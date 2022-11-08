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
        return view('student.saved-jobs.index')
            ->with('saved_jobs', Auth::user()->student->savedJobs);
    }

    public function store(Request $request) 
    {
        SavedJob::firstOrCreate([
            'job_post_id' => $request->job_post_id,
            'student_id' => Auth::user()->student->id,
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
                ->where('student_id', Auth::user()->student->id)
                ->delete();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Removed from saved jobs',
                'type' => 'success'
            ]
        );
    }
}
