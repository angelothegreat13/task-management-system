<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatusLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'change_at' => 'datetime',    
    ];
}