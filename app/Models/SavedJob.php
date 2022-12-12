<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedJob extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'job_post_id',
        'student_id',
    ];

    public function jobPost()
    {
        return $this->belongsTo(
            JobPost::class
        );
    }
}
