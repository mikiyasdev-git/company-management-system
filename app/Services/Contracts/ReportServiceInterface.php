<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface ReportServiceInterface
{
    /**
     * Retrieve all reports.
     */
    public function getAll();

    /**
     * Retrieve a report by ID.
     */
    public function getById(int $id);

    /**
     * Create a report.
     */
    public function create(array $data);

    /**
     * Update a report.
     */
    public function update(int $id, array $data);

    /**
     * Delete a report.
     */
    public function delete(int $id);
}
