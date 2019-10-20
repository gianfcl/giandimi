@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/switchery.min.css') }}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
@stop

@section('content')


@section('pageTitle', 'Alertas')

<div class="row">
    @if (!in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosBE())))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Búsqueda</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form action="{{ route('be.creditos.index') }}" class="form-horizontal">       
                     @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE())))
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

                        @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca())))
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
                        
                        @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE())))
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
                        
                        @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE())))
                        <div class="form-group col-md-3">
                            <label for="" class="control-label col-md-3">Ejecutivo:</label>
                            <div class="col-md-9">
                                <select id="cboEjecutivo" class="form-control" name="ejecutivo">
                                    <option value="">Todos</option>
                                    @foreach ($ejecutivos as  $ejecutivo)
                                        <option value="{{$ejecutivo->REGISTRO}}" {{($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''}}
                                        >{{$ejecutivo->NOMBRE}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit" >Buscar</button>
                    </div>            
                </form>
            </div>
        </div>
    </div>
    @endif

        <div class="form-group col-md-12 col-md-12 col-sm-12 col-xs-12" style="font-size: 0.8em;">    
        <div class="x_panel">
            <div class="x_title">
                <h2>Leyenda</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-md-4" style="padding : 4px;"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color: {{\App\Entity\BE\SemaforoAlertasInternas::COLOR_SEMAFORO_AMBAR}}; display: inline;"></i> <label style="display: inline;">  Hasta 8 días de atraso: Ejecutivo se comunica con el cliente.</label></div>
                    <div class="col-md-4" style="padding : 4px;"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color: {{\App\Entity\BE\SemaforoAlertasInternas::COLOR_SEMAFORO_ROJO}}; display: inline;"></i><label style="display: inline;"> Hasta 15 días de atraso: Jefe comercial se comunica con el cliente. </label></div>
                    <div class="col-md-4" style="padding : 4px;"><i class="fa fa-circle fa-2x" aria-hidden="true" style="color: {{\App\Entity\BE\SemaforoAlertasInternas::COLOR_SEMAFORO_NEGRO}}; display: inline;"></i><label style="display: inline;"> Más de 15 días de atraso: Gerente zonal se comunica con el cliente.</label></div>                    
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
                    <table class="table table-striped jambo_table" style="width:100%">
                        <thead>
                            <tr class="headings">
                                <th style="width: 1%; text-align: center;;"></th>
                                <th style="width: 10%; text-align: center;">Empresa</th>
                                <th style="width: 5%; text-align: center;">Nro. documento</th>
                                <th style="width: 5%; text-align: center;">Producto</th>
                                <th style="width: 5%; text-align: center;">Fecha Vencimiento</th>
                                <th style="width: 5%; text-align: center;">Días de atraso</th>                            
                                <th style="width: 5%; text-align: center;">Deuda</th>                                
                                @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getAnalistasEjecutivosBE())))
                                <th style="width: 1%; text-align: center;">¿Gestionado?</th>  
                                @endif
                                <th style="width: 5%;text-align: center;" align="center">Comentario</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($leads)>0)
                            @foreach ($leads as $lead)
                            <tr>
                                <td style="padding-bottom: 0px;"> <i class="fa fa-circle fa-2x" aria-hidden="true" style="color: {{\App\Entity\BE\SemaforoAlertasInternas::getColorSemaforo($lead->NUM_DIAS_VENCIDOS)}}"></i></td>
                                <td style="padding-bottom: 0px; text-align: center;">{{$lead->NC_CLIE}}</td>                                
                                <td style="padding-bottom: 0px; text-align: center;">{{$lead->NUM_DOCUMENTO}}</td>
                                <td style="padding-bottom: 0px; text-align: center;">{{$lead->COD_PRODUCTO}}- {{$lead->NOMBRE_PRODUCTO}}</td>                            
                                <td style="padding-bottom: 0px; text-align: center;">{{Jenssegers\Date\Date::parse($lead->FECHA_VENCIMIENTO)->format('d/m/Y')}}</td>
                                <td style="padding-bottom: 0px; text-align: center;">{{$lead->NUM_DIAS_VENCIDOS}} Días</td>
                                <td style="padding-bottom: 0px;">S/. {{number_format($lead->DEUDA,0,'.',',')}}</td>
                                @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getAnalistasEjecutivosBE())))
                                <td style="text-align: center;">
                                    <input fecha="{{$lead->FECHA}}" idCliente='{{$lead->ID_CLIE}}' numDocumento='{{$lead->NUM_DOCUMENTO}}' Estado='{{$lead->ESTADO}}' type="checkbox" class="chkGestion js-switch js-check-change"
                                           <?php echo (($lead->FLG_GESTIONADO == '1') ? 'checked' : '') ?> />
                                </td>
                                @endif
                                <td align="center" style="padding-bottom: 0px; text-align: center;">   
                                    <div class="row">
                                        <div class="col-md-10" style="padding : 0px"><textarea class="form-group inpComentario" readonly rows="1" style="resize:none;">{{$lead->COMENTARIO}}</textarea></div>
                                        @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getAnalistasEjecutivosBE())))
                                        <div class="col-md-2" style="padding : 0px;margin-top: 15px ;"><button style=""
                                                                                                               fecha="{{$lead->FECHA}}" idCliente='{{$lead->ID_CLIE}}' numDocumento='{{$lead->NUM_DOCUMENTO}}' Estado='{{$lead->ESTADO}}' class="form-group btnSave hidden"  type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>                                </div>
                                                                                                               @endif
                                    </div>                                    
                                    <!--<input class="form-group inpComentario" value="{{$lead->COMENTARIO}}" readonly ></input>-->

                                </td>
                            </tr>
                            @endforeach 
                            @else
                        <span>No se encontro resultado</span>
                        @endif
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
$(document).ready(function () {
    /*-------------------------INICIALIZACION DE SWITCH-INICIO------------------------------------------*/
    var elems = Array.prototype.slice.call(document.querySelectorAll('.chkGestion'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });
    /*-------------------------INICIALIZACION DE SWITCH-FIN---------------------------------------------*/

    /*-------------------------ACTIVAR GESTION O ELIMINAR-INICIO----------------------------------------*/
    $('.chkGestion').change(function () {
        if ($(this).is(':checked')) {
            $(this).closest('tr').find('.btnSave').removeClass('hidden');
            $(this).closest('tr').find('textarea').prop("readonly", false);
        } else {
            fecha = $(this).attr('fecha');
            idCliente = $(this).attr('idCliente');
            numDocumento = $(this).attr('numDocumento');
            estado = $(this).attr('estado');
            ActualizarGestion(fecha, idCliente, numDocumento, estado, null, 0)
            $(this).closest('tr').find('.btnSave').addClass('hidden');
            $(this).closest('tr').find('textarea').val('');
            $(this).closest('tr').find('textarea').prop("readonly", true);
        }

    });
    /*-------------------------ACTIVAR GESTION O ELIMINAR-FIN----------------------------------------*/
    /*-------------------------CARGAR GESTION-INICIO----------------------------------------*/
    function ActualizarGestion(fecha, idCliente, numDocumento, estado, comentario, marca) {
        $.ajax({
            type: "POST",
            data: {
                fecha: fecha,
                idCliente: idCliente,
                numDocumento: numDocumento,
                estado: estado,
                comentario: comentario,
                marca: marca,
                "_token": "{{ csrf_token() }}"
            },
            url: APP_URL + '/be/guardarGestion',
            dataType: 'json',
            success: function (json) {
                console.log('ok');

            },
            error: function (xhr, status, text) {
                console.log(status);
            }
        });
    }
    /*-------------------------CARGAR GESTION-FIN----------------------------------------*/
    /*-------------------------CARGAR GESTION-INICIO----------------------------------------*/
    $('.btnSave').click(function () {

        console.log($(this).parent('td').find('.chkGestion').is(':checked'));
        fecha = $(this).attr('fecha');
        idCliente = $(this).attr('idCliente');
        numDocumento = $(this).attr('numDocumento');
        estado = $(this).attr('estado');
        comentario = $(this).closest('tr').find('.inpComentario').val();
        marca = $(this).closest('tr').find('.chkGestion').is(':checked') ? 1 : 0;

        ActualizarGestion(fecha, idCliente, numDocumento, estado, comentario, marca)
        if (!$(this).parent('td').find('.chkGestion').is(':checked')) {
            $(this).parent('td').find('.inpComentario').val('')
        }
        $(this).addClass('hidden');
    });
    /*-------------------------CARGAR GESTION-FIN----------------------------------------*/

    /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
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

    /*$.ajax({
     type: "POST",
     data: {
     fecha: $(this).attr('fecha'),
     idCliente: $(this).attr('idCliente'),
     numDocumento: $(this).attr('numDocumento'),
     estado: $(this).attr('estado'),
     comentario: $(this).closest('tr').find('.inpComentario').val(),
     marca: $(this).closest('tr').find('.chkGestion').is(':checked') ? 1 : 0,
     "_token": "{{ csrf_token() }}"
     },
     url: APP_URL + '/be/guardarGestion',
     dataType: 'json',
     success: function (json) {
     console.log('ok');
     
     },
     error: function (xhr, status, text) {
     console.log(status);
     }
     });*/

});
/****** ZONAL - JEFATURA - EJECUTIVO ******/
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

    </script>

    @stop