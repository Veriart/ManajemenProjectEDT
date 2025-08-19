<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'order_code',
        'pic',
        'project',
        'type',
        'third_party_id',
        'project_location',
        'status',
        'planned_date',
        'price',
        'sales_tax',
        'inc_tax',
        'discount',
        'payment_terms',
        'payment_type',
        'project_id' // Tambahkan project_id
    ];
    
    public function scopeOut($query)
    {
        return $query->where('type', 'Out');
    }
    
    public function itemOrders()
    {
        return $this->hasMany(ItemOrder::class);
    }

    public function fileOrders()
    {
        return $this->hasMany(FileOrder::class);
    }

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function deliveryOrders()
    {
        return $this->hasMany(DeliveryOrder::class);
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    protected static function booted()
    {
        static::created(function ($purchaseOrder) {
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
        });
        
        static::updated(function ($purchaseOrder) {
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
        });
        
        static::deleted(function ($purchaseOrder) {
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
        });
    }
}
