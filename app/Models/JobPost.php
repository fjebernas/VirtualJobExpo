<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

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

    public function job_applications()
    {
        return $this->hasMany(
            JobApplication::class
        );
    }
}
