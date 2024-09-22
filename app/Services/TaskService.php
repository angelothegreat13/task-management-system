<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatusLog;

class TaskService
{   
    /**
     * Get the next sequential status for a task.
     * @param string $status
     * @param array $statuses
     * @return string|null 
    */
    public function getNextStatus(string $status, array $statuses)
    {
        $currentStatusIndex = array_search($status, $statuses);
    
        if ($currentStatusIndex === false) {
            return null;
        }

        $statusesLastIndex = count($statuses) - 1;

        return $currentStatusIndex < $statusesLastIndex
            ? $statuses[$currentStatusIndex + 1]
            : null;
    }

    public function store(array $taskData)
    {
        
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function updateStatus()
    {

    }

}
