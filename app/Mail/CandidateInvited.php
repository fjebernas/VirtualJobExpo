<?php

namespace App\Mail;

use App\Models\JobPost;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateInvited extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $job_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, JobPost $job_post)
    {
        $this->student = $student;
        $this->job_post = $job_post;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Candidate Invited',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.candidate-invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
