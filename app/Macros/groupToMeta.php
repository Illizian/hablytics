<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * Convert a Collection into Chart Meta data
 *
 * @return Collection
 */
class groupToMeta extends Collection
{
    public function __invoke()
    {
        return function () : Collection
        {
            $values = $this->map(function($group, $key) {
                return [
                    'label' => $key,
                    'count' => $group->count()
                ];
            })->values();

            $max = $values->max('count');
            $min = $values->min('count');
            $total = $values->sum('count');
            $count = $values->count();

            $data = $values->map(function($column, $index) use ($total) {
                return collect(array_merge($column, [
                    'percentage' => $total ? round($column['count'] / $total, 2) : 0
                ]));
            })->sort(function($a, $b) {
                return ($a->get('count') < $b->get('count')) ? -1 : 1;
            });

            return collect(compact(
                'max',
                'min',
                'total',
                'count',
                'data'
            ));
        };
    }
}
