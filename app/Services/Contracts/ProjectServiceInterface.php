<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ProjectServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
}

