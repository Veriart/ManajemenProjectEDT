<?php

namespace App\Observers;

use App\Models\ItemOrder;
use App\Models\PurchaseOrder;
use App\Models\Project;

class ItemOrderObserver
{
    /**
     * Handle the ItemOrder "created" event.
     */
    public function created(ItemOrder $itemOrder): void
    {
        $this->updatePurchaseOrderPrice($itemOrder);
    }

    /**
     * Handle the ItemOrder "updated" event.
     */
    public function updated(ItemOrder $itemOrder): void
    {
        $this->updatePurchaseOrderPrice($itemOrder);
    }

    /**
     * Handle the ItemOrder "deleted" event.
     */
    public function deleted(ItemOrder $itemOrder): void
    {
        $this->updatePurchaseOrderPrice($itemOrder);
    }

    /**
     * Update the purchase order price based on item orders
     */
    private function updatePurchaseOrderPrice(ItemOrder $itemOrder): void
    {
        $purchaseOrder = $itemOrder->purchaseOrder;

        if ($purchaseOrder) {
            // Hitung total price dari semua item order
            $totalPrice = $purchaseOrder->itemOrders()->sum('total');

            // Ambil discount dan sales_tax dari purchase order
            $discount  = $purchaseOrder->discount ?? 0;
            $salesTax  = $purchaseOrder->sales_tax ?? 0;

            // Hitung subtotal setelah diskon
            $subtotal = max($totalPrice - $discount, 0);

            // Hitung tax (dari persentase sales_tax)
            $tax = $subtotal * ($salesTax / 100);

            // Hitung final include tax
            $incTax = $subtotal + $tax;

            // Update field di purchase order
            $purchaseOrder->update([
                'price'    => $totalPrice,
                'inc_tax'  => $incTax,
            ]);

            // Update project calculations jika ada
            if ($purchaseOrder->project_id) {
                $project = Project::find($purchaseOrder->project_id);
                if ($project) {
                    if ($purchaseOrder->type === 'In') {
                        $project->calculateCost();
                    } else {
                        $project->calculateExpenses();
                    }
                }
            }
        }
    }
}
