<?php $__env->startSection('pageTitle', 'Reasignación de Leads'); ?>

<?php $__env->startSection('content'); ?>

<div class="x_panel" id="asignar">
    <div class="x_title">
        <h2>Reasignar a</h2>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <form class="form-horizontal">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                    <label class="control-label">Reg. Ejecutivo:</label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                    <input type="text" id="busqueda_en" class="form-control typeahead" placeholder="Ejem: B34300, BP0026, etc">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                    <button id="btnCancelar" type="button" class="btn btn-default hidden">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form method="POST" action="<?php echo e(route('bpe.campanha.gerente.reasignar.reasignar')); ?>">
    <div class="x_panel">
        <div class="x_title">
            <h2>Lista de leads a Asignar</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="busqueda_leads">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                            <label class="control-label">RUC/DNI:</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                            <input id="num_doc" type="text" class="form-control" placeholder="Ejem: 3598874115">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                            <button id="agregar" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ln_solid"></div>

            <div class="row">
                <table id="tablaLeads" class="table">
                    <thead>
                        <tr>
                            <th class="">#</th>
                            <th class="">Cliente</th>
                            <th class="">Ejecutivo</th>
                            <th class="">Ubicacion</th>
                            <th class="">Cita</th>
                            <th class="">Canal</th>
                            <th class="">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tablaLeadsBody">
                        <tr>
                            <td colspan="7" style="text-align: center">No hay leads agregados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="rsgn_btn_div">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                    <input type="hidden" name="en" value="" id="txtEjecutivo"> 
                    <button id="btnAsignar" type="submit" class="btn btn-success rsgn_btn" disabled="disabled"><i class="glyphicon glyphicon-random"></i> Reasignar</button>
                </div>        
        </div>
    </div>
</form>

<!-- Plantilla para fila de tabla de leads -->
<div id="templateRowLead" class="hidden">
    <table>
        <tr>
            <td>
                <span class="lblNumero"></span>
            </td>

            <td>
                <span class="lblTipoDocumento"></span>: <span class="lblDocumento"></span><br/>
                <span class="lblLead">
            </td>                
            <td>
                <div class="divAreaEjecutivo hidden">
                    Registro: <span class="lblRegistro"></span><br/>
                    <span class="lblEjecutivo"></span>
                </div>
                <div class="divAreaSinEjecutivo hidden">
                    <span>LIBRE</span>
                </div>
            </td>
            <td>
                <div class="divAreaTienda hidden">
                    Tienda:<span class="lblTienda"></span><br/>
                    Zona:<span class="lblZona"></span>    
                </div>
                <div class="divAreaSinTienda hidden">
                    <span>LIBRE</span>
                </div>
            </td>
            <td>
                <span class="lblFecha hidden"></span>
                <span class="lblHora hidden"></span>
                <span class="lblSinCitas hidden">Sin Citas Programadas</span>
                <div class="divAreaConflictoCita hidden">
                    <button class="btn btn-sm btn-danger btnReparar"> Reparar Conflicto</button>
                </div>
                <input class="txtCita" type="hidden" name="cita[]">
                <input class="txtFecha" type="hidden" name="fecha[]">
                <input class="txtHora" type="hidden" name="hora[]">
            </td>
            <td>
                <span class="lblCanal"></span>
            </td>
            <td class="rowAccion">
                <input type="hidden" name="lead[]">
                <button class="btn btn-sm btn-danger btnQuitar">Quitar</button>
            </td>
        </tr>
    </table>
</div>

<!-- MODAL REPARAR CITA -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalReprogramacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar Fecha Cita</h4>
            </div>
            <form id="frmReprogramarCita" class="form-horizontal form-label-left" action="" method="POST">
                <input type="hidden" name="lead" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="" >Fecha</label>
                            <input type="text" class="form-control" name="fecha" onkeydown="return false">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Hora</label>
                            <select class="form-control" name="hora">
                                <?php $__currentLoopData = $horasDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hora): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"><?php echo e($hora); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cambiar Fecha</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>

<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>

<script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/webvpc/bpe-campanha-gerente-reasignar.js')); ?>"></script>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>