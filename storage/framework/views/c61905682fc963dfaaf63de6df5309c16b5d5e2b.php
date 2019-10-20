<?php $__env->startSection('encabezado'); ?>
<p class="textoPersonalizado"><?php echo e($ejecutivo); ?> ha ingresado una visita para el cliente <?php echo e($cliente); ?> (CU: <?php echo e($cu); ?>)
    la cual se encuentra pendiente de confirmación.</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('detalles'); ?>
<p class="textoPersonalizado">Puedes revisar los datos de la visita y confirmarla desde este <a class="textoPersonalizado" href="<?php echo e($url); ?>" style="text-decoration: underline">enlace</a> </p>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('emails.infinity.mailLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>