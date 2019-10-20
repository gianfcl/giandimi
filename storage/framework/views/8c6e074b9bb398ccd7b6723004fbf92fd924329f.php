<?php $__env->startSection('js-libs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Leads'); ?>

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
        <form action="<?php echo e(route('bpe.campanha.asistente.leads.listar')); ?>" class="form-horizontal">
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="" class="control-label col-md-4">Documento:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo e($busqueda['documento']); ?>" name="documento" id="txtDocumento">
                    </div>
                </div>

                <div class="form-group col-md-4 col-md-offset-4">
                    <label for="" class="control-label col-md-4">Ejecutivo:</label>
                    <div class="col-md-8">
                        <select class="form-control" name="ejecutivo" id="cboEjecutivo">
                            <option value="">---Todos----</option>
                            <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ejecutivo->REGISTRO); ?>" <?php echo e(($busqueda['ejecutivo'] == $ejecutivo->REGISTRO) ? 'selected="selected"' : ''); ?> ><?php echo e($ejecutivo->NOMBRE); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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

                
            </div>
            
            <div class="form-group">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      <h2>Lista</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th></th>
                    <th>Ejecutivo</th>
                    <th style="width: 20%">Cliente</th>
                    <th style="width: 35%">Dirección</th>
                    <th style="width: 10%">Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    <th>Detalle</th>

                </tr>
            </thead>
            <tbody>
                <?php if(count($leads)>0): ?>
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                    </td>
                    <td>
                        <?php if($lead->MARCA_ASISTENTE_COMERCIAL == '1'): ?>
                        <span class="glyphicon glyphicon-tag" aria-hidden="true" style="color: #2A3F54;"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                       <?php echo e($lead->EN_NOMBRE); ?>

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
                    <?php $cpns = explode('|',$lead->CAM_EST_NOMBRE) ?>
                    <?php $__currentLoopData = $cpns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($cpn); ?><br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <?php $gestiones = $lead->GESTION? explode('|',$lead->GESTION): [];?>
                    <?php if(count($gestiones) == 0): ?>
                    <label>-</label>
                    <?php endif; ?>

                    <?php $__currentLoopData = $gestiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo empty($gest)? '-':$gest; ?><br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <?php if(empty($lead->FECHA_CITA)): ?>
                        <label>-</label>
                        <?php else: ?>
                        <?php 
                            $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA);
                        ?>
                        <span class="glyphicon glyphicon-calendar"></span> <span><?php echo e($fecha->format("j M")); ?></span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span><?php echo e($fecha->format("H:i")); ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(count($gestiones) == 0 and empty($lead->FECHA_CITA)): ?>
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.asistente.cita.nuevo')); ?>?lead=<?php echo e($lead->NUM_DOC); ?>">Agendar Cita / Gestionar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
                <td colspan="4">No se encontraron resultados</td>
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
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input').val("");
            $(this).closest('form').find('select').val("");
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>