<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pageTitle', 'Detalle de Cliente'); ?>

<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
    $modoJefe = in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO,
      App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_TIENDA]);
    $modoAsistente= Auth::user()->ROL==App\Entity\Usuario::ROL_ASISTENTE_COMERCIAL;
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos del Cliente</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Documento:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="(<?php echo e($cliente->TIPO_DOCUMENTO); ?>) <?php echo e($cliente->NUM_DOC); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->NOMBRE_CLIENTE); ?>">
                        </div>
                    </div>
                    <?php if($cliente->TIPO_DOCUMENTO === 'RUC'): ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Representante:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->REPRESENTANTE_LEGAL); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Distrito:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->DISTRITO); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->DIRECCION); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tienda:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->TIENDA); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Giro/Actividad:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->GIRO); ?> - <?php echo e($cliente->ACTIVIDAD); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Score:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->SCORE_COMPORTAMIENTO); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Saldo:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="S/. <?php echo e(number_format($cliente->SALDO,0,'.',',')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Atraso Prom./Ult:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="<?php echo e($cliente->ATRASO_PROMEDIO . ' d / ' . $cliente->ATRASO_ULTIMO.' d'); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos de Contacto</h2>
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
                        <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><label><?php echo e(ucwords(strtolower($contacto->TIPO_CONTACTO))); ?>:</label></td>
                            <td><?php echo e($contacto->VALOR); ?></td>
                            <td>
                                <i  aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $telefonos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $telefono): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><label>Telefono <?php echo e(($key + 1)); ?>:</label></td>
                            <td class="cellTelefono <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'tachado' : '' ?>"><?php echo e($telefono); ?></td>
                            <td>
                                <?php if(!$modoJefe and !$modoAsistente): ?>
                                <i 
                                    feedback="POSITIVO"  lead="<?php echo e($cliente->NUM_DOC); ?>"  telefono="<?php echo e($telefono); ?>" aria-hidden="true"
                                    class="icon-feedback fa fa-thumbs-o-up <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'POSITIVO') ? 'icon-feedback-active' : '' ?>" 
                                    data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                                <i feedback="NEUTRO" lead="<?php echo e($cliente->NUM_DOC); ?>" telefono="<?php echo e($telefono); ?>" aria-hidden="true" 
                                    class="icon-feedback fa fa-meh-o <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEUTRO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="No contestó">
                                        
                                </i>
                                
                                <i feedback="NEGATIVO" lead="<?php echo e($cliente->NUM_DOC); ?>" telefono="<?php echo e($telefono); ?>" aria-hidden="true" 
                                      class="icon-feedback fa fa-thumbs-o-down <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="Número erróneo">          
                                </i>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(!$modoJefe and !$modoAsistente): ?>
                <button id="btnNuevoContacto" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos de Contacto</button>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="col-md-6 col-sm-6 cold-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Estrategia</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php ?>
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#"  role="tab" data-toggle="tab" aria-expanded="true">
                        <?php echo e($cliente->NOMBRE_CAMP); ?> <!--NOMBRE DE LA CAMPAÑA-->
                    </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" >
                        <form class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Monto Aprobado:</label> 
                                <label class="info-label col-md-9 col-sm-9 col-xs-9">S/. <?php echo e($cliente->MONTO_APROBADO); ?></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Monto Disponible:</label> 
                                <label class="info-label col-md-9 col-sm-9 col-xs-9">S/. <?php echo e($cliente->MONTO_DISPONIBLE); ?></label>
                            </div>
                            <?php if($cliente->CANAL!=NULL): ?>                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Canal:</label> 
                                <label class="info-label col-md-9 col-sm-9 col-xs-9"><?php echo e($cliente->CANAL); ?></label>
                            </div>                   
                            <?php endif; ?>    
                             <?php if($cliente->CANAL_ATENCION!=NULL): ?>                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Canal de Atención:</label> 
                                <label class="info-label col-md-9 col-sm-9 col-xs-9"><?php echo e($cliente->CANAL_ATENCION); ?></label>
                            </div>                   
                            <?php endif; ?>          
                            <?php if($cliente->ESTRATEGIA_LINEA!=NULL): ?>  
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Estrategia:</label> 
                                <label class="info-label col-md-9 col-sm-9 col-xs-9"><?php echo e($cliente->ESTRATEGIA_LINEA); ?></label>
                            </div>
                            <?php endif; ?> 
                        </form>


                        <div class="ln_solid"></div>
                        <div class="divGestionArea form-group">
                            <div class="divGestionInfo form-group">
                                <form class="form-horizontal form-label-left">
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Resultado:</label>
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblResultado"><?php echo e($cliente->DESCRIPCION_RESULTADO); ?></label>
                                    </div>
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) && $cliente->DESCRIPCION_RESULTADO == 'LO PENSARA' ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Volver a llamar:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblVolverLLamar"><?php echo e($cliente->FECHA_VOLVER_LLAMAR); ?></label>
                                    </div>
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) && $cliente->DESCRIPCION_RESULTADO <> 'LO PENSARA' ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Motivo:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblMotivo"><?php echo e($cliente->DESCRIPCION_MOTIVO); ?></label>
                                    </div>
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Comentario:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblComentario"><?php echo e(isset($cliente->COMENTARIO_GESTION)? $cliente->COMENTARIO_GESTION:"-"); ?></label>
                                    </div>  
                                    <?php if(!$modoJefe and !$modoAsistente): ?>                                  
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) ? '' : 'hidden' ?>">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="button" class="btn btn-sm btn-success btnEditarGestion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</button>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) ? 'hidden' : '' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Estado:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblSinGestion" style="font-weight: 800; color: #FA503A;">SIN GESTION</label>
                                    </div>
                                    <div class="form-group <?php echo isset($cliente->DESCRIPCION_RESULTADO) ? 'hidden' : '' ?>">
                                        <?php if(!$modoJefe and !$modoAsistente): ?>
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="button" class="btn btn-sm btn-success btnGestionar"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Gestionar</button>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>


                            <!--FORMULARIO DE GESTIÓN-->
                            <div class="divGestionForm hidden">
                                <form id="gestionForm" class="gestionForm form-horizontal" action="<?php echo e(route('bpe.campanha.ejecutivo.clientes.nueva-gestion')); ?>" method="POST">
                                    <input type="hidden" name="campanha" value="<?php echo e($cliente->ID_CAMP_EST); ?>" >
                                    <input type="hidden" name="periodo" value="<?php echo e($cliente->PERIODO); ?>" >
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                                    <input type="hidden" name="regEjecutivo" value="<?php echo e($cliente->REGISTRO_EN); ?>">
                                    <input type="hidden" name="cliente" value="<?php echo e($cliente->NUM_DOC); ?>">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Resultado:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control cboResultado" name="resultado" id="resultado">
                                                <option value="">Elige una opción</option>
                                                <?php $__currentLoopData = $resultados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resultado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($resultado->id); ?>"><?php echo e($resultado->desc); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control cboMotivo" name="motivo" id="motivo">
                                                <option value="">Elige una opción</option>
                                                <?php $__currentLoopData = $motivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($motivo->id); ?>"><?php echo e($motivo->desc); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group hidden">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Tentativa:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control dpFecha" id="dpFecha" name="fecha">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control txtComentario" name="comentario" maxlength="150" id="comentario" placeholder="Max. 150 caracteres">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 form-group">
                                        <button type="button" class="btn btnCancelarGestion">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Gestión</button>
                                    </div>
                                </form>  
                            </div>                           
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template de formulario de nueva gestion -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Gestiones anteriores</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblGestiones" class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Ejecutivo</th>
                            <th>Campaña</th>
                            <th>Fecha</th>
                            <th>Resultado</th>
                            <th>Motivo/Volver LLamar</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($gestiones)>0): ?>
                        <?php $__currentLoopData = $gestiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($gestion->EJECUTIVO); ?></td>
                            <td><?php echo e($gestion->CAMP_EST_NOMBRE); ?></td>
                            <td><?php echo e($gestion->FECHA_REGISTRO); ?></td>
                            <td><?php echo e($gestion->GESTION_RESULTADO); ?></td>
                            <td><?php echo e(($gestion->GESTION_RESULTADO == 'LO PENSARA')? $gestion->FECHA_VOLVER_LLAMAR: $gestion->GESTION_MOTIVO); ?></td>
                            <td><?php echo e(isset($gestion->COMENTARIO)? $gestion->COMENTARIO:'-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr class="emptyResult">
                            <td colspan="7">No se encontraron gestiones previas</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.Modal Agregar Contacto -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoContacto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Contacto</h4>
            </div>
            <form id="frmNuevoContacto" class="form-horizontal form-label-left" action="<?php echo e(route('bpe.campanha.ejecutivo.leads.nuevo-contacto')); ?>">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                    <input type="hidden" name="lead" value="<?php echo e($cliente->NUM_DOC); ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Contacto:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="cboTipoContacto" id="cboTipoContacto" class="form-control">
                                <option value="TELEFONO">Teléfono</option>
                                <option value="DIRECCION">Dirección</option>
                                <option value="EMAIL">Email</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="txtContacto" name="txtContacto" class="form-control" type="text" value="" maxlength="150">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
$(document).ready(function () {


      /************ NUEVO CONTACTO ******************/
    
    // Cuando se abre el modal limpiamos el formulario de contacto
    $('#btnNuevoContacto').click(function () {
        $('#cboTipoContacto').val("TELEFONO");
        $('#lblContacto').text("Teléfono:");
        $('#txtContacto').val("");
        $('#modalNuevoContacto').modal();
        initializeFormValidationContacto();
    })

    $('#modalNuevoContacto').on('hidden.bs.modal', function () {
        $('#frmNuevoContacto').formValidation('destroy', true);
    })
    
    function initializeFormValidationContacto(){
        // Validación para formulario.
        $('#frmNuevoContacto').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                txtContacto: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un dato de contacto'
                        },
                        regexp: {
                            regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                            message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                        },
                        emailAddress: {
                            enabled: false,
                            message: 'El email ingresado no es válido. (miemail@dominio.com)'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
                    fv = $form.data('formValidation');
            $form.formValidation('disableSubmitButtons', true);
            
            
            // Enviamos el formulario en ajax, si todo sale bien se agrega a la tabla de contactos la data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    $('#modalNuevoContacto').modal('hide');
                    html = '<td><label>' + $('#cboTipoContacto').find("option:selected").text() + ":" + '</label></td>'
                    html += '<td>' + $('#txtContacto').val() + '</td>'
                    html += '<td>' + '<i  aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto"></i>' +'</td>';
                    if ($('#tblContactos > tbody > tr').length > 0){
                        $('#tblContactos > tbody').prepend('<tr>' + html + '</tr>');
                    }
                    else{
                        $('#tblContactos > tbody').html('<tr>' + html + '</tr>');   
                    }
                    $form.formValidation('destroy', true);
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                }
            });
        }).on('change', '#cboTipoContacto', function () {
            // Cada vez que cambiemos el combo de tipo de contacto, limpiamos data y re configuramos el validador para que se adapte al caso
            $('#lblContacto').text($(this).find("option:selected").text() + ":");
            $('#txtContacto').val("");
            
            switch ($(this).val()) {
                case "TELEFONO":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', true, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', true, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
                case "EMAIL":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', true, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', false, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
                case "DIRECCION":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', false, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
            }
        });

    }

    
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
                    "_token": "<?php echo e(csrf_token()); ?>",
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
                    "_token": "<?php echo e(csrf_token()); ?>"
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
    
    
    /****************** GESTIONAR CAMPAÑA-CLIENTE*********************/
    
    function cleanForm(form){
        form.find('select').val('');
        form.find('input[type=text]').val('');
        form.find('.cboMotivo').val('');
        form.find('.cboMotivo option:not(:first)').remove();
    }
    // Comportamiento de Botonos Gestionar/Editar/Cancelar que ocultan y muestran paneles
    $('.btnGestionar').click(function () {
        cleanForm($(this).closest('form'));
        mostrarForm($(this));

    });
    
    $('.btnEditarGestion').click(function () {
        cleanForm($(this).closest('form'));
        mostrarForm($(this));
    });
    
    $('.btnCancelarGestion').click(function () {
        var form = $(this).closest('form');
        form.formValidation('destroy', true);
        $(this).closest('.divGestionForm').addClass('hidden');
        $(this).closest('.divGestionArea').find('.divGestionInfo').removeClass("hidden");
    });
    
    function mostrarForm(button) {
        button.closest('.divGestionArea').find('.divGestionForm').removeClass("hidden");
        initializeFormValidationGestion(button.closest('.divGestionArea').find('.divGestionForm form'));
        button.closest('.divGestionInfo').addClass('hidden');
    }
    
    // Funcion para inicilizar los datepicker
    function initializeDatepicker() {
        $('.dpFecha').datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "+1d",
            endDate: "+90d",
            format: "yyyy-mm-dd"
        }).on('changeDate', function (e) {
            $(this).closest('form').formValidation('revalidateField', 'fecha');
        });
    }
    
    
    // FORMULARIO
    //Elimina todas las opciones de motivo excepto la primera (necesario para evitar problemas al enviar formulario)
    $('.cboMotivo option').not(':eq(0), :selected').remove();
    
    //Cuando se seleccione una opcion en Resultado
    function cboResultadoChange(combobox) {
        var resultado = combobox.val();
        var form = combobox.closest('form');
        
        //Limpiamos el combobox de motivos
        console.log(form.find('.cboMotivo'));
        console.log(form.find('.cboMotivo option:not(:first)'));
        
        
        //Si no selecionada nada como resultado
        if (resultado === '') {
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            form.find('.dpFecha').closest('.form-group').addClass("hidden");
            return;
        }
        
        //Si selecciona lo pensará como resultado
        if ($("option:selected", combobox).text() === 'LO PENSARA') {
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            form.find('.dpFecha').closest('.form-group').removeClass("hidden");
            initializeDatepicker();
            return;
        }
        

       if($("option:selected", combobox).text() === 'FUERA DE PERFIL POR VENTAS'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() === 'MALAS REFERENCIAS CREDITICIAS'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() === 'ACEPTA GIRO'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }

        if($("option:selected", combobox).text() ==='CONTACTO AVAL'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='NO CONTESTA'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='NRO. ERRADO'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='MALOGRADO/CORTADO'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='CONTACTO TITULAR'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='CONTACTO FAMILIAR'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }
        if($("option:selected", combobox).text() ==='CONTACTO VECINO'){
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            return;
        }

       
        //Si selecciona cualquier otro resultado
        form.find('.cboMotivo').prop('disabled', true);
        form.find('.cboMotivo').closest('.form-group').removeClass("hidden");
        form.find('.dpFecha').closest('.form-group').addClass("hidden");
        
        $.ajax({
            type: "GET",
            data: {resultado: resultado},
            url: APP_URL + '/bpe/campanha/utils/get-motivo-by-resultado',
            dataType: 'json',
            success: function (json) {
                form.find('.cboMotivo option:not(:first)').remove();
                $.each(json, function (key, value) {
                    form.find('.cboMotivo').append($("<option></option>")
                            .attr("value", value.id).text(value.desc));
                });
                form.find('.cboMotivo').prop('disabled', false);
                form.formValidation('revalidateField', 'motivo');
            }
        });
    }
    
    /*Validacion del formulario de gestión*/
    
    function initializeFormValidationGestion(form) {
        form.formValidation({
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
                        }
                    }
                },
                
                motivo: {
                    validators: {
                        notEmpty: {
                            message: 'El motivo de la gestión es requerido'
                        }
                    }
                },
                fecha: {
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
                    validators: {
                        notEmpty: {
                            enabled: false,
                            message: 'El comentario es requerido'
                        },
                        stringLength: {
                            min: 10,
                            max: 150,
                            message: 'El comentario de la gestión debe tener al menos 10 caracteres'
                        }
                    }
                }
            }
        }).on('change', '.cboResultado', function () {
            cboResultadoChange($(this));
            thisForm = $(this).closest('form');
            
            if (
                $("option:selected", this).text() === 'FUERA DE PERFIL POR VENTAS' ||
                $("option:selected", this).text() === 'MALAS REFERENCIAS CREDITICIAS' ||
                $("option:selected", this).text() === 'ACEPTA GIRO' ||
                $("option:selected", this).text() ==='CONTACTO AVAL' ||
                $("option:selected", this).text() ==='NO CONTESTA' ||
                $("option:selected", this).text() ==='NRO. ERRADO' ||
                $("option:selected", this).text() ==='MALOGRADO/CORTADO' ||
                $("option:selected", this).text() ==='CONTACTO TITULAR' ||
                $("option:selected", this).text() ==='CONTACTO FAMILIAR' ||
                $("option:selected", this).text() ==='CONTACTO VECINO'
                ) {
                thisForm.formValidation('enableFieldValidators', 'comentario', true, 'notEmpty');
            } else {
                thisForm.formValidation('enableFieldValidators', 'comentario', false, 'notEmpty');
            }
            thisForm.formValidation('revalidateField', 'comentario');
            
        }).on('success.form.fv', function (e) {
            var $form = $(e.target);
            $form.formValidation('disableSubmitButtons', true);
            e.preventDefault();
            
            // Enviamos el formulario en ajax,
            $.ajax({
                url: APP_URL + 'bpe/en/nueva-gestion-cartera',
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    divInfo = $form.closest('.divGestionArea').find('.divGestionInfo');
                    
                    // Dibujando el area de gestion/campaña
                    divInfo.find('.lblResultado').text(result.GESTION_RESULTADO).closest('.form-group').removeClass("hidden");
                    divInfo.find('.lblComentario').text(!result.COMENTARIO ? '-' : result.COMENTARIO).closest('.form-group').removeClass("hidden");
                    divInfo.find('.btnEditarGestion').closest('.form-group').removeClass("hidden");
                    divInfo.find('.btnGestionar').closest('.form-group').addClass("hidden");
                    divInfo.find('.lblSinGestion').closest('.form-group').addClass("hidden");
                    

                    if (result.GESTION_RESULTADO === 'LO PENSARA') {
                        divInfo.find('.lblVolverLLamar').text(result.FECHA_VOLVER_LLAMAR).closest('.form-group').removeClass("hidden");
                        divInfo.find('.lblMotivo').text(result.GESTION_MOTIVO).closest('.form-group').addClass("hidden");
                    } else {
                        divInfo.find('.lblVolverLLamar').text(result.FECHA_VOLVER_LLAMAR).closest('.form-group').addClass("hidden");
                        divInfo.find('.lblMotivo').text(result.GESTION_MOTIVO).closest('.form-group').removeClass("hidden");
                    }
                    
                    //Agregando item a tabla historica de gestiones
                    html = '<td>' + result.EJECUTIVO + '</td>';
                    html += '<td>' + result.CAMP_EST_NOMBRE + '</td>';
                    html += '<td>' + result.FECHA_REGISTRO + '</td>';
                    html += '<td>' + result.GESTION_RESULTADO + '</td>';
                    html += '<td>' + (result.GESTION_RESULTADO === 'LO PENSARA' ? result.FECHA_VOLVER_LLAMAR : result.GESTION_MOTIVO) + '</td>';                    
                    html += '<td>' + (!result.COMENTARIO ? '-' : result.COMENTARIO) + '</td>';
                    
                    $('#tblGestiones > tbody > tr:first').before('<tr>'+ html +'</tr>');
                    $('#tblGestiones > tbody').find('.emptyResult').remove();
                    
                    //Cerrando Formulario
                    $form.formValidation('destroy', true);
                    $form.closest('.divGestionForm').addClass("hidden");
                    divInfo.removeClass("hidden");
                    cleanForm($form);
                    
                },
                error: function (xhr, status, text) {
                    $form.closest('.divGestionForm').addClass("hidden");
                    $form.closest('.divGestionArea').find('.divGestionInfo').removeClass("hidden");
                    cleanForm($form); 
                    alert('Hubo un error al registrar su información. Inténtelo nuevamente');
                }
            });
        });
    }
    
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>