<?php $__env->startSection('pageTitle', 'Agregar Jefatura'); ?>


<?php $__env->startSection('content'); ?>
<!--Editado-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="" method="POST" id="frmAddjefatu" class="frmAddjefatAñadir
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre</label>
                            <input class="form-control" placeholder="nombre_j" required="" type="text" name="nombre_j" id="nombre_j">
                        </div> 
                    </div>                 
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>ID_JEFATURA</label>
                            <input class="form-control" placeholder="idjefatura" required="" type="text" name="idjefatura" id="idjefatura">
                        </div>
                    </div>
                   
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>ID_ZONAL</label>
                            <input class="form-control" placeholder="zonal" required="" type="text" name="zonal" id="zonal">
                        </div>
                    </div>

                    <br><br><br><br>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <button class="btn btn-primary" type="submit">Añadir</button>
                    </div>
                    <div class="clearfix"></div>

                </form> 
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>