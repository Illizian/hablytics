<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\DiaryTag;
use App\Observers\DiaryTagAchievementObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DiaryTag::observe(DiaryTagAchievementObserver::class);
    }
}
