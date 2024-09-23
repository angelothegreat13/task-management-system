<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatusLog;

class TaskService
{   
    public function store(array $taskData)
    {

    }

    public function update(Task $task, array $taskData)
    {
        $oldStatus = $task->status;
        $newStatus = $taskData['status'];

        if ($newStatus === 'Completed') {
            $taskData['completed_at'] = now();
        } 

        if ($oldStatus !== $newStatus) {
            TaskStatusLog::create([
                'task_id' => $task->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'changed_at' => now(), 
            ]);
            $taskData['changed_at'] = now();
        }

        return $task->update($taskData);
    }

    public function updateStatus(Task $task, string $newStatus)
    {
        return $this->update($task, ['status' => $newStatus]);
    }

    public function delete()
    {

    }
}
