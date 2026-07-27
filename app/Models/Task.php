<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
//use App\Models\Task;


class Task extends Model
{
    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'priority',
        'status',
        'deadline',
        'completed'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function user()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
