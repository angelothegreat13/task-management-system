<?php

namespace App\Rules;
use App\Models\Task;

use Illuminate\Contracts\Validation\Rule;

class NextStatus implements Rule
{
    protected $currentStatus;

    public function __construct($currentStatus)
    {
        $this->currentStatus = $currentStatus;
    }

    public function passes($attribute, $value)
    {
        $nextStatus = getNextStatus($this->currentStatus);

        return $value === $nextStatus || $value === $this->currentStatus;
    }

    public function message()
    {
        return 'The status must be either the next status or the current status.';
    }
}
