@extends('layouts.app-single')

@section('title')
    Weekly Report
@endsection

@section('header-content')
    <div class="text-white pt-4 pb-2">
        <h1 class="text-2xl font-black">{{ $from->format('M d') }} - {{ $to->format('M d') }}</h1>

        <h2 class="text-blue-200">
            You tracked {{ $events->count() }} events this week, let's see how your week went
        </h2>
    </div>
@endsection

@section('content')
    <section class="mb-4 shadow-md rounded-xl p-4 bg-white">
        <h3 class="mb-4 text-lg text-gray-600 font-bold">
            Your most used tag
            <span class="block mt-2 ml-4 text-xl text-purple-500 font-black tracking-wide uppercase">
                {{ $chart->get('data')->last()->get('label') }}
            </span>
        </h3>

        @if($largest->value > 1)
            <h3 class="mb-4 text-lg text-gray-600 font-bold">
                Your largest tag
                <span class="block mt-2 ml-4">
                    <span class="text-xl text-purple-500 font-black tracking-wide uppercase">
                        {{ $largest->tag->name }}
                    </span>
                    <span class="text-gray-500 font-light">
                        with
                    </span>
                    <span class="text-xl text-purple-500 font-black tracking-wide uppercase">
                        {{ $largest->value }}
                    </span>
                </span>
            </h3>
        @endif
    </section>

    <section class="mb-4 shadow-md rounded-xl p-4 bg-white">
        <h3 class="mb-4 text-lg text-gray-600 font-bold">Your week in summary</h3>

        <div class="flex">
            <div class="w-1/2">
                @component('components/pie-chart', [ 'chart' => $chart ])
                @endcomponent
            </div>
            <div class="w-1/2 pl-4">
                <ol class="legend">
                    @foreach($chart->get('data') as $column)
                        <li class="mb-2" style="--highlight-color: {{ $column->get('color') }};">
                            {{ $column->get('count') }}x
                            {{ $column->get('label') }}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    @if(count($achievements))
        <section class="shadow-md rounded-xl p-4 bg-white">
            <h3 class="mb-4 text-lg text-gray-600 font-bold">
                A great week! You unlocked
                {{ count($achievements) > 1 ? 'achievements' : 'an achievement' }}.
            </h3>

            <div class="flex flex-wrap">
                @foreach($achievements as $achievement)
                    <div class="w-1/3 text-center">
                        @svg('trophy', 'm-auto mb-2 w-auto h-24')
                        <h5 class="font-bold">{{ $achievement->details()->first()->name }}</h5>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
