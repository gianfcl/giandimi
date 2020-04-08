@extends('Layouts.layoutlogin')

@section('content')

<form method="post" action="{{ route('pass.attempt') }}" >
    <h1>Ingreso GIANDIMI</h1>
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
</form> 
@stop