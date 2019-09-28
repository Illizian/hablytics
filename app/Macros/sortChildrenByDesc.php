<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * sortByDesc on the Collections' items
 *
 * @param string $key
 *
 * @return \Illuminate\Support\Collection
 */
class sortChildrenByDesc extends Collection
{
    public function __invoke()
    {
        return function (string $key) : Collection
        {
            return $this->map(function($item) use ($key) {
                return $item->sortByDesc($key);
            });
        };
    }
}
