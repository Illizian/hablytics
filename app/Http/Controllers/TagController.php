<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $data = DiaryTag::where('tag_id', '=', $id)
                        ->whereIn('diary_id', $user->diaries()->get()->pluck('id'))
                        ->whereDate('at', '>=', Carbon::now()->subDays(30)->format('Y-m-d'))
                        ->get()
                        ->load('tag')
                        ->sortByDesc('at')
                        ->flatten();

        // Generate Meta data
        $lastUsed = $data->first()->at;
        $count = $data->count();
        $value = $data->sum(function($event) {
            return (int) $event->value ?: 1;
        });

        // Generate a 30day chart
        $grouped = $data->groupByDateRange(Carbon::now()->subDays(30), Carbon::now(), 'at');
        $events = $grouped->sortChildrenByDesc('at')->reverse();
        $chart = $grouped->groupToSvg(1280, 300, 8, 8);

        return view('tags.view', [
            'tag' => $tag,
            'dates' => $events,
            'chart' => $chart,
            'lastUsed' => $lastUsed,
            'count' => $count,
            'value' => $value,
        ]);
    }
}
