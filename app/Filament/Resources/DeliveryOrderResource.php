<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryOrderResource\Pages;
use App\Filament\Resources\DeliveryOrderResource\RelationManagers\DeliveryItemsRelationManager;
use App\Models\DeliveryOrder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryOrderResource extends Resource
{
    protected static ?string $model = DeliveryOrder::class;

    protected static ?string $navigationGroup = 'Project';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated()
                    ->default(function ($get) {
                        $purchaseOrderId = $get('purchase_order_id');

                        if (!$purchaseOrderId) {
                            return '';
                        }

                        // Get the count of delivery orders for this PO
                        $doCount = DeliveryOrder::where('purchase_order_id', $purchaseOrderId)->count() + 1;

                        // Get purchase order details
                        $po = \App\Models\PurchaseOrder::with('thirdParty')->find($purchaseOrderId);

                        if (!$po) {
                            return '';
                        }

                        // Format: {DO count}/EDT/DO/{third party name}/{current month}/{current year}
                        return sprintf(
                            '%02d/EDT/DO/%s/%s/%s',
                            $doCount,
                            $po->thirdParty->name ?? 'UNKNOWN',
                            now()->format('m'),
                            now()->format('Y')
                        );
                    })
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $purchaseOrderId = $get('purchase_order_id');

                        if (!$purchaseOrderId) {
                            $set('code', '');
                            return;
                        }

                        $doCount = DeliveryOrder::where('purchase_order_id', $purchaseOrderId)->count() + 1;
                        $po = \App\Models\PurchaseOrder::with('thirdParty')->find($purchaseOrderId);

                        if (!$po) {
                            $set('code', '');
                            return;
                        }

                        $code = sprintf(
                            '%02d/EDT/DO/%s/%s/%s',
                            $doCount,
                            $po->thirdParty->name ?? 'UNKNOWN',
                            now()->format('m'),
                            now()->format('Y')
                        );

                        $set('code', $code);
                    }),
                Select::make('purchase_order_id')
                    ->relationship(
                        'purchaseOrder',
                        'order_code',
                        fn(Builder $query) =>
                        $query->select(['id', 'order_code'])
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        "{$record->order_code} ({$record->purchaseOrder})"
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        if (!$state) {
                            $set('code', '');
                            return;
                        }

                        $doCount = DeliveryOrder::where('purchase_order_id', $state)->count() + 1;
                        $po = \App\Models\PurchaseOrder::with('thirdParty')->find($state);

                        if (!$po) {
                            $set('code', '');
                            return;
                        }

                        $code = sprintf(
                            '%02d/EDT/DO/%s/%s/%s',
                            $doCount,
                            $po->thirdParty->name ?? 'UNKNOWN',
                            now()->format('m'),
                            now()->format('Y')
                        );

                        $set('code', $code);
                    }),
                Select::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Delivered' => 'Delivered'
                    ])
                    ->default('Draft')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('purchaseOrder.order_code')
                    ->searchable(),
                TextColumn::make('purchaseOrder.project.name')
                    ->label('Project Name')
                    ->searchable(),
                TextColumn::make('purchaseOrder.project.project_location')
                    ->label('Project Location')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'delivered' => 'success',
                        default => 'gray'
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->url(fn(DeliveryOrder $record): string => route('delivery-order.print', $record))
                    ->openUrlInNewTab(),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DeliveryItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveryOrders::route('/'),
            'create' => Pages\CreateDeliveryOrder::route('/create'),
            'edit' => Pages\EditDeliveryOrder::route('/{record}/edit'),
        ];
    }
}
