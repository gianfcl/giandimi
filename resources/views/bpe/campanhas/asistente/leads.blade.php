@extends('Layouts.layout')

@section('js-libs')
@stop

@section('content')

@section('pageTitle', 'Leads')

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
        <form action="{{ route('bpe.campanha.asistente.leads.listar') }}" class="form-horizontal">
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="" class="control-label col-md-4">Documento:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="{{ $busqueda['documento'] }}" name="documento" id="txtDocumento">
                    </div>
                </div>

                <div class="form-group col-md-4 col-md-offset-4">
                    <label for="" class="control-label col-md-4">Ejecutivo:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="ejecutivo" id="cboEjecutivo">
                            <option value="">---Todos----</option>
                            @foreach($ejecutivos as $ejecutivo)
                            <option value="{{ $ejecutivo->REGISTRO }}" {{ ($busqueda['ejecutivo'] == $ejecutivo->REGISTRO) ? 'selected="selected"' : '' }} >{{ $ejecutivo->NOMBRE }}</option>
                            @endforeach
                        </select>
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

                
            </div>
            
            <div class="form-group">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>


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
                    <th></th>
                    <th>Ejecutivo</th>
                    <th style="width: 20%">Cliente</th>
                    <th style="width: 35%">Dirección</th>
                    <th style="width: 10%">Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    <th>Detalle</th>

                </tr>
            </thead>
            <tbody>
                @if(count($leads)>0)
                @foreach ($leads as $lead)
                <tr>
                    <td>
                    </td>
                    <td>
                        @if($lead->MARCA_ASISTENTE_COMERCIAL == '1')
                        <span class="glyphicon glyphicon-tag" aria-hidden="true" style="color: #2A3F54;"></span>
                        @endif
                    </td>
                    <td>
                       {{ $lead->EN_NOMBRE }}
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
                        <span class="glyphicon glyphicon-calendar"></span> <span>{{ $fecha->format("j M") }}</span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span>{{ $fecha->format("H:i") }}</span>
                    @endif
                </td>
                <td>
                    @if(count($gestiones) == 0 and empty($lead->FECHA_CITA))
                    <a class="btn btn-sm btn-primary" href="{{ route('bpe.campanha.asistente.cita.nuevo') }}?lead={{$lead->NUM_DOC}}">Agendar Cita / Gestionar</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">No se encontraron resultados</td>
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
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input').val("");
            $(this).closest('form').find('select').val("");
        });

    });
</script>
@stop