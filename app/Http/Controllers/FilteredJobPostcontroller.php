<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilteredJobPostcontroller extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * Display a listing of the resource with filters.
     * if student, return with saved jobs and  job applications
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $job_posts = $this->filterJobPosts($request);
        $old_keywords = $this->getOldKeywords($request);

        if (Auth::check()) 
        {
            if (Auth::user()->role == 'student') 
            {
                return view('job-posts.index')
                    ->with('job_posts', $job_posts->orderBy('created_at', 'desc')
                                                ->paginate(6))
                    ->with('saved_jobs', Auth::user()->student->savedJobs->pluck('job_post_id')->toArray())
                    ->with('job_applications', Auth::user()->student->jobApplications->pluck('job_post_id')->toArray())
                    ->with('old_keywords', $old_keywords);
            }
        }

        return view('job-posts.index')
            ->with('job_posts', $job_posts->orderBy('created_at', 'desc')
                                        ->paginate(6))
            ->with('old_keywords', $old_keywords); 
    }

    /**
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Collection $job_posts
     */
    private function filterJobPosts(Request $request)
    {
        $job_posts = JobPost::where('position', 'like', '%' . $request->keyword_position . '%')
                            ->whereHas('company', function($company) use ($request) 
                                                {
                                                    $company->where('name', 'like', '%' . $request->keyword_company . '%');
                                                })
                            ->where('level', 'like', '%' . $request->level . '%')
                            ->where('employment', 'like', '%' . $request->employment . '%')
                            ->where('salary_range->low', '>=', $request->salary_range);

        return $job_posts;
    }

    /**
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array $old_keywords
     */
    private function getOldKeywords(Request $request)
    {
        $old_keywords = [
            'position' => $request->keyword_position,
            'company' => $request->keyword_company,
            'job_level' => $request->level,
            'employment' => $request->employment,
            'salary_range' => $request->salary_range,
        ];

        return $old_keywords;
    }
}
