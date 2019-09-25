@extends('layouts.app')

@section('title')
    Your Goals
@endsection

@section('content')
    @component('components/card', [ 'bgColor' => 'bg-blue-100' ])
        <div class="text-center">
            <h2 class="mb-2 block font-bold text-2xl">
                Goals
            </h2>

            <div class="mb-4">
                <span class="pill pill-secondary">Coming Soon!</span>
            </div>

            <div class="px-4 py-8">
                @svg('goals-placeholder', 'w-full h-auto')
            </div>
        </div>
    @endcomponent
@endsection
