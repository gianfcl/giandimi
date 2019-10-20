@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >


<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/modernizr.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'E - Note')

<style type="text/css">
    .lnkRenovacion, .lnkRenovacion:hover, .lnkNotas, .lnkNotas:hover{
        text-decoration: underline;
        color: blue;
    }
</style>

<div class="row">

    <!-- SECCION: FILTROS DE BUSQUEDA !-->
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form id='formBusqueda' method="GET">
                    @if (in_array(Auth::user()->ROL,array_merge(\App\Entity\Usuario::getDivisionBE())))
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Banca:</label>
                        <div class="col-md-9">
                            <select id="cboBanca" class="form-control" name="banca">
                                <option value="">Seleccine una Banca</option>
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
                                <option value="">Selecciona una Zonal</option>
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
                                <option value="">Seleccione una Jefatura</option>
                                @foreach ($jefaturas as  $jefatura)
                                    <option value="{{$jefatura->ID_JEFATURA}}" {{($jefatura->ID_JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''}}
                                    >{{$jefatura->JEFATURA}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                        
                    @if (in_array(Auth::user()->ROL,array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE())))
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Ejecutivo:</label>
                        <div class="col-md-9">
                            <select id="cboEjecutivo" class="form-control" name="ejecutivo">
                                <option value="">Seleccione un Ejecutivo</option>
                                @foreach ($ejecutivos as  $ejecutivo)
                                    <option value="{{$ejecutivo->REGISTRO}}" {{($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''}}
                                    >{{$ejecutivo->NOMBRE}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group col-md-2">
                        <label for="" class="control-label col-md-3">Periodo:</label>
                        <div class="col-md-6">
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

    @if (in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosBE()) || ($busqueda['ejecutivo'] <> ''))

    <!-- SECCION: RESUMEN !-->
	<div class="col-xs-12">
		<div class="x_panel" >
            <div class="x_title">
                <h2>Resumen</h2>
                <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!--<li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                      </li>-->
                </ul>
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
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <!--<li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>-->
                </ul>
                <div class="clearfix"></div>
            </div>            
            <div class="row x_content">
                <div class=" col-xs-6">
                    <canvas id="divColocacionesDirectas"></canvas>
                </div>
                
                <div class=" col-xs-6">
                    <canvas id="divColocacionesIndirectas"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SECCION: VENCIMIENTOS,AMORTIZACIONES Y OPERACIONES  !-->
    <div class="col-xs-12">
        <div class="row">
            <!-- SECCION: VENCIMIENTOS  !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Vencimientos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li>
                            <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <div id="alertNuevaRenovacion" class="alert alert-success alert-dismissible fade in hidden" role="alert" >
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            Se ha agregado la renovación de manera correcta
                        </div>
                        <table class="table table-striped table-bordered jambo_table" id="tblVencimientos"  style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Vencimiento</th>
                                    <th>Monto Caída</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>

                        <div class="divVencimientoButtons hidden">
                            <button class="btn btn-success btnGuardarVencimientos" style="float: right;" onclick="guardarVencimientos($(this))">Guardar</button>
                            <button class="btn btn-default btnCancelarVencimientos" style="float: right;"">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCION: AMORTIZACIONES  !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Amortizaciones</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                            </li>
                            <!--<li>
                                <a class="close-link"><i class="fa fa-close"></i></a>
                            </li>-->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <table class="table table-striped table-bordered jambo_table" id="tblAmortizaciones" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Vencimiento</th>
                                    <th>Monto Caída</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECCION: OPERACIONES NUEVAS  !-->
            <div class="col-xs-12">
                <div class="x_panel" style="height: auto;">
                    <div class="x_title">
                        <h2>Operaciones Nuevas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                            </li>
                            <!--<li>
                                <a class="close-link"><i class="fa fa-close"></i></a>
                            </li>-->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: none;">
                        <div id="alertNuevaOperacion" class="alert alert-success alert-dismissible fade in hidden" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            Se ha agregado la operación de manera correcta
                        </div>                        
                        <div id="alertNuevaPrecancelacion" class="alert alert-success alert-dismissible fade in hidden" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            Se ha agregado la Precancelación de manera correcta
                        </div>                        
                            @if($busqueda['periodo']==\App\Entity\BE\SaldosDiarios::getParametros('PERIODO',null))
                            <button id="btnOpenModalOperacion" class="btn btn-primary">+ Ingresar Operación</button>
                            <button id="btnOpenModalRenovacion" class="btn btn-primary">+ Ingresar Renovación</button>
                            <button id="btnOpenModalPrecancelacion" class="btn btn-danger">+ Ingresar Precancelación</button>
                            @endif                            
                        <table class="table table-striped table-bordered jambo_table" id="tblOperaciones" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Acción Comercial</th>
                                    <th>Monto Certero</th>
                                    <th>Monto Cotización</th>
                                    <th>Desemb.?</th>
                                    <th>Pérdida?</th>
                                    <th>Fecha Desemb.</th>
                                    <th>Notas</th>
                                    <th>Edición</th>
                                </tr>
                            </thead>
                        </table>

                        <div class="divOperacionesButtons hidden">
                            <button class="btn btn-success btnActualizarOperaciones" style="float: right;" >Guardar</button>                            
                            <button class="btn btn-default btnCancelarActualizarOperaciones" style="float: right;"">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>

<!-- MODAL NUEVA OPERACIONES -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarOperacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Operación/Precancelación</h4>
            </div>
            <div class="modal-body">
                <div id="divBusqueda">
                    <div class="col-lg-3">
                        <label class="control-label">Razón Social::</label>
                    </div>
                    <div class="col-lg-9">
                        <div class="input-group">                        
                            <!--<input type="text" class="form-control formatInputNumber" placeholder="Ejm: 2015648468746" maxlength="11" id="txtDocumentoOperacion">-->
                            <input class="form-control" type="text" value="" name="razonSocial" id="txtRazonSocial" style="width: 200%;">                        
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnBuscarDocumento">
                                    <i class="fa fa-spinner fa-spin fa-fw fa-1x margin-bottom hidden"></i>
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->    
                </div>    
                <form id="frmNuevaOperacion" class="form-horizontal form-label-left" action="{{ route('be.enote.operacion-nueva.registro') }}" method="POST">
                    <input type="hidden" name="periodo" value="{{$busqueda['periodo']}}">
                    <input type="hidden" name="tipoOperacion" >
                    <input type="hidden" name="documento" >
                    <input type="hidden" name="codunico" >
                    <input type="hidden" id="idOperacion">
                    <input type="hidden" name="ejecutivo" value="{{$busqueda['ejecutivo']}}">
                    <div id="divClienteExistente" class="hidden">
                        <div class="form-group col-md-12" id="divNombre">
                            <label>Nombre</label>
                            <input class="form-control" readonly="readonly" name="nombre">
                        </div>
                        <div class="form-group col-md-12" id="divProducto">
                            <label>Producto</label>
                            <select class="form-control" name="producto" >
                                    <option value="inicial">--Seleccione--</option>
                                @foreach ($productos as $producto)
                                    <option value="{{$producto->ID_PRODUCTO}}">{{$producto->PRODUCTO}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12" id="divAccionComercial">
                            <label>Acción Comercial</label>
                            <select class="form-control" name="accionComercial">
                                <option value="" selected="selected">-- Seleccione --</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tipo Monto</label>
                            <select class="form-control" name="tipoMonto">
                                <option value="certero">Monto Certero</option>
                                <option value="cotizacion">Monto Cotización</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Monto (S/. Miles)</label>
                            <input class="form-control" name="monto" maxlength="10">
                        </div>
                        <div class="form-group col-md-12" id="fechaCertecera">
                            <label>Fecha Aprox. Desembolso</label>
                            <input type="text" class="form-control" id='fechaCertero' name="fechaCertero" onkeydown="return false" >
                        </div>
                        <div class="form-group col-md-12" id="fechaCotizacion">
                            <label>Fecha Aprox. Desembolso</label>
                            <input type="text" class="form-control" name="fechaCotizacion" onkeydown="return false" >
                        </div>
                    </div>

                    <div id="divClienteNuevo" class="hidden">
                        <p>No se encontraron resultados</p>
                    </div>

                    <div class="clearfix"></div>
                    <div id="divFormOperaciosButtons" class="modal-footer hidden">
                        <button type="button" class="btn btn-default" id="btnCancelOperacion" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success btnModificarOperaciones hidden"  data-dismiss="modal">Guardar</button>
                        <button type="submit" class="btn btn-success btnOcultar">Guardar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- MODAL NOTAS -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNotas">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Nota</h4>
            </div>
                <div class="modal-body">
                    @if($busqueda['periodo']==\App\Entity\BE\SaldosDiarios::getParametros('PERIODO',null))
                    <form method="POST" id="frmAgregarNota" class="form-horizontal form-label-left" action="{{ route('be.enote.agregar-nota') }}">
                        <input name="operacion" type="hidden" />
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nota:</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea class="form-control" rows="3" placeholder="Escribe aqui..." name="nota"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Guardar</button>
                            <button class="btn btn-success pull-right hidden btn-loading" disabled="disabled"><i class="fa fa-spinner fa-spin fa-fw"></i> Guardando</button>
                        </div>
                    </form>
                    @endif
                    <div class="ln_solid"></div>

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
    var valEjecutivo = "{{$busqueda['ejecutivo']}}";//$('#cboEjecutivo').val();


    if ($('#cboBanca').length > 0){
        cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());
    }else{
        if ($('#cboZonal').length > 0){
            cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
        }
        else{
          if ($('#cboJefatura').length > 0){
            cboJefaturaChange($('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboZonal').val());    
          }
        }            
    }
        
    $('#cboJefatura').change(function(){
        cboJefaturaChange($(this).val(),null,null);
    });

    $('#cboZonal').change(function(){
        cboZonalChange($(this).val(),null,null);
    });
                    

    $('#cboBanca').change(function(){
        cboBancaChange($(this).val(),null,null,null);
    });

    function cboJefaturaChange(jefatura,ejecutivo,zonal) {

        var cboEjecutivo = $('#cboEjecutivo');
        //Limpiamos el combobox de ejecutivos
        cboEjecutivo.find('option:not(:first)').remove();
        
        
        //Si selecciona cualquier otro resultado
        cboEjecutivo.prop('disabled', true);
        $.ajax({
            type: "GET",
            data: {
                jefatura: jefatura,
                zonal: zonal
            },
            url: APP_URL + 'be/utils/get-ejecutivos-by-jefatura',
            dataType: 'json',
            success: function (json) {
                $.each(json, function (key, value) {
                    cboEjecutivo.append($("<option></option>")
                        .attr("value", value.REGISTRO).text(value.NOMBRE));
                });
                if (ejecutivo){
                    cboEjecutivo.val(ejecutivo);
                }
                cboEjecutivo.prop('disabled', false);
            }
        });
    }

    function cboZonalChange(zonal,jefatura,ejecutivo) {

            var cboJefatura = $('#cboJefatura');
            var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de ejecutivos
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
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
                    cboJefaturaChange(jefatura,ejecutivo,zonal);
                }
            });
    }    

    function cboBancaChange(banca,zonal,jefatura,ejecutivo) {
            var cboZonal = $('#cboZonal');
            var cboJefatura = $('#cboJefatura');
            var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
            //Si no selecionada nada como resultado
            if (!banca) {
                cboZonal.val('');
                cboZonal.prop('disabled',false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboZonal.prop('disabled', true);
            //cboJefatura.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true); 

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
                    cboZonalChange(zonal,jefatura,ejecutivo);
                }
            });
    }   


    /*** GRAFICOS ****/

    var dataGraficos;

    function cargaDataGraficos(){
        $.ajax({
            url: APP_URL + '/be/enote/graficar',
            dataType:"json",
            data: {
                    ejecutivo: valEjecutivo,
                    periodo: $('#cboPeriodo').val()
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
                   
                    //console.log(resp.DIA+'/'+resp.MES);
                    //console.log(resp.PROYECCION_DIRECTAS);

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
    function valCeros(){
        if(this!=0){
            return this;
        }else{
            return null;
        }
    }
    function cargarColocacionesDirectas(dias,mpromedio,mpunta,proyeccion,min = 0){        
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
                        text: 'Colocaciones Directas (Miles)'
                    },
                    scales:{
                        xAxes:[{
                           ticks: {
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 90,                                
                           }     
                        }],
                        yAxes:[{
                            ticks:{                                
                                min : min,                                
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
                                //console.log(tooltipItem);                                                              
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

    function cargarColocacionesIndirectas(dias,mpromedio,mpunta,proyeccion,min = 0){
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
                    text: 'Colocaciones Indirectas (Miles)' 
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
                                    /*var labelCabecera = data.datasets[tooltipItem.datasetIndex].label || '';                                    
                                    var label = labelCabecera+': ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                    return label;*/
                            },
                            afterBody: function(tooltipItem, data) {
                                //console.log(dataGraficos[tooltipItem[2].index]);
                                if (dataGraficos[tooltipItem[1].index].SALDO_PUNTA_INDIRECTAS == null){
                                    text = [];
                                    text.push('Desembolso: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].DESEMBOLSO_INDIRECTA).toFixed(0)));
                                    text.push('Amortizacion: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].AMORTIZACION_INDIRECTA).toFixed(0)));
                                    text.push('Vencimiento: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].VENCIMIENTO_INDIRECTA).toFixed(0)));
                                    text.push('Pre Cancelaciones: ' + formatNumber(parseFloat(dataGraficos[tooltipItem[1].index].PRE_CANCELACIONES_INDIRECTA).toFixed(0)));
                                    return text;  
                                }else{
                                    var date = new Date(dataGraficos[tooltipItem[1].index].FECHA);
                                    var day = date.getDay();

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

    /********* Clases De Operaciones Nuevas *******/

    //Objeto simple de vencimiento amortizacion
    class OperacionNueva {
        constructor(row) {
            this.id = row.ID_OPERACION;
            this.flagDesembolso = row.FLG_DESEMBOLSADO;
            this.flagPerdida = row.FLG_PERDIDO;
            this.MontoCert = row.MONTO_CERT;
            this.MontoEncot = row.MONTO_ENCOT;  
            this.fechaDesembolso = row.FECHA_DESEMBOLSO;          
        }

        setFlagDesembolsado(flag){
            this.flagDesembolso = flag;
            if (this.flagDesembolso == '1'){
                this.flagPerdida = '0';
            }
        }

        setFlagPerdida(flag){
            this.flagPerdida = flag;
            if (this.flagPerdida == '1'){
                this.flagDesembolso = '0';
            }
        }
        setMontoEncot(monto){
            this.MontoEncot = monto;
        }
        setMontoCert(monto){
            this.MontoCert = monto;
        } 
        getMontoEncot(){
            return this.MontoEncot;
        }
        getMontoCert(){
            return this.MontoCert;
        }     
        getFlagDesembolso(){
            return this.flagDesembolso;
        }

        getFlagPerdida(){
            return this.flagPerdida;
        }
        getFechaDesembolso(){
            return this.fechaDesembolso;
        }
        setFechaDesembolso(fecha){
             this.fechaDesembolso = fecha;
        }
        getId(){
            return this.id;
        }

        equals(obj){
            //evalua el key de la tabla es igual a lo que quiero comparar
            return this.id == obj.getId();
        }

    }

    //Lista de items a actualizar
    class listaOperaciones {
        constructor(){
            this.lista = [];
        }

        get(index){
            return this.lista[index];
        }

        buscar(operacion){
            
            for (var i = 0; i < this.lista.length; i++) {
                if(this.lista[i].equals(operacion)){
                    return i;
                }
            }
            return false;
        }

        agregar(operacion){
            //buscando el item
            var result = this.buscar(operacion);
            //si lo encuentra, lo eliminamos
            if (result !== false){
                this.lista.splice(result, 1);
            }
            //insertamos el iteam
            this.lista.push(operacion);
        }

        clean(){
            this.lista = [];
        }

        toParam(){
            return this.lista;
        }
    }

        /********* FIN Clases De Operaciones Nuevas *******/


        // Variables globales
        var listaOperac = new listaOperaciones();
        var currentRow;
        var tablaVencimientos;
        var tablaAmortizaciones;
        var tablaOperaciones;
        var formNuevaOperacion;
       
        function cargarResumen(valEjecutivo,periodo){
            console.log(valEjecutivo);
            $.ajax({
                    url: APP_URL + '/be/enote/resumen',
                    type: 'GET',
                    data: {ejecutivo: valEjecutivo,
                           periodo :periodo 
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

        function cargarVencimientos(){

            tablaVencimientos = $('#tblVencimientos').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 3, "desc" ]],
                language: {"url": APP_URL + "dataTables.spanish.lang"},
                ajax: {
                    "url" : '{{ route('be.enote.get-vencimientos') }}',
                    "data": {
                        ejecutivo: valEjecutivo,
                        periodo: {{$busqueda['periodo']}},
                    }    
                },
                columnDefs:[
                    {
                        targets:3,
                        data:null,
                        //searchable: false,
                        render:function(data,type,row,meta){
                            return formatNumber(row.MONTO_SOLES);
                        }
                    },
                    {
                        targets:4,
                        data:null,
                        searchable: false,
                        render:function(data,type,row,meta){
                            if({{$busqueda['periodo']}}=={{\App\Entity\BE\SaldosDiarios::getParametros('PERIODO',null)}}){
                                if(row.FLG_SE_RENUEVA!=1){
                                    return '<a class="lnkRenovacion" href="#" documento="'+ row.NUM_DOC +'" monto="' + row.MONTO_SOLES +'" producto="'+ row.ID_PRODUCTO +'" flg="'+row.FLG_SE_RENUEVA+'" >Renovar</a>';
                                }else{
                                    return '<p class="" href="#" documento="'+ row.NUM_DOC +'" monto="' + row.MONTO_SOLES +'" producto="'+ row.ID_PRODUCTO +'">Renovar</p>';    
                                }
                            
                            }
                            return '<p class="" href="#" documento="'+ row.NUM_DOC +'" monto="' + row.MONTO_SOLES +'" producto="'+ row.ID_PRODUCTO +'">Renovar</p>';
                        }
                    },
                ],
                columns: [
                    { data: 'NOMBRE', name: 'WL.NOMBRE' },
                    { data: 'PRODUCTO', name: 'WP.PRODUCTO' },
                    { data: 'FECHA_VENCIMIENTO', name: 'WVA.FECHA_VENCIMIENTO', searchable: false },
                    { data: 'MONTO_SOLES', name: 'MONTO_SOLES',searchable: false,},
                ]
            });
        }

        function cargarAmortizaciones(){
            tablaAmortizaciones = $('#tblAmortizaciones').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 3, "desc" ]],
                language: {"url": APP_URL + "dataTables.spanish.lang"},
                ajax: {
                    "url" : '{{ route('be.enote.get-amortizaciones') }}',
                    "data": {
                        ejecutivo: valEjecutivo,
                        periodo: $('#cboPeriodo').val(),
                    }
                },
                columnDefs:[
                    {
                        targets:3,
                        data:null,
                        render:function(data,type,row,meta){
                            return formatNumber(row.MONTO_SOLES);
                        }
                    },
                ],
                columns: [
                    { data: 'NOMBRE', name: 'WL.NOMBRE' },
                    { data: 'PRODUCTO', name: 'WP.PRODUCTO' },
                    { data: 'FECHA_VENCIMIENTO', name: 'WVA.FECHA_VENCIMIENTO', searchable: false },
                    { data: 'MONTO_SOLES', name: 'MONTO_SOLES', searchable: false },
                ]
            });
        }

        function cargarOperaciones(){
            tablaOperaciones = $('#tblOperaciones').DataTable({
                processing: true,
                serverSide: true,
                language: {"url": APP_URL + "dataTables.spanish.lang"},
                ajax: {
                    "url" : '{{ route('be.enote.get-operaciones') }}',
                    "data": {
                        ejecutivo: valEjecutivo,
                        periodo: $('#cboPeriodo').val(),
                    }
                },
                listaOperaciones: listaOperac,
                columnDefs:[
                    {
                        targets:3,
                        data:null,
                        render:function(data,type,row,meta){                                                        
                            return formatNumber(row.MONTO_CERT);
                        }
                    },
                    {
                        targets:4,
                        data:null,
                        render:function(data,type,row,meta){
                            return formatNumber(row.MONTO_ENCOT);                           
                        }
                    },
                    {
                        targets:5,
                        data:null,
                        render:function(data,type,row,meta){
                            var html = '<input type="checkbox" class="chkFlagDesembolsado" ';

                            //Busca si el objeto esta dentro de la lista a editar
                            obj = new OperacionNueva(row);
                            listaOperaciones = meta.settings.oInit.listaOperaciones;
                            index = listaOperaciones.buscar(obj);

                            if(index !== false){
                                //Si lo está toma el valor a editar
                                check = listaOperaciones.get(index).getFlagDesembolso();
                            }else{
                                //En caso contrario toma lo que se encuentra en BD
                                check = row.FLG_DESEMBOLSADO
                            }

                            if(check == 1){
                                html += 'checked />';
                            }else{
                                html += '/>';
                            }
                            return html;
                        }
                    },
                    {
                        targets:6,
                        data:null,
                        render:function(data,type,row,meta){
                            var html = '<input type="checkbox" class="chkFlagPerdida" ';

                            //Busca si el objeto esta dentro de la lista a editar
                            obj = new OperacionNueva(row);
                            listaOperaciones = meta.settings.oInit.listaOperaciones;
                            index = listaOperaciones.buscar(obj);

                            if(index !== false){
                                //Si lo está toma el valor a editar
                                check = listaOperaciones.get(index).getFlagPerdida();
                            }else{
                                //En caso contrario toma lo que se encuentra en BD
                                check = row.FLG_PERDIDO
                            }

                            if(check == 1){
                                html += 'checked />';
                            }else{
                                html += '/>';
                            }
                            return html;
                        }
                    },
                    {
                        targets:8,
                        data:null,
                        render:function(data,type,row,meta){
                            if({{$busqueda['periodo']}}=={{\App\Entity\BE\SaldosDiarios::getParametros('PERIODO',null)}}){
                            return '<a href="#" class="lnkNotas" operacion="' + row.ID_OPERACION +'"><i class="fa fa-plus-circle fa-2x"></i></a>';
                            }
                            return '<p href="#" class="" operacion="' + row.ID_OPERACION +'"></p>';
                        }
                    
                    },
                    {
                        targets:9,
                        data:null,
                        render:function(data,type,row,meta){
                            if({{$busqueda['periodo']}}=={{\App\Entity\BE\SaldosDiarios::getParametros('PERIODO',null)}}){
                            return '<a href="#"  class="lnkEditar" operacion="' + row.ID_OPERACION +'"><i class="fa fa-edit fa-2x"></i></a>';
                            }
                            return '<p href="#" class="" operacion="' + row.ID_OPERACION +'"></p>';
                        }
                    }
                ],
                columns: [
                    { data: 'CLIENTE', name: 'CLIENTE' },
                    { data: 'PRODUCTO', name: 'PRODUCTO' },
                    { data: 'ESTRATEGIA', name: 'ESTRATEGIA'},
                    { data: 'MONTO_CERT', name: 'MONTO_CERT', searchable: false},
                    { data: 'MONTO_ENCOT', name: 'MONTO_ENCOT', searchable: false},
                    { data: 'FLG_DESEMBOLSADO', name: 'WON.FLG_DESEMBOLSADO', searchable: false },
                    { data: 'FLG_PERDIDO', name: 'WON.FLG_PERDIDO', searchable: false },
                    { data: 'FECHA_DESEMBOLSO', name: 'FECHA_DESEMBOLSO', searchable: false },
                    //{ data: 'FECHA_DESEMBOLSO', name: 'WON.FECHA_DESEMBOLSO', searchable: false },
                ]
            });
        }

        $(document).ready(function(){
            
            cargarResumen('{{$busqueda['ejecutivo']}}',{{$busqueda['periodo']}});
            cargarVencimientos();
            cargarAmortizaciones();
            cargarOperaciones();
            formNuevaOperacion = initializeFormNuevaOperacion();
            cargaDataGraficos();
            autocompleteCliente();
        })

        $( '#divClienteExistente select[name="tipoMonto"]' ).change(function() {
            var tipoMonto =  this.value;
            //alert(tipoMonto);
            var dateText = '{{\Jenssegers\Date\Date::createFromFormat('Y-m-d',\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_S',$busqueda['periodo']))->addDay()->format('Y-m-d')}}';                                 
            document.getElementById('fechaCertero').value = dateText;
            

            if(tipoMonto=='cotizacion'){
                $('#fechaCertecera').addClass('hidden');
                $('#fechaCotizacion').removeClass('hidden');
            }else{
                $('#fechaCotizacion').addClass('hidden');
                $('#fechaCertecera').removeClass('hidden');
            }
        });

        function changeTipo(){


            var tipoMonto =  ('#divClienteExistente select[name="tipoMonto"]').value;
            //alert(tipoMonto);
            //alert(tipoMonto);
            var dateText = '{{\Jenssegers\Date\Date::createFromFormat('Y-m-d',\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_S',$busqueda['periodo']))->addDay()->format('Y-m-d')}}';                                 
            document.getElementById('fechaCertero').value = dateText;           

            if(tipoMonto=='cotizacion'){
                $('#fechaCertecera').addClass('hidden');
                $('#fechaCotizacion').removeClass('hidden');
            }else{
                $('#fechaCotizacion').addClass('hidden');
                $('#fechaCertecera').removeClass('hidden');
            }
        }

        /* ACCIONES PARA VENCIMIENTOS */
        $('body').on('click','.lnkRenovacion',function(e){
            abrirOperaciones();
            $('#frmNuevaOperacion input[name="tipoOperacion"]').val(3);
            $('#divBusqueda').addClass('hidden');
            $('#divClienteNuevo').addClass('hidden');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');
            $("#modalAgregarOperacion").removeClass('hidden');            
            $("#modalAgregarOperacion").modal();
            changeTipo();
            buscarDocumento($(this).attr('documento'),$(this).attr('monto'),$(this).attr('producto'));                     
        }); 
        /*BORRAR VALORES*/
        $('#btnCancelOperacion').click(function(){

            $(this).parent('#modalAgregarOperacion').find('#txtDocumentoOperacion').val('');
            $(this).parent('#modalAgregarOperacion').find('name="monto').val('');

            abrirOperaciones();
        })
        /* ACCIONES PARA NUEVAS OPERACIONES */
        $('body').on('click','.chkFlagDesembolsado',function(e){
            data = tablaOperaciones.row($(this).closest('tr')).data();
            obj = new OperacionNueva(data);
            if ($(this).is(':checked')){
                obj.setFlagDesembolsado('1');
                $(this).closest('tr').find('.chkFlagPerdida').prop('checked', false);

            }else{
                obj.setFlagDesembolsado('0');
            }
            listaOperac.agregar(obj);
            $('.divOperacionesButtons').removeClass('hidden');
            console.log("success desemb");
        });

        $('body').on('click','.chkFlagPerdida',function(e){
            
            data = tablaOperaciones.row($(this).closest('tr')).data();
            obj = new OperacionNueva(data);
            
            if ($(this).is(':checked')){
                obj.setFlagPerdida('1');
                $(this).closest('tr').find('.chkFlagDesembolsado').prop('checked', false);
            }else{
                obj.setFlagPerdida('0');
            }
            listaOperac.agregar(obj);
            $('.divOperacionesButtons').removeClass('hidden');
            console.log("success perdida");
        });
        
        $('body').on('input','.inputMontoCerter',function(e){            
            
            data = tablaOperaciones.row($(this).closest('tr')).data();
            obj = new OperacionNueva(data);

            monto = $(this).val();        
            obj.setMontoCert(monto);
                        
            listaOperac.agregar(obj);
            
            $('.divOperacionesButtons').removeClass('hidden');            
        });

        $('body').on('input','.inputMontoCotizacion',function(e){            
            
            data = tablaOperaciones.row($(this).closest('tr')).data();
            obj = new OperacionNueva(data);

            monto = $(this).val();
            obj.setMontoEncot(monto);
            
            listaOperac.agregar(obj);
            $('.divOperacionesButtons').removeClass('hidden');            
        });

        $('.btnActualizarOperaciones').click(function(){
            var button = $(this);

            $('.divOperacionesButtons .btn').attr('disabled','disabled');
            $(this).text('Guardando...');

            $.ajax({
                type: "POST",
                data: {items: listaOperac.toParam()},
                url: APP_URL + '/be/enote/update-operaciones',
                dataType: 'json',
                success: function (response) {
                    if (response['status'] === 'ok'){
                        $('.divOperacionesButtons .btn').removeAttr('disabled','disabled');
                        $('.divOperacionesButtons').addClass('hidden');
                        $('.btnActualizarOperaciones').text('Guardar');

                        //actualizar graficos y resumenes
                        cargarResumen('{{$busqueda['ejecutivo']}}',{{$busqueda['periodo']}});                                                           
                        cargaDataGraficos();
                        /*actualizar operaciones*/
                        listaOperac.clean();
                        tablaOperaciones.draw();  
                    }
                    if (response['status'] === 'error'){
                        alert('Hubo un error al actualizar los datos : ' + response['msg'] )
                        $('.divOperacionesButtons .btn').removeAttr('disabled','disabled');
                        $('.divOperacionesButtons').addClass('hidden');
                        $('.btnActualizarOperaciones').text('Guardar');
                        /*actualizar operaciones*/
                        listaOperac.clean();
                        tablaOperaciones.draw();  
                    }
                }
            });
        });

        $('.btnCancelarActualizarOperaciones').click(function(){
            $('.divOperacionesButtons').addClass('hidden');
            listaOperac.clean();
            tablaOperaciones.draw();            
        });

        /************************************/
        /********* NUEVA OPERACION **********/
        /************************************/

        $('body').on('click','.lnkEditar',function (e) {
            e.preventDefault();

            data = tablaOperaciones.row($(this).closest('tr')).data();
            obj = new OperacionNueva(data);   

            nuevoModalOperacion(obj);
        });

        function nuevoModalOperacion(operacion){
            $('#frmNuevaOperacion input[name="tipoOperacion"]').val(3);            
            $('#divBusqueda').addClass('hidden');
            $('#divProducto').addClass('hidden');
            $('#divAccionComercial').addClass('hidden');
            $('.btnOcultar').addClass('hidden');
            $('.btnModificarOperaciones').removeClass('hidden');
            $('#divNombre').addClass('hidden');            
            $('#divClienteExistente').removeClass('hidden');
            $('#divClienteExistente').removeClass('hidden');
            $('#divFormOperaciosButtons').removeClass('hidden');                    
            $("#modalAgregarOperacion").modal(); 
            //asignar valores            
            valCot = intlRound(operacion.getMontoEncot());
            monto = 0;
            if(valCot!=0){                                
                monto =  operacion.getMontoEncot();
                $('#divClienteExistente select[name="tipoMonto"]').val('cotizacion');
                $('#divClienteExistente input[name="fecha"]').parent('div').addClass('hidden');            
            }else{
                monto =  operacion.getMontoCert();
                $('#divClienteExistente select[name="tipoMonto"]').val('certero');                            
                $('#divClienteExistente input[name="fecha"]').parent('div').removeClass('hidden');            
            }

            
            var tipo = $('#divClienteExistente select[name="tipoMonto"]').val();
            var dateText = '{{\Jenssegers\Date\Date::createFromFormat('Y-m-d',\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_S',$busqueda['periodo']))->addDay()->format('Y-m-d')}}';                                 
            document.getElementById('fechaCertero').value = dateText;           

            if(tipo=='cotizacion'){
                $('#fechaCertecera').addClass('hidden');
                $('#fechaCotizacion').removeClass('hidden');
            }else{
                $('#fechaCotizacion').addClass('hidden');
                $('#fechaCertecera').removeClass('hidden');
            }
            
            //console.log(monto);
            $('#idOperacion').val(operacion.getId());
            $('#divClienteExistente input[name="monto"]').val(intlRound(monto,3));            
            $('#divClienteExistente input[name="fecha"]').val(operacion.getFechaDesembolso());                
        }

        

        $('.btnModificarOperaciones').click(function(){
            var button = $(this);
            
            idoperacion = $('#idOperacion').val();

            //alert(idoperacion);
            data = tablaOperaciones.row($("a[operacion='"+idoperacion+"'").closest('tr')).data();
            obj = new OperacionNueva(data);    

            montoCert = 0;
            montoEncot= 0;
            val = $('#divClienteExistente select[name="tipoMonto"]').val();            
            if(val=='certero'){
                montoCert  = $('#divClienteExistente input[name="monto"]').val();
                fecha = $('#divClienteExistente input[name="fechaCertero"]').val();
            }else{
                montoEncot = $('#divClienteExistente input[name="monto"]').val();                    
                var fecCotizacion=$('#divClienteExistente input[name="fechaCotizacion"]').val();                
                if(fecCotizacion=="" || fecCotizacion == null){                    
                    fecha = obj.getFechaDesembolso();
                } else{
                    fecha = fecCotizacion;
                }
            }

                        

            obj.setFechaDesembolso(fecha);
            obj.setMontoEncot(montoEncot*1000);
            obj.setMontoCert(montoCert*1000);
            console.log(obj);
            listaOperac.agregar(obj);

            /*$('.divFormOperaciosButtons .btn').attr('disabled','disabled');
            $(this).text('Guardando...');*/            
            $.ajax({
                type: "POST",
                data: {items: listaOperac.toParam()},
                url: APP_URL + '/be/enote/update-operaciones',
                dataType: 'json',
                success: function (response) {
                    if (response['status'] === 'ok'){                                                                        
                        $('#frmNuevaOperacion').data('formValidation').resetForm();
                        //actualizar graficos y resumenes
                        cargarResumen('{{$busqueda['ejecutivo']}}',{{$busqueda['periodo']}});                                                           
                        cargaDataGraficos();
                        /*actualizar operaciones*/
                        listaOperac.clean();
                        tablaOperaciones.draw();  
                    }
                    if (response['status'] === 'error'){                   
                        /*actualizar operaciones*/
                        listaOperac.clean();
                        tablaOperaciones.draw();  
                    }
                }
            });            
        });
        function abrirOperaciones(){
            $('#divBusqueda').removeClass('hidden');
            $('#divProducto').removeClass('hidden');
            $('#divAccionComercial').removeClass('hidden');
            $('.btnOcultar').removeClass('hidden');
            $('.btnModificarOperaciones').addClass('hidden');
            $('#divNombre').removeClass('hidden');
            $('#txtRazonSocial').val('');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');
            $('#divClienteExistente select[name="tipoMonto"]').val('certero');            
            changeTipo();                         
        }
        /*
        $('#divClienteExistente select[name="tipoMonto"]').on('change', function() {
          var tipoMonto =  this.value;
          if(tipoMonto=='Cotización'){
            //alert(tipoMonto);
            alert('here');
            $('#divClienteExistente input[name="fecha"]').addClass('hidden');
            //alert($('#divClienteExistente').class());            
          }else{
            //alert(tipoMonto);
            $('#divClienteExistente input[name="fecha"]').removeClass('hidden');
          }
        })*/

        
        function intlRound(numero, decimales = 2, usarComa = false) {
            var opciones = {
                maximumFractionDigits: decimales, 
                useGrouping: false
            };
            usarComa = usarComa ? "es" : "en";
            return new Intl.NumberFormat(usarComa, opciones).format(numero);
        }
        $('#frmNuevaOperacion input[name="fechaCertero"]').datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,            
            startDate: "{{\Jenssegers\Date\Date::createFromFormat('Y-m-d',\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_S',$busqueda['periodo']))->addDay()->format('Y-m-d')}}",
            endDate: "+5m",
            format: "yyyy-mm-dd"
        }).on('changeDate', function (e) {             
            $(this).closest('form').formValidation('revalidateField', 'fecha');
        });

        $('#frmNuevaOperacion input[name="fechaCotizacion"]').datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,            
            startDate: "{{\Jenssegers\Date\Date::createFromFormat('Y-m-d',\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_S',$busqueda['periodo']))->addDay()->format('Y-m-d')}}",
            endDate: "+5m",
            format: "yyyy-mm-dd"
        }).on('changeDate', function (e) {             
            $(this).closest('form').formValidation('revalidateField', 'fecha');
        });

        $('#btnOpenModalPrecancelacion').click(function(){
            abrirOperaciones();
            $('#frmNuevaOperacion input[name="tipoOperacion"]').val(2);
            $('#divBusqueda').removeClass('hidden');
            $('#txtRazonSocial').val('');
            $('#divClienteNuevo').addClass('hidden');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');            
            $("#modalAgregarOperacion").modal();               
         });   
        
        $('#btnOpenModalOperacion').click(function(){
            abrirOperaciones();            
            $('#frmNuevaOperacion input[name="tipoOperacion"]').val(1);
            $('#divBusqueda').removeClass('hidden');
            $('#txtRazonSocial').val('');
            $('#divClienteNuevo').addClass('hidden');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');            
            $("#modalAgregarOperacion").modal();            
        });
        $('#btnOpenModalRenovacion').click(function(){
            abrirOperaciones();            
            $('#frmNuevaOperacion input[name="tipoOperacion"]').val(3);            
            $('#divBusqueda').removeClass('hidden');
            $('#txtRazonSocial').val('');
            $('#divClienteNuevo').addClass('hidden');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');            
            $("#modalAgregarOperacion").modal();            
        });

        $('#btnBuscarDocumento').click(function(){
            $('#divClienteNuevo').addClass('hidden');
            $('#divClienteExistente').addClass('hidden');
            $('#divFormOperaciosButtons').addClass('hidden');            
            buscarDocumento($('#txtDocumentoOperacion').val());            
        });

        $('#txtDocumentoOperacion').keypress(function(e){
            if(e.which == 13) {
                buscarDocumento($('#txtDocumentoOperacion').val());    
            }
            
        });

        function buscarDocumento(documento,monto=null,producto = null){            
            console.log(documento);
            console.log(monto);
            console.log(producto);
            $('#txtDocumentoOperacion').val(documento);

            if ($.inArray($.trim(documento).length, [8, 11]) == -1) {
                alert('Formato de documento incorrecto');
                return false;
            }

            form = $('#frmNuevaOperacion');

            item = $('#btnBuscarDocumento').find('.fa-search');
            item.addClass('hidden').prev().removeClass('hidden');

            $.ajax({
                url: APP_URL + 'be/enote/buscar-cliente',
                type: 'GET',
                data: {
                    documento: documento
                },
                success: function (result) {

                    if (result.existe == 'si') {


                        $('#divClienteExistente').removeClass('hidden');
                        form.find('input[name="documento"]').val(documento);
                        form.find('input[name="nombre"]').val(result['cliente']);
                        form.find('input[name="codunico"]').val(result['codunico']);

                        
                        
                        if (producto !== null){
                            form.find('select[name="producto"]').find('option[value="'+producto+'"]').prop('selected', true);
                        }else{
                            form.find('select[name="producto"]').find('option[value="inicial"]').prop('selected', true);
                        }
                        
                        if(monto !== null){
                            form.find('input[name="monto"]').val(intlRound(monto,3));
                        }else{
                            form.find('input[name="monto"]').val('');
                        }
                        
                        html = '';
                        if(result.acciones.length>0){
                            form.find('select[name="accionComercial"] option').not(':first').remove();
                                for (var i = 0; i < result.acciones.length; i++) {
                                    html += '<option value="' + result.acciones[i].key + '">' + result.acciones[i].value + '</option>';
                                }
                                form.find('select[name="accionComercial"]').append(html);
                        }else{
                            form.find('select[name="accionComercial"]').parent('div').addClass('hidden');                            
                        }
                                
                        $('#frmNuevaOperacion .modal-footer').removeClass('hidden');

                        formNuevaOperacion.data('formValidation').resetForm();
                    } else {
                        $('#divClienteNuevo').removeClass('hidden');
                    }
                    item.removeClass('hidden').prev().addClass('hidden');

                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al buscar la información, inténtelo mas tarde');
                    item.removeClass('hidden').prev().addClass('hidden');
                }
            });
        }

        function initializeFormNuevaOperacion() {
            return $('#frmNuevaOperacion').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    producto: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un producto'
                            },
                        }
                    },
                    fechaCertecera: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione una fecha'
                            },
                        }
                    },
                    monto: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese un monto'
                            },
                            numeric: {
                                message: 'Ingrese un monto válido'
                            },
                            between: {
                                min: 0,
                                max: 9999999,
                                message: 'El monto debe ser mayor a 0'
                            }
                            
                        },

                    },

                }
            })
            .off('success.form.fv')
            .on('success.form.fv', function(e) {
                // Prevent form submission
                e.preventDefault();

                var $form = $(e.target),
                    fv    = $form.data('formValidation');
                $form.formValidation('disableSubmitButtons', true);
                
                
                // Enviamos el formulario en ajax, si todo sale bien se agrega a la tabla de contactos la data
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    success: function (result) {
                        if (result.status == 'ok'){                                                        
                            $('#modalAgregarOperacion').modal('toggle');
                            tablaOperaciones.draw();
                            switch(result.operacion){
                                case 1:
                                    $('#alertNuevaOperacion').removeClass('hidden');
                                break;
                                case 2:
                                    $('#alertNuevaPrecancelacion').removeClass('hidden');
                                break;
                                case 3:
                                    $('#alertNuevaRenovacion').removeClass('hidden');
                                break;
                            }                         
                                                                                
                        }
                        if (result.status == 'error'){
                            alert(result.msg);
                        }
                        
                    },
                    error: function (xhr, status, text) {
                        e.preventDefault();
                        alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                    }
                });                
                cargaDataGraficos();
                cargarResumen('{{$busqueda['ejecutivo']}}',{{$busqueda['periodo']}});                
                
            });

        }


        /************************************/
        /************ NOTAS *****************/
        /************************************/
        $('body').on('click','.lnkNotas',function (e) {
            e.preventDefault();
            nuevoModalNotas($(this).attr('operacion'));
        });

        function nuevoModalNotas(operacion){
            initializeFormNota(operacion);
            $('#listaNotas .sin-resultados').addClass('hidden');
            $('#listaNotas .cargando-resultados').removeClass('hidden');
            $('#listaNotas .item-nota').remove()
            $('#frmAgregarNota input[name="operacion"]').val(operacion);
            $('#modalNotas').modal();
            cargarNotas(operacion);
        }

        function initializeFormNota(operacion){
            
            var form = $('#frmAgregarNota').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nota: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese una nota'
                            },
                            stringLength:{
                                message: 'La longitud máxima es de 500 caracteres',
                                max: 500,
                            }
                        }
                    }
                }
            })
            .off('success.form.fv')
            .on('success.form.fv', function (e) {
                // El form se envía por AJAX
                e.preventDefault();
                var $form = $(e.target),
                        fv = $form.data('formValidation');

                $form.formValidation('disableSubmitButtons', true);
                $form.find('.btn-success').addClass('hidden').end().find('.btn-loading').removeClass("hidden");

                $form.find()
                // Enviamos el formulario en ajax, si todo sale bien Cambiamos el estado
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    success: function (result) {
                        $('#frmAgregarNota textarea').val('');

                        $form.find('.btn-success').removeClass('hidden').end().find('.btn-loading').addClass("hidden");
                        $form.formValidation('disableSubmitButtons', false);

                        $('#listaNotas .sin-resultados').addClass('hidden');
                        html = '';
                        html += '<li class="media event item-nota">';
                        html += '<p><strong>'+ result.FECHA_REGISTRO.substring(0,16) + ' - </strong>' + result.NOTA + '</p>';
                        html+='<div align="right"><a class="fa fa-trash fa-2x" href="#" idnota ="'+result.NOTA_ID+'" registro="'+result.REGISTRO_EN+'" numdoc="'+result.NUM_DOC+'" onClick="eliminarNota(this)"></div></a>'
                        html += '</li>';
                        $('#listaNotas').prepend(html);                        
                        $form.data('formValidation').resetForm();
                    },
                    error: function (xhr, status, text) {
                        e.preventDefault();
                        alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                        $form.find('.btn-success').removeClass('hidden').end().find('.btn-loading').addClass("hidden");
                        $form.formValidation('disableSubmitButtons', false);
                    }
                });
            });
            form.data('formValidation').resetForm();
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
                        html += '<div align="right"><a class="fa fa-trash fa-2x" href="#" idnota ="'+result[i].NOTA_ID+'" registro="'+result[i].REGISTRO_EN+'" numdoc="'+result[i].NUM_DOC+'" onClick="eliminarNota(this)"> </a></div></li>';
                    }
                    $('#listaNotas').find('.item-nota').remove().end().append(html);
                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                }
            });
        }


        function eliminarNota(e){       
            //var elem= e;
            $.ajax({
                    url: "{{route('be.enote.eliminar-nota')}}",
                    type: 'POST',
                    data: {
                        id: $(e).attr('idnota'),
                        ejecutivo: $(e).attr('registro'),
                        lead: $(e).attr('numdoc'),
                    },

                    success: function (result) {
                        //document.write($(e).attr('idnota'));
                        $(e).parent('div').parent('li').remove();       
                        //cargarNotas(ejecutivo,lead);
                        
                    },
                    error: function (xhr, status, text) {
                        alert('Hubo un error al eliminar la nota , inténtelo mas tarde');
                    }
                });
        }
        /*autoCompletado Cliente*/
        function autocompleteCliente() {
                var registro = "{{$busqueda['ejecutivo']}}";
                var engine = new Bloodhound({
                    remote: {
                        url: APP_URL + '/be/enote/autocomplet?ejecutivo='+registro+'&termino=%Q%',
                        wildcard: '%Q%'
                    },
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                $('#txtRazonSocial').typeahead({
                    minLength: 3
                }, {
                    display: 'NOMBRE',
                    source: engine.ttAdapter(),            
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados</div></div>'
                        ],
                        suggestion: function (data) {                    
                            //console.log(data.NUM_DOC);
                            //alert(data.NUM_DOC);
                            return '<div class="list-group-item"  style="width:200%;"><a onClick="buscarDocumento('+data.NUM_DOC+',null,null);">' + data.NOMBRE + '</a></div>'
                        }
                    }
                })
        }

    </script>
@stop
