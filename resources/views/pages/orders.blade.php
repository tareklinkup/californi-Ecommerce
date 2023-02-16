@extends('layouts.master')

@push('css')
<style>
.total {
    padding-top: 0 !important;
}
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Your Orders</li>
        </ol>
    </div>
</div>

<div class="order">
    <div class="container">

        <div class="col-md-4 products-left">
            <div class="orders">
                <h2> Orders </h2>
                <ul>
                    @foreach ($orders as $_order)
                    <li class="{{ strtoupper($order_number) == $_order->order_number ? 'active-order-menu' : '' }}">
                        <a href="{{ route('order', strtolower($_order->order_number)) }}">
                            <span>{{ $_order->order_number }}</span>
                            <small>{{ date('D d F, Y', strtotime($_order->created_at)) }}</small>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>																																												
        </div>
        <div class="col-md-8 products-right">
            @if (isset($order))
            <div class="order-heading">
                <p class="float-left">Order Details : </p>
                <p class="float-right">
                    Status : 
                    @if ($order->status == 0)
                        <span class="badge badge-warning">Pending</span>
                    @elseif ($order->status == 1)
                        <span class="badge badge-info">Processing</span>
                    @elseif ($order->status == 2)
                        <span class="badge badge-success">Delivered</span>
                    @elseif ($order->status == 3)
                        <span class="badge badge-danger">Canceled</span>
                    @endif
                </p>
                <div class="clearfix"></div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Product</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                @foreach ($order->order_products as $opk => $order_product)
                <tr>
                    <td>{{ ++$opk }}</td>
                    <td>{{ $order_product->product->product_code }}</td>
                    <td><img src="{{ asset($order_product->product->thumbnail) }}" height="50" alt=""></td>
                    <td>{{ $order_product->product->name }}</td>
                    <td>{{ $order_product->quantity }}</td>
                    <td>{{ $order_product->price }}</td>
                    <td>{{ number_format($order_product->price * $order_product->quantity, 2) }}</td>
                </tr>
                @endforeach
            </table>

            <div class="total">
                <div class="left">
                    <p class="shipping-heading">Shipping Information</p>
                    <table class="table shipping-info">
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $order->shipping_name ?? Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{ $order->shipping_phone ?? Auth::user()->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $order->shipping_address ?? Auth::user()->address }}</td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td>:</td>
                            <td>{{ $order->shipping_region ? ucfirst($order->shipping_region) : ucfirst(Auth::user()->region) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="right">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-right"><strong>Sub-Total :</strong></td>
                                <td class="text-right">{{ number_format($order->sub_total, 2) }} Taka</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>VAT ({{ $order->vat }} %) :</strong></td>
                                <td class="text-right">{{ number_format(($order->sub_total * $order->vat) / 100, 2) }} Taka</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Total :</strong></td>
                                <td class="text-right">{{ number_format($order->total, 2) }} Taka</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($order->status == 0)
                    <div>
                        <a href="{{ route('order.cancel', strtolower($order->order_number)) }}" class="order-cancel-btn" onclick="return confirm('Are you sure to cancel this order?')">Cancel Order</a>
                    </div>
                    @endif
                </div>
            </div>
            @else
            <p class="select-order-msg">Please select an order first.</p>
            @endif
        </div>
        <div class="clearfix"> </div>

    </div>

</div>
@endsection


@push('js')
    
@endpush
