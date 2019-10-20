@extends('Layouts.layout')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')

@section('pageTitle', 'Líneas Infinity')

<style>
	.celda-centrada{
		vertical-align: middle; 
		text-align: center;
	}
</style>

<?php 
//Calculos de indicadores
    $cartera = 0;
    $clientesInfinity = 0;
    $documentacion = 0;
    $gestionado = 0;
    foreach ($stats as $stat){
        $cartera += $stat->TOTAL;
        $clientesInfinity += $stat->INFINITY;
        $documentacion += $stat->DOCUMENTACION_COMPLETA_INFINITY;
        $gestionado += $stat->GESTIONADO_INFINITY;
    }
?>

<div class="row">
    <div class="col-xs-6">
        <div class="x_panel">
            <p><b>CLIENTES INFINITY: {{$clientesInfinity}}</b></p>
            <div class="progress">
                @foreach($stats as $key => $stat)
                    <div class="progress-bar" style="width: {{$stat->INFINITY*100/$clientesInfinity}}%; background-color: {{App\Entity\Infinity\Semaforo::getColor($key)}}">
                        {{$stat->INFINITY}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>    
    <div class="col-xs-6">
        <div class="x_panel">        
            <p><b>CARTERA: {{$cartera}}</b></p>
            <div class="progress">
                @foreach($stats as $key => $stat)
                    <div class="progress-bar" style="width: {{$stat->TOTAL*100/$cartera}}%; background-color: {{App\Entity\Infinity\Semaforo::getColor($key)}}">
                        {{$stat->TOTAL}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="x_panel">
    		<div class="x_content">
		        <table class="table table-striped table-bordered jambo_table" id="data-table">
		            <thead>
		            	<tr>
		            		<th class="">Inf.</th>
                            <th>Ejecutivo</th>
		            		<th>Cliente</th>
		            	    <th>Semáforo</th>
		            		<th>Motivos</th>
		            		<th>Clasificación</th>
		            		<th>Feve</th>
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

<input id="flg-visibilidad-banca" value="0" type="hidden">
<input id="flg-visibilidad-zonal" value="0" type="hidden">
<input id="flg-visibilidad-jefatura" value="0" type="hidden">

@stop

@section('js-scripts')
<script>
	$('#data-table').DataTable({
        processing: true,
        serverSide: true,
        language: {"url":"{{ URL::asset('js/Json/Spanish.json') }}"},
        ajax: '{{ route('infinity.ge.clientes.get') }}',
        "order": [[ 0, "desc" ],[ 3, "desc" ]],
         columnDefs:[
            {
                targets:0,
                data:null,
                searchable: false,
                className: "celda-centrada",
                render:function(data,type,row){
                    if (row.FLG_INFINITY == 1){
                        return '<i class="fas fa-infinity fa-2x" style="color: #26B99A"></i>';
                    }else{
                        return '';
                    }
                }
            },
            {
                targets:1,
                data:null,
                searchable: $('#flg-visibilidad-jefatura').val() == '1' ? true:false,
                visible: $('#flg-visibilidad-jefatura').val() == '1' ? true:false,
                className: "celda-centrada",
                render:function(data,type,row){

                    html = '';

                    if($('#flg-visibilidad-jefatura').val() == '1')
                        html += row.EJECUTIVO;

                    if($('#flg-visibilidad-zonal').val() == '1')
                        html += '<br/>'+ row.JEFATURA;

                    if($('#flg-visibilidad-banca').val() == '1')
                        html += '<br/>' + row.ZONAL;

                    return html;
                }
            },
            {    
                targets:2,
                data:null,
                render:function(data,type,row){
                    var linea1 = 'CU: ' + row.COD_UNICO;
                    var linea2 = '<br/>' + row.NOMBRE;
                    return linea1 + linea2;
                }
            },
            {
                targets:3,
                data:null,
                className: "celda-centrada",
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
                targets:7,
                data:null,
                visible:false
                
            },
        ],
		columns: [
            { data: 'FLG_INFINITY', name: 'FLG_INFINITY', searchable: false },
            { data: 'EJECUTIVO', name: 'WU.NOMBRE' },
            { data: 'NOMBRE', name: 'WIC.NOMBRE' },
            { data: 'NIVEL_ALERTA', name: 'WIA.NIVEL_ALERTA', searchable: false },
            { data: 'ALERTA_MOTIVO', name: 'WIA.ALERTA_MOTIVO', searchable: false, sortable: false },
            { data: 'CLASIFICACION', name: 'WIC.CLASIFICACION', searchable: false, sortable: false },
            { data: 'FEVE', name: 'WC.FEVE', searchable: false, sortable: false },
            { data: 'COD_UNICO', name: 'WIC.COD_UNICO', sortable: false  },
        ]
		});
</script>
@stop
