@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>

<style type="text/css">
th {

    border-top: 0px;
    border-right: 0px;
    border-bottom: 0px;
    border-left: 0px;
}

.elementoTabla{
    vertical-align: middle;text-align: center;font-size: 13px;height: 25px;
}

.tablaPersonalizada{
    width: 100%;
    /*display: table;
    border-collapse: separate;
    border-spacing: 2px;
    -webkit-border-horizontal-spacing: 2px;
    -webkit-border-vertical-spacing: 2px;
    border-color: grey;*/
}


</style>
@stop

@section('content')

@section('pageTitle', 'Resumen Infinity')
@if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE]))
<div class="row">
    <form action="{{ route('infinity.me.resumen') }}" class="form-horizontal">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Búsqueda</h2>   
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row clearfix">
                        @if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA]))
                        <div class="form-group col-md-3">
                            <label for="" class="control-label col-md-3">Zonal:</label>
                            <div class="col-md-9">
                                <select id="cboZonal" class="form-control" name="zonal">
                                    <option value="">Todos</option>
                                    @foreach ($zonales as  $zonal)
                                    <option value="{{$zonal->ID_ZONAL}}" {{($zonal->ID_ZONAL == $busqueda['zonal'])? 'selected="selected"':''}}
                                        >{{$zonal->ZONAL}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        
                        @if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE]))
                            <div class="form-group col-md-3">
                                <label for="" class="control-label col-md-3">Jefatura:</label>
                                <div class="col-md-9">
                                    <select id="cboJefatura" class="form-control" name="jefatura">
                                        <option value="">Todos</option>
                                        @foreach ($jefaturas as  $jefatura)
                                        <option value="{{$jefatura->ID_JEFATURA}}" {{($jefatura->ID_JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''}}
                                            >{{$jefatura->JEFATURA}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        @endif

                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Buscar</button>
                                </div>

                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit" >Ver Detalles</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif

        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 300px">
                    <div class="x_title" style="height: auto;">
                        <h2>Gestiones</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">

                        <div class="col-md-4 col-sm-12 col-xs-12"><canvas id="donaAmbar"></canvas></div>
                        <div class="col-md-4 col-sm-12 col-xs-12"><canvas id="donaRoja" ></canvas></div>
                        <div class="col-md-4 col-sm-12 col-xs-12"><canvas id="donaDocumentacion"></canvas></div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 300px">
                    <div class="x_title" style="height: auto;">
                        <h2>Mora</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <center>
                            <div id="canvas-Mora" style="width: 80%">
                                <canvas id="donaMora"></canvas><br>                                
                            </div>  
                        </center>                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 220px">
                    <div class="x_title" style="height: auto;">
                        <h2>Movimientos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <center>
                            <div class="tile-stats">
                                <div class="count">+{{$movimientos['LINEAS_NUEVAS']}}</div>
                                <h3 style="font-size: 20px">Nuevas líneas Infinity</h3>
                            </div>
                            <div class="tile-stats">
                                <div class="count">@if($movimientos['LINEAS_PERDIDAS']>0)-@endif{{$movimientos['LINEAS_PERDIDAS']}}</div>
                                <h3 style="font-size: 20px">líneas Infinity</h3>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 220px">
                    <div class="x_title" style="height: auto;">
                        <h2>Migraciones</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <div id="tablaMigraciones">
                            <table class="tablaPersonalizada table-striped jambo_table">
                                <thead>                                    
                                    <tr class="headings">                           
                                        <th class="elementoTabla">Semáforo</th>                           
                                        <th class="elementoTabla">Cliente</th>                         
                                        <th class="elementoTabla">Saldo</th>                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="elementoTabla">
                                            <i class="fa fa-circle fa-2x" style="color:green"></i>
                                            <i class="fa fa-arrow-right fa-2x" style="color:black"></i>
                                            <i class="fa fa-circle fa-2x" style="color:red"></i>
                                        </td>
                                        <td class="elementoTabla"><strong>{{$migraciones->MIG_CLIENTE_1}}</strong></td>                       
                                        <td class="elementoTabla"><strong>{{number_format($migraciones->MIG_SALDO_1/1000000,0,'.',',')}} M</strong></td>                      
                                    </tr>                                    
                                    <tr>
                                        <td class="elementoTabla">
                                            <i class="fa fa-circle fa-2x" style="color:#fc3"></i>
                                            <i class="fa fa-arrow-right fa-2x" style="color:black"></i>
                                            <i class="fa fa-circle fa-2x" style="color:red"></i>
                                        </td>                     
                                        <td class="elementoTabla"><strong>{{$migraciones->MIG_CLIENTE_2}}</strong></td>                       
                                        <td class="elementoTabla"><strong>{{number_format($migraciones->MIG_SALDO_2/1000000,0,'.',',')}} M</strong></td>   
                                    </tr>
                                    <tr>
                                        <td class="elementoTabla">
                                            <i class="fa fa-circle fa-2x" style="color:#fc3"></i>
                                            <i class="fa fa-arrow-right fa-2x" style="color:black"></i>
                                            <i class="fa fa-circle fa-2x" style="color:green"></i>
                                        </td>                   
                                        <td class="elementoTabla"><strong>{{$migraciones->MIG_CLIENTE_3}}</strong></td>                       
                                        <td class="elementoTabla"><strong>{{number_format($migraciones->MIG_SALDO_3/1000000,0,'.',',')}} M</strong></td>   
                                    </tr>                                    
                                    <tr>
                                        <td class="elementoTabla">
                                            <i class="fa fa-circle fa-2x" style="color:#fc3"></i>
                                            <i class="fa fa-circle fa-2x" style="color:red"></i>
                                            <i class="fa fa-arrow-right fa-2x" style="color:black"></i>
                                            <i class="fa fa-circle fa-2x" style="color:green"></i>
                                        </td>                  
                                        <td class="elementoTabla"><strong>{{$migraciones->MIG_CLIENTE_4}}</strong></td>                       
                                        <td class="elementoTabla"><strong>{{number_format($migraciones->MIG_SALDO_4/1000000,0,'.',',')}} M</strong></td>   
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 220px">
                    <div class="x_title" style="height: auto;">
                        <h2>Composición Cartera</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <div id="tablaCartera">
                            <table class="tablaPersonalizada table-striped jambo_table">
                                <thead>                                    
                                    <tr class="headings">                           
                                        <th class="elementoTabla">Semáforo</th>                           
                                        <th class="elementoTabla">Clientes</th>                         
                                        <th class="elementoTabla"></th>                         
                                        <th class="elementoTabla">Saldo</th>                        
                                        <th class="elementoTabla"></th>                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($composicionCartera as $semaforo)
                                    <tr>
                                        <td class="elementoTabla">
                                            <i class="fa fa-circle fa-2x" style="color:{{$semaforo['COLOR']}}"></i>
                                        </strong></td>                       
                                        <td class="elementoTabla"><strong>{{$semaforo['CLIENTE_ACT']}}</strong></td>                       
                                        <td class="elementoTabla">                                            
                                            <strong>{{$semaforo['CLIENTE_ACT']-$semaforo['CLIENTE_ANT']}}</strong>
                                            @if($semaforo['CLIENTE_ACT']>$semaforo['CLIENTE_ANT'])
                                                    <i class="fa fa-arrow-circle-up" style="color:green"></i>
                                            @elseif($semaforo['CLIENTE_ACT']<$semaforo['CLIENTE_ANT'])
                                                    <i class="fa fa-arrow-circle-down" style="color:red"></i>
                                            @else
                                                    <i class="fa fa-arrow-circle-up" style="color:green"></i>
                                            @endif
                                        </td>
                                        <td class="elementoTabla"><strong>{{number_format($semaforo['SALDO_ACT']/1000000,0,'.',',')}} M</strong></td>
                                        <td class="elementoTabla">
                                            <strong>
                                                @if($semaforo['SALDO_ANT']!=0)
                                                    {{number_format(($semaforo['SALDO_ACT']-$semaforo['SALDO_ANT'])*100/$semaforo['SALDO_ANT'],0,'.',',')}}%
                                                @else
                                                        0%
                                                @endif
                                            </strong>
                                            @if($semaforo['SALDO_ACT']>$semaforo['SALDO_ANT'])
                                                    <i class="fa fa-arrow-circle-up" style="color:green"></i>
                                            @elseif($semaforo['SALDO_ACT']<$semaforo['SALDO_ANT'])
                                                    <i class="fa fa-arrow-circle-down" style="color:red"></i>
                                            @else
                                                    <i class="fa fa-arrow-circle-up" style="color:green"></i>
                                            @endif
                                        </td>
                                    </tr>  
                                    @endforeach                                

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title" style="height: auto;">
                        <h2>Gráfico Evolutivo</h2>                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block;">
                        <div>
                            <canvas id="graficoLinea"></canvas>
                        </div>
                    </div>
                </div>
            </div>           

        </div>


        @stop

        @section('js-scripts')
        <script>
            $(document).ready(function () {
                generarGraficos($('#cboZonal').val(),$('#cboJefatura').val());


                if ($('#cboZonal').length > 0){
                    cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val());    
                }

                $('#cboZonal').change(function(){
                    cboZonalChange($(this).val(),null);
                });


            });


            /****** ZONAL - JEFATURA ******/
            function cboZonalChange(zonal,jefatura) {

                var cboJefatura = $('#cboJefatura');

                    //Limpiamos el combobox de jefaturas
                    cboJefatura.find('option:not(:first)').remove();

                    //Si no selecionada nada como resultado
                    if (!zonal) {
                        cboJefatura.val('');              
                        cboJefatura.prop('disabled', false);
                        return;
                    }
                    
                    //Si selecciona cualquier otro resultado
                    cboJefatura.prop('disabled', true);              

                    return $.ajax({
                        type: "GET",
                        data: {zonal: zonal},
                        url: APP_URL + 'be/utils/get-jefaturas-by-zonal',
                        dataType: 'json',
                        success: function (json) {
                            $.each(json, function (key, value) {
                                cboJefatura.append($("<option></option>")
                                    .attr("value", value.ID_JEFATURA).text(value.JEFATURA));
                            });
                            if (jefatura){
                                cboJefatura.val(jefatura);
                            }
                            cboJefatura.prop('disabled', false);
                        }
                    });
                }    

                function randomScalingFactor() {
                    return Math.round(Math.random() * 100);
                };


                function configuracionDona(color,valor,titulo){

                    var config={
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [
                                            valor,                              
                                            100-valor,                              
                                    ],
                                    backgroundColor: [
                                        color,
                                        window.chartColors.gray,
                                    ],
                                }],
                            },
                            options: {
                                responsive: true,
                                title: {
                                    display: true,
                                    text: titulo
                                },                           
                                animation: {
                                    animateScale: true,
                                    animateRotate: true
                                },
                                elements: {
                                    center: {
                                        text: valor+'%'
                                    }
                                },
                                tooltips: {
                                     enabled: false
                                }

                            }
                    };

                    return config;
                }

                function generarGraficos(zonal,jefatura){

                    //Configuramos las donas de gestiones
                    $.ajax({
                        type: "GET",
                        data: {             
                            zonal: zonal,                   
                            jefatura: jefatura               
                        },
                        async:false,
                        url: APP_URL + 'infinity/me/resumen/graficos-gestion',
                        success: function (result) {
                            
                            var configAmbar = configuracionDona('#fc3',Math.round(result[0]['GESTION_AMBAR']*100,0),'Gestión Ámbar');
                            var configRoja =configuracionDona('red',Math.round(result[0]['GESTION_ROJO']*100,0),'Gestión Rojo');
                            var configDocumentacion = configuracionDona('blue',Math.round(result[0]['GESTION_DOCUMENTACION']*100,0),'Documentación');

                            var ctxAmbar = document.getElementById('donaAmbar').getContext('2d');
                            window.myDoughnut = new Chart(ctxAmbar, configAmbar);
                            var ctxRoja = document.getElementById('donaRoja').getContext('2d');
                            window.myDoughnut = new Chart(ctxRoja, configRoja);
                            var ctxDocumentacion = document.getElementById('donaDocumentacion').getContext('2d');
                            window.myDoughnut = new Chart(ctxDocumentacion, configDocumentacion);                           

                        }
                    });  

                    //Configuramos las dona de moras
                    $.ajax({
                        type: "GET",
                        data: {             
                            zonal: zonal,                   
                            jefatura: jefatura               
                        },
                        async:false,
                        url: APP_URL + 'infinity/me/resumen/grafico-mora',
                        success: function (result) {
                            var moraVerde=result[0]['MORA_VERDE']/1000;
                            var moraAmbar=result[0]['MORA_AMBAR']/1000;
                            var moraRoja=result[0]['MORA_ROJO']/1000;
                            var moraTotal=result[0]['MORA_TOTAL']/1000;
                            var variacionMora=Math.round(result[0]['VARIACION_MORA'],0);

                            var iconoVariacion='';

                            if (variacionMora>=0)
                                iconoVariacion='<i class="fa fa-arrow-circle-up" style="color:green"></i>';
                            else
                                iconoVariacion='<i class="fa fa-arrow-circle-down" style="color:red"></i>';

                                var config = {
                                    type: 'doughnut',
                                    data: {
                                        datasets: [{
                                            data: [
                                            moraVerde/moraTotal,
                                            moraAmbar/moraTotal,
                                            moraRoja/moraTotal,
                                            ],
                                            backgroundColor: [
                                            'green',
                                            '#fc3',
                                            'red'
                                            ],
                                            label: 'Dataset 1'
                                        }],
                                        labels: [
                                        Math.round(moraVerde,0)+' K',                            
                                        Math.round(moraAmbar,0)+' K',                            
                                        Math.round(moraRoja,0)+' K'
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        legend: {
                                            position: 'right',
                                        },                            
                                        animation: {
                                            animateScale: true,
                                            animateRotate: true
                                        },
                                        tooltips: {
                                             enabled: false
                                        },
                                        /*title: {
                                            display: true,
                                            text: 'Hola',
                                            position:'bottom'
                                        },*/
                                    }
                                };

                                var ctx = document.getElementById('donaMora').getContext('2d');
                                window.myDoughnut = new Chart(ctx, config);

                                
                                $('#canvas-Mora').append('<p style="font-size: 14px"><strong>Total: </strong>'
                                    +Math.round(moraTotal,0)+' K ('+variacionMora+'%'+iconoVariacion+')'+'</p>');

                        }
                    });                      


                    //Configuramos el gráfico lineal
                    $.ajax({
                        type: "GET",
                        data: {             
                            zonal: zonal,                   
                            jefatura: jefatura               
                        },
                        async:false,
                        url: APP_URL + 'infinity/me/resumen/grafico-lineal',
                        success: function (result) {
                            console.log(result);
                            var periodos=[];
                            var evolucionVerde=[];
                            var evolucionAmbar=[];
                            var evolucionRoja=[];
                            var total=0;
                            for (var i = 0; i < result.length; i++) {
                                periodos.push(result[i]['PERIODO']);
                                total=parseInt(result[i]['CLIENTES_VERDE'])+parseInt(result[i]['CLIENTES_AMBAR'])+parseInt(result[i]['CLIENTES_ROJO']);

                                evolucionVerde.push(Math.round(result[i]['CLIENTES_VERDE']*100/total,0));
                                evolucionAmbar.push(Math.round(result[i]['CLIENTES_AMBAR']*100/total,0));
                                evolucionRoja.push(Math.round(result[i]['CLIENTES_ROJO']*100/total,0));
                            }

                            var configLinea = {
                                type: 'line',
                                data: {
                                    labels: periodos,
                                    datasets: [{
                                        label: 'Verde',
                                        backgroundColor: 'green',
                                        borderColor: 'green',
                                        data: evolucionVerde,
                                        fill: false,
                                    }, {
                                        label: 'Ámbar',
                                        fill: false,
                                        backgroundColor: '#fc3',
                                        borderColor: '#fc3',
                                        data: evolucionAmbar,
                                    },
                                    {
                                        label: 'Rojo',
                                        fill: false,
                                        backgroundColor: 'red',
                                        borderColor: 'red',
                                        data: evolucionRoja,
                                    }]
                                }, 
                                options:{
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    },
                                    tooltips: {
                                      callbacks: {
                                        title: function(tooltipItem, data) {
                                          return tooltipItem[0]['yLabel']+'%';
                                        },
                                        label: function(tooltipItem, data) {
                                            for (var i = 0; i < result.length; i++) {
                                                if(result[i]['PERIODO']==tooltipItem['xLabel']){
                                                    var clientes=0;
                                                    if(tooltipItem['datasetIndex']==0)
                                                        clientes=result[i]['CLIENTES_VERDE'];
                                                    else if(tooltipItem['datasetIndex']==1)
                                                        clientes=result[i]['CLIENTES_AMBAR'];
                                                    else if(tooltipItem['datasetIndex']==2)
                                                        clientes=result[i]['CLIENTES_ROJO'];
                                                    break;
                                                }
                                            }
                                          return 'Clientes: '+clientes;
                                        },
                                        afterLabel: function(tooltipItem, data) {
                                            for (var i = 0; i < result.length; i++) {
                                                if(result[i]['PERIODO']==tooltipItem['xLabel']){
                                                    var saldo=0;
                                                    if(tooltipItem['datasetIndex']==0)
                                                        saldo=result[i]['SALDO_VERDE'];
                                                    else if(tooltipItem['datasetIndex']==1)
                                                        saldo=result[i]['SALDO_AMBAR'];
                                                    else if(tooltipItem['datasetIndex']==2)
                                                        saldo=result[i]['SALDO_ROJO'];
                                                    break;
                                                }
                                            }
                                          return 'Saldo: '+Math.round(saldo/1000000,0)+' M';
                                        }
                                      },
                                      backgroundColor: '#FFF',
                                      titleFontSize: 16,
                                      titleFontColor: '#000',
                                      bodyFontColor: '#000',
                                      bodyFontSize: 14,
                                      displayColors: false
                                  }
                                }                       
                            };


                            var ctxLinea = document.getElementById('graficoLinea').getContext('2d');
                            window.myLine = new Chart(ctxLinea, configLinea);
                            $('#graficoLinea').css('height','400px');
                }
            });


        }

            //Plugin para graficar el porcentaje en el medio
            Chart.pluginService.register({
                beforeDraw: function (chart) {
                    if (chart.config.options.elements.center) {
                    //Get ctx from string
                    var ctx = chart.chart.ctx;
                    
                            //Get options from the center object in options
                            var centerConfig = chart.config.options.elements.center;
                            var fontStyle = centerConfig.fontStyle || 'Arial';
                            var txt = centerConfig.text;
                            var color = centerConfig.color || '#000';
                            var sidePadding = centerConfig.sidePadding || 20;
                            var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
                    //Start with a base font of 30px
                    ctx.font = "30px " + fontStyle;
                    
                            //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                            var stringWidth = ctx.measureText(txt).width;
                            var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                    // Find out how much the font can grow in width.
                    var widthRatio = elementWidth / stringWidth;
                    var newFontSize = Math.floor(30 * widthRatio);
                    var elementHeight = (chart.innerRadius * 2);

                    // Pick a new font size so it will not be larger than the height of label.
                    var fontSizeToUse = Math.min(newFontSize, elementHeight);

                            //Set font settings to draw it correctly.
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                            var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                            ctx.font = fontSizeToUse+"px " + fontStyle;
                            ctx.fillStyle = color;

                    //Draw text in center
                    ctx.fillText(txt, centerX, centerY);
                }
            }
            });



</script>
@stop





