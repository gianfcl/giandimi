@extends('Layouts.Plantilla')

@section('pageTitle','Menus')

@section('js-libs')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/multiselect.min.css') }}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{ URL::asset('js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.html5.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/numeral.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/multiselect.min.js') }}"></script>
@stop

@section('content')
@section('tituloCentrado','MENUS')
<a class="btn btn-success" href="{{route('menu.formmenu')}}">AGREGAR MENU<i class="fa fa-hand-pointer-o" aria-hidden="true"></i></a>
<div class="row">
	<div class="col-xs-12">
		<div class="x_content">
			<table class="table table-striped table-bordered jambo_table" id="table">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>PRIORIDAD</th>
						<th>ESTADO</th>
						<th>ACCIONES</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop

@section('js-scripts')
<script type="text/javascript">
	$(document).ready(function () {
		Menus();
	});

	function Menus() {
		if ($.fn.dataTable.isDataTable('#table')) {
			$('#table').DataTable().destroy();
		}
		$('#table').DataTable({
			processing: true,"bAutoWidth": false,rowId: 'staffId',dom: 'Blfrtip',
			buttons: [{
					"extend": 'pdf',
					"text": 'PDF',
					"className": 'btn btn-danger btn-xs'
				},
				{
					"extend": 'excel',
					"text": 'EXCEL',
					"className": 'btn btn-success btn-xs'
				}
			],
			serverSide: true,language: {"url": "{{ URL::asset('js/Json/Spanish.json') }}"},
			ajax: {
				"type": "GET",
				"url": "{{ route('menus.getMenus') }}",
				data: function(data) {
					data.usuario = null;
				}
			},
			"aLengthMenu": [
				[25, 50, -1],
				[25, 50, "Todo"]
			],
			"iDisplayLength": 25,"order": [[1, "desc"]],
			columnDefs: [
				{
					targets: 0,
					data: null,
					render: function(data, type, row) {
						return row.NOMBRE;
					}
				},
				{
					targets: 1,
					data: null,
					searchable: false,
					render: function(data, type, row) {
						return row.PRIORIDAD;
					}
				},
				{
					targets: 2,
					data: null,
					render: function(data, type, row) {
						if (row.FLG_ACTIVO==null || row.FLG_ACTIVO==0) {
							return 'INACTIVO';
						}
						return "ACTIVO";
					}
				},
				{
					targets: 3,
					data: null,
					render: function(data, type, row) {
						if (row.FLG_ACTIVO==1) {
							$html = "<a class='btn btn-danger' href='{{route('menu.estado')}}?id="+row.ID+"'>Eliminar</a>";
						}else{
							$html = "<a class='btn btn-success' href='{{route('menu.estado')}}?id="+row.ID+"'>Agregar</a>";
						}
						return "<a class='btn btn-primary editar'>Editar</a><br>"+$html;
					}
				}
			],
			columns: [
				{
					data: 'NOMBRE',
					name: 'NOMBRE'
				},
				{
					data: 'PRIORIDAD',
					name: 'PRIORIDAD'
				},
				{
					data: 'FLG_ACTIVO',
					name: 'FLG_ACTIVO'
				}
			]
		});
	}
</script>
@stop