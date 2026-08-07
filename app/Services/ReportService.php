<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Services\Contracts\ReportServiceInterface;
use Illuminate\Support\Facades\Auth;

class ReportService implements ReportServiceInterface
{
    protected ReportRepositoryInterface $reportRepository;

    public function __construct(
        ReportRepositoryInterface $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
    }

    /**
     * Get all reports.
     */
    public function getAll()
    {
        return $this->reportRepository->all();
    }

    /**
     * Get report by ID.
     */
    public function getById(int $id)
    {
        return $this->reportRepository->find($id);
    }

    /**
     * Create report.
     */
     public function create(array $data)
{
    $data['user_id'] = Auth::user()->id;

    $data['status'] = 'submitted';

    return $this->reportRepository->create($data);
}

    /**
     * Update report.
     */
    public function update(int $id, array $data)
    {
        return $this->reportRepository->update($id, $data);
    }

    /**
     * Delete report.
     */
    public function delete(int $id)
    {
        return $this->reportRepository->delete($id);
    }

   /**
 * Approve a report.
 */
public function approve(int $id)
{
    $report = $this->reportRepository->find($id);

    if (! $report) {
        return null;
    }

    // Cannot approve twice
    if ($report->status === 'approved') {
        return false;
    }

    // Cannot approve a rejected report
    if ($report->status === 'rejected') {
        return 'rejected';
    }

    $report->update([
        'status' => 'approved',
        'approved_by' => Auth::id(),
        'approved_at' => now(),
        'rejection_reason' => null,
    ]);

    return $report->fresh();
}
public function reject(int $id, string $reason)
{
    $report = $this->reportRepository->find($id);

    if (! $report) {
        return null;
    }

    // Already rejected
    if ($report->status === 'rejected') {
        return false;
    }

    // Already approved
    if ($report->status === 'approved') {
        return 'approved';
    }

    $report->update([
        'status' => 'rejected',
        'approved_by' => Auth::id(),
        'approved_at' => now(),
        'rejection_reason' => $reason,
    ]);

    return $report->fresh();
}
}
