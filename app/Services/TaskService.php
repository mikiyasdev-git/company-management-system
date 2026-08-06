<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Services\Contracts\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    /**
     * Task Repository instance.
     */
    protected TaskRepositoryInterface $taskRepository;

    /**
     * Create a new TaskService instance.
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Retrieve all tasks.
     */
    public function getAll()
    {
        return $this->taskRepository->all();
    }

    /**
     * Retrieve a task by ID.
     */
    public function getById(int $id)
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Create a new task.
     */
    public function create(array $data)
    {
        return $this->taskRepository->create($data);
    }

    /**
     * Update an existing task.
     */
    public function update(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * Delete a task.
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }
}
