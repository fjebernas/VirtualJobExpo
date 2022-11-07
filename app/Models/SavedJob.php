<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'company',
        'job_post_id',
        'student_last_name',
        'student_id',
    ];
}
