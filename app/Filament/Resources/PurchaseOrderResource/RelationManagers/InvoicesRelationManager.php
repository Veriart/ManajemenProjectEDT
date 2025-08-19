<?php

namespace App\Filament\Resources\PurchaseOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Invoice Number')
                    ->default(function () {
                        $today = now();
                        $prefix = 'INV_' . $today->format('Ymd');

                        // Get count of today's invoices and add 1 for the new invoice
                        $todayCount = \App\Models\Invoice::whereDate('created_at', $today->toDateString())->count() + 1;

                        // Format the counter to 4 digits (0001, 0002, etc)
                        $suffix = str_pad($todayCount, 4, '0', STR_PAD_LEFT);

                        return $prefix . $suffix;
                    })
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount_paid')
                    ->label('Amount Paid')
                    ->numeric()
                    ->prefix('Rp ')
                    ->step(1)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($set, $get, $state) {
                        $purchaseOrder = $this->getOwnerRecord();
                        $totalAmount = $purchaseOrder->inc_tax;
                        
                        // Exclude current invoice when calculating total paid
                        $currentInvoiceId = $get('id');
                        $totalPaid = $purchaseOrder->invoices()
                            ->when($currentInvoiceId, function ($query) use ($currentInvoiceId) {
                                $query->where('id', '!=', $currentInvoiceId);
                            })
                            ->sum('amount_paid');
                        
                        $currentAmount = (int)($state ?? 0);
                        $remainingBalance = $totalAmount - ($totalPaid + $currentAmount);
                        
                        // Ensure remaining balance doesn't go below 0
                        $set('remaining_balance', max(0, $remainingBalance));
                    }),
                Forms\Components\TextInput::make('remaining_balance')
                    ->label('Remaining Balance')
                    ->numeric()
                    ->prefix('Rp ')
                    ->disabled()
                    ->dehydrated()
                    ->default(function ($get) {
                        $purchaseOrder = $this->getOwnerRecord();
                        $totalAmount = $purchaseOrder->inc_tax;
                        $totalPaid = (int)$purchaseOrder->invoices()->sum('amount_paid');
                        return max(0, $totalAmount - $totalPaid);
                    }),
                Forms\Components\Select::make('status')
                    ->options([
                        'Unpaid' => 'Unpaid',
                        'Send' => 'Send',
                        'Paid' => 'Paid',
                    ])
                    ->default('Unpaid')
                    ->required(),
                DatePicker::make('created_at')
                    ->label('Created At')
                    ->displayFormat('d F Y')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('remaining_balance')
                    ->formatStateUsing(function ($record) {
                        $purchaseOrder = $record->purchaseOrder;
                        $totalAmount = $purchaseOrder->inc_tax;
                        $totalPaid = $purchaseOrder->invoices()
                            ->where('id', '<=', $record->id)
                            ->sum('amount_paid');
                        $remainingBalance = max(0, $totalAmount - $totalPaid);
                        return 'Rp ' . number_format($remainingBalance, 0, ',', '.');
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Unpaid' => 'danger',
                        'Send' => 'warning',
                        'Paid' => 'success',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Action::make('print')
                    ->label('Print/Download')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('invoice.print', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
