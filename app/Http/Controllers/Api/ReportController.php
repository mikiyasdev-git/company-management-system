<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReportRequest;
use App\Http\Requests\Api\UpdateReportRequest;
use App\Http\Resources\ReportResource;
use App\Services\Contracts\ReportServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\RejectReportRequest;

class ReportController extends Controller
{
    use ApiResponse;

    protected ReportServiceInterface $reportService;

    public function __construct(
        ReportServiceInterface $reportService
    ) {
        $this->reportService = $reportService;
    }
    /**
 * Display all reports.
 */
public function index(): JsonResponse
{
    $reports = $this->reportService->getAll();

    return $this->success(
        ReportResource::collection($reports),
        'Reports retrieved successfully.'
    );
}
/**
 * Display a single report.
 */
public function show(int $id): JsonResponse
{
    $report = $this->reportService->getById($id);

    if (!$report) {
        return $this->error(
            'Report not found.',
            null,
            404
        );
    }

    return $this->success(
        new ReportResource($report),
        'Report retrieved successfully.'
    );
}
/**
 * Store a new report.
 */
public function store(
    StoreReportRequest $request
): JsonResponse
{
    $report = $this->reportService->create(
        $request->validated()
    );

    return $this->success(
        new ReportResource($report),
        'Report created successfully.',
        201
    );
}
/**
 * Update an existing report.
 */
public function update(
    UpdateReportRequest $request,
    int $id
): JsonResponse
{
    $report = $this->reportService->getById($id);

    if (!$report) {
        return $this->error(
            'Report not found.',
            null,
            404
        );
    }

    $this->reportService->update(
        $id,
        $request->validated()
    );

    $updatedReport = $this->reportService->getById($id);

    return $this->success(
        new ReportResource($updatedReport),
        'Report updated successfully.'
    );
}
/**
 * Delete a report.
 */
public function destroy(int $id): JsonResponse
{
    $deleted = $this->reportService->delete($id);

    if (!$deleted) {
        return $this->error(
            'Report not found.',
            null,
            404
        );
    }

    return $this->success(
        null,
        'Report deleted successfully.'
    );
}
/**
 * Approve a report.
 */
public function approve(int $id): JsonResponse
{
    $result = $this->reportService->approve($id);

    if ($result === null) {
        return $this->error(
            'Report not found.',
            null,
            404
        );
    }

    if ($result === false) {
        return $this->error(
            'Report has already been approved.',
            null,
            409
        );
    }

    if ($result === 'rejected') {
        return $this->error(
            'Rejected reports must be revised and resubmitted before approval.',
            null,
            409
        );
    }

    return $this->success(
        new ReportResource($result),
        'Report approved successfully.'
    );
}
/**
 * Reject a report.
 */
public function reject(
    RejectReportRequest $request,
    int $id
): JsonResponse
{
    $result = $this->reportService->reject(
        $id,
        $request->validated()['rejection_reason']
    );

    if ($result === null) {
        return $this->error(
            'Report not found.',
            null,
            404
        );
    }

    if ($result === false) {
        return $this->error(
            'Report has already been rejected.',
            null,
            409
        );
    }

    if ($result === 'approved') {
        return $this->error(
            'Approved reports cannot be rejected.',
            null,
            409
        );
    }

    return $this->success(
        new ReportResource($result),
        'Report rejected successfully.'
    );
}
}
