<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(action('LoginController@demoAttempt')); ?>" >
    <h1>Bienvenido a la WEBVPC</h1>
    <div class="form-group">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <select name="usuario" class="form-control">

            <option value="B13017">EN Lima Centro</option>
            <option value="B14859">EN SJ Lurigancho</option>
            <option value="B12946">EN Mendiola</option>
            <option value="B28740">EN Gamarra</option>
            <option value="B29597">EN Santa Anita</option>
            <option value="B14114">EN Omega</option>

            <option value="B31069">EN El Tambo</option>
            <option value="B18301">EN Trujillo</option>
            <option value="B27646">EN Arequipa</option>
            <option value="B20560">EN Tacna</option>

            
            <option value="B14812">Asistente Comercial 1</option>
            <option value="B22414">Asistente Comercial 2</option>

            <option value="XT7823">Jefe Call Center</option>
            <option value="XT7856">Ejecutivo Call 1</option>
            <option value="XT7797">Ejecutivo Call 2</option>


            <option value="B18066">Jefe Comercial Gamarra</option>
            <option value="B19478">Jefe Comercial Los Olivos</option>
            <option value="B15970">Jefe Comercial Trujillo</option>

            <option value="B14261">Jefe Zonal Lima Norte</option>
            <option value="B14530">Jefe Zonal Prov. Norte</option>

            <option value="B15316">Soporte 1</option>
            <option value="B24316">Soporte 2</option>

            
            <option value="B11315">Administrador</option>


        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit">Ingresar</button>
    </div>

    <div class="clearfix"></div>

    <div class="separator">
        <p class="change_link">¿No tienes acceso?
            <a href="#" class="to_register"> Solicitar Acceso </a>
        </p>

        <div class="clearfix"></div>
        <br />

        <div>
            <h4> VPC Comercial Interbank</h4>
            <p>Contacto: soportevpc@interbank.com.pe / Anexo: 2354</p>
        </div>
    </div>
</form> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layoutlogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>