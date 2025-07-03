<?php

namespace App\Services;

namespace App\Services;

use App\DTOs\StoreTaskDto;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function __construct(private RabbitMQService $rabbitMQ, private TaskRepository $taskRepository) {}

    public function fetchTasks(): Collection
    {
        return Auth::user()->tasks()->latest()->get();
    }

    public function createTask(StoreTaskDto $storeTaskDto): Task
    {
        $task = Auth::user()->tasks()->create(['title' => $storeTaskDto->getTitle()]);

        $this->rabbitMQ->publish([
            'id' => $task->id,
            'user_id' => $task->user_id,
            'is_completed' => $task->is_completed,
            'timestamp' => now()->toDateTimeString()
        ]);

        return $task;
    }

    public function toggleTask(int $taskId): void
    {
        $task = $this->taskRepository->findById($taskId);

        $this->taskValidation($task);

        $this->taskRepository->toggleCompletion($task);

        $this->rabbitMQ->publish([
            'id' => $task->id,
            'user_id' => $task->user_id,
            'is_completed' => $task->is_completed,
            'timestamp' => now()->toDateTimeString()
        ]);
    }

    /**
     * @param Task|null $task
     * @return void
     */
    private function taskValidation(?Task $task): void
    {
        if (!$task) {
            abort(404, 'Task not found.');
        }

        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized.');
        }
    }
}
