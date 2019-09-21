<?php

namespace App\Notifications;

use App\Notifications\BaseNotification;
use App\User;

class UserRegistered extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(App $user)
    {
        $body = "${ $user->name } has registered.".

        if (! $user->approved) {
            $body .= ' They require approval, please visit the admin area.';
        }

        parent::__construct(
            'A New User Registered!', // title
            $body
        );
    }
}
