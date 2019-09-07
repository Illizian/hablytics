<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\UsesUuid;

class User extends Authenticatable
{
    use Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The Diary(s) this User has access to
     */
    public function diaries()
    {
        return $this->belongsToMany('App\Diary')->withTimestamps();
    }

    /**
     * Determine this User's "favourite" Tags
     */
    public function favouriteTags($limit = 10)
    {
        return $this->diaries()
                    ->get()
                    ->flatMap(function($diary) {
                        return $diary->events()->get();
                    })
                    ->groupBy('id')
                    ->map(function($group) {
                        $latest = $group->sortByDesc(function($tag) {
                            return $tag->pivot->at;
                        })->first();

                        $value = $group->sum(function($tag) {
                            return (int) $tag->pivot->value || 1;
                        });

                        return [
                            'tag' => $latest,
                            'count' => $group->count(),
                            'value' => $value,
                            'lastUsed' => $latest->pivot->at->format('h:ia d/m/y')
                        ];
                    })
                    ->sortByDesc('count')
                    ->take($limit);
    }
}
