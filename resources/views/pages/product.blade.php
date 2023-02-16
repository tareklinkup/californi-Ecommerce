@extends('layouts.master')

@push('css')
<style>
    #product-img { width: 100%; }
    .piclist {list-style: none; margin-top: 10px;}
    .piclist li {float: left; margin: 5px 10px 5px 0; cursor: pointer}
</style>
<link rel="stylesheet" href="{{ asset('/public/assets/website/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('/public/assets/website/product-zoom/css/jquery-picZoomer.css') }}">
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}l"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Product</li>
        </ol>
    </div>
</div>

<div class="row mb-15">
    <div class="col-md-10 col-md-offset-1">

        <div class="products">
            <div class="container">
                <div class="agileinfo_single">
                    
                    <div class="col-md-5 agileinfo_single_left">
                        <div class="zoom">
                            <img id="product-img" src="{{ asset($product->thumbnail) }}" class="img-responsive">
                        </div>
                        <ul class="piclist">
                            @foreach ($product->images as $image)
                                <li><img src="{{ asset($image->image) }}" height="80" alt=""></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-7 agileinfo_single_right">
                        <h2>{{ $product->name }}</h2>
                        <h5 class="single-page-brand">
                            <b>Brand :</b> {{ $product->brand->name }}
                        </h5>
                        <h5 class="single-page-category">
                            <b>Category :</b> {{ $product->category->name }}
                        </h5>
                        <div class="w3agile_description">
                            <h4>Description :</h4>
                            {!! $product->description !!}
                        </div>
                        <div class="snipcart-item block">
                            <div class="snipcart-thumb agileinfo_single_right_snipcart">
                                <h4 class="m-sing"> Price : 
                                    @if ($product->has_discount)
                                        <del> {{ number_format($product->price, 2) }} </del>
                                    @else
                                        {{ number_format($product->price, 2) }}
                                    @endif
                                        {{ $product->discount_price }} Tk
                                </h4>
                            </div>
                            <div class="snipcart-details agileinfo_single_right_details">
                                <fieldset>
                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_image" value="{{ $product->thumbnail }}">
                                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                                        <input type="number" name="product_quantity" value="1" min="1" class="quantity">
                                        @if ($product->discount_price)
                                        <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                                        @else
                                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                                        @endif
                                        <input type="submit" name="submit" value="Add to cart" class="button" />
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="newproducts-w3agile">
    <div class="container">
        <h3>Related Products</h3>

    <div class="agile_top_brands_grids">

        @foreach ($same_category_products as $same_category_product)
        <div class="col-md-3 top_brand_left">
            <div class="hover14 column">
                <div class="agile_top_brand_left_grid">
    
                    @if ($same_category_product->has_discount)
                        <div class="agile_top_brand_left_grid_pos">
                            <img src="{{ asset('/public/assets/website/') }}/images/offer.png" alt=" " class="img-responsive" />
                        </div>
                    @endif
    
                    <div class="agile_top_brand_left_grid1">
                        <figure>
                            <div class="snipcart-item block" >
                                <div class="snipcart-thumb">
                                    <a href="{{ route('product', $same_category_product->slug) }}">
                                        <img src="{{ asset($same_category_product->thumbnail) }}" />
                                    </a>
                                    <p>{{ Str::limit($same_category_product->name, 25) }}</p>
                                    <h4>
                                        @if ($same_category_product->has_discount)
                                           <del> {{ number_format($same_category_product->price, 2) }} </del>
                                        @else
                                            {{ number_format($same_category_product->price, 2) }}
                                        @endif
                                        {{ $same_category_product->discount_price }}
                                    </h4>
                                </div>
                                <div class="snipcart-details top_brand_home_details">
                                    <fieldset>
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $same_category_product->id }}">
                                            <input type="hidden" name="product_image" value="{{ $same_category_product->thumbnail }}">
                                            <input type="hidden" name="product_name" value="{{ $same_category_product->name }}">
                                            <input type="hidden" name="product_quantity" value="1">
                                            @if ($same_category_product->discount_price)
                                            <input type="hidden" name="product_price" value="{{  $same_category_product->discount_price }}">
                                            @else
                                            <input type="hidden" name="product_price" value="{{  $same_category_product->price }}">
                                            @endif
                                            <input type="submit" name="submit" value="Add to cart" class="button" />
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                        </figure>
                    </div>
    
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="clearfix"> </div>
    </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('/public/assets/website/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/public/assets/website/product-zoom/src/jquery.picZoomer.js') }}"></script>
<script>
    $(".zoom").picZoomer();
    $('.piclist li').on('click',function(event){
        var $pic = $(this).find('img');
        $('.zoom img').attr('src', $pic.attr('src'));
    });
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoWidth: false,
        autoHeight: false,
        autoplay: true,
        dots: true
    });
</script>
@endpush
