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
    @include('partials/events-list')
@endsection
