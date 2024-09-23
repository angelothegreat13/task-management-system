<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Services\TaskService;
use App\Traits\FilterableTrait;

class DashboardController extends Controller
{   
    use FilterableTrait;

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasksQuery = Task::with('category')
            ->latest()
            ->where('user_id', auth()->id()); 
        $tasks = $this->applyFilters($tasksQuery, $request->all())->paginate(10);

        $statistics = $this->taskService->getTaskStatistics(auth()->id());
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');

        return view('dashboard', compact('tasks', 'categories', 'statuses', 'statistics'));
    }
}
