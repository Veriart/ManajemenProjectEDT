<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

// class SalesSummary extends BaseWidget
// {
//     protected function getStats(): array
//     {
//         $totalSales = PurchaseOrder::where('type', 'Out')
//             ->where('status', '!=', 'Cancel')
//             ->sum('inc_tax');
            
//         $totalPaid = Invoice::where('status', 'Paid')
//             ->sum('amount_paid');
            
//         $totalUnpaid = $totalSales - $totalPaid;
        
//         $monthlyIncome = PurchaseOrder::where('type', 'Out')
//             ->where('status', '!=', 'Cancel')
//             ->whereMonth('created_at', Carbon::now()->month)
//             ->whereYear('created_at', Carbon::now()->year)
//             ->sum('inc_tax');
            
//         return [
//             Stat::make('Total Penjualan', 'Rp ' . number_format($totalSales, 0, ',', '.'))
//                 ->description('Semua waktu')
//                 ->color('success'),
                
//             Stat::make('Total Dibayar', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
//                 ->description('Semua waktu')
//                 ->color('success'),
                
//             Stat::make('Total Belum Dibayar', 'Rp ' . number_format($totalUnpaid, 0, ',', '.'))
//                 ->description('Semua waktu')
//                 ->color('danger'),
                
//             Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($monthlyIncome, 0, ',', '.'))
//                 ->description(Carbon::now()->format('F Y'))
//                 ->color('info'),
//         ];
//     }
// }