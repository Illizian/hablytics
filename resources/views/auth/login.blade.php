@extends('layouts.app')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    @component('components/card')
        <form method="POST" action="{{ route('login') }}">
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
                    autofocus
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
                    placeholder="{{ __('Enter your Password') }}"
                    value="{{ old('password') }}"
                    autocomplete="current-password"
                    required
                />

                @error('password')
                    <span class="mt-2 alert alert-sm" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </label>

            <label class="mt-4 flex items-center">
                <input
                    class="form-checkbox"
                    type="checkbox"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                />
                <span class="ml-2 font-bold @if($errors->has('password')) text-red-500 @else text-gray-700 @endif">{{ __('Remember Me') }}</span>
            </label>

            <div class="mt-4">
                <button type="submit" class="btn">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="ml-2 text-purple-700 font-bold" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    @endcomponent
@endsection
