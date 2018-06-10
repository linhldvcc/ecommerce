<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ url('lib/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            #product-lists .old-price {
                text-decoration: line-through;
            }
        </style>
        <script src="{{ url('lib/jquery/dist/jquery.min.js') }}"></script>
        @yield('script')
    </head>
    <body>
    <div class="container">
        <!-- Content here -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}">SOHAPAY</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-label">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    {{--<li>--}}
                    {{--@if (Route::has('login'))--}}
                    {{--<div class="top-right links">--}}
                    {{--@if (Auth::check())--}}
                    {{--<a href="{{ url('/home') }}">Home</a>--}}
                    {{--@else--}}
                    {{--<a href="{{ url('/login') }}">Login</a>--}}
                    {{--<a href="{{ url('/register') }}">Register</a>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    {{--</li>--}}
                </ul>
                <span class="navbar-text">
                    <a href="{{ route('cart.get-item') }}"><i class="fa fa-2x fa-shopping-cart"></i> Giỏ hàng</a>
                    <?php $badge = (count($cart) > 0) ? count($cart) : ''; ?>
                    <lavel id="cart-badge" class="badge badge-warning">{{ $badge }}</lavel>
                </span>
            </div>
        </nav>

        <div class="content">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    </body>
</html>
