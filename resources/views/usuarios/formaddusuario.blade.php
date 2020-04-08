@extends('Layouts.Plantilla')

@section('pageTitle','Usuarios')

@section('js-libs')

@stop

@section('content')
@section('tituloCentrado','AGREGAR USUARIOS')
<form action="{{route('addusuario')}}">
	<div class="row">
		<label>NOMBRE</label>
		<input name="nombre" class="form-control" required>
	</div>
	<div class="row">
		<label>USUARIO</label>
		<input name="usuario" class="form-control" required>
	</div>
	<div class="row">
		<label>CLAVE</label>
		<input id="password" name="password" class="form-control" required>
	</div>
	<div class="row">
		<label>VALIDAR CLAVE</label>
		<input id="password2" class="form-control" required>
	</div>
	<div class="row">
		<label>ROL</label>
		<select class="form-control" name="rol" required>
			<option value="" selected disabled>Seleccionar Rol</option>
			@foreach($roles as $rol)
				<option value="{{$rol->ROL}}">{{$rol->NOMBRE}}</option>
			@endforeach
		</select>
	</div><br>
	<div class="row">
		<button class="btn btn-success">Agregar USUARIO</button>
	</div>
</form>
@stop

@section('js-scripts')
@stop