<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    /**
     * Create a new TaskRepository instance.
     */
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }
}
