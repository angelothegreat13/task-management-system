<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\TaskService;

class NextStatus implements Rule
{
    protected $currentStatus;

    public function __construct($currentStatus)
    {
        $this->currentStatus = $currentStatus;
    }

    public function passes($attribute, $value)
    {
        $nextStatus = app(TaskService::class)->getNextStatus($this->currentStatus, config('task.status_sequence'));

        return $value === $nextStatus || $value === $this->currentStatus;
    }

    public function message()
    {
        return 'The status must be either the next status or the current status.';
    }
}
