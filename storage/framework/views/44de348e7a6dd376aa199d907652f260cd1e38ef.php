<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-1.12.4.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php
    
    $rolUsuario = Auth::user()->ROL;
?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Reportes'); ?>
<form action="" class="form-horizontal" method="GET">

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
                <div class="row clearfix">

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Fecha:</label>
                        <div class="col-md-9">
                            <input type="text" id="datetimepicker3" class="form-control datepicker" value="<?php echo e($busqueda['fecha']); ?>" name="fecha">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Tipo:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="tipo">
                                <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t); ?>" <?php echo e(($t == $busqueda['tipo'])? 'selected="selected"':''); ?>

                                ><?php echo e($t); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>								
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Estado:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="estado" >
                                <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($e); ?>" <?php echo e(($e == $busqueda['estado'])? 'selected="selected"':''); ?>

                                ><?php echo e($e); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary" type="submit" id="buttonSSRS">Buscar</button>
                    </div>
                    
                </div>
                <div class="row clearfix">

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Banca:</label>
                        <div class="col-md-9">
                            <select id="cboBanca" class="form-control" name="banca">
                                <option value="">VPC</option>
                                <?php $__currentLoopData = $bancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($banca->BANCA); ?>" <?php echo e(($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''); ?>

                                ><?php echo e($banca->NOMBRE_BANCA); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Zonal:</label>
                        <div class="col-md-9">
                            <select id="cboZonal" class="form-control" name="zonal">
                                <option value="">Todos</option>
                                <?php $__currentLoopData = $zonales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($zonal->ZONAL); ?>" <?php echo e(($zonal->ZONAL == $busqueda['zonal'])? 'selected="selected"':''); ?>

                                ><?php echo e($zonal->NOMBRE_ZONAL); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Jefatura:</label>
                        <div class="col-md-9">
                            <select id="cboJefatura" class="form-control" name="jefatura">
                                <option value="">Todos</option>
                                <?php $__currentLoopData = $jefaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jefatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($jefatura->JEFATURA); ?>" <?php echo e(($jefatura->JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''); ?>

                                ><?php echo e($jefatura->NOMBRE_JEFE); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="" class="control-label col-md-3">Ejecutivo:</label>
                        <div class="col-md-9">
                            <select id="cboEjecutivo" class="form-control" name="ejecutivo">
                                <option value="">Todos</option>
                                <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ejecutivo->COD_SECT_UNIQ); ?>" <?php echo e(($ejecutivo->COD_SECT_UNIQ == $busqueda['ejecutivo'])? 'selected="selected"':''); ?>

                                ><?php echo e($ejecutivo->ENCARGADO); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
    	</div>
    </div>
</div>
<!--span>
    <?php echo e($url); ?>&origen=VPCONNECT&fecha=<?php echo e($busqueda['fecha']); ?>&tipo=<?php echo e($busqueda['tipo']); ?>&estado=<?php echo e($busqueda['estado']); ?>&banca=<?php echo e($busqueda['banca']); ?>&zonal=<?php echo e($agrupacion); ?>&ejecutivo=<?php echo e($busqueda['ejecutivo']); ?>&nomEjec=<?php echo e($nomEjec); ?>

</span-->        
<iframe id="frameSSRS" 
        
        src="<?php echo e($url); ?>&origen=VPCONNECT&fecha=<?php echo e($busqueda['fecha']); ?>&tipo=<?php echo e($busqueda['tipo']); ?>&estado=<?php echo e($busqueda['estado']); ?>&banca=<?php echo e($busqueda['banca']); ?>&zonal=<?php echo e($agrupacion); ?>&ejecutivo=<?php echo e($busqueda['ejecutivo']); ?>&nomEjec=<?php echo e($nomEjec); ?>" 
        
        width="100%" height="800px" >
</iframe>

</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>

<script>
       
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
        //cargarReporte();
        
        /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
        if ($('#cboBanca').length > 0){
            cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());
        } else {
            if ($('#cboZonal').length > 0){
                cboZonalChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
            } else {
                if ($('#cboJefatura').length > 0){
                    cboJefaturaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
                }
            }
        }
        
        $('#cboBanca').change(function(){
            cboBancaChange($(this).val(),null,null,null);
        });
        
        $('#cboZonal').change(function(){
            cboZonalChange($('#cboBanca').val(),$(this).val(),null,null);
        });

        $('#cboJefatura').change(function(){
            cboJefaturaChange($('#cboBanca').val(),$('#cboZonal').val(),$(this).val(),null);
        });
        
    });
    
    
    /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/

    function cboBancaChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboBancaChange - banca: " + banca);
        var cboZonal = $('#cboZonal');
        var cboJefatura = $('#cboJefatura');
        var cboEjecutivo = $('#cboEjecutivo');

        //Limpiamos el combobox de jefaturas
        cboZonal.find('option:not(:first)').remove();
        cboJefatura.find('option:not(:first)').remove();
        cboEjecutivo.find('option:not(:first)').remove();
        cboEjecutivo.val('');

        //Si no selecionada nada como resultado
        if (!banca) {
            cboZonal.val('');
            cboZonal.prop('disabled',false);
            return;
        }

        //Si selecciona cualquier otro resultado
        cboZonal.prop('disabled', true);
        //cboJefatura.prop('disabled', true);
        //cboEjecutivo.prop('disabled', true); 

        return $.ajax({
            type: "GET",
            data: {
                banca: banca
            },
            //url: APP_URL + 'be/utils/get-zonales-by-banca',
            url: APP_URL + 'be/utils/get-arbol-zonales',
            dataType: 'json',
            success: function (json) {
                $.each(json, function (key, value) {
                    cboZonal.append($("<option></option>")
                        .attr("value", value.ZONAL).text(value.NOMBRE_ZONAL));
                });
                if (zonal){
                    cboZonal.val(zonal);
                }
                cboZonal.prop('disabled', false);
                cboZonalChange(banca, zonal, jefatura, ejecutivo);
            }
        });
    }

    function cboZonalChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboZonalChange - zonal: " + zonal);
        console.log("cboZonalChange - banca: " + banca);
        var cboJefatura = $('#cboJefatura');
        var cboEjecutivo = $('#cboEjecutivo');

        //Limpiamos el combobox de jefaturas y ejecutivos
        cboJefatura.find('option:not(:first)').remove();
        cboEjecutivo.find('option:not(:first)').remove();
        cboEjecutivo.val('');

        //Si no selecionada nada como resultado
        if (!zonal) {
            cboJefatura.val('');
            cboJefatura.prop('disabled', false);
            return;
        }
            
        //Si selecciona cualquier otro resultado
        cboJefatura.prop('disabled', true);
        //cboEjecutivo.prop('disabled', true);
        return $.ajax({
            type: "GET",
            data: {
                banca: banca,
                zonal: zonal
            },
            //url: APP_URL + 'be/utils/get-jefaturas-by-zonal',
            url: APP_URL + 'be/utils/get-arbol-jefaturas',
            dataType: 'json',
            success: function (json) {
                var i = 0, valor = '';
                $.each(json, function (key, value) {
                    if (i===0) {
                        valor = value.JEFATURA;
                    }
                    cboJefatura.append($("<option></option>")
                        .attr("value", value.JEFATURA).text(value.NOMBRE_JEFE));
                    i=+1;
                });
                if (jefatura){
                    cboJefatura.val(jefatura);
                } else {
                    cboJefatura.val(valor);
                    jefatura = valor;
                }
                
                cboJefatura.prop('disabled', false);
                cboJefaturaChange(banca, zonal, jefatura, ejecutivo);
            }
        });
    }
    
    function cboJefaturaChange(banca, zonal, jefatura, ejecutivo) {
        console.log("cboJefaturaChange - jefatura: " + jefatura);
        var cboEjecutivo = $('#cboEjecutivo');

        //Limpiamos el combobox de ejecutivos
        cboEjecutivo.find('option:not(:first)').remove();

        //Si selecciona cualquier otro resultado
        cboEjecutivo.prop('disabled', true);
        $.ajax({
            type: "GET",
            data: {
                banca: banca,
                jefatura: jefatura,
                zonal: zonal
            },
            //url: APP_URL + 'be/utils/get-ejecutivos-by-jefatura',
            url: APP_URL + 'be/utils/get-arbol-ejecutivos',
            dataType: 'json',
            success: function (json) {
                var i = 0, valor = '';
                $.each(json, function (key, value) {
                    if (i===0) {
                        valor = value.COD_SECT_UNIQ;
                    }
                    cboEjecutivo.append($("<option></option>")
                        .attr("value", value.COD_SECT_UNIQ).text(value.ENCARGADO));
                    
                    i=+1;
                });
                if (ejecutivo){
                    cboEjecutivo.val(ejecutivo);
                } else {
                    //if (typeof jefatura !== 'undefined' && jefatura !== null && jefatura !== '') {
                    if (jefatura === null || jefatura === '') {
                        cboEjecutivo.val(valor);
                        ejecutivo = valor;
                    }
                }
                
                cboEjecutivo.prop('disabled', false);
            }
        });
    }
    
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>