<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function index()
    {
        return view('student.job-application.index')
            ->with('job_applications', Auth::user()->student->jobApplications)
            ->with('job_posts_applied', Auth::user()->student->jobPostsApplied);
    }

    public function create($job_post_id) 
    {
        return view('student.job-application.create')
            ->with('job_post', JobPost::where('id', $job_post_id)->firstOrFail());
    }

    public function store(Request $request, $job_post_id)
    {
        JobApplication::create([
            'pitch' => $request->pitch,
            'job_post_id' => $job_post_id,
            'student_id' => Auth::user()->student->id,
        ]);
        
        return redirect()->back()
            ->with('notification', [
                'message' => 'Job application submitted',
                'type' => 'success'
            ]
        );
    }

    public function destroy($job_application_id)
    {
        JobApplication::where('id', $job_application_id)->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Job application withdrew',
                'type' => 'success'
            ]
        );
    }
}
