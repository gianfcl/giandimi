<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{ URL::asset('img/logo.png') }}">

        <title>@yield('pageTitle') - GIANDIMI</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/custom/custom.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/custom/webvpc.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/font-awesome-5.7.1.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">

        <!--JS-->
        <script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('bower_components/moment/min/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/impl.js?v001') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/typeahead.bundle.js') }}"></script>
        @yield('js-libs')

        <script>
var APP_URL = "<?php echo config('app.url'); ?>";
var APP_PUBLIC_URL = "<?php echo config('app.url'); ?>";
        </script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view" style="width: 100%">
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_info" style="padding-top: 15px;">
                                <span>Bienvenido,</span>
                                <h2>{{ Auth::user()->nombre }}</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar_menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li class="{{ (Route::currentRouteName() == 'usuario.index')? 'active':'' }}">
                                        <a href="{{ route('usuario.index') }}"><i class="fa fa-key"></i> Usuarios</a>
                                    </li> 

                                </ul>
                            </div>

                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="glyphicon glyphicon-align-justify"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right" style="width: auto;">
                                <li class="">
                                    <a href="{{ route('logout') }}">
                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div id="content" class="right_col" role="main" style="min-height: 1550px;">
                    <div style="margin-top: 4%;">
                        <div class="page-title">
                            <div class="row">
                                <div class="text-center">
                                    @yield('tituloCentrado')
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        @include('flash::message')

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
    @yield('js-scripts')
</html>