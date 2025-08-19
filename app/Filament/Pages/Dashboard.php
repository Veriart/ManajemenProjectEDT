<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SalesChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
    
    public function getWidgets(): array
    {
        return [
            // SalesChart::class,
        ];
    }
}