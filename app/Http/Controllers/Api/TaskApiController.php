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
use App\Traits\ApiResponseTrait;

class TaskApiController extends Controller
{
    use ApiResponseTrait;

    protected $taskService;

    public function __construct(TaskService $taskService) 
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request->all());

        return $this->successResponse('Tasks retrieved successfully.', [
            'tasks' => $tasks->items(),
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'last_page' => $tasks->lastPage(),
                'per_page' => $tasks->perPage(),
                'count' => $tasks->count(), 
                'total' => $tasks->total(),
            ],
        ]);
    }

    public function store(TaskStoreRequest $request)
    {
        $taskData = array_merge($request->validated(), [
            'user_id' => auth()->id(),
            'category_id' => $request->input('category')
        ]);

        $task = $this->taskService->store($taskData);

        return $this->successResponse('Task saved successfully.', $task, 201);
    }

    public function show(Task $task)
    {
        return $this->successResponse('Task retrieved successfully', $task);
    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
        $taskData = array_merge($request->validated(), [
            'category_id' => $request->input('category')
        ]);

        $task = $this->taskService->update($task, $taskData);
        
        return $this->successResponse('Task updated successfully', $task);
    }

    public function updateStatus(Task $task, TaskUpdateStatusRequest $request)
    {
        $task = $this->taskService->updateStatus($task, $request->validated('status'));

        return $this->successResponse('Task status updated successfully', $task);
    }

    public function destroy(Task $task)
    { 
        $task->delete();

        return response()->noContent();
    }
}
