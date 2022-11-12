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
        'company',
        'location',
        'level',
        'employment',
        'salary_range',
        'company_id',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function jobApplications()
    {
        return $this->hasMany(
            JobApplication::class
        );
    }
}
