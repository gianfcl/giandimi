@extends('Layouts.layoutlogin')

@section('content')

<form method="post" action="{{ action('LoginController@superAttempt') }}" >
    <h1>Bienvenido a la WEBVPC</h1>
    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input class="form-control" placeholder="Registro de Usuario" type="text" name="registro">
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Password" required="" type="password" name="password">
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Ingresar</button>
    </div>

    <div class="clearfix"></div>

    <div class="separator">
        <p class="change_link">¿No tienes acceso?
            <a href="#" class="to_register"> Solicitar Acceso </a>
        </p>

        <div class="clearfix"></div>
        <br />

        <div>
            <h4> VPC Comercial Interbank</h4>
            <p>Contacto: controlgestcom@intranet.ib</p>
        </div>
    </div>
</form> 
@stop