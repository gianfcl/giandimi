<?php $__env->startSection('js-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pageTitle', 'Productos'); ?>
<table class="table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($producto->NOMBRE); ?></td>
                <td><?php echo e($producto->DESCRIPCION); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js-scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.Plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>