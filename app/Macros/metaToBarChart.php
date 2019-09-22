<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * Convert meta data into Bar Chart data
 *
 * @return Array
 */
class metaToBarChart
{
    public function __invoke()
    {
        return function (int $width = 400, int $height = 300, int $gap = 12, int $radius = 8) : Collection
        {
            $max = $this->get('max');
            $min = $this->get('min');
            $columns = $this->get('count');
            $colWidth = ($width - ($gap * $columns)) / $columns;

            $data = $this->get('data')->map(function($column, $index) use ($height, $gap, $radius, $colWidth) {
                $percentage = $column->get('percentage');
                $value = $height * $percentage;
                $props = [
                    'width' => $colWidth,
                    'x' => ($colWidth + $gap) * $index,
                    'y' => $height - $value
                ];

                if (empty($percentage)) {
                    $props['height'] = 1;
                    $props['radius'] = 0;
                } else {
                    $props['height'] = $value + $radius;
                    $props['radius'] = $radius;
                }

                return collect(array_merge($column->toArray(), $props));
            });

            return collect(compact(
                'width',
                'height',
                'radius',
                'max',
                'min',
                'columns',
                'colWidth',
                'data'
            ));
        };
    }
}
