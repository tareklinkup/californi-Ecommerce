@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('REGISTER HERE') }}</h2>

        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <small class="text-muted warning-text">Name is required *</small>
                @error('name')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email">
                <small class="text-muted warning-text">Email is required *</small>
                @error('email')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input type="text" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" placeholder="Phone" required>
                <small class="text-muted warning-text">Phone is required *</small>
                @error('phone')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <textarea name="address" placeholder="Address" class="@error('phone') is-invalid @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <select name="region" class="@error('region') is-invalid @enderror">
                    <option value="" hidden>--- Select Region/State ---</option>
                    <option value="dhaka">Dhaka</option>
                    <option value="chittagong">Chittagong</option>
                    <option value="khulna">Khulna</option>
                    <option value="barisal">Barisal</option>
                    <option value="mymensingh">Mymensingh</option>
                    <option value="rajshahi">Rajshahi</option>
                    <option value="sylhet">Sylhet</option>
                    <option value="rangpur">Rangpur</option>
                </select>
                @error('region')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                @error('password')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                <input type="submit" value="Register">
            </form>
        </div>
        <h4>For Registered People</h4>
        <p><a href="{{ route('login') }}">Already registered</a> (Or) go back to <a href="index.html">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
    </div>
</div>
@endsection
