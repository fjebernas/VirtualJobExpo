<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function sendInvitation(Request $request, MailService $mailService)
    {
        $mailService->sendInvitationMail($request->job_application_id);

        JobApplication::where('id', $request->job_application_id)
                    ->update([
                        'invited' => true,
                    ]);

        return redirect()->back()
            ->with('notification', [
                'message' => 'Invitation sent',
                'type' => 'success'
            ]);
    }
}
