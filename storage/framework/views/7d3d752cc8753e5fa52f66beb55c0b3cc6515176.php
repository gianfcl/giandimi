<?php $__env->startSection('pageTitle', 'Usuario Agregado'); ?>


<?php $__env->startSection('content'); ?>

<div>
    <a href="<?php echo e(route('add.usuario')); ?>" class="btn btn-success">Volver</a>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form>
                    <?php $__currentLoopData = $infoinsert; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Nombre</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->NOMBRE); ?>" type="text" name="nombre_j" id="nombre_j">
                            </div> 
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>Registro</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->REGISTRO); ?>" type="text" name="registro" id="registro">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>DNI</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->DNI); ?>" type="text" name="dni" id="dni">
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>Contraseña</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->PASS); ?>" type="password" name="passwordusu" id="passwordusu">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>Cargo</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->CARGO); ?>" type="text" name="cargo" id="cargo">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>Rol</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->nombrerol); ?>" type="text" name="rol" id="rol">
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>Area</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->AREA); ?>" type="text" name="area" id="area">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>CENTRO</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->ID_CENTRO); ?>" type="text" name="centro" id="centro">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>BANCA</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->BANCA); ?>" type="text" name="banca" id="banca">
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>ZONA</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->ID_ZONA); ?>" type="text" name="zona" id="zona">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label>TIENDA</label>
                                <input class="form-control" disabled="" value="<?php echo e($info->TIENDA); ?>" type="text" name="tienda" id="tienda">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>