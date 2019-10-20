@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 


<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/modernizr.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'E - Note Jefe')

    <?php
        $factor = 1000;
        $factorMiles = "Miles";
        $factormm = "MM";
    ?>
<style type="text/css">
    .lnkPorcentaje, .lnkPorcentaje:hover, .lnkNotas, .lnkNotas:hover{
        text-decoration: underline;
        color: blue;
    }
</style>

<div class="row">
    <!-- SECCION: FILTROS DE BUSQUEDA !-->
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form id='formBusqueda'>
                    @if (in_array(Auth::user()->ROL,array_merge(\App\Entity\Usuario::getDivisionBE())))
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Banca:</label>
                        <div class="col-md-9">
                            <select id="cboBanca" class="form-control" name="banca">
                                <option value="">Todos</option>
                                    @foreach ($bancas as  $banca)
                                        <option value="{{$banca->BANCA}}" {{($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''}}
                                        >{{$banca->BANCA}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if (in_array(Auth::user()->ROL,array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca())))
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
                        
                    @if (in_array(Auth::user()->ROL,array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE())))
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

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-2">Periodo:</label>
                        <div class="col-md-9">
                            <select id="cboPeriodo" class="form-control" name="periodo">
                                @foreach ($periodos as  $periodo)
                                    <option value="{{$periodo['key']}}" {{($periodo['key'] == $busqueda['periodo'])? 'selected="selected"':''}}
                                    >{{$periodo['value']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- SECCION: RESUMEN !-->
	<div class="col-xs-12">
		<div class="x_panel">
            <div class="x_title">
                <h2>Resumen </h2>
                <div class="clearfix"></div>
            </div>
			<div id="divResumenContent" class="x_content">
				
			</div>
		</div>
	</div>

    <!-- SECCION: EVOLUCION DE SALDOS !-->
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Evolución de Saldos</h2>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class=" col-xs-6">
                    <canvas id="divColocacionesDirectas"></canvas>
                </div>
                
                <div class=" col-xs-6">
                    <canvas id="divColocacionesIndirectas"></canvas>
                </div>
            </div>
        </div>
    </div>

   
     

    <!-- SECCION: TABLAS DETALLE  !-->
    <div class="col-xs-12">
        <div class="row">
            <!-- SECCION: DESEMBOLSOS CERTEROS  !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Desembolsos Certeros</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <table class="table table-striped table-bordered jambo_table" id="tblDesembolsosCerteros" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Banca</th>
                                    <th>Grupo/Zonal</th>
                                    <th>Ejecutivo</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECCION: DESEMBOLSOS EN COTIZACION  !-->
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="height: auto;">
                        <h2>Desembolsos en cotización</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <table class="table table-striped table-bordered jambo_table" id="tblDesembolsosCotizacion" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Banca</th>
                                    <th>Grupo/Zonal</th>
                                    <th>Ejecutivo</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

             <!-- SECCION: CAIDAS PROYECTADAS  !-->
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="height: auto;">
                        <h2>Caídas Proyectadas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <table class="table table-striped table-bordered jambo_table" id="tblCaidas" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Banca</th>
                                    <th>Grupo/Zonal</th>
                                    <th>Ejecutivo</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Monto</th>
                                    <th>Fecha Venc.</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

             <!-- SECCION: OPERACIONES PERDIDAS  !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Operaciones Perdidas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <table class="table table-striped table-bordered jambo_table" id="tblOperacionesPerdidas" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Banca</th>
                                    <th>Grupo/Zonal</th>
                                    <th>Ejecutivo</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Monto</th>                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

             <!-- SECCION: DESEMBOLSOS EN COTIZACION FUTUROS !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Desembolsos en cotización futuros</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-down"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">                        
                        <table class="table table-striped table-bordered jambo_table" id="tblOperacionesCotizacionFuturos" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Banca</th>
                                    <th>Grupo/Zonal</th>
                                    <th>Ejecutivo</th>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Monto</th>                                    
                                </tr>
                            </thead>
                        </table>                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- MODAL NOTAS -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNotas">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Notas</h4>
            </div>
                <div class="modal-body">
                    <ul id="listaNotas" class="list-unstyled top_profiles scroll-view" style="height: auto;">
                        <li class="media event cargando-resultados">
                            <div class="media-body">
                                <p style="text-align: center;"><i class="fa fa-spinner fa-spin fa-fw"></i></p>
                            </div>
                        </li>
                        <li class="media event sin-resultados hidden">
                            <div class="media-body">
                                <p style="text-align: center;">No existen notas previas</p> 
                            </div>
                        </li>
                    </ul>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@stop

@section('js-scripts')
    <script>

    /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
    var valBanca = "{{$busqueda['banca']}}";
    var valZonal = "{{$busqueda['zonal']}}";
    var valJefatura = "{{$busqueda['jefatura']}}";
    var valEjecutivo = null;


    if ($('#cboBanca').length > 0){
        cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val());
    }else{
        if ($('#cboZonal').length > 0){
            cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val());    
        }
    }
        

    $('#cboZonal').change(function(){
        cboZonalChange($(this).val(),null,null);
    });


    $('#cboBanca').change(function(){
        cboBancaChange($(this).val(),null,null,null);
    });

    function cboZonalChange(zonal,jefatura) {

            var cboJefatura = $('#cboJefatura');

            //Limpiamos el combobox de ejecutivos
            cboJefatura.find('option:not(:first)').remove();
            
            //Si no selecionada nada como resultado
            if (!zonal) {
                cboJefatura.val('');
                cboJefatura.prop('disabled', false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboJefatura.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true);
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

    function cboBancaChange(banca,zonal,jefatura) {
            var cboZonal = $('#cboZonal');
            var cboJefatura = $('#cboJefatura');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            
            //Si no selecionada nada como resultado
            if (!banca) {
                cboZonal.val('');
                cboZonal.prop('disabled',false);
                return;
            }
            
            cboZonal.prop('disabled', true);

            return $.ajax({
                type: "GET",
                data: {banca: banca},
                url: APP_URL + 'be/utils/get-zonales-by-banca',
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (key, value) {
                        cboZonal.append($("<option></option>")
                            .attr("value", value.ID_ZONAL).text(value.ZONAL));
                    });
                    if (zonal){
                        cboZonal.val(zonal);
                    }
                    cboZonal.prop('disabled', false);
                    cboZonalChange(zonal,jefatura);
                }
            });
    } 

    function cargarColocacionesIndirectas(){
    /*
     //Data para el grafico
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Día');
        data.addColumn('number', 'Saldo Punta');
        data.addColumn('number', 'Saldo Promedio');

        //Opciones del gráfico
        var options = {
          title : 'Colocaciones Indirectas',
          vAxis: {title: 'Saldo'},
          hAxis: {title: 'Días'},
          seriesType: 'bars',
          series: {1: {type: 'line'}},
          colors: ['#FFD966', '#ED7D31'],
          legend: { position: 'top'}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('divColocacionesIndirectas'));
        
        //Cargamos la data por Ajax
        $.ajax({
            url: APP_URL + '/be/enote/getColIndirecta',
            dataType:"json",
            success:function(resp){
                //Agregamos fila por fila
                $.each(resp, function(i,resp){
                    data.addRows([[resp.DIA, parseFloat(resp.SALDO_PROMEDIO), parseFloat(resp.SALDO_PUNTA)]]);
                });
                
                //dibujamos el gráfico
                chart.draw(data, options);
            },
            error:function(resp){
                alert("Error In Connecting");
            }
        });
    */
     
        
    }
    /*** GRAFICOS ****/

    var dataGraficos;

    function cargaDataGraficos(){
        $.ajax({
            url: APP_URL + '/be/enoteJefe/graficar',
            dataType:"json",
            data: {
                    ejecutivo: valEjecutivo,
                    periodo: $('#cboPeriodo').val(),
                    jefatura: valJefatura,
                    banca: valBanca,
                    zonal: valZonal,
                },
            success:function(resp){
                
                dataGraficos = resp;

                dias = [];

                mpromedioDir = [];
                mpuntaDir = [];
                proyeccionDir = [];

                mpromedioInd = [];
                mpuntaInd = [];
                proyeccionInd = [];

                //Formateamos la data
                $.each(resp, function(i,resp){
                    dias.push(resp.DIA+'/'+resp.MES);

                    mpromedioDir.push(parseFloat(resp.SALDO_PROMEDIO_DIRECTAS));
                    mpuntaDir.push(parseFloat(resp.SALDO_PUNTA_DIRECTAS));
                    proyeccionDir.push(parseFloat(resp.PROYECCION_DIRECTAS));

                    mpromedioInd.push(parseFloat(resp.SALDO_PROMEDIO_INDIRECTAS));
                    mpuntaInd.push(parseFloat(resp.SALDO_PUNTA_INDIRECTAS));
                    proyeccionInd.push(parseFloat(resp.PROYECCION_INDIRECTAS));
                });

                corteMinDir = Math.min(mmObject(mpromedioDir),mmObject(mpuntaDir),mmObject(proyeccionDir));               
                corteMinInd = Math.min(mmObject(mpromedioInd),mmObject(mpuntaInd),mmObject(proyeccionInd));               
                
                console.log(corteMinDir);
                console.log(corteMinInd);                


                cargarColocacionesDirectas(dias,mpromedioDir,mpuntaDir,proyeccionDir,corteMinDir);
                cargarColocacionesIndirectas(dias,mpromedioInd,mpuntaInd,proyeccionInd,corteMinInd); 


            },
            error:function(resp){
                alert("Error In Connecting");
            }
        });

    }

    function mmObject(ob,tipo='min'){
        min = 9999999999999999;
        max = 0;
        var result = Object.keys(ob).map(function(key) {
                  
                  if(max<ob[key]){
                    max = ob[key];                  
                  }
                  if(ob[key]!=0){
                    if (min>ob[key]) {
                    min = ob[key];
                  }            
                  }                    
                });
        if (tipo=='max') {
            return max;
        }else{
            return 0.95*min;
        }
    }

    function cargarColocacionesDirectas(dias,mpromedio,mpunta,proyeccion, min = 0){
        
        var chartData = {
                labels: dias,
                datasets: [{
                    type: 'line',
                    label: 'Saldo Promedio',
                    borderColor: '#2B0FF9',
                    backgroundColor: '#2B0FF9',
                    borderWidth: 2,
                    fill: false,
                    data: mpromedio
                },
                {
                    type: 'bar',
                    label: 'Saldo Punta',
                    backgroundColor: '#9DC3E6',
                    data: mpunta,
                    borderColor: '#9DC3E6',
                    borderWidth: 2
                },
                {
                    type: 'bar',
                    label: 'Proyección',
                    backgroundColor: '#ccc',
                    data: proyeccion,
                    borderColor: '#ccc',
                    borderWidth: 2
                },
            ]};
            
            //dibujamos el gráfico
            var canvas = document.getElementById("divColocacionesDirectas");
            var ctx = canvas.getContext('2d');
            var myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Colocaciones Directas (MM)'
                    },
                    scales:{
                        xAxes:[{
                           ticks: {
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 90
                           },     
                        }],
                        yAxes:[{
                            ticks:{                                
                                min : min
                            }
                        }],
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                        position: 'nearest',
                        callbacks: {
                            label:function(tooltipItem, data){                                    
                                    var valor = tooltipItem.yLabel;
                                    val = valor;

                                    if(isNaN(valor)){
                                        val = 0;
                                    }

                                    //console.log(val);  

                                    var labelCabecera = data.datasets[tooltipItem.datasetIndex].label || '';                                    
                                    var label = labelCabecera+': ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");  
                                    
                                    //console.log(label);
                                    if(labelCabecera!='Saldo Promedio' && val!=0){
                                        return label;    
                                    }
                                    
                                    
                                    /*var labelCabecera = data.datasets[tooltipItem.datasetIndex].label || '';                                    
                                    var label = labelCabecera+': ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                    return label;*/
                            },
                            afterBody: function(tooltipItem, data) {
                                //console.log(dataGraficos[tooltipItem[2].index]);
                                
                                if (dataGraficos[tooltipItem[1].index].SALDO_PUNTA_DIRECTAS == null){
                                    text = [];
                                    text.push('Desembolso: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].DESEMBOLSO_DIRECTA).toFixed(0)));
                                    text.push('Amortizacion: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].AMORTIZACION_DIRECTA).toFixed(0)));
                                    text.push('Vencimiento: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].VENCIMIENTO_DIRECTA).toFixed(0)));
                                    text.push('Pre Cancelaciones: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].PRE_CANCELACIONES_DIRECTA).toFixed(0)));
                                    return text;  
                                }else{
                                    var date = new Date(dataGraficos[tooltipItem[1].index].FECHA);
                                    var day = date.getDay();
                                    console.log(date.getDay());
                                    if(day==4){                                        
                                        text = [];
                                        //text.push('Proyeccion Certera: ' + dataGraficos[tooltipItem[1].index].SALDO_PROYECTADO_DIR.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                        text.push('Compromiso: ' + dataGraficos[tooltipItem[1].index].MONTO_COMPROMISO_DIR.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));                                        
                                        return text; 
                                    }
                                }                                
                            }
                        }
                    }
                }
            });

            canvas.onclick = function(evt){
                var activePoints = myMixedChart.getElementsAtEvent(evt);
                // => activePoints is an array of points on the canvas that are at the same position as the click event.
                if (activePoints[0]) {
                    var cd = activePoints[0]['_chart'].config.data;
                    var idx = activePoints[0]['_index'];
                    //console.log(cd.labels[idx]);
                    //console.log(cd.datasets[2].data[idx]);
                  }
            };
    }

    function cargarColocacionesIndirectas(dias,mpromedio,mpunta,proyeccion,min=0){
        var chartData = {
            labels: dias,
            datasets: [{
                type: 'line',
                label: 'Saldo Promedio',
                borderColor: '#ED7D31',
                backgroundColor: '#ED7D31',
                borderWidth: 2,
                fill: false,
                data: mpromedio
            }, 
            {
                type: 'bar',
                label: 'Saldo Punta',
                backgroundColor: '#FFD966',
                data: mpunta,
                borderColor: '#FFD966',
                borderWidth: 2
            },
            {
                    type: 'bar',
                    label: 'Proyección',
                    backgroundColor: '#ccc',
                    data: proyeccion,
                    borderColor: '#ccc',
                    borderWidth: 2
            }
            ]

        };
        
        //dibujamos el gráfico
        var ctx = document.getElementById('divColocacionesIndirectas').getContext('2d');
        window.myMixedChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Colocaciones Indirectas (MM)' 
                },
                scales:{
                    xAxes:[{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90
                        }     
                    }],
                        yAxes:[{
                            ticks:{                                
                                min : min
                            }
                        }],
                },
                tooltips: {
                    mode: 'index',
                    intersect: true,
                    position: 'nearest',
                    callbacks: {
                            label:function(tooltipItem, data){
                                    var valor = tooltipItem.yLabel;
                                    val = valor;

                                    if(isNaN(valor)){
                                        val = 0;
                                    }

                                    //console.log(val);  

                                    var labelCabecera = data.datasets[tooltipItem.datasetIndex].label || '';                                    
                                    var label = labelCabecera+': ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");  
                                    
                                    //console.log(label);
                                    if(labelCabecera!='Saldo Promedio' && val!=0){
                                        return label;    
                                    }
                            },
                            afterBody: function(tooltipItem, data) {
                                //console.log(dataGraficos[tooltipItem[2].index]);
                                if (dataGraficos[tooltipItem[1].index].SALDO_PUNTA_INDIRECTAS == null){
                                    text = [];
                                    text.push('Desembolso: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].DESEMBOLSO_INDIRECTA).toFixed(0)));
                                    text.push('Amortizacion: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].AMORTIZACION_INDIRECTA).toFixed(0)));
                                    text.push('Vencimiento: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].VENCIMIENTO_INDIRECTA).toFixed(0)));
                                    text.push('Pre Cancelaciones: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].PRE_CANCELACIONES_DIRECTA).toFixed(0)));
                                    return text;  
                                }else{
                                    var date = new Date(dataGraficos[tooltipItem[1].index].FECHA);
                                    var day = date.getDay();
                                    console.log(date.getDay());
                                    if(day==4){                                        
                                        text = [];
                                        //text.push('Proyeccion Certera: ' + dataGraficos[tooltipItem[1].index].SALDO_PROYECTADO_IND.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                                        text.push('Compromiso: ' + dataGraficos[tooltipItem[1].index].MONTO_COMPROMISO_IND.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));                                        
                                        return text; 
                                    }
                                } 
                                
                            }
                        }
                }
            }
        });
    }

    /********* Funciones de apoyo *******/

    function formatNumber(number){
        return parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
    }

    function validarPorcentaje(number){
        return  !isNaN(parseFloat(number)) && isFinite(number) && number > 0 && number <= 100
    }

    /********* Funciones de apoyo *******/

    function formatNumber(number){
        return parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
    }


    /********* FIN Clases De Operaciones Nuevas *******/

    // Variables globales
    var currentRow;
    var tablaVencimientos;
    var tablaAmortizaciones;
    var tablaOperaciones;
    var tablaCaidas;
    var formNuevaOperacion;

    function cargarResumen(valEjecutivo,periodo,banca,zonal,jefatura){
        //if(banca=""){ banca = null}
        //if(zonal=""){ zonal = null}                    
        $.ajax({
                    url: APP_URL + '/be/enote/resumen-jefe',
                    type: 'GET',
                    data: {ejecutivo: valEjecutivo,
                           periodo :periodo ,
                           banca :banca,
                           zonal :zonal,
                           jefatura: jefatura
                            },
                    success: function (result) {
                        $('#divResumenContent').html(result);
                    },
                    error: function (xhr, status, text) {
                        e.preventDefault();
                        alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                    }
                });
    }

    function cargarDesembolsosCerteros(){
        tablaVencimientos = $('#tblDesembolsosCerteros').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": APP_URL + "dataTables.spanish.lang"},
            ajax: {
                "url" : '{{ route('be.enote-jefe.get-desemb-certeros') }}',
                "data": {
                    periodo: $('#cboPeriodo').val(),
                    banca: valBanca,
                    zonal: valZonal,
                    jefatura: valJefatura,
                }
            },
            columnDefs:[                
                {
                    targets:5,
                    data:'FECHA_DESEMBOLSO',  
                    sortable: true,  
                    searchable: true,
                },
                {
                    targets:6,
                    data:'MONTO_CERT',
                    searchable: false,
                    sortable: true,
                    render:function(data,type,row,meta){
                        //Condicion para hacer sortable el campo ya que es un renderizado
                        if (type == "sort" || type == 'type')
                            return data;

                        return formatNumber(row.MONTO_CERT);
                    }
                },
                {

                    targets:7,
                    data:null,
                    render:function(data,type,row,meta){
                        return '<a href="#" class="lnkNotas" operacion="' + row.ID_OPERACION +'">+ Notas</a>';
                    }
                },
            ],
            columns: [
                { data: 'BANCA' ,searchable: false},
                { data: 'ZONAL' },
                { data: 'EJECUTIVO'},
                { data: 'CLIENTE'},                
                { data: 'PRODUCTO' },                                
                { data: 'FECHA_DESEMBOLSO' },                   
                { data: 'MONTO_CERT' },                                
            ]
        });
    }

    function cargarDesembolsosCotizacion(){
        tablaVencimientos = $('#tblDesembolsosCotizacion').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": APP_URL + "dataTables.spanish.lang"},
            ajax: {
                "url" : '{{ route('be.enote-jefe.get-desemb-cotizacion') }}',
                "data": {
                    periodo: $('#cboPeriodo').val(),
                    banca: valBanca,
                    zonal: valZonal,
                    jefatura: valJefatura,
                }
            },
            columnDefs:[
                {
                    targets:5,
                    data:'FECHA_DESEMBOLSO',  
                    sortable: true,  
                    searchable: true,
                },
                {
                    targets:6,
                    data:null,
                    searchable: false,
                    sortable: true,
                    render:function(data,type,row,meta){
                        //Condicion para hacer sortable el campo ya que es un renderizado
                        if (type == "sort" || type == 'type')
                            return data;
                        return formatNumber(row.MONTO_ENCOT);
                    }
                },
                {
                    targets:7,
                    data:null,
                    render:function(data,type,row,meta){
                        return '<a href="#" class="lnkNotas" operacion="' + row.ID_OPERACION +'">+ Notas</a>';
                    }
                },
            ],
            columns: [
                { data: 'BANCA' ,searchable: false},
                { data: 'ZONAL' },
                { data: 'EJECUTIVO'},
                { data: 'CLIENTE'},
                { data: 'PRODUCTO' },
                { data: 'FECHA_DESEMBOLSO' },
                { data: 'MONTO_ENCOT' },
            ]
        });
    }

    function cargarCaidas(){
         tablaCaidas = $('#tblCaidas').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": APP_URL + "dataTables.spanish.lang"},
            ajax: {
                "url" : '{{ route('be.enote-jefe.get-caidas-proyectadas') }}',
                "data": {
                    periodo: $('#cboPeriodo').val(),
                    banca: valBanca,
                    zonal: valZonal,
                    jefatura: valJefatura,
                }
            },
            columnDefs:[
                {
                    targets:5,
                    data:'MONTO_CAIDA',
                    searchable: false,
                    sortable: true,
                    render:function(data,type,row,meta){
                        if (type == "sort" || type == 'type')
                            return data;
                        return formatNumber(row.MONTO_CAIDA);
                    }
                },
                {
                    targets:6,
                    data:'FECHA_VENCIMIENTO',  
                    sortable: true,  
                    searchable: true,
                },
            ],
            columns: [
                { data: 'BANCA' ,searchable: false},
                { data: 'ZONAL' },
                { data: 'EJECUTIVO'},
                { data: 'CLIENTE'},
                { data: 'PRODUCTO' },
                { data: 'MONTO_CAIDA' },
                { data: 'FECHA_VENCIMIENTO'},
            ]
        });
    }

    function cargarOperaicionesPerdidas(){
         tablaCaidas = $('#tblOperacionesPerdidas').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": APP_URL + "dataTables.spanish.lang"},
            ajax: {
                "url" : '{{ route('be.enote-jefe.get-operaciones-perdidas') }}',
                "data": {
                    periodo: $('#cboPeriodo').val(),
                    banca: valBanca,
                    zonal: valZonal,
                    jefatura: valJefatura,
                }
            },
            columnDefs:[
                {
                    targets:5,
                    data:'MONTO_CERT',
                    searchable: false,
                    sortable: true,
                    render:function(data,type,row,meta){
                        if (type == "sort" || type == 'type')
                            return data;
                        return formatNumber(row.MONTO_CERT);
                    }
                }             
            ],
            columns: [
                { data: 'BANCA' ,searchable: false},
                { data: 'ZONAL' },
                { data: 'EJECUTIVO'},
                { data: 'CLIENTE'},
                { data: 'PRODUCTO' },
                { data: 'MONTO_CERT' },
                //{ data: 'FECHA_VENCIMIENTO',sortable:true},
            ]
        });
    }

    function getDesembolsosCotizacionFuturos(){
       tablaCaidas = $('#tblOperacionesCotizacionFuturos').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": APP_URL + "dataTables.spanish.lang"},
            ajax: {
                "url" : '{{ route('be.enote-jefe.get-desemb-cot-futuros') }}',
                "data": {
                    periodo: $('#cboPeriodo').val(),
                    banca: valBanca,
                    zonal: valZonal,
                    jefatura: valJefatura,
                }
            },
            columnDefs:[
                {
                    targets:5,
                    data:'MONTO_ENCOT',
                    searchable: false,
                    sortable: true,
                    render:function(data,type,row,meta){
                        if (type == "sort" || type == 'type')
                            return data;
                        return formatNumber(row.MONTO_ENCOT);
                    }
                }             
            ],
            columns: [
                { data: 'BANCA' ,searchable: false},
                { data: 'ZONAL' },
                { data: 'EJECUTIVO'},
                { data: 'CLIENTE'},
                { data: 'PRODUCTO' },
                { data: 'MONTO_ENCOT' },
               //{ data: 'FECHA_VENCIMIENTO'},
            ]
        }); 
    }

    $(document).ready(function(){        
        cargarResumen(valEjecutivo,"{{$busqueda['periodo']}}",valBanca,valZonal,valJefatura);
        cargarDesembolsosCerteros();
        cargarDesembolsosCotizacion();
        cargarCaidas();
        cargarColocacionesDirectas();
        cargarColocacionesIndirectas();
        cargarOperaicionesPerdidas();
        getDesembolsosCotizacionFuturos();
        cargaDataGraficos();

       /*var valBanca = "{{$busqueda['banca']}}";
        var valZonal = "{{$busqueda['zonal']}}";
        var valJefatura = $('#cboJefatura').val();
        var valEjecutivo = null;*/

        console.log("banca - "+valBanca);
        console.log("zonal - "+valZonal);
        console.log("jefatura - "+ valJefatura);
        console.log("ejecutivo - "+valEjecutivo);
    });

    $('body').on('click','.lnkNotas',function (e) {
        e.preventDefault();
        nuevoModalNotas($(this).attr('operacion'));
    });

    function nuevoModalNotas(operacion){
        $('#listaNotas .sin-resultados').addClass('hidden');
        $('#listaNotas .cargando-resultados').removeClass('hidden');
        $('#listaNotas .item-nota').remove()
        $('#modalNotas').modal();
        cargarNotas(operacion);
    }

    function cargarNotas(operacion){
        $.ajax({
            url: "{{route('be.enote.listar-notas')}}",
            type: 'GET',
            data: {
                operacion: operacion,
            },
            success: function (result) {
                var i;
                var html = '';

                $('#listaNotas .cargando-resultados').addClass('hidden');
                if (result.length == 0){
                    $('#listaNotas .sin-resultados').removeClass('hidden');
                    return;
                }

                for (i = 0; i < result.length; ++i) {
                    html += '<li class="media event item-nota">';
                    html += '<p><strong>'+ result[i].FECHA_REGISTRO.substring(0,16) + ' - </strong>' + result[i].NOTA +'</p>';
                }
                $('#listaNotas').find('.item-nota').remove().end().append(html);
            },
            error: function (xhr, status, text) {
                alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
            }
        });
    }

       

    </script>
@stop
