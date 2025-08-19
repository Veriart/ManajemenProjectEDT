<?php

namespace App\Filament\Resources\PurchaseOrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PurchaseOrder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ItemOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'itemOrders';
    protected static ?string $recordTitleAttribute = 'name';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Item Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'Material' => 'Material',
                        'Service' => 'Service',
                    ])
                    ->default('Material')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->prefix('Rp ')
                    ->required()
                    ->live(debounce: 500)
                    // format ribuan saat edit form dibuka
                    ->afterStateHydrated(
                        fn($component, $state) =>
                        $component->state(
                            $state ? number_format((float) $state, 0, ',', '.') : null
                        )
                    )
                    // simpan ke DB dalam bentuk integer
                    ->dehydrateStateUsing(
                        fn($state) =>
                        (int) str_replace('.', '', $state)
                    )
                    // auto-format ribuan + hitung total ketika user ubah harga
                    ->afterStateUpdated(function ($state, $set, $get, $component) {
                        if (blank($state)) return;

                        $clean = (int) str_replace('.', '', $state);
                        $component->state(number_format($clean, 0, ',', '.'));

                        $qty   = (int) $get('qty') ?: 0;
                        $total = $clean * $qty;

                        // set total dengan format ribuan langsung
                        $set('total', number_format($total, 0, ',', '.'));
                    }),

                Forms\Components\TextInput::make('qty')
                    ->label('Quantity')
                    ->numeric()
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if ($state === null || $state === '') return;

                        $price = (int) str_replace('.', '', $get('price'));
                        $qty   = (int) $state ?: 0;
                        $total = $price * $qty;

                        // set total dengan format ribuan langsung
                        $set('total', number_format($total, 0, ',', '.'));
                    }),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->prefix('Rp ')
                    ->disabled()
                    ->dehydrated()
                    // pastikan tampil terformat kalau dari DB
                    ->afterStateHydrated(
                        fn($component, $state) =>
                        $component->state(
                            $state ? number_format((float) $state, 0, ',', '.') : null
                        )
                    )
                    ->dehydrateStateUsing(
                        fn($state) =>
                        (int) str_replace('.', '', $state)
                    ),
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->default('Material')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'Material' => 'Material',
                        'Service' => 'Service',
                        default => 'Material'
                    })
                    ->sortable(),
                TextColumn::make('price')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('qty')
                    ->label('Quantity')
                    ->sortable(),
                TextColumn::make('total')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Preparation' => 'gray',
                        'Delivery' => 'warning',
                        'Done' => 'success',
                    }),
            ])
            ->defaultSort('type', 'desc')
            ->defaultSort('created_at', 'asc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
