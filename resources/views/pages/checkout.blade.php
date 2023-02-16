@extends('layouts.master')

@push('css')
<style>
.login-form-grids {
    width: 100% !important;
    margin-top: 1em !important;
    margin-bottom: 3em !important;
    padding: 1.5em !important;
}
.login-form-grids:first-child {
    margin-bottom: 1em !important;
}
table.timetable_sub {
    margin: 25px auto 0 !important;
}
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Checkout</li>
        </ol>
    </div>
</div>

<div class="checkout">
    <div class="container">

        <form action="{{ route('order.confirm.process') }}" method="post">
            @csrf

            <div class="col-md-8">

                <div class="login-form-grids">
    
                    <h2> <i class="fa fa-book"></i> Your Account</h2>
    
                    <div class="col-md-6">
                        <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ Auth::user()->name }}"  autocomplete="name" autofocus>
                        @error('name')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
        
                        <input type="text" class="@error('phone') is-invalid @enderror" value="{{ Auth::user()->phone ?? old('phone') }}" name="phone" placeholder="Phone" >
                        @error('phone')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror

                        <label for="same" class="payment-shipping-same">
                            <input type="checkbox" name="same_as_account" id="same" {{ old('same_as_account') ? 'checked' : '' }}>
                            <p>My shipping information same as account.</p>
                        </label>
                    </div>
    
                    <div class="col-md-6">
                        <select name="region" class="@error('region') is-invalid @enderror">
                            <option value="" hidden>--- Select Region/State ---</option>
                            @foreach ($regions as $region)
                            <option value="{{ $region }}" {{ ($region == Auth::user()->region)  || ($region == old('region')) ? 'selected' : ''}}>
                                {{ ucfirst($region) }}
                            </option>
                            @endforeach
                        </select>
                        @error('region')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror

                        <textarea name="address" placeholder="Address" class="@error('address') is-invalid @enderror">{{ Auth::user()->address ?? old('address') }}</textarea>
                        @error('address')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
                    </div>
    
                    <div class="clearfix"></div>
    
                </div>
                
                <div class="login-form-grids" id="shipping_information">
        
                    <h2> <i class="fa fa-book"></i> Shipping Information</h2>
    
                    <div class="col-md-6">
                        <input type="text" class="@error('shipping_name') is-invalid @enderror" name="shipping_name" placeholder="Name" value="{{ old('shipping_name') }}"  autocomplete="name" autofocus>
                        @error('shipping_name')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
        
                        <textarea name="shipping_address" placeholder="Address" class="@error('shipping_address') is-invalid @enderror">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <input type="text" class="@error('shipping_phone') is-invalid @enderror" value="{{ old('shipping_phone') }}" name="shipping_phone" placeholder="Phone" >
                        @error('shipping_phone')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
        
                        <select name="shipping_region" class="@error('shipping_region') is-invalid @enderror">
                            <option value="" hidden>--- Select Region/State ---</option>
                            @foreach ($regions as $region)
                            <option value="{{ $region }}" {{ $region == old('shipping_region') ? 'selected' : '' }}>
                                {{ ucfirst($region) }}
                            </option>
                            @endforeach
                        </select>
                        @error('shipping_region')
                            <div class="mt-5">
                                <span class="invalid-feedback" role="alert">
                                    <span>{{ $message }}</span>
                                </span>
                            </div>
                        @enderror
                    </div>
    
                    <div class="clearfix"></div>
                        
                </div>
    
            </div>
    
            <div class="col-md-4">
                <table class="timetable_sub">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
        
                        @php($i=0)
                        @if (count($items) > 0)
                            @foreach($items as $key => $item)

                                <input type="hidden" name="product[{{ $key }}][quantity]" value="{{ $item['product_quantity'] }}">
                                <input type="hidden" name="product[{{ $key }}][price]" value="{{ $item['product_price'] }}">

                                <tr class="rem1">
                                    <td class="invert">{{ ++$i }}</td>
                                    <td class="invert">{{ $item['product_name'] }}</td>
                                    <td class="invert">
                                        <div class="entry value"><span>{{ $item['product_quantity'] }}</span></div>
                                    </td>
                                    <td class="invert total_price">
                                        {{ number_format($item['product_price'] * $item['product_quantity'], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
    
                <table class="table checkout-info">
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>Sub-Total :</strong></td>
                            <td class="text-right">
                                <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                                <span class="sub_total">{{ number_format($sub_total, 2) }}</span> Taka
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>VAT :</strong></td>
                            <td class="text-right">
                                <input type="hidden" name="vat" value="{{ $vat }}">
                                <span class="vat">{{ $vat }}</span> %
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Total :</strong></td>
                            <td class="text-right">
                                <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                                <span class="grand_total">{{ number_format($grand_total, 2) }}</span> Taka
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Shipping Charge :</strong></td>
                            <td class="text-right">
                                <input type="hidden" name="shipping_charge" value="{{ 50 }}">
                                {{ $shipping_charge }} Taka
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="login-form-grids">

                    <div><strong>Payment Method</strong></div>

                    @error('payment_method')
                        <div class="mt-5">
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        </div>
                    @enderror

                    <div style="margin:10px">
                        <input type="radio" name="payment_method" value="bkash" {{ old('payment_method') == 'bkash' ? 'checked' : '' }} id="bkash">
                        <label for="bkash">Bkash</label>
                    </div>
                    <div style="margin:10px">
                        <input type="radio" name="payment_method" value="rocket" {{ old('payment_method') == 'rocket' ? 'checked' : '' }} id="rocket">
                        <label for="rocket">Rocket</label>
                    </div>
                    <div style="margin:10px">
                        <input type="radio" name="payment_method" value="cash-on-delivery" {{ old('payment_method') == 'cash-on-delivery' ? 'checked' : '' }} id="cod">
                        <label for="cod">Cash On Delivery</label>
                    </div>
                    <input type="submit" value="Confirm Order" class="btn btn-primary btn-block confirm-order-button">
                </div>
    
            </div>

        </form>

    </div>

</div>
@endsection


@push('js')
    <script>
        sameCheck($('#same'));
        $(document).on('click', '#same', function() {
            sameCheck($(this));
        });
        function sameCheck(element) {
            if ($(element).is(':checked')) {
                $('#shipping_information').hide();
            } else {
                $('#shipping_information').show();
            }
        }
    </script>
@endpush
