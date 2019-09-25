@extends('layouts.app')

@section('title')
    Your Integrations
@endsection

@section('content')
    @component('components/card', [ 'bgColor' => 'bg-blue-100' ])
        <div class="text-center">
            <h2 class="mb-2 block font-bold text-2xl">
                Integrations
            </h2>

            <span class="pill pill-secondary">Coming Soon!</span>

            <div class="px-4 py-8">
                @svg('integrate-placeholder', 'w-full h-auto')
            </div>
        </div>
    @endcomponent
@endsection
