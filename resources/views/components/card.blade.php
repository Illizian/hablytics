@isset($href)
    <a href="{{ $href }}" class="mb-4 p-4 block shadow-md rounded-xl {{ $bgColor ?? 'bg-white' }}">
        {{ $slot }}
    </a>
@else
    <div class="mb-4 p-4 block shadow-md rounded-xl {{ $bgColor ?? 'bg-white' }}">
        {{ $slot }}
    </div>
@endif
