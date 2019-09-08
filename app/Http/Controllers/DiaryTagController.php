<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\DiaryTag;

class DiaryTagController extends Controller
{
    public function view($id)
    {
        $user = Auth::user();
        $diaryTag = DiaryTag::find($id);
        $diary = $diaryTag->diary()->first();

        if (! $diary->users()->get()->contains($user)) return abort(404, "Diary Tag not found with the ID $id!");

        return view('diary-tag.view', [
            'diaryTag' => $diaryTag
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $diaryTag = DiaryTag::find($id);
        $diary = $diaryTag->diary()->first();

        if (! $diary->users()->get()->contains($user)) return abort(404, "Diary Tag not found with the ID $id!");

        $diaryTag->delete();

        return redirect("/diary/$diary->id");
    }
}
