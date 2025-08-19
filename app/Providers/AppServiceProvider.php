<?php

namespace App\Providers;

use App\Models\ItemOrder;
use App\Models\UnexpectedExpense;
use App\Models\Invoice;
use App\Observers\ItemOrderObserver;
use App\Observers\UnexpectedExpenseObserver;
use App\Observers\InvoiceObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ItemOrder::observe(ItemOrderObserver::class);
        UnexpectedExpense::observe(UnexpectedExpenseObserver::class);
        Invoice::observe(InvoiceObserver::class);
    }
}
