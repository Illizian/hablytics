<h2 class="font-bold">Latest Events</h2>

@if(count($events) === 0)
    <p class="text-purple-700 font-light">
        There are no events. Create your first now.
    </p>
@endif

<ul class="events-list" style="--list-transition-delay: {{ count($events) * 0.1 }}s;">
    @foreach($events as $event)
        <li class="my-1 event flex items-center" style="--event-transition-delay: {{ $loop->index * 0.1 }}s;">
            <a class="ml-2" href="/diary-tag/{{ $event->id }}">
                {{ $event->tag->name }}
            </a>

            @if($event->value && $event->value > 1)
                <span class="ml-2 pill">
                    {{ $event->value }}
                </span>
            @endif
            <span class="flex-grow text-xs font-bold text-gray-500 text-right">
                {{ $event->at->format('h:ia d/m/y') }}
            </span>
        </li>
    @endforeach
</ul>
