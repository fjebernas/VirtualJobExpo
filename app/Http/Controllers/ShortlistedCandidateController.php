<?php

namespace App\Http\Controllers;

use App\Mail\CandidateInvited;
use App\Models\JobApplication;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ShortlistedCandidateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.shortlisted-candidates.index')
            ->with('job_applications', Auth::user()->company->jobApplicationsReceived
                                                            ->where('status', 'Shortlisted')
                                                            ->all());
    }

    public function sendInvitation(Request $request)
    {
        $job_application = JobApplication::firstWhere('id', $request->job_application_id);
        $job_post = $job_application->jobPost;
        $company = $job_application->jobPost->company;
        $student = $job_application->student;
        

        Mail::to($student->user->email)
            ->send(new CandidateInvited($student, $job_post));

        return redirect()->back()
            ->with('notification', [
                'message' => 'Invitation sent',
                'type' => 'success'
            ]);
    }
}
