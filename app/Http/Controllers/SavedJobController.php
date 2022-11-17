<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\SavedJob;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SavedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.saved-jobs.index')
            ->with('saved_jobs', Auth::user()->student->savedJobs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        SavedJob::firstOrCreate([
            'job_post_id' => $request->job_post_id,
            'student_id' => Auth::user()->student->id,
        ]);

        return Response::json([
            'report' => 'Added to saved jobs',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $job_post_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($job_post_id) 
    {
        SavedJob::where('job_post_id', $job_post_id)
            ->where('student_id', Auth::user()->student->id)
            ->delete();

        return Response::json([
            'report' => 'Removed from saved jobs',
        ]);
    }
}
