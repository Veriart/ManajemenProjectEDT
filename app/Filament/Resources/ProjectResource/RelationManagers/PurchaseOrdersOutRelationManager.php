<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ThirdParty;
use App\Models\PurchaseOrder;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PurchaseOrdersOutRelationManager extends RelationManager
{
    protected static string $relationship = 'purchaseOrdersOut';

    protected static ?string $recordTitleAttribute = 'order_code';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->label('Project Name')
                    ->required()
                    ->disabled()
                    ->default(fn() => $this->ownerRecord->id),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('order_code')
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Preparation' => 'gray',
                        'Process' => 'purple',
                        'BAST' => 'info',
                        'Success' => 'success',
                        'Cancel' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('sales_tax')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d F Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Preparation' => 'Preparation',
                        'Process' => 'Process',
                        'BAST' => 'BAST',
                        'Success' => 'Success',
                        'Cancel' => 'Cancel',
                    ]),
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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['project_id'] = $this->ownerRecord->id;
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => route('filament.app.resources.purchase-orders.edit', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}