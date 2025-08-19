<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'task_date',
        'coordinator',
        'worker_count',
        'photo',
        'status'
    ];

    protected $casts = [
        'task_date' => 'date',
        'worker_count' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}