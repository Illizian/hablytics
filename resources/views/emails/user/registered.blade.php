@extends('layouts.email')

@section('header')
    <p>
        New User Registration
    </p>
@endsection

@section('content')
    <img src="https://media.giphy.com/media/l0MYt5jPR6QX5pnqM/giphy.gif" style="display: block; margin: 0 auto; max-width: 100%;" />

    <p>
        A new user has registered for {{ config('app.name') }}.
    </p>

    <p>
        {{ $user->name }}
        <strong>
            [{{ $user->email }}]
        </strong>
    </p>

    @unless($user->approved)
        <p>The user requires approval.</p>
    @endunless
@endsection
