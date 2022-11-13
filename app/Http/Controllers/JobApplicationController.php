<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.job-application.index')
            ->with('job_applications', Auth::user()->student->jobApplications)
            ->with('job_posts_applied', Auth::user()->student->jobPostsApplied);
    }

    /**
     * Show the form for creating a new resource.
     * this method is excluded from the resource controller in web.php, because it needs a parameter of job post id.
     * 
     * @param int $job_post_id
     * @return \Illuminate\Http\Response
     */
    public function create($job_post_id) 
    {
        return view('student.job-application.create')
            ->with('job_post', JobPost::firstWhere('id', $job_post_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JobApplication::create([
            'name' => Auth::user()->student->last_name,
            'email' => Auth::user()->email,
            'pitch' => $request->pitch,
            'job_post_id' => $request->job_post_id,
            'student_id' => Auth::user()->student->id,
        ]);
        
        return redirect('/job-posts')
            ->with('notification', [
                'message' => 'Job application submitted',
                'type' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return Response::json([
            'report' => 'Withdrew job application',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApplication $job_application)
    {
        $job_application->update([
            'status' => $request->status
        ]);

        return Response::json([
            'report' => 'success',
        ]);
    }
}
