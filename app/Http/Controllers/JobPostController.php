<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\SavedJob;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * if student, return with saved jobs and  job applications
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if (Auth::check()) 
        {
            if (Auth::user()->role == 'student') 
            {
                return view('job-posts.index')
                    ->with('job_posts', JobPost::all())
                    ->with('saved_jobs', Auth::user()->student->savedJobs->pluck('job_post_id')->toArray())
                    ->with('job_applications', Auth::user()->student->jobApplications->pluck('job_post_id')->toArray());
            } 
            else if (Auth::user()->role == 'company')
            {
                return view('company.job-post.index')
                    ->with('job_posts_with_job_applications', $this->getJobPostsWithJobApplications())
                    ->with('statuses', [
                                        'Received',
                                        'Shortlisted',
                                        'Not qualified',
                                    ]);
            }
        }

        return view('job-posts.index')
            ->with('job_posts', JobPost::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('company.job-post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        JobPost::create([
            'position' => $request->position,
            'company' => Auth::user()->company->name,
            'location' => $request->location,
            'level' => $request->level,
            'employment' => $request->employment,
            'salary_range' => [
                                'low' => $request->salary_range[0],
                                'high' => $request->salary_range[1],
                            ],
            'company_id' => Auth::user()->company->id,
        ]);

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Job post created',
                'type' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPost $jobPost) 
    {
        $jobPost->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Job post deleted',
                'type' => 'success'
            ]);
    }

    /**
     *
     *
     * 
     * @return \Collection
     */
    private function getJobPostsWithJobApplications()
    {
        $job_posts_with_job_applications = collect([]);

        $job_posts = Auth::user()->company->jobPosts;
        $job_applications = Auth::user()->company->jobApplicationsReceived;

        foreach ($job_posts as $job_post)
        {
            $job_posts_with_job_applications->prepend([
                'job_post' => $job_post,
                'job_applications' => $job_applications->where('job_post_id', $job_post->id),
            ]);
        }

        return $job_posts_with_job_applications;
    }
}
