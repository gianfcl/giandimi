<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ URL::asset('img/logo.png') }}">
    <title>Bienvenido- GIANDIMI</title>

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
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;    

        }
        .textoLogin {
           color: black;
           font-size: 16px;            
        }
    </style>
</head>

<body class="login fondo">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">                       
                    @include('flash::message')
                    <form method="post" action="{{ route('login.attempt') }}" >
                        <img src = "{{ URL::asset('img/bienvenida.jpg') }}" style="width: 100%" />
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="form-control textoLogin" placeholder="Usuario" type="text" name="usuario">
                        </div>
                        <div class="form-group">
                            <input class="form-control textoLogin" placeholder="Clave" required="" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default textoLogin" type="submit" style="font-weight: bold">Ingresar</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>