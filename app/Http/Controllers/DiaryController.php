<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Diary;
use App\DiaryTag;
use App\Http\Requests\CreateEventRequest;
use App\Tag;

class DiaryController extends Controller
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

    /**
     * Either show the Diary List or redirect to a single diary view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->diaries()->count() === 1) {
            // User only has one diary, redirect to directly to that diary.
            $diary = $user->diaries()->first();

            return redirect("/diary/$diary->id");
        } else {
            // Collect all Users' diaries and display as a list
            $diaries = $user->diaries()->get();

            return view('diaries.index', [ 'diaries' => $diaries ]);
        }
    }

    public function create()
    {
        return view('diaries.create');
    }

    public function postCreate(Request $request)
    {
        $user = Auth::user();
        $diary = new Diary;
        $diary->fill($request->only(['name']));
        $diary->save();

        $user->diaries()->attach($diary);

        return redirect('/');
    }

    public function view($id)
    {
        $user = Auth::user();
        $diary = $user->diaries()->find($id);

        if (empty($diary)) return abort(404, "Diary not found with the ID $id!");

        // Actually get events from DiaryTag Model
        $events = DiaryTag::where([
            [ 'diary_id', '=', $id ],
            [ 'at', '>=', Carbon::now()->subWeek() ]
        ])
            ->get()
            ->load('tag')
            ->groupByDateRange(Carbon::now()->subWeek(), Carbon::now(), 'at');

        return view('diaries.view', [
            'diary' => $diary,
            'dates' => $events,
            'userFavourites' => $user->favouriteTags(),
            'diaryFavourites' => $diary->favouriteTags()
        ]);
    }

    public function createEvent($id)
    {
        $user = Auth::user();
        $diary = $user->diaries()->find($id);
        $tags = Tag::get();

        if (empty($diary)) return abort(404, "Diary not found with the ID $id!");

        return view('events.create', [ 'tags' => $tags ]);
    }

    public function postCreateEvent($id, CreateEventRequest $request)
    {
        $user = Auth::user();
        $diary = $user->diaries()->find($id);
        if (empty($diary)) return abort(404, "Diary not found with the ID $id!");

        $tag = Tag::firstOrCreate([
            'name' => Str::title($request->input('tag'))
        ]);

        // Extract pivot values
        $pivot = [];
        if ($request->filled('at')) {
            $pivot['at'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('at'));
        }

        if ($request->filled('value')) {
            $pivot['value'] = $request->input('value');
        }

        $diary->events()->attach($tag, $pivot);

        return redirect("/diary/$id");
    }
}
