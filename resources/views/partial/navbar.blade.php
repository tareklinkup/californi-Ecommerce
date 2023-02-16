<script type="text/javascript">
    /// some script

    // jquery ready start
    $(document).ready(function() {
        // jQuery code

        //////////////////////// Prevent closing from click inside dropdown
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        // make it as accordion for smaller screens
        if ($(window).width() < 992) {
                $('.dropdown-menu a').click(function(e){
                    e.preventDefault();
                if($(this).next('.submenu').length){
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
                });
        }
        
    }); // jquery end
</script>

<style type="text/css">
    @media (min-width: 992px){
        .dropdown-menu .dropdown-toggle:after{
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;
        }

        .dropdown-menu .dropdown-menu{
            margin-left:0; margin-right: 0;
        }

        .dropdown-menu li{
            position: relative;
            list-style: none;
            color: #fff;
        }
        .nav-item .submenu{ 
            display: none;
            position: absolute;
            left:100%; top:-7px;
        }
        .nav-item .submenu-left{ 
            right:100%; left:auto;
        }

        .dropdown-menu > li:hover{ background-color: #dddddd }
        .dropdown-menu > li:hover > .submenu{
            display: block;
        }
    }
</style>
<div class="navigation-agileits">
    {{-- <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav">
                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}" class="act">Home</a></li>
                    <li class="{{ request()->is('products') ? '' : '' }}"><a href="{{ route('products') }}" class="act">All Products</a></li>
                    <!-- Mega Menu -->
                    <li class="dropdown {{ request()->is('brand*') ? '' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brand<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="multi-gd-img">
                                    <ul class="multi-column-dropdown">
                                        @foreach ($_brands as $brand)
                                            <li>
                                                <a href="{{ route('brand.products', $brand->slug) }}">
                                                    {{ $brand->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                        <a href="{{ route('brands') }}" class="see-all">See All Brand</a>
                                    </ul>
                                </div>

                            </div>
                        </ul>
                    </li>
                    <li class="dropdown {{ request()->is('categor*') ? 'selected' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="multi-gd-img">
                                    <ul class="multi-column-dropdown">
                                        
                                        @foreach ($_categories as $category)
                                            <li>
                                                <a href="{{ route('category.products', $category->slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                                <ul class="dropdown-menu multi-column columns-3">
                                                    <div class="row">
                                                        <div class="multi-gd-img">
                                                            <ul class="multi-column-dropdown">
                                                                @foreach ($category->children as $subcategory)
                                                                    <li>
                                                                        <a href="{{ route('category.products', $subcategory->slug) }}">
                                                                            {{ $subcategory->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </li>
                                        @endforeach

                                        <a href="{{ route('categories') }}" class="see-all">See All Category</a>
                                    </ul>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="{{ request()->is('about-us') ? '' : '' }}"><a href="{{ route('about.us') }}">About Us</a></li>
                    <li class="{{ request()->is('contact-us') ? '' : '' }}"><a href="{{ route('contact.us') }}">Contact Us</a></li>
                    <li class=""><a href="{{ route('message') }}">Message</a></li>
                </ul>
                <ul class="nav navbar-nav nav-right">
                    @if (Auth::check())
                        <li class=""><a href="{{ route('orders') }}" class="act">Orders</a></li>
                    @endif
                    <li>
                        <a href="{{ route('cart') }}" class="w3view-cart">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true" style="margin-top: -5px"></i>
                            <span class="cart-item-balance"> 
                                <span class="total_item">{{ $_total_cart_item }}</span> item(s) - 
                                <span class="sub_total">{{ number_format($_total_price, 2) }}</span> Taka 
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> --}}
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('home') }}">Home </a> </li>
                    <li class="nav-item {{ request()->is('products') ? '' : '' }}"><a class="nav-link" href="{{ route('products') }}"> All Product </a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Brand <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach ($_brands as $brand)
                                <li><a class="dropdown-item" href="{{ route('brand.products', $brand->slug) }}"> {{ $brand->name }} </a></li>
                            @endforeach
                            <li><a class="dropdown-item" href="{{ route('brands') }}"> See All Brand </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  Category  <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach ($_categories as $category)
                            <li><a class="dropdown-item dropdown-toggle" href="{{ route('category.products', $category->slug) }}"> {{ $category->name }} </a>
                                @foreach ($category->children as $subcategory)
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('category.products', $subcategory->slug) }}">{{ $subcategory->name }}</a></li>
                                </ul>
                                @endforeach
                            </li>
                            @endforeach
                            <li><a class="dropdown-item" href="{{ route('categories') }}"> See All Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('about.us') }}">About Us </a> </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact.us') }}"> Contact Us </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('message') }}"> Message </a></li>
                </ul>
                <ul class="nav navbar-nav nav-right">
                    @if (Auth::check())
                    <li class="nav-item nav-right"><a class="nav-link" href="{{ route('orders') }}"> Orders </a></li>
                    @endif
                    <li class="nav-right">
                        <a href="{{ route('cart') }}" class="w3view-cart">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true" style="margin-top: -5px"></i>
                            <span class="cart-item-balance"> 
                                <span class="total_item">{{ $_total_cart_item }}</span> item(s) - 
                                <span class="sub_total">{{ number_format($_total_price, 2) }}</span> Taka 
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
