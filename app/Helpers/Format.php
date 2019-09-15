<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Format
{
    public static function date(string $string, string $format = 'd/m/y')
    {
        $date = Carbon::createFromFormat($format, $string);
        $formatted = $date->format('d M');
        $diff = ucfirst(
            ($date->diffInDays() === 0)
                ? 'today'
                : $date->diffForHumans([ 'options' => Carbon::ONE_DAY_WORDS ])
        );

        return "$diff, $formatted";
    }
}
