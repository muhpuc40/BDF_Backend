<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('New User Registration - ' . $this->user->full_name)
                    ->view('emails.new-user-notification')
                    ->with([
                        'user' => $this->user,
                        'timestamp' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}