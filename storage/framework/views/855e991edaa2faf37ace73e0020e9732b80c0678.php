<?php $__env->startSection('content'); ?>
	<h1>Bienvenido</h1>
	<?php echo e($result); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>