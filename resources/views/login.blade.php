@section('pageTitle', 'Bienvenido')

@extends('Layouts.layoutlogin')

@section('content')

    <style> 
        .textoLogin {
           color: black;
           font-size: 16px;            
        }
    </style>

<form method="post" action="{{ route('login.attempt') }}" >
    <img src = "{{ URL::asset('img/paddy/paddy_logo_2.png') }}" style="width: 100%" />
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

    <div class="clearfix"></div>
    
</form>
@stop