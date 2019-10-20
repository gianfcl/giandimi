<?php $__env->startSection('js-libs'); ?>
    <link href="<?php echo e(URL::asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Leads'); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Resumen
        <?php if(count($leads)>0): ?>
            <small><?php echo e($leads[0]->EN_NOMBRE); ?></small>
        <?php endif; ?>
        </h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="col-md-3">
                <?php if($busqueda['campanha'] == ''): ?>
                    <span>Todas las campañas</span>
                <?php else: ?>
                    <span>Campaña: 
                    <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(($campanha->ID_CAMP_EST == $busqueda['campanha'])? $campanha->NOMBRE:''); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($resumen->GESTIONES * 100/$resumen->TOTAL); ?>%; min-width: 2em;">
                        <?php echo e(number_format($resumen->GESTIONES * 100/$resumen->TOTAL,0)); ?>%
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <?php echo e($resumen->GESTIONES); ?> de <?php echo e($resumen->TOTAL); ?> gestionados
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h4 style="margin-top: 0px;">
            <?php if($resumen->CITAS_PENDIENTES == 0): ?>
                <span class="label label-default">No tienes citas pendientes</span>
            <?php else: ?>
                <span class="label label-success">Tiene <?php echo e($resumen->CITAS_PENDIENTES); ?> cita(s) pendiente(s)</span>
            <?php endif; ?>
            <?php if($resumen->CITAS_VENCIDAS > 0): ?>
                <span class="label label-danger">Tiene <?php echo e($resumen->CITAS_VENCIDAS); ?> cita(s) vencidas(s)</span>
            <?php endif; ?>
            </h4>
            
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align: right;">
        </div>
    </div>
</div>
</div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Búsqueda</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="" class="form-horizontal" method="GET">
            <input class="form-control" type="hidden" value="<?php echo e($busqueda['ejecutivo']); ?>" name="ejecutivo" >
            <div class="row">
            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">DNI/RUC:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" value="<?php echo e($busqueda['documento']); ?>" name="documento" id="txtDocumento">
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Campaña:</label>
                <div class="col-md-8">
                    <select id="cboCampanha" name="campanha" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($campanha->ID_CAMP_EST); ?>" <?php echo e(($campanha->ID_CAMP_EST == $busqueda['campanha'])? 'selected="selected"':''); ?>>
                            <?php echo e($campanha->NOMBRE); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Nombre:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" value="<?php echo e($busqueda['lead']); ?>" name="lead" id="txtLead">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="" class="control-label col-md-4">Distrito:</label>
                <div class="col-md-8">
                    <select id="cboDistrito" name="distrito" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $distritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($distrito->DISTRITO); ?>" <?php echo e(($distrito->DISTRITO === $busqueda['distrito'])? 'selected="selected"':''); ?>>
                            <?php echo e($distrito->DISTRITO); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<?php $hoy = Jenssegers\Date\Date::now(); ?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
            <h2>Lista</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.imprimir', array_merge($busqueda,isset($orden)? $orden:[]))); ?>" target="_blank" class="collapse-link"><i class="fa fa-print"></i> Imprimir</a></li>
            </ul>
            <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th style="width: 20%">
                        <?php if(isset($orden) && $orden['sort'] == 'lead'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'lead','order' =>'desc']))); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda)); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'lead','order' =>'asc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Cliente</th>
                    <th style="width: 35%">
                        <?php if(isset($orden) && $orden['sort'] == 'direccion'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'direccion','order' =>'desc']))); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda)); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'direccion','order' =>'asc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Dirección</th>
                    <th style="width: 10%">
                        <?php if(isset($orden) && $orden['sort'] == 'deuda'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'desc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'deuda','order' =>'asc']))); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', $busqueda)); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle', array_merge($busqueda,['sort' => 'deuda','order' =>'desc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php if(count($leads)>0): ?>
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="vertical-align: middle;">
                        <?php if($lead->PROPENSION >= 0.80): ?>
                            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 30px; color: #1ABB9C;"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($lead->TIPO_DOCUMENTO); ?>: <?php echo e($lead->NUM_DOC); ?>

                        <br/><?php echo e($lead->NOMBRE_CLIENTE); ?>

                        <?php if(empty($lead->FECHA_CITA)): ?>
                        <br/><?php echo e($lead->REPRESENTANTE_LEGAL); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($lead->DISTRITO); ?><br/>
                        <?php echo e($lead->DIRECCION); ?>

                    </td>
                    <td>
                        <?php echo e($lead->DEUDA_SSFF_MONEDA); ?> <?php echo e(number_format($lead->DEUDA_SSFF,0,'.',',')); ?> <br/>
                        <?php if($lead->VARIACION_DEUDA_6M_SSFF > 0): ?>
                            (<?php echo e(number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-up" style="color: #449D44"></span> )<br/>
                        <?php else: ?>
                            (<?php echo e(number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-down" style="color: #CB2431"></span> )<br/>
                        <?php endif; ?>
                        <?php echo e($lead->BANCO_PRINCIPAL_SSFF); ?><br/>
                    </td>
                    <td>
                        <?php $cpns = array_filter(explode('|',$lead->CAM_EST_ABREV)) ;
                        ?>
                        <?php $__currentLoopData = $cpns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($cpn); ?><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $gestiones = array_filter(explode('|',$lead->GESTION));?>

                        <?php $__currentLoopData = $cpns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(!isset($gestiones[$key])? '-':ucwords(mb_strtolower($gestiones[$key], 'UTF-8'))); ?><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php if(empty($lead->FECHA_CITA)): ?>
                        <label>-</label>
                        <?php else: ?>
                        <?php 
                            $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA);
                        ?>
                        <span style="<?php echo e((in_array($lead->CITA_ESTADO,[1,2,3])&& $fecha->lt($hoy))  ? 'color:#DB242C':''); ?>">
                        <span class="glyphicon glyphicon-calendar"></span> <span><?php echo e($fecha->format("j M")); ?></span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span><?php echo e($fecha->format("H:i")); ?></span>
                        </span>
                        <?php endif; ?>
                    </td>
                    </td>
                    <td style="vertical-align: middle; text-align: center;">
                        
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <tr>
                    <td colspan="8">No se encontraron resultados</td>
                </tr><?php endif; ?>
            </tbody>
        </table>
        <?php echo e($leads->appends($busqueda)->links()); ?>

    </div>
</div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
    $(document).ready(function() {

        // Limpieza de formulario
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input[type="text"]').val("");
            $(this).closest('form').find('select').val("");
        });

        
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>