<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\SavedJob;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        return view('job-posts.index')
            ->with('job_posts', JobPost::orderBy('created_at', 'desc')
                                        ->paginate(6));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost $job_post
     * @return \Illuminate\Http\Response
     */
    public function show(JobPost $job_post) 
    {
        return view('job-posts.show')
            ->with('job_post', $job_post);
    }

    /**
     * Display a listing of the resource.
     * Exclusive only for companies.
     * 
     * @return \Illuminate\Http\Response
     */
    public function companyOwnedIndex()
    {
        return view('company.job-post.index')
                    ->with('job_posts', Auth::user()->company->jobPosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
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
        $validated = $request->validate([
            'position' => ['required'],
            'location' => ['required'],
            'level' => ['required', Rule::in(['entry-level',
                                                'intermediate',
                                                'senior',
                                                'internship',])],
            'employment' => ['required', Rule::in(['full-time',
                                                    'part-time',])],
            'salary_range' => ['nullable'],
            'description' => ['nullable'],
        ]);

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
            'description' => $request->description,
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
    public function destroy(JobPost $job_post) 
    {
        $job_post->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Job post deleted',
                'type' => 'success'
            ]);
    }
}
