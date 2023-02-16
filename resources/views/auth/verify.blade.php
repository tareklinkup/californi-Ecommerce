@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('Verify Your Email Address') }}</h2>

        <div class="login-form-grids">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}, <br> <br>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
