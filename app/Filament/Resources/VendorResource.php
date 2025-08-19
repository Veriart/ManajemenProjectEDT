<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vendor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VendorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VendorResource\RelationManagers;

class VendorResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationGroup = 'Project';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->default(fn() => 'EV' . date('ym') . str_pad(Vendor::count() + 1, 5, '0', STR_PAD_LEFT))
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                TextInput::make('name')->required(),
                TextInput::make('as')->required(),
                Select::make('type')
                    ->options([
                        'Vendor' => 'Vendor',
                        'Customer' => 'Customer',
                    ])
                    ->required(),
                Select::make('status')
                    ->options([
                        'Vendor' => 'Vendor',
                        'Customer' => 'Customer',
                    ])
                    ->required(),
                TextInput::make('vat')->required(),
                TextInput::make('contact')->required(),
                TextInput::make('telepon')->required(),
                TextInput::make('address')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('name'),
                TextColumn::make('vat')->label('VAT ID'),
                TextColumn::make('contact'),
                TextColumn::make('telepon'),
                TextColumn::make('address'),
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
            'index' => Pages\ListVendors::route('/'),
            // 'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
