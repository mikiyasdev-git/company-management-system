<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user_id' => $this->user_id,

            'project_id' => $this->project_id,

            'task_id' => $this->task_id,

            'title' => $this->title,

            'description' => $this->description,

            'status' => $this->status,

            'report_date' => $this->report_date,

            'approved_by' => $this->approved_by,

            'approved_at' => $this->approved_at,

            'rejection_reason' => $this->rejection_reason,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
