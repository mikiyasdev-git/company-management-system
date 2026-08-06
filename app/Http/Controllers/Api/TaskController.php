<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Services\Contracts\TaskServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;


class TaskController extends Controller
{
    use ApiResponse;

    /**
     * Task Service instance.
     */
    protected TaskServiceInterface $taskService;

    /**
     * Create a new TaskController instance.
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

          /**
     * Display all tasks.
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAll();

        return $this->success(
            TaskResource::collection($tasks),
            'Tasks retrieved successfully.'
        );
    }

        /**
     * Display a specific task.
     */
    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->getById($id);

        if (!$task) {
            return $this->error(
                'Task not found.',
                null,
                404
            );
        }

        return $this->success(
            new TaskResource($task),
            'Task retrieved successfully.'
        );
    }
        /**
     * Store a newly created task.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create(
            $request->validated()
        );

        return $this->success(
            new TaskResource($task),
            'Task created successfully.',
            201
        );
    }
        /**
     * Update the specified task.
     */
    public function update(
        UpdateTaskRequest $request,
        int $id
    ): JsonResponse
    {
        $task = $this->taskService->getById($id);

        if (!$task) {
            return $this->error(
                'Task not found.',
                null,
                404
            );
        }

        $this->taskService->update(
            $id,
            $request->validated()
        );

        $updatedTask = $this->taskService->getById($id);

        return $this->success(
            new TaskResource($updatedTask),
            'Task updated successfully.'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->taskService->delete($id);
        if (! $deleted) {
            return $this->error(
                'Task not found.', null, 404
            );
        }
        return $this->success(
            null, 'Task deleted successfully.'
        );
    }
}
