@extends('Layouts.Plantilla')

@section('pageTitle','Usuarios')

@section('js-libs')

@stop

@section('content')
@section('tituloCentrado','AGREGAR USUARIOS')
<div class="x_panel">
	<form action="{{route('addusuario')}}" style="padding-left: 30%">
		<div class="row">
			<label class="col-sm-3">NOMBRE</label>
			<div class="col-sm-4">
				<input name="nombre" class="form-control" required>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">USUARIO</label>
			<div class="col-sm-4">
				<input name="usuario" class="form-control" required>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">CLAVE</label>
			<div class="col-sm-4">
				<input id="password" name="password" class="form-control" required>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">VALIDAR CLAVE</label>
			<div class="col-sm-4">
				<input id="password2" class="form-control" required>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">ROL</label>
			<div class="col-sm-4">
				<select class="form-control" name="rol" required>
					<option value="" selected disabled>Seleccionar Rol</option>
					@foreach($roles as $rol)
						<option value="{{$rol->ROL}}">{{$rol->NOMBRE}}</option>
					@endforeach
				</select>
			</div>
		</div><br>
		<div class="row">
			<center><button class="btn btn-success">Agregar USUARIO</button></center>
		</div>
	</form>
</div>
@stop

@section('js-scripts')
@stop