<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Models\Task;
use App\Models\Category;
use App\Models\TaskStatusLog;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskUpdateStatusRequest;

class TaskController extends Controller
{   
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');

        return view('tasks.create', compact('categories', 'statuses'));
    }

    public function store(TaskStoreRequest $request)
    {
        $taskData = array_merge($request->validated(), [
            'user_id' => auth()->id(),
            'category_id' => $request->input('category')
        ]);

        Task::create($taskData);

        return redirect()->route('dashboard')
            ->with('message', 'Task created successfully.');
    }

    public function edit(Task $task)  
    {
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');
        $nextStatus = getNextStatus($task->status);

        return view('tasks.edit', compact('task', 'categories', 'statuses', 'nextStatus'));
    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
        $taskData = array_merge($request->validated(), [
            'category_id' => $request->input('category')
        ]);

        $this->taskService->update($task, $taskData);

        return redirect()->route('dashboard')
            ->with('message', 'Task updated successfully.');
    }

    public function updateStatus(Task $task, TaskUpdateStatusRequest $request)
    {
        $this->taskService->updateStatus($task, $request->validated('status'));

        return redirect()->route('dashboard')
            ->with('message', 'Task Status updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('dashboard')
            ->with('message', 'Task deleted successfully.');
    }
}
