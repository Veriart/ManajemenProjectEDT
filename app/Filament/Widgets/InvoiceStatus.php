<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InvoiceStatus extends BaseWidget
{
    protected static ?string $heading = 'Status Invoice';
    protected static ?int $sort = 6;
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invoice::query()
                    ->with('purchaseOrder')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('code')
                    ->label('Kode Invoice')
                    ->searchable(),
                TextColumn::make('purchaseOrder.order_code')
                    ->label('Kode PO')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('amount_paid')
                    ->label('Dibayar')
                    ->money('idr'),
                TextColumn::make('remaining_balance')
                    ->label('Sisa')
                    ->money('idr'),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Pending',
                        'warning' => 'Partial',
                        'success' => 'Paid',
                        'danger' => 'Overdue',
                    ]),
            ])
            ->actions([])
            ->bulkActions([]);
    }
}