<?php $__env->startSection('pageTitle', 'Todos los usuarios'); ?>


<?php $__env->startSection('content'); ?>
<div>
    <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#add_usu">Agregar Usuario</i></a>
</div>

<div>
    <div class="x_panel">
        <div class="x_content">
        	<table class="table table-striped jambo_table">
        		<thead>
        			<tr>
        				<th style="vertical-align:middle;text-align: left;">NOMBRE</th>
        				<th style="vertical-align:middle;text-align: left;">REGISTRO</th>
        				<th style="vertical-align:middle;text-align: left;">ROL</th>
        				<th style="vertical-align:middle;text-align: left;">
                            AREA/<br>
                            CARGO
                        </th>
        				<th style="vertical-align:middle;text-align: left;">BANCA</th>
        				<th style="vertical-align:middle;text-align: left;">Acciones</th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        				<tr>
        					<td><?php echo e($usuarios->NOMBRE); ?></td>
        					<td class="id_regis"><?php echo e($usuarios->REGISTRO); ?></td>
        					<td><?php echo e($usuarios->nombrerol); ?></td>
        					<td>
                                <?php echo e($usuarios->AREA); ?><br>
                                <?php echo e($usuarios->CARGO); ?>

                            </td>
        					<td><?php echo e($usuarios->BANCA); ?></td>
        					<td style="vertical-align:middle;text-align: center;">
        						<a class="btn btn-primary ediusu btn-xs" href="javascript:void(0);" data-toggle="modal" data-target="#detalle_usu"><i class="fa fa-pencil" aria-hidden="true"> </i></a>
        						<?php if($usuarios->FLAG_ACTIVO == 1): ?>
        							<a class="btn btn-danger delete btn-xs"><i class="fa fa-minus" aria-hidden="true"> </i></a>
        						<?php elseif($usuarios->FLAG_ACTIVO == 0): ?>
        							<a class="btn btn-info activar btn-xs"><i class="fa fa-plus" aria-hidden="true"> </i></a>
        						<?php endif; ?>
        					</td>
        				</tr>
        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        		</tbody>
        	</table>
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
     $(document).on('click','.ediusu', function() {
        var registro = $(this).closest('tr').find('.id_regis').html();
        $.ajax({
                type: "POST",
                data: 'registro='+registro,
                url: APP_URL + 'addusuario/get-usuario',
                dataType: 'json',
                beforeSend: function() {
                },
                success: function (json) {
                    //console.log((json) ? json : 'nada');
                    if (json) {
                        $("#nombre_j_i").val(json.NOMBRE);
                        $("#registro_i").val(json.REGISTRO);
                        $("#dni_i").val(json.DNI);
                        $("#passwordusu_i").val(json.PASS);
                        $("#cargo_i").val(json.CARGO);
                        $("#rol_i").val(json.nombrerol);
                        $("#area_i").val(json.AREA);
                        $("#centro_i").val(json.ID_CENTRO);
                        $("#banca_i").val(json.BANCA);
                        $("#zona_i").val(json.ID_ZONA);
                        $("#tienda_i").val(json.ID_TIENDA);
                    }
                },
                complete:function() {
                }
        });
     });

     $(document).on('click','.delete',function() {
     	var registro = $(this).closest('tr').find('.id_regis').html();
     	$.ajax({
     			type: "POST",
                data: 'registro='+registro,
                url: APP_URL + 'addusuario/delete-usuario',
                dataType: 'json',
                beforeSend: function() {
                },
                success: function (json) {
                    console.log((json) ? json : 'nada');
                    location.reload();
                },
                complete:function() {
                }
        });
     });

     $(document).on('click','.activar',function() {
     	var registro = $(this).closest('tr').find('.id_regis').html();
     	$.ajax({
     			type: "POST",
                data: 'registro='+registro,
                url: APP_URL + 'addusuario/activar-usuario',
                dataType: 'json',
                beforeSend: function() {
                },
                success: function (json) {
                    console.log((json) ? json : 'nada');
                    location.reload();
                },
                complete:function() {
                }
        });
     });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('detalle_usuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('modal_addusuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>