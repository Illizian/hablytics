<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Tag;
use App\DiaryTag;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    public function index()
    {
        $user = Auth::user();

        return view('tags.index', [
            'favourites' => $user->favouriteTags(),
        ]);
    }

    public function view($id)
    {
        $user = Auth::user();
        $tag = Tag::find($id);

        // Find all events with this tag that have occurred within a diary
        // this user has access to
        $events = DiaryTag::where('tag_id', '=', $id)
                            ->whereIn('diary_id', $user->diaries()->get()->pluck('id'))
                            ->get()
                            ->sortByDesc('at')
                            ->flatten();

        $lastUsed = $events->first()->at;
        $count = $events->count();
        $value = $events->sum(function($event) {
            return (int) $event->value ?: 1;
        });

        return view('tags.view', [
            'tag' => $tag,
            'events' => $events->take(10),
            'lastUsed' => $lastUsed,
            'count' => $count,
            'value' => $value,
        ]);
    }
}
