<?php $__env->startSection('encabezado'); ?>
<p class="textoPersonalizado"><?php echo e($jefe); ?> ha confirmado la visita realizada al cliente <?php echo e($cliente); ?> (CU: <?php echo e($cu); ?>).</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('detalles'); ?>
<p class="textoPersonalizado">Puedes revisar los datos de la ficha conóceme desde este <a class="textoPersonalizado" href="<?php echo e($url); ?>" style="text-decoration: underline">enlace</a> </p>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('emails.infinity.mailLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>