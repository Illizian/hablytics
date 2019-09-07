@extends('layouts.app')

@section('title')
    {{ __('Waiting for Approval') }}
@endsection

@section('content')
    @component('components/card')
        <div class="alert alert-info" role="alert">
            <div>
                <span class="font-bold">Info:</span>
                Registrations are being confirmed in batches whilst we're in Alpha.
            </div>
        </div>

        <div class="mb-2">
            <h2 class="mb-2 font-bold text-lg">
                Your account is waiting for an administrator's approval.
            </h2>

            <p>
                You will receive an email when your account has been approved, otherwise please check back later.
            </p>
        </div>

        <a href="mailto:alex@alexscotton.com" class="btn">Can't wait? Email me!</a>
    @endcomponent
@endsection
