<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BusinessOverview;
use App\Filament\Widgets\ProjectStatusChart;
use App\Filament\Widgets\RecentProjects;
use App\Filament\Widgets\FinancialSummary;
use App\Filament\Widgets\TasksOverview;
use App\Filament\Widgets\ExpensesChart;
use App\Filament\Widgets\InvoiceStatus;
use Filament\Pages\Page;

class BusinessDashboard extends Page
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationLabel = 'Dashboard Bisnis';
    protected static ?string $title = 'Dashboard Bisnis';
    protected static ?int $navigationSort = -2;

    protected static string $view = 'filament.pages.business-dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            BusinessOverview::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            ProjectStatusChart::class,
            FinancialSummary::class,
            RecentProjects::class,
            TasksOverview::class,
            ExpensesChart::class,
            InvoiceStatus::class,
        ];
    }
}
