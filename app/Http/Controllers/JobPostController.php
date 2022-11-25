<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostStoreRequest;
use App\Models\JobPost;
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
    public function store(JobPostStoreRequest $request) 
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
