@extends('Layouts.layout')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/numeral.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')

@section('pageTitle', 'Líneas Automáticas')

<style>
    .celda-centrada{
        vertical-align: middle !important; 
        text-align: center;
    }
    table a,table a:hover,table a:active,table a:visited{
        text-decoration: underline;
    }


    .table>tbody>tr>td{
        padding: 5px;
    }
</style>

<?php
//Calculos de indicadores
$cartera = 0;
$clientesInfinity = 0;
$documentacion = 0;
$gestionado = 0;
$gestionable = 0;
$vencidoIBK = 0;
$vencidoRCC = 0;
$visitas = 0;
foreach ($stats as $stat) {
    $cartera += $stat->TOTAL;
    $clientesInfinity += $stat->INFINITY;
    $documentacion += $stat->DOCUMENTACION_COMPLETA_INFINITY;
    $documentacionV2 = $stat->DOCUMENTACION_COMPLETA_INFINITY_2;
    $gestionado += $stat->GESTIONADO_INFINITY;
    $gestionable += $stat->GESTIONABLE_INFINITY;
    $vencidoIBK += $stat->VENCIDO_IBK;
    $vencidoRCC += $stat->VENCIDO_RCC;
    $visitas= $stat->VISITA_INFINITY_2;
}
?>

<div class="row">
    <div class="col-xs-6">
        <div class="x_panel">
            <p><b>CARTERA: {{$cartera}}</b></p>
            <div class="progress">
                @foreach($stats as $key => $stat)
                <div class="progress-bar" style="width: {{$stat->TOTAL*100/$cartera}}%; 
                     background-color: {{$key? App\Entity\Infinity\Semaforo::getColor($key) : 'gray'}}">
                    {{$stat->TOTAL}}
                </div>
                @endforeach
            </div>
            <p><b>CLIENTES LINEAS AUTOMATICAS: {{$clientesInfinity}}</b></p>
            <div class="progress">
                @if($clientesInfinity>0)
                    @foreach($stats as $key => $stat)
                    <div class="progress-bar" style="width: {{$stat->INFINITY*100/$clientesInfinity}}%; background-color: {{App\Entity\Infinity\Semaforo::getColor($key)}}">
                        {{$stat->INFINITY}}
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="x_panel">
            <div class="col-md-6"> 
                <p>GESTIONES</p>
                <div class="progress">
                    @if($gestionable>0)
                    <div class="progress-bar active" role="progressbar"style="min-width: 10%; width: {{$gestionado*100/$gestionable}}%">
                        {{number_format($gestionado*100/$gestionable,0)}}%
                    </div>
                    @endif
                </div>
                <p>VISITA</p>
                <div class="progress">
                    @if($clientesInfinity>0)
                    <div class="progress-bar active" role="progressbar" style="min-width: 10%; width: {{$visitas*100/$clientesInfinity}}%">
                        {{number_format($visitas*100/$clientesInfinity,0)}}%
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6"> 
                <p>DOCUMENTACIÓN</p>
                <div class="progress">
                    @if($clientesInfinity>0)
                    <div class="progress-bar active" role="progressbar" style="min-width: 10%; width: {{$documentacionV2*100/$clientesInfinity}}%">
                        {{number_format($documentacionV2*100/$clientesInfinity,0)}}%
                    </div>
                    @endif
                </div>
                <p><strong>VENCIDOS IBK:</strong> {{$vencidoIBK}}</p>
                <p><strong>VENCIDOS RCC:</strong> {{$vencidoRCC}}</p>
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
                            <th>LA</th>
                            <th>Ejecutivo</th>
                            <th>Cliente</th>
                            <th>Deuda</th>
                            <th>Vencido</th>
                            <th>Semáforo</th>
                            <th>Recálc</th>
                            <th>Docs</th>
                            <th>Visit</th>
                            <th>Resultado</th>
                            <th>Gestión</th>
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

<input id="flg-visibilidad-banca" value="{{$flgVisibilidadBanca}}" type="hidden">
<input id="flg-visibilidad-zonal" value="{{$flgVisibilidadZonal}}" type="hidden">
<input id="flg-visibilidad-jefatura" value="{{$flgVisibilidadJefatura}}" type="hidden">
<input id="flg-visibilidad-general" value="{{$flgVisibilidadGeneral}}" type="hidden">
<input id="flg-visibilidad-control" value="{{$flgVisibilidadControl}}" type="hidden">

<div class="hidden">
@foreach($iconoAlertas as $key => $icono)
<div class="alerta-icono-{{$key}}">
{!! $icono !!}
</div>
@endforeach
</div>

<input id="icono" type="hidden" value="{{ URL::asset('img/Logo_favi.ico') }}" />

@stop

@section('js-scripts')
<script>
$('#data-table').DataTable({
    processing: true,
    rowId: 'staffId',
    serverSide: true,
    language: {"url": "{{ URL::asset('js/Json/Spanish.json') }}"},
    ajax: '{{ route('infinity.me.clientes.get') }}',
    "aLengthMenu": [[25, 50, -1], [25, 50, "Todo"]],
    "iDisplayLength": 25,
    "order": [[0, "desc"], [3, "desc"]],
    columnDefs: [
        {
            targets: 0,
            data: null,
            searchable: false,
            className: "celda-centrada",
            render: function (data, type, row) {
                if (row.FLG_INFINITY == 1) {
                    return '<img src="'+ $('#icono').val()+'" style="width: 20px"/>';
                } else {
                    return '';
                }
            }
        },
        {
            targets: 1,
            data: null,
            searchable: $('#flg-visibilidad-general').val() == '1' ? true : false,
            visible: $('#flg-visibilidad-general').val() == '1' ? true : false,
            //className: "celda-centrada",
            render: function (data, type, row) {

                html = '';

                if ($('#flg-visibilidad-general').val() == '1')
                    html += ''+row.EJECUTIVO;

                if ($('#flg-visibilidad-zonal').val() == '1')
                    html += '<br/>' + 'JEFE: '+ row.JEFATURA;

                if ($('#flg-visibilidad-banca').val() == '1')
                    html += '<br/>' + 'ZONAL: '+row.ZONAL;

                return html;
            }
        },
        {
            targets: 2,
            data: null,
            render: function (data, type, row) {
                var linea1 = 'CU: ' + row.COD_UNICO;
                var linea2 = '<br/>';
                if($('#flg-visibilidad-control').val() == '0')
                    linea2+='<a href="{{route("infinity.me.cliente.detalle")}}?cu=' + row.COD_UNICO + '">' + row.NOMBRE + '</a>';
                else
                    linea2+='<p>'+row.NOMBRE+'</p>';

                return linea1 + linea2;
            }
        },
        {
            targets: 3,
            data: null,
            render: function (data, type, row) {
                return numeral(row.SALDO_RCC / 1000).format('0,0') + 'M';
            }
        },
        {
            targets: 4,
            data: null,
            render: function (data, type, row) {
                var linea1 = 'IBK: ' + numeral(row.SALDO_VENCIDO_IBK / 1000).format('0,0') + 'M';
                var linea2 = '<br/>RCC: ' + numeral(row.SALDO_VENCIDO_RCC / 1000).format('0,0') + 'M';
                return linea1 + linea2;
            }
        },
        {
            targets: 5,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row) {
                var color1 = $('#semaforo-' + row.NIVEL_ALERTA).val();
                var color2 = $('#semaforo-' + row.NIVEL_ALERTA_ANTERIOR).val();
                var color3 = $('#semaforo-' + row.NIVEL_ALERTA_ANTERIOR_2).val();
                return '<i class="fa fa-circle fa-lg" style="padding-right : 3px; color:' + color3 + '"></i>' +
                        '<i class="fa fa-circle fa-lg" style="padding-right : 3px; color:' + color2 + '"></i>' +
                        '<i class="fa fa-circle fa-2x" style="color:' + color1 + '"></i>';
            }
        },
        {
            targets: 6,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row, meta) {
                if (row.ALERTA_RECALCULO){
                    return $('.alerta-icono-'+row.ALERTA_RECALCULO)[0].outerHTML;
                }else{
                    return '';
                }
            }
        },
        {
            targets: 7,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row) {
                if (row.ALERTA_DOCUMENTACION !== null){
                    return $('.alerta-icono-'+row.ALERTA_DOCUMENTACION)[0].outerHTML;
                }else{
                    return '';
                }
            }
        },
        {
            targets: 8,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row, meta) {
                if (row.ALERTA_VISITA !== null){
                    return $('.alerta-icono-'+row.ALERTA_VISITA)[0].outerHTML;
                }else{
                    return '';
                }
            }
        },
        {
            targets: 9,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row, meta) {
                return row.RESULTADO_INFINITY;
            }
        },
        {
            targets: 10,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row, meta) {
                var html = '';
                if (row.ESTADO_INFINITY){
                html += row.ESTADO_INFINITY + '<br>';
                
                var color = '#73879C';
                var texto = 'vence en ' + Math.abs(row.TIMER) + ' día(s)';
                if(row.TIMER == 0){
                    color = '#D9534F';
                    texto = 'vence hoy';
                }
                if(row.TIMER >= 0){
                    color = '#D9534F';
                    texto = 'venció hace '  + Math.abs(row.TIMER) + ' día(s)';
                }
                html += '<div style="color: '+ color + '"><i class="fas fa-clock"></i> ' + texto + '</div>';
                }
                return html;
            }
        },
        {
            targets: 11,
            data: null,
            visible: $('#flg-visibilidad-control').val() == '0' ? true : false,
            render: function (data, type, row) {
                html = '<a href="{{route("infinity.me.cliente.conoceme")}}?cu=' + row.COD_UNICO + '">Conóceme</a>';
                html += ' <a href="{{route("infinity.me.cliente.visita")}}?cu=' + row.COD_UNICO + '">Visita</a>';
                return html;
            }
        },
    ],
    columns: [
        {data: 'FLG_INFINITY', name: 'FLG_INFINITY', searchable: false},
        {data: 'EJECUTIVO', name: 'WU.NOMBRE'},
        {data: 'NOMBRE', name: 'WIC.NOMBRE'},
        {data: 'SALDO_RCC', name: 'SALDO_RCC', searchable: false},
        {data: 'SALDO_VENCIDO_RCC', name: 'SALDO_VENCIDO_RCC', searchable: false},
        {data: 'NIVEL_ALERTA', name: 'NIVEL_ALERTA', searchable: false},
        
        {data: 'FECHA_ULTIMO_RECALCULO_INFINITY', name: 'FECHA_ULTIMO_RECALCULO_INFINITY', searchable: false},
        {data: 'ALERTA_DOCUMENTACION', name: 'ALERTA_DOCUMENTACION', searchable: false, sortable: false},
        {data: 'FECHA_ULTIMA_VISITA_INFINITY', name: 'FECHA_ULTIMA_VISITA_INFINITY', searchable: false}, //Reemplazar con info de resultado
        
        {data: 'FLAG_GESTIONABLE', name: 'FLAG_GESTIONABLE', searchable: false},
        {data: 'ESTADO_GESTION', name: 'ESTADO_GESTION', searchable: false},
        
        {data: 'COD_UNICO', name: 'WIC.COD_UNICO', sortable: false},
    ]
});

/*function getIconoAlerta(idDocumento,fechaUltimo,elemento){
 return $.ajax({
 type: "GET",
 data: {             
 idDocumento: idDocumento,                                 
 fechaUltimo: fechaUltimo,                                 
 },
 //async:false,
 url: APP_URL + 'infinity/me/get-icono-alerta',
 success: function (result) {
 elemento.append(result);
 }
 });  
 }*/

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}


</script>
@stop



