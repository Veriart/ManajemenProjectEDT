<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'code',
        'name', 
        'amount_paid',
        'purchase_order_id',
        'status',
        'description',
        'remaining_balance',
        'created_at'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
