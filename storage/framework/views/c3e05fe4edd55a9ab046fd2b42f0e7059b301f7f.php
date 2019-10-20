<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/pnotify.custom.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/animate.css')); ?>" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/pnotify.custom.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php
    $modoComunicacion=in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosComunicacion());
?>
<?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_JEFATURA_BE,\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE])): ?>
<?php $__env->startSection('content'); ?>


<?php $__env->startSection('pageTitle', 'Ejecutivos de Negocio'); ?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel">
    		<div class="x_title">    			
      			<h2 style="font-size: 150%">Búsqueda</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>
		    <div class="x_content">
		        <form action="<?php echo e(route('be.resumen.index')); ?>" class="form-horizontal">
		            <div class="row clearfix">
		                <div class="row" id="filtros">

		                	<?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE])): ?>
		                	<div class="form-group col-md-4">
			                    <label for="" class="control-label col-md-3" style="font-size: 120%">Banca:</label>
			                    <div class="col-md-7">
				                    <select id="cboBanca" class="form-control" name="banca" style="font-size: 120%">
				                    	<option value="">Todos</option>
				                    	<?php $__currentLoopData = $bancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            			<option value="<?php echo e($banca->BANCA); ?>" <?php echo e(($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''); ?>

	                            			><?php echo e($banca->BANCA); ?></option>
                        				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        			
									</select>
			                    </div>
			                </div>
			                <?php endif; ?>

		                	<?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA])): ?>
		                	<div class="form-group col-md-4">
			                    <label for="" class="control-label col-md-3" style="font-size: 120%">Zonal:</label>
			                    <div class="col-md-7">
				                    <select id="cboZonal" class="form-control" name="zonal" style="font-size: 120%">
				                    	<option value="">Todos</option>
				                    	<?php $__currentLoopData = $zonales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($zonal->ID_ZONAL); ?>" <?php echo e(($zonal->ID_ZONAL == $busqueda['zonal'])? 'selected="selected"':''); ?>

                            			><?php echo e($zonal->ZONAL); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
			                    </div>
			                </div>
			                <?php endif; ?>

			                <?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE])): ?>
			                <div class="form-group col-md-4">
			                    <label for="" class="control-label col-md-3 " style="font-size: 120%">Jefatura:</label>
			                    <div class="col-md-7">
			                    	<select id= "cboJefatura" class="form-control" name="jefatura" style="font-size: 120%">
			                    		<option value="">Todos</option>
			                    		<?php $__currentLoopData = $jefaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jefatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($jefatura->ID_JEFATURA); ?>" <?php echo e(($jefatura->ID_JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''); ?>

                            			><?php echo e($jefatura->JEFATURA); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        		</select>
			                    </div>
			                </div>
			                <?php endif; ?>	

			                <div class="form-group col-md-4">
			                    <label for="" class="control-label col-md-3" style="font-size: 120%" >Avance: </label>
			                    <div class="col-md-7">
			                        <select class="form-control" name="avance" style="font-size: 120%">
			                        	<option value="Todos" <?php echo e(('Todos' == $busqueda['avance'])? 'selected="selected"':''); ?>>Todos</option>
			                        	<option value="Mes"<?php echo e(('Mes' == $busqueda['avance'])? 'selected="selected"':''); ?>>Avance del Mes</option>
			                        	<option value="Stock"<?php echo e(('Stock' == $busqueda['avance'])? 'selected="selected"':''); ?>>Avance del Stock</option>
									</select>
			                    </div>
			                </div>
			                <div class="col-md-3">
		                	<button class="btn btn-primary" type="submit" style="font-size: 120%" >Buscar</button>
		                	</div>
			            </div>		                
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
	      		<h2>Lista de Ejecutivos</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<div class="x_content">

				<table class="table table-striped jambo_table">
		            <thead>
		                <tr class="headings" style="font-size: 120%"  >
		                	
		                    <th style="width: 15%" class="text-center">Ejecutivo</th>

		                    <?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA])): ?>
		                    <th style="" class="text-center">Zonal</th>		                    
		                    <?php endif; ?>

		                    <?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE])): ?>
		                    <th style="" class="text-center">Jefatura</th>
		                    <?php endif; ?>

		                    <th style="" class="text-center">Leads</th>

		                    <!--Aquí irá el ordenamiento-->
		                    <th style="" class="text-center">
		                    <?php if(isset($orden) && $orden['sort'] == 'avance'): ?>
	                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
	                                <a href="<?php echo e(route('be.resumen.index', array_merge($busqueda,['sort' => 'avance','order' =>'desc']))); ?>">
	                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
	                            <?php else: ?>
	                                <a href="<?php echo e(route('be.resumen.index', $busqueda)); ?>">
	                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
	                            <?php endif; ?>
	                        <?php else: ?>
	                            <a href="<?php echo e(route('be.resumen.index', array_merge($busqueda,['sort' => 'avance','order' =>'asc']))); ?>">
	                            <i class="fa fa-sort fa-lg order-icon"></i>
	                        <?php endif; ?>
		                    </a>%Avance</th>


		                    <th style="" class="text-center">Contactados</th>
		                    <th style="" class="text-center">Evaluación IBK</th>
		                    <?php if(!('Mes' == $busqueda['avance'])): ?>
		                    <th style="" class="text-center">Visitas</th>
		                    <?php else: ?>
		                    <th style="" class="text-center">Visitas del Mes</th>
		                    <?php endif; ?>
		                    <th style="width: 5%"></th>

		                </tr>
		            </thead>
		            <tbody>
		            	<?php if(count($ejecutivos)>0): ?>
        			    	<?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    	<tr class="text-center" style="font-size: 110%">
					                <td style="vertical-align: middle;">
					                	Registro: <?php echo e($ejecutivo->REGISTRO); ?> <br/>
					                	<?php echo e($ejecutivo->EJECUTIVO); ?>

					                	
					                </td>

					                <?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA])): ?>
					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->ZONAL); ?></td>
					                <?php endif; ?>

					                <?php if(in_array($usuario->getValue('_rol'),[\App\Entity\Usuario::ROL_GERENCIA_ZONAL_BE,\App\Entity\Usuario::ROL_GERENTE_DIVISION_BE,\App\Entity\Usuario::ROL_GERENTE_BANCA])): ?>
					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->JEFATURA); ?></td>
					                <?php endif; ?>

					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->LEADS); ?></td>
					                <td style="vertical-align: middle;">
					                	<?php if($ejecutivo->AVANCE==0): ?>
									    <div class="progress" style="background-color: #e4e4e4; margin-top: 8px;">
									        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($ejecutivo->AVANCE); ?>%; min-width: 0;">	        
									        </div>  
									    </div>
									    <?php else: ?>
									    <div class="progress" style="background-color: #e4e4e4; margin-top: 8px;">
									        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($ejecutivo->AVANCE); ?>%; min-width: 2em;">
									        <?php echo e(number_format($ejecutivo->AVANCE)); ?>%
									        </div>  
									    </div>
									    <?php endif; ?>
									</td>
					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->LEADS_ETAPA_CONTACTADOS); ?></td>
					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->LEADS_ETAPA_EVALUACION_IBK); ?></td>
					                <td style="vertical-align: middle;"><?php echo e($ejecutivo->VISITAS); ?></td>
					                <td style="vertical-align: middle;">
					                	<a class="btn btn-primary" style="font-size: 120%" href="<?php echo e(route('be.miprospecto.lista.index',['ejecutivo' => $ejecutivo->REGISTRO])); ?>">Detalle</a>
					                	
					                </td>

				            </tr>
				            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    <?php else: ?>
					    	<tr>
					                <td colspan="10">No se encontraron resultados</td>
				            </tr>
			            <?php endif; ?>
		        	</tbody>
		    </table>
		    <?php echo e($ejecutivos->appends($busqueda)->links()); ?>

		    </div>
		</div>
	</div>
</div>

<!--Modal Comunicación-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalComunicacion" style="margin-top: 200px;">
	    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title">Comunicación</h4>-->
            </div>
                <div class="modal-body"><a href="<?php echo e(route('ecosistema.principal')); ?>">
					<img src = "<?php echo e(URL::asset('img/comunicacionEcosistema.jpg')); ?>" style="width: 100%" /></a>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php $__env->stopSection(); ?>
<?php endif; ?> 

<?php $__env->startSection('js-scripts'); ?>
<?php if(session('popUpLogueo') && $modoComunicacion): ?>
	<script type="text/javascript">
		$('#modalComunicacion').modal();
	</script>
<?php endif; ?>
<script>

/*$(function(){
  	new PNotify({
	    title: 'Encuestas Internas',
	    text: 'Tienes hasta el 15/11/2018 para llenar tus encuestas',
	    animate: {
	        animate: true,
	        in_class: 'rotateInDownLeft',
	        out_class: 'rotateOutUpRight'
	    }
	});
});*/
    $(document).ready(function () {

        /****** BANCA - ZONAL - JEFATURA  ******/
		if ($('#cboBanca').length > 0){
            cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val());
        }else{
            if ($('#cboZonal').length > 0){
                cboCentroChange($('#cboZonal').val(),$('#cboJefatura').val());    
            }         
        }
        
        $('#cboZonal').change(function(){
            cboZonalChange($(this).val(),null);
        });


        $('#cboBanca').change(function(){
            cboBancaChange($(this).val(),null,null);
        });
    });

	
	/****** BANCA - ZONAL - JEFATURA ******/
    function cboZonalChange(zonal,jefatura) {
        	var cboJefatura = $('#cboJefatura');

            //Limpiamos el combobox de jefaturas
            cboJefatura.find('option:not(:first)').remove();
            cboJefatura.val('');
                     
            //Si no selecionada nada como resultado
            if (!zonal) {
            	cboJefatura.val('');
                cboJefatura.prop('disabled', false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboJefatura.prop('disabled', true);         

            return $.ajax({
            	type: "GET",
            	data: {zonal: zonal},
            	url: APP_URL + 'be/utils/get-jefaturas-by-zonal',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboJefatura.append($("<option></option>")
            				.attr("value", value.ID_JEFATURA).text(value.JEFATURA));
            		});
            		if (jefatura){
            			cboJefatura.val(jefatura);
            		}
            		cboJefatura.prop('disabled', false);
            	}
            });
        }

    function cboBancaChange(banca,zonal,jefatura) {
        	var cboJefatura = $('#cboJefatura');
        	var cboZonal=$('#cboZonal');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            cboJefatura.val('');

            //Si no selecionada nada como resultado
            if (!banca) {
            	cboZonal.val('');
            	cboZonal.prop('disabled',false);
            	return;

            }
            
            //Si selecciona cualquier otro resultado
            cboZonal.prop('disabled', true);         

            return $.ajax({
            	type: "GET",
            	data: {banca: banca},
            	url: APP_URL + 'be/utils/get-zonales-by-banca',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboZonal.append($("<option></option>")
            				.attr("value", value.ID_ZONAL).text(value.ZONAL));
            		});
            		if (zonal){
            			cboZonal.val(zonal);
            		}
            		cboZonal.prop('disabled', false);
            		cboZonalChange(zonal,jefatura);
            	}
            });
        } 

    
</script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>