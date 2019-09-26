@extends('layouts.app')

@section('title')
    {{ __('Register') }}
@endsection

@section('content')
    @component('components/card')
        <div class="alert alert-info" role="alert">
            <div>
                <span class="font-bold">Info:</span>
                Registrations are being confirmed in batches whilst we're in Alpha. Register for your account below and we'll email when your account has been approved.
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label class="block">
                <span class="font-bold @if($errors->has('name')) text-red-500 @else text-gray-700 @endif">{{ __('Name') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('name')) border border-red-500 @endif"
                    name="name"
                    placeholder="{{ __('What should we call you?') }}"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                    autofocus
                />

                @error('name')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mt-4 block">
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
                <span class="font-bold @if($errors->has('password_confirmation')) text-red-500 @else text-gray-700 @endif">{{ __('Confirm your Password') }}</span>
                <input
                    class="form-input block w-full @if($errors->has('password_confirmation')) border border-red-500 @endif"
                    name="password_confirmation"
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

            <label class="mt-4 block">
                <input
                    class="form-checkbox mr-2 @if($errors->has('password_confirmation')) border border-red-500 @endif"
                    name="privacy"
                    type="checkbox"
                    required
                />

                <span class="font-bold @if($errors->has('password_confirmation')) text-red-500 @else text-gray-700 @endif">
                    You agree to our <a class="text-purple-700 underline" href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a> and <a class="text-purple-700 underline" href="{{ route('terms') }}">{{ __('Terms and Conditions') }}</a>
                </span>

                @error('password-confirm')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <div class="mt-4">
                <button type="submit" class="btn">
                    {{ __('Register') }}
                </button>

                <a class="ml-2 text-purple-700 font-bold" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
            </div>
        </form>
    @endcomponent
@endsection
