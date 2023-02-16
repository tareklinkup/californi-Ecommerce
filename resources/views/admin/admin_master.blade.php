<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> @yield('title', optional($_settings)->shop_name) </title>

    <meta name="description" content="Fantasy Khelaghor - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{ asset(optional($_settings)->logo) }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/jqvmap/dist/jqvmap.min.css">

    @stack('css')

    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/assets/css/custom.css">

    <style>
        
    </style>

</head>

<body>
    
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ $_shop_short_name }}</a>
                <a class="navbar-brand hidden" href="{{ route('admin.dashboard') }}">{{ $_shop_short_name }}</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li class="{{ request()->is('admin/brand*') ? 'active' : '' }}">
                        <a href="{{ route('admin.brand.index') }}"> <i class="menu-icon fa fa-list"></i> Brand </a>
                    </li>
                    <li class="{{ request()->is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}"> <i class="menu-icon fa fa-list"></i> Category </a>
                    </li>
                    <li class="{{ request()->is('admin/product*') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.index') }}"> <i class="menu-icon fa fa-list"></i> Product </a>
                    </li>
                    <li class="{{ request()->is('admin/order*') ? 'active' : '' }}">
                        <a href="{{ route('admin.orders') }}"> <i class="menu-icon fa fa-list"></i> Order <span class="badge badge-warning">{{ $_new_order_count }}</span> </a>
                    </li>
                    <li class="{{ request()->is('admin/customer*') ? 'active' : '' }}">
                        <a href="{{ route('admin.customer.list') }}"> <i class="menu-icon fa fa-list"></i> Customer</a>
                    </li>
                    <li class="{{ request()->is('admin/about-us*') ? 'active' : '' }}">
                        <a href="{{ route('admin.about.us') }}"> <i class="menu-icon fa fa-list"></i> About Us </a>
                    </li>
                    <li class="{{ request()->is('admin/slider*') ? 'active' : '' }}">
                        <a href="{{ route('admin.sliders') }}"> <i class="menu-icon fa fa-list"></i> Slider </a>
                    </li>
                    <li class="{{ request()->is('admin/banner*') ? 'active' : '' }}">
                        <a href="{{ route('admin.banners') }}"> <i class="menu-icon fa fa-list"></i> Banners </a>
                    </li>
                    <li class="{{ request()->is('all-message') ? 'active' : '' }}">
                        <a href="{{ route('admin.message.list') }}"> <i class="menu-icon fa fa-list"></i> All Messages </a>
                    </li>
                    <li class="{{ request()->is('admin/setting*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}"> <i class="menu-icon fa fa-list"></i> Setting </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="text-right text-uppercase">
                        <h4 class="mt-1">{{ optional($_settings)->shop_name }}</h4>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right mt-2">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome! {{ ucwords(Auth::guard('admin')->user()->username) }}
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('admin.profile') }}">
                                <i class="fa fa-user"></i> Settings
                            </a>

                            <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        @yield('breadcrumb')


        <div class="content mt-3">

            @yield('content', 'Not Content Found')

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('assets/admin/') }}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/assets/js/main.js"></script>

    <script src="{{ asset('assets/admin/') }}/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/assets/js/dashboard.js"></script>
    <script src="{{ asset('assets/admin/') }}/assets/js/widgets.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>

        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

    @stack('js')

</body>

</html>
