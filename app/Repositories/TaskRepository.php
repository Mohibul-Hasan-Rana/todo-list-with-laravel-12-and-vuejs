<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    

    public function allForUser($userId)
    {
        return Task::where('user_id', $userId)->latest()->paginate(10);
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }

    public function toggle(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        return $task;
    }
   
}
