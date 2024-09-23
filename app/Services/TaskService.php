<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatusLog;

class TaskService
{   
    public function getTaskStatistics($userId)
    {
        $statusSequence = config('task.status_sequence');
        $taskCounts = array_fill_keys($statusSequence, 0);
        $tasks = Task::where('user_id', $userId)
            ->select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        foreach ($tasks as $task) {
            $taskCounts[$task->status] = $task->count;
        }

        return $taskCounts;
    }

    public function store(array $taskData)
    {
        if ($taskData['status'] == 'Completed') {
            $taskData['completed_at'] = now();
        }

        $task = Task::create($taskData);

        return $task;
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
}
