<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Services\Contracts\ProjectServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\StoreProjectRequest;
use App\Http\Requests\Api\UpdateProjectRequest;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(
        private ProjectServiceInterface $projectService
    ) {
    }

    public function index(): JsonResponse
    {
        $projects = $this->projectService->getAll();

        return $this->success(
            ProjectResource::collection($projects),
            'Projects retrieved successfully.'
        );
    }
    public function show(int $id): JsonResponse
{
    $project = $this->projectService->getById($id);

    if (!$project) {
        return $this->error(
            'Project not found.',
            null,
            404
        );
    }

    return $this->success(
        new ProjectResource($project),
        'Project retrieved successfully.'
    );
}

public function store(StoreProjectRequest $request): JsonResponse
{
    $project = $this->projectService
        ->create($request->validated());

    return $this->success(
        new ProjectResource($project),
        'Project created successfully.',
        201
    );
}

public function update(
    UpdateProjectRequest $request,
    int $id
): JsonResponse
{
    $project = $this->projectService->update(
        $id,
        $request->validated()
    );

    if (! $project) {
        return $this->error(
            'Project not found.',
            null,
            404
        );
    }

    return $this->success(
        new ProjectResource($project),
        'Project updated successfully.'
    );
}
}
