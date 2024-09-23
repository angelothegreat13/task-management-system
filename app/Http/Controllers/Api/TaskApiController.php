<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Models\Task;
use App\Models\Category;
use App\Models\TaskStatusLog;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskUpdateStatusRequest;

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

    public function store(TaskStoreRequest $request)
    {

    }

    public function show(Task $task)
    {

    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
     
    }

    public function updateStatus(Task $task, TaskUpdateStatusRequest $request)
    {

    }

    public function destroy(Task $task)
    {

    }
}
