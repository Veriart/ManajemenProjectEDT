<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use App\Models\ThirdParty;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // protected function getStats(): array
    // {
    //     $thirdPartyStats = ThirdParty::query()
    //         ->selectRaw('type, COUNT(*) as count')
    //         ->groupBy('type')
    //         ->get()
    //         ->map(fn ($stat) => Stat::make(
    //             "Total {$stat->type}",
    //             $stat->count
    //         ));

    //     $purchaseOrderStats = PurchaseOrder::query()
    //         ->selectRaw('status, COUNT(*) as count')
    //         ->groupBy('status')
    //         ->get()
    //         ->map(fn ($stat) => Stat::make(
    //             "Project {$stat->status}",
    //             $stat->count
    //         ));

    //     $totalSales = PurchaseOrder::sum('inc_tax');

    //     return [
    //         // Stat::make('Total Penjualan', 'Rp ' . number_format($totalSales, 0, ',', '.')),
    //         ...$thirdPartyStats,
    //         ...$purchaseOrderStats,
    //     ];
    // }
}