<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateUserSubscriptionRequest;
use App\Notifications\DailyPrompt;

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
        // Check current user has admin priviledges
        if (!$user->admin) return response()->json(null, 401);
        // Check is user has requested the notification be sent to
        // another user
        if ($request->filled('user')) {
            $user = User::find($request->input);
        }
        // Check we still have a valid user
        if (!$user) return response()->json(null, 404);

        // Send the selected user a DailyPrompt notification
        $user->notify(new DailyPrompt);

        return response()->json(null, 204);
    }
}
