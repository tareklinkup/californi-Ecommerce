
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
    <title>Fantasy Khelaghor</title>
    <meta name="description" content="Fantasy Khelaghor">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="{{ asset('assets/admin/') }}/assets/css/style.css">


</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap mt-5">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <h2 class="font-weight-light text-white"> FANTASY SPORTS </h2>
                    </a>
                </div>
                <div class="card-header bg-white text-center">
                    <h4>Admin</h4>
                </div>
                <div class="login-form">

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('admin.login.process') }}" method="POST" class="mb-4">
                        @csrf

                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control @error('username') is-invalid @enderror" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/admin/') }}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/admin/') }}/assets/js/main.js"></script>


</body>

</html>
