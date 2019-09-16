<div class="w-1/2 p-2">
    <div class="@if($achievement->isLocked()) opacity-50 @endif">
        @svg('trophy', 'm-auto')
    </div>

    <div class="mt-2">
        <h5 class="font-bold">{{ $achievement->details()->first()->name }}</h5>
        <p>{{ $achievement->details()->first()->description }}</p>

        @if($achievement->isUnlocked())
            <p>Unlocked {{ App\Helpers\Format::date($achievement->unlocked_at->format('d/m/y')) }}</p>
        @else
            <progress value="{{ $achievement->points }}" max="{{ $achievement->details()->first()->points }}" />
        @endif
    </div>
</div>
