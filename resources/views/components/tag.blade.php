@component('components/card')
    <div class="flex">
        <div class="flex-grow">
            <h3 class="font-bold">
                <a href="/tags/{{ $tag['tag']->id }}">
                    {{ $tag['tag']->name }}
                </a>
                <span class="ml-4 pill pill-secondary">{{ $tag['count'] }}</span>
            </h3>

            <p class="font-light">
                Last Used: {{ $tag['lastUsed'] }}
            </p>
        </div>

         <div class="flex ml-4">
            <a href="/tags/{{ $tag['tag']->id }}" class="flex flex-grow items-center text-indigo-700">
                @svg('icons/chevron-right')
            </a>
        </div>
    </div>
@endcomponent
