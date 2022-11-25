<?php

namespace App\Http\Controllers;

use App\Services\JobPostService;
use Illuminate\Http\Request;

class FilteredJobPostController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * Display a listing of the resource with filters.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, JobPostService $jobPostService)
    {
        return view('job-posts.index')
            ->with('job_posts', $jobPostService->getFilteredJobPosts($request)
                                            ->orderBy('created_at', 'desc')
                                            ->paginate(6))
            ->with('old_keywords', $jobPostService->getOldKeywords($request)); 
    }
}
