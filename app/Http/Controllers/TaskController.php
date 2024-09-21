<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{   
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store()
    {

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
