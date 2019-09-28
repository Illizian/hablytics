<?php

namespace App\Macros;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/*
 * Get the next item from the collection.
 *
 * @param Carbon\Carbon $from
 * @param Carbon\Carbon $to
 * @param string $key
 * @param string $format
 *
 * @return \Illuminate\Support\Collection
 */
class GroupByDateRange extends Collection
{
    public function __invoke()
    {
        return function (Carbon $from, Carbon $to, string $key, string $format = 'd/m/y') : Collection
        {
            // Generate the requested date range
            $dates = collect(CarbonPeriod::create($from, $to))->reduce(function($acc, $date) use ($format) {
                $acc[$date->format($format)] = collect();

                return $acc;
            }, []);

            // Create new collection, with items in this collection added to appropriate date group by key
            return collect($this->reduce(function($groups, $entry) use ($key, $format) {
                $date = $entry->{$key}->format($format);

                // Check if $entry is within date range
                if (! array_key_exists($date, $groups)) return $groups;

                $groups[$date]->push($entry);

                return $groups;
            }, $dates));
        };
    }
}
