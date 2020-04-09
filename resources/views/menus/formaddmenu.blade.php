@extends('Layouts.Plantilla')

@section('pageTitle','Menus')

@section('js-libs')

@stop

@section('content')
@section('tituloCentrado','AGREGAR MENU')
<div class="x_panel">
	<form action="{{route('menu.add')}}" style="padding-left: 30%">
		<div class="row">
			<label class="col-sm-3">NOMBRE</label>
			<div class="col-sm-4">
				<input name="nombre" class="form-control" required>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">TIENE SUBMENU?</label>
			<div class="col-sm-4">
				<select name="flgsubmenu" class="form-control" required>
					<option value="1">SI</option>
					<option value="0" selected>NO</option>
				</select>
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">ORDEN</label>
			<div class="col-sm-4">
				<input id="prioridad" name="prioridad" class="form-control" required type="number">
			</div>
		</div><br>
		<div class="row">
			<label class="col-sm-3">ICONO</label>
			<div class="col-sm-5">
				<div class="col-sm-1">
					<i id="iconprueba" aria-hidden="true"><i>
				</div>
				<div class="col-sm-9" style="width: 74%">
					<select id="icon" name="icon" class="form-control" required>
						<option value="" selected disabled>Seleccionar Icono</option>
						<option value="fa fa-scissors">scissors</option>
						<option value="fa fa-money">money</option>
						<option value="fa fa-user">user</option>
						<option value="fa fa-cutlery">cutlery</option>
						<option value="fa fa-line-chart">line-chart</option>
						<option value="fa fa-calculator">calculator</option>
						<option value="fa fa-cogs">cogs</option>
						<option value="fa fa-calendar">calendar</option>
						<option value="fa fa-folder-open">folder-open</option>
						<option value="fa fa-briefcase">briefcase</option>
					</select>
				</div>
			</div>
		</div><br>
		<div class="row">
			<center><button class="btn btn-success">AGREGAR MENU</button></center>
		</div>
	</form>
</div>
@stop

@section('js-scripts')
<script type="text/javascript">
	$(document).on("change","#icon",function () {
		$("#iconprueba").removeAttr('class');
		$("#iconprueba").addClass($(this).val());
	});
</script>
@stop