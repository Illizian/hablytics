<svg class="{{ $class ?? '' }}" width="{{ $chart['width'] }}px" height="{{ $chart['height'] }}px" viewBox="0 0 {{ $chart['width'] }} {{ $chart['height'] }}" xmlns="http://www.w3.org/2000/svg">
    @foreach($chart['data'] as $column)
        @if($column['value'] === 0)
            <rect
                height="1"
                width="{{ $column['width'] }}"
                x="{{ $column['x'] }}"
                y="{{ $chart['height'] - 1 }}"
                fill="currentColor"
            />
        @else
            <rect
                height="{{ $column['height'] }}"
                width="{{ $column['width'] }}"
                x="{{ $column['x'] }}"
                y="{{ $column['y'] }}"
                ry="{{ $chart['colRadius'] }}"
                fill="currentColor"
            />
        @endif
    @endforeach
</svg>
