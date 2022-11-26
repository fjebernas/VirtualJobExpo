<?php

namespace App\Services;

use App\Mail\CandidateInvited;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Mail;

class MailService 
{
    /**
     * 
     * 
     * @param  int $job_application_id
     * @return void
     */
    public function sendInvitationMail($job_application_id)
    {
        $job_application = JobApplication::firstWhere('id', $job_application_id);

        Mail::to($job_application->student->user->email)
            ->send(new CandidateInvited($job_application->student, $job_application->jobPost));
    }
}