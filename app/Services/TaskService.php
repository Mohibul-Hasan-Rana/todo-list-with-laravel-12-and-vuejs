<?php

namespace App\Services;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllForUser($userId)
    {
        return $this->taskRepository->allForUser($userId);
    }

    public function store(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function update(Task $task, array $data)
    {
        return $this->taskRepository->update($task, $data);
    }

    public function delete(Task $task)
    {
        return $this->taskRepository->delete($task);
    }
}
