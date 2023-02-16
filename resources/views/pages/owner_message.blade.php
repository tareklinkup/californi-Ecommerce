@extends('layouts.master')

@push('css')
<style>
.owner-image {
    text-align: center;
    margin-bottom: 30px;
}
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Owner Message</li>
        </ol>
    </div>
</div>

<div class="container">

    <div class="about-us">
        <p class="owner-image"><img src="{{ $_settings->owner_image }}" alt=""></p>
        <p class="owner-message">
            {{ $_settings->owner_message }}
        </p>
    </div>

</div>

@endsection


@push('js')
    
@endpush
