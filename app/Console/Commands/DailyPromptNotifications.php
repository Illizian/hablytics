<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;

use App\User;
use App\DiaryTag;
use App\Notifications\DailyPrompt;

class DailyPromptNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:prompt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify all Users whom haven\'t recorded an event today.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get a list of Users who've created events today
        $tags = DiaryTag::where('at', '>', Carbon::now()->startOfDay())->pluck('created_by')->unique();

        // Get all users and remove those that appear in the list above
        $users = User::whereNotIn('id', $tags->toArray())->get();
        $count = $users->count();

        if ($count > 0) {
            // Notify them
            Notification::sendNow($users, new DailyPrompt());
        }

        // Log
        $msg = "$this->signature: Notified $count users";
        $this->info($msg);
        Log::info($msg);

    }
}
