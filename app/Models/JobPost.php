<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'salary_range' => 'array',
    ];

    protected $fillable = [
        'position',
        'location',
        'level',
        'employment',
        'salary_range',
        'description',
        'company_id',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }

    public function jobApplications()
    {
        return $this->hasMany(
            JobApplication::class
        );
    }

    public function savedJobs()
    {
        return $this->hasMany(
            SavedJob::class
        );
    }
}
