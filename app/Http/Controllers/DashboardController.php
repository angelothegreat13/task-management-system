<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Services\TaskService;

class DashboardController extends Controller
{   
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request->all());
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');

        return view('dashboard', compact('tasks', 'categories', 'statuses'));
    }
}
