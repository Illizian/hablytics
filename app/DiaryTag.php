<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Traits\UsesUserTracking;

class DiaryTag extends Pivot
{
    use UsesUserTracking;

    protected $dates = ['at'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;


    public function diary()
    {
        return $this->belongsTo('App\Diary');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
