<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.2
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>Login</title>

    <!-- Icons -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="backend/css/style.css" rel="stylesheet">

    <!-- Styles required by this views -->
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>

</head>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group mb-0">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <p class="text-muted">Sign In to your account</p>
                            <p>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            </p>
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input name="password" type="password" class="form-control" placeholder="Password" required>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">Đăng nhập</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <div>
                            <h2>Đăng kí</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="{{ route('register') }}" class="btn btn-primary active mt-3">Đăng kí ngay!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="lib/jquery/dist/jquery.min.js"></script>
<script src="lib/popper.js/dist/umd/popper.min.js"></script>
<script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
