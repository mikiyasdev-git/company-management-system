<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    protected $fillable = ['report_id', 'original_name', 'file_path', 'mime_type', 'size'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
