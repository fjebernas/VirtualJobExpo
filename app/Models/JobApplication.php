<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'pitch',
        'status',
        'invited',
        'job_post_id',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }

    public function jobPost()
    {
        return $this->belongsTo(
            JobPost::class
        );
    }
}
