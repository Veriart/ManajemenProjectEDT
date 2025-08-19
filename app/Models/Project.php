<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Get the third party associated with the project.
     */
    protected $fillable = [
        'code',
        'name',
        'project_location',
        'third_party_id',
        'planned_date',
        'start_date', 
        'end_date',
        'status',
        'cost',
        'remaining_invoice',
        'expenses',
        'net_cost',
        'description'
    ];

    protected $casts = [
        'status' => 'string',
        'planned_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'cost' => 'integer',
        'remaining_invoice' => 'integer', 
        'expenses' => 'integer',
        'net_cost' => 'integer'
    ];
    
    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }
    
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    
    public function purchaseOrdersIn()
    {
        return $this->hasMany(PurchaseOrder::class)->where('type', 'In');
    }
    
    public function purchaseOrdersOut()
    {
        return $this->hasMany(PurchaseOrder::class)->where('type', 'Out');
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function unexpectedExpenses()
    {
        return $this->hasMany(UnexpectedExpense::class);
    }
    
    /**
     * Calculate total cost from purchase orders in
     */
    public function calculateCost()
    {
        $totalCost = $this->purchaseOrdersIn()
            ->with('itemOrders')
            ->get()
            ->sum(function ($po) {
                return $po->itemOrders->sum('total');
            });
            
        $this->update(['cost' => $totalCost]);
        $this->calculateNetCost();
        $this->calculateRemainingInvoice();
        
        return $totalCost;
    }
    
    /**
     * Calculate total expenses from purchase orders out and unexpected expenses
     */
    public function calculateExpenses()
    {
        $poOutTotal = $this->purchaseOrdersOut()
            ->with('itemOrders')
            ->get()
            ->sum(function ($po) {
                return $po->itemOrders->sum('total');
            });
            
        $unexpectedTotal = $this->unexpectedExpenses()->sum('amount');
        $totalExpenses = $poOutTotal + $unexpectedTotal;
        
        $this->update(['expenses' => $totalExpenses]);
        $this->calculateNetCost();
        
        return $totalExpenses;
    }
    
    /**
     * Calculate net cost (cost - expenses)
     */
    public function calculateNetCost()
    {
        $netCost = $this->cost - $this->expenses;
        $this->update(['net_cost' => $netCost]);
        
        return $netCost;
    }
    
    /**
     * Calculate remaining invoice (cost - total paid invoices)
     */
    public function calculateRemainingInvoice()
    {
        $totalPaid = $this->purchaseOrdersIn()
            ->with('invoices')
            ->get()
            ->flatMap->invoices
            ->where('status', 'Paid')
            ->sum('amount_paid');
            
        $remainingInvoice = $this->cost - $totalPaid;
        $this->update(['remaining_invoice' => $remainingInvoice]);
        
        return $remainingInvoice;
    }
}
