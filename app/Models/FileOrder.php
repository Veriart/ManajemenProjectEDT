<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileOrder extends Model
{
    protected $fillable = [
        'name',
        'file',
        'purchase_order_id'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
