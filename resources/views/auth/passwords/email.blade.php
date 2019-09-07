@extends('layouts.app')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
     @component('components/card')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block">
                <span class="font-bold @if($errors->has('email')) text-red-500 @else text-gray-700 @endif">{{ __('Email Address') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('email')) border border-red-500 @endif"
                    name="email"
                    placeholder="{{ __('Enter your Email') }}"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                />

                @error('email')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <div class="mt-4">
                <button type="submit" class="btn">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
     @endcomponent


@endsection
