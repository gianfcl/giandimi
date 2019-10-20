@extends('Layouts.layout')

@section('content')

@section('pageTitle', 'Leads')

@if ($resumen)
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
                <span class="label label-success">Tienes {{$resumen->CITAS_PENDIENTES}} cita(s) pendiente(s)</span>
            @endif
            @if($resumen->CITAS_VENCIDAS > 0)
                <span class="label label-danger">Tienes {{$resumen->CITAS_VENCIDAS}} cita(s) vencidas(s)</span>
            @endif
            </h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align: right;">
        <a class="btn btn-sm btn-primary" href="{{ route('bpe.campanha.consulta-nuevos') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Consulta Lead</a>
        </div>
    </div>
</div>
</div>
</div>
@endif

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
                <label for="" class="control-label col-md-4 col-xs-3">DNI/RUC:</label>
                <div class="col-md-8 col-xs-9">
                    <input class="form-control" type="text" value="{{ $busqueda['documento'] }}" name="documento" id="txtDocumento" maxlength="15">
                </div>
            </div>
        

            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Campaña:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboCampanha" name="campanha" class="form-control">
                        <option value="">---Todos----</option>
                        @foreach ($campanhas as $campanha)
                            <option value="{{$campanha->ID_CAMP_EST}}" {{($campanha->ID_CAMP_EST == $busqueda['campanha'])? 'selected="selected"':''}}>
                            {{$campanha->NOMBRE}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Propensión:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboPropension" name="propension" class="form-control">
                        <option value="">---Todos----</option>
                        @foreach ($propension as $nivel)
                            <option value="{{$nivel['ID']}}" {{($nivel['ID'] == $busqueda['propension'])? 'selected="selected"':''}}>
                            {{$nivel['NIVEL']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Mi Grupo:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboMarca" name="marca" class="form-control">
                        <option value="">---Todos----</option>
                        @foreach ($marcas as $marca)
                            <option value="{{$marca}}" {{($marca == $busqueda['marca'])? 'selected="selected"':''}}> {{$marca}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Nombre:</label>
                <div class="col-md-8 col-xs-9">
                    <input class="form-control" type="text" value="{{ $busqueda['lead'] }}" name="lead" id="txtLead" maxlength="75">
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Distrito:</label>
                <div class="col-md-8 col-xs-9">
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

<?php $hoy = Jenssegers\Date\Date::now(); 
?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
            <h2>Lista</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="{{ route('bpe.campanha.ejecutivo.leads.imprimir', array_merge($busqueda,isset($orden)? $orden:[])) }}" target="_blank" class="collapse-link"><i class="fa fa-print"></i> Imprimir</a></li>
            </ul>
            <div class="clearfix"></div>
      </div>
      
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th></th>
                    <th style="width: 20%">
                        @if(isset($orden) && $orden['sort'] == 'lead')
                            @if(isset($orden) && $orden['order'] == 'asc')
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'lead','order' =>'desc'])) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', $busqueda) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'lead','order' =>'asc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Cliente</th>
                    <th style="width: 35%">
                        @if(isset($orden) && $orden['sort'] == 'direccion')
                            @if(isset($orden) && $orden['order'] == 'asc')
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'direccion','order' =>'desc'])) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', $busqueda) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'direccion','order' =>'asc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Dirección</th>
                    <th style="width: 10%">
                        @if(isset($orden) && $orden['sort'] == 'deuda')
                            @if(isset($orden) && $orden['order'] == 'desc')
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'deuda','order' =>'asc'])) }}">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            @else
                                <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', $busqueda) }}">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            @endif
                        @else
                            <a href="{{ route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'deuda','order' =>'desc'])) }}">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        @endif
                        </a> Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    @if( Auth::user()->FLAG_TIENE_ASISTENTE_COMERCIAL == 1)
                    <th >¿Enviar Asist.?</th>
                    @endif
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
                        @elseif($lead->MARCA_ESTRELLA == 2)
                            <i aria-hidden="true" class="fa fa-handshake-o fa-2x" style="color: rgb(255,0,0);"></i>
                        @elseif($lead->MARCA_ESTRELLA == 3)
                           <img src = "{{ URL::asset('img/derivado.png') }}" alt="derivado" style="width: 40px">
                        @elseif($lead->MARCA_ESTRELLA == 4)
                           <img src = "{{ URL::asset('img/derivado.png') }}" alt="derivado-propenso" style="width: 40px">
                        @endif
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="circle-tag circle-tag-{{$lead->ETIQUETA_EJECUTIVO}}" lead="{{ $lead->NUM_DOC }}">
                            {{$lead->ETIQUETA_EJECUTIVO}}
                        </div>
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
                        @if (!is_null($lead->CITA_CONTACTO_DIRECCION))
                            {{ $lead->CITA_CONTACTO_DIRECCION }}
                        @else
                            {{ $lead->DIRECCION }}
                        @endif
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
                        <span style="{{ (in_array($lead->CITA_ESTADO,[1,2,3]) && $fecha->lt($hoy))? 'color:#DB242C':'' }}">
                        <span class="glyphicon glyphicon-calendar"></span> <span>{{ $fecha->format("j M") }}</span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span>{{ $fecha->format("H:i") }}</span>
                        </span>
                        @endif
                    </td>
                    @if( Auth::user()->FLAG_TIENE_ASISTENTE_COMERCIAL == 1)
                    <td style="vertical-align: middle; text-align: center;">
                            <input lead="{{ $lead->NUM_DOC }}" type="checkbox" class='chkAsistente' aria-label=""
                            <?php echo (($lead->MARCA_ASISTENTE_COMERCIAL == '1')? 'checked':'') ?> />
                        
                    </td>
                    @endif
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="{{ route('bpe.campanha.ejecutivo.leads.detalle') }}?lead={{$lead->NUM_DOC}}">Gestión</a>
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


@stop

@section('js-scripts')
<script>
    $(document).ready(function() {

        // Limpieza de formulario
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input').val("");
            $(this).closest('form').find('select').val("");
        });

        /*********  ETIQUETA DE EJECUTIVO ***************/

        // Etiqueta de ejecutivo
        $("table .circle-tag").popover({ 
            trigger: "manual" ,
            html : true,
            content: function() {
                return $('#templatePopoverTag').html();
            } 
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 700);
        });

        $(document).on('click', '.popover .circle-tag', function() {
            var elem = $(this).closest('.popover').prev();
            var etiq = $(this).html();
            elem.removeClass()
                .addClass($(this).attr('class'))
                .html(etiq);
            $.ajax({
                type: "POST",
                data: {
                    lead: elem.attr('lead'),
                    etiqueta: etiq,
                    "_token": "{{ csrf_token() }}"
                },
                url: APP_URL + '/bpe/en/update-etiqueta',
                dataType: 'json',
                success: function (json) {
                    console.log('ok');
                },
                error: function (xhr, status, text) {
                    console.log(status);
                }
            });
        });

        /*********  ENVIAR ASISTENTE COMERCIAL ***************/
        $('.chkAsistente').click(function(){
            console.log($(this).is(':checked'));
             $.ajax({
                type: "POST",
                data: {
                    lead: $(this).attr('lead'),
                    marca: $(this).is(':checked')? 1:0,
                    "_token": "{{ csrf_token() }}"
                },
                url: APP_URL + '/bpe/en/enviar-asistente',
                dataType: 'json',
                success: function (json) {
                    console.log('ok');
                },
                error: function (xhr, status, text) {
                    console.log(status);
                }
            });
        });
    });



     /****** CAMPAÑA - PROPENSIÓN ******/

        if ($('#cboCampanha').length > 0){
            cboCampanhaChange($('#cboCampanha').val(),$('#cboPropension').val());    
        }                   
       
        $('#cboCampanha').change(function(){
            cboCampanhaChange($(this).val(),null);
        });
      
    function cboCampanhaChange(campanha,propension) {
            var cboPropension = $('#cboPropension');          

            //Limpiamos el combobox de propension
            cboPropension.find('option:not(:first)').remove();

            
            //Si no selecionada nada como resultado
            if (!campanha) {
                cboPropension.val('');
                cboPropension.prop('disabled', false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboPropension.prop('disabled', true);

            //Campañas recurrentes y estacionales
            if(campanha>=2 && campanha<=5){
                arregloPropension=["Muy Bajo","Bajo","Medio","Alto","Recomendable"];

                for (var i = 0; i < arregloPropension.length; i++) {
                    cboPropension.append($("<option></option>")
                    .attr("value", i+1).text(arregloPropension[i]));
                }


                if (propension){
                    cboPropension.val(propension);
                }

                cboPropension.prop('disabled', false);          
            }         

    }    
    

</script>
@stop