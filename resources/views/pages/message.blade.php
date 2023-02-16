@extends('layouts.master')

@push('css')
<style>
    .about {
        padding: 2em 0 5em !important;
    }
    .alert {
        margin-top: 10px;
        margin-bottom: -5px;
    }
    .w3_agileits_contact_grid_right textarea {
        font-weight: normal !important;
    }
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Message</li>
        </ol>
    </div>
</div>

<div class="about">
    <div class="w3_agileits_contact_grids">
        <div class="col-md-8 w3_agileits_contact_grid_right col-md-offset-2">
            <h2 class="w3_agile_header">Leave a<span> Message</span></h2>

            <form action="{{ route('message.store') }}" method="post">
                @csrf

                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @elseif (session('error'))
                    <p class="alert alert-danger">{{ session('error') }}</p>
                @endif

                <span class="input input--ichiro">
                    <input id="name" name="name" value="{{ old('name') }}" class="input__field input__field--ichiro" required type="text">
                    <label class="input__label input__label--ichiro" for="name">
                        <span class="input__label-content input__label-content--ichiro">Your Name</span>
                    </label>
                </span>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="input input--ichiro">
                    <input id="email" name="email" value="{{ old('email') }}" class="input__field input__field--ichiro" required type="email">
                    <label class="input__label input__label--ichiro" for="email">
                        <span class="input__label-content input__label-content--ichiro">Your Email</span>
                    </label>
                </span>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="input input--ichiro">
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="input__field input__field--ichiro" required type="phone">
                    <label class="input__label input__label--ichiro" for="phone">
                        <span class="input__label-content input__label-content--ichiro">Your phone</span>
                    </label>
                </span>
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <textarea name="message" placeholder="Your message here..." required>{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection


@push('js')
    
@endpush
