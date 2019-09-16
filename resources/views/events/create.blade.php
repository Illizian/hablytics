@extends('layouts.app')

@section('backUrl')
/diary/{{ Request::route('id') }}
@endsection

@section('title')
    Create an event
@endsection

@section('content')
    @component('components/card')
        <form method="POST">
            @csrf

            <p class="mb-2 text-xs font-light">
                Search for an existing tag or publish a new one. You may specify a date/time (e.g. If this event occurred earlier) and an optional custom value (e.g. 3 for a “3 mile run”)
            </p>

            <label class="mb-4 block">
                <span class="font-bold text-sm @if($errors->has('tag')) text-red-500 @else text-gray-700 @endif">{{ __('Select or Create a tag') }}</span>

                <input
                    class="form-input block w-full @if($errors->has('tag')) border border-red-500 @endif"
                    name="tag"
                    type="text"
                    list="tags"
                    value="{{ old('tag') }}"
                    autofocus
                >
                <datalist id="tags">
                    @foreach ($tags as $tag)
                        <option>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </datalist>

                @error('tag')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mb-4 block">
                <span class="font-bold text-sm @if($errors->has('at')) text-red-500 @else text-gray-700 @endif">{{ __('Occured At') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('at')) border border-red-500 @endif"
                    name="at"
                    type="datetime-local"
                    max="{{ Carbon\Carbon::tomorrow()->subMinute(1)->format('Y-m-d\TH:i') }}"
                    value="{{ old('at') }}"
                />

                @error('at')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mb-4 block">
                <span class="font-bold text-sm @if($errors->has('value')) text-red-500 @else text-gray-700 @endif">{{ __('Value') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('value')) border border-red-500 @endif"
                    name="value"
                    type="number"
                    value="{{ old('value') }}"
                />

                @error('value')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <div class="text-right">
                <button type="submit" class="btn">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection
