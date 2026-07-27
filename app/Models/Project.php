<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];
    public $timestamps = false;

    public function tasks(){
        return $this->hasMany(Task::class);
    }

     public function reports(){
        return $this->hasMany(Report::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
