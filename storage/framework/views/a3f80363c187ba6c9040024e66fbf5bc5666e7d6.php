<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/datatables.min.css')); ?>" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo e(URL::asset('js/datatables.min.js')); ?>"></script>

<style type="text/css">
    .formatoCheck{
        font-size: 14px;
    }

    .espaciado{
        padding-left: 15px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle','Historia de Cliente - Visita'); ?>

<form id="frmVisita" action="<?php echo e(route('infinity.me.cliente.visita.guardar')); ?>" method="POST">


    <!-- DATOS GENERALES DE LA EMPRESA -->
    <div class="row">
        <div class="col-xs-12" >
            <div class="x_panel" style="min-height: 70px">
                <div class="x_title">
                    <h2><?php echo e($cliente->getValue('_nombre')); ?> (CU: <?php echo e($cliente->getValue('_codunico')); ?>)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CHECKS -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió el modelo de negocio?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioModeloNegocio') == 1?'Sí':'No'); ?></p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió los productos o mix de ventas?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioMixVentas') == 1?'Sí':'No'); ?></p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió la concentración de proveedores de sus clientes?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioConcentracionProveedores') == 1?'Sí':'No'); ?></p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió la concentración de ventas de sus clientes?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioConcentracionClientes') == 1?'Sí':'No'); ?></p>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió la zona de operaciones?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioOperaciones') == 1?'Sí':'No'); ?></p>
                                <ul>
                                        <?php $__currentLoopData = $cliente->getValue('_zonaOperaciones'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($zonas->getValue('_zona')); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió la zona de clientes?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($visita->getValue('_flagCambioZonaClientes') == 1?'Sí':'No'); ?></p>
                                <ul>
                                        <?php $__currentLoopData = $cliente->getValue('_zonaClientes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($zonas->getValue('_zona')); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                            <?php if($cliente->getValue('_backlog') == 'Proyectos'): ?>
                            <div class="col-sm-8">
                                <label class="control-label">¿Cambió la política de compras?</label>
                            </div>
                            <div class="col-sm-4">
                                <p><?php echo e($cliente->getValue('_gestionesCompra')); ?></p>
                            </div>

                            <?php endif; ?>


                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label">¿El cliente ha realizado inversiones de por lo menos 50% del activo fijo/patrimonio que representen un desvio de fondos o signifique un cambio en su modelo de negocio?:</label>
                            </div>
                            <div class="col-sm-12">
                                <p><?php echo e($visita->getvalue('_flagCambioInversionActivoPatrimonio')==1?'Si':'No'); ?>. <?php echo e($visita->getValue('_cambioInversionActivoPatrimonio')); ?></p>
                            </div>
                            <div class="col-sm-12">
                                <label class="control-label">¿El cliente ha realizado préstamos/desvío de fondos al accionista/empresa vincladas de por lo menos el 15% del acitvo en el último ejercicio?</label>
                            </div>
                            <div class="col-sm-12">
                                <p><?php echo e($visita->getValue('_flagCambioPrestamoDesvio')==1?'Si':'No'); ?>. <?php echo e($visita->getValue('_cambioPrestamoDesvio')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CHECKS -->

    <!-- ZONA DE MIX Y MODELO DE NEGOCIO -->
    <div class="row">
        <div id="panelModeloNegocio" class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Modelo de Negocio</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <div class="form-group">
                        <label class="control-label col-xs-12">Modelo de Negocio

                        </label>
                        <div class="col-xs-12">
                            <p class="control-label"><?php echo e($cliente->getValue('_modeloNegocio')); ?></p>
                            <!--<textarea class="form-control" rows="3" name="modeloNegocio"><?php echo e($cliente->getValue('_modeloNegocio')); ?></textarea>-->
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12">Ventaja Competitiva

                        </label>
                        <div class="col-xs-12">
                            <p class="control-label"><?php echo e($cliente->getValue('_ventajaCompetitiva')); ?></p>
                            <!--<textarea class="form-control" rows="3" name="ventajaCompetitiva"><?php echo e($cliente->getValue('_ventajaCompetitiva')); ?></textarea>-->
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12">Fortalezas y Riesgos
                        </label>
                        <div class="col-xs-12">
                            <p class="control-label"><?php echo e($cliente->getValue('_fortalezasRiesgos')); ?></p>
                            <!--<textarea class="form-control" rows="3" name="fortalezasRiesgos"><?php echo e($cliente->getValue('_fortalezasRiesgos')); ?></textarea>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panelMixVentas" class="col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mix de Ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px" > 
                    <table class="table table-striped jambo_table">
                        <thead>
                            <tr>
                                <th>Producto/Servicio</th>
                                <th>Participación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cliente->getValue('_mixVentas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($producto->getValue('_productoServicio')); ?></td>
                                <td><?php echo e($participaciones[$producto->getValue('_participacion')]); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ZONA DE CLIENTES Y PROVEEDORES -->
    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>RUC</th>
                                    <th>Nombre</th>
                                    <th>Particip.</th>
                                    <th>Año </th>
                                    <th>Contrato?</th>
                                    <th>Fec. Venc. Contrato</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cliente->getValue('_clientes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($cl->getvalue('_documento')); ?></td>
                                    <td><?php echo e($cl->getvalue('_nombre')); ?></td>
                                    <td><?php echo e($participaciones[$cl->getvalue('_concentracion')]); ?></td>
                                    <td><?php echo e($cl->getvalue('_desde')); ?></td>
                                    <td><?php echo e($cl->getvalue('_flgContrato')==1?'Si':'No'); ?></td>
                                    <td><?php echo e($cl->getvalue('_contratofechaVencimiento')); ?></td>
                                    <td></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Proveedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="min-height: 150px">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>RUC</th>
                                    <th>Nombre</th>
                                    <th>Particip.</th>
                                    <th>Año</th>
                                    <th>Contrato?</th>
                                    <th>Fec. Venc. Contrato</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cliente->getValue('_proveedores'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($prov->getvalue('_documento')); ?></td>
                                    <td><?php echo e($prov->getvalue('_nombre')); ?></td>
                                    <td><?php echo e($participaciones[$prov->getvalue('_concentracion')]); ?></td>
                                    <td><?php echo e($prov->getvalue('_desde')); ?></td>
                                    <td><?php echo e($prov->getvalue('_flgContrato')==1?'Si':'No'); ?></td>
                                    <td><?php echo e($prov->getvalue('_contratofechaVencimiento')); ?></td>
                                    <td></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
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
                <div class="x_content">

                    <div class="col-sm-8">
                        <label class="control-label">¿Cambio en Gerencia General? </label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($visita->getValue('_flagCambioGerenciaGeneral') == 1?'Sí':'No'); ?> 
                            <?php echo e($cliente->getValue('_cambioGerenciaGeneralAnnio')? '('.$cliente->getValue('_cambioGerenciaGeneralAnnio').')':''); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">Gerente General</label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($cliente->getValue('_gerenteGeneral')); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label"><?php echo e($cliente->getValue('_financieroRol')); ?></label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($cliente->getValue('_financieroNombre')); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">Contabilidad</label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($cliente->getValue('_tipoContabilidad')); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">¿Cambio en Gerencia General? </label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($visita->getValue('_flagCambioAccionistas') == 1?'Sí':'No'); ?> 
                            <?php echo e($cliente->getValue('_cambioAccionistasAnnio')? '('.$cliente->getValue('_cambioAccionistasAnnio').')':''); ?></p>
                    </div>

                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableAccionistas">
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Accionista</th>
                                    <th>Particip.</th>
                                    <th>Nac</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cliente->getValue('_accionistas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($acc->getvalue('_documento')); ?></td>
                                    <td><?php echo e($acc->getvalue('_nombre')); ?></td>
                                    <td><?php echo e($acc->getvalue('_concentracion')); ?></td>
                                    <td><?php echo e($acc->getvalue('_nacimiento')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
                <div class="x_content">

                    <div class="col-sm-8">
                        <label class="control-label">Monto de Línea con Proveedores (PEN)</label>
                    </div>
                    <div class="col-sm-4">
                        <p>S/.<?php echo e($cliente->getValue('_montoLineaProveedores')? number_format($cliente->getValue('_montoLineaProveedores'),0,'.',',') : 0); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">¿Cambió en distribución de líneas bancarias?</label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($visita->getValue('_flagCambioLineas') == 1?'Sí':'No'); ?></p>
                    </div>

                    <div class="col-sm-8">
                        <label class="control-label">¿Cuenta con activos libre de gravamen?</label>
                    </div>
                    <div class="col-sm-4">
                        <p><?php echo e($visita->getValue('_activoLibreGravamen') == 1?'Sí':'No'); ?></p>
                    </div>
                    
                    <div class="clearfix"></div>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="tableClientes">
                            <thead>
                                <tr>
                                    <th>Banco</th>
                                    <th>Deuda</th>
                                    <th>Líneas</th>
                                    <th>Garantía</th>
                                    <th>Tipo Garantía</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banco): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($banco); ?></td>
                                    <td><?php echo e(isset($rcc['Deuda'][$key])? number_format($rcc['Deuda'][$key]->MONTO/1000,0,'.',','):0); ?></td>
                                    <td><?php echo e(isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_linea'):''); ?></td>
                                    <td><?php echo e(isset($rcc['Garantia'][$key])? number_format($rcc['Garantia'][$key]->MONTO/1000,0,'.',','):0); ?></td>
                                    <td><?php echo e(isset($cliente->getValue('_lineas')[$key])? $cliente->getValue('_lineas')[$key]->getValue('_tipoGarantia'):''); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
                        <label class="control-label col-md-6 col-sm-6">Proyección de Inversiones (PEN) Año 2019</label>
                        <div class="col-md-4 col-sm-4">
                            <!--<input type="text" class="form-control" name="proyeccionInversion" value="<?php echo e($cliente->getValue('_proyeccionInversion')); ?>">-->
                            <p class="control-label"><?php echo e(number_format($cliente->getValue('_proyeccionInversion'),0,'.',',')); ?></p>
                            <!--<label class="control-label col-md-6 col-sm-6"><?php echo e($cliente->getValue('_proyeccionInversion')); ?></label>-->
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="control-label col-md-6 col-sm-6">Proyección de Ventas (PEN) Año 2019</label>
                        <div class="col-md-4 col-sm-4">
                            <!--<input type="text" class="form-control" readonly="readonly" name="proyeccionVentas" value="<?php echo e($cliente->getValue('_proyeccionVentas')); ?>"> -->
                            <p class="control-label"><?php echo e(number_format($cliente->getValue('_proyeccionVentas'),0,'.',',')); ?></p>
                            <!--<label class="control-label col-md-6 col-sm-6"><?php echo e($cliente->getValue('_proyeccionVentas')); ?></label>-->
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <i class="fa fa-question-circle"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>