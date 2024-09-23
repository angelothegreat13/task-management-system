<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatusLog;

class TaskService
{   
    public function getTasks(array $filters = [], bool $paginate = true)
    {
        $query = Task::query()->latest()->with('category');

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if ($paginate) {
            $perPage = $filters['per_page'] ?? 10;
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function store(array $taskData)
    {
        if ($taskData['status'] == 'Completed') {
            $taskData['completed_at'] = now();
        }

        $task = Task::create($taskData);

        return $task;
    }
    
    public function getStatistics()
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

        return ($task->update($taskData)) ? $taskData : null;
    }

    public function updateStatus(Task $task, string $newStatus)
    {
        return $this->update($task, ['status' => $newStatus]);
    }

    public function delete()
    {

    }
}
