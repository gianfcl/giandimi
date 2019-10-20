<?php $__env->startSection('content'); ?>

<form method="post" action="<?php echo e(route('pass.attempt')); ?>" >
    <h1>Ingreso VPCONNECT</h1>
    <div class="form-group">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input class="form-control" placeholder="Registro de Usuario" type="text" name="registro">
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Password" required="" type="password" name="passw">
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Ingresar</button>
    </div>
</form> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layoutlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>