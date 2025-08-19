<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use App\Models\ThirdParty;
use Filament\Tables\Table;
use App\Models\PurchaseOrder;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Navigation\NavigationItem;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\TasksRelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers\PurchaseOrdersInRelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers\PurchaseOrdersOutRelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers\UnexpectedExpensesRelationManager;

class ProjectResource extends Resource
{
    protected static ?string $navigationGroup = 'Project';

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\Grid::make(4)
                    ->schema([
                        TextInput::make('cost')
                            ->prefix('Rp ')
                            ->default(0)
                            ->readOnly()
                            ->dehydrated(false) // jangan simpan ke DB dari sini
                            ->formatStateUsing(fn($state) => $state !== null ? number_format((float) $state, 0, ',', '.') : '0'),

                        TextInput::make('remaining_invoice')
                            ->prefix('Rp ')
                            ->default(0)
                            ->readOnly()
                            ->dehydrated(false)
                            ->formatStateUsing(fn($state) => $state !== null ? number_format((float) $state, 0, ',', '.') : '0'),

                        TextInput::make('expenses')
                            ->prefix('Rp ')
                            ->default(0)
                            ->readOnly()
                            ->dehydrated(false)
                            ->formatStateUsing(fn($state) => $state !== null ? number_format((float) $state, 0, ',', '.') : '0'),

                        TextInput::make('net_cost')
                            ->prefix('Rp ')
                            ->default(0)
                            ->readOnly()
                            ->dehydrated(false)
                            ->formatStateUsing(fn($state) => $state !== null ? number_format((float) $state, 0, ',', '.') : '0'),

                    ]),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thirdParty.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('planned_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('remaining_invoice')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expenses')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_cost')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Preparation' => 'Preparation',
                        'Process' => 'Process',
                        'BAST' => 'BAST',
                        'Success' => 'Success',
                        'Cancel' => 'Cancel'
                    ]),
                Tables\Filters\SelectFilter::make('third_party_id')
                    ->relationship('thirdParty', 'name'),
                Tables\Filters\Filter::make('planned_date')
                    ->form([
                        DatePicker::make('planned_from'),
                        DatePicker::make('planned_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['planned_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('planned_date', '>=', $date),
                            )
                            ->when(
                                $data['planned_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('planned_date', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        DatePicker::make('start_from'),
                        DatePicker::make('start_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                            )
                            ->when(
                                $data['start_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\Action::make('print')
                //     ->label('Cetak')
                //     ->icon('heroicon-o-printer')
                //     ->url(fn($record) => route('purchase-order.print', ['record' => $record->id]))
                //     ->openUrlInNewTab(),
                Tables\Actions\Action::make('export_bast')
                    ->label('Export BAST')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->url(fn($record) => route('project.export-bast', ['id' => $record->id]))
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->status === 'BAST' || $record->status === 'Success'),
                Tables\Actions\Action::make('timeline')
                    ->label('Timeline')
                    ->icon('heroicon-o-clock')
                    ->color('primary')
                    ->url(fn($record) => ProjectResource::getUrl('timeline', ['record' => $record->id]))
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
            PurchaseOrdersInRelationManager::class,
            PurchaseOrdersOutRelationManager::class,
            TasksRelationManager::class,
            UnexpectedExpensesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'timeline' => Pages\ProjectTimeline::route('/{record}/timeline'),
        ];
    }
}
