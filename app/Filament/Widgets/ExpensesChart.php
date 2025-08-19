<?php

namespace App\Filament\Widgets;

use App\Models\PurchaseOrder;
use App\Models\UnexpectedExpense;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ExpensesChart extends ChartWidget
{
    protected static ?string $heading = 'Pengeluaran';
    protected static ?int $sort = 5;
    
    protected function getData(): array
    {
        // Data untuk 6 bulan terakhir
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('M Y'));
        }
        
        // PO Out expenses
        $poOutData = [];
        // Unexpected expenses
        $unexpectedData = [];
        
        foreach ($months as $index => $month) {
            $startDate = Carbon::now()->subMonths(5 - $index)->startOfMonth();
            $endDate = Carbon::now()->subMonths(5 - $index)->endOfMonth();
            
            $poOut = PurchaseOrder::where('type', 'Out')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('inc_tax');
                
            $unexpected = UnexpectedExpense::whereBetween('expense_date', [$startDate, $endDate])
                ->sum('amount');
                
            $poOutData[] = $poOut;
            $unexpectedData[] = $unexpected;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'PO Keluar',
                    'data' => $poOutData,
                    'backgroundColor' => '#F59E0B',
                ],
                [
                    'label' => 'Pengeluaran Tak Terduga',
                    'data' => $unexpectedData,
                    'backgroundColor' => '#EF4444',
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