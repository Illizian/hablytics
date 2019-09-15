@extends('layouts.app')

@section('title')
    Your Profile
@endsection

@section('content')
    @component('components/card')
        <div class="mb-4 flex justify-center border-b border-gray-300">
            <div class="m-2 mb-4 w-32 h-32 flex justify-center items-center bg-purple-500 rounded-full">
                <span class="text-4xl text-white font-bold">
                    {{ App\Helpers\Format::initials($user->name) }}
                </span>
            </div>
        </div>

        <div>
            <label class="block font-bold">Email</label>

            {{ $user->email }}

            @if($user->email_verified_at)
                <span class="pill">Verified</span>
            @else
                <span class="pill pill-tertiary">Unverified</span>
            @endif
        </div>
    @endcomponent
@endsection
