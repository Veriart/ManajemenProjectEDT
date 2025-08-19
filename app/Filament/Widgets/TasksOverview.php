<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TasksOverview extends BaseWidget
{
    protected static ?string $heading = 'Tugas Terbaru';
    protected static ?int $sort = 4;
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Task::query()
                    ->with('project')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('project.name')
                    ->label('Proyek')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Tugas')
                    ->searchable(),
                TextColumn::make('task_date')
                    ->label('Tanggal')
                    ->date(),
                TextColumn::make('coordinator')
                    ->label('Koordinator')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'Pending',
                        'warning' => 'In Progress',
                        'success' => 'Completed',
                        'danger' => 'Cancelled',
                    ]),
            ])
            ->actions([])
            ->bulkActions([]);
    }
}