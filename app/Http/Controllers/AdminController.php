<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'approved', 'admin']);
    }

    /**
     * Show the Admin Overview
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    /**
     * Update the User
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $user = User::find($request->input('user'));

        // if (empty($user)) return

        switch ($request->input('action')) {
            case 'approve':
                $user->approved = true;
                $user->save();
                break;
            case 'unapprove':
                $user->approved = false;
                $user->save();
                break;
            case 'admin':
                $user->admin = true;
                $user->save();
                break;
            case 'delete':
                $user->delete();
                break;
        }

        return back();
    }
}
