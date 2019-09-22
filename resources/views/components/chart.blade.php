<svg
    class="{{ $class ?? '' }}"
    width="{{ $chart->get('width') }}px"
    height="{{ $chart->get('height') }}px"
    viewBox="0 0 {{ $chart->get('width') }} {{ $chart->get('height') }}"
    xmlns="http://www.w3.org/2000/svg"
>
    @foreach($chart->get('data') as $column)
        @if($column->get('percentage') > 0)
            <rect
                height="{{ $column->get('height') }}"
                width="{{ $column->get('width') }}"
                x="{{ $column->get('x') }}"
                y="{{ $column->get('y') }}"
                ry="{{ $column->get('radius') }}"
                fill="currentColor"
            />
        @else
            <rect
                height="1"
                width="{{ $column->get('width') }}"
                x="{{ $column->get('x') }}"
                y="{{ $chart->get('height') - 1 }}"
                fill="currentColor"
            />
        @endif
    @endforeach
</svg>

