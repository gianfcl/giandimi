<?php $__env->startSection('pageTitle', 'Resumen de Citas'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Filtros</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal" method="GET">
                        <?php if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Zonal:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboZonal" name="zonal" class="form-control">
                                    <option value="">---Todos---</option>
                                    <?php $__currentLoopData = $zonales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($zonal->ID_ZONA == $busqueda['zonal']): ?>
                                            <option value="<?php echo e($zonal->ID_ZONA); ?>" selected><?php echo e($zonal->ZONA); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($zonal->ID_ZONA); ?>"><?php echo e($zonal->ZONA); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA])): ?>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Centro:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboCentro" name="centro" class="form-control">
                                    <option value="">---Todos---</option>
                                    <?php $__currentLoopData = $centros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($centro->ID_CENTRO == $busqueda['centro']): ?>
                                            <option value="<?php echo e($centro->ID_CENTRO); ?>" selected><?php echo e($centro->CENTRO); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($centro->ID_CENTRO); ?>"><?php echo e($centro->CENTRO); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO])): ?>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label for="" class="control-label col-xs-3 col-sm-3 col-md-2">Tienda:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <select id="cboTienda" name="tienda" class="form-control">
                                    <option value="">---Todos---</option>
                                    <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($tienda->ID_TIENDA == $busqueda['tienda']): ?>
                                            <option value="<?php echo e($tienda->ID_TIENDA); ?>" selected><?php echo e($tienda->TIENDA); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($tienda->ID_TIENDA); ?>"><?php echo e($tienda->TIENDA); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                        <span id="req_fechaIni" style="display: none;"><?php echo e($busqueda['fechaIni']); ?></span>
                        <span id="req_fechaFin" style="display: none;"><?php echo e($busqueda['fechaFin']); ?></span>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <label class="control-label col-xs-3 col-md-2" for="">Fechas:</label>
                            <div class="col-xs-9 col-sm-9 col-md-10">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" value="" name="fechaIni" id="dp_fechaIni">
                                    <div class="input-group-addon">al</div>
                                    <input type="text" class="form-control" value="" name="fechaFin" id="dp_fechaFin">    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1" style="text-align: center;">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(count($ejecutivos) > 0): ?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Resumen</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                $programadas = 0;
                $vencidas = 0;
                $realizadas = 0;
                $total = 0;
                if(count($ejecutivos)>0) {
                    foreach ($ejecutivos as $ejecutivo) {
                        $programadas = $programadas + $ejecutivo->PROGRAMADAS;
                        $vencidas = $vencidas + $ejecutivo->VENCIDAS;
                        $realizadas = $realizadas + $ejecutivo->REALIZADAS;
                        $total = $total + $ejecutivo->TOTAL;
                    }
                }
                ?>
                <div class="col-md-3">
                    <span style=" font-size: 24px;"><?php echo e($total); ?> Citas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;"><?php echo e($realizadas); ?> Realizadas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;"><?php echo e($programadas); ?> Programadas</span>
                </div>
                <div class="col-md-3">
                    <span style=" font-size: 24px;"><?php echo e($vencidas); ?> Vencidas</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ejecutivos</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>            
            <div class="x_content">
                <?php if(count($ejecutivos)>0): ?>
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th class="col-md-3">Ejecutivo</th>
                            <?php if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                            <th class="col-md-1">Zonal</th>
                            <?php endif; ?>
                            <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA])): ?>
                            <th class="col-md-1">Centro</th>
                            <?php endif; ?>
                            <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO])): ?>
                            <th class="col-md-1">Tienda</th>
                            <?php endif; ?>
                            <th class="col-md-1">Citas Pendientes</th>
                            <th class="col-md-1">Citas Vencidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($ejecutivos)>0): ?>
                            <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->NOMBRE); ?> <br/> <?php echo e($ejecutivo->REGISTRO); ?>                                      
                                    </td>
                                    <?php if(Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->ZONA); ?>                                   
                                    </td>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA])): ?>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->CENTRO); ?>                                   
                                    </td>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO])): ?>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->TIENDA); ?>                                   
                                    </td>
                                    <?php endif; ?>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->PROGRAMADAS); ?>                                   
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($ejecutivo->VENCIDAS); ?>                                   
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($ejecutivos->appends(['zonal' => $busqueda['zonal'], 'centro' => $busqueda['centro'], 'tienda' => $busqueda['tienda'], 'fechaIni' => $busqueda['fechaIni'], 'fechaFin' => $busqueda['fechaFin']])->links()); ?>

                <?php else: ?>
                <span>No hay citas</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/webvpc/bpe-campanha-herramientas-resumen-citas.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>