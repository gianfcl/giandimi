@extends('Layouts.layoutlogin')

@section('content')

<form method="post" action="{{ route('pass.save') }}" >
    <h1>Bienvenido a la WEBVPC</h1>
    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input class="form-control" placeholder="Registro de Usuario" type="text" name="registro">
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="passw" value="{{$passw}}">
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Actualizar</button>
    </div>

    <div class="clearfix"></div>
</form> 
@stop