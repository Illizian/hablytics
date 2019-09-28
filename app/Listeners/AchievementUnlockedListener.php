<?php

namespace App\Listeners;

use Gstt\Achievements\Event\Unlocked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AchievementUnlockedListener
{
    /**
     * The Request, used to flash achievement messages
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Gstt\Achievements\Event\Unlocked  $event
     * @return void
     */
    public function handle(Unlocked $event)
    {
        $this->request->session()->flash('achievement', $event->progress->details()->first());
    }
}
