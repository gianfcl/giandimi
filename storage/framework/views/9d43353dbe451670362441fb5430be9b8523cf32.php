<?php if(count($actividades)>0): ?>                            
<?php $__currentLoopData = $actividades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="<?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>
    <?php echo e('CAMBIO'); ?>

    <?php else: ?>
    <?php echo e($actividad->TIPO); ?>

    <?php endif; ?>">
    <div class="cbp_tmicon"> <?php
        switch ($actividad->TIPO) {
            case 'VISITA' :
                $tipoIcono = 'fa-home';
                break;
            case 'LLAMADA' :
                $tipoIcono = 'fa-phone';
                break;
            case 'CORREO':
                $tipoIcono = 'fa-envelope';
                break;
            CASE 'CAMBIO DE ESTADO' :
                $tipoIcono = 'fa-exchange';
                break;
        }
        ?>
        <i class="fa <?php echo e($tipoIcono); ?>"></i></div>
    <div class="cbp_tmlabel" style="
        <?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>        <?php echo e('background-color: #FCE16D'); ?>         <?php else: ?>         <?php echo e('background-color: #F5F7FA'); ?>         <?php endif; ?>;">
        <div  class="col-md-12 col-sm-12 col-xs-12" >
            <div class="col-md-4 col-sm-4 col-xs-12" style="border-right: 3px solid #FFFFFF;">                                                    
                <h5 style="color:#46a4da ;"><strong> <?php echo e($actividad->TITULO); ?></strong></h5>
                <label style="margin-top: 5px;"><?php echo e(Jenssegers\Date\Date::parse($actividad->FECHA_ACTIVIDAD)->format('j \d\e F \d\e Y')); ?></label><br>                                                    
                <div class="row top" style="margin-top: 10px;">         
                    <div class="col-md-6">
                        <ul class="fa-ul">

                            <?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>
                                <li><i class="fa-li fa fa-user"></i><?php echo e($actividad->NOMBRE); ?></li>
                            <?php endif; ?>

                            <?php $__currentLoopData = $actividad->P_IBK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pibk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($pibk!=''): ?>
                                    <li><i class="fa-li fa fa-user"></i><?php echo e($pibk); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div  class="col-md-6">
                        <ul class="fa-ul">
                            <?php $pclientes = $actividad->P_CLIENTES ?>
                            <?php if(count($pclientes)>0): ?>                                                               
                            <?php $__currentLoopData = $pclientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($pcliente!=''): ?>
                            <li><i class="fa-li fa fa-user"></i><?php echo e($pcliente); ?></li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>	
            <?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>
                <div  class="col-md-4 col-sm-4 col-xs-12">
                    <p  style="margin: 0px;" ><?php echo e($actividad->TEMAS_COMERCIALES); ?></p>
                    <p style="margin: 0px;"><?php echo e($actividad->TEMAS_CREDITICIOS); ?></p>
                </div>
            <?php else: ?>
            <div  class="col-md-4 col-sm-4 col-xs-12">
                <h4>Temas Comerciales</h4>
                <p  style="margin: 0px;" ><?php echo e($actividad->TEMAS_COMERCIALES); ?></p>

            </div>
            <div  class="col-md-4 col-sm-4 col-xs-12">
                <h4>Temas Crediticios</h4>
                <p style="margin: 0px;"><?php echo e($actividad->TEMAS_CREDITICIOS); ?></p>
            </div>
            <?php endif; ?>											
        </div>
    </div>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($actividades->currentPage() < $actividades->lastPage()): ?>
        <div align="center"><button class="btn btn-primary masActividades" pagina="<?php echo e(($actividades->currentPage() + 1)); ?>" type="button">
            <i class="fa fa-spinner fa-spin fa-fw hidden"></i> Más Actividades</button>
        </div>
    <?php else: ?>
        <div align='center' style='margin-bottom: 5px;'>
            <h2 id='notFound'>No se encontraron más resultados</h2>
        </div>    
    <?php endif; ?>
<?php else: ?>
<div align='center' style='margin-bottom: 5px;'>
    <h2 id='notFound'>No se encontraron más resultados</h2>
</div>
<?php endif; ?>
