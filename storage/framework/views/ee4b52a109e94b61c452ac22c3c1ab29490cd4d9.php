<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(URL::asset('css/datatables.min.css')); ?>" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/datatables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/chart.bundle.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/utils.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/numeral.min.js')); ?>"></script>

<!--FORM VALIDATION-->
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('pageTitle'); ?>
<?php echo e($cliente->NOMBRE); ?> <i class="fa fa-circle fa-sm" style ="color: <?php echo e(\App\Entity\Infinity\Semaforo::getColor($cliente->NIVEL_ALERTA)); ?>"></i>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
    .celda-centrada{
        vertical-align: middle; 
        text-align: center;
    }

    .tr-empty{
        background-color: #f9f9f9;
    }

</style>

<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="min-height: 280px">
            <div class="x_title">
                <h2>Cliente</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left input_mask">
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-xs-12">CU</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->COD_UNICO); ?>" readonly="readonly" id="codUnico">
                        </div>
                        <a href="<?php echo e(route('infinity.me.cliente.conoceme')); ?>?cu=<?php echo e($cliente->COD_UNICO); ?>" style="text-decoration: underline;font-weight: bold">Conóceme</a>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-xs-12">Ejecutivo</label>
                        <div class="col-sm-10 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->EJECUTIVO); ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-xs-12">Deuda RCC</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="S/. <?php echo e(number_format($cliente->SALDO_RCC,0,'.',',')); ?>" readonly="readonly">
                        </div>
                        <label class="control-label col-sm-2 col-xs-12">SOW</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e(number_format($cliente->SOW,0,'.',',')); ?>%" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-xs-12">Vencido</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="S/. <?php echo e(number_format($cliente->SALDO_VENCIDO_RCC,0,'.',',')); ?>" readonly="readonly">
                        </div>
                        <label class="control-label col-sm-2 col-xs-12">Rating</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->RATING); ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-xs-12">Clasificación</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->CLASIFICACION); ?>" readonly="readonly">
                        </div>
                        <label class="control-label col-sm-2 col-xs-12">FEVE</label>
                        <div class="col-sm-4 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FEVE); ?>" readonly="readonly">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="min-height: 280px">
            <div class="x_title">
                <h2>Status</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form class="form-horizontal form-label-left input_mask">

                    <div class="form-group" style="padding-bottom: 15px">
                        <label class="control-label col-sm-2 col-xs-12">EEFF 1</label>
                        <div class="col-sm-3 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FECHA_ULTIMO_EEFF_1); ?>" readonly="readonly"> 
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_DDJJ, $cliente->FECHA_ULTIMO_EEFF_1);
                            ?>                                        
                        </div>
                        <label class="control-label col-sm-2 col-xs-12">EEFF 2</label>
                        <div class="col-sm-3 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FECHA_ULTIMO_EEFF_2); ?>" readonly="readonly">
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_EEFF, $cliente->FECHA_ULTIMO_EEFF_2);
                            ?> 
                        </div>
                    </div>

                    <div class="form-group" style="padding-bottom: 15px">
                        <label class="control-label col-sm-2 col-xs-12">Última Visita</label>
                        <div class="col-sm-3 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FECHA_ULTIMA_VISITA); ?>" readonly="readonly"> 
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_VISITA, $cliente->FECHA_ULTIMA_VISITA);
                            ?> 
                        </div>
                        <a href="<?php echo e(route('infinity.me.cliente.visita')); ?>?cu=<?php echo e($cliente->COD_UNICO); ?>" style="text-decoration: underline;font-weight: bold">Agregar Visita</a>
                    </div>
                    <div class="form-group" style="padding-bottom: 15px">
                        <label class="control-label col-sm-2 col-xs-12">IBR</label>
                        <div class="col-sm-3 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FECHA_ULTIMO_IBR); ?>" readonly="readonly"> 
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_IBR, $cliente->FECHA_ULTIMO_IBR);
                            ?> 
                        </div>
                        <label class="control-label col-sm-2 col-xs-12">F02</label>
                        <div class="col-sm-3 col-xs-12">
                            <input class="form-control" type="text" value="<?php echo e($cliente->FECHA_ULTIMO_F02); ?>" readonly="readonly"> 
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_F02, $cliente->FECHA_ULTIMO_F02);
                            ?> 
                        </div>
                    </div>   
                </form>
                <center><button class="btn btn-primary" id="btnDocumentacion">Gestión de Documentación</button></center>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="min-height: 380px">
            <div class="x_title">
                <h2>Evolución</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <center>
                    <div class="chart-container" style="width: 70%">
                        <canvas id="graficoEvolucion"></canvas>
                    </div>                                              
                </center>            
            </div>
        </div>
        <div class="x_panel" style="min-height: 230px">
            <div class="x_title">
                <h2>Recálculo</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form id="frmRecalculo" class="form-horizontal form-label-left" enctype="multipart/form-data" action="<?php echo e(route('infinity.me.detalle.guardar.recalculo')); ?>" method="POST">
                    <input name="codUnico" type="text" value="<?php echo e($cliente->COD_UNICO); ?>" hidden="">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">MDL </label>
                            <div class="input-group col-md-9 col-sm-9 col-xs-12" >              
                                <input autocomplete="off" class="form-control"  type="text" id="mdlRecalculo" name="mdlRecalculo" placeholder="Monto (USD)" 
                                       value="<?php echo e($recalculo!=null?$recalculo->MDL:''); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha </label>
                            <div class="input-group col-md-9 col-sm-9 col-xs-12" >               
                                <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar" for="fechaRecalculo"></i></div>
                                <input autocomplete="off" class="form-control dfecha"  type="text" id="fechaRecalculo" name="fechaRecalculo" placeholder="Seleccionar fecha"
                                       value="<?php echo e($recalculo!=null?$recalculo->FECHA_RECALCULO:''); ?>" 
                                       >
                            </div>
                        </div>          

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Adjunto </label>
                            <div class="input-group col-md-9 col-sm-9 col-xs-12">
                                <input type="file" name="adjuntoRecalculo" id ="adjuntoRecalculo" class="form-control image" style="border-style: none">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <center>
                            <?php
                            echo \App\Entity\Infinity\AlertaDocumentacion::getIcono(\App\Entity\Infinity\AlertaDocumentacion::ID_RECALCULO, $cliente->FECHA_ULTIMO_RECALCULO);
                            ?> 
                            <p style="font-size: 16px;">Recálculo</p>
                            <?php if($recalculo!=null): ?>
                            <a href="<?php echo e(route('download', ['file' => str_replace('/','|',\App\Entity\Infinity\ConocemeDocumentacion::RUTA_MDL.$recalculo->ADJUNTO)])); ?>" ><i class="fa fa-download fa-2x" ></i>
                            </a><br><br>
                            <?php endif; ?>
                            <button class="btn btn-success" type="submit">Recálculo</button>
                        </center>
                    </div>
                </form>         
            </div>
        </div>

        <div class="x_panel" style="min-height: 170px">
            <div class="x_title">
                <h2>Grupo Económico</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                    <?php if($grupoEconomico!=NULL): ?>
                        <?php if($grupoEconomico['FLG_AUTONOMIA']): ?>
                            <p><i class="fas fa-check-circle fa-2x" style="color:#26B99A"></i> Sí cumple la Autonomía Comercial</p>
                        <?php else: ?>
                            <p><i class="fas fa-exclamation-circle fa-2x" style="color:#D9534F"></i> No cumple la Autonomía Comercial</p> 
                        <?php endif; ?>
                      <center>
                          <button class="btn btn-success" type="button" id="btnGrupoEconomico">Ver Detalles</button>
                      </center>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="x_panel" style="min-height: 800px">
            <div class="x_title">
                <h2>Políticas y Variables</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <form class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Periodo: </label>
                            <div class="input-group col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="cboMesExplicacion" id="cboMesExplicacion">
                                    <?php $__currentLoopData = $meses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mes['PERIODO']); ?>"><?php echo e($mes['MES']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                

                <div class="row" style="padding-bottom: 30px">
                    <div class="col-md-12">
                        <table class="table table-striped jambo_table tableHistorico" id="tablePoliticas">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Política</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($politicas) > 0): ?>
                                <?php $__currentLoopData = $politicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $politica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="tr-<?php echo e($politica->PERIODO); ?> <?php echo e($politica->PERIODO == config('app.periodoInfinity')? '':'hidden'); ?>">
                                    <td><?php echo e($politica->TIPO); ?></td>
                                    <td><?php echo e($politica->NOMBRE); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr class="tr-empty"><td colspan="2">El cliente no tiene políticas aplicadas</td><tr>
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row" style="padding-bottom: 30px">
                    <div class="col-md-12">
                        <table class="table table-striped jambo_table tableHistorico" id="tableVariables">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Variable</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($variables) > 0): ?>
                                    <?php $__currentLoopData = $variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $var; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="tr-<?php echo e($j); ?> <?php echo e($j == config('app.periodoInfinity')? '':'hidden'); ?>">
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e(implode(',',array_unique($v))); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr class="tr-empty"><td colspan="2">El cliente no tiene variables a revisar</td><tr>
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--
                <div class="row">  
                    <div class="col-md-12"  style="padding-left: 20px" style="width: 70%">
                        <table id="tableSalidas" class="table table-striped jambo_table tableHistorico">
                            <thead>
                                <tr>
                                    <th style="font-size:14px ;">¿Salida de Líneas Automáticas?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($salidas) > 0): ?>
                                <?php $__currentLoopData = $salidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="tr-<?php echo e($salida->PERIODO); ?> <?php echo e($salida->PERIODO == 201810? '':'hidden'); ?>">
                                    <td style="font-size:14px ;text-decoration: underline;"><?php echo e($salida->MOTIVO_SALIDA); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr class="tr-empty"><td colspan="2">El cliente se mantuvo en Líneas Automáticas</td><tr>
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                -->
                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <div class="x_panel" style="min-height: 500px">
            <div class="x_title">
                <h2>Gestiones y Observaciones</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="max-height: 380px; <?php echo (count($gestiones) > 0 ? 'overflow-y: scroll' : ''); ?>;">

                <table class="table table-striped table-bordered jambo_table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Comentario</th>
                            <th>Adjunto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($gestiones)>0): ?>
                        <?php $__currentLoopData = $gestiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="">
                            <td style="width: 10%;padding-bottom: 30px"><?php echo e($gestion->NOMBRE); ?><br><?php echo e($gestion->CARGO); ?></td>
                            <td style="width: 5%;padding-bottom: 30px"><?php echo e($gestion->FECHA_GESTION); ?></td> 
                            <td style="width: 20%;padding-bottom: 30px;text-align: justify;"><?php echo e($gestion->COMENTARIO); ?></td>
                            <td style="width: 5%;padding-bottom: 30px;padding-left: 30px;text-align: center;">
                                <?php if($gestion->ADJUNTO): ?>
                                <a href="<?php echo e(route('download', ['file' => str_replace('/','|',\App\Entity\Infinity\Gestion::RUTA.$gestion->ADJUNTO)])); ?>"
                                   ><i class="fa fa-download fa-2x" ></i>
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                        <?php else: ?>
                        <tr style=""><td colspan="4">No se encontraton gestiones para el cliente</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="col-sm-5">
        <div class="x_panel" style="min-height: 500px">
            <div class="x_title">
                <h2>Nueva Observación</h2>
                <ul class="nav navbar-right panel_toolbox">                
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="frmGestion" class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo e(route('infinity.me.detalle.guardar.gestion')); ?>">

                    <input name="codUnico" type="text" value="<?php echo e($cliente->COD_UNICO); ?>" hidden="">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="estadoGestion">
                                <option value="">Seleccionar Estado</option>
                                <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estado->ID_ESTADO_GESTION); ?>"><?php echo e($estado->NOMBRE_ESTADO); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Gestión:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12" >               
                            <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar" for="fechaGestion"></i></div>
                            <input autocomplete="off" class="form-control dfecha"  type="text" id="fechaGestion" name="fechaGestion" placeholder="Seleccionar fecha" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="10" style="resize: none" placeholder="Ingresar Comentario..." name="comentarioGestion" ></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Adjunto:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <input type="file" name="adjuntoGestion" id = "adjuntoGestion" class="form-control image" style="border-style: none">
                        </div>
                    </div>
                    <center><button class="btn btn-success" type="submit">Guardar</button></center>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <div class="x_panel" style="min-height: 500px">
            <div class="x_title">
                <h2>Historia del Cliente</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <table class="table table-striped table-bordered jambo_table" id="tblHistoricoCliente">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /.Modal Documentación-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalDocumentacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gestión de Documentación</h4>
            </div>
            <div class="modal-body">
                <form id="frmDocumentacion" class="form-horizontal form-label-left" enctype="multipart/form-data" action="<?php echo e(route('infinity.me.detalle.guardar.documentacion')); ?>" method="POST">

                    <input name="codUnico" type="text" value="<?php echo e($cliente->COD_UNICO); ?>" hidden="">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Documento:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="tipoDocumento" id="cboTipoDocumento">
                                <option value="">Seleccionar Tipo</option>
                                <!--DEFINIR-->
                                <option value="1">DDJJ</option>
                                <option value="2">EEFF</option>
                                <option value="3">IBR</option>
                                <option value="4">F02</option>                            
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="fechaFirmaOcultar" hidden>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Firma Documento:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12" >               
                            <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar" for="fechaFirma"></i></div>
                            <input autocomplete="off" class="form-control dfecha"  type="text" id="fechaFirma" name="fechaFirma" placeholder="Seleccionar fecha" value="">
                        </div>
                    </div>          

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Adjunto:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <input type="file" name="adjuntoDocumento" id ="adjuntoDocumento" class="form-control image" style="border-style: none">
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-success" type="submit">Agregar</button>
                    </center>
                </form>

                <div id="tablaDocumentacion" style="overflow-y: scroll;max-height: 500px" >
                    <table class="table table-striped jambo_table">
                        <thead>                                    
                            <tr class="headings">
                                <th>Documento</th>
                                <th>Fecha Firma</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(count($documentos)>0): ?>
                            <?php $__currentLoopData = $documentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $documento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($documento->NOMBRE_DOCUMENTO); ?></td>
                                <td><?php echo e($documento->FECHA_FIRMA); ?></td>                       
                                <td><a href="<?php echo e(route('download', ['file' => str_replace('/','|',\App\Entity\Infinity\ConocemeDocumentacion::RUTA_DOCS.$documento->ADJUNTO)])); ?>">
                                        <i class="fa fa-download"></i></a></td>
                            </tr>    
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                            <?php else: ?>
                            <tr><td colspan="3">No se encontraron resultados</td></tr>
                            <?php endif; ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- /.Modal Grupo Económico-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalGrupoEconomico">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Grupo Económico</h4>
            </div>
            <div class="modal-body" style="min-height: 420px;max-height: 420px">
                <?php if($grupoEconomico!=NULL): ?>
                <div class="col-sm-12" id="infoResumen" style="padding-bottom:20px">
                    <label style="text-decoration: underline;">Resumen</label><br>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_CLASIFICACION']);
                        ?> Clasificación
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_VENCIDO']);
                        ?> Vencido
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_FEVE']);
                        ?> FEVE DURO
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_REFINANCIADO']);
                        ?> Refinanciado
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_REESTRUCTURADO']);
                        ?> Reestructurado
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_JUDICIAL']);
                        ?> Judicial
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <?php
                            echo \App\Entity\Flag::getIconoFlag($grupoEconomico['FLG_COBRANZA']);
                        ?> Cobranza
                    </div>                    
                </div>

                <div class="col-sm-12">
                        <?php if(count($grupoEconomico['RELACIONADOS'])>0): ?>
                            <label style="text-decoration: underline;">Relacionados</label><br>
                            <div id="infoRelacionados" style="overflow-y: scroll;max-height: 250px" >
                            <?php $__currentLoopData = $grupoEconomico['RELACIONADOS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relacionado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-12" style="padding-bottom:20px">
                                <label style="text-decoration: underline;"><?php echo e($relacionado->NOMBRE_REL); ?></label><br>
                                <div class="col-sm-4 col-xs-12">
                                    <?php
                                        echo \App\Entity\Flag::getIconoFlag($relacionado->FLG_CLASIFICACION);
                                    ?> Clasificación
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Vencido: S/. <?php echo e(number_format($relacionado->MONTO_VENCIDO,0,'.',',')); ?>

                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <?php
                                        echo \App\Entity\Flag::getIconoFlag($relacionado->FLG_FEVE);
                                    ?> FEVE DURO
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Refinanciado: S/. <?php echo e(number_format($relacionado->MONTO_REFINANCIADO,0,'.',',')); ?>

                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Reestructurado: S/. <?php echo e(number_format($relacionado->MONTO_REESTRUCTURADO,0,'.',',')); ?>

                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Judicial: S/. <?php echo e(number_format($relacionado->MONTO_JUDICIAL,0,'.',',')); ?>

                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Coactiva: S/. <?php echo e(number_format($relacionado->MONTO_COACTIVA,0,'.',',')); ?>

                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    Laboral: S/. <?php echo e(number_format($relacionado->MONTO_LABORAL,0,'.',',')); ?>

                                </div>    
                            </div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>

$(document).ready(function () {
    generarGrafico($('#codUnico').val());

    /*Combobox Mes de explicación, cambia las filas a mostrar*/
    $('#cboMesExplicacion').change(function () {

        $('.tableHistorico tbody >tr')
                .find('.tr-empty').remove().end()
                .addClass('hidden').end()
                .find('.tr-' + $(this).val()).removeClass('hidden');

        if ($('#tableSalidas tbody>tr').not('.hidden').length == 0) {
            $('#tableSalidas tbody').append('<tr class="tr-empty"><td colspan="2">El cliente se mantuvo en Líneas Automáticas</td><tr>')
        }

        if ($('#tablePoliticas tbody>tr').not('.hidden').length == 0) {
            $('#tablePoliticas tbody').append('<tr class="tr-empty"><td colspan="2">El cliente no tiene políticas aplicadas</td><tr>')
        }
        
        if ($('#tableVariables tbody>tr').not('.hidden').length == 0) {
            $('#tableVariables tbody').append('<tr class="tr-empty"><td colspan="2">No existen variables para mostrar</td><tr>')
        }
    })

    //La fecha no se registra para documentos DDJJ y EEFF
    $('#cboTipoDocumento').change(function () {
        console.log($(this).val());
        if ($(this).val() <= 2)
            $('#fechaFirmaOcultar').attr('hidden', 'true');
        else
            $('#fechaFirmaOcultar').removeAttr('hidden');
    })

    $('#btnDocumentacion').on("click", function () {
        $('#frmDocumentacion').trigger("reset");
        $('#frmDocumentacion').formValidation('destroy', true);
        initializeFormDocumentacion();
        $('#modalDocumentacion').modal();
    })

    $('#btnGrupoEconomico').on("click", function () {
        $('#modalGrupoEconomico').modal();
    })

    $("[data-toggle=popover]").each(function (i, obj) {
        $(this).popover({
            html: true,
            content: function () {
                html = '<b>Rating:</b> ' + $(this).attr('data-rating');
                html += '<br><b>Mora:</b> ' + $(this).attr('data-mora');
                return html;
            }
        });
    });

    $('.dfecha').each(function () {
        $(this).datepicker({
            maxViewMode: 1,
            //daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "-365d",
            endDate: "0d",
            format: "yyyy-mm-dd",
        })
                .on('changeDate', function (e) {
                    // Revalidate the date field
                    $('#frmGestion').formValidation('revalidateField', 'fechaGestion');
                    $('#frmDocumentacion').formValidation('revalidateField', 'fechaFirma');
                    $('#frmRecalculo').formValidation('revalidateField', 'fechaRecalculo');
                });
    });

    $('#frmGestion').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'estadoGestion': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un estado'
                    },
                }
            },
            'fechaGestion': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar una fecha'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida',
                    }
                }
            },
            'comentarioGestion': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un estado'
                    },
                    stringLength: {
                        max: 500,
                        min: 30,
                        message: 'El comentario debe tener entre 30 y 500 caracteres'
                    }
                }
            },
        },
    })
            .off('success.form.fv');

    $('#frmRecalculo').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'mdlRecalculo': {
                validators: {
                    notEmpty: {
                        message: 'Debes llenar el monto del MDL'
                    },
                    numeric: {
                        message: 'El MDL debe ser un monto numérico',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: '.'
                    }
                }
            },
            'fechaRecalculo': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar una fecha'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida',
                    }
                }
            },
            'adjuntoRecalculo': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un archivo'
                    },
                }
            },
        },
    })
            .off('success.form.fv');

});

function initializeFormDocumentacion() {

    $('#frmDocumentacion').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'tipoDocumento': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un tipo'
                    },
                }
            },
            'fechaFirma': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar una fecha'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida',
                    }
                }
            },
            'adjuntoDocumento': {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un archivo'
                    },
                }
            },
        },
    })
            .off('success.form.fv');
}

function generarGrafico(cu) {

    $.ajax({
        type: "GET",
        data: {
            cu: cu,
        },
        async: false,
        url: APP_URL + 'infinity/me/cliente/detalle/grafico',
        success: function (result) {
            //console.log(result);
            var periodos = [];
            var nivelInverso = [];
            var nivel = [];
            var colores = [];

            for (var i = 0; i < result.length; i++) {
                periodos.push(result[i]['PERIODO']);              


                switch (result[i]['NIVEL_ALERTA']) {
                    case '1':
                        nivelInverso.push(4);
                        break;
                    case '2':
                        nivelInverso.push(3);
                        break;
                    case '3':
                        nivelInverso.push(2);
                        break;                    
                    case '99':
                        nivelInverso.push(1);
                        break;
                    default:
                        nivelInverso.push(0);
                        break;
                }

                switch (result[i]['NIVEL_ALERTA']) {
                    case '1':
                        colores.push('green');
                        break;
                    case '2':
                        colores.push('#fc3');
                        break;
                    case '3':
                        colores.push('red');
                        break;                    
                    case '99':
                        colores.push('#000000');
                        break;
                    default:
                        colores.push('gray');
                        break;
                }

            }
            console.log(nivel);
            console.log(nivelInverso);
            var config = {
                type: 'line',
                data: {
                    labels: periodos,
                    datasets: [{
                            label: 'Evolución Infinity',
                            //backgroundColor: window.chartColors.blue,
                            borderColor: 'gray',
                            data: nivelInverso,
                            fill: false,
                            borderDash: [5],
                            pointRadius: 15,
                            pointHoverRadius: 10,
                            pointBackgroundColor: colores
                        }, ]
                },
                options: {
                    responsive: true,
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: 'Month'
                                }
                            }],
                        yAxes: [{
                                display: false,
                                ticks: {
                                    //beginAtZero:true,
                                    suggestedMax: 4.5,
                                    suggestedMin: 0.5
                                }
                            }]
                    },
                    tooltips: {
                        callbacks: {
                            title: function (tooltipItem, data) {
                                console.log(result[tooltipItem[0]['index']]);
                                return 'LA: ' + ((result[tooltipItem[0]['index']]['FLG_INFINITY'] == 1) ? 'Sí' : 'No');
                            },
                            label: function (tooltipItem, data) {
                                i = 0;

                                nivelInverso = [];
                                while (periodos[i] != tooltipItem['xLabel'])
                                    i++;

                                nivelInverso.push('Rating: ' + result[i]['RATING']);
                                nivelInverso.push('Deuda IBK: S/.' + numeral(result[i]['SALDO_INTERBANK']).format('0,0'));
                                nivelInverso.push('Deuda RCC: S/.' + numeral(result[i]['SALDO_RCC']).format('0,0'));
                                nivelInverso.push('Días Atraso: ' + result[i]['MAX_DIAS_ATRASO']);
                                return nivelInverso;
                            },

                        },
                        backgroundColor: '#FFF',
                        titleFontSize: 16,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        bodyFontSize: 14,
                        displayColors: false
                    }
                }
            };

            window.onload = function () {
                var ctx = document.getElementById('graficoEvolucion').getContext('2d');
                window.myLine = new Chart(ctx, config);

            };


        }
    });
}

$('#tblHistoricoCliente').DataTable({
    processing: true,
    serverSide: true,
    language: {"url": "<?php echo e(URL::asset('js/Json/Spanish.json')); ?>"},
    ajax: {
        url: '<?php echo e(route('infinity.me.cliente.historia')); ?>',
        data: {
            "cliente": $('#codUnico').val()
        }
    },
    order: [[2, "desc"]],
        
    columnDefs: [
        {
            targets: 3,
            data: null,
            render: function (data, type, row) {
                var url = '';
                if(row.TIPO === 'VISITA'){
                    url = "<?php echo e(route('infinity.me.visita.historia')); ?>" + "?id=" + row.ID;
                }else{
                    url = "<?php echo e(route('infinity.me.conoceme.historia')); ?>" + "?id=" + row.ID;
                }
                return '<a href="'+ url +'">Ver</a>';
            }
        },
    ],
    columns: [
        {data: 'TIPO', name: 'WICON.TIPO'},
        {data: 'USUARIO', name: 'WU.NOMBRE'},
        {data: 'FECHA_ACTUALIZACION', name: 'WICON.FECHA_ACTUALIZACION', searchable: false},
        {data: 'TIPO', name: 'WICON.TIPO', searchable: false},
    ]
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>