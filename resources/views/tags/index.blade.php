@extends('layouts.app')

@section('title')
    Analytics
@endsection

@section('content')
    @if(count($favourites) === 0)
        @component('components/card')
            <p class="text-purple-700 font-light">
                You do not have any favourite tags, track some events to see their analytics here.
            </p>
        @endcomponent
    @endif

    @each('components/tag', $favourites, 'tag')
@endsection
