@extends('layouts.app')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    @component('components/card')
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label class="mt-4 block">
                <span class="font-bold @if($errors->has('email')) text-red-500 @else text-gray-700 @endif">{{ __('Email Address') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('email')) border border-red-500 @endif"
                    name="email"
                    placeholder="{{ __('Enter your Email') }}"
                    value="{{ $email ?? old('email') }}"
                    autocomplete="email"
                    required
                />

                @error('email')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mt-4 block">
                <span class="font-bold @if($errors->has('password')) text-red-500 @else text-gray-700 @endif">{{ __('Password') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('password')) border border-red-500 @endif"
                    name="password"
                    type="password"
                    placeholder="{{ __('Enter a Password') }}"
                    autocomplete="new-password"
                    required
                />

                @error('password')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mt-4 block">
                <span class="font-bold @if($errors->has('password-confirm')) text-red-500 @else text-gray-700 @endif">{{ __('Confirm your Password') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('password-confirm')) border border-red-500 @endif"
                    name="password-confirm"
                    type="password"
                    placeholder="{{ __('Confirm your Password') }}"
                    autocomplete="new-password"
                    required
                />

                @error('password-confirm')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <div class="mt-4">
                <button type="submit" class="btn">
                    {{ __('Reset Password') }}
                </button>
            </div>
    @endcomponent
@endsection
