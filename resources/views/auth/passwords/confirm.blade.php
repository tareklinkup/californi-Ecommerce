@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('Confirm Password') }}</h2>

        <div class="login-form-grids">
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf


                <input placeholder="Password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</strong>
                        </span>
                    </div>
                @enderror

                <input type="submit" value="Confirm Password">

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
