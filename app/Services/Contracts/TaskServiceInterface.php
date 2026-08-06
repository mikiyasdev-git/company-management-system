<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface TaskServiceInterface
{
    /**
     * Retrieve all tasks.
     */
    public function getAll();

    /**
     * Retrieve a task by ID.
     */
    public function getById(int $id);

    /**
     * Create a new task.
     */
    public function create(array $data);

    /**
     * Update an existing task.
     */
    public function update(int $id, array $data);

    /**
     * Delete a task.
     */
    public function delete(int $id): bool;
}
