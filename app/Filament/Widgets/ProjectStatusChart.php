<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Proyek';
    protected static ?int $sort = 2;
    
    protected function getData(): array
    {
        $statuses = ['Preparation', 'Process', 'BAST', 'Success', 'Cancel', 'Completed'];
        $counts = [];
        $colors = ['#4F46E5', '#F59E0B', '#10B981', '#16A34A', '#EF4444', '#6366F1'];
        
        foreach ($statuses as $status) {
            $counts[] = Project::where('status', $status)->count();
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Proyek',
                    'data' => $counts,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $statuses,
        ];
    }
    
    protected function getType(): string
    {
        return 'doughnut';
    }
}