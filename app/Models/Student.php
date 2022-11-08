<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender',
        'university',
        'email',
        'contact_number',
        'user_id',
    ];

    public function savedJobs() 
    {
        return $this->belongsToMany(
            JobPost::class, 'saved_jobs'
        );
    }

    public function jobApplications()
    {
        return $this->hasMany(
            JobApplication::class
        );
    }

    public function jobPostsApplied()
    {
        return $this->belongsToMany(
            JobPost::class, 'job_applications'
        );
    }
}
