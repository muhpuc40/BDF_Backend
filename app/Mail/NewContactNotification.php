<?php

namespace App\Mail;

use App\Models\ContactEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactEmail;

    public function __construct(ContactEmail $contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission - ' . $this->contactEmail->subject)
                    ->view('emails.new-contact-notification')
                    ->with([
                        'contactEmail' => $this->contactEmail,
                        'timestamp' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}