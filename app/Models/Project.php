<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';


    protected $fillable = [
        'student_id', 'name', 'description', 'duration'
    ];

    public $timestamps = false;
}
