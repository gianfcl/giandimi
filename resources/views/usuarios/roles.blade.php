@extends('Layouts.Plantilla')

@section('pageTitle','Roles')

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
@section('tituloCentrado','ROLES')
<a class="btn btn-success" href="{{route('roles.formroles')}}">Agregar Rol<i class="fa fa-hand-pointer-o" aria-hidden="true"></i></a>
<div class="row">
	<div class="col-xs-12">
		<div class="x_content">
			<table class="table table-striped table-bordered jambo_table" id="table">
				<thead>
					<tr>
						<th>ROL</th>
						<th>NOMBRE</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="ModalAccesoRol">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Accesos Menú</h4>
            </div>
            <div class="modal-body">
            	<!-- {{route('usuarios.editar')}} -->
                <form id="formModalAccesoRol" class="form-horizontal" enctype="multipart/form-data" action="#">
                    <input type="hidden" name="idrol" id="idrol">
                    <div class="row">
                        <label class="col-md-3">ROL:</label>
                        <div class="input-group col-md-9">
                            <input id="nombrerol" class="form-control">
                        </div>
                    </div><br>
                    <div class="html">
                    	
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@stop

@section('js-scripts')
<script type="text/javascript">
	$(document).ready(function () {
		Roles();
	});

	$(document).on("click",".idmenurol",function () {
		idmenurol = $(this).attr("idmenurol");
		activomr = $(this).attr("activomr");
		$.ajax({
			type: "GET",
			data: {
				idmenurol: idmenurol,
				activomr: activomr
			},
			url: '{{route("roles.estadorm")}}',
			success: function(result) {
			}
		});
		$("#ModalAccesoRol button.close").click();
	})

	$(document).on("click",".acceso",function () {
		rol = $(this).attr("rol");
		nombrerol = $(this).attr("nombrerol");
		activo = $(this).attr("activo");
		cantidad_menus = $(this).attr("cantidad_menus");
		$("#ModalAccesoRol").modal();
		$("#idrol").val(rol);
		$("#nombrerol").val(nombrerol);
		$.ajax({
			type: "GET",
			data: {
				rol: rol,
				activo: activo,
				cantidad_menus: cantidad_menus
			},
			url: '{{route("roles.rolesxmenu")}}',
			success: function(result) {
				$(".html").html(result);
			}
		});
	});

	function Roles() {
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
				"url": "{{ route('roles.getRoles') }}",
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
						return row.ROL;
					}
				},
				{
					targets: 1,
					data: null,
					render: function(data, type, row) {
						return row.NOMBRE;
					}
				},
				{
					targets: 2,
					data: null,
					searchable: false,
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
					searchable: false,
					render: function(data, type, row) {
						if (row.FLG_ACTIVO==1) {
							$activo="<br><a class='btn btn-danger' href='{{route('roles.estado')}}?id="+row.ROL+"&activo="+row.FLG_ACTIVO+"'>Eliminar</a>";
						}else{
							$activo="<br><a class='btn btn-success' href='{{route('roles.estado')}}?id="+row.ROL+"&activo="+row.FLG_ACTIVO+"'>Agregar</a>";
						}
						$acceso="<br><a class='btn btn-info acceso' nombrerol="+row.NOMBRE+" rol="+row.ROL+" activo="+row.FLG_ACTIVO+" cantidad_menus="+row.CANT_M+"'>Dar Acceso</a>";
						$editar="<a class='btn btn-primary editar'>Editar</a>";
						return $activo+$acceso;
					}
				}
			],
			columns: [
				{
					data: 'ROL',
					name: 'ROL'
				},
				{
					data: 'NOMBRE',
					name: 'NOMBRE'
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