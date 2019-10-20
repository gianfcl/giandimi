<?php $__env->startSection('pageTitle', 'Asignacion de Leads'); ?>

<?php $__env->startSection('js-scripts'); ?>

<script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/formvalidation/formValidation.min.js')); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/webvpc/bpe-campanha-soporte-asignar.js?v=001')); ?>"></script>
 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="x_panel" id="asignar">
    <div class="x_title">
        <h2>Asignar a</h2>
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
                        <input id="num_doc" type="text" class="form-control" placeholder="Ejem: 3598874115" maxlength="15">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                        <button id="agregar" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="ln_solid"></div>

        <form method="POST" action="<?php echo e(route('bpe.campanha.soporte.asignar.asignar')); ?>">
            <div class="row">
                <table id="tablaLeads" class="table table-striped jambo_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Documento</th>
                            <th>Cliente</th>
                            <th>Actividad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tablaLeadsBody">
                        <tr>
                            <td colspan="5" style="text-align: center">No hay leads agregados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="rsgn_btn_div">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                <input type="hidden" name="en" value="" id="txtEjecutivo"> 
                <button id="btnAsignar" type="submit" class="btn btn-success rsgn_btn" disabled="disabled"><span class="glyphicon glyphicon-send"></span> Asignar</button>
            </div>        
        </form>
    </div>
</div>
<div id="templateRowLead" class="hidden">
    <table>
        <tr>
            <td class="rowNumero"></td>
            <td class="rowDocumento"></td>
            <td class="rowCliente"></td>
            <td class="rowActividad"></td>
            <td class="rowAccion">
                <input type="hidden" name="lead[]">
                <button class="btn btn-sm btn-danger btnQuitar">Quitar</button>
            </td>
        </tr>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>