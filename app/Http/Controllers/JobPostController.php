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
    public function index() 
    {
        // if student, return with saved jobs
        if (Auth::check()) {
            if (Auth::user()->role == 'student') 
            {
                return view('job-posts.index')
                    ->with('job_posts', JobPost::all())
                    ->with('saved_jobs_id', Auth::user()->student->jobPostsFromSavedJobs->pluck('id')->toArray());
            }
        }

        return view('job-posts.index')
            ->with('job_posts', JobPost::all());
    }

    /*
     *
     *  For company only
     * 
     */ 
    public function indexOwned() 
    {
        return view('company.job-post.index')
            ->with('job_posts', Auth::user()->company->jobPosts)
            ->with('job_applications_received', Auth::user()->company->jobApplicationsReceived);
    }

    public function create() {
        return view('company.job-post.create');
    }

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
            ]
        );
    }

    public function destroy($id) 
    {
        JobPost::where('id', $id)
                ->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Job post deleted',
                'type' => 'success'
            ]
        );
    }
}
