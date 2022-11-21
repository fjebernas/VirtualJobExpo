<?php

namespace App\Http\Controllers;

use App\Mail\CandidateInvited;
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
        Mail::to($request->email)->send(new CandidateInvited);

        return redirect()->back()
            ->with('notification', [
                'message' => 'Invitation sent',
                'type' => 'success'
            ]);
    }
}
