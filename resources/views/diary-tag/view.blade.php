@extends('layouts.app-single')

@section('backUrl')
/diary/{{ $diaryTag->diary_id }}
@endsection

@section('title')
    View Diary Tag
@endsection

@section('header-content')
    <div class="m-4 p-4 text-white bg-blue-400 rounded-xl shadow-inner">
        <div class="flex">
            <div class="flex-grow">
                <label class="block font-bold">Name</label>
                <span class="block text-5xl">
                    {{ $diaryTag->tag->name }}
                </span>
            </div>
            <div class="flex-grow">
                <label class="block font-bold">Value</label>
                <span class="block text-5xl">
                    {{ $diaryTag->value ?? 1 }}
                </span>
            </div>
        </div>
        <div>
            <label class="block mb-2 font-bold">At</label>
            <span class="block">
                {{ $diaryTag->at->format('h:ia d/m/y') }}
            </span>
        </div>
    </div>
@endsection

@section('content')
    <form method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-red btn-lg">Delete</button>
    </form>
@endsection
