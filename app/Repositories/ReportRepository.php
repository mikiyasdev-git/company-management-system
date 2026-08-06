<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Report;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function __construct(Report $report)
    {
        parent::__construct($report);
    }
}
