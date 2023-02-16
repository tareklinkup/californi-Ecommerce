@extends('admin.admin_master')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="clearfix">
            <button onclick="printT('invoice')" class="btn btn-sm btn-dark mb-2 float-left">
                <i class="fa fa-print"></i>
            </button>
            <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-warning float-right">Cancel</a>
        </div>
        <div id="invoice">
            <div class="p-5">
                <div class="border-bottom mb-3">
                    <div class="row">
                        <div class="col">
                           
                            <h3 style="font-size: 22px;" class="font-weight-normal mt-4 company-name"> <img style="height: 60px;" src="{{ asset('public/invoice-logo.jpg') }}"> {{ $_settings->shop_name }}</h3>
                        </div>
                        <div class="col text-right">
                            <h5>{{ $_settings->shop_name }}</h5>
                            <p class="text">
                                {{ $_settings->address }} <br>
                                {{ $_settings->phone_1 }} <br>
                                {{ $_settings->email_1 }}
                            </p>
                            @php
                                $_shipping = $_settings->shipping_charge;
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="mb-2">INVOICE TO:</p>
                        <h5>{{ $order->shipping_name ?? $order->user->name }}</h5>
                        <p class="text">
                            <b>Address :</b> {{ $order->shipping_address ?? $order->user->address }} <br>
                            <b>Phone :</b> {{ $order->shipping_phone ?? $order->user->phone }}
                        </p>
                    </div>
                    <div class="col text-right">
                        <h5>Order {{ $order->order_number }}</h5>
                        <p class="text" style="margin-bottom:0">
                            <b>Date of Order :</b> {{ date('d-m-Y', strtotime($order->created_at)) }}
                        </p>
                        <p class="text text-dark">
                            <b>Payment Method :</b> {{ ucwords(str_replace(['-', ''], ' ', $order->payment_method)) }}
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        @php($sub_total = 0)
                        @foreach ($order->order_products as $key => $op)
                            @php($sub_total += ($op->price * $op->quantity))
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ optional($op->product)->name }}</td>
                            <td>{{ number_format($op->price, 2) }}</td>
                            <td>{{ $op->quantity }}</td>
                            <td>{{ number_format($op->price * $op->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-normal">Thank you!</h3>
                    </div>
                    <div class="col">
                        <table class="table table-borderless total">
                            <tr>
                                <th>Sub Total</th>
                                <th class="colon">:</th>
                                <td>{{ number_format($sub_total, 2) }}</td>
                            </tr>
                            <tr>
                                <th>TAX ({{ $vat }}%)</th>
                                <th>:</th>
                                <td>{{ number_format(($sub_total * $vat) / 100, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Shipping Charge</th>
                                <th>:</th>
                                <td>{{ number_format(($_shipping), 2) }}</td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <th>:</th>
                                <td>{{ number_format($sub_total + $_shipping + (($sub_total * $vat) / 100), 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function printT(el) {
        var rp = document.body.innerHTML;
        var pc = document.getElementById(el).innerHTML;
        document.body.innerHTML = pc;
        window.print();
        document.body.innerHTML = rp;
    }
</script>
@endpush

@push('css')
<style>

/* ----------------------- */

* {
    letter-spacing: 1px;
}
.company-name {
    font-size: 40px;
}
#invoice {
    background: white;
}
.table {
    font-size: 18px;
}
.text {
    font-size: 17px;
    line-height: 30px !important;
}
.total {
    width: 80%;
    margin-left: auto;
    font-size: 20px;
}
.total th, .total td {
    padding: 0;
    text-align: right;
}

.colon {
    width: 10%;
}
</style>
@endpush