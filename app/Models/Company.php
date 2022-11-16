<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'industry',
        'address',
        'contact_number',
        'profile_picture_path',
        'about',
        'user_id',
    ];

    public function jobPosts() 
    {
        return $this->hasMany(
            JobPost::class
        );
    }

    public function jobApplicationsReceived()
    {
        return $this->hasManyThrough(
            JobApplication::class, JobPost::class
        );
    }
}
