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
            $totalPrice = $purchaseOrder->itemOrders()->sum('total');
            $purchaseOrder->update(['price' => $totalPrice]);
            
            // Update project calculations if this PO is linked to a project
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