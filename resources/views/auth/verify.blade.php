@extends('layouts.app')

@section('title')
    {{ __('Verify Your Email Address') }}
@endsection

@section('content')
    @component('components/card')
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p>
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
        </p>
    @endcomponent
@endsection
