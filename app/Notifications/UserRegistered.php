<?php

namespace App\Notifications;

use App\Notifications\BaseNotification;
use App\User;

class UserRegistered extends BaseNotification
{
    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $body = $user->name . " has registered.";

        if (! $user->approved) {
            $body .= ' They require approval, please visit the admin area.';
        }

        parent::__construct(
            'A New User Registered!', // title
            $body
        );
    }
}
