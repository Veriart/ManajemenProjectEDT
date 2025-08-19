<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdParty extends Model
{
    protected $fillable = [
    'code',
    'name',
    'alias',
    'type',
    'status',
    'vat',
    'contact',
    'telepon',
    'address',
    'website',
];
}
