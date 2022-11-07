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
        $student_id = Student::where('email', Auth::user()->email)->value('id');
        $saved_jobs = SavedJob::where('student_id', $student_id)->get();

        return view('student.saved-jobs.index')
            ->with('saved_jobs', $saved_jobs);
    }

    public function store(Request $request) 
    {
        $job_post = JobPost::where('id', $request->job_post_id)
                            ->firstOrFail();
        $student = Student::where('email', Auth::user()->email)
                            ->firstOrFail();

        SavedJob::create([
            'position' => $job_post->position,
            'company' => $job_post->company,
            'job_post_id' => $job_post->id,
            'student_last_name' => $student->last_name,
            'student_id' => $student->id,
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
