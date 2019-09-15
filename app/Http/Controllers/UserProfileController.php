<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Remove the User
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function remove()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();

        return redirect()->route('home');
    }
}
