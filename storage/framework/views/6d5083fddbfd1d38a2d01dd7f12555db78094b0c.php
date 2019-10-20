<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(URL::asset('css/datatables.min.css')); ?>" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/datatables.min.js')); ?>"></script>

<!--FORM VALIDATION-->
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>

<style type="text/css">
    .formatoCheck{
        font-size: 14px;
    }

    .espaciado{
        padding-left: 15px;
    }

    .has-feedback .form-control {
        padding-right: 10px !important;
    }

    .fv-plugins-icon, .form-control-feedback{
        display: none !important;
    }

</style>
<?php $__env->stopSection(); ?>

<?php
//Son los usuarios que no pueden hacer modificaciones en esta ficha
$soloLectura = in_array(Auth::user()->ROL, array_merge(App\Entity\Usuario::getEquipoInfinity()));
?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle','Ficha Visita'); ?>
<!--Flag de solo lectura-->
<input type="text" id="soloLectura" value="<?php echo e($soloLectura); ?>" hidden="">

<form id="frmVisita" action="<?php echo e(route('infinity.me.cliente.visita.guardar')); ?>" method="POST">
    <input type="hidden" name="codunicoConoceme" value="<?php echo e($cliente->getValue('_codunicoConoceme')); ?>">
    <input type="hidden" name="codunico" value="<?php echo e($cliente->getValue('_codunico')); ?>">

    <input type="hidden" name="flgPorRevisar" value="<?php echo e($flgPorRevisar && $usuario->getValue('_rol') != App\Entity\Usuario::ROL_JEFATURA_BE); ?>" />

    <?php if($flgPorRevisar): ?>
    <div class="alert alert-warning" role="alert">La visita está pendiente de revisión.</div>
    <?php endif; ?>

    <?php if(!$flgPorRevisar && $usuario->getValue('_rol') == App\Entity\Usuario::ROL_JEFATURA_BE): ?>
    <div class="alert alert-warning" role="alert">No hay ninguna visita pendiente por revisar.</div>
    <?php endif; ?>

    <!-- DATOS GENERALES DE LA EMPRESA -->
    <div class="row">
        <div class="col-xs-12" >
            <div class="x_panel" style="min-height: 180px">
                <div class="x_title">
                    <h2>Empresa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-4 form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Empresa</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly  value="<?php echo e($cliente->getValue('_nombre')); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Cod. Unico</label>
                                <div class="col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo e($cliente->getValue('_codunico')); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">EEFF Jun</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" readonly  value="<?php echo e($infoCliente->FECHA_ULTIMO_EEFF_1); ?>">
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <?php
                                    echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_DDJJ, $infoCliente->FECHA_ULTIMO_EEFF_1);
                                    ?>                                    
                                </div>                                        

                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">EEFF Dic</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo e($infoCliente->FECHA_ULTIMO_EEFF_2); ?>">
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <?php
                                    echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_EEFF, $infoCliente->FECHA_ULTIMO_EEFF_2);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">F02</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" readonly  value="<?php echo e($infoCliente->FECHA_ULTIMO_F02); ?>">
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <?php
                                    echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_F02, $infoCliente->FECHA_ULTIMO_F02);
                                    ?>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">IBR</label>
                                <div class="col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" readonly value="<?php echo e($infoCliente->FECHA_ULTIMO_IBR); ?>">
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <?php
                                    echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_IBR, $infoCliente->FECHA_ULTIMO_IBR);
                                    ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($flgPorRevisar || $usuario->getValue('_rol') != App\Entity\Usuario::ROL_JEFATURA_BE): ?>

    <!-- ZONA DE CHECKS -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label class="formatoCheck">
                                <input name="flagCambioModelo" id="flagCambioModelo" type="checkbox" <?php echo e($visita->getValue('_flagCambioModeloNegocio') == 1?'checked':''); ?>>¿Cambió el modelo de negocio? 
                            </label>
                        </div>           

                        <div class="checkbox">
                            <label class="formatoCheck">
                                <input name="flagCambioMixVentas" id="flagCambioMixVentas" type="checkbox" <?php echo e($visita->getValue('_flagCambioMixVentas') == 1?'checked':''); ?>>¿Cambió los productos o mix de ventas? 
                            </label>
                        </div>
                        <!--
                            <div class="checkbox">
                                <label class="formatoCheck">
                                    <input name="flagCambioProcesoIntegracion" id="flagCambioProcesoIntegracion" type="checkbox" <?php echo e($visita->getValue('_flagCambioProcesoIntegracion')== 1?'checked':''); ?>>¿Presenta algún cambio en el proceso de integración de la cadena? 
                                </label>
                            </div>
                        -->

                        <div class="checkbox">
                            <label class="formatoCheck">
                                <input name="flagCambioConcentracionProveedores" id="flagCambioConcentracionProveedores" type="checkbox" <?php echo e($visita->getValue('_flagCambioConcentracionProveedores')== 1?'checked':''); ?>>¿Cambió la concentración de proveedores de sus clientes?
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="formatoCheck">
                                <input name="flagCambioConcentracionVentas" id="flagCambioConcentracionVentas" type="checkbox" <?php echo e($visita->getValue('_flagCambioConcentracionVentas')== 1?'checked':''); ?>>¿Cambió la concentración de ventas de sus clientes? 
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="formatoCheck col-sm-4">
                                <input name="flagCambioOperaciones" id="flagCambioOperaciones" type="checkbox" class="check" <?php echo e($visita->getValue('_flagCambioOperaciones')== 1?'checked':''); ?>>¿Cambió la zona de operaciones? 
                            </label>
                            <div class="col-sm-6">
                                <button data-toggle="modal" data-target="#modalZonaOperaciones" type="button" class="btn btn-primary" id="btnZonasOperaciones" disabled>Lista de Zonas de Operacion</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="checkbox">
                            <label class="formatoCheck col-sm-4">
                                <input name="flagCambioZonaClientes" id="flagCambioZonaClientes" type="checkbox" class="check" <?php echo e($visita->getValue('_flagCambioZonaClientes')== 1?'checked':''); ?>>¿Cambió la zona de clientes?
                            </label>
                            <div class="col-sm-6">
                                <button data-toggle="modal" data-target="#modalZonaClientes" type="button" class="btn btn-primary" id="btnZonasClientes" disabled>Lista de Zonas de clientes</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php if($cliente->getValue('_backlog') == 'Proyectos'): ?>
                        <ul class="list-unstyled msg_list">
                            <li><div class="checkbox grupoCheck">
                                    <label class="formatoCheck col-md-3">
                                        <input name="flagBacklog" id="flagBacklog" type="checkbox" class="check" <?php echo e($visita->getValue('_flagCambioBacklog')== 1?'checked':''); ?>>Backlog Proyectos
                                    </label>
                                    <div class="col-sm-9">
                                        <label class="formatoCheck">¿Cambió la política de compras?
                                            <select class="form-control" name="gestionesCompra" value="<?php echo e($cliente->getValue('_gestionesCompra')); ?>" disabled>
                                                <option value="">--Elegir Opción--</option>
                                                <?php $__currentLoopData = $gestionesCompra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($b); ?>" <?php echo e(($cliente->getValue('_gestionesCompra')==$b)?'selected=selected':''); ?>><?php echo e($b); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <label>¿El cliente ha realizado inversiones de por lo menos 50% del activo fijo/patrimonio que representen un desvío de fondos?:</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control" name="flagCambioInversionActivoPatrimonio">
                                    <option value="0">No</option>
                                    <option value="1" <?php echo e($visita->getValue('_flagCambioInversionActivoPatrimonio')== 1?'selected':''); ?>>Sí</option>
                                </select>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="cambioInversionActivoPatrimonio"><?php echo e($visita->getValue('_cambioInversionActivoPatrimonio')); ?></textarea>
                                <p id="lblCambioInversionActivoPatrimonio" class="hidden">Explicar e indicar si esto genero un cambio de modelo de negocio actual</p>
                            </div>
                        </div>

                        <label for="fullname" style="padding-top: 10px;">¿El cliente ha realizado préstamos/desvío de fondos al accionista/empresa vincladas de por lo menos el 15% del acitvo en el último ejercicio?</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control" name="flagCambioPrestamoDesvio">
                                    <option value="0">No</option>
                                    <option value="1" <?php echo e($visita->getValue('_flagCambioPrestamoDesvio')== 1?'selected':''); ?>>Sí</option>
                                </select>
                            </div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="cambioPrestamoDesvio"><?php echo e($visita->getValue('_cambioPrestamoDesvio')); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE MIX Y MODELO DE NEGOCIO -->
    <div class="row">
        <div id="panelModeloNegocio" class="col-sm-6 col-xs-12 hidden">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Modelo de Negocio</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">Modelo de Negocio
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Descripción o detalle del cómo la empresa crea y entrega valor"></i>
                        </label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="3" name="modeloNegocio"><?php echo e($cliente->getValue('_modeloNegocio')); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">Ventaja Competitiva
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Señalar la principal ventaja competitiva en su sector"></i>
                        </label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="3" name="ventajaCompetitiva"><?php echo e($cliente->getValue('_ventajaCompetitiva')); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12">Fortalezas y Riesgos
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"  data-original-title="Señalar principales fortalezas y riesgos"></i>
                        </label>
                        <div class="col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="3" name="fortalezasRiesgos"><?php echo e($cliente->getValue('_fortalezasRiesgos')); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panelMixVentas" class="col-sm-6 col-xs-12 hidden">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mix de Ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <?php for($i=0;$i<3;$i++): ?>
                    <div class="row">
                        <div class="form-group col-sm-2"></div>
                        <div class="form-group col-sm-4">
                            <input class="form-control inputMixVentas" type="text" name="mixVenta[<?php echo e($i); ?>][productoServicio]" maxlength="50" placeholder="Producto/Servicio" value="<?php echo e(isset($cliente->getValue('_mixVentas')[$i])?$cliente->getValue('_mixVentas')[$i]->getValue('_productoServicio'):''); ?>">
                        </div>

                        <div class="form-group col-sm-4"> 
                            <select class="form-control inputMixVentas" name="mixVenta[<?php echo e($i); ?>][participacion]">
                                <?php $__currentLoopData = $participacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!--Añadir la opción de selected-->
                                <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($cliente->getValue('_mixVentas')[$i]) && $cliente->getValue('_mixVentas')[$i]->getValue('_participacion') == $key ?'selected':''); ?>>
                                    <?php echo e($par); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CLIENTES Y PROVEEDORES -->
    <div class="row">
        <div class="col-sm-12">
            <!--PROVEEDORES-->
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proveedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-2"><b>RUC</b></div>
                        <div class="col-sm-2"><b>Nombre</b></div>
                        <div class="col-sm-2"><b>Particip.</b></div>
                        <div class="col-sm-1"><b>Exclusiv.</b></div>
                        <div class="col-sm-1"><b>Año</b></div>
                        <div class="col-sm-1"><b>Contrato?</b></div>
                        <div class="col-sm-2"><b>Fec. Vec. Contrato</b></div>
                        <div class="col-sm-1"><b>Adjunto</b></div>
                    </div>
                    <?php for($i=0;$i<3;$i++): ?>
                    <div class="row">
                        <div class="form-group col-sm-2"> 
                            <input class="form-control inputConcentProv" type="text" name="proveedor[<?php echo e($i); ?>][documento]" maxlength="11" value="<?php echo e(isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_documento'):''); ?>" disabled>
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input class="form-control inputConcentProv" type="text" name="proveedor[<?php echo e($i); ?>][nombre]" maxlength="50" value="<?php echo e(isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_nombre'):''); ?>" disabled>
                        </div>
                        <div class="form-group col-sm-2"> 
                            <select class="form-control inputConcentProv" name="proveedor[<?php echo e($i); ?>][participacion]" disabled>
                                <?php $__currentLoopData = $participacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($cliente->getValue('_proveedores')[$i]) && $cliente->getValue('_proveedores')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''); ?>

                                    ><?php echo e($par); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <input class="inputConcentProv" type="checkbox" disabled
                                   name="proveedor[<?php echo e($i); ?>][exclusividad]" 
                                   <?php echo e(isset($cliente->getValue('_proveedores')[$i]) && $cliente->getValue('_proveedores')[$i]->getValue('_exclusividad') == 1 ?'checked':''); ?>>
                        </div>
                        <div class="form-group col-sm-1"> 
                            <input class="form-control inputConcentProv" type="text" name="proveedor[<?php echo e($i); ?>][desde]" maxlength="4" value="<?php echo e(isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_desde'):''); ?>" disabled>
                        </div>
                        <div class="form-group col-sm-1">
                            <input  type="checkbox" class="" 
                                    name="proveedor[<?php echo e($i); ?>][flgContrato]"  
                                    <?php echo e(isset($cliente->getValue('_proveedores')[$i]) && $cliente->getValue('_proveedores')[$i]->getValue('_flgContrato') == 1 ?'checked':''); ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <input class="form-control dfecha" type="text" name="proveedor[<?php echo e($i); ?>][contratofechaVencimiento]" 
                                   value="<?php echo e(isset($cliente->getValue('_proveedores')[$i])?$cliente->getValue('_proveedores')[$i]->getValue('_contratofechaVencimiento'):''); ?>">
                        </div>
                        <div class="form-group col-sm-1">
                            <!-- <input type="file" id="exampleInputFile"> !-->
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px">
                    <div class="row">
                        <div class="col-sm-2"><b>RUC</b></div>
                        <div class="col-sm-2"><b>Nombre</b></div>
                        <div class="col-sm-2"><b>Particip.</b></div>
                        <div class="col-sm-1"><b>Año</b></div>
                        <div class="col-sm-1"><b>Contrato?</b></div>
                        <div class="col-sm-2"><b>Fec. Vec. Contrato</b></div>
                        <div class="col-sm-2"><b>Adjunto</b></div>
                    </div>
                    <?php for($i=0;$i<3;$i++): ?>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <input class="form-control inputConcentCli" type="text" name="cliente[<?php echo e($i); ?>][documento]" maxlength="11" disabled="disabled" value="<?php echo e(isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_documento'):''); ?>">
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input class="form-control inputConcentCli" type="text" name="cliente[<?php echo e($i); ?>][nombre]" maxlength="50" disabled="disabled" value="<?php echo e(isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_nombre'):''); ?>">
                        </div>
                        <div class="form-group col-sm-2"> 
                            <select class="form-control inputConcentCli" name="cliente[<?php echo e($i); ?>][participacion]" disabled="disabled">
                                <?php $__currentLoopData = $participacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($cliente->getValue('_clientes')[$i]) && $cliente->getValue('_clientes')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''); ?>

                                    ><?php echo e($par); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-1"> 
                            <input class="form-control inputConcentCli" type="text" name="cliente[<?php echo e($i); ?>][desde]" maxlength="4" disabled="disabled"
                                   value="<?php echo e(isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_desde'):''); ?>" >
                        </div>
                        <div class="form-group col-sm-1">
                            <input  type="checkbox"  
                                    name="cliente[<?php echo e($i); ?>][flgContrato]"  <?php echo e(isset($cliente->getValue('_clientes')[$i]) && $cliente->getValue('_clientes')[$i]->getValue('_flgContrato') == 1 ?'checked':''); ?>>
                        </div>
                        <div class="form-group col-sm-2">
                            <input class="form-control dfecha" type="text" name="cliente[<?php echo e($i); ?>][contratofechaVencimiento]" value="<?php echo e(isset($cliente->getValue('_clientes')[$i])?$cliente->getValue('_clientes')[$i]->getValue('_contratofechaVencimiento'):''); ?>">
                        </div>
                        <div class="form-group col-sm-2">
                            <!-- <input type="file" id="exampleInputFile"> !-->
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Accionistas, FINANCIAMIENTOS y PROYECCION -->
    <div class="row">

        <!-- ACCIONISTAS-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Accionistas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="grupoCheck">
                        <div class="checkbox col-md-12"  style="padding-bottom: 10px">
                            <label class="formatoCheck col-md-5 col-sm-6">
                                <input name="flagCambioGerenciaGeneral" id="flagCambioGerenciaGeneral" type="checkbox" class="check"
                                       <?php echo e($visita->getValue('_flagCambioGerenciaGeneral') == '1'?'checked':''); ?>

                                >¿Cambió en Gerencia General? 
                            </label>
                            <div class="col-md-4 col-sm-6">
                                <input type="text" class="form-control"  name="cambioGerenciaGeneralAnnio" placeholder="año" value="<?php echo e($cliente->getValue('_cambioGerenciaGeneralAnnio')); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">G. General</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="gerenteGeneral" value="<?php echo e($cliente->getValue('_gerenteGeneral')); ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="grupoCheck">
                        <div class="checkbox"  style="padding-bottom: 10px">
                            <label class="formatoCheck">
                                <input name="flagCambioGestionFinanciera" id="flagCambioGestionFinanciera" class="check" type="checkbox"
                                       <?php echo e($visita->getValue('_flagCambioGestionFinanciera') == '1'?'checked':''); ?>       
                                >¿Cambió en Gestión Financiera? 
                            </label>                    
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3 col-xs-12">
                                <select class="form-control" name="financieroRol" value="<?php echo e($cliente->getValue('_financieroRol')); ?>" disabled>
                                    <option>--Elegir Opción--</option>
                                    <?php $__currentLoopData = $financieroRol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($b); ?>" <?php echo e(($cliente->getValue('_financieroRol')==$b)?'selected=selected':''); ?>><?php echo e($b); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="financieroNombre" value="<?php echo e($cliente->getValue('_financieroNombre')); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Contabilidad</label>
                            <div class="col-sm-9 col-xs-12">
                                <select class="form-control" name="tipoContabilidad" value="<?php echo e($cliente->getValue('_tipoContabilidad')); ?>" disabled>
                                    <option >No aplica</option>
                                    <option value="Interna" <?php echo e(($cliente->getValue('_tipoContabilidad')=='Interna')?'selected=selected':''); ?>>Interna</option>
                                    <option value="Externa" <?php echo e(($cliente->getValue('_tipoContabilidad')=='Externa')?'selected=selected':''); ?>>Externa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grupoCheck">
                        <div class="checkbox col-md-12"  style="padding-bottom: 10px">
                            <label class="formatoCheck col-md-5">
                                <input name="flagCambioAccionistas" class="check" id="flagCambioAccionistas" type="checkbox"
                                       <?php echo e($visita->getValue('_flagCambioAccionistas') == '1'? 'checked':''); ?>

                                >¿Cambió en accionistas? 
                            </label>
                            <div class="col-md-4 col-sm-6">
                                <input type="text" class="form-control"  name="cambioAccionistasAnnio" value="<?php echo e($cliente->getValue('_cambioAccionistasAnnio')); ?>" disabled>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-sm-3"><b>DNI</b></div>
                            <div class="col-sm-4"><b>Accionista</b></div>
                            <div class="col-sm-3"><b>Particip.</b></div>
                            <div class="col-sm-2"><b>Nac</b></div>
                        </div>
                        <?php for($i=0;$i<5;$i++): ?>
                        <div class="row">
                            <div class="form-group col-sm-3"> 
                                <input class="form-control" type="text" name="accionista[<?php echo e($i); ?>][documento]" maxlength="11" value="<?php echo e(isset($cliente->getValue('_accionistas')[$i])?$cliente->getValue('_accionistas')[$i]->getValue('_documento'):''); ?>" disabled>
                            </div>
                            <div class="form-group col-sm-4"> 
                                <input class="form-control" type="text" name="accionista[<?php echo e($i); ?>][nombre]" maxlength="50" value="<?php echo e(isset($cliente->getValue('_accionistas')[$i])?$cliente->getValue('_accionistas')[$i]->getValue('_nombre'):''); ?>" disabled>
                            </div>
                            <div class="form-group col-sm-3"> 
                                <select class="form-control" name="accionista[<?php echo e($i); ?>][participacion]" disabled>
                                    <?php $__currentLoopData = $participacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                            <?php echo e(isset($cliente->getValue('_accionistas')[$i]) && $cliente->getValue('_accionistas')[$i]->getValue('_concentracion') == $key ?'selected = "selected"':''); ?>

                                        ><?php echo e($par); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-2"> 
                                <input class="form-control" type="text" name="accionista[<?php echo e($i); ?>][nacimiento]" maxlength="4" value="<?php echo e(isset($cliente->getValue('_accionistas')[$i])?$cliente->getValue('_accionistas')[$i]->getValue('_nacimiento'):''); ?>" disabled>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!--
                        <div class="checkbox col-md-12 grupoCheck"  style="padding-bottom: 10px">
                            <label class="formatoCheck col-md-3">
                                <input name="flgLineaSucesion" id="flgLineaSucesion" type="checkbox" class="check">Línea de sucesión 
                            </label>
                            <div class="col-md-4">
                                
                                <select class="form-control" name="lineaSucesion" disabled>
                                    <option>Seleccione una opción</option>
                                    <option value="1">Linea 1</option>
                                    <option value="2">Linea 2</option>
                                    <option value="3">Linea 3</option>
                                </select>
                            </div>
                        </div> 
                    -->
                </div>
            </div>
        </div>

        <!--FINANCIAMIENTOS-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Financiamientos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-5 col-xs-12">Monto de Línea con Proveedores (Miles de PEN)</label>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" class="form-control" value="<?php echo e($cliente->getValue('_montoLineaProveedores')); ?>" name="montoLineaProveedores">
                        </div>
                    </div>

                    <div class="grupoCheck">
                        <div class="checkbox"  style="padding-bottom: 10px">
                            <label class="formatoCheck">
                                <input name="flagCambioLineas" class="check" id="flagCambioLineas" type="checkbox"
                                       <?php echo e($visita->getValue('_flagCambioLineas') == '1'? 'checked':''); ?>       
                                >¿Cambió en distribución de líneas bancarias? 
                            </label>                    
                        </div>

                        <div class="row">
                            <div class="col-sm-2"><b></b></div>
                            <div class="col-sm-2"><b>Deuda</b></div>
                            <div class="col-sm-3"><b>Líneas</b></div>
                            <div class="col-sm-2"><b>Garantías</b></div>
                            <div class="col-sm-3"><b>Tipo</b></div>
                        </div>

                        <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banco): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="form-group col-sm-2"> 
                                <label class="control-label"><?php echo e($banco); ?></label>
                            </div>
                            <div class="form-group col-sm-2"> 
                                <input type="text" class="form-control" readonly="readonly" value="<?php echo e(isset($rcc['Deuda'][$key])? number_format($rcc['Deuda'][$key]->MONTO/1000,0,'.',','):0); ?>">
                            </div>
                            <div class="form-group col-sm-3"> 
                                <input type="text" class="form-control noActualizable" name="linea[<?php echo e($key); ?>][monto]" maxlength="5" value="<?php echo e(isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_linea'):''); ?>">
                            </div>
                            <div class="form-group col-sm-2"> 
                                <input type="text" class="form-control" readonly="readonly" value="<?php echo e(isset($rcc['Garantia'][$key])? number_format($rcc['Garantia'][$key]->MONTO/1000,0,'.',','):0); ?>">
                            </div>
                            <div class="form-group col-sm-3"> 
                                <select class="form-control noActualizable" name="linea[<?php echo e($key); ?>][tipoGarantia]">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $tiposGarantia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoGarantia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tipoGarantia); ?>"
                                            <?php echo e(isset($cliente->getValue('_lineas')[$key]) && $cliente->getValue('_lineas')[$key]->getValue('_tipoGarantia') == $tipoGarantia? 'selected':''); ?>

                                        ><?php echo e($tipoGarantia); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="checkbox"  style="padding-bottom: 10px">
                            <label class="formatoCheck">
                                <input name="flgGravamen" id="flgGravamen" type="checkbox" disabled <?php echo e($cliente->getValue('_activoLibreGravamen') == 1?'checked':''); ?>>¿Cuenta con activos libre de gravamen? 
                            </label>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <!--PROYECCION-->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proyección</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group col-sm-12" >
                        <label class="control-label col-md-6 col-sm-6">Proyección de Inversiones (Miles de PEN) Año 2019</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" class="form-control" id="inputProyeccionInversion" name="proyeccionInversion" value="<?php echo e($cliente->getValue('_proyeccionInversion')); ?>">
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <div class="col-md-1 col-sm-1 <?php echo e($cliente->getValue('_proyeccionInversion')>0?'':'hidden'); ?>" id="btnInversion" style="cursor: pointer;"  >
                            <img src = "<?php echo e(URL::asset('img/click.gif')); ?>" style="width: 40px;height: 40px">
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="control-label col-md-6 col-sm-6">Proyección de Ventas (Miles de PEN) Año 2019</label>
                        <div class="col-md-4 col-sm-4">
                            <input type="text" class="form-control" name="proyeccionVentas" value="<?php echo e($cliente->getValue('_proyeccionVentas')); ?>">
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Cierre de Visita-->
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Otros</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="col-md-6 col-xs-12 col-sm-12">                    
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Fecha</label>
                            <div class="col-sm-6 col-xs-12" >
                                <input autocomplete="off" class="form-control dfecha"  type="text" name="fechaVisita" placeholder="Seleccionar fecha"
                                       value='<?php echo e(($visita->getValue('_fechaVisita'))? $visita->getValue('_fechaVisita')->format('Y-m-d'):''); ?>'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Entrevistado (Cargo)</label>
                            <div class="col-sm-6 col-xs-12">
                                <select class="form-control" name="cargoVisita" >
                                    <option value="">Seleccione un cargo</option>
                                    <?php $__currentLoopData = $cargosEntrevistado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cargo); ?>" <?php echo e($visita->getValue('_entrevistadoCargo') == $cargo?'selected':''); ?>><?php echo e($cargo); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-12 col-sm-12"> 
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Ejecutivo</label>
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" class="form-control" readonly value="<?php echo e($usuario->getValue('_rol') == App\Entity\Usuario::ROL_JEFATURA_BE? $visita->getValue('_registroNombre'):$usuario->getValue('_nombre')); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Nombre</label>
                            <div class="col-sm-6 col-xs-12">
                                <input type="text" name="nombreVisita" class="form-control" value='<?php echo e($visita->getValue('_entrevistadoNombre')); ?>'>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12"> 
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Comentario:</label>
                            <div class="input-group col-md-8 col-sm-8 col-xs-12">
                                <textarea class="form-control" rows="10" style="resize: none" placeholder="Ingresar Comentario..." name="comentarioVisita" ><?php echo e($visita->getValue('_comentarios')); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <?php if($flgPorRevisar && $usuario->getValue('_rol') == App\Entity\Usuario::ROL_JEFATURA_BE): ?>

                    <div class="col-xs-12 text-center">
                        *Al dar click en el botón se actualizarán los datos del cliente acorde a la información de la visita
                        <input type="hidden" name="flgConfirmar" value="1">
                        <input type="hidden" name="idHistorico" value="<?php echo e($cliente->getValue('_idHistorico')); ?>">
                        <input type="hidden" name="visita" value="<?php echo e($visita->getValue('_id')); ?>">
                        <br/><button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Actualizar y Confirmar</button>
                    </div>
                    <?php endif; ?>

                    <?php if(!$flgPorRevisar): ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div id="modalZonaOperaciones" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <?php $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox col-sm-3 col-xs-6" style="margin-top: 0px;">
                            <label>
                                <input type="checkbox" value="<?php echo e($zona); ?>" name="zonaOperacion[]" 
                                       <?php echo e(isset($cliente->getValue('_zonaOperaciones')[$zona])?'checked':''); ?>><?php echo e($zona); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalZonaClientes" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <?php $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox col-sm-3 col-xs-6" style="margin-top: 0px;">
                            <label>
                                <input type="checkbox" value="<?php echo e($zona); ?>" name="zonaCliente[]" 
                                       <?php echo e(isset($cliente->getValue('_zonaClientes')[$zona])?'checked':''); ?>><?php echo e($zona); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.Modal Inversión-->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalInversion">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="min-height: 240px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Seleccione tipo de Inversión</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php $__currentLoopData = $inversiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="checkbox col-sm-6 col-xs-6" style="margin-top: 0px;">
                            <label>
                                <input type="checkbox" value="<?php echo e($inv); ?>" name="inversionCliente[]" 
                                       <?php echo e(isset($cliente->getValue('_inversiones')[$inv])?'checked':''); ?>><?php echo e($inv); ?>

                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
                </div>            
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php endif; ?>
</form>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    if ($('#soloLectura').val() == '1') {
        console.log("Colocar en modo solo lectura");
        $(':input').attr('disabled', 'true');
    }

    $('#inputProyeccionInversion').on('change', function (e) {
        var valorMinimo = 0;
        if ($(this).val() > valorMinimo) {
            $('#btnInversion').removeClass('hidden');
        } else
            $('#btnInversion').addClass('hidden');
    });


    $('#btnInversion').on('click', function (e) {
        $('#modalInversion').modal();
    });

    function checkFormStatus() {

        if ($('#flagCambioMixVentas').prop("checked")) {
            $('#panelMixVentas').removeClass('hidden');
        }

        if ($('#flagCambioModelo').prop("checked")) {
            $('#panelModeloNegocio').removeClass('hidden');
        }

        if ($('#flagCambioOperaciones').prop("checked")) {
            $('#btnZonasOperaciones').removeAttr('disabled');
        }
        if ($('#flagCambioZonaClientes').prop("checked")) {
            $('#btnZonasClientes').removeAttr('disabled');
        }

        if ($('#flagCambioConcentracionVentas').prop("checked")) {
            $('.inputConcentCli').removeAttr('disabled');
        }

        if ($('#flagCambioConcentracionProveedores').prop("checked")) {
            $('.inputConcentProv').removeAttr('disabled');
        }

        console.log($('.check:checked'));
        console.log($('.check:checked').closest('.grupoCheck'));
        $('.check:checked').closest('.grupoCheck').find(':input').removeAttr('disabled');

    }

    checkFormStatus();

    if ($('input[name="flgPorRevisar"]').val() == "1") {
        $('form :input').attr("disabled", true);
    }

    $('select[name="flagCambioInversionActivoPatrimonio"]').change(function () {
        $('#lblCambioInversionActivoPatrimonio').toggleClass('hidden');
    });

    /*Checks de los flag de cambiko*/
    $('#flagCambioOperaciones').change(function () {
        $('#btnZonasOperaciones').prop('disabled', (_, val) => !val);
    });

    $('#flagCambioZonaClientes').change(function () {
        $('#btnZonasClientes').prop('disabled', (_, val) => !val);
    });

    $('#flagCambioMixVentas').change(function () {
        $('#panelMixVentas').toggleClass('hidden');
    });

    $('#flagCambioModelo').change(function () {
        $('#panelModeloNegocio').toggleClass('hidden');
    });

    $('#flagCambioConcentracionVentas').change(function () {
        if ($(this).attr('checked') != undefined) {
            $(this).removeAttr('checked');
            $('.inputConcentCli').attr('disabled', '');
        } else {
            $(this).attr('checked', true);
            $('.inputConcentCli').removeAttr('disabled');
        }
        revalidar();
    });

    $('#flagCambioConcentracionProveedores').change(function () {
        if ($(this).attr('checked') != undefined) {
            $(this).removeAttr('checked');
            $('.inputConcentProv').attr('disabled', '');
        } else {
            $(this).attr('checked', true);
            $('.inputConcentProv').removeAttr('disabled');
        }
        revalidar();
    });

    $('.check').change(function () {
        //Debo de conseguir todos los input del grupo
        var grupoCheck = $(this).closest('.grupoCheck');

        var inputSelect = grupoCheck.find('input, select, textarea');

        if ($(this).attr('checked') != undefined) {
            inputSelect.attr('disabled', '');
            $(this).removeAttr('checked');
            $(this).removeAttr('disabled');
        } else {
            $(this).attr('checked', true);
            inputSelect.removeAttr('disabled');
        }
        revalidar();
    });



    $('.dfecha').each(function () {
        $(this).on('keydown', function () {
            return false;
        });

        $(this).datepicker({
            maxViewMode: 1,
            //daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "-365d",
            endDate: "0d",
            format: "yyyy-mm-dd",
        })
                .on('changeDate', function (e) {
                    // Revalidate the date field
                    $('#frmVisita').formValidation('revalidateField', 'fechaVisita');
                });
    });

    var validatorsDocumento = {
        digits: {
            message: 'El documento debe tener solo dígitos',
        },
        stringLength: {
            min: 8,
            message: 'El documento debe tener al menos 8 dígitos',
        },
    };

    var validatorsAnnio = {
        between: {
            min: 1980,
            max: 2020,
            message: 'Año no válido (1980 - 2020)',
        },
    };

    var validatorsLineas = {
        between: {
            min: 0,
            max: 99999,
            message: 'Línea ingresada no válida (0 - 9999)',
        },
    };

    var form = $('#frmVisita').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'cargoVisita': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un cargo'
                    },
                }
            },
            'fechaVisita': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar una fecha'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida',
                    }
                }
            },
            'comentarioVisita': {
                validators: {
                    notEmpty: {
                        message: 'Ingresa un comentario'
                    },
                    stringLength: {
                        max: 500,
                        min: 30,
                        message: 'El comentario debe tener entre 30 y 500 caracteres'
                    }
                }
            },
            'nombreVisita': {
                validators: {
                    notEmpty: {
                        message: 'Debes de indicar al entrevistado'
                    },
                }
            },
            'proyeccionInversion': {
                validators: {
                    between: {
                        min: 0,
                        max: 99999,
                        message: 'Línea ingresada no válida (0 - 999999)',
                    },
                }
            },
            'proyeccionVentas': {
                validators: {
                    between: {
                        min: 0,
                        max: 99999,
                        message: 'Línea ingresada no válida (0 - 999999)',
                    },
                }
            },
            'montoLineaProveedores': {
                validators: {
                    between: {
                        min: 0,
                        max: 99999,
                        message: 'Línea ingresada no válida (0 - 999999)',
                    },
                }
            },
            'cliente[0][documento]': {
                validators: validatorsDocumento
            },
            'cliente[1][documento]': {
                validators: validatorsDocumento
            },
            'cliente[2][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[0][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[1][documento]': {
                validators: validatorsDocumento
            },
            'proveedor[2][documento]': {
                validators: validatorsDocumento
            },
            'accionista[0][documento]': {
                validators: validatorsDocumento
            },
            'accionista[1][documento]': {
                validators: validatorsDocumento
            },
            'accionista[2][documento]': {
                validators: validatorsDocumento
            },
            'accionista[3][documento]': {
                validators: validatorsDocumento
            },
            'accionista[4][documento]': {
                validators: validatorsDocumento
            },
            'cliente[0][desde]': {
                validators: validatorsAnnio
            },
            'cliente[1][desde]': {
                validators: validatorsAnnio
            },
            'cliente[2][desde]': {
                validators: validatorsAnnio
            },
            'proveedor[0][desde]': {
                validators: validatorsAnnio
            },
            'proveedor[1][desde]': {
                validators: validatorsAnnio
            },
            'proveedor[2][desde]': {
                validators: validatorsAnnio
            },
            'linea[BCP][monto]': {
                validators: validatorsLineas
            },
            'linea[BBVA][monto]': {
                validators: validatorsLineas
            },
            'linea[SCOTIA][monto]': {
                validators: validatorsLineas
            },
            'linea[BANBIF][monto]': {
                validators: validatorsLineas
            },
            'linea[PICHINCHA][monto]': {
                validators: validatorsLineas
            },
            'linea[HSBC][monto]': {
                validators: validatorsLineas
            }
        },
    }).off('success.form.fv');


    function revalidar() {

        form.formValidation('validate');

        /*
         form.formValidation('revalidateField', 'cliente[0][documento]');
         form.formValidation('revalidateField', 'cliente[1][documento]');
         form.formValidation('revalidateField', 'cliente[2][documento]');
         form.formValidation('revalidateField', 'proveedor[0][documento]');
         form.formValidation('revalidateField', 'proveedor[1][documento]');
         form.formValidation('revalidateField', 'proveedor[2][documento]');
         form.formValidation('revalidateField', 'accionista[0][documento]');
         form.formValidation('revalidateField', 'accionista[1][documento]');
         form.formValidation('revalidateField', 'accionista[2][documento]');
         form.formValidation('revalidateField', 'accionista[3][documento]');
         form.formValidation('revalidateField', 'accionista[4][documento]');
         form.formValidation('revalidateField', 'cliente[0][desde]');
         form.formValidation('revalidateField', 'cliente[1][desde]');
         form.formValidation('revalidateField', 'cliente[2][desde]');
         form.formValidation('revalidateField', 'proveedor[0][desde]');
         form.formValidation('revalidateField', 'proveedor[1][desde]');
         form.formValidation('revalidateField', 'proveedor[2][desde]');
         form.formValidation('revalidateField', 'cliente[0][monto]');
         form.formValidation('revalidateField', 'cliente[1][monto]');
         form.formValidation('revalidateField', 'cliente[2][monto]');
         form.formValidation('revalidateField', 'proveedor[0][monto]');
         form.formValidation('revalidateField', 'proveedor[1][monto]');
         form.formValidation('revalidateField', 'proveedor[2][monto]');
         */
    }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>