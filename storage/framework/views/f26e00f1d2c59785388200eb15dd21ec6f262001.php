<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(action('LoginController@attempt')); ?>" >
    <h1>Bienvenido a la WEBVPC</h1>
   
        <h2>Lo sentimos, no tienes acceso a la web</h2>
        <div class="clearfix"></div>
        <p class="change_link">Si requieres uno escríbenos a: 
            <a href="#" class="to_register"> controlgestcom@intranet.ib </a>
        </p>
 

    <div class="separator">
        

        <div class="clearfix"></div>
        <br />

        <div>
            <h4> VPC Comercial Interbank</h4>
            <p>Contacto: controlgestcom@intranet.ib</p>
        </div>
    </div>
</form> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layoutlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>