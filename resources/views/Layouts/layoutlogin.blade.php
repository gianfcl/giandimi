<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ URL::asset('img/paddy/paddy.png') }}">
    <title>@yield('pageTitle') - Paddy</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    -->

    <!-- CSS-->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/custom/custom.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/custom/webvpc.css') }}" rel="stylesheet" type="text/css">

    <!--JS-->
    <script type="text/javascript"  src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>       
    <script type="text/javascript" src="{{ URL::asset('js/impl.js') }}"></script>
    @yield('js-libs')

    <script>
        var APP_URL = "<?php echo config('app.url'); ?>";
        var APP_PUBLIC_URL = "<?php echo config('app.url'); ?>";
    </script>
    <style> 
    .fondo {
        /*background-image: url('img/verano.jpg');*/
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;    

    }
</style>
</head>

<body class="login fondo">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">                       
                    @include('flash::message')
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
</body>
</html>

