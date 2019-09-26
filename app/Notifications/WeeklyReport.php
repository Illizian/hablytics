<?php

namespace App\Notifications;

use App\Notifications\BaseNotification;

class WeeklyReport extends BaseNotification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            'Your weekly report is ready! Ready to see how well you did last week?', // title
            null, // body
            [
                [ 'See your report', url('/user/reports/weekly') ]
            ]
        );
    }
}
