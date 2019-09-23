<svg
    class="{{ $class ?? 'w-full h-auto' }}"
    viewBox="-1 -1 2 2"
    style="transform: rotate(-0.25turn)"
    xmlns="http://www.w3.org/2000/svg"
>
    @foreach($chart->get('data') as $column)
        <path
            d="
                M {{ $column->get('startX') }} {{ $column->get('startY') }}
                A 1 1 0 {{ $column->get('arc') }} 1 {{ $column->get('endX') }} {{ $column->get('endY') }}
                L 0 0
            "
            fill="{{ $column->get('color') }}"
        ></path>
    @endforeach
    <circle r="0.5" fill="{{ $fill ?? '#f7fafc' }}"></circle>
</svg>
