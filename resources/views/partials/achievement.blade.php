<div class="mb-4 flex">
    <div class="pr-4 @if($achievement->isLocked()) opacity-50 @endif">
        @svg('trophy', 'm-auto w-auto h-24')
    </div>

    <div class="flex-grow">
        <h5 class="font-bold">{{ $achievement->details()->first()->name }}</h5>
        <p>{{ $achievement->details()->first()->description }}</p>

        <progress
            class="block w-full mt-2"
            value="{{ $achievement->points }}"
            max="{{ $achievement->details()->first()->points }}"
        ></progress>

        @if($achievement->isUnlocked())
            <p class="text-gray-600">Unlocked {{ App\Helpers\Format::date($achievement->unlocked_at->format('d/m/y')) }}</p>
        @endif
    </div>
</div>
