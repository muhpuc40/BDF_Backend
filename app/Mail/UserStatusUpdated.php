<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $subject = $this->user->status === 'active' 
            ? 'Your Registration has been Approved!' 
            : 'Registration Update';

        return $this->subject($subject)
                    ->view('emails.user-status-updated')
                    ->with([
                        'user' => $this->user,
                        'status' => $this->user->status,
                        'timestamp' => now()->format('F j, Y, g:i a'),
                    ]);
    }
}