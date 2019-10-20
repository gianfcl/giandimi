@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

@stop

<?php
    
    $rolUsuario = Auth::user()->ROL;
?>
@section('content')

@section('pageTitle', 'Reportes')
<form action="" class="form-horizontal" method="GET">

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
                <div class="row clearfix">

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Fecha:</label>
                        <div class="col-md-9">
                            <input type="text" id="datetimepicker3" class="form-control datepicker" value="{{ $busqueda['fecha'] }}" name="fecha">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Tipo:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="tipo">
                                @foreach($tipos as $t)
                                <option value="{{$t}}" {{($t == $busqueda['tipo'])? 'selected="selected"':''}}
                                >{{$t}}</option>
                                @endforeach								
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Estado:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="estado" >
                                @foreach($estados as $e)
                                <option value="{{$e}}" {{($e == $busqueda['estado'])? 'selected="selected"':''}}
                                >{{$e}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit" id="buttonSSRS">Buscar</button>
                    </div>
                    
                </div>
                <div class="row clearfix">

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Banca:</label>
                        <div class="col-md-9">
                            <select id="cboBanca" class="form-control" name="banca">
                                <option value="">VPC</option>
                                @foreach ($bancas as $banca)
                                <option value="{{$banca->BANCA}}" {{($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''}}
                                >{{$banca->NOMBRE_BANCA}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Zonal:</label>
                        <div class="col-md-9">
                            <select id="cboZonal" class="form-control" name="zonal">
                                <option value="">Todos</option>
                                @foreach ($zonales as  $zonal)
                                <option value="{{$zonal->ZONAL}}" {{($zonal->ZONAL == $busqueda['zonal'])? 'selected="selected"':''}}
                                >{{$zonal->NOMBRE_ZONAL}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Jefatura:</label>
                        <div class="col-md-9">
                            <select id="cboJefatura" class="form-control" name="jefatura">
                                <option value="">Todos</option>
                                @foreach ($jefaturas as  $jefatura)
                                <option value="{{$jefatura->JEFATURA}}" {{($jefatura->JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''}}
                                >{{$jefatura->NOMBRE_JEFE}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Ejecutivo:</label>
                        <div class="col-md-9">
                            <select id="cboEjecutivo" class="form-control" name="ejecutivo">
                                <option value="">Todos</option>
                                @foreach ($ejecutivos as  $ejecutivo)
                                <option value="{{$ejecutivo->COD_SECT_UNIQ}}" {{($ejecutivo->COD_SECT_UNIQ == $busqueda['ejecutivo'])? 'selected="selected"':''}}
                                >{{$ejecutivo->ENCARGADO}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
    	</div>
    </div>
</div>
<!--span>
    {{$url}}&origen=VPCONNECT&fecha={{$busqueda['fecha']}}&tipo={{$busqueda['tipo']}}&estado={{$busqueda['estado']}}&banca={{$busqueda['banca']}}&zonal={{$agrupacion}}&ejecutivo={{$busqueda['ejecutivo']}}&nomEjec={{$nomEjec}}
</span-->        
<iframe id="frameSSRS" 
        
        src="{{$url}}&origen=VPCONNECT&fecha={{$busqueda['fecha']}}&tipo={{$busqueda['tipo']}}&estado={{$busqueda['estado']}}&banca={{$busqueda['banca']}}&zonal={{$agrupacion}}&ejecutivo={{$busqueda['ejecutivo']}}&nomEjec={{$nomEjec}}" 
        
        width="100%" height="800px" >
</iframe>

</form>

@stop

@section('js-scripts')

<script>
       
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
        //cargarReporte();
        
        /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
        if ($('#cboBanca').length > 0){
            cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());
        } else {
            if ($('#cboZonal').length > 0){
                cboZonalChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
            } else {
                if ($('#cboJefatura').length > 0){
                    cboJefaturaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
                }
            }
        }
        
        $('#cboBanca').change(function(){
            cboBancaChange($(this).val(),null,null,null);
        });
        
        $('#cboZonal').change(function(){
            cboZonalChange($('#cboBanca').val(),$(this).val(),null,null);
        });

        $('#cboJefatura').change(function(){
            cboJefaturaChange($('#cboBanca').val(),$('#cboZonal').val(),$(this).val(),null);
        });
        
    });
    
    
    /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/

    function cboBancaChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboBancaChange - banca: " + banca);
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
            data: {
                banca: banca
            },
            //url: APP_URL + 'be/utils/get-zonales-by-banca',
            url: APP_URL + 'be/utils/get-arbol-zonales',
            dataType: 'json',
            success: function (json) {
                $.each(json, function (key, value) {
                    cboZonal.append($("<option></option>")
                        .attr("value", value.ZONAL).text(value.NOMBRE_ZONAL));
                });
                if (zonal){
                    cboZonal.val(zonal);
                }
                cboZonal.prop('disabled', false);
                cboZonalChange(banca, zonal, jefatura, ejecutivo);
            }
        });
    }

    function cboZonalChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboZonalChange - zonal: " + zonal);
        console.log("cboZonalChange - banca: " + banca);
        var cboJefatura = $('#cboJefatura');
        var cboEjecutivo = $('#cboEjecutivo');

        //Limpiamos el combobox de jefaturas y ejecutivos
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
            data: {
                banca: banca,
                zonal: zonal
            },
            //url: APP_URL + 'be/utils/get-jefaturas-by-zonal',
            url: APP_URL + 'be/utils/get-arbol-jefaturas',
            dataType: 'json',
            success: function (json) {
                var i = 0, valor = '';
                $.each(json, function (key, value) {
                    if (i===0) {
                        valor = value.JEFATURA;
                    }
                    cboJefatura.append($("<option></option>")
                        .attr("value", value.JEFATURA).text(value.NOMBRE_JEFE));
                    i=+1;
                });
                if (jefatura){
                    cboJefatura.val(jefatura);
                } else {
                    cboJefatura.val(valor);
                    jefatura = valor;
                }
                
                cboJefatura.prop('disabled', false);
                cboJefaturaChange(banca, zonal, jefatura, ejecutivo);
            }
        });
    }
    
    function cboJefaturaChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboJefaturaChange - jefatura: " + jefatura);
        var cboEjecutivo = $('#cboEjecutivo');

        //Limpiamos el combobox de ejecutivos
        cboEjecutivo.find('option:not(:first)').remove();

        //Si selecciona cualquier otro resultado
        cboEjecutivo.prop('disabled', true);
        $.ajax({
            type: "GET",
            data: {
                banca: banca,
                jefatura: jefatura,
                zonal: zonal
            },
            //url: APP_URL + 'be/utils/get-ejecutivos-by-jefatura',
            url: APP_URL + 'be/utils/get-arbol-ejecutivos',
            dataType: 'json',
            success: function (json) {
                var i = 0, valor = '';
                $.each(json, function (key, value) {
                    if (i===0) {
                        valor = value.COD_SECT_UNIQ;
                    }
                    cboEjecutivo.append($("<option></option>")
                        .attr("value", value.COD_SECT_UNIQ).text(value.ENCARGADO));
                    
                    i=+1;
                });
                if (ejecutivo){
                    cboEjecutivo.val(ejecutivo);
                } else {
                    //if (typeof jefatura !== 'undefined' && jefatura !== null && jefatura !== '') {
                    if (jefatura === null || jefatura === '') {
                        cboEjecutivo.val(valor);
                        ejecutivo = valor;
                    }
                }
                
                cboEjecutivo.prop('disabled', false);
            }
        });
    }
    
</script>

@stop
