<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TaskService;

class TaskController extends Controller
{   
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create()
    {

    }

    public function store()
    {

    }

    // displays the edit task form
    public function edit()  
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
