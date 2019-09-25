@component('components/card', [ 'href' => '/tags/'. $tag['tag']->id ])
    <div class="flex">
        <div class="flex-grow">
            <h3 class="font-bold">
                {{ $tag['tag']->name }}
                <span class="ml-4 pill pill-secondary">{{ $tag['count'] }}</span>
            </h3>

            <p class="font-light">
                Last Used: {{ $tag['lastUsed'] }}
            </p>
        </div>

         <div class="flex ml-4 items-center">
            @svg('icons/chevron-right')
        </div>
    </div>
@endcomponent
