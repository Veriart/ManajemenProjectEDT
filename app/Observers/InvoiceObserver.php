<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        $this->updateProjectRemainingInvoice($invoice);
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        $this->updateProjectRemainingInvoice($invoice);
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        $this->updateProjectRemainingInvoice($invoice);
    }

    /**
     * Update the project remaining invoice
     */
    private function updateProjectRemainingInvoice(Invoice $invoice): void
    {
        $purchaseOrder = $invoice->purchaseOrder;
        if ($purchaseOrder && $purchaseOrder->project_id && $purchaseOrder->type === 'In') {
            $project = $purchaseOrder->project;
            if ($project) {
                $project->calculateRemainingInvoice();
            }
        }
    }
}