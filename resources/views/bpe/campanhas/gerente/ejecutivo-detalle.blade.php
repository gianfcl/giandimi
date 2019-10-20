@extends('Layouts.layout')

@section('js-libs')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')

@section('pageTitle', 'Leads')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Resumen
        @if(count($leads)>0)
            <small>{{ $leads[0]->EN_NOMBRE }}</small>
        @endif
        </h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="col-md-3">
                @if($busqueda['campanha'] == '')
                    <span>Todas las campañas</span>
                @else
                    <span>Campaña: 
                    @foreach ($campanhas as $campanha)
                        {{($campanha->ID_CAMP_EST == $busqueda['campanha'])? $campanha->NOMBRE:''}}
                    @endforeach
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$resumen->GESTIONES * 100/$resumen->TOTAL}}%; min-width: 2em;">
                        {{number_format($resumen->GESTIONES * 100/$resumen->TOTAL,0)}}%
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                {{$resumen->GESTIONES}} de {{$resumen->TOTAL}} gestionados
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h4 style="margin-top: 0px;">
            @if($resumen->CITAS_PENDIENTES == 0)
                <span class="label label-default">No tienes citas pendientes</span>
            @else
                <span class="label label-success">Tiene {{$resumen->CITAS_PENDIENTES}} cita(s) pendiente(s)</span>
            @endif
            @if($resumen->CITAS_VENCIDAS > 0)
                <span class="label label-danger">Tiene {{$resumen->CITAS_VENCIDAS}} cita(s) vencidas(s)</span>
            @endif
            </h4>
            
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align: right;">
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
            <input class="form-control" type="hidden" value="{{ $busqueda['ejecutivo'] }}" name="ejecutivo" >
            <div class="row">
            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">DNI/RUC:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" value="{{ $busqueda['documento'] }}" name="documento" id="txtDocumento">
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Campaña:</label>
                <div class="col-md-8">
                    <select id="cboCampanha" name="campanha" class="form-control">
                        <option value="">---Todos----</option>
                        @foreach ($campanhas as $campanha)
                            <option value="{{$campanha->ID_CAMP_EST}}" {{($campanha->ID_CAMP_EST == $busqueda['campanha'])? 'selected="selected"':''}}>
                            {{$campanha->NOMBRE}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Nombre:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" value="{{ $busqueda['lead'] }}" name="lead" id="txtLead">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Distrito:</label>
                <div class="col-md-8">
                    <select id="cboDistrito" name="distrito" class="form-control">
                        <option value="">---Todos----</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{$distrito->DISTRITO}}" {{($distrito->DISTRITO === $busqueda['distrito'])? 'selected="selected"':''}}>
                            {{$distrito->DISTRITO}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<?php $hoy = Jenssegers\Date\Date::now(); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
            <h2>Lista</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th style="width: 20%">
                        @if(isset($orden) && $orden['sort'] == 'lead')
                            @if(isset($orden) && $orden['order'] == 'asc')
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'lead','order' =>'desc'])) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'lead','order' =>'asc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Cliente</th>
                    <th style="width: 25%">
                        @if(isset($orden) && $orden['sort'] == 'direccion')
                            @if(isset($orden) && $orden['order'] == 'asc')
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'direccion','order' =>'desc'])) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'direccion','order' =>'asc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Dirección</th>
                    <th style="width: 10%">
                        @if(isset($orden) && $orden['sort'] == 'deuda')
                            @if(isset($orden) && $orden['order'] == 'desc')
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'deuda','order' =>'asc'])) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'deuda','order' =>'desc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    <th style="width: 10%"></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @if(count($leads)>0)
                @foreach ($leads as $lead)
                <tr>
                    <td style="vertical-align: middle;">
                        @if($lead->MARCA_ESTRELLA == 1)
                            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 30px; color: #1ABB9C;"></span>
                        @endif
                        @if($lead->MARCA_ESTRELLA == 2)
                            <i aria-hidden="true" class="fa fa-handshake-o fa-2x" style="color: rgb(255,0,0);"></i>
                        @endif
                    </td>
                    <td>
                        {{ $lead->TIPO_DOCUMENTO }}: {{ $lead->NUM_DOC }}
                        <br/>{{ $lead->NOMBRE_CLIENTE }}
                        @if(empty($lead->FECHA_CITA))
                        <br/>{{$lead->REPRESENTANTE_LEGAL}}
                        @endif
                    </td>
                    <td>
                        {{ $lead->DISTRITO }}<br/>
                        {{ $lead->DIRECCION }}
                    </td>
                    <td>
                        {{ $lead->DEUDA_SSFF_MONEDA}} {{ number_format($lead->DEUDA_SSFF,0,'.',',') }} <br/>
                        @if($lead->VARIACION_DEUDA_6M_SSFF > 0)
                            ({{ number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',') }}%<span class="glyphicon glyphicon-arrow-up" style="color: #449D44"></span> )<br/>
                        @else
                            ({{ number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',') }}%<span class="glyphicon glyphicon-arrow-down" style="color: #CB2431"></span> )<br/>
                        @endif
                        {{ $lead->BANCO_PRINCIPAL_SSFF }}<br/>
                    </td>
                    <td>
                        <?php $cpns = array_filter(explode('|',$lead->CAM_EST_ABREV)) ;
                        ?>
                        @foreach ($cpns as $cpn)
                        {{$cpn}}<br/>
                        @endforeach
                    </td>
                    <td>
                        <?php $gestiones = array_filter(explode('|',$lead->GESTION));?>

                        @foreach ($cpns as $key => $cpn)
                        {{ !isset($gestiones[$key])? '-':ucwords(mb_strtolower($gestiones[$key], 'UTF-8')) }}<br/>
                        @endforeach
                    </td>
                    <td>
                        @if(empty($lead->FECHA_CITA))
                        <label>-</label>
                        @else
                        <?php 
                            $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA);
                        ?>
                        <span style="{{ (in_array($lead->CITA_ESTADO,[1,2,3])&& $fecha->lt($hoy))  ? 'color:#DB242C':'' }}">
                        <span class="glyphicon glyphicon-calendar"></span> <span>{{ $fecha->format("j M") }}</span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span>{{ $fecha->format("H:i") }}</span>
                        </span>
                        @endif
                    </td>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="{{ route('bpe.campanha.gerente.ejecutivo.detallelead') }}?ejecutivo={{app('request')->input('ejecutivo')}}&lead={{$lead->NUM_DOC}}">Ver Gestión</a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8">No se encontraron resultados</td>
                </tr>@endif
            </tbody>
        </table>
        {{ $leads->appends($busqueda)->links() }}
    </div>
</div>
</div>
</div>


@stop

@section('js-scripts')
<script>
    $(document).ready(function() {

        // Limpieza de formulario
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input[type="text"]').val("");
            $(this).closest('form').find('select').val("");
        });

        
    });
</script>
@stop