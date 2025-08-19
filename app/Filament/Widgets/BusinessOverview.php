<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Invoice;
use App\Models\Task;
use App\Models\UnexpectedExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class BusinessOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    
    protected function getStats(): array
    {
        // Total Project
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', '!=', 'Completed')->count();
        $completedProjects = Project::where('status', 'Completed')->count();
        
        // Financial Overview
        $totalRevenue = PurchaseOrder::where('type', 'In')->sum('inc_tax');
        $totalExpenses = PurchaseOrder::where('type', 'Out')->sum('inc_tax') + 
                         UnexpectedExpense::sum('amount');
        $netProfit = $totalRevenue - $totalExpenses;
        
        // Invoice Status
        $pendingInvoices = Invoice::where('status', '!=', 'Paid')->count();
        $pendingAmount = Invoice::where('status', '!=', 'Paid')->sum('remaining_balance');
        
        return [
            Stat::make('Total Proyek', $totalProjects)
                ->description($activeProjects . ' proyek aktif')
                ->descriptionIcon('heroicon-m-building-office')
                ->chart([$completedProjects, $activeProjects])
                ->color('success'),
                
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Profit: Rp ' . number_format($netProfit, 0, ',', '.'))
                ->descriptionIcon($netProfit >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([65, 35, 85, 70, 90])
                ->color($netProfit >= 0 ? 'success' : 'danger'),
                
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalExpenses, 0, ',', '.'))
                ->description('Dari ' . PurchaseOrder::where('type', 'Out')->count() . ' PO & ' . UnexpectedExpense::count() . ' pengeluaran tak terduga')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([40, 50, 30, 25, 60])
                ->color('warning'),
                
            Stat::make('Invoice Tertunda', $pendingInvoices)
                ->description('Rp ' . number_format($pendingAmount, 0, ',', '.'))
                ->descriptionIcon('heroicon-m-document-text')
                ->chart([10, 15, 20, 18, 25])
                ->color('danger'),
        ];
    }
}