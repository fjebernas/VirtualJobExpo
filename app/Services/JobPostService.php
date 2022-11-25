<?php

namespace App\Services;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostService 
{
     /**
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Collection $job_posts
     */
    public function getFilteredJobPosts(Request $request)
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
    public function getOldKeywords(Request $request)
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