<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\SavedJob;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function index()
    {
        $saved_jobs_reference = SavedJob::where('user_id', Auth::user()->id)->pluck('job_post_id')->toArray();
        $saved_jobs = JobPost::whereIn('id', $saved_jobs_reference)->get();

        return view('student.saved-jobs.index')
            ->with('saved_jobs', $saved_jobs);
    }

    public function store(Request $request) 
    {
        $job_post = JobPost::where('id', $request->job_post_id)
                            ->firstOrFail();

        SavedJob::create([
            'job_post_id' => $job_post->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()
            ->with('notification', [
                'message' => 'Job saved successfully',
                'type' => 'success'
            ]
        );
    }

    public function destroy($job_post_id) 
    {
        SavedJob::where('job_post_id', $job_post_id)
                ->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Removed from saved jobs',
                'type' => 'success'
            ]
        );
    }
}
