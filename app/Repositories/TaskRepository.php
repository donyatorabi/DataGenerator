<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function findById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function toggleCompletion(Task $task): bool
    {
        $task->is_completed = !$task->is_completed;
        return $task->save();
    }
}
