@extends('layouts.app-single')

@section('title')
    {{ $diary->name }}
@endsection

@section('header-content')
    <div id="daily-bar-chart" class="text-white pt-4 pb-2">
        @component('components/bar-chart', [ 'chart' => $chart, 'class' => 'w-full h-auto' ])
        @endcomponent
    </div>
@endsection

@section('content')
    <form method="POST" action="/diary/{{ $diary->id }}/create" class="quick-events">
        @csrf
        <input type="hidden" name="tag" class="quick-event-tag" value="" />
        <input type="hidden" name="value" class="quick-event-value" value="" />

        <ul class="flex flex-wrap mb-2">
            <li class="block mr-2 mb-2">
                <a class="btn h-full flex items-center" href="/diary/{{ $diary->id }}/create">
                    @svg('icons/plus')
                </a>
            </li>

            @foreach($diaryFavourites as $favourite)
                <li class="block mr-2 mb-2">
                    <button class="quick-event-button" type="button" value="{{ $favourite['tag']->name }}">
                        <div class="quick-event-button-inner">
                            <span class="quick-event-button-tag">{{ $favourite['tag']->name }}</span>
                            <span class="quick-event-button-value"></span>
                        </div>
                    </button>
                </li>
            @endforeach
        </ul>
    </form>

    <section class="swipe-container relative js-swipe-prev-active">
        <div class="swipe-nav">
            <button class="swipe-prev">
                @svg('icons/chevron-left')
            </button>
            <div class="swipe-heading">
                <span class="swipe-heading-text"></span>
            </div>
            <button class="swipe-next">
                @svg('icons/chevron-right')
            </button>
        </div>
        <div class="swipe -mx-4 z-10">
            <ol class="swipe-wrap">
                @foreach($dates as $date => $events)
                    <li class="min-h-180 p-4" data-heading="{{ App\Helpers\Format::date($date) }}">
                        @include('partials/events-list')
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
@endsection
