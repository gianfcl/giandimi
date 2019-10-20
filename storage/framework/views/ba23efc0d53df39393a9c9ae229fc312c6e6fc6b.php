<?php $__env->startSection('pageTitle', 'Bienvenido'); ?>



<?php $__env->startSection('content'); ?>

    <style> 
        .textoLogin {
           color: black;
           font-size: 16px;            
        }
    </style>

<form method="post" action="<?php echo e(route('login.attempt')); ?>" >
    <img src = "<?php echo e(URL::asset('img/vpconnect.png')); ?>" style="width: 100%" />
    <div class="form-group">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input class="form-control textoLogin" placeholder="Registro de Usuario" type="text" name="usuario">
    </div>
    <div class="form-group">
        <input class="form-control textoLogin" placeholder="Password" required="" type="password" name="password">
    </div>
    <div class="form-group">
        <button class="btn btn-default textoLogin" type="submit" style="font-weight: bold">Ingresar</button>
    </div>

    <div class="clearfix"></div>
    <div class="separator">
        <div>
            <h4 class="textoLogin"> VP Comercial Interbank</h4>
            <p class="textoLogin">Contacto BPE: controlgestcom@intranet.ib</p>
            <p class="textoLogin">Contacto BE: gestioncomercial@intercorp.com.pe</p>
        </div>
    </div>


</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layoutlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>