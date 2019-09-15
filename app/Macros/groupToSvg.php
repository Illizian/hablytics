<?php

namespace App\Macros;

use Illuminate\Support\Collection;

/*
 * Convert a Collection into SVG Chart Meta data
 *
 * @param int $width
 * @param int $height
 *
 * @return Array
 */
class groupToSvg
{
    public function __invoke()
    {
        return function (int $width = 400, int $height = 300, int $gap = 12, int $colRadius = 8) : Array
        {
            $values = $this->map(function($group, $key) {
                return [
                    'label' => $key,
                    'value' => $group->count()
                ];
            })->values();
            $max = $values->max('value');
            $min = $values->min('value');
            $cols = $values->count();
            $colWidth = ($width - ($gap * $cols)) / $cols;
            $segmentHeight = $height / max($max - $min, 1);
            $data = $values->map(function($column, $index) use ($width, $height, $gap, $colRadius, $colWidth, $segmentHeight) {
                return array_merge($column, [
                    'height' => ($segmentHeight * $column['value']) + $colRadius,
                    'width' => $colWidth,
                    'x' => ($colWidth + $gap) * $index,
                    'y' => ($height - ($segmentHeight * $column['value'])) + $colRadius
                ]);
            });

            return [
                'width' => $width,
                'height' => $height,
                'max' => $max,
                'min' => $min,
                'cols' => $cols,
                'colWidth' => $colWidth,
                'colRadius' => $colRadius,
                'data' => $data
            ];
        };
    }
}
