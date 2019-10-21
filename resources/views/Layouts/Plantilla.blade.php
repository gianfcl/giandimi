<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="{{ URL::asset('img/paddy/paddy.png') }}">

        <title>@yield('pageTitle') - Paddy</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        -->
        <!-- <link rel="shortcut icon" href="{{ URL::asset('genious/images/favicon.ico') }}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{ URL::asset('genious/images/apple-touch-icon.png') }}"> -->

        <!-- CSS-->
        <link rel="stylesheet" href="{{ URL::asset('genious/css/fonts-googleapis.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('genious/css/fonts-googleapis-2.css') }}">

        <link rel="stylesheet" href="{{ URL::asset('genious/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('genious/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('genious/css/carousel.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('genious/style.css') }}">

        <script type="text/javascript"  src="{{ URL::asset('genious/js/jquery.min.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/carousel.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/parallax.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/rotate.js') }}"></script> 
        <script type="text/javascript"  src="{{ URL::asset('genious/js/custom.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/masonry.js') }}"></script>
        <script type="text/javascript"  src="{{ URL::asset('genious/js/masonry-4-col.js') }}"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
            <script src="{{ URL::asset('js/respond.min.js') }}"></script>
          <![endif]-->
        @yield('js-libs')

        <script>
var APP_URL = "<?php echo config('app.url'); ?>";
var APP_PUBLIC_URL = "<?php echo config('app.url'); ?>";
        </script>



    </head>
    <body class="left-menu">
        
        <div class="menu-wrapper">
            <header class="vertical-header">
                <div class="vertical-header-wrapper">
                    <nav class="nav-menu">
                        <div class="logo">
                            <a href="#"><img src="{{ URL::asset('img/paddy/paddy_logo_2.png') }}" alt=""></a>
                        </div><!-- end logo -->
                        <div class="profile clearfix">
                            <div class="profile_info" style="padding-top: 15px;">
                                <span>Bienvenido,</span>
                                <h5 style="color: white">{{ Auth::user()->NOMBRE }}</h5>
                            </div>
                        </div>

                        <div class="margin-block"></div>
                        <div id="sidebar_menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li class="{{ (Route::currentRouteName() == 'productos')? 'active':'' }}">
                                        <a href="{{ route('productos') }}"><i class="fa fa-key"></i> Productos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
        </div>

        <div id="wrapper">
            <div id="home">
                <div class="row" style="width: 10%;margin-left: 1320px">
                    <ul class="nav navbar-nav navbar-right" style="width: auto;">
                        <li class="">
                            <a href="{{ route('logout') }}">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="content" class="right_col" role="main" style="min-height: 900px;">
                <div style="margin-top: 4%;">
                    <div class="page-title" style="width: 90%;">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>@yield('pageTitle')</h3>
                            </div>
                            <div class="text-right">
                                @yield('tituloDerecha')
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    @include('flash::message')

                    @yield('content')
                </div>
            </div>
            <footer class="section footer">
            </footer>
        </div>
    </body>
@yield('js-scripts')
</html>