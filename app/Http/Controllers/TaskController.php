<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\Category;

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
        $nextStatus = $this->taskService->getNextStatus($task->status, $statuses);

        return view('tasks.edit', compact('task', 'categories', 'statuses', 'nextStatus'));
    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
        return $request;
    }

    public function destroy()
    {
        return 'task.destroy';
    }

}
