<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

use App\DiaryTag;
use App\Achievements\UserCreated100DiaryTag;
use App\Achievements\UserCreated10DiaryTag;
use App\Achievements\UserCreatedDiaryTag;

class DiaryTagAchievementObserver
{
    /**
     * Handle the diary tag "created" event.
     *
     * @param  \App\DiaryTag  $diaryTag
     * @return void
     */
    public function created(DiaryTag $diaryTag)
    {
        // TODO: Should we source the $user from elsewhere? Could an admin trigger this by creating a diary tag
        //       on behalf of another user? Could this be triggered by a Migration/Job
        $user = Auth::user();

        // TODO: Analyse a User's achievements, and only add progress where relevant
        // dd($user->achievements);

        $user->addProgress(new UserCreated100DiaryTag(), 1);
        $user->addProgress(new UserCreated10DiaryTag(), 1);
        $user->addProgress(new UserCreatedDiaryTag(), 1);
    }
}
