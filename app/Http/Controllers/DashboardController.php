<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Services\TaskService;

class DashboardController extends Controller
{   
    public function index()
    {
        $tasks = Task::with('category')->latest()->paginate(5);
        $categories = Category::orderBy('title')->get();
        $statuses = config('task.status_sequence');

        return view('dashboard', compact('tasks', 'categories', 'statuses'));
    }
}
