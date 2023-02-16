@extends('layouts.master')

@section('content')
<div class="login">
    <div class="container">
        <h2>{{ __('Profile') }}</h2>

        <div class="login-form-grids animated wow slideInUp">

            @if (session('message'))
                {!! session('message') !!}
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                <small class="text-muted warning-text">Name is required *</small>
                @error('name')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <input type="text" class="@error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}" name="phone" placeholder="Phone" required>
                <small class="text-muted warning-text">Phone is required *</small>
                @error('phone')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <textarea name="address" placeholder="Address" class="@error('phone') is-invalid @enderror">{{ Auth::user()->address }}</textarea>
                @error('address')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <select name="region" class="@error('region') is-invalid @enderror">
                    <option value="" hidden>--- Select Region/State ---</option>
                    @foreach ($regions as $region)
                    <option value="{{ $region }}" {{ $region == Auth::user()->region ? 'selected' : '' }}>{{ ucfirst($region) }}</option>
                    @endforeach
                </select>
                @error('region')
                    <div class="mt-5">
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    </div>
                @enderror

                <a href="javascript:void(0)" id="password-edit">Password Edit</a>

                <div id="password_update" {{ session('old_password') || $errors->has('new_password') ? '' : 'style=display:none' }}>
                    <input type="password" class="@error('old_password') is-invalid @enderror" name="old_password" placeholder="Old Password" autocomplete="new-password">
                    @if (session('old_password'))
                        <div class="mt-5">
                            <span class="invalid-feedback" role="alert">
                                <span>{{ session('old_password') }}</span>
                            </span>
                        </div>
                    @enderror

                    <input type="password" class="@error('new_password') is-invalid @enderror" name="new_password" placeholder="New Password" autocomplete="new-password">
                    @error('new_password')
                        <div class="mt-5">
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        </div>
                    @enderror

                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                </div>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    (function($) {
        $(document).on('click', '#password-edit', function() {
            $('#password_update').toggle();
        });
    })(jQuery);    
</script>    
@endpush
