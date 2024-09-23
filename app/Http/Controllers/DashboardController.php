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

    public function index(Request $request)
    {
        $tasksQuery = Task::with('category')->latest(); 
        $tasks = $this->applyFilters($tasksQuery, $request->all())->paginate(10);
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');

        return view('dashboard', compact('tasks', 'categories', 'statuses'));
    }
}
