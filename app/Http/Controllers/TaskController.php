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

        // $this->taskService->store($taskData);

        return redirect()->route('dashboard')
            ->with('message', 'Task created successfully.');
    }

    // displays the edit task form
    public function edit()  
    {
        return 'task.edit';
    }

    public function update()
    {

    }

    public function destroy()
    {
        return 'task.destroy';
    }
}
