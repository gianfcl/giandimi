<?php $__env->startSection('pageTitle', 'Call'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Llamadas en los ultimos 5 dias</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Ejecutivo Call</th>
                            <th style="text-align: center;"> <?php echo e(Carbon\Carbon::parse($fechas[0]->_4)->format('d-m-Y')); ?> </th>
                            <th style="text-align: center;"> <?php echo e(Carbon\Carbon::parse($fechas[0]->_3)->format('d-m-Y')); ?> </th>
                            <th style="text-align: center;"> <?php echo e(Carbon\Carbon::parse($fechas[0]->_2)->format('d-m-Y')); ?> </th>
                            <th style="text-align: center;"> <?php echo e(Carbon\Carbon::parse($fechas[0]->_1)->format('d-m-Y')); ?> </th>
                            <th style="text-align: center;"> <?php echo e(Carbon\Carbon::parse($fechas[0]->HOY)->format('d-m-Y')); ?> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $statsCall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($stat->NOMBRE); ?> <br> <?php echo e($stat->REGISTRO_EN_AGENDADOR); ?></td>
                                <td style="text-align: center;"><?php echo e($stat->_4); ?></td>
                                <td style="text-align: center;"><?php echo e($stat->_3); ?></td>
                                <td style="text-align: center;"><?php echo e($stat->_2); ?></td>
                                <td style="text-align: center;"><?php echo e($stat->_1); ?></td>
                                <td style="text-align: center;"><?php echo e($stat->HOY); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                            
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Citas</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th class="col-md-1">Fecha de Registro</th>
                            <th class="col-md-2">Call Agendador</th>
                            <th class="col-md-2">Ejecutivo Agendado</th>
                            <th class="">Zonal/Tienda</th>
                            <th class="col-md-1">Fecha de Cita</th>
                            <th class="col-md-2">Informacion Lead</th>
                            <th class="col-md-1">Telefono</th>
                            <th class="col-md-3">Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($listaCitas)>0): ?>
                        <?php $__currentLoopData = $listaCitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(Carbon\Carbon::parse($cita->FECHA_REGISTRO)->format('d-m-Y')); ?></td>
                            <td> <?php echo e($cita->NOMBRE_AG); ?> <br> <?php echo e($cita->REGISTRO_EN_AGENDADOR); ?> </td>
                            <td> <?php echo e($cita->NOMBRE_EN); ?> <br> <?php echo e($cita->REGISTRO_EN); ?> </td>
                            <td><?php echo e($cita->TIENDA); ?> <br> <?php echo e($cita->ZONA); ?></td>
                            <td> <?php echo e(Carbon\Carbon::parse($cita->FECHA_CITA)->format('d-m-Y h:i')); ?></td>
                            <td> <?php echo e($cita->NUM_DOC); ?> <br> <?php echo e($cita->PERSONA_CONTACTO); ?> </td>
                            <td> <?php echo e($cita->TELEFONO_CONTACTO); ?> </td>
                            <td> <?php echo e($cita->DIRECCION_CONTACTO); ?> <br> <?php echo e($cita->REFERENCIA); ?> </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($listaCitas->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>