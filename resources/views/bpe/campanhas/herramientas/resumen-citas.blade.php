@extends('Layouts.layout')

@section('pageTitle', 'Resumen de Citas')

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Filtros</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal" method="GET">
                        @if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR)
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Zonal:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboZonal" name="zonal" class="form-control">
                                    <option value="">---Todos---</option>
                                    @foreach ($zonales as $zonal)
                                        @if ($zonal->ID_ZONA == $busqueda['zonal'])
                                            <option value="{{$zonal->ID_ZONA}}" selected>{{$zonal->ZONA}}</option>
                                        @else
                                            <option value="{{$zonal->ID_ZONA}}">{{$zonal->ZONA}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA]))
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Centro:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboCentro" name="centro" class="form-control">
                                    <option value="">---Todos---</option>
                                    @foreach ($centros as $centro)
                                        @if ($centro->ID_CENTRO == $busqueda['centro'])
                                            <option value="{{$centro->ID_CENTRO}}" selected>{{$centro->CENTRO}}</option>
                                        @else
                                            <option value="{{$centro->ID_CENTRO}}">{{$centro->CENTRO}}</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        @endif
                        @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO]))
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Tienda:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboTienda" name="tienda" class="form-control">
                                    <option value="">---Todos---</option>
                                    @foreach ($tiendas as $tienda)
                                        @if ($tienda->ID_TIENDA == $busqueda['tienda'])
                                            <option value="{{$tienda->ID_TIENDA}}" selected>{{$tienda->TIENDA}}</option>
                                        @else
                                            <option value="{{$tienda->ID_TIENDA}}">{{$tienda->TIENDA}}</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        @endif
                        <span id="req_fechaIni" style="display: none;">{{ $busqueda['fechaIni'] }}</span>
                        <span id="req_fechaFin" style="display: none;">{{ $busqueda['fechaFin'] }}</span>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label class="control-label col-xs-3 col-md-2" for="">Fechas:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" value="" name="fechaIni" id="dp_fechaIni">
                                    <div class="input-group-addon">al</div>
                                    <input type="text" class="form-control" value="" name="fechaFin" id="dp_fechaFin">    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1" style="text-align: center;">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($ejecutivos) > 0)
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Resumen</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                $programadas = 0;
                $vencidas = 0;
                $realizadas = 0;
                $total = 0;
                if(count($ejecutivos)>0) {
                    foreach ($ejecutivos as $ejecutivo) {
                        $programadas = $programadas + $ejecutivo->PROGRAMADAS;
                        $vencidas = $vencidas + $ejecutivo->VENCIDAS;
                        $realizadas = $realizadas + $ejecutivo->REALIZADAS;
                        $total = $total + $ejecutivo->TOTAL;
                    }
                }
                ?>
                <div class="col-md-3">
                    <span style=" font-size: 24px;">{{ $total }} Citas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;">{{ $realizadas }} Realizadas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;">{{ $programadas }} Programadas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;">{{ $vencidas }} Vencidas</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ejecutivos</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>            
            <div class="x_content">
                @if(count($ejecutivos)>0)
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th class="col-md-3">Ejecutivo</th>
                            @if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR)
                            <th class="col-md-1">Zonal</th>
                            @endif
                            @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA]))
                            <th class="col-md-1">Centro</th>
                            @endif
                            @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO]))
                            <th class="col-md-1">Tienda</th>
                            @endif
                            <th class="col-md-1">Citas Pendientes</th>
                            <th class="col-md-1">Citas Vencidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($ejecutivos)>0)
                            @foreach ($ejecutivos as $ejecutivo)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->NOMBRE}} <br/> {{$ejecutivo->REGISTRO}}                                      
                                    </td>
                                    @if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR)
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->ZONA}}                                   
                                    </td>
                                    @endif
                                    @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA]))
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->CENTRO}}                                   
                                    </td>
                                    @endif
                                    @if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO]))
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->TIENDA}}                                   
                                    </td>
                                    @endif
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->PROGRAMADAS}}                                   
                                    </td>
                                    <td style="vertical-align: middle;">
                                        {{$ejecutivo->VENCIDAS}}                                   
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $ejecutivos->appends(['zonal' => $busqueda['zonal'], 'centro' => $busqueda['centro'], 'tienda' => $busqueda['tienda'], 'fechaIni' => $busqueda['fechaIni'], 'fechaFin' => $busqueda['fechaFin']])->links() }}
                @else
                <span>No hay citas</span>
                @endif
            </div>
        </div>
    </div>
</div>


@stop

@section('js-scripts')
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ URL::asset('js/webvpc/bpe-campanha-herramientas-resumen-citas.js') }}"></script>

@stop