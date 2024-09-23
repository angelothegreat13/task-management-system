<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskApiController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) 
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tasks retrieved successfully.',
            'data' => [
                'tasks' => $tasks->items(),
                'pagination' => [
                    'current_page' => $tasks->currentPage(),
                    'last_page' => $tasks->lastPage(),
                    'per_page' => $tasks->perPage(),
                    'count' => $tasks->count(), 
                    'total' => $tasks->total(),
                ],
            ],
        ]);
    }

    // POST /api/tasks
    public function store()
    {

    }

    //  GET /api/tasks/{id}
    public function show()
    {

    }

    // PUT /api/tasks/{id}
    public function update()
    {
     
    }

    // DELETE /api/tasks/{id}
    public function destroy()
    {

    }

    // POST /api/tasks/{id}/update-status
    public function updateStatus()
    {

    }
}
