<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnexpectedExpense extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'expense_date',
        'amount',
        'receipt'
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}