@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">

        <h2>{{ __('Reset Password') }}</h2>

        <div class="login-form-grids">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <input placeholder="E-Mail Address" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" | autocomplete="email" autofocus>
                @error('email')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</strong>
                        </span>
                    </div>
                @enderror


                <input placeholder="Password" type="password" class="@error('password') is-invalid @enderror" name="password" | autocomplete="new-password">
                @error('password')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</strong>
                        </span>
                    </div>
                @enderror

                <input placeholder="Confirm Password" type="password" name="password_confirmation" | autocomplete="new-password">

                <input type="submit" value="Reset Password">
            </form>
        </div>
    </div>
</div>
@endsection
