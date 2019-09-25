@component('components/card', [ 'href' => "/diary/$diary->id" ])
    <div class="flex">
        <div class="flex-grow">
            <h3 class="font-bold">
                {{ $diary->name }}
            </h3>

            <div class="text-orange-300">
                @svg('example-graph')
            </div>
        </div>

        <div class="ml-4 flex items-center">
            @svg('icons/chevron-right')
        </div>
    </div>
@endcomponent
