<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\ThirdParty;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ThirdPartyResource\Pages;
use App\Filament\Resources\ThirdPartyResource\RelationManagers;

class ThirdPartyResource extends Resource
{
    protected static ?string $model = ThirdParty::class;

    protected static ?string $navigationGroup = 'Project';
    protected static ?int $navigationSort = -2;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label('Code')->searchable(),
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('alias')->label('Alias')->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Vendor' => 'warning',
                        'Customer' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Active' => 'success',
                        'Non Active' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('vat')->label('VAT'),
                TextColumn::make('contact')->label('Contact'),
                TextColumn::make('telepon')->label('Telepon'),
                TextColumn::make('address')->label('Address')->limit(30),
                TextColumn::make('website')->label('Website')->limit(30),
                TextColumn::make('created_at')->label('Created')->dateTime()->sortable(),
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
            'index' => Pages\ListThirdParties::route('/'),
            'create' => Pages\CreateThirdParty::route('/create'),
            'edit' => Pages\EditThirdParty::route('/{record}/edit'),
        ];
    }
}
