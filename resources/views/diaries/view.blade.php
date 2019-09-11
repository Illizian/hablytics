@extends('layouts.app-single')

@section('title')
    {{ $diary->name }}
@endsection

@section('header-content')
    <div class="text-white px-4 pt-4">
        @svg('example-graph')
    </div>
@endsection

@section('content')
    <ul class="flex flex-wrap mb-2">
        <li class="block mr-2 mb-2">
            <a class="btn h-full flex items-center" href="/diary/{{ $diary->id }}/create">
                @svg('icons/plus')
            </a>
        </li>

        @foreach($diaryFavourites as $favourite)
            <li class="block mr-2 mb-2">
                <a class="block btn btn-green" href="/diary/{{ $diary->id }}/create/{{ $favourite['tag']->id }}" data-count="{{ $favourite['count'] }}">
                    {{ $favourite['tag']->name }}
                </a>
            </li>
        @endforeach
    </ul>

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
        <div class="swipe z-10">
            <ol class="swipe-wrap">
                @foreach($dates as $date => $events)
                    <li class="min-h-180 py-4" data-heading="{{ $date }}">
                        @include('partials/events-list')
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
@endsection
