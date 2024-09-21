<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use App\Services\TaskService;

class DashboardController extends Controller
{   
    public function index()
    {
        return view('dashboard');
    }
}
