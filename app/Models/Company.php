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
        'about',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

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
