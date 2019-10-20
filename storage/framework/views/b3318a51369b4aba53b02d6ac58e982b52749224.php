<?php $__env->startSection('pageTitle', 'Agregar Nuevo Usuario'); ?>


<?php $__env->startSection('content'); ?>
<div>
    <a href="<?php echo e(route('add.usuario')); ?>" class="btn btn-success">Volver</a>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="<?php echo e(route('addusuario.lista.index')); ?>" id="frmAddusuario" class="frmAddusuario">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Nombre</label>
                            <input class="form-control" placeholder="Nombre Usuario" required="" type="text" name="nombre_j" id="nombre_j">
                        </div> 
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Registro</label>
                            <input class="form-control" placeholder="Registro" required="" type="text" name="registro" id="registro">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>DNI</label>
                            <input class="form-control" placeholder="DNI" type="text" name="dni" id="dni">
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Contraseña</label>
                            <input class="form-control" placeholder="Contraseña" required="" type="password" name="passwordusu" id="passwordusu">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Cargo</label>
                            <input class="form-control" placeholder="Cargo" required="" type="text" name="cargo" id="cargo">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Area</label>
                            <input class="form-control" placeholder="Area" required="" type="text" name="area" id="area">
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Banca</label>
                            <select class="form-control" placeholder="Banca" required="" type="text" name="banca" id="banca">
                                <option disabled selected="true">Seleccionar Banca</option>
                                <option value="BE">Banca Empresa</option>
                                <option value="BPE">Banca Pequeña Empresa</option>
                                <option value="BC">Banca Corporativa</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>ZONA</label>
                            <select class="form-control" placeholder="Zona" required="" type="text" name="zona" id="zona">
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label id="lacenje">CENTRO/JEFATURA</label>
                            <select class="form-control" placeholder="Centro" value="" type="text" name="centro" id="centro">
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>TIENDA</label>
                            <select class="form-control" placeholder="Tienda" required="" type="text" name="tienda" id="tienda">
                            	<option disabled selected="true">Todos</option>
                            	<?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            	<option value="<?php echo e($tienda->ID_TIENDA); ?>"><?php echo e($tienda->TIENDA); ?></option>
                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Rol</label>
                            <select class="form-control" placeholder="Rol" required="" type="text" name="rol" id="rol">
                                <option disabled selected="true">Seleccionar Rol</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rol->ID_ROL); ?>"><?php echo e($rol->NOMBRE); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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

<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 


<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script>
    $(document).on('change','#banca',function() {
        banca = $(this).val();$("#zona").html("");console.log(banca);
        if (banca=="BPE") {
            $("#lacenje").html("Centro");
        }else{
            $("#lacenje").html("Jefatura");
        }
        $.ajax({
            type: "POST",
            data: 'banca='+banca,
            url: APP_URL + 'addusuario/comboZonas',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (banca=="BPE") {
                    if (json.length>0) {
                    $("#zona").html("<option value='' disabled selected='true'>Seleccionar uno</option>");
                    $.each(json, function (key, value) {
                            $("#zona").append($("<option></option>")
                                .attr("value", value.ID_ZONA).text(value.ZONA));
                        });
                    }else{
                        $("#zona").html("<option value='' disabled selected='true'>No existe uno</option>");
                    }
                }else{
                    if (json.length>0) {
                    $("#zona").html("<option value='' disabled selected='true'>Seleccionar uno</option>");
                    $.each(json, function (key, value) {
                            $("#zona").append($("<option></option>")
                                .attr("value", value.ID_ZONAL).text(value.ZONAL));
                        });
                    }else{
                        $("#zona").html("<option value='' disabled selected='true'>No existe uno</option>");
                    }
                }
            },
            complete:function() {
            }
        });
    })

    $(document).on('change','#zona',function () {
        id_zonal=$(this).val();
        $.ajax({
            type: "POST",
            data: 'id_zonal='+id_zonal,
            url: APP_URL + 'addusuario/comboCentros',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (json.length>0) {
                    $("#centro").html("<option value='' disabled selected='true'>Seleccionar uno</option>");
                    $.each(json, function (key, value) {
                        $("#centro").append($("<option></option>")
                            .attr("value", value.ID_JEFATURA).text(value.JEFATURA));
                    });
                }else{
                    $("#centro").html("<option value='' disabled selected='true'>No existe uno</option>");
                }
            },
            complete:function() {
            }
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>