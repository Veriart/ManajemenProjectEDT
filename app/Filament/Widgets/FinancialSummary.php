<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FinancialSummary extends ChartWidget
{
    protected static ?string $heading = 'Ringkasan Keuangan';
    protected static ?int $sort = 3;
    
    protected function getData(): array
    {
        // Data untuk 6 bulan terakhir
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('M Y'));
        }
        
        // Revenue data (PO In)
        $revenueData = [];
        // Expenses data (PO Out + Unexpected Expenses)
        $expensesData = [];
        // Profit data
        $profitData = [];
        
        foreach ($months as $index => $month) {
            $startDate = Carbon::now()->subMonths(5 - $index)->startOfMonth();
            $endDate = Carbon::now()->subMonths(5 - $index)->endOfMonth();
            
            $revenue = PurchaseOrder::where('type', 'In')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('inc_tax');
                
            $expenses = PurchaseOrder::where('type', 'Out')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('inc_tax');
                
            $revenueData[] = $revenue;
            $expensesData[] = $expenses;
            $profitData[] = $revenue - $expenses;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $revenueData,
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#10B981',
                    'fill' => false,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $expensesData,
                    'backgroundColor' => '#F59E0B',
                    'borderColor' => '#F59E0B',
                    'fill' => false,
                ],
                [
                    'label' => 'Profit',
                    'data' => $profitData,
                    'backgroundColor' => '#4F46E5',
                    'borderColor' => '#4F46E5',
                    'fill' => false,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
}