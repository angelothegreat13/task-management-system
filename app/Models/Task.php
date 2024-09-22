<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'completed_at' => 'datetime', 
        'change_at' => 'datetime',    
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the next sequential status for the task.
     *
     * @return string|null
     */
    public function getNextStatus()
    {
        $statuses = config('task.status_sequence');
        $currentStatusIndex = array_search($this->status, $statuses);
        $statusesLastIndex = count($statuses) - 1;

        return $currentStatusIndex !== false && $currentStatusIndex < $statusesLastIndex
            ? $statuses[$currentStatusIndex + 1]
            : null;
    }
}
