@extends('Layouts.Plantilla')

@section('pageTitle','Roles')

@section('js-libs')

@stop

@section('content')
@section('tituloCentrado','AGREGAR ROLES')
<form action="{{route('roles.addrol')}}">
	<div class="row">
		<label>NOMBRE</label>
		<input name="NOMBRE" class="form-control" required>
	</div><br>
	<input name="FLG_ACTIVO" type="hidden" value="1">
	<div class="row">
		<button class="btn btn-success">AGREGAR ROL</button>
	</div>
</form>
@stop

@section('js-scripts')
@stop