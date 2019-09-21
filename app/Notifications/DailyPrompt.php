<?php

namespace App\Notifications;

use App\Notifications\BaseNotification;

class DailyPrompt extends BaseNotification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            'Don\'t forget to track your events for today!', // title
            null, // body
            [
                [ 'Track', url('/diary') ]
            ]
        );
    }
}
