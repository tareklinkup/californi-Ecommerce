@extends('layouts.master')

@push('css')

@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Cart</li>
        </ol>
    </div>
</div>

<div class="checkout">
    <div class="container">
        <h2>Your shopping cart contains : <span><span class="items">{{ count($items) }}</span> Products</span></h2>
        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Product</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>

                @php($i=0)
                @if (count($items) > 0)
                    @foreach($items as $key => $item)
                        <tr class="rem1">
                            <td class="invert">{{ ++$i }}</td>
                            <td class="invert">
                                <img src="{{ asset($item['product_image']) }}" alt=" " height="50">
                            </td>
                            <td class="invert">{{ $item['product_name'] }}</td>
                            <td class="invert">
                                <div class="quantity">
                                    <div class="quantity-select">
                                        <div class="entry value-minus" data-id="{{ $key }}">&nbsp;</div>
                                        <div class="entry value"><span>{{ $item['product_quantity'] }}</span></div>
                                        <div class="entry value-plus active" data-id="{{ $key }}">&nbsp;</div>
                                    </div>
                                </div>
                            </td>
                            <td class="invert">{{ $item['product_price'] }}</td>
                            <td class="invert total_price">
                                {{ number_format($item['product_price'] * $item['product_quantity'], 2) }}
                            </td>
                            <td class="invert">
                                <button type="button" data-id="{{ $key }}" class="close"> 
                                    <i class="fa fa-times"></i>    
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="7" id="status" style="display:none">
                        Your shopping cart is empty!
                    </td>
                </tr>
            </tbody>
        </table>
        </div>

        <div class="total">
            <div class="right">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-right"><strong>Sub-Total :</strong></td>
                            <td class="text-right"><span class="sub_total">{{ number_format($sub_total, 2) }}</span> Taka</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>VAT ({{ $vat }} %) :</strong></td>
                            <td class="text-right">{{ number_format(($sub_total * $vat) / 100, 2) }} Taka</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Total :</strong></td>
                            <td class="text-right"><span class="grand_total">{{ number_format($grand_total, 2) }}</span> Taka</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-80">
            <div class="buttons">
                <div class="left">
                    <a href="{{ route('home') }}" class="btn btn-default">Continue Shopping</a>
                </div>
                <div class="right">
                    <a href="{{ route('checkout') }}" class="btn btn-default" {{ count($items) < 1 ? 'disabled' : '' }}>Checkout</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@push('js')
<script>
    (function($) {
    
        cartStatus(1);
    
        $('.value-plus').on('click', function(){
            var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) + 1;
            divUpd.text(newVal);
            updateQuantity($(this), newVal);
        });
    
        $('.value-minus').on('click', function(){
            var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) - 1;
            if(newVal >= 1) {
                divUpd.text(newVal);
                updateQuantity($(this), newVal);
            }
        });
    
        function updateQuantity(element, quantity) {
            var route = '{{ route('quantity.update', [':id', ':quantity']) }}';
            var _route = route.replace(':id', element.data('id'));
            var _url = _route.replace(':quantity', quantity);
            $.ajax({
                url: _url,
                method: 'GET',
                success: function(response) {
                    $(element).parents('tr.rem1').children('.total_price').text(response.total_price);
                    $('.sub_total').text(response.sub_total.toFixed(2));
                    $('.vat').text(response.vat);
                    $('.grand_total').text(response.grand_total.toFixed(2));
                    $('.total_item').text(response.total_quantity);
                }
            });
        }
    
        function cartStatus(length) {
            if ($('.timetable_sub tbody tr').length == length) {
                $('#status').show();
            }
        }
    
        $('.close').on('click', function(){
            if ('' != $(this).data('id')) {
                var route = '{{ route('cart.item.remove', ':id') }}';
                var url = route.replace(':id', $(this).data('id'));
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $(this).closest('tr').fadeOut(function(){
                            $(this).closest('tr').remove();
                        });
                        $('.sub_total').text((response.sub_total).toFixed(2));
                        $('.vat').text(response.vat);
                        $('.grand_total').text((response.grand_total).toFixed(2));
                        $('.total_item').text(response.total_quantity);
                        $('.items').text(response.items);
                    }.bind(this)
                });
            }
            cartStatus(2);
        });
    
    })(jQuery);
    </script>
@endpush
