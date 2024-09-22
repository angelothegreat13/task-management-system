<?php

namespace App\Rules;
use App\Models\Task;

use Illuminate\Contracts\Validation\Rule;

class NextStatus implements Rule
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function passes($attribute, $value)
    {
        $nextStatus = $this->task->getNextStatus();

        return $value === $nextStatus || $value === $this->task->status;
    }

    public function message()
    {
        return 'The status must be either the next status or the current status.';
    }
}
