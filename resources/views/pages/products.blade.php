@extends('layouts.master')

@push('css')
<style>
    img {
        height: 100px;
    }
    .agile_top_brands_grids, .agile_top_brands_grids .top_brand_left {
        margin-top: 0 !important;
    }
    .agile_top_brands_grids .top_brand_left {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Products</li>
        </ol>
    </div>
</div>

<div class="products">
    <div class="container">
        <div class="col-md-3 products-left">
            <div class="home-cats">
                <h4 class="home-cat-head">
                    @if ($mode == 'category')
                        Categories
                    @elseif ($mode == 'brand')
                        Brands
                    @endif
                </h4>
                <ul class="list-group">
                    @if ($mode == 'category')
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('category.products', $category->slug) }}" class="{{ $slug == $category->slug ? 'active' : '' }}">
                                    {{ $category->name }}
                                </a>
                                @foreach ($category->children as $item)   
                                <ul>
                                    <li><a href="{{ route('category.products', $item->slug) }}"><i class="fa fa-arrow-right" aria-hidden="true"></i>{{ $item->name }}</a></li>
                                </ul>
                                @endforeach
                            </li>
                        @endforeach
                    @elseif ($mode == 'brand')
                        @foreach ($brands as $brand)
                            <li class="list-group-item">
                                <a href="{{ route('brand.products', $brand->slug) }}" class="{{ $slug == $brand->slug ? 'active' : '' }}">
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    
                </ul>
            </div>																																												
        </div>
        <div class="col-md-9 products-right">

            <div class="agile_top_brands_grids">

                @php($counter = 0)
                @forelse ($products as $product)

                @if ($counter == 4)
                    <div class="clearfix"></div>
                    @php($counter = 0)
                @endif

                @php($counter++)

                <div class="col-md-3 top_brand_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid">
            
                            @if ($product->has_discount)
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="{{ asset('/public/assets/website/') }}/images/offer.png" alt=" " class="img-responsive" />
                                </div>
                            @endif
            
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block" >
                                        <div class="snipcart-thumb">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img src="{{ asset($product->thumbnail) }}" />
                                            </a>
                                            <p>{{ Str::limit($product->name, 25) }}</p>
                                            <h4>
                                                @if ($product->has_discount)
                                                    <del> {{ number_format($product->price, 2) }} TK </del>
                                                @else
                                                    {{ number_format($product->price, 2) }}
                                                @endif 
                                                {{ $product->discount_price }} TK
                                            </h4>
                                        </div>
                                    </div>
                                </figure>
                            </div>
            
                        </div>
                    </div>
                </div>
                @empty
                <p class="select-order-msg">No Products available!</p>
                @endforelse
                
                <div class="clearfix"> </div>
            </div>

            <div class="text-center">
                {{ $products->links() }}
            </div>
            
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection


@push('js')

@endpush
