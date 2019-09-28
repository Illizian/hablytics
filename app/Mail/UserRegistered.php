<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The App\User that has registered
     *
     * @var \App\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New User Registration')
                    ->view('emails.user.registered');
    }
}
