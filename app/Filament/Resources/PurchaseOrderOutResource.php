<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\ThirdParty;
use Filament\Tables\Table;
use App\Models\PurchaseOrder;
use Ramsey\Uuid\Type\Integer;
use Filament\Resources\Resource;
use Filament\Forms\Components\Mask;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PurchaseOrderResource\Pages;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\ItemOrdersRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\FileOrdersRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\InvoicesRelationManager;
use Filament\Forms\Components\Actions\Action;

class PurchaseOrderOutResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationGroup = 'Project';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    // protected static ?string $navigationLabel = 'Purchase Order Out';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('order_code')
                    ->label('Purchase Order')
                    ->readOnly()
                    ->required()
                    ->afterStateHydrated(function (callable $set) {
                        // Ambil tahun (2 digit) dan bulan (2 digit)
                        $year = date('y'); // Contoh: 25
                        $month = date('m'); // Contoh: 05
                        // Hitung jumlah data pada bulan dan tahun ini
                        $orderCount = PurchaseOrder::whereYear('created_at', date('Y'))
                            ->whereMonth('created_at', date('m'))
                            ->count();
                        // Buat nomor urut baru (+1 dari jumlah data)
                        $newNumber = str_pad($orderCount + 1, 4, '0', STR_PAD_LEFT);
                        // Gabungkan ke format PO
                        $poCode = "PO{$year}{$month}-{$newNumber}";

                        // Check if PO code already exists
                        while (PurchaseOrder::where('order_code', $poCode)->exists()) {
                            // If exists, increment number and regenerate code
                            $newNumber = str_pad((int)$newNumber + 1, 4, '0', STR_PAD_LEFT);
                            $poCode = "PO{$year}{$month}-{$newNumber}";
                        }

                        // Setel state di form
                        $set('order_code', $poCode);
                    }),
                TextInput::make('project')
                    ->label('Project Name')
                    ->required(),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'In' => 'In',
                        'Out' => 'Out',
                    ])
                    ->required()
                    ->reactive(),
                Select::make('third_party_id')
                    ->relationship('thirdParty', 'name', function ($query, $get) {
                        // Filter third party based on PO type
                        if ($get('type') === 'Out') {
                            $query->where('type', 'Vendor');
                        } else {
                            $query->where('type', 'Customer');
                        }
                    })
                    ->required()
                    ->hidden(fn(callable $get): bool => empty($get('type')))
                    ->createOptionForm([
                        TextInput::make('code')
                            ->label('Code')
                            ->readOnly()
                            ->dehydrated()
                            ->required()
                            ->reactive(),
                        TextInput::make('name')->required(),
                        TextInput::make('alias')->required(),
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'Vendor' => 'Vendor',
                                'Customer' => 'Customer',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Hitung jumlah berdasarkan tipe
                                $count = ThirdParty::where('type', $state)->count() + 1;
                                // Tentukan awalan berdasarkan tipe
                                $prefix = $state === 'Vendor' ? 'EV' : 'EC';
                                // Format final kode
                                $code = $prefix . date('ym') . str_pad($count, 5, '0', STR_PAD_LEFT);
                                // Set ke input code
                                $set('code', $code);
                            }),
                        Select::make('status')
                            ->options([
                                'Active' => 'Active',
                                'Non Active' => 'Non Active',
                            ])
                            ->required(),
                        TextInput::make('vat')->required(),
                        TextInput::make('contact')->required(),
                        TextInput::make('telepon')->required(),
                        TextInput::make('address')->required(),
                        TextInput::make('website'),
                    ]),
                TextInput::make('project_location')
                    ->label('Project Location')
                    ->required(fn(callable $get): bool => $get('type') === 'In')
                    ->hidden(fn(callable $get): bool => empty($get('type'))),
                Select::make('status')
                    ->label('Status Order')
                    ->options([
                        'Pending' => 'Pending',
                        'Preparation' => 'Preparation',
                        'Process' => 'Process',
                        'BAST' => 'BAST',
                        'Success' => 'Success',
                        'Cancel' => 'Cancel',
                    ])
                    ->default('Preparation')
                    ->required(),
                DatePicker::make('planned_date')
                    ->label('Planned date of delivery')
                    ->displayFormat('d m Y')
                    ->required(),
                Forms\Components\Grid::make(4)
                    ->schema([
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->prefix('Rp ')
                            ->readOnly()
                            ->dehydrated()
                            ->formatStateUsing(fn($state) => number_format((float) $state, 0, ',', '.'))
                            ->reactive()
                            ->afterStateHydrated(function ($state, callable $set, callable $get) {
                                $salesTax = (float) $get('sales_tax');
                                $discount = (float) $get('discount') ?? 0;
                                $price = (float) str_replace(['Rp ', '.', ','], ['', '', '.'], $state);

                                // Apply discount if exists
                                $priceAfterDiscount = $price - $discount;
                                $incTax = $priceAfterDiscount + ($priceAfterDiscount * ($salesTax / 100));
                                $set('inc_tax', $incTax);

                                // Update database
                                if ($record = PurchaseOrder::find($get('id'))) {
                                    $record->update([
                                        'inc_tax' => $incTax
                                    ]);
                                }
                            }),

                        TextInput::make('sales_tax')
                            ->label('Sales Tax')
                            ->numeric()
                            ->suffix('%')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $price = (float) str_replace(['Rp ', '.', ','], ['', '', '.'], $get('price'));
                                $salesTax = (float) $state;
                                $discount = (float) $get('discount') ?? 0;

                                $priceAfterDiscount = $price - $discount;
                                $incTax = $priceAfterDiscount + ($priceAfterDiscount * ($salesTax / 100));
                                $set('inc_tax', $incTax);

                                // Update database
                                if ($record = PurchaseOrder::find($get('id'))) {
                                    $record->update([
                                        'sales_tax' => $salesTax,
                                        'inc_tax' => $incTax
                                    ]);
                                }
                            }),

                        TextInput::make('inc_tax')
                            ->label('Include Tax')
                            ->numeric()
                            ->readOnly()
                            ->prefix('Rp ')
                            ->dehydrated()
                            ->formatStateUsing(fn($state) => number_format((float) $state, 0, ',', '.'))
                            ->afterStateHydrated(function (callable $set, callable $get) {
                                $price = (float) str_replace(['Rp ', '.', ','], ['', '', '.'], $get('price'));
                                $salesTax = (float) $get('sales_tax');
                                $discount = (float) $get('discount') ?? 0;

                                $priceAfterDiscount = $price - $discount;
                                $incTax = $priceAfterDiscount + ($priceAfterDiscount * ($salesTax / 100));
                                $set('inc_tax', $incTax);

                                // Update database
                                if ($record = PurchaseOrder::find($get('id'))) {
                                    $record->update([
                                        'inc_tax' => $incTax
                                    ]);
                                }
                            }),

                        TextInput::make('discount')
                            ->label('Discount')
                            ->numeric()
                            ->prefix('Rp ')
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $price = (float) str_replace(['Rp ', '.', ','], ['', '', '.'], $get('price'));
                                $salesTax = (float) $get('sales_tax');
                                $discount = (float) $state;

                                $priceAfterDiscount = $price - $discount;
                                $incTax = $priceAfterDiscount + ($priceAfterDiscount * ($salesTax / 100));
                                $set('inc_tax', $incTax);

                                // Update database
                                if ($record = PurchaseOrder::find($get('id'))) {
                                    $record->update([
                                        'discount' => $discount,
                                        'inc_tax' => $incTax
                                    ]);
                                }
                            }),
                    ]),


                Select::make('payment_terms')
                    ->options([
                        'DP 30%, Progress 30%, After BAST 40%' => 'DP 30%, Progress 30%, After BAST 40%',
                        'DP 50%, Progress 20%, After BAST 25%, Retensi 1 Bulan 5%' => 'DP 50%, Progress 20%, After BAST 25%, Retensi 1 Bulan 5%',
                        '30% Down Payment, 60% Before Delivery, 10% After TesComm' => '30% Down Payment, 60% Before Delivery, 10% After TesComm',
                        'Cash On Delivery' => 'Cash On Delivery',
                        '50% DP, 50% After BAST' => '50% DP, 50% After BAST',
                        '50% DP, 50% Before Delivery' => '50% DP, 50% Before Delivery',
                        'Invoice/Maintenance Visit' => 'Invoice/Maintenance Visit',
                        'No DP, 100% After Completion' => 'No DP, 100% After Completion',
                        '40% Before Delivery, 55% After BAST, 5% Retention' => '40% Before Delivery, 55% After BAST, 5% Retention',
                        '100% Before Delivery' => '100% Before Delivery',
                        'DP 30%, Progress 30%, After Completion 35%, 5% Retention' => 'DP 30%, Progress 30%, After Completion 35%, 5% Retention',
                        'Due Upon Receipt' => 'Due Upon Receipt'
                    ])
                    ->required(),
                Select::make('payment_type')
                    ->options([
                        'Bank Transfer' => 'Bank Transfer',
                        'Cash' => 'Cash',
                        'Check' => 'Check',
                        'Credit Card' => 'Credit Card',
                        'Debit Payment Order' => 'Debit Payment Order'
                    ])
                    ->required(),
                DatePicker::make('created_at')
                    ->label('Created At')
                    ->displayFormat('d F Y')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'Out'))
            ->defaultSort('created_at', 'desc') // Sort by newest first
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pic')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'In' => 'info',
                        'Out' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('thirdParty.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Preparation' => 'gray',
                        'Process' => 'puple',
                        'BAST' => 'info',
                        'Success' => 'success',
                        'Cancel' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('planned_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('sales_tax')
                    ->numeric()
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inc_tax')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_terms')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d F Y')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $created = \Carbon\Carbon::parse($state);
                        $now = \Carbon\Carbon::now();
                        $diff = $created->diffInDays($now);
                        $diff = ceil($diff);

                        return $created->format('d F Y') . ' (' . $diff . ' days ago)';
                    })
                    ->color(function ($state) {
                        $created = \Carbon\Carbon::parse($state);
                        $now = \Carbon\Carbon::now();
                        $diff = ceil($created->diffInDays($now));

                        return match (true) {
                            $diff <= 7 => 'success',    // Less than a week
                            $diff <= 30 => 'warning',   // Less than a month 
                            default => 'danger',        // More than a month
                        };
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'In' => 'In',
                        'Out' => 'Out',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Preparation' => 'Preparation',
                        'Process' => 'Process',
                        'BAST' => 'BAST',
                        'Success' => 'Success',
                        'Cancel' => 'Cancel',
                    ]),
                Tables\Filters\SelectFilter::make('third_party')
                    ->relationship('thirdParty', 'name'),
                Tables\Filters\Filter::make('planned_date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('planned_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('planned_date', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('min_price')
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('max_price')
                            ->numeric()
                            ->prefix('Rp'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn(Builder $query, $min): Builder => $query->where('price', '>=', $min),
                            )
                            ->when(
                                $data['max_price'],
                                fn(Builder $query, $max): Builder => $query->where('price', '<=', $max),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->label('Cetak')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('purchase-order.print', ['record' => $record->id]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemOrdersRelationManager::class,
            FileOrdersRelationManager::class,
            InvoicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }
}
