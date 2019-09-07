@extends('layouts.landing')

@section('content')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="p-4">
            @svg('hero-image', 'w-full')

            <div class="text-center mt-8">
                @auth
                    <a class="btn btn-lg inline-block mx-2" href="{{ route('diary.index') }}">
                        Goto App
                    </a>
                @endauth

                @guest
                    <a class="btn btn-lg inline-block mx-2" href="{{ route('login') }}">
                        Login
                    </a>

                    <a class="btn btn-lg inline-block mx-2" href="{{ route('register') }}">
                        Register
                    </a>
                @endguest
            </div>
        </section>

@endsection
