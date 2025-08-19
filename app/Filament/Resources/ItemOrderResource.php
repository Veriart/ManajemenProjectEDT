<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemOrderResource\Pages;
use App\Filament\Resources\ItemOrderResource\RelationManagers;
use App\Models\ItemOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemOrderResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = ItemOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemOrders::route('/'),
            'create' => Pages\CreateItemOrder::route('/create'),
            'edit' => Pages\EditItemOrder::route('/{record}/edit'),
        ];
    }
}
