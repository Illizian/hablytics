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

        <div class="mb-4 pb-4 border-b border-gray-300">
            <form method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-red">Delete account</button>
            </form>
        </div>

        <div>
            <label class="block mb-4 font-bold">Achievements</label>

            <div class="-m-2 flex flex-wrap">
                @each('partials/achievement', $user->achievements, 'achievement')
            </div>
        </div>
    @endcomponent
@endsection
