@extends('Layouts.Plantilla')

@section('pageTitle','Usuarios')

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
@section('tituloCentrado','USUARIOS')
<a class="btn btn-success" href="{{route('formaddusuario')}}">Agregar Usuario <i class="fa fa-hand-pointer-o" aria-hidden="true"></i></a>
<div class="row">
	<div class="col-xs-12">
		<div class="x_content">
			<table class="table table-striped table-bordered jambo_table" id="table">
				<thead>
					<tr>
						<th>USUARIO</th>
						<th>NOMBRE</th>
						<th>ROL</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="Modaleditusuario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                <form id="formModaleditusuario" class="form-horizontal" enctype="multipart/form-data" action="{{route('usuarios.editar')}}">
                    <input type="hidden" name="id" id="eid">
                    <div class="row" style="padding-left:11px">
                        <label class="col-md-3">NOMBRE:</label>
                        <div class="input-group col-md-9">
                            <input id="enombre" name="nombre" class="form-control">
                        </div>
                    </div><br>
                    <div class="row" style="padding-left:11px">
                        <label class="col-md-3">USUARIO:</label>
                        <div class="input-group col-md-9">
                            <input id="eusuario" name="usuario" class="form-control">
                        </div>
                    </div><br>
                    <div class="row" style="padding-left:11px">
                        <label class="col-md-3">ROL:</label>
                        <div class="input-group col-md-9">
                            <select id="erol" name="rol" class="form-control">
                            	@foreach($roles as $rol)
                            		<option value="{{$rol->ROL}}">{{$rol->NOMBRE}}</option>
                            	@endforeach
                            </select>
                        </div>
                    </div><br>
                    <center><button class="btn btn-success" type="submit">Guardar</button></center>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@stop

@section('js-scripts')
<script type="text/javascript">
	$(document).ready(function () {
		Usuarios();
	});

	$(document).on("click",".editar",function () {
		$("#Modaleditusuario").modal();
		$("#eid").val($(this).attr('idusuario'));
		$("#enombre").val($(this).attr('nombre'));
		$("#eusuario").val($(this).attr('usuario'));
		$("#erol").val($(this).attr('rol'));
	});

	function Usuarios() {
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
				"url": "{{ route('usuario.getUsuarios') }}",
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
					searchable: false,
					render: function(data, type, row) {
						return row.usuario;
					}
				},
				{
					targets: 1,
					data: null,
					render: function(data, type, row) {
						return row.nombre;
					}
				},
				{
					targets: 2,
					data: null,
					render: function(data, type, row) {
						return row.nombrerol;
					}
				},
				{
					targets: 3,
					data: null,
					render: function(data, type, row) {
						if (row.flg_activo==1) {
							return "ACTIVO";
						}
						return "INACTIVO";
					}
				},
				{
					targets: 4,
					data: null,
					render: function(data, type, row) {
						return "<a class='btn btn-primary editar' idusuario='"+row.id+"' nombre='"+row.nombre+"' usuario='"+row.usuario+"' password='"+row.password+"' nombrerol='"+row.nombrerol+"' rol='"+row.rol+"'>Editar</a><br><a class='btn btn-danger' href='{{route('usuario.delete')}}?id="+row.id+"'>Eliminar</a>";
					}
				}
			],
			columns: [
				{
					data: 'usuario',
					name: 'usuario'
				},
				{
					data: 'nombre',
					name: 'nombre'
				},
				{
					data: 'nombrerol',
					name: 'nombrerol'
				},
				{
					data: 'flg_activo',
					name: 'flg_activo'
				}
			]
		});
	}
</script>
@stop