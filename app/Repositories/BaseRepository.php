<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Retrieve all records.
     */
    public function all(): Collection
    {
        return $this->model->all();
    }


    /**
     * Find record by ID.
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }


    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    /**
     * Update an existing record.
     */
    public function update(int $id, array $data): bool
    {
        $record = $this->find($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }


    /**
     * Delete a record.
     */
    public function delete(int $id): bool
    {
        $record = $this->find($id);

        if (!$record) {
            return false;
        }

        return $record->delete();
    }
}
