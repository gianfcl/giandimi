@extends('Layouts.Plantilla')

@section('pageTitle','Roles')

@section('js-libs')

@stop

@section('content')
@section('tituloCentrado','AGREGAR ROLES')
<div class="x_panel">
	<form action="{{route('roles.addrol')}}">
		<div class="row">
			<label class="col-sm-3">NOMBRE</label>
			<div class="col-sm-4">
				<input name="NOMBRE" class="form-control" required>
			</div>
			<input name="FLG_ACTIVO" type="hidden" value="1">
			<div class="col-sm-4">
				<button class="btn btn-success">AGREGAR ROL</button>
			</div>
		</div>
	</form>
</div>
@stop

@section('js-scripts')
@stop