<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use App\Models\ThirdParty;
use Filament\Tables\Table;
use App\Models\PurchaseOrder;
use Ramsey\Uuid\Type\Integer;
use Filament\Resources\Resource;
use Filament\Forms\Components\Mask;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PurchaseOrderResource\Pages;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\InvoicesRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\FileOrdersRelationManager;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers\ItemOrdersRelationManager;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;
    protected static ?string $navigationGroup = 'Project';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->label('Project Name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('code')
                            ->label('Code Project')
                            ->readOnly()
                            ->required()
                            ->afterStateHydrated(function (callable $set) {
                                // Get year (2 digits) and month (2 digits)
                                $year = date('y');
                                $month = date('m');

                                // Count data for current month and year
                                $orderCount = Project::whereYear('created_at', date('Y'))
                                    ->whereMonth('created_at', date('m'))
                                    ->count();

                                // Create new sequence number
                                $newNumber = str_pad($orderCount + 1, 4, '0', STR_PAD_LEFT);

                                // Combine into PO format
                                $poCode = "EP{$year}{$month}-{$newNumber}";

                                // Check for duplicates and increment if needed
                                while (Project::where('code', $poCode)->exists()) {
                                    $newNumber = str_pad((int)$newNumber + 1, 4, '0', STR_PAD_LEFT);
                                    $poCode = "EP{$year}{$month}-{$newNumber}";
                                }

                                // Set form state
                                $set('code', $poCode);
                            }),
                        TextInput::make('name')
                            ->label('Project Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('project_location')
                            ->required()
                            ->maxLength(255),
                        Select::make('third_party_id')
                            ->relationship('thirdParty', 'name')
                            ->required()
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
                                        $count = ThirdParty::where('type', $state)->count() + 1;
                                        $prefix = $state === 'Vendor' ? 'EV' : 'EC';
                                        $code = $prefix . date('ym') . str_pad($count, 5, '0', STR_PAD_LEFT);
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
                        DatePicker::make('planned_date')
                            ->required(),
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Preparation' => 'Preparation',
                                'Process' => 'Process',
                                'BAST' => 'BAST',
                                'Success' => 'Success',
                                'Cancel' => 'Cancel'
                            ])
                            ->default('Pending')
                            ->required(),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('cost')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->readOnly(),
                                TextInput::make('remaining_invoice')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->readOnly(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('expenses')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->readOnly(),
                                TextInput::make('net_cost')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0)
                                    ->readOnly(),
                            ]),
                        Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),

                    ])
                    ->createOptionAction(function (Action $action) {
                        return $action
                            ->modalHeading('Create new project')
                            ->modalButton('Create project')
                            ->modalWidth('lg');
                    }),
                Forms\Components\TextInput::make('order_code')
                    ->label('Purchase Order')
                    ->readOnly()
                    ->required()
                    ->afterStateHydrated(function (callable $set) {
                        // Get year and month in 2 digits format
                        $year = date('y');
                        $month = date('m');

                        // Count orders for current month/year
                        $orderCount = PurchaseOrder::whereYear('created_at', date('Y'))
                            ->whereMonth('created_at', date('m'))
                            ->count();

                        // Generate new sequence number
                        $newNumber = str_pad($orderCount + 1, 4, '0', STR_PAD_LEFT);

                        // Generate PO code
                        $poCode = "POO{$year}{$month}-{$newNumber}";

                        // Check for duplicates and increment if needed
                        while (PurchaseOrder::where('order_code', $poCode)->exists()) {
                            $newNumber = str_pad((int)$newNumber + 1, 4, '0', STR_PAD_LEFT);
                            $poCode = "POO{$year}{$month}-{$newNumber}";
                        }

                        $set('order_code', $poCode);
                        $set('type', 'Out');
                    }),
                Forms\Components\Hidden::make('type')
                    ->default('Out'),
                Forms\Components\Select::make('status')
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
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->prefix('Rp ')
                            ->readOnly()
                            ->default(0)
                            ->dehydrated(),
                        Forms\Components\TextInput::make('sales_tax')
                            ->label('Sales Tax')
                            ->numeric()
                            ->suffix('%')
                            ->default(11)
                            ->required(),
                        Forms\Components\TextInput::make('inc_tax')
                            ->label('Include Tax')
                            ->numeric()
                            ->readOnly()
                            ->prefix('Rp ')
                            ->default(0)
                            ->dehydrated(),
                        Forms\Components\TextInput::make('discount')
                            ->label('Discount')
                            ->numeric()
                            ->prefix('Rp ')
                            ->default(0),
                    ]),
                Forms\Components\Select::make('payment_terms')
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
                Forms\Components\Select::make('payment_type')
                    ->options([
                        'Bank Transfer' => 'Bank Transfer',
                        'Cash' => 'Cash',
                        'Check' => 'Check',
                        'Credit Card' => 'Credit Card',
                        'Debit Payment Order' => 'Debit Payment Order'
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc') // Sort by newest first
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.name')
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
                // ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(function () {
                        $params = [
                            'start_date' => request('tableFilters.planned_date.from') ?? now()->startOfMonth()->format('Y-m-d'),
                            'end_date' => request('tableFilters.planned_date.until') ?? now()->endOfMonth()->format('Y-m-d'),
                            'status' => request('tableFilters.status') ?? 'all',
                            'type' => request('tableFilters.type') ?? 'all',
                            'third_party_id' => request('tableFilters.third_party') ?? 'all',
                        ];

                        return route('purchase-order.export-pdf', $params);
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-table')
                    ->color('primary')
                    ->url(function () {
                        $params = [
                            'start_date' => request('tableFilters.planned_date.from') ?? now()->startOfMonth()->format('Y-m-d'),
                            'end_date' => request('tableFilters.planned_date.until') ?? now()->endOfMonth()->format('Y-m-d'),
                            'status' => request('tableFilters.status') ?? 'all',
                            'type' => request('tableFilters.type') ?? 'all',
                            'third_party_id' => request('tableFilters.third_party') ?? 'all',
                        ];

                        return route('purchase-order.export-excel', $params);
                    })
                    ->openUrlInNewTab(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
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
