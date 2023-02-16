
<div class="header_top"> 
    <div class="agileits_header" >
        <div class="container">
            <div class="w3l_offers">
                <p><strong>Hotline :</strong> {{ optional($_settings)->phone_1 }}</p>
            </div>
            <div class="agile-login">
                <ul>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="font-weight-normal">
                                <span class="text-white mr-5">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </span>
                            </a>
    
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    
    <div class="logo_products">
        <div class="container">
        <div class="w3ls_logo_products_left1">
            <a href="{{ route('home') }}">
                {{-- <img src="{{ asset('public/assets/website/images/1.png') }}" alt=""> --}}
                <img src="{{ asset(optional($_settings)->logo) }}" class="logo" alt="">
                @php
                    // print_r($_settings->logo);
                @endphp
            </a>
        </div>
        <div class="w3ls_logo_products_left">
            <h1><a href="{{ route('home') }}" style="color:red;">{{ optional($_settings)->shop_name }}</a></h1>
        </div>
        <div class="w3l_search">
            <form action="{{ route('products.search') }}" method="GET">
                <input type="search" name="q" id="search_field" value="{{ request()->input('q') }}" placeholder="Search" autocomplete="off" required>
                <button type="submit" class="btn btn-default search" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
                <div class="clearfix"></div>
            </form>
            <ul class="suggetion"></ul>
        </div>
    
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
