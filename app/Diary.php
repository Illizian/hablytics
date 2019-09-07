<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UsesUuid;

class Diary extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The User(s) that access to this Diary
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * The Events (->Tag) that have occurred within this Diary
     */
    public function events()
    {
        return $this->belongsToMany('App\Tag')
                    ->using('App\DiaryTag')
                    ->withPivot([
                        'id',
                        'at',
                        'value'
                    ])
                    ->withTimestamps();
    }

    /**
     * Determine this Diary's "favourite" Tags
     */
    public function favouriteTags($limit = 10)
    {
        return $this->events()
                    ->get()
                    ->groupBy('id')
                    ->map(function($group) {
                        return [
                            'tag' => $group->first(),
                            'count' => $group->count(),
                        ];
                    })
                    ->sortByDesc('count')
                    ->take($limit);
    }
}
