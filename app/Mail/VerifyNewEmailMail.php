<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyNewEmailMail extends Mailable
{
    public $emailChangeRequest;

    public function __construct($emailChangeRequest)
    {
        $this->emailChangeRequest = $emailChangeRequest;
    }

    public function build()
    {
        return $this->subject('Verify Your New Email Address')
            ->view('auth.verify-new-email')
            ->with([
                'url' => url('/email/verify-email-change/' . $this->emailChangeRequest->token),
            ]);
    }
}