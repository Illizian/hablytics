<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * Convert meta data into Bar Chart data
 *
 * @return Array
 */
class metaToPieChart extends Collection
{
    public function __invoke()
    {
        return function (array $colors = [
            '#48BB78',
            '#ECC94B',
            '#ED8936',
            '#F56565',
            '#ED64A6',
            '#9F7AEA',
            '#667EEA',
            '#4299E1',
            '#38B2AC'
        ]) : Collection {
            $max = $this->get('max');
            $min = $this->get('min');
            $total = $this->get('total');
            $columns = $this->get('count');

            $radians = 0.0;
            $data = $this->get('data')->map(function($column, $index) use ($colors, &$radians) {
                $color = $colors[$index % count($colors)];
                $percentage = $column->get('percentage');
                $startX = cos($radians);
                $startY = sin($radians);
                $radians += (2 * pi() * $percentage);
                $endX = cos($radians);
                $endY = sin($radians);
                $arc = $percentage > 0.5 ? 1 : 0;

                return collect(array_merge($column->toArray(), compact(
                    'startX',
                    'startY',
                    'endX',
                    'endY',
                    'arc',
                    'color'
                )));
            });

            return collect(compact(
                'max',
                'min',
                'total',
                'columns',
                'data'
            ));
        };
    }
}
