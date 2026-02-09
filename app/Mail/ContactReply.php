<?php

namespace App\Mail;

use App\Models\ContactEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $contactEmail;
    public $replyMessage;

    public function __construct(ContactEmail $contactEmail, $replyMessage)
    {
        $this->contactEmail = $contactEmail;
        $this->replyMessage = $replyMessage;
    }

    public function build()
    {
        return $this->subject('Re: ' . $this->contactEmail->subject)
                    ->view('emails.contact-reply')
                    ->with([
                        'name' => $this->contactEmail->name,
                        'originalMessage' => $this->contactEmail->message,
                        'replyMessage' => $this->replyMessage,
                        'repliedAt' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}