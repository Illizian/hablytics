<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UpdateUserRequest;

class UserProfileController extends Controller
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
     * Show the User's Profile page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', [
            'user' => $user
        ]);
    }

    /**
     * Update the User
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $route = 'profile.index';

        switch ($request->input('action')) {
            case 'password':
                $user->fill([
                    'password' => Hash::make($request->input('password'))
                ])->save();
            case 'reset':
                $user->achievements()->delete();
                break;
            case 'suspend':
                $user->delete();
                Auth::logout();
                $route = 'home';
                break;
            case 'delete':
                $user->forceDelete();
                Auth::logout();
                $route = 'home';
                break;
        }

        return redirect()->route($route);
    }
}
