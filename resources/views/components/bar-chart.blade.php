<svg
    class="{{ $class ?? '' }}"
    width="{{ $chart->get('width') }}px"
    height="{{ $chart->get('height') }}px"
    viewBox="0 0 {{ $chart->get('width') }} {{ $chart->get('height') }}"
    xmlns="http://www.w3.org/2000/svg"
>
    @foreach($chart->get('data') as $column)
        <rect
            height="{{ $column->get('height') }}"
            width="{{ $column->get('width') }}"
            x="{{ $column->get('x') }}"
            y="{{ $column->get('y') }}"
            ry="{{ $column->get('radius') }}"
            fill="currentColor"
        />
    @endforeach
</svg>
