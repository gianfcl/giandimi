@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>

<style type="text/css">
    .formatoCheck{
        font-size: 14px;
    }

    .espaciado{
        padding-left: 15px;
    }
</style>
@stop

@section('content')

@section('pageTitle','Historia de Cliente - Conoceme')

<form id="frmVisita" action="{{route('infinity.me.cliente.visita.guardar')}}" method="POST">


    <!-- DATOS GENERALES DE LA EMPRESA -->
    <div class="row">
        <div class="col-xs-12" >
            <div class="x_panel" style="min-height: 70px">
                <div class="x_title">
                    <h2>{{$cliente->getValue('_nombre')}} (CU: {{$cliente->getValue('_codunico')}})</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CHECKS -->
    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Datos Generales</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <div class="row">
                            <div class="col-sm-8">
                                <label class="control-label">Empresa</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_nombre')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Cod. Unico</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_codunico')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Ubicación</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_provincia')}}</p>
                                <p>{{$cliente->getValue('_distrito')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Inic. IBK </label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_inicioIbk')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Inic. Operaciones</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_inicioOperacion')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Actividad</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_actividad')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Subsector</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_subsector')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Backlog</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_backlog')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Modelo de Negocio</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_modeloNegocio')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Ventaja Competitiva</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_ventajaCompetitiva')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Fortalezas y Riesgos</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_fortalezasRiesgos')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Zona de Operaciones</label>
                            </div>
                            <div class="col-sm-4">
                                @if ($cliente->getValue('_zonaOperaciones'))
                                    <ul>
                                        @foreach ($cliente->getValue('_zonaOperaciones') as $zonas)
                                        <li>{{$zonas->getValue('_zona')}}</li>
                                        @endforeach
                                    </ul>
                                @else 
                                <p>Ninguna</p>
                                @endif
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">Zona de Clientes</label>
                            </div>
                            <div class="col-sm-4">
                                @if ($cliente->getValue('_zonaClientes'))
                                    <ul>
                                        @foreach ($cliente->getValue('_zonaClientes') as $zonas)
                                        <li>{{$zonas->getValue('_zona')}}</li>
                                        @endforeach
                                    </ul>
                                @else 
                                <p>Ninguna</p>
                                @endif
                            </div>    
                            <div class="col-sm-8">
                                <label class="control-label">Procedencia Materia Prima</label>
                            </div>
                            <div class="col-sm-4">
                                <p>{{$cliente->getValue('_procedenciaMateriaPrima')}}</p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Afectado a commoditie?</label>
                            </div>
                            <div class="col-sm-4">
                                @if ($cliente->getValue('_commodities'))
                                    <ul>
                                        @foreach ($cliente->getValue('_commodities') as $com)
                                        <li>{{$com->getValue('_nombre')}}</li>
                                        @endforeach
                                    </ul>
                                @else 
                                <p>Ninguna</p>
                                @endif
                            </div>                            
                        </div>
                </div>
            </div>
        </div>
  

     
        <div id="panelMixVentas" class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mix de Ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <table class="table table-striped jambo_table">
                        <thead>
                            <tr>
                                <th>Producto/Servicio</th>
                                <th>Participación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliente->getValue('_mixVentas') as $producto)
                            <tr>
                                <td>{{$producto->getValue('_productoServicio')}}</td>
                                <td>{{$participaciones[$producto->getValue('_participacion')]}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Canales de Ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <table class="table table-striped jambo_table">
                        <thead>
                            <tr>
                                <th>Canales</th>
                                <th>Participación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliente->getValue('_canalVentas') as $canales)
                            <tr>
                                <td>{{$canales->getValue('_canal')}}</td>
                                <td>{{$participaciones[$canales->getValue('_participacion')]}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CLIENTES Y PROVEEDORES -->

    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>RUC</th>
                                    <th>Nombre</th>
                                    <th>Particip.</th>
                                    <th>Año </th>
                       
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->getValue('_clientes') as $cl)
                                <tr>
                                    <td>{{$cl->getvalue('_documento')}}</td>
                                    <td>{{$cl->getvalue('_nombre')}}</td>
                                    <td>{{$participaciones[$cl->getvalue('_concentracion')]}}</td>
                                    <td>{{$cl->getvalue('_desde')}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proveedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>RUC</th>
                                    <th>Nombre</th>
                                    <th>Particip.</th>
                                    <th>Exclusiv.</th>
                                    <th>Año</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->getValue('_proveedores') as $prov)
                                <tr>
                                    <td>{{$prov->getvalue('_documento')}}</td>
                                    <td>{{$prov->getvalue('_nombre')}}</td>
                                    <td>{{$participaciones[$prov->getvalue('_concentracion')]}}</td>
                                    <td>{{$prov->getvalue('_exclusividad')==1?'Si':'No'}}</td>
                                    <td>{{$prov->getvalue('_desde')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accionistas, FINANCIAMIENTOS y PROYECCION -->
    <div class="row">
        <!-- ACCIONISTAS-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Accionistas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <div class="col-sm-8">
                        <label class="control-label">Gerente General</label>
                    </div>
                    <div class="col-sm-4">
                        <p>{{$cliente->getValue('_gerenteGeneral')}}</p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">{{$cliente->getValue('_financieroRol')}}</label>
                    </div>
                    <div class="col-sm-4">
                        <p>{{$cliente->getValue('_financieroNombre')}}</p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">Contabilidad</label>
                    </div>
                    <div class="col-sm-4">
                        <p>{{$cliente->getValue('_tipoContabilidad')}}</p>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableAccionistas">
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Accionista</th>
                                    <th>Particip.</th>
                                    <th>Nac</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->getValue('_accionistas') as $acc)
                                <tr>
                                    <td>{{$acc->getvalue('_documento')}}</td>
                                    <td>{{$acc->getvalue('_nombre')}}</td>
                                    <td>{{$participaciones[$acc->getvalue('_concentracion')]}}</td>
                                    <td>{{$acc->getvalue('_nacimiento')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--
                    <div class="checkbox col-md-12 grupoCheck"  style="padding-bottom: 10px">
                        <label class="formatoCheck col-md-3">
                            <input name="flgLineaSucesion" id="flgLineaSucesion" type="checkbox" class="check">Línea de sucesión 
                        </label>
                        <div class="col-md-4">

                            <select class="form-control" name="lineaSucesion" disabled>
                                <option>Seleccione una opción</option>
                                <option value="1">Linea 1</option>
                                <option value="2">Linea 2</option>
                                <option value="3">Linea 3</option>
                            </select>
                        </div>
                    </div> 
                    -->
                </div>
            </div>
        </div>

        <!--FINANCIAMIENTOS-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>RCC (en miles S/.)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 

                    <div class="col-sm-8">
                        <label class="control-label">Clasificación</label>
                    </div>
                    <div class="col-sm-4">
                        <p>{{$cliente->getValue('_clasificacion')}}</p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">SOW</label>
                    </div>
                    <div class="col-sm-4">
                        <p>{{$cliente->getValue('_saldoRcc') == 0? 0 : number_format($cliente->getValue('_saldoIbk')/$cliente->getValue('_saldoRcc')*100,2,'.',',')}}%</p>
                    </div>
                                    
                    <div class="clearfix"></div>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>Banco</th>
                                    <th>Deuda</th>
                                    <th>Líneas</th>
                                    <th>Garantía</th>
                                    <th>Tipo Garantía</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bancos as $key => $banco)
                                <tr>
                                    <td>{{$banco}}</td>
                                    <td>{{isset($rcc['Deuda'][$key])? number_format($rcc['Deuda'][$key]->MONTO/1000,0,'.',','):0}}</td>
                                    <td>{{isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_linea'):''}}</td>
                                    <td>{{isset($rcc['Garantia'][$key])? number_format($rcc['Garantia'][$key]->MONTO/1000,0,'.',','):0}}</td>
                                    <td>{{isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_tipoGarantia'):''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!--PROYECCION-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Datos de la ficha</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group col-sm-12" >
                        <label class="control-label col-md-6 col-sm-6">Usuario</label>
                        <div class="col-md-4 col-sm-4">
                            <!--<input type="text" class="form-control" name="proyeccionInversion" value="{{$cliente->getValue('_proyeccionInversion')}}">-->
                            <p class="control-label">{{$cliente->getValue('_usuarioNombre')}}</p>
                            <!--<label class="control-label col-md-6 col-sm-6">{{$cliente->getValue('_proyeccionInversion')}}</label>-->
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="control-label col-md-6 col-sm-6">Fecha</label>
                        <div class="col-md-4 col-sm-4">
                            <!--<input type="text" class="form-control" readonly="readonly" name="proyeccionVentas" value="{{$cliente->getValue('_proyeccionVentas')}}"> -->
                            <p class="control-label">{{$cliente->getValue('_fechaActualizacion')->format('l, j \\d\\e F Y')}}</p>
                            <!--<label class="control-label col-md-6 col-sm-6">{{$cliente->getValue('_proyeccionVentas')}}</label>-->
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


</form>

@stop

@section('js-scripts')
@stop
