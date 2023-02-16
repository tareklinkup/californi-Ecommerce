@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('Reset Password') }}</h2>

    <div class="login-form-grids">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" autocomplete="email" autofocus>

            @error('email')
                <div class="mt-5">
                    <span class="invalid-feedback" role="alert">
                        <span>{{ $message }}</strong>
                    </span>
                </div>
            @enderror

            <input type="submit" value="Send Password Reset Link">
        </form>
    </div>

</div>
</div>
@endsection
