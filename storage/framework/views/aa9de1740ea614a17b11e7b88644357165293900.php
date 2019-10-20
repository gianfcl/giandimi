<?php $__env->startSection('pageTitle', 'Usuarios'); ?>


<?php $__env->startSection('content'); ?>
<div>
    <a class="btn btn-primary adu" href="javascript:void(0);" data-toggle="modal" data-target="#add_usu">Agregar Usuario</i></a>
</div>

<div>
    <div class="x_panel">
        <div class="x_content">
        	<table class="table table-striped jambo_table" id="tblUsuarios">
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
<link href="<?php echo e(URL::asset('css/datatables.min.css')); ?>" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="<?php echo e(URL::asset('js/datatables.min.js')); ?>"></script>

<script>
     $(document).on('click','.ediusu', function() {
        var registro = $(this).closest('tr').find('.id_regis').html();
        $.ajax({
                type: "POST",
                data: 'registro='+registro,
                url: APP_URL + 'addusuario/addusuario/get-usuario',
                dataType: 'json',
                beforeSend: function() {
                },
                success: function (result) {
                    console.log(result);
                    if (result) {
                        $("#nombre_j_i").val(result.NOMBRE);
                        $("#registro_i").val(result.REGISTRO);
                        $("#dni_i").val(result.DNI);
                        $("#passwordusu_i").val(result.PASS);
                        $("#cargo_i").val(result.CARGO);
                        $("#rol_i_d").html(result.nombrerol);
                        $("#area_i").val(result.AREA);
                        $("#banca_i_d").html(result.BANCA);
                        $("#banca_i").val(result.BANCA);
                        if (result.BANCA !=null) {
                            if (result.BANCA.length>0) {
                                    banca = $("#banca_i").val();$("#zona_i").html("");$("#centro_i").html("");$("#tienda_i").html("");
                                    if (banca=="BPE") {
                                        $("#lacenje_i").html("Centro");
                                    }else{
                                        $("#lacenje_i").html("Jefatura");
                                    }
                                    $.ajax({
                                        type: "POST",
                                        data: 'banca='+banca,
                                        url: APP_URL + 'addusuario/addusuario/comboZonas',
                                        dataType: 'json',
                                        beforeSend: function() {
                                        },
                                        success: function (json) {
                                            if (banca=="BPE") {
                                                if (json.length>0) {
                                                  $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                    $("#zona_i").append($("<option></option>")
                                                        .attr("value", value.ID_ZONA).text(value.ZONA));
                                                  });
                                                }else{
                                                    $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                                                }
                                            }else{
                                                if (json.length>0) {
                                                  $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                    $("#zona_i").append($("<option></option>")
                                                        .attr("value", value.ID_ZONAL).text(value.ZONAL));
                                                  });
                                                }else{
                                                    $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                                                }
                                            }
                                        },
                                        complete:function() {
                                            if (result.ID_ZONA != null) {
                                                if (result.ID_ZONA.length>0) {
                                                    $("#zona_i").val(result.ID_ZONA);
                                                }
                                            }
                                        }
                                    });

                                    $.ajax({
                                        type: "POST",
                                        data: 'banca='+banca,
                                        url: APP_URL + 'addusuario/addusuario/comboRoles',
                                        dataType: 'json',
                                        beforeSend: function() {
                                        },
                                        success: function (json) {
                                            //20-31
                                            if (banca=="BE" || banca=="BC") {
                                                if (json.length>0) {
                                                  $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                      $("#rol_i").append($("<option></option>")
                                                          .attr("value", value.ID_ROL).text(value.NOMBRE));
                                                  });
                                                }else{
                                                    $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                                                }
                                            }else{
                                              //1-10
                                                if (json.length>0) {
                                                  $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                      $("#rol_i").append($("<option></option>")
                                                          .attr("value", value.ID_ROL).text(value.NOMBRE));
                                                  });
                                                }else{
                                                    $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                                                }
                                            }
                                        },
                                        complete:function() {
                                            if (result.ID_ROL != null) {
                                                if (result.ID_ROL.length>0) {
                                                    $("#rol_i").val(result.ID_ROL);
                                                }
                                            }
                                        }
                                    });
                            }
                        }
                        
                        $("#zona_i_d").html(result.ID_ZONA);
                        if (result.ID_ZONA != null) {
                            if (result.ID_ZONA.length>0) {
                                    id_zonal=$("#zona_i_d").html();$("#centro_i").html("");$("#tienda_i").html("");
                                    banca = $("#banca_i").val();
                                    if (banca=="BE" || banca=="BC") {
                                        $.ajax({
                                          type: "POST",
                                          data: 'id_zonal='+id_zonal,
                                          url: APP_URL + 'addusuario/addusuario/comboJefaturas',
                                          dataType: 'json',
                                          beforeSend: function() {
                                          },
                                          success: function (json) {
                                              if (json.length>0) {
                                                  $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                    $("#centro_i").append($("<option></option>")
                                                        .attr("value", value.ID_JEFATURA).text(value.JEFATURA));
                                                  });
                                              }else{
                                                  $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                                              }
                                          },
                                          complete:function() {
                                            if (result.ID_CENTRO != null) {
                                                if (result.ID_CENTRO.length>0) {
                                                    $("#centro_i").val(result.ID_CENTRO);
                                                }
                                            }
                                          }
                                        });
                                    }else{
                                      $.ajax({
                                        type: "POST",
                                        data: 'id_zonal='+id_zonal,
                                        url: APP_URL + 'addusuario/addusuario/comboCentros',
                                        dataType: 'json',
                                        beforeSend: function() {
                                        },
                                        success: function (json) {
                                            if (json.length>0) {
                                                $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                                                  $.each(json, function (key, value) {
                                                    $("#centro_i").append($("<option></option>")
                                                        .attr("value", value.ID_CENTRO).text(value.CENTRO));
                                                  });
                                            }else{
                                                $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                                            }
                                        },
                                        complete:function() {
                                            if (result.ID_CENTRO != null) {
                                                if (result.ID_CENTRO.length>0) {
                                                    $("#centro_i").val(result.ID_CENTRO);
                                                }
                                            }
                                        }
                                      });
                                    }
                            }
                        }
                        $("#centro_i_d").html(result.ID_CENTRO);
                        $("#tienda_i_d").html(result.ID_TIENDA);
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
                url: APP_URL + 'addusuario/addusuario/delete-usuario',
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
                url: APP_URL + 'addusuario/addusuario/activar-usuario',
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


$(document).ready( function () {
    $('#tblUsuarios').DataTable({
        language: {"url": APP_URL + "dataTables.spanish.lang"},
    });
} );
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('addusuario.detalle_usuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('addusuario.modal_addusuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>