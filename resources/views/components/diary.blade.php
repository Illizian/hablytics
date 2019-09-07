@component('components/card')
    <div class="flex">
        <div class="flex-grow">
            <h3 class="font-bold">
                <a href="/diary/{{ $diary->id }}">
                    {{ $diary->name }}
                </a>
            </h3>

            <div class="text-orange-300">
                @svg('example-graph')
            </div>
        </div>

        <div class="flex ml-4">
            <a href="/diary/{{ $diary->id }}" class="flex flex-grow items-center text-indigo-700">
                @svg('icons/chevron-right')
            </a>
        </div>
    </div>
@endcomponent
