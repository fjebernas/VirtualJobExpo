<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'pitch',
        'status',
        'job_post_id',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    public function job_post()
    {
        return $this->belongsTo(
            JobPost::class
        );
    }
}
