<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pageTitle', 'Registro de Citas'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="" class="form-horizontal" method="GET">
                    <div class="form-group col-md-4">
                        <label for="" class="control-label col-md-4">DNI/RUC:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo e($documento); ?>" name="documento" maxlength="15">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if(!$lead): ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <?php if(!$documento): ?>
                <label>Ingresese un número de documento</label>
            <?php else: ?>
                <label>No se encontraron resultados para el documento <?php echo e($documento); ?></label>
            <?php endif; ?>
        </div>
    </div>
</div>    
<?php else: ?>
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
                            <input class="form-control" type="text" value="(<?php echo e($lead->TIPO_DOCUMENTO); ?>) <?php echo e($lead->NUM_DOC); ?>" readonly="readonly">
                        </div>

                        <div class="col-md-8 form-group">
                            <label for="">Nombre/ R. Social</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->NOMBRE_CLIENTE); ?>" readonly="readonly">
                        </div>
                    </div>
                    <?php if($lead->TIPO_DOCUMENTO === 'RUC'): ?>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="" class="">Representante</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->REPRESENTANTE_LEGAL); ?>" readonly="readonly">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Dirección</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->DIRECCION); ?>" readonly="readonly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="">Distrito</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->DISTRITO); ?>" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Tienda</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->TIENDA); ?>" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Zonal</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->ZONAL); ?>" readonly="readonly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="">Riesgo</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->SCORE_BURO); ?>" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Giro</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->GIRO); ?>" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="">Actividad</label>
                            <input class="form-control" type="text" value="<?php echo e($lead->ACTIVIDAD); ?>" readonly="readonly">
                        </div>
                    </div>           
                </form> 
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 cold-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Calendario del Ejecutivo
                <span style="font-size: 14px;">(<?php echo e($lead->EN_REGISTRO); ?>) <?php echo e($lead->EN_NOMBRE); ?></span>
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
                            <?php $__currentLoopData = $calendario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th><?php echo e($dia); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php $__currentLoopData = $horario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $khora => $hora): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($hora); ?></th>
                            <?php $__currentLoopData = $calendario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kdia => $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="celda-horario">
                            <?php if(in_array($kdia.'-'.$khora,$horarioEjecutivo)): ?>
                                <span class="glyphicon glyphicon-ban-circle" style="color: #A94442;"></span> <span style="color: #A94442;">Ocupado<span>
                            <?php else: ?>
                            </td>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<?php if($lead->ID_CITA): ?>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-dismissible alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php 
                $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA);
                $hoy = Jenssegers\Date\Date::now();
            ?>
            El cliente ya 
            <?php if($hoy->diffInDays($fecha,false) < 0): ?>
                tuvo
            <?php else: ?>
                tiene
            <?php endif; ?>
            una cita programada para el día <strong><?php echo e($fecha->format("d \\d\\e F ")); ?></strong> a las <strong><?php echo e($fecha->format("H:i")); ?></strong>
        </div>
        </div>
</div>
<?php endif; ?>

<?php if(!($lead->ID_CITA && $hoy->diffInDays($fecha,false) < 0)): ?>
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
                <form id="nuevaCitaForm" method="POST" action="<?php echo e(route('bpe.campanha.call.cita.guardar')); ?>">
                    <div class="row">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                        <input type="hidden" id="regEjecutivo" name="regEjecutivo" value="<?php echo e($lead->EN_REGISTRO); ?>">
                        <input type="hidden" id="lead" name="lead" value="<?php echo e($lead->NUM_DOC); ?>" maxlength="50">
                        <div class="col-md-8 form-group">
                            <label for="">Persona Contacto</label>
                            <?php if($lead->ID_CITA): ?>
                                <input type="text" class="form-control" id="pcontacto" name="pcontacto" value="<?php echo e($lead->CITA_CONTACTO_PERSONA); ?>" maxlength="50">
                            <?php else: ?>
                                <?php if(isset($lead->REPRESENTANTE_LEGAL)): ?>
                                <input type="text" class="form-control" id="pcontacto" name="pcontacto" value="<?php echo e($lead->REPRESENTANTE_LEGAL); ?>" maxlength="50">
                                <?php else: ?>
                                <input type="text" class="form-control" id="pcontacto" name="pcontacto" value="<?php echo e($lead->NOMBRE_CLIENTE); ?>"  maxlength="50">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Teléfono</label>
                            <input type="text" class="form-control" id="txtTelefono" name="telefono" maxlength="9" 
                            value="<?php echo e($lead->ID_CITA? $lead->CITA_CONTACTO_TELEFONO : ''); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" maxlength="250"
                            value="<?php echo e($lead->ID_CITA? $lead->CITA_CONTACTO_DIRECCION : $lead->DIRECCION); ?>" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Referencia</label>
                            <input type="text" class="form-control" id="referencia" name="referencia" 
                            value="<?php echo e($lead->ID_CITA? $lead->CITA_CONTACTO_REFERENCIA : ''); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="">Fecha</label>
                            <input type="text" class="form-control" id="txtFecha" name="fecha" onkeydown="return false" 
                            value="<?php echo e($lead->ID_CITA? $fecha->format('Y-m-d'):''); ?>">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Hora</label>
                            <select class="form-control" name="hora" id="hora">
                                <?php $__currentLoopData = $horasDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hora): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($lead->ID_CITA && $fecha->format('H:i') == $key ? 'selected="selected"' : ''); ?> ><?php echo e($hora); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Autorización de Datos</label>
                            <select class="form-control" name="autDatos" id="autDatos">
                                <option value="si" <?php echo e($lead->ID_CITA && $lead->AUTORIZACION_DATOS == 'si' ? 'selected="selected"' : ''); ?>>Sí</option>
                                <option value="no" <?php echo e($lead->ID_CITA && $lead->AUTORIZACION_DATOS == 'no' ? 'selected="selected"' : ''); ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <?php if($lead->ID_CITA): ?>
                                <input type="hidden" name="cita" value="<?php echo e($lead->ID_CITA); ?>" >
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar Cita</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar Cita</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
    $(document).ready(function () {

    var today = new Date();
    var lastDate = new Date(today.getFullYear(), today.getMonth(0), 31);

    $('#txtFecha').datepicker({

        maxViewMode: 1,
        daysOfWeekDisabled: "0,6",
        language: "es",
        autoclose: true,
        startDate: "+1d",
        endDate: "+15d",
        format: "yyyy-mm-dd"
    }).on('changeDate', function (e) {
        $(this).closest('form').formValidation('revalidateField', 'hora');
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
                    regexp: {
                        regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                            message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                    }
                }
            },
            hora: {
                validators: {
                    remote: {
                        delay: 1000,
                        message: 'El horario seleccionado ya está ocupado',
                        url: APP_URL + '/bpe/campanha/validator/horarioEjecutivo',
                        data: function (validator, $field, value) {
                            return {
                                ejecutivo: validator.getFieldElements('regEjecutivo').val(),
                                fecha: validator.getFieldElements('fecha').val(),
                                cita: validator.getFieldElements('cita').val()
                            };
                        },
                        type: 'GET'
                    }
                }
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>