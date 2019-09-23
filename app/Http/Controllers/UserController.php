<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Requests\UpdateUserSubscriptionRequest;
use App\Notifications\DailyPrompt;
use App\User;
use App\DiaryTag;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Update the User's Push Subscription
     *
     * @param \App\Http\Requests\UpdateUserSubscriptionRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateSubscription(UpdateUserSubscriptionRequest $request)
    {
        $endpoint = $request->input('endpoint');
        $key = $request->input('key');
        $token = $request->input('token');
        $contentEncoding = $request->input('contentEncoding');

        $request->user()->updatePushSubscription($endpoint, $key, $token, $contentEncoding);

        return response()->json(null, 204);
    }

    /**
     * Test a User's Push Subscription
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function testSubscription(Request $request)
    {
        $user = $request->user();
        // Check is user has requested the notification be sent to
        // another user
        if ($request->filled('user')) {
            // Check current user has admin priviledges
            if (!$user->admin) return response()->json(null, 401);
            $user = User::find($request->input('user'));
        }
        // Check we still have a valid user
        if (!$user) return response()->json(null, 404);

        // Send the selected user a DailyPrompt notification
        $user->notify(new DailyPrompt);

        return "Push Dispatched!";
    }

    /**
     * View User's Weekly Report
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reportsWeekly(Request $request)
    {
        // Get the date range for this Report
        $to = Carbon::parse('last Sunday');
        $from = $to->copy()->subWeek(1);

        // Get events from DiaryTag Model
        $diary_ids = $request->user()->diaries()->get()->pluck('id');
        $events = DiaryTag::where([
            [ 'at', '>=', $from ],
            [ 'at', '<=', $to ]
        ])->whereIn('diary_id', $diary_ids)->get();

        // Get Achievements
        $achievements = $request->user()->achievements()->where([
            [ 'unlocked_at', '>=', $from ],
            [ 'unlocked_at', '<=', $to ]
        ])->get();

        // Sumarise the $events
        $chart = $events->groupBy('tag.name')->groupToMeta()->metaToPieChart();

        // Get the largest tag (by value)
        $largest = $events->sortByDesc('value')->first();

        return view('user.reports.weekly', compact('to', 'from', 'events', 'largest', 'achievements', 'chart'));
    }
}
