<!DOCTYPE html>
<html>
<head>
<title> @yield('title', optional($_settings)->shop_name) </title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="{{ asset(optional($_settings)->logo) }}">

<!-- //for-mobile-apps -->
<link href="{{ asset('assets/website/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" /> 


<!-- font-awesome icons -->
<link href="{{ asset('assets/website/css/font-awesome.css') }}" rel="stylesheet">
<!-- //font-awesome icons -->

@stack('css')

<link href="{{ asset('assets/website/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />

</head>
<body>

    {{-- <div id="loader"></div> --}}

<!-- header -->
	@include('partial.header')
<!-- //header -->

<!-- navigation -->
	@include('partial.navbar')
<!-- //navigation -->

<!-- content -->
    @yield('content')
<!-- //content -->

<!-- //footer -->
    @include('partial.footer')
<!-- //footer -->

<a href="#" id="toTop" style="display: block;">
    <span id="toTopHover" style="opacity: 0;"></span> To Top
</a>

<script src="{{ asset('assets/website/js/jquery-1.11.1.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/website/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/website/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/website/js/easing.js') }}"></script>

<script type="text/javascript">
    $().UItoTop({ easingType: 'easeOutQuart' });
</script>

@stack('js')

<script>

    $(window).on('load', function(){
        $("#loader").fadeOut("slow");
    });

    $(document).on('keyup', '#search_field', function() {
        if ($(this).val() != '') {
            var route = '{{ route("products.suggestion", ":q") }}';
            var _url = route.replace(":q", $(this).val());
            $.ajax({
                url: _url,
                method: "GET",
                success: function(response) {
                    if (response.length > 0) {
                        var output = '';
                        for (let i = 0; i < response.length; i++) {
                            const el = response[i];
                            output += '<li><span>' + el.name + '</span><br>';
                        }
                        $('.suggetion').html(output);
                    } else {
                        $('.suggetion').html('');
                    }
                }
            });
        } else {
            $('.suggetion').html('');
        }
    });
    
    $(document).on('click', '.suggetion li', function() {
        $('#search_field').val($(this).children('span').text());
        $('.suggetion').html('');
    });
</script>

</body>
</html>
