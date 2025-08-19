<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentProjects extends BaseWidget
{
    protected static ?string $heading = 'Proyek Terbaru';
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Proyek')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('thirdParty.name')
                    ->label('Klien')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Preparation',
                        'warning' => 'Process',
                        'success' => fn ($state) => in_array($state, ['Success', 'Completed']),
                        'danger' => 'Cancel',
                    ]),
                TextColumn::make('cost')
                    ->label('Biaya')
                    ->money('idr'),
                TextColumn::make('expenses')
                    ->label('Pengeluaran')
                    ->money('idr'),
                TextColumn::make('net_cost')
                    ->label('Laba Bersih')
                    ->money('idr'),
            ])
            ->actions([])
            ->bulkActions([]);
    }
}