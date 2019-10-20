@extends('Layouts.layout')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')

@section('pageTitle', 'Líneas Infinity')

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
      		<div class="x_title">
	      		<h2>Lista</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<!-- Inicio: Área !-->
    		<div class="row">
    			<div class="col-md-4 col-xs-6">
    				Lineas Infinity: 
    			</div>
    			<div class="col-md-4 col-xs-6">
    				Semaforo 1:
    				<br> Semaforo 2:
    			</div>
    			<div class="col-md-4 col-xs-6">
    				PENDIENTES DE GESTIÓN:
    				<br> PENDIENTES DE DOCUMENTACIÓN:
    			</div>
    		<div>

    		<div class="x_content">
		        <table class="table table-striped table-bordered jambo_table" id="data-table">
		            <thead>
		            	<tr>
		            		<th>Inf.</th>
		            		<th>Cliente</th>
		            		<th>Deuda Total</th>
		            		<th>Semáforo</th>
		            		<th>Motivos</th>
		            		<th>Gestión</th>
		            		<th>Docum?</th>
		            		<th>Acciones</th>
		            	</tr>
		            </thead>
		            <tbody>
		        	</tbody>
		    	</table>
			</div>
		</div>
	</div>
</div>
            
<!-- Colores de semaforos -->
@foreach(App\Entity\Infinity\Semaforo::SEMAFOROS_ME_COLORES as $key => $color)
    <input id="semaforo-{{$key}}" type="hidden" value="{{$color}}">
@endforeach

@stop

@section('js-scripts')
<script>
	$('#data-table').DataTable({
        processing: true,
        serverSide: true,
        language: {"url":"dataTables.spanish.lang"},
        ajax: '{{ route('infinity.clientes.get') }}',
         columnDefs:[
            {
                targets:0,
                data:null,
                searchable: false,
                render:function(data,type,row){
                    if (row.FLG_INFINITY == 1){
                        return 1;
                    }else{
                        return 0;
                    }
                }
            },
            {    
                targets:1,
                data:null,
                render:function(data,type,row){
                    var linea1 = 'CU: ' + row.COD_UNICO;
                    var linea2 = '<br/>' + row.NOMBRE;
                    return linea1 + linea2;
                }
            },
            {
                targets:2,
                data:null,
                render:function(data,type,row){
                    var linea1 = 'IBK: S/.' + Math.round(row.SALDO_IBK);
                    var linea2 = '<br/>RCC: S/.' + Math.round(row.SALDO_IBK);
                    return linea1 + linea2;
                }
            },
            {
                targets:3,
                data:null,
                render:function(data,type,row){
                    var color1 = $('#semaforo-'+row.NIVEL_ALERTA).val();
                    var color2 = $('#semaforo-'+row.NIVEL_ALERTA_ANTERIOR).val();
                    var color3 = $('#semaforo-'+row.NIVEL_ALERTA_ANTERIOR_2).val();
                    return '<i class="fa fa-circle fa-lg" style="padding-right : 3px; color:'+ color3 +'"></i>'+
                    '<i class="fa fa-circle fa-lg" style="padding-right : 3px; color:'+ color2 +'"></i>' +
                    '<i class="fa fa-circle fa-2x" style="color:'+ color1 +'"></i>';
                }
            },
            {
                targets:6,
                data:null,
                render:function(data,type,row){
                    if (row.FLG_DOCUMENTACION_COMPLETA == 1){
                        return 1;
                    }else{
                        return 0;
                    }
                }
            },
            {
                targets:7,
                data:null,
                render:function(data,type,row){
                    return null;
                }
            },
        ],
		columns: [
            { data: 'FLG_INFINITY', name: 'FLG_INFINITY' },
            { data: 'COD_UNICO', name: 'COD_UNICO' },
            { data: 'SALDO_IBK', name: 'WCI.SALDO_DIRECTO_INTERBANK' },
            { data: 'NIVEL_ALERTA', name: 'WIC.NIVEL_ALERTA' },
            { data: 'ALERTA_MOTIVO', name: 'WIA.ALERTA_MOTIVO', searchable: false, sortable: false },
            { data: 'ESTADO_GESTION', name: 'ESTADO_GESTION' },
            { data: 'FLG_DOCUMENTACION_COMPLETA', name: 'WIC.FLG_DOCUMENTACION_COMPLETA' },
            { data: 'NOMBRE', name: 'WIC.NOMBRE', sortable: false  },
        ]
		});
</script>
@stop
