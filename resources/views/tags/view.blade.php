@extends('layouts.app-single')

@section('backUrl')
/tags
@endsection

@section('title')
    {{ $tag->name }}
@endsection

@section('header-content')
    <div class="m-4 p-4 text-white bg-blue-400 rounded-xl shadow-inner">
        <div class="flex">
            <div class="flex-grow">
                <label class="block font-bold">Total</label>
                <span class="block text-5xl">
                    {{ $count }}
                </span>
            </div>
            <div class="flex-grow">
                <label class="block font-bold">Value</label>
                <span class="block text-5xl">
                    {{ $value }}
                </span>
            </div>
        </div>
        <div>
            <label class="block mb-2 font-bold">Last Used</label>
            <span class="block">
                {{ $lastUsed }}
            </span>
        </div>
    </div>
@endsection

@section('content')
    <div class="mb-4 overflow-x-scroll rtl">
        @component('components/chart', [ 'chart' => $chart ])
        @endcomponent
    </div>

    <h4 class="font-bold">

    @foreach($dates as $date => $events)
        @if(count($events) > 0)
            <div class="pb-4 mb-4 border-b border-gray-300">
                <h4 class="font-bold">{{ App\Helpers\Format::date($date) }}</h4>

                @include('partials/events-list')
            </div>
        @else
            <span class="event-ellipsis"></span>
        @endif
    @endforeach
@endsection
