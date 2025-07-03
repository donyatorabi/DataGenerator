<?php

namespace App\Http\Controllers;

use App\DTOs\StoreTaskDto;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService) {}

    public function list()
    {
        $tasks = $this->taskService->fetchTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $storeTaskDTO = new StoreTaskDTO($request->title);

        $task = $this->taskService->createTask($storeTaskDTO);

        return response()->json($task);
    }

    public function toggle(int $taskId)
    {
        $this->taskService->toggleTask($taskId);

        return response()->json(['status' => 'updated']);
    }
}
