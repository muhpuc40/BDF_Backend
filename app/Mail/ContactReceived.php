<?php

namespace App\Mail;

use App\Models\ContactEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $contactEmail;

    public function __construct(ContactEmail $contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function build()
    {
        return $this->subject('Thank you for contacting Bangladesh Debate Federation')
                    ->view('emails.contact-received')
                    ->with([
                        'name' => $this->contactEmail->name,
                        'subject' => $this->contactEmail->subject,
                        'timestamp' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}