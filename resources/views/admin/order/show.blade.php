@extends('admin.admin_master')

@push('css')
<style>
    .table td, .table th {
        border-top: none;
    }
    .status .table td, .table th {
        padding: 5px;
    }
</style>
@endpush

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline">Order</h4>
                <a href="{{ route('admin.orders') }}" class="btn btn-info btn-sm float-right">Back</a>
                <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-dark btn-sm float-right">
                    <i class="fa fa-file"></i>
                </a>
            </div>
            <div class="card-body">

                @if (session('message'))
                    {!! session('message') !!}
                @endif

                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Customer Name</th>
                            <td>:</td>
                            <td>{{ $order->shipping_name ?? optional($order->user)->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>:</td>
                            <td>{{ $order->shipping_phone ?? optional($order->user)->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ optional($order->user)->email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td>{{ $order->shipping_address ?? optional($order->user)->address }}</td>
                        </tr>
                        <tr>
                            <th>Region</th>
                            <td>:</td>
                            <td>{{ $order->shipping_region ? ucfirst($order->shipping_region) : ucfirst(optional($order->user)->region) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Order Number</th>
                            <td>:</td>
                            <td>{{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <th>Sub-Total</th>
                            <td>:</td>
                            <td>{{ $order->sub_total }}</td>
                        </tr>
                        <tr>
                            <th>VAT ({{ $order->vat }}%)</th>
                            <th>:</th>
                            <td>{{ number_format(($order->sub_total * $order->vat) / 100, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td>:</td>
                            <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Charge</th>
                            <td>:</td>
                            <td>{{ $order->shipping_charge }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>:</td>
                            <td>{{ ucwords(str_replace(['-', ''], ' ', $order->payment_method)) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="clearfix"></div>

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

                <div class="status">
                    <div class="float-left">
                        <table class="table">
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge badge-info">Processing</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge badge-success">Delivered</span>
                                    @elseif ($order->status == 3)
                                        <span class="badge badge-danger">Canceled</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($order->delivered_at)
                            <tr>
                                <th>Delivered</th>
                                <td>:</td>
                                <td>{{ date('D d F, Y', strtotime($order->delivered_at)) }}</td>
                            </tr>
                            @endif
                            @if ($order->processing_at)
                            <tr>
                                <th>Processing</th>
                                <td>:</td>
                                <td>{{ date('D d F, Y', strtotime($order->processing_at)) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Order</th>
                                <td>:</td>
                                <td>{{ date('D d F, Y', strtotime($order->created_at)) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="float-right">
                        @if ($order->status != 3)
                            @if ($order->status == 0)
                            <a href="{{ route('admin.order.processing', $order->id) }}" class="btn btn-info btn-sm">
                                Processing <i class="fa fa-arrow-right"></i>
                            </a>
                            @elseif ($order->status == 1)
                            <a href="{{ route('admin.order.delivered', $order->id) }}" class="btn btn-success btn-sm">
                                Delivered <i class="fa fa-arrow-right"></i>
                            </a>
                            @endif
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
