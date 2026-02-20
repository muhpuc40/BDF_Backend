<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Registration Received - Bangladesh Debate Federation')
                    ->view('emails.user-registration-received')
                    ->with([
                        'name' => $this->user->full_name,
                        'email' => $this->user->email,
                        'timestamp' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}