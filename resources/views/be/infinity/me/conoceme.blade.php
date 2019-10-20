@extends('Layouts.layout')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

@stop

<?php
//Son los usuarios que no pueden hacer modificaciones en esta ficha
$soloLectura = in_array(Auth::user()->ROL, array_merge(App\Entity\Usuario::getEquipoInfinity()));
?>

@section('pageTitle','Ficha Conóceme')

@section('tituloDerecha')
<h3>Ventas: S/. {{number_format($cliente->getValue('_ventas'),0,'.',',')}} ({{$cliente->getValue('_cefDJFecha')->year}})</h3>
@stop

@section('content')


<style type="text/css">
    .tooltip-inner {
        max-width: 300px;
        /* If max-width does not work, try using width instead */
        width: 300px;
    }

    .fv-plugins-icon {
        display: none;
    }

    .form-control {
        padding: 6px 10px !important;
    }

</style>

<!--Flag de solo lectura-->
<input type="text" id="soloLectura" value="{{$soloLectura}}" hidden="">

<form id="formConoceme" action="{{route('infinity.me.cliente.conoceme.guardar')}}" method="POST">
    <input type="hidden" name="codunicoConoceme" value="{{$cliente->getValue('_codunicoConoceme')}}">
    <input type="hidden" name="codunico" value="{{$cliente->getValue('_codunico')}}">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Datos Generales</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6 form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Empresa</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_nombre')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Cod. Unico</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly="readonly" value="{{$cliente->getValue('_codunico')}}" name="codunico">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Ubicación</label>
                                <div class="col-sm-4 col-xs-12">
                                    <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_provincia')}}">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_distrito')}}">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class="control-label col-sm-6 col-xs-12">Inic. IBK </label>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" name="inicioIBK"  value="{{$cliente->getValue('_inicioIbk')}}" maxlength="4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class="control-label col-sm-6 col-xs-12">Inic. Operaciones</label>
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" name="inicioOperacion"  value="{{$cliente->getValue('_inicioOperacion')}}" maxlength="4">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Actividad</label>
                                <div class="col-sm-9 col-xs-12">
                                    <select class="form-control " name="actividad">
                                        <option value="">--Elegir Opción--</option>
                                        @foreach($actividades as $actividad)
                                        <option value="{{$actividad}}" {{($cliente->getValue('_actividad')==$actividad)?'selected':''}}>{{$actividad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Subsector</label>
                                <div class="col-sm-9 col-xs-12">
                                    <select class="form-control" name="subsector" name="subsector">
                                        <option value="">--Elegir Opción--</option>
                                        @foreach($subsectores as $subsector)
                                        <option value="{{$subsector}}" {{($cliente->getValue('_subsector')==$subsector)?'selected':''}}>{{$subsector}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Backlog
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                       data-html="true" 
                                       data-title="{{$txtBacklog}}"
                                       ></i>
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <select class="form-control" name="backlog">
                                        <option value="">--Elegir Opción--</option>
                                        @foreach($backlog as $b)
                                        <option value="{{$b}}" {{($cliente->getValue('_backlog')==$b)?'selected=selected':''}}>{{$b}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Modelo de Negocio
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Descripción o detalle del cómo la empresa crea y entrega valor"></i>
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <textarea class="form-control noActualizable" maxlength="500" rows="3" name="modeloNegocio">{{$cliente->getValue('_modeloNegocio')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Ventaja Competitiva
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Señalar la principal ventaja competitiva en su sector"></i>
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <textarea class="form-control noActualizable" maxlength="500" rows="3" name="ventajaCompetitiva">{{$cliente->getValue('_ventajaCompetitiva')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Fortalezas y Riesgos
                                    <i class="fa fa-question-circle noActualizable" data-toggle="tooltip" data-placement="top"  data-original-title="Señalar principales fortalezas y riesgos"></i>
                                </label>
                                <div class="col-sm-9 col-xs-12">
                                    <textarea class="form-control noActualizable" maxlength="500" rows="3" name="fortalezasRiesgos">{{$cliente->getValue('_fortalezasRiesgos')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Zona de Operaciones</label>
                                <div class="col-sm-9 col-xs-12">
                                    <button data-toggle="modal" data-target="#modalZonaOperaciones" type="button" class="btn btn-primary">Lista de Zonas de Operacion</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Zona de Clientes</label>
                                <div class="col-sm-9 col-xs-12">
                                    <button data-toggle="modal" data-target="#modalZonaClientes" type="button" class="btn btn-primary">Lista de Zonas de clientes</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p><b>Mix de Ventas</b></p>
                            @for($i=0;$i<3;$i++)
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input class="form-control noActualizable" placeholder="Producto/Servicio" type="text" name="mixVenta[{{$i}}][productoServicio]" maxlength="50" value="{{isset($cliente->getValue('_mixVentas')[$i])?$cliente->getValue('_mixVentas')[$i]->getValue('_productoServicio'):''}}">
                                </div>
                                <div class="form-group col-sm-6"> 
                                    <select class="form-control noActualizable" name="mixVenta[{{$i}}][participacion]">
                                        <option value="">-Seleccionar-</option>
                                        @foreach ($participacion as $key => $par)
                                        <option value="{{$key}}"
                                                {{isset($cliente->getValue('_mixVentas')[$i]) && $cliente->getValue('_mixVentas')[$i]->getValue('_participacion') == $key ?'selected':''}}
                                            >{{$par}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endfor
                            <!--
                            <div class="ln_solid"></div>
                            <div class="row">
                                <label class="control-label col-sm-6">¿Está integrado verticalmente con la cadena de valor?
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Completar si la gestión financiera es por un Gerente Financiero o por un Asesor Financiero"></i>
                                </label>
                                <div class="form-group col-sm-6">
                                    <select class="form-control" name="flagIntegracionVertical" value="{{$cliente->getValue('_flagIntegracionVertical')}}">
                                        <option value="">No aplica</option>
                                        <option value="1" {{($cliente->getValue('_flagIntegracionVertical')==='1')?'selected=selected':''}}>Si</option>
                                        <option value="0" {{($cliente->getValue('_flagIntegracionVertical')==='0')?'selected=selected':''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            -->
                            <div class="ln_solid"></div>
                            <p><b>Canales de Ventas</b></p>
                            @for($i=0;$i<3;$i++)
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <select class="form-control" name="canalVenta[{{$i}}][canales]">
                                        <option value="" >Seleccionar opción</option>
                                        @foreach ($canales as $key => $par)
                                        <option value="{{$par}}"
                                                {{isset($cliente->getValue('_canalVentas')[$i]) && $cliente->getValue('_canalVentas')[$i]->getValue('_canal') == $par ?'selected = "selected"':''}}
                                            >{{$par}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6"> 
                                    <select class="form-control " name="canalVenta[{{$i}}][participacion]">
                                        <option value="">-Seleccionar-</option>
                                        @foreach ($participacion as $key => $par)
                                        <option value="{{$key}}"
                                                {{isset($cliente->getValue('_canalVentas')[$i]) && $cliente->getValue('_canalVentas')[$i]->getValue('_participacion') == $key ?'selected = "selected"':''}}
                                            >{{$par}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endfor
                            <div class="ln_solid"></div>
                            <div class="areaGestionCompras">
                                <div class="row">
                                    <label class="control-label col-sm-6">¿Cómo gestionas tu compra?</label>
                                    <div class="form-group col-sm-6">
                                        <select class="form-control noActualizable" name="gestionesCompra" value="{{$cliente->getValue('_gestionesCompra')}}">
                                            <option value="">--Elegir Opción--</option>
                                            @foreach($gestionesCompra as $b)
                                            <option value="{{$b}}" {{($cliente->getValue('_gestionesCompra')==$b)?'selected=selected':''}}>{{$b}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <label class="control-label col-sm-4">Procedencia Materia Prima</label>
                                        <div class="col-sm-8 col-xs-12">
                                            <select class="form-control" name="materiaPrima">
                                                <option value="">Seleccionar</option>
                                                <option value="Local" {{$cliente->getValue('_procedenciaMateriaPrima') == 'Local'?'selected':''}}>Local</option>
                                                <option value="Exterior" {{$cliente->getValue('_procedenciaMateriaPrima') == 'Exterior'?'selected':''}}>Exterior</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="row">
                                        <label class="control-label col-sm-4">¿Afectado a Commoditie?</label>
                                        <div class="col-sm-8 col-xs-12">
                                            <select class="select2_multiple form-control" multiple="multiple" name="commodity[]">
                                                @foreach ($commodities as $commodity)
                                                <option value="{{$commodity}}" {{isset($cliente->getValue('_commodities')[$commodity])?'selected':''}}>{{$commodity}}</option>
                                                @endforeach  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-3"><b>RUC</b></div>
                        <div class="col-sm-4"><b>Nombre</b></div>
                        <div class="col-sm-3"><b>Particip.</b></div>
                        <div class="col-sm-2"><b>Año</b></div>
                    </div>
                    @for($i=0;$i<3;$i++)
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <input class="form-control noActualizable" type="text" name="cliente[{{$i}}][documento]" maxlength="11" value="{{isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_documento'):''}}">
                        </div>
                        <div class="form-group col-sm-4"> 
                            <input class="form-control noActualizable" type="text" name="cliente[{{$i}}][nombre]" maxlength="50" value="{{isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_nombre'):''}}">
                        </div>
                        <div class="form-group col-sm-3"> 
                            <select class="form-control noActualizable" name="cliente[{{$i}}][participacion]">
                                <option value="">-Seleccionar-</option>
                                @foreach ($participacion as $key => $par)
                                <option value="{{$key}}"
                                        {{isset($cliente->getValue('_clientes')[$i]) && $cliente->getValue('_clientes')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''}}
                                    >{{$par}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input class="form-control noActualizable" type="text" name="cliente[{{$i}}][desde]" maxlength="4" value="{{isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_desde'):''}}">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proveedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-3"><b>RUC</b></div>
                        <div class="col-sm-3"><b>Nombre</b></div>
                        <div class="col-sm-3"><b>Particip.</b></div>
                        <div class="col-sm-1"><b>Exclu.</b></div>
                        <div class="col-sm-2"><b>Año</b></div>
                    </div>
                    @for($i=0;$i<3;$i++)
                    <div class="row">
                        <div class="form-group col-sm-3"> 
                            <input class="form-control noActualizable" datav-tipo="documento" type="text" name="proveedor[{{$i}}][documento]" maxlength="11" value="{{isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_documento'):''}}">
                        </div>
                        <div class="form-group col-sm-3"> 
                            <input class="form-control noActualizable" type="text" name="proveedor[{{$i}}][nombre]" maxlength="50" value="{{isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_nombre'):''}}">
                        </div>
                        <div class="form-group col-sm-3"> 
                            <select class="form-control noActualizable" name="proveedor[{{$i}}][participacion]">
                                <option value="">-Seleccionar-</option>
                                @foreach ($participacion as $key => $par)
                                <option value="{{$key}}"
                                        {{isset($cliente->getValue('_proveedores')[$i]) && $cliente->getValue('_proveedores')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''}}
                                    >{{$par}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-1"> 
                            <input class="noActualizable" type="checkbox" name="proveedor[{{$i}}][exclusividad]"  {{isset($cliente->getValue('_proveedores')[$i]) && $cliente->getValue('_proveedores')[$i]->getValue('_exclusividad') == 1 ?'checked':''}}>
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input class="form-control noActualizable" type="text" name="proveedor[{{$i}}][desde]" maxlength="4" value="{{isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_desde'):''}}">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Accionistas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">G. General</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type="text" class="form-control noActualizable" name="gerenteGeneral" value="{{$cliente->getValue('_gerenteGeneral')}}" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-xs-11">
                            <select class="form-control noActualizable" name="financieroRol" value="{{$cliente->getValue('_financieroRol')}}">
                                <option value="">--Elegir Opción--</option>
                                @foreach($financieroRol as $b)
                                <option value="{{$b}}" {{($cliente->getValue('_financieroRol')==$b)?'selected=selected':''}}>{{$b}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1 col-xs-1">
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Seleccionar quién se encarga de la gestión financiera y el nombre de la persona"></i>
                        </div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="text" class="form-control noActualizable" name="financieroNombre" value="{{$cliente->getValue('_financieroNombre')}}" maxlength="50">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">Contabilidad</label>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control noActualizable" name="tipoContabilidad" value="{{$cliente->getValue('_tipoContabilidad')}}">
                                <option value="Interna" {{($cliente->getValue('_tipoContabilidad')=='Interna')?'selected=selected':''}}>Interna</option>
                                <option value="Externa" {{($cliente->getValue('_tipoContabilidad')=='Externa')?'selected=selected':''}}>Externa</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3"><b>DNI</b></div>
                        <div class="col-sm-4"><b>Accionista</b></div>
                        <div class="col-sm-3"><b>Particip.</b></div>
                    </div>
                    @for($i=0;$i<5;$i++)
                    <div class="row">
                        <div class="form-group col-sm-3"> 
                            <input class="form-control noActualizable" type="text" name="accionista[{{$i}}][documento]" maxlength="11" value="{{isset($cliente->getValue('_accionistas')[$i])?$cliente->getValue('_accionistas')[$i]->getValue('_documento'):''}}">
                        </div>
                        <div class="form-group col-sm-4"> 
                            <input class="form-control noActualizable" type="text" name="accionista[{{$i}}][nombre]" maxlength="50" value="{{isset($cliente->getValue('_accionistas')[$i])?$cliente->getValue('_accionistas')[$i]->getValue('_nombre'):''}}">
                        </div>
                        <div class="form-group col-sm-4"> 
                            <select class="form-control noActualizable" name="accionista[{{$i}}][participacion]">
                                <option value="">-Seleccionar-</option>
                                @foreach ($participacion as $key => $par)
                                <option value="{{$key}}"
                                        {{isset($cliente->getValue('_accionistas')[$i]) && $cliente->getValue('_accionistas')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''}}
                                    >{{$par}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>RCC (en miles S/.)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">Clasificación</label>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_clasificacion')}}">
                        </div>
                        <label class="control-label col-sm-3 col-xs-12">SOW</label>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" class="form-control" readonly="readonly"  
                                   value="{{$cliente->getValue('_saldoRcc') == 0? 0 : number_format($cliente->getValue('_saldoIbk')/$cliente->getValue('_saldoRcc')*100,2,'.',',')}}%">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"><b></b></div>
                        <div class="col-sm-2"><b>Deuda</b></div>
                        <div class="col-sm-3"><b>Líneas</b></div>
                        <div class="col-sm-2"><b>Garant.</b><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                                               data-html="true" 
                                                               data-title="Garantías Reales y Autoliquidables"
                                                               ></i></div>
                        <div class="col-sm-3"><b>Tipo</b></div>
                    </div>
                    @foreach ($bancos as $key => $banco)
                    <div class="row">
                        <div class="form-group col-sm-2"> 
                            <label class="control-label">{{$banco}}</label>
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input type="text" class="form-control" readonly="readonly" value="{{isset($rcc['Deuda'][$key])? number_format($rcc['Deuda'][$key]->MONTO/1000,0,'.',','):0}}">
                        </div>
                        <div class="form-group col-sm-3"> 
                            <input type="text" class="form-control noActualizable" name="linea[{{$key}}][monto]" maxlength="5" value="{{isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_linea'):''}}">
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input type="text" class="form-control" readonly="readonly" value="{{isset($rcc['Garantia'][$key])? number_format($rcc['Garantia'][$key]->MONTO/1000,0,'.',','):0}}">
                        </div>
                        <div class="form-group col-sm-3"> 
                            <select class="form-control noActualizable" name="linea[{{$key}}][tipoGarantia]">
                                <option value="">Seleccionar</option>
                                @foreach ($tiposGarantia as $tipoGarantia)
                                <option value="{{$tipoGarantia}}"
                                        {{isset($cliente->getValue('_lineas')[$key]) && $cliente->getValue('_lineas')[$key]->getValue('_tipoGarantia') == $tipoGarantia? 'selected':''}}
                                    >{{$tipoGarantia}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 {{$cliente->getValue('_fechaActualizacion')?'':'hidden'}}">
            <div class="x_panel">
                <div class="x_content form-horizontal text-center">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Última Fecha de Actualización</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_fechaActualizacion')?$cliente->getValue('_fechaActualizacion')->format('l, j \\d\\e F Y'):'-'}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Último usuario en actualizar</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" readonly="readonly"  value="{{$cliente->getValue('_usuarioNombre')?$cliente->getValue('_usuarioNombre'):'-'}}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @if (in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE()))
        <div class="col-sm-6">
            <div class="x_panel">
                <div class="x_content form-horizontal text-center">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Usuario</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" readonly="readonly"  value="{{$usuario->getValue('_nombre')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Fecha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" readonly="readonly"  value="{{Jenssegers\Date\Date::now()->format('l, j \\d\\e F Y')}}">
                        </div>
                    </div>
                    <div class="col-sm-12 center">
                        <button class="btn btn-primary" type="submit">
                            {{$cliente->getValue('_codunicoConoceme')? 'Actualizar Ficha Conóceme':'Guardar Ficha Conóceme'}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div id="modalZonaOperaciones" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        @foreach ($zonas as $zona)
                        <div class="checkbox col-sm-3 col-xs-6" style="margin-top: 0px;">
                            <label>
                                <input class="noActualizable" type="checkbox" value="{{$zona}}" name="zonaOperacion[]" 
                                       {{isset($cliente->getValue('_zonaOperaciones')[$zona])?'checked':''}}>{{$zona}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalZonaClientes" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        @foreach ($zonas as $zona)
                        <div class="checkbox col-sm-3 col-xs-6" style="margin-top: 0px;">
                            <label>
                                <input class="noActualizable" type="checkbox" value="{{$zona}}" name="zonaCliente[]" 
                                       {{isset($cliente->getValue('_zonaClientes')[$zona])?'checked':''}}>{{$zona}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </div>
            </div>
        </div>
    </div>

</form>

@stop

@section('js-scripts')
<script>
$(document).ready(function () {

    if ($('#soloLectura').val() == '1') {
        console.log("Colocar en modo solo lectura");
        $(':input').attr('disabled', 'true');
    }

    function checkFormStatus() {
        if ($('input[name="codunicoConoceme"]').val() !== '') {
            //$('.noActualizable').prop('disabled', true);
        }

        if ($('select[name="backlog"]').val() === 'Proyectos') {
            $('.areaGestionCompras').removeClass('hidden');
        } else {
            $('.areaGestionCompras').addClass('hidden');
        }
    }

    checkFormStatus();

    $('select[name="backlog"]').change(function () {
        checkFormStatus();
    });

    $('[data-toggle="tooltip"]').tooltip();

    var validatorsDocumento = {
        digits: {
            message: 'El documento debe tener solo dígitos',
        },
        stringLength: {
            min: 8,
            message: 'El documento debe tener al menos 8 dígitos',
        },
    };

    var validatorsAnnio = {
        between: {
            min: 1980,
            max: 2030,
            message: 'Año no válido (1980 - 2030)',
        },
    };

    var validatorsLineas = {
        between: {
            min: 0,
            max: 99999,
            message: 'Línea ingresada no válida (0 - 9999)',
        },
    };


    $('#formConoceme').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: null,
            invalid: null,
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'inicioIBK': {
                validators: {
                    between: {
                        min: 1950,
                        max: 2030,
                        message: 'Año no válido (1950 - 2030)',
                    },
                }
            },
            'inicioOperacion': {
                validators: {
                    between: {
                        min: 1950,
                        max: 2030,
                        message: 'Año no válido (1950 - 2030)',
                    },
                }
            },
            'cliente[0][documento]': {
                validators: validatorsDocumento
            },
            'cliente[1][documento]': {
                validators: validatorsDocumento
            },
            'cliente[2][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[0][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[1][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[2][documento]': {
                validators: validatorsDocumento
            },
            'accionista[0][documento]': {
                validators: validatorsDocumento
            },
            'accionista[1][documento]': {
                validators: validatorsDocumento
            },
            'accionista[2][documento]': {
                validators: validatorsDocumento
            },
            'accionista[3][documento]': {
                validators: validatorsDocumento
            },
            'accionista[4][documento]': {
                validators: validatorsDocumento
            },
            'cliente[0][desde]': {
                validators: validatorsAnnio
            },
            'cliente[1][desde]': {
                validators: validatorsAnnio
            },
            'cliente[2][desde]': {
                validators: validatorsAnnio
            },
            'proveedor[0][desde]': {
                validators: validatorsAnnio
            },
            'proveedor[1][desde]': {
                validators: validatorsAnnio
            },
            'linea[BCP][monto]': {
                validators: validatorsLineas
            },
            'linea[BBVA][monto]': {
                validators: validatorsLineas
            },
            'linea[SCOTIA][monto]': {
                validators: validatorsLineas
            },
            'linea[BANBIF][monto]': {
                validators: validatorsLineas
            },
            'linea[PICHINCHA][monto]': {
                validators: validatorsLineas
            },
            'linea[HSBC][monto]': {
                validators: validatorsLineas
            }

        },
    }).off('success.form.fv');

})

</script>
@stop
