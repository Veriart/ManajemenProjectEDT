<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

// class SalesChart extends ChartWidget
// {
    // protected static ?string $heading = 'Grafik Penjualan';

    // protected function getData(): array
    // {
    //     $finishedData = PurchaseOrder::query()
    //         ->selectRaw('DATE(created_at) as date, SUM(inc_tax) as total')
    //         ->where('created_at', '>=', now()->subMonths(6))
    //         ->where('status', 'finish')
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     $unfinishedData = PurchaseOrder::query()
    //         ->selectRaw('DATE(created_at) as date, SUM(inc_tax) as total')
    //         ->where('created_at', '>=', now()->subMonths(6))
    //         ->where('status', '!=', 'finish')
    //         ->where('status', '!=', 'cancel')
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     $canceledData = PurchaseOrder::query()
    //         ->selectRaw('DATE(created_at) as date, SUM(inc_tax) as total')
    //         ->where('created_at', '>=', now()->subMonths(6))
    //         ->where('status', 'cancel')
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     // Get all unique dates
    //     $allDates = collect()
    //         ->merge($finishedData->pluck('date'))
    //         ->merge($unfinishedData->pluck('date'))
    //         ->merge($canceledData->pluck('date'))
    //         ->unique()
    //         ->sort();

    //     return [
    //         'datasets' => [
    //             [
    //                 'label' => 'Penjualan Selesai',
    //                 'data' => $finishedData->pluck('total')->toArray(),
    //                 'borderColor' => '#36A2EB',
    //                 'fill' => false,
    //             ],
    //             [
    //                 'label' => 'Penjualan Dalam Proses',
    //                 'data' => $unfinishedData->pluck('total')->toArray(),
    //                 'borderColor' => '#FFB74D',
    //                 'fill' => false,
    //             ],
    //             [
    //                 'label' => 'Penjualan Dibatalkan',
    //                 'data' => $canceledData->pluck('total')->toArray(),
    //                 'borderColor' => '#FF5252',
    //                 'fill' => false,
    //             ],
    //         ],
    //         'labels' => $allDates
    //             ->map(fn ($date) => Carbon::parse($date)->format('d M Y'))
    //             ->toArray(),
    //     ];
    // }

    // protected function getType(): string
    // {
    //     return 'line';
    // }
// }