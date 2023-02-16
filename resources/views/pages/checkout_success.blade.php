@extends('layouts.master')

@push('css')
<style>
    .login-form-grids {
        width: auto !important;
        margin: 0 0 2.5em 0 !important;
        text-align: center;
    }
    .login-form-grids h2 {
        color: green !important;
        font-size: 25px !important;
    }
    .login-form-grids p, .login-form-grids h4 {
        margin-top: 10px;
    }
    .login-form-grids a {
        margin-top: 40px;
    }
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Checkout Success</li>
        </ol>
    </div>
</div>

<div class="checkout">
    <div class="container">

        <div class="login-form-grids">
            <h2>Your order has been placed!</h2>
            <h4>Your order number : {{ $order->order_number }}</h4>
            <p>Thanks for shopping with us!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
        </div>

    </div>

</div>
@endsection


@push('js')
    
@endpush
