<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * Convert meta data into Bar Chart data
 *
 * @return Array
 */
class metaToBarChart extends Collection
{
    public function __invoke()
    {
        return function (int $width = 400, int $height = 300, int $gap = 12, int $radius = 8) : Collection
        {
            $max = $this->get('max');
            $min = $this->get('min');
            $columns = $this->get('count');

            $colWidth = ($width - ($gap * ($columns - 1))) / $columns;
            $segmentHeight = $height / max($max - $min, 1);
            $padding = ($width - (($colWidth * $columns) + ($gap * ($columns - 1)))) / 2;

            $data = $this->get('data')->map(function($column, $index) use ($height, $gap, $radius, $colWidth, $segmentHeight, $padding) {
                $count = $column->get('count');
                $props = [
                    'width' => $colWidth,
                    'x' => (($colWidth + $gap) * $index) + $padding
                ];

                if (empty($count)) {
                    $props['height'] = 1;
                    $props['radius'] = 0;
                    $props['y'] = $height - 1;
                } else {
                    $props['height'] = ($segmentHeight * $count) + $radius;
                    $props['radius'] = $radius;
                    $props['y'] = $height - ($segmentHeight * $count);
                }

                return collect(array_merge($column->toArray(), $props));
            })->sortBy('x');

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
