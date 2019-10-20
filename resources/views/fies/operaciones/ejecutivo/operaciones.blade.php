@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/custom/webfies.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >


<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/fies/DetalleOperaciones.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'Operaciones')


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Resumen</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="filterbtnGroup" role="group" aria-label="g1">

                <div class="col-md-1 col-sm-1 col-xs-1">   </div>
                <div class="col-md-10 col-sm-10 col-xs-10 btn-group">   
                    <button type="button" style="width: 10%" class="btn btn-sm btn-secondary " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=1'" >Pipeline<br/><span>   {{ $resumen->PIPELINE }}</span></button>
                    <button type="button" style="width: 10%" class="btn btn-sm btn-info " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=2'">Cotizacion<br/><span>{{ $resumen->COTIZACION }}</span></button>
                    <button type="button" style="width: 10%" class="btn btn-sm btn-info " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=3'">FIES<br/><span>{{ $resumen->FIES }}</span></button>
                    <button type="button" style="width: 10%" class="btn btn-sm btn-info " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=4'">Riesgos<br/><span>{{ $resumen->RIESGOS }}</span></button>
                    <button type="button" style="width: 10%" class="btn btn-sm btn-primary " data-toggle="button"  autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=5'">Aprobado<br/><span>{{ $resumen->APROBADO }}</span></button> 



                    <button type="button" style="width: 20%" class="btn btn-sm btn-success " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=6'">Desembolsado/Cobrado<br/><span>{{ $resumen->DESEMBOLSADO }}</span></button>
                    <button type="button" style="width: 20%" class="btn btn-sm btn-default " data-toggle="button" autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=7'" >Terminado<br/><span>{{ $resumen->TERMINADO }}</span></button>



                    <button type="button" style="width: 10%" class="btn btn-sm btn-secondary " data-toggle="button"  autocomplete="on" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}?idEstacion=8'">Perdida<br/><span>{{ $resumen->PERDIDA }}</span></button>

                </div>
                <div class="col-md-1 col-sm-1 col-xs-1" align="center" >  
                    <ul class="nav navbar-right panel_toolbox">
                        <li  class="{{ (Route::currentRouteName() == 'fies.operaciones.ejecutivo.operaciones.listar')? 'active':'' }}"><a  class="collapse-link" href="{{ route('fies.operaciones.ejecutivo.operaciones.listar') }}"> Ver Todos</a></li>
                    </ul>
                </div>
            </div>
            
            
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Búsqueda</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="" class="form-horizontal" method="GET">
            <div class="row">
                <div class="form-group col-md-4 col-xs-12">
                    <label for="" class="control-label col-md-4 col-xs-3">RUC:</label>
                    <div class="col-md-8 col-xs-9">
                        <input class="form-control" type="text" value="{{ $busqueda['documento'] }}" name="documento" id="txtDocumento" maxlength="15">
                    </div>
                </div>
                <div class="form-group col-md-4 col-xs-12">
                    <label for="" class="control-label col-md-4 col-xs-3">Banca/Zonal:</label>
                    <div class="col-md-8 col-xs-9">
                        <select id="cboGrupo_Zonal" name="grupo_zonal" class="form-control">
                            <option value="">---Todos----</option>
                            @foreach ($grupo_zonales as $grupo_zonal)
                            <option value="{{$grupo_zonal->GRUPO_ZONAL}}" {{($grupo_zonal->GRUPO_ZONAL === $busqueda['grupo_zonal'])? 'selected="selected"':''}}>
                                {{$grupo_zonal->GRUPO_ZONAL}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-4 col-xs-12">
                        <label for="" class="control-label col-md-4 col-xs-3">Eje. Fies:</label>
                        <div class="col-md-8 col-xs-9">
                            <select id="cboMarca" name="ejeFies" class="form-control">
                                <option value="">---Todos----</option>
                                @foreach ($ejecutivos_fies as $ejecutivo)
                                <option value="{{ $ejecutivo->REGISTRO }}" {{ ($busqueda['ejeFies'] == $ejecutivo->REGISTRO) ? 'selected="selected"' : '' }} >{{ $ejecutivo->NOMBRE }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    
                    

                </div>
                <div class="form-group">
                 <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
             </div>
         </form>
     </div>
 </div>
</div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-6 col-xs-6">
    <div class="x_panel">
      <div class="x_title">
        <h2>Lista</h2>
        <div class="form-group" style="float: right;">
            <button type="submit" class="btn btn-primary" id="btnNuevaOperacion"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Operación</button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content table-responsive">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th></th>
                    <th style="width: 10%">
                        @if(isset($orden) && $orden['sort'] == 'ejeFies')
                        @if(isset($orden) && $orden['order'] == 'desc')
                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'ejeFies','order' =>'asc'])) }}">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @else
                            <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                @endif
                                @else
                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'ejeFies','order' =>'desc'])) }}">
                                    <i class="fa fa-sort fa-lg order-icon"></i>
                                    @endif
                                </a> Eje. FIES
                            </th>

                            <th style="width: 10%">
                                @if(isset($orden) && $orden['sort'] == 'estacion')
                                @if(isset($orden) && $orden['order'] == 'desc')
                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'estacion','order' =>'asc'])) }}">
                                    <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                                    @else
                                    <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                        <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                        @endif
                                        @else
                                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'estacion','order' =>'desc'])) }}">
                                            <i class="fa fa-sort fa-lg order-icon"></i>
                                            @endif

                                        </a>Estacion
                                    </th>
                                    <th style="width: 10%">
                                        @if(isset($orden) && $orden['sort'] == 'grupo_zonal')
                                        @if(isset($orden) && $orden['order'] == 'desc')
                                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'grupo_zonal','order' =>'asc'])) }}">
                                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                                            @else
                                            <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                                @endif
                                                @else
                                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'grupo_zonal','order' =>'desc'])) }}">
                                                    <i class="fa fa-sort fa-lg order-icon"></i>
                                                    @endif
                                                </a>Banca/Zona
                                            </th>
                                            <th style="width: 10%"> @if(isset($orden) && $orden['sort'] == 'nomCliente')
                                                @if(isset($orden) && $orden['order'] == 'desc')
                                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'nomCliente','order' =>'asc'])) }}">
                                                    <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                                                    @else
                                                    <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                                        <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                                        @endif
                                                        @else
                                                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'nomCliente','order' =>'desc'])) }}">
                                                            <i class="fa fa-sort fa-lg order-icon"></i>
                                                            @endif
                                                        </a>Razon Social
                                                    </th>
                                                    <th style="width: 10%">Producto</th>
                                                    <th style="width: 15%">Monto Desemb.</th>
                                                    <th style="width: 5%" > @if(isset($orden) && $orden['sort'] == 'mesDesem')
                                                        @if(isset($orden) && $orden['order'] == 'desc')
                                                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'mesDesem','order' =>'asc'])) }}">
                                                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                                                            @else
                                                            <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                                                @endif
                                                                @else
                                                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'mesDesem','order' =>'desc'])) }}">
                                                                    <i class="fa fa-sort fa-lg order-icon"></i>
                                                                    @endif
                                                                </a>Mes Desemb</th>
                                                                <th style="width: 15%">Monto Comis.</th>
                                                                <th style="width: 5%"> @if(isset($orden) && $orden['sort'] == 'mesComi')
                                                                    @if(isset($orden) && $orden['order'] == 'desc')
                                                                    <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'mesComi','order' =>'asc'])) }}">
                                                                        <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                                                                        @else
                                                                        <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', $busqueda) }}">
                                                                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                                                                            @endif
                                                                            @else
                                                                            <a href="{{ route('fies.operaciones.ejecutivo.operaciones.listar', array_merge($busqueda,['sort' => 'mesComi','order' =>'desc'])) }}">
                                                                                <i class="fa fa-sort fa-lg order-icon"></i>
                                                                                @endif
                                                                            </a>Mes Comision</th>                  
                                                                            <th style="width: 10%">Prob.</th>
                                                                            <th ></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(count($operaciones)>0)
                                                                        @foreach ($operaciones as $operacion)
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td>
                                                                                {{ $operacion->NOMBRE }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->ULTIMO_ESTACION }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->GRUPO_ZONAL }}<br/>
                                                                                {{ $operacion->ENCARGADO }}
                                                                            </td>
                                                                            <td>
                                                                                RUC: {{ $operacion->NUM_DOC }}<br/>
                                                                                {{ $operacion->NOMBRE_CLIENTE }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->PRODUCTO }}
                                                                            </td>
                                                                            <td>
                                                                                {{ number_format((int)$operacion->MONTO_PROBABLE_DESEMB,0,'.',',') }} {{ $operacion->MONEDA_DESEMB }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->MES_PROBABLE_DESEMB }}
                                                                            </td>
                                                                            <td>
                                                                                {{ number_format((int)$operacion->MONTO_PROBABLE_COM,0,'.',',') }}  {{ $operacion->MONEDA_COM }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->MES_PROBABLE_COM }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $operacion->PROBABILIDAD }}
                                                                            </td>

                                                                            <td style="vertical-align: middle; text-align: center;">

                                                                                <a href="{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}" class="btn btn-info btn-lg">
                                                                                  <span class="glyphicon glyphicon-pencil"></span> Gestión 
                                                                              </a>
                                                                          </td>

                                                                      </tr>
                                                                      @endforeach
                                                                      @else
                                                                      <tr>
                                                                        <td colspan="4">No se encontraron resultados</td>
                                                                    </tr>@endif


                                                                </tbody>
                                                            </table>
                                                            {{ $operaciones->appends($busqueda)->links() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--MODAL NUEVA OPERACION-->
                                        <div class="modal fade" tabindex="-1" role="dialog" id="modalNuevaOperacion">
                                            <div class="modal-dialog" role="document"  style="width: 40%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Agregar Operación</h4>

                                                    </div>
                                                    <form id="formNuevaOperacion" method="POST" class="form-horizontal form-label-left"  action="{{ route('fies.operaciones.ejecutivo.operaciones.registrar-operacion') }}"  >
                                                      <div class="modal-body">
                                                        <input type="hidden" name="_token" value="" >
                                                        <input type="hidden" name="operacion" value="">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">RUC: </label>
                                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                                <input class="form-control" type="text" onkeypress="return valida(event)" value="" name="ruc" id="inRuc" maxlength="15">
                                                                <div class="alert alert-danger"  id="alertClienteWorng" style="display: none;">                                                            
                                                                    <a href="#" class="alert-link" style="font-size: 10px;" >No se encontro el cliente</a>                                                            
                                                                </div> 
                                                            </div>
                                                            <div>
                                                                <div class="form-group ">
                                                                 <button type="button" class="btn btn-primary" id="btnBuscarCliente"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                                                             </div>
                                                         </div>
                                                     </div>

                                                     <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">CU: </label>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <input id="inCU" name="codUnico" class="form-control" type="text" value="" maxlength="150">
                                                        </div>
                                                    </div>
                                                    <div  class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Razon Social: </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <input id="inRazonSocial" name="razonSocial" class="form-control" type="text" value="" maxlength="150">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                    <div  class="form-group">
                                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Ejecutivo FIES: </label>
                                                      <input type="hidden" name="page" value="{{ Auth::user()->ROL }}" >
                                                      @if( Auth::user()->ROL =="11" )

                                                      <div class="col-md-3 col-sm-9 col-xs-12">
                                                        <input  name="ejecutivoFies" onkeypress="return validaLetras(event)" class="form-control"  readonly="readonly" value="{{ Auth::user()->REGISTRO }}" >                               
                                                    </div>
                                                    <div class="col-md-6 col-sm-9 col-xs-12">
                                                        <input name="ejeFiesNom" onkeypress="return validaLetras(event)" class="form-control" readonly="readonly" value="{{ Auth::user()->NOMBRE }}" > 
                                                    </div>
                                                    @else 
                                                    <div class="col-md-6 col-sm-9 col-xs-12">
                                                     <select id="cboMarca" name="ejecutivoFies" class="form-control">
                                                        <option value="">---Todos----</option>
                                                        @foreach ($ejecutivos_fies as $ejecutivo)
                                                        <option value="{{ $ejecutivo->REGISTRO }}" {{ ($busqueda['ejeFies'] == $ejecutivo->REGISTRO) ? 'selected="selected"' : '' }} >{{ $ejecutivo->NOMBRE }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                            </div>
                                            <div  class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Fecha Registro: </label>
                                                <div class="col-md-3 col-sm-3 col-xs-6">

                                                    <input class="form-control dfecha" type="text"  name="fechaRegistro" id="Text7" maxlength="15" onkeypress="return validaLetras(event)" >

                                                </div>

                                            </div>

                                            <div  class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Producto: </label>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                 <select class="form-control" name="producto">
                                                     <option>Pagaré</option>
                                                     <option>Carta Fianza</option>
                                                     <option>Leasing</option>
                                                 </select>

                                             </div>
                                         </div>
                                         <div  class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Mes Probable: </label>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <select class="form-control" name="mesProbable" id="mesProbableDesembolso"  value="inicial">
                                                    <option value="inicial" name="seleccione">--Seleccione--</option>
                                                    @foreach( $meses as $mes){
                                                    <option value="{{$mes}}">{{$mes}}</option>   
                                                }
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Año Probable: </label>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <select class="form-control" name="añoProbable" id="mesProbableDesembolso"  value="inicial">
                                                <option value="inicial" name="seleccione">--Seleccione--</option>
                                                @foreach( $años as $año){
                                                <option value="{{$año}}">{{$año}}</option>   
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" id="lblMonto">Desembolso :</label>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <select class="form-control" name="moneda">                            
                                            <option value="PEN">PEN</option>
                                            <option value="USD">USD</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">

                                        <input id="inDesembolso" name="montoDesembolso" class="form-control inDesembolsoClass formatInputNumber" onkeypress="return valida(event)" type="text" value="" maxlength="10">
                                    </div>

                                </div>
                                <div  class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" id="lblComision">Comisión :</label>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <select class="form-control tipoComisionClass" id="tipoComision"  >
                                            <option value="procentual">Porcentaje</option>
                                            <option value="PEN">Importe</option>                                    
                                        </select> 
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <input id="inComisionValor" name="valorComision" class="form-control inComisionClass formatInputNumber" type="text" onkeypress="return valida(event)" maxlength="10">
                                        <input id="inComisionPorcentaje" name="porcentajeComision" class="form-control inComisionClass" type="hidden" onkeypress="return valida(event)" maxlength="10">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <input id="inComisionSoles" onkeypress="return validaLetras(event)" readonly="readonly" name="montoComision" class="form-control" type="text"  maxlength="10">
                                    </div>


                                </div>

                            </div>
                            <input type="hidden" name="sectorEconomico" id="sectorEconomicoOperacion">
                            <input type="hidden" name="grupoEconomico" id="grupoEconomicoOperacion">
                            <input type="hidden" name="banca" id="bancaOperacion">
                            <input type="hidden" name="segmento" id="segmentoEconomicoOperacion">
                            <input type="hidden" name="Zonal" id="zonaOperacion">
                            <input type="hidden" name="regEjeNegocio" id="regEjNegocioOperacion">

                            <input type="hidden" name="page" value="{{ $busqueda['page'] }}">
                            <input type="hidden" name="documento" value="{{ $busqueda['documento'] }}">
                            <input type="hidden" name="grupo_zonal" value="{{ $busqueda['grupo_zonal'] }}">
                            <input type="hidden" name="estacion" value="{{ $busqueda['estacion'] }}">


                            <div align="center">
                                <button  type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary " id="btnGuardarCuotaCom" >Guardar</button>
                            </div>  
                        </form>

                    </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog 
    </div>/.modal -->

    <div id="templatePopoverTag" class="hidden">
        <div>
            <div class="circle-tag circle-tag-0">0</div>
            <div class="circle-tag circle-tag-1">1</div>
        </div>
        <div>   
            <div class="circle-tag circle-tag-2">2</div>
            <div class="circle-tag circle-tag-3">3</div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
                   //iniciar el datepicker()
                   $('.dfecha').each(function() {
                    $(this).datepicker({
                        maxViewMode: 1,
                        daysOfWeekDisabled: "0,6",
                        language: "es",
                        autoclose: true,
                        startDate: "-60d",
                        endDate: "+30d",
                        format: "yyyy-mm-dd"
                    })
                    //.datepicker('setDate', new Date())
                    .datepicker('setDate', '')
                });


                   $(".inComisionClass").keyup(function () {
                    var tipo=$('#tipoComision').val();
                    var valueDesembolso=0;
                    var value=0;
                    
                    var valueDesembolso = $(".inDesembolsoClass").val();
                    
                    if(valueDesembolso==""){
                        valueDesembolso=0;
                        
                    }

                    var value = $(this).val();  

                    

                    if(tipo=="procentual"){
                        var value = value.replace(/,/g, "");
                        var valueDesembolso = valueDesembolso.replace(/,/g, "");
                        
                        var valorComision=(parseFloat(value)*parseFloat(valueDesembolso))/100;
                        
                        if(isNaN(valorComision)){
                            valorComision=0;
                        }
                        
                        $("#inComisionSoles").val(valorComision);
                    }else{

                       if(parseFloat(value.replace(/,/g, ""))<=parseFloat(valueDesembolso.replace(/,/g, ""))){
                         $("#inComisionSoles").val(value); 
                     }else{
                         $("#inComisionSoles").val(valueDesembolso); 
                     }


                 }
             });

                   /**/

                   var tipo = $('#tipoComision').val(); 
                   if(tipo=="procentual"){
                    $('#inComisionPorcentaje').attr("type","text");
                    $('#inComisionValor').attr("type","hidden");
                }else{
                   $('#inComisionPorcentaje').attr("type","hidden");
                   $('#inComisionValor').attr("type","text");   
               }
               /**/  
               $("#tipoComision").change(function () {                        
                var tipo = $('#tipoComision').val(); 
                $('#inComisionPorcentaje').val('');
                $('#inComisionValor').val(''); 
                if(tipo=="procentual"){
                    $('#inComisionPorcentaje').attr("type","text");
                    $('#inComisionValor').attr("type","hidden");
                }else{
                   $('#inComisionPorcentaje').attr("type","hidden");
                   $('#inComisionValor').attr("type","text");   
               }

           });

                   //FORMVALIDATION
                   $('#formNuevaOperacion').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        porcentajeComision: {
                            validators: {
                               notEmpty: {
                                message: 'El Valor de la comision es requerido'
                            },
                            between: {
                                min: 0,
                                max: 100,
                                message: 'Ingrese valores entre 0 y 100'
                            }
                        }
                        
                    },
                    valorComision: {
                        validators: {
                       callback: {
                        message: 'Ingrese un importe menor al del desembolso',
                        callback: function (value, validator, $field) {
                                // Determine the numbers which are generated in captchaOperation
                                var desembolso = parseFloat($(".inDesembolsoClass").val().replace(/,/g, ""));
                                var valor = parseFloat(value.replace(/,/g, ""));
                                console.log(valor);
                                if(valor<=desembolso){
                                  return true;
                                }else{
                                  return false;
                                }                                
                              }
                            }
                          }
                    },
                    montoDesembolso: {
                        validators: {
                           notEmpty: {
                            message: 'El Monto de la operacion es requerido'
                        }
                    }
                },
                ruc: {
                    validators: {
                       notEmpty: {
                        message: 'El  RUC es requerido'
                    }
                }
            },
            añoProbable: {
                validators: {
                    different: {
                        field: 'seleccione',
                        message: 'Seleccione un año'
                    }
                }
            },
            mesProbable: {
                validators: {
                    different: {
                        field: 'seleccione',
                        message: 'Seleccione un año'
                    }
                }
            },
              fechaRegistro: {
                validators: {
                    notEmpty: {
                            message: 'La fecha es requerido'
                        }
                }
            }
            
            
        }
    });

               });

function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8){
                    return true;
                }
                
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9.]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }

            function validaLetras(e){
                tecla = (document.all) ? e.keyCode : e.which;

                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8){
                    return true;
                }
                
               // Patron de entrada, en este caso solo acepta numeros
               patron =/[^a-zA-Z0-9´+{}.-ñ ]/;
               tecla_final = String.fromCharCode(tecla);
               return patron.test(tecla_final);
           }


       </script>


       @stop