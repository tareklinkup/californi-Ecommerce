@extends('layouts.master')

@push('css')
<link href="{{ asset('/public/assets/website/css/skdslider.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/public/assets/website/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
@endpush


@section('content')

<div class="slider-wrapper">
    <div class="slider-wrapper-inner">
        <div class="clearfix">
            <div class="slider">
                <!-- main-slider -->
                @if ($slider->count())
                <ul id="demo1">

                    @foreach ($slider as $s1)
                        <li>
                            <img src="{{ asset($s1->image) }}" alt=""  class="img-responsive"/>
                            <!--Slider Description example-->
                            <div class="slide-desc">
                                <h3>{{ $s1->heading }}</h3>
                            </div>
                        </li>
                    @endforeach

                </ul>
                @endif
            </div>
            <div class="banner-group">
                <div class="clearfix">
                    <div class="banner-item-col">
                        <div class="banner-item">
                            <img src="{{ asset($_settings->banner_1) }}" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="banner-item-col">
                        <div class="banner-item">
                            <img src="{{ asset($_settings->banner_2) }}" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="banner-item-col">
                        <div class="banner-item">
                            <img src="{{ asset($_settings->banner_3) }}" alt="" class="img-responsive">
                        </div>
                    </div>
                    <div class="banner-item-col">
                        <div class="banner-item">
                            <img src="{{ asset($_settings->banner_4) }}" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="top-brands">

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="home-cats">
                    <h4 class="home-cat-head">Categories</h4>
                    <ul class="list-group">
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('category.products', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                                @foreach ($category->children as $item)   
                                <ul>
                                    <li><a href="{{ route('category.products', $item->slug) }}"><i class="fa fa-arrow-right" aria-hidden="true"></i>{{ $item->name }}</a></li>
                                </ul>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>	

            </div>
            <div class="col-md-9">

                <h2 class="recent-products-heading">Our Products</h2>
                <div class="agile_top_brands_grids">

                    @php($fc = 0)
                    @foreach ($recent_products as $recent_product)

                        @if ($fc == 4)
                            <div class="clearfix"></div>
                            @php($fc = 0)
                        @endif
                        @php($fc++)
                        
                        <div class="col-md-3 top_brand_left">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid">

                                    @if ($recent_product->has_discount)
                                        <div class="agile_top_brand_left_grid_pos">
                                            <img src="{{ asset('/public/assets/website/') }}/images/offer.png" alt=" " class="img-responsive" />
                                        </div>
                                    @endif

                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block" >
                                                <div class="snipcart-thumb">
                                                    <a href="{{ route('product', $recent_product->slug) }}">
                                                        <img src="{{ asset($recent_product->thumbnail) }}" />
                                                    </a>
                                                    <p>{{ Str::limit($recent_product->name, 25) }}</p>
                                                    <h4>
                                                        @if ($recent_product->has_discount)
                                                        <del> {{ number_format($recent_product->price, 2) }} TK </del>
                                                        @else
                                                            {{ number_format($recent_product->price, 2) }}
                                                        @endif
                                                        {{ $recent_product->discount_price }} TK
                                                    </h4>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="clearfix"></div>

                    <div class="view-all-btn">
                        <a href="{{ route('recent.items') }}">View All Items</a>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>

</div>


<!--brands-->
<div class="brands">
    <div class="container">
        <h3>Brand Store</h3>
        <div class="brands-agile">
            <div class="owl-carousel">
                @foreach ($brands as $brand)
                    <div>
                        <a href="{{ route('brand.products', $brand->slug) }}">
                            <div class="brand-item">
                                <img src="{{ asset($brand->thumbnail) }}" alt="">
                                <p>{{ $brand->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--//brands-->

<!-- new -->
<div class="newproducts-w3agile">
<div class="container">
    <h3>New offers</h3>
    <div class="agile_top_brands_grids">

        @php($fc = 0)
        @foreach ($new_offer_products as $new_offer_product)

            @if ($fc == 6)
                <div class="clearfix"></div>
                @php($fc = 0)
            @endif
            @php($fc++)
            
            <div class="col-md-2 top_brand_left">
                <div class="hover14 column">
                    <div class="agile_top_brand_left_grid">
        
                        @if ($new_offer_product->has_discount)
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="{{ asset('/public/assets/website/') }}/images/offer.png" alt=" " class="img-responsive" />
                            </div>
                        @endif
        
                        <div class="agile_top_brand_left_grid1">
                            <figure>
                                <div class="snipcart-item block" >
                                    <div class="snipcart-thumb">
                                        <a href="{{ route('product', $new_offer_product->slug) }}">
                                            <img src="{{ asset($new_offer_product->thumbnail) }}" />
                                        </a>
                                        <p>{{ Str::limit($new_offer_product->name, 20) }}</p>
                                        <h4>
                                            @if ($new_offer_product->has_discount)
                                            <del> {{ number_format($new_offer_product->price, 2) }} TK </del>
                                            @else
                                                {{ number_format($new_offer_product->price, 2) }}
                                            @endif
                                            {{ $new_offer_product->discount_price }} TK
                                        </h4>
                                    </div>
                                </div>
                            </figure>
                        </div>
        
                    </div>
                </div>
            </div>
        @endforeach
        
        <div class="clearfix"> </div>

        <div class="view-all-btn">
            <a href="{{ route('new.offer.items') }}">View All Items</a>
        </div>

    </div>
    
</div>
</div>
<!-- //new -->
@endsection


@push('js')
<!-- main slider-banner -->
<script src="{{ asset('/public/assets/website/js/skdslider.min.js') }}"></script>
<script src="{{ asset('/public/assets/website/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({
                'delay':5000,
                'animationSpeed': 2000,
                'showNextPrev':true,
                'showPlayButton':true,
                'autoSlide':true,
                'animationType':'fading'
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                autoWidth: false,
                autoHeight: false,
                autoplay: true,
                dots: false,
                items: 5,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:false,
                        loop:false
                    }
                }
            });
		});
</script>
<!-- //main slider-banner -->
@endpush
