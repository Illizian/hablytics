@extends('layouts.app')

@section('title')
    Your Profile
@endsection

@section('content')
    @component('components/card')
        <div class="mb-4 border-b border-gray-300 flex justify-center">
            <div class="m-2 mb-4 w-32 h-32 flex justify-center items-center bg-purple-500 rounded-full">
                <span class="text-4xl text-white font-bold">
                    {{ App\Helpers\Format::initials($user->name) }}
                </span>
            </div>
        </div>

        <div class="mb-4 pb-4 border-b border-gray-300">
            <label class="block font-bold">Email</label>

            {{ $user->email }}

            @if($user->email_verified_at)
                <span class="pill">Verified</span>
            @else
                <span class="pill pill-tertiary">Unverified</span>
            @endif
        </div>

        <div class="mb-2 border-b border-gray-300">
            <label class="block mb-4 font-bold">Achievements</label>

            <div>
                @each('partials/achievement', $achievements, 'achievement')
            </div>
        </div>

        <div class="">
            <label class="block mb-2 font-bold">Account Settings</label>

            <form class="mb-4" method="POST">
                @csrf
                <input type="hidden" name="action" value="password" />

                <label class="block mb-2">Update your password</label>

                <label class="mb-1 block">
                    <input
                        class="form-input block w-full text-gray-500"
                        autocomplete="email"
                        value="{{ $user->email }}"
                        disabled
                    />
                </label>

                <label class="mb-1 block">
                    <input
                        class="form-input block w-full @if($errors->has('password')) border border-red-500 @endif"
                        name="password"
                        type="password"
                        placeholder="{{ __('Enter a New Password') }}"
                        autocomplete="new-password"
                        {{-- required --}}
                    />

                    @error('password')
                        <span class="mt-2 alert alert-sm" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </label>

                <label class="mb-2 block">
                    <input
                        class="form-input block w-full @if($errors->has('password_confirmation')) border border-red-500 @endif"
                        name="password_confirmation"
                        type="password"
                        placeholder="{{ __('Confirm your New Password') }}"
                        autocomplete="new-password"
                        {{-- required --}}
                    />

                    @error('password-confirm')
                        <span class="mt-2 alert alert-sm" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </label>

                <button class="block btn" type="submit">Update Password</button>
            </form>

            <form class="mb-4" method="POST">
                @csrf
                <label class="block mb-2">
                    Having issues with your achievements? Contact support, or reset them below.
                    <span class="italic">
                        If you just want to repeat the challenge, you can reset at anytime.
                    </span>
                </label>
                <button class="mb-1 block btn" type="submit" name="action" value="reset">Reset Achievements</button>
            </form>

            <form method="POST">
                <label class="block mb-2">
                    No longer using your diary? You can delete your account below, choose suspend if you may want to restore your account later or delete to permanently erase your account and associated data.
                    <span class="italic">
                        We'd really appreciate your feedback, and to learn why you're not finding the app useful. Please <a href="mailto:{{ config('variables.support_email') }}">email us</a>.
                    </span>
                </label>
                <button class="mr-1 btn btn-red" type="submit" name="action" value="suspend">Suspend Account</button>
                <button class="mr-1 btn btn-red" type="submit" name="action" value="delete">Delete Account</button>
            </form>
        </div>
    @endcomponent
@endsection
