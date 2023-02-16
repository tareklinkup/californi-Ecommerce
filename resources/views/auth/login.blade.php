@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('Login') }}</h2>

        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input name="email" value="{{ old('email') }}" placeholder="Email Address" type="email" class="@error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                @error('email')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input name="password" placeholder="Password" type="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                @error('password')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <label class="remember" for="remember">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember Me') }}
                </label>

                <input type="submit" value="Login">
            </form>
            <div class="forgot">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
        <h4>For New People</h4>
        <p><a href="{{ route('register') }}">Register Here</a> (Or) go back to <a href="index.html">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
    </div>
</div>
@endsection
