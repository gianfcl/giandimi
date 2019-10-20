@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

@stop


@section('pageTitle', 'Registro de Citas')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos del Lead</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form>
                    <div class="row">
                        <div class="col-md-4 col-xs-12 form-group">
                            <label for="">Documento</label>
                            <input class="form-control" type="text" value="({{ $lead->TIPO_DOCUMENTO }}) {{ $lead->NUM_DOC }}" readonly="readonly">
                        </div>

                        <div class="col-md-8 form-group">
                            <label for="">Nombre/ R. Social</label>
                            <input class="form-control" type="text" value="{{ $lead->NOMBRE_CLIENTE }}" readonly="readonly">
                        </div>
                    </div>
                    @if ($lead->TIPO_DOCUMENTO === 'RUC')
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="" class="">Representante</label>
                            <input class="form-control" type="text" value="{{ $lead->REPRESENTANTE_LEGAL }}" readonly="readonly">
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Dirección</label>
                            <input class="form-control" type="text" value="{{ $lead->DIRECCION }}" readonly="readonly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="">Distrito</label>
                            <input class="form-control" type="text" value="{{ $lead->DISTRITO }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Tienda</label>
                            <input class="form-control" type="text" value="{{ $lead->TIENDA }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Zonal</label>
                            <input class="form-control" type="text" value="{{ $lead->ZONAL }}" readonly="readonly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="">Riesgo</label>
                            <input class="form-control" type="text" value="{{ $lead->SCORE_BURO }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Giro</label>
                            <input class="form-control" type="text" value="{{ $lead->GIRO }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Actividad</label>
                            <input class="form-control" type="text" value="{{ $lead->ACTIVIDAD }}" readonly="readonly">
                        </div>
                    </div>           
                </form> 
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 cold-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Teléfonos de Lead</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblContactos" class="table table-condensed">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $key => $contacto)
                        <tr>
                            <td><label>{{ ucwords(strtolower($contacto->TIPO_CONTACTO)) }}:</label></td>
                            <td>{{ $contacto->VALOR }}</td>
                            <td>
                                <i  aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($telefonos as $key => $telefono)
                        <tr>
                            <td><label>Telefono {{ ($key + 1) }}:</label></td>
                            <td class="cellTelefono <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'tachado' : '' ?>">{{ $telefono }}</td>
                            <td>
                                <i 
                                    feedback="POSITIVO"  lead="{{ $lead->NUM_DOC }}"  telefono="{{ $telefono }}" aria-hidden="true"
                                    class="icon-feedback fa fa-thumbs-o-up <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'POSITIVO') ? 'icon-feedback-active' : '' ?>" 
                                    data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                                <i feedback="NEUTRO" lead="{{ $lead->NUM_DOC }}" telefono="{{ $telefono }}" aria-hidden="true" 
                                    class="icon-feedback fa fa-meh-o <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEUTRO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="No contestó">
                                        
                                </i>
                                </i>
                                <i feedback="NEGATIVO" lead="{{ $lead->NUM_DOC }}" telefono="{{ $telefono }}" aria-hidden="true" 
                                      class="icon-feedback fa fa-thumbs-o-down <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="Número erróneo">          
                                </i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 cold-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Calendario del Ejecutivo
                <small>{{$lead->EN_NOMBRE}}</small>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-condensed table-calendar-cita">
                    <thead> 
                        <tr>
                            <th></th> 
                            @foreach ($calendario as $dia)
                            <th>{{ $dia }}</th>
                            @endforeach
                        </tr> 
                    </thead> 
                    <tbody>
                        @foreach ($horario as $khora => $hora)
                        <tr>
                            <th>{{ $hora }}</th>
                            @foreach ($calendario as $kdia => $dia)
                            <td class="celda-horario">
                            @if (in_array($kdia.'-'.$khora,$horarioEjecutivo))
                                <span class="glyphicon glyphicon-ban-circle" style="color: #A94442;"></span> <span style="color: #A94442;">Ocupado<span>
                            @else
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Cita/Gestión</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-citas" role="tab" data-toggle="tab" aria-expanded="true">Cita</a></li>
                    <li role="presentation" class=""><a href="#tab-gestion" role="tab" data-toggle="tab" aria-expanded="false">Gestión</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab-citas" aria-labelledby="tab-citas">
                        <form id="nuevaCitaForm" method="POST" action="{{ route('bpe.campanha.asistente.cita.registrar') }}">
                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" id="regEjecutivo" name="regEjecutivo" value="{{ $lead->EN_REGISTRO }}" maxlength="50">
                                <input type="hidden" id="lead" name="lead" value="{{ $lead->NUM_DOC }}" maxlength="50">
                                <div class="col-md-8 form-group">
                                    <label for="">Persona Contacto</label>
                                    @isset ($lead->REPRESENTANTE_LEGAL)
                                    <input type="text" class="form-control" id="pcontacto" name="pcontacto" value="{{ $lead->REPRESENTANTE_LEGAL }}" maxlength="50">
                                    @else
                                    <input type="text" class="form-control" id="pcontacto" name="pcontacto" value="{{ $lead->NOMBRE_CLIENTE }}"  maxlength="50">
                                    @endisset
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Teléfono</label>
                                    <input type="text" class="form-control" id="txtTelefono" name="telefono" maxlength="9">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $lead->DIRECCION }}" maxlength="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="">Referencia</label>
                                    <input type="text" class="form-control" id="referencia" name="referencia" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Fecha</label>
                                    <select class="form-control" name="fecha" id="fecha">
                                        @foreach ($calendario as $key => $dia)
                                        <option value="{{ $key }}">{{ $dia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Hora</label>
                                    <select class="form-control" name="hora" id="hora">
                                        @foreach($horasDisponibles as $key => $hora)
                                        <option value="{{ $key }}">{{ $hora }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Autorización de Datos</label>
                                    <select class="form-control" name="autDatos" id="autDatos">
                                        <option value="si">Sí</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Registrar Cita</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-gestion" aria-labelledby="tab-gestion">
                        <form id=gestionForm action="{{ route('bpe.campanha.asistente.cita.registrarGestion') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                            <input type="hidden" name="regEjecutivo" value="{{ $lead->EN_REGISTRO }}">
                            <input type="hidden" name="lead" value="{{ $lead->NUM_DOC }}">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Resultado</label>
                                    <select class="form-control cboResultado" name="resultado" id="resultado">
                                        <option value="">Elige una opción</option>
                                        @foreach ($resultados as $resultado)
                                        <option value="{{ $resultado->id }}">{{ $resultado->desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group hidden">
                                    <label for="">Motivo</label>
                                    <select class="form-control cboMotivo" name="motivo" id="motivo">
                                        <option value="">Elige una opción</option>
                                        @foreach ($motivos as $motivo)
                                        <option value="{{ $motivo->id }}">{{ $motivo->desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group hidden">
                                    <label for="">Fecha Tentativa</label>
                                    <input type="text" class="form-control dpFecha" id="dpFecha" name="fecha">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label for="">Comentario</label>
                                    <input type="text" class="form-control txtComentario" name="comentario" maxlength="100" id="comentario">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Guardar Gestión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js-scripts')
<script>
$(document).ready(function () {

    /****************** FEEDBACK *********************/

    $('[data-toggle="tooltip"]').tooltip();
    
    // Cuando le de click a alguno de los botones de feedback
    $('.icon-feedback').click(function () {
        
        //Si quita un feedback
        if ($(this).hasClass('icon-feedback-active')) {
            
            $(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
            $(this).closest('tr').find('.cellTelefono').removeClass('tachado');
            $.ajax({
                type: "POST",
                data: {
                    telefono: $(this).attr('telefono'),
                    lead: $(this).attr('lead'),
                    "_token": "{{ csrf_token() }}",
                },
                url: APP_URL + '/bpe/quitar-feedback',
                dataType: 'json',
                success: function (json) {
                    console.log('listo!');
                },
                error: function (xhr, status, text) {
                    alert(text);
                }
            });
        } else {
            //Si agrega o cambia un feedback
            $(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
            $(this).addClass('icon-feedback-active');
            
            switch ($(this).attr('feedback')) {
                case 'NEGATIVO':
                    $(this).closest('tr').find('.cellTelefono').addClass('tachado');
                    break;
                case 'POSITIVO':
                    $('#txtTelefono').val($(this).attr('telefono'));
                case 'NEUTRO':
                    $(this).closest('tr').find('.cellTelefono').removeClass('tachado');
                    break;
            }
            
            if ($(this).attr('feedback') === 'POSITIVO') {
                $('#txtTelefono').val($(this).attr('telefono'));
            }
            
            $.ajax({
                type: "POST",
                data: {
                    telefono: $(this).attr('telefono'),
                    lead: $(this).attr('lead'),
                    feedback: $(this).attr('feedback'),
                    "_token": "{{ csrf_token() }}"
                },
                url: APP_URL + '/bpe/registrar-feedback',
                dataType: 'json',
                success: function (json) {
                    console.log('listo!');
                },
                error: function (xhr, status, text) {
                    alert(text);
                    $(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
                }
            });
        }
    });

    /****************** NUEVA CITA *********************/

    /*Validación de Formulario de Cita*/
    $('#nuevaCitaForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            pcontacto: {
                validators: {
                    notEmpty: {
                        message: 'El contacto es requerido'
                    },
                    stringLength: {
                        min: 6,
                        message: 'El nombre del contacto debe tener al menos 6 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-ZñÑü ]+$/,
                        message: 'El nombre solo puede tener caracteres alfabéticos'
                    }
                }
            },
            direccion: {
                validators: {
                    notEmpty: {
                        message: 'La dirección es requerida'
                    }
                }
            },
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'El teléfono es requerido'
                    },
                    stringLength: {
                        min: 9,
                        message: 'El teléfono debe tener 9 dígitos de longitud'
                    },
                    regexp: {
                        regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                        message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                    }
                }
            },
            hora: {
                validators: {
                    remote: {
                        message: 'El horario seleccionado ya está ocupado',
                        url: APP_URL + '/bpe/campanha/validator/horarioEjecutivo',
                        data: function (validator, $field, value) {
                            return {
                                ejecutivo: validator.getFieldElements('regEjecutivo').val(),
                                fecha: validator.getFieldElements('fecha').val()
                            };
                        },
                        type: 'GET'
                    }
                }
            }
        }
    });


    /****************** NUEVA GESTION *********************/

    //Elimina todas las opciones de motivo excepto la primera (necesario para evitar problemas al enviar formulario)
    $('.cboMotivo option').not(':eq(0), :selected').remove();

        //Carga de Datepicker
    $('#gestionForm .dpFecha').datepicker({
        maxViewMode: 1,
        daysOfWeekDisabled: "0,6",
        language: "es",
        autoclose: true,
        startDate: "+1d",
        endDate: "+90d",
        format: "yyyy-mm-dd"
    }).on('changeDate', function (e) {
        // Set the value for the date input
        $(this).closest('form').formValidation('revalidateField', 'dpFecha');
    });

    $(document).on("change", '.cboResultado', function (e) {

        var resultado = $(this).val();
        var form = $(this).closest('form');

        //Limpiamos el combobox de motivos
        form.find('.cboMotivo option:not(:first)').remove();

        //Si no selecionada nada como resultado
        if (resultado == '') {
            form.find('.cboMotivo').parent().addClass("hidden");
            form.find('.dpFecha').parent().addClass("hidden");
            return;
        }

        //Si selecciona lo pensará como resultado
        if ($("option:selected", this).text() == 'LO PENSARA') {
            form.find('.cboMotivo').parent().addClass("hidden");
            form.find('.dpFecha').parent().removeClass("hidden");
            return;
        }


        //Si selecciona cualquier otro resultado
        form.find('.cboMotivo').prop('disabled', true);
        form.find('.cboMotivo').parent().removeClass("hidden");
        form.find('.dpFecha').parent().addClass("hidden");

        $.ajax({
            type: "GET",
            data: {resultado: resultado},
            url: APP_URL + '/bpe/campanha/utils/get-motivo-by-resultado',
            dataType: 'json',
            success: function (json) {
                $.each(json, function (key, value) {
                    form.find('.cboMotivo').append($("<option></option>")
                            .attr("value", value.id).text(value.desc));
                });
                form.find('.cboMotivo').prop('disabled', false);
                form.formValidation('revalidateField', 'motivo');
            }
        });
    });

    /*Validacion del formulario de gestión*/
    $('#gestionForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            resultado: {
                validators: {
                    notEmpty: {
                        message: 'El resultado de la gestión es requerido'
                    },
                }
            },

            motivo: {
                validators: {
                    notEmpty: {
                        message: 'El motivo de la gestión es requerido'
                    }
                }
            },
            dpFecha: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese una fecha tentativa de contacto'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha no es válida'
                    }
                }
            },
            comentario: {
                enabled: false,
                validators: {
                    notEmpty: {
                        message: 'El motivo de la gestión es requerido'
                    },
                    stringLength: {
                        min: 10,
                        max: 100,
                        message: 'El comentario de la gestión debe tener al menos 10 caracteres'
                    },
                }
            },
        }
    }).on('change', '[name="resultado"]', function () {
        console.log($("option:selected", this).text());
        $('#gestionForm').formValidation('enableFieldValidators', 'comentario', $("option:selected", this).text() == 'LO PENSARA');
        $('#gestionForm').formValidation('validateField', 'comentario');

    });

});
</script>
@stop