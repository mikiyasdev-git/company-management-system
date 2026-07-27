<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = ['username', 'firstname', 'lastname', 'email', 'password'];
    protected $table = 'student';
    public $timestamps = false;
}
