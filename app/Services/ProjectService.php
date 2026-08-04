<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->projectRepository->all();
    }

    public function getById(int $id){
        return $this->projectRepository->find($id);
    }

    public function create(array $data)
    {
    return $this->projectRepository->create($data);
    }

    public function update(int $id, array $data)
{
    $updated = $this->projectRepository->update($id, $data);

    if (! $updated) {
        return null;
    }

    return $this->projectRepository->find($id);
}
}
