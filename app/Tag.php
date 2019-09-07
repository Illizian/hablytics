<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UsesUuid;

class Tag extends Model
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
     * The Events that have used this Tag
     */
    public function events()
    {
        return $this->belongsToMany('App\Diary')
                    ->using('App\DiaryTag')
                    ->withPivot([
                        'id',
                        'at',
                        'value'
                    ])
                    ->withTimestamps();
    }
}
