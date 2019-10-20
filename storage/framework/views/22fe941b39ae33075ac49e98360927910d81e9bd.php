<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>



<?php $__env->stopSection(); ?>

<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
	$modoJefe = in_array(Auth::user()->ROL,array_merge(App\Entity\Usuario::getJefesGerentesBE(),App\Entity\Usuario::getAnalistasExternosBE())) ;
	$modoEjecutivo=in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosBE());
	$modoAnalista=in_array(Auth::user()->ROL,App\Entity\Usuario::getAnalistasInternosBE());
	$modoEjecutivoProducto=in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosProductoBE());
	$modoEdicion=in_array(Auth::user()->ROL,array_merge(App\Entity\Usuario::getAnalistasInternosBE(),App\Entity\Usuario::getEjecutivosBE(),App\Entity\Usuario::getEjecutivosProductoBE()));
	$rolUsuario=Auth::user()->ROL;
	$permisoAsesoria=in_array(Auth::user()->REGISTRO,['B34601','B14971']);
    $modoComunicacion=in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosComunicacion());
?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
	.item-nota p{
		margin: 5px 0px;
	}

	.paddingForm {
	    padding-bottom: 0px;
	    padding-top: 0px;	   
	    height: 25px;
	}

	div.grande {
	    bottom: 0px;
	    left: -300px;
	    width: 1350px;
	}

	div.pequenho{
	    bottom: -300px;
	    right: 200px;
	    width: 300px;
	}
	
	textarea{
		resize: none;
	}

	.tamForm {
		font-size: 11px;
		width:150px;
	}

	.styleAddOn{
	    padding-bottom: 0px;
	    padding-top: 0px;
	}
	.titEstrategia{
		font-size: 12px;
		font-weight: bold;
	}

	.paddingXPanel{
	    padding-bottom: 0px;
	    padding-top: 10px;
	    padding-left: 10px;
	    padding-right: 10px;
	}

</style>

<?php if(!in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosBE(),\App\Entity\Usuario::getEjecutivosProductoBE(),\App\Entity\Usuario::getAnalistasInternosBE(),[\App\Entity\Usuario::ROL_JEFATURA_BE])) and !$permisoAsesoria): ?>
<style type="text/css">
	#modalNotas .fa-trash {
		display: none;
	}
</style>
<?php endif; ?>

<?php $__env->startSection('pageTitle', 'Acciones Comerciales'); ?>
<form action="<?php echo e(route('be.misacciones.lista.index')); ?>" class="form-horizontal">
<input name="flgRequest" value="<?php echo ($flgAccion ? $flgAccion : '0') ?>" class="hidden">
<div class="form-group">		        		
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
	    	<div class="x_panel"> 
	    		
	    		<div class="col-md-12 col-sm-12 col-xs-12">	  
				<center>
	    			
					<button type="submit" class="btn <?php echo ($flgAccion=='0' ? 'btn-success active' : 'btn-primary') ?>" style="font-size: 16px" name="flgAccion" value="0" >Acciones Propias</button>	 		
					<button type="submit" class="btn <?php echo ($flgAccion=='1' ? 'btn-success active' : 'btn-primary') ?>" style="font-size: 16px" name="flgAccion" value="1" >Acciones Delegadas</button>
					<button type="submit" class="btn <?php echo ($flgAccion=='2' ? 'btn-success active' : 'btn-primary') ?>" style="font-size: 16px" name="flgAccion" value="2" >Acciones por Campañas</button>
	    			
				</div>
				</center>
				
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
		            <div class="row clearfix">
						

		               <?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE()))): ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Banca:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <select id="cboBanca" class="form-control" name="banca">
		                    		<option value="">Todos</option>
				                    	<?php $__currentLoopData = $bancas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            			<option value="<?php echo e($banca->BANCA); ?>" <?php echo e(($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''); ?>

	                            			><?php echo e($banca->BANCA); ?></option>
                        				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</select>
		                    </div>
		                </div>
		                <?php endif; ?>

						<?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca()))): ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Zonal:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <select id="cboZonal" class="form-control" name="zonal">
		                    		<option value="">Todos</option>
									<?php $__currentLoopData = $zonales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($zonal->ID_ZONAL); ?>" <?php echo e(($zonal->ID_ZONAL == $busqueda['zonal'])? 'selected="selected"':''); ?>

                            			><?php echo e($zonal->ZONAL); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</select>
		                    </div>
		                </div>
		                <?php endif; ?>
						
						<?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE()))): ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jefatura:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <select id="cboJefatura" class="form-control" name="jefatura">
		                    		<option value="">Todos</option>
									<?php $__currentLoopData = $jefaturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jefatura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($jefatura->ID_JEFATURA); ?>" <?php echo e(($jefatura->ID_JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''); ?>

                            			><?php echo e($jefatura->JEFATURA); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</select>
		                    </div>
		                </div>
		                <?php endif; ?>
						
						<?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosProductoBE(),\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE()))): ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ej. Negocio:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <select id="cboEjecutivo" class="form-control" name="ejecutivo">
		                    		<option value="">Todos</option>
									<?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($ejecutivo->REGISTRO); ?>" <?php echo e(($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''); ?>

                            			><?php echo e($ejecutivo->NOMBRE); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</select>
		                    </div>
		                </div>
		                <?php endif; ?>

						<?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosProductoBE(),\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE()))): ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px;">Ej. Producto:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <select id="cboProducto" class="form-control" name="ejecutivoProducto">
		                    		<option value="">Todos</option>
									<?php $__currentLoopData = $eProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($ejecutivo->REGISTRO); ?>" <?php echo e(($ejecutivo->REGISTRO == $busqueda['ejecutivoProducto'])? 'selected="selected"':''); ?>

                            			><?php echo e($ejecutivo->NOMBRE); ?></option>
                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</select>
		                    </div>
		                </div>
		                <?php endif; ?>
		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">R.Social:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <input class="form-control" type="text" value="<?php echo e($busqueda['razonSocial']); ?>" name="razonSocial">
		                    </div>
		                </div>

		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">CU:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
		                        <input class="form-control formatInputNumber" type="text" value="<?php echo e($busqueda['codUnico']); ?>" name="codUnico">
		                    </div>
		                </div>

			            
						<div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoría:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
			                    <select class="form-control" name="categoria">
			                    	<option value="">Todos</option>	
			                    	<?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    		<option value="<?php echo e($cat->CATEGORIA); ?>" <?php echo e(($cat->CATEGORIA == $busqueda['categoria'])? 'selected="selected"':''); ?>

                            			><?php echo e($cat->CATEGORIA); ?></option>
			                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>								
								</select>
							</div>
	                    </div>

	                    <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Estrategia:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
			                    <select class="form-control" name="estrategia" id="cboEstrategia">
			                    	<option value="">Todos</option>									
			                    	<?php $__currentLoopData = $estrategias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estrategia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    		<option value="<?php echo e($estrategia->ESTRATEGIA); ?>" <?php echo e(($estrategia->ESTRATEGIA == $busqueda['estrategia'])? 'selected="selected"':''); ?>

                            			><?php echo e($estrategia->ESTRATEGIA); ?></option>
			                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
	                    </div>

	                    <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Acción:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
			                    <select class="form-control" name="accion" id="cboAccion">
			                    	<option value="">Todos</option>	
			                    	<?php $__currentLoopData = $accionesE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    		<option value="<?php echo e($acc->ID_ACCION); ?>" <?php echo e(($acc->ID_ACCION == $busqueda['accion'])? 'selected="selected"':''); ?>

                            			><?php echo e($acc->ACCION); ?></option>
			                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>								
								</select>
							</div>
	                    </div>

	                    <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Etapa:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
			                    <select class="form-control" name="etapa" id="cboEtapa">
			                    	<option value="">Todos</option>									
			                    	<?php $__currentLoopData = $etapasAcciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etapa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    		<option value="<?php echo e($etapa->ID_ETAPA); ?>" <?php echo e(($etapa->ID_ETAPA == $busqueda['etapa'])? 'selected="selected"':''); ?>

                            			><?php echo e($etapa->ETAPA); ?></option>
			                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
	                    </div>

	                    <?php if($visualizacion): ?>
	                    <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Semáforo:</label>
		                    <div class="col-md-9 col-sm-9 col-xs-12">
			                    <select class="form-control" name="semaforo" id="cboSemaforo">
			                    	<option value="">Todos</option>									
			                    	<?php $__currentLoopData = $semaforo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    		<option value="<?php echo e($color); ?>" <?php echo e(($color== $busqueda['semaforo'])? 'selected="selected"':''); ?>

                            			><?php echo e($color); ?></option>
			                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
	                    </div>	   
	                    <?php endif; ?>  	                			                			                

		                <div class="form-group col-md-3 col-xs-6 col-sm-6">
		                	<center>
		                		<button class="btn btn-primary" type="submit" style="font-size: 14px" ><i class="fa fa-search"></i> Buscar</button>
		                	</center>
		                </div>
		            </div>
		    </div>
    	</div>
    </div>
</div>
</form>


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
      		<div class="x_title">
	      		<h2>Detalle por Cliente</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<div class="x_content table-responsive">
    			<?php if($modoEdicion or $permisoAsesoria): ?>				
    			<button id="btnAgregarAccionComercial" class="btn btn-sm btn-primary" style="font-size: 14px;"><i class="fa fa-plus" aria-hidden="true"></i> Ingresar Acción</button>
    			<?php endif; ?>
				<?php if(!$visualizacion): ?> <!--Vista de un EN-->		
		        <table class="table table-striped jambo_table">
		            <thead>
		                <tr class="headings">		                	
		                    <th style="vertical-align: middle;text-align: center;width:7%"></th>
		                    <th style="vertical-align: middle;text-align: center;width:3%">Días por vencer</th>
		                    <th style="vertical-align: middle;text-align: center;width:10%">Estrategia</th>
		                    <th style="vertical-align: middle;text-align: center;width:10%">		                    
		                    <?php if(isset($orden) && $orden['sort'] == 'accion'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'accion','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'accion','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Acción</th>
		                    <th style="vertical-align: middle;text-align: center;width:15%">Empresa</th> <!--Empresa/Encargado-->

		                    <th style="vertical-align: middle;text-align: center;width:10%">
		                    <?php if(isset($orden) && $orden['sort'] == 'categoria'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'categoria','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'categoria','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Categoría</th>

		                    <th style="vertical-align: middle;text-align: center;width:8%">
		                    <?php if(isset($orden) && $orden['sort'] == 'deudaRCC'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaRCC','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaRCC','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Deuda RCC (S/ Miles)/ Bco. Principal</th>
		                    
                        	<th style="vertical-align: middle;text-align: center;width:8%">
	                        <?php if(isset($orden) && $orden['sort'] == 'deudaIBK'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaIBK','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaIBK','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Deuda Total IBK (S/ Miles)</th>

		                    <th style="vertical-align: middle;text-align: center;width:7%">
	                    	<?php if(isset($orden) && $orden['sort'] == 'etapa'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'etapa','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'etapa','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Etapa</th>
		                    <th style="vertical-align: middle;text-align: center;width:8%">Monto KPI (S/ Miles)</th>                    
				
							<th style="vertical-align: middle;text-align: center;width:6%"></th>
							<th style="vertical-align: middle;text-align: center;width:4%"></th>
							<th style="vertical-align: middle;text-align: center;width:4%"></th>
		                </tr>
		            </thead>
		            <tbody>
		            <?php if(count($acciones)>0): ?>
		            	<?php $__currentLoopData = $acciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                <td style="vertical-align: middle;text-align: center;">
	                        <?php if($accion->ESTRELLA == 0 && $accion->ENCARGADO_EN==1): ?>
	                            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 40px; color: rgb(128, 128, 128);"
	                            cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" rol="<?php echo e($rolUsuario); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" ></span>
	                        <?php elseif($accion->ESTRELLA == 1 && $accion->ENCARGADO_EN==1): ?>
	                            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 40px; color: rgb(241, 196, 15);"
	                            cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" rol="<?php echo e($rolUsuario); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" ></span>
	                        <?php endif; ?>
	                        <?php if($accion->ENCARGADO_EN==0): ?>
	                        	<?php if($accion->MESES_ASIGNACION==0): ?>
		                       		<span class="fa fa-circle fa-2x" aria-hidden="true" style="font-size: 30px; color: #3ADF00;"></span>
		                        <?php elseif($accion->MESES_ASIGNACION==1): ?>
		                        	<span class="fa fa-circle fa-2xr" aria-hidden="true" style="font-size: 30px; color: #F1C40F ;"></span>
		                        <?php else: ?>
		                        	<span class="fa fa-circle fa-2x" aria-hidden="true" style="font-size: 30px; color: #FF0000 ;"></span>
		                        <?php endif; ?>
	                        	<img src = "<?php echo e(URL::asset('img/eCash.png')); ?>" style="width: 40%;margin-left: 15px;margin-bottom: 10px" />
	                        <?php endif; ?>
                    	</td>

		                	<?php $diasVencer=$accion->DIAS_VENCER; if($diasVencer==NULL) $diasVencer=0;?>
		                	<?php if(!($diasVencer>=15)): ?>		
		                    	<td style="vertical-align: middle;text-align: center; color:red"><?php echo e($diasVencer); ?></td>
		                	<?php else: ?>
	                			<td style="vertical-align: middle;text-align: center;"><?php echo e($diasVencer); ?></td>
		                	<?php endif; ?>

		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->ESTRATEGIA); ?></td>
		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->ACCION); ?>

		                		<?php if($accion->TOOLTIP != '*'): ?>
                        		<i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e($accion->TOOLTIP); ?>" aria-hidden="true"></i>
                    			<?php endif; ?>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php echo e($accion->NOMBRE_EMPRESA); ?><br>
		                		CU: <?php echo e($accion->COD_UNICO); ?><br>
		                		<?php if($accion->ENCARGADO_EN==0 and $modoEjecutivo): ?>
		                			EC: <?php echo e($accion->NOMBRE_EC); ?><br>
		                		<?php endif; ?>
		                		<?php if(!$modoEjecutivo or $modoEjecutivoProducto): ?>
		                			EN: <?php echo e($accion->NOMBRE_EN); ?><br>
		                			<?php if($accion->NOMBRE_EC!=NULL and !$modoEjecutivoProducto): ?>
		                				EC: <?php echo e($accion->NOMBRE_EC); ?><br>
		                			<?php endif; ?>
		                		<?php endif; ?>		                		
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->CATEGORIA); ?></td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		S/ <?php echo e(number_format($accion->DEUDA_TOTAL_RCC/1000,0,'.',',')); ?><br>
		                		<?php echo e($accion->BANCO_PRINCIPAL); ?>

		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		S/ <?php echo e(number_format($accion->DEUDA_IBK/1000,0,'.',',')); ?></td>

		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEdicion and $accion->ENCARGADO_EN==1): ?>
		                		<a class="lnkEditEtapa" href="" etapa="<?php echo e($accion->ID_ETAPA); ?>" cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">
		                			<?php echo e($accion->ETAPA); ?>

		                		</a>
		                		<?php else: ?>
		                			<?php echo e($accion->ETAPA); ?>

		                		<?php endif; ?>
		                	</td>

		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php echo e($accion->TIPO_KPI); ?><br>
		                		<?php echo e(number_format($accion->KPI/1000,0,'.',',')); ?></td>

		                	<td style="vertical-align: middle;text-align: center;">

		                		<?php if(($modoEdicion and $accion->ENCARGADO_EN==1) or $permisoAsesoria): ?>

		                		<a href="#" class="lnkNotas" lead="<?php echo e($accion->NUM_DOC); ?>" usuarioRegistro="<?php echo e($accion->NOMBRE_REGISTRO_ACCION); ?>" flgAccion="<?php echo e($accion->FLG_ACCION); ?>" ejecutivo="<?php echo e($usuario->getValue('_registro')); ?>" idAccion="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">+Añadir una nueva nota</a>

		                		<?php else: ?>
		                		<a href="#" class="lnkNotas" lead="<?php echo e($accion->NUM_DOC); ?>" usuarioRegistro="<?php echo e($accion->NOMBRE_REGISTRO_ACCION); ?>" flgAccion="<?php echo e($accion->FLG_ACCION); ?>" ejecutivo="<?php echo e($usuario->getValue('_registro')); ?>" idAccion="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">Visualizar notas</a>
		                		<?php endif; ?>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<a href="<?php echo e(route('be.micontacto.index')); ?>?documento=<?php echo e($accion->NUM_DOC); ?>" style ="padding:8px;"> <i class="fa fa-phone fa-2x" data-toggle="tooltip" title="" data-placement="bottom"  aria-hidden="true"  data-original-title="Contacto"></i></a>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEdicion and $accion->ENCARGADO_EN==1): ?>
		                		<a href="#" style ="padding:8px;" id ="btnEliminarAccion"> <i class="fa fa-trash fa-2x btnEliminarAccion" data-toggle="tooltip" title="" documentoE="<?php echo e($accion->NUM_DOC); ?>" accionE="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" data-placement="bottom" aria-hidden="true"  data-original-title="Eliminar"></i></a>
		                		<?php endif; ?>
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

		    		<?php else: ?> 
		    			<table class="table table-striped jambo_table">
		            	<thead>
		                <tr class="headings">
		    			<!--Vista de un EC-->
		    				<th style="vertical-align: middle;text-align: center;width:3%"></th>
		    				<th style="vertical-align: middle;text-align: center;width:6%">Fecha de Registro</th>
		                    <th style="vertical-align: middle;text-align: center;width:12%">Empresa</th> <!--Empresa/Encargado-->
		                    <th style="vertical-align: middle;text-align: center;width:5%">Grupo Económico</th>
		                    <th style="vertical-align: middle;text-align: center;width:8%">Estrategia</th>
		                    <th style="vertical-align: middle;text-align: center;width:8%">
		                    	<?php if(isset($orden) && $orden['sort'] == 'accion'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'accion','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'accion','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Acción</th>

		                    <th style="vertical-align: middle;text-align: center;width:6%">
		                    <?php if(isset($orden) && $orden['sort'] == 'categoria'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'categoria','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'categoria','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Categoría</th>

		                    <th style="vertical-align: middle;text-align: center;width:8%">
		                    <?php if(isset($orden) && $orden['sort'] == 'ventas'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'ventas','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'ventas','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Ventas / Costo de Ventas (S/ Miles) </th>
		                    
                        	<th style="vertical-align: middle;text-align: center;width:8%">
	                        <?php if(isset($orden) && $orden['sort'] == 'deudaIBK'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaIBK','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'deudaIBK','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Deuda Total IBK (S/ Miles) / SOW</th>

		                    <th style="vertical-align: middle;text-align: center;width:6%">
		                    <?php if(isset($orden) && $orden['sort'] == 'etapa'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'etapa','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'etapa','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Etapa</th>
		                    <th style="vertical-align: middle;text-align: center;width:8%">
							<?php if(isset($orden) && $orden['sort'] == 'volumen'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'volumen','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'volumen','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Volumen Proyectado Mensual (S/ Miles)</th>                    
                        	<th style="vertical-align: middle;text-align: center;width:8%">
							<?php if(isset($orden) && $orden['sort'] == 'mesActivacion'): ?>
		                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'mesActivacion','order' =>'desc']))); ?>">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        <?php else: ?>
		                            <a href="<?php echo e(route('be.misacciones.lista.index', $busqueda)); ?>">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        <?php endif; ?>
		                    <?php else: ?>
		                        <a href="<?php echo e(route('be.misacciones.lista.index', array_merge($busqueda,['sort' => 'mesActivacion','order' =>'asc']))); ?>">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    <?php endif; ?>
                        	</a>Mes Activación</th>                  
				
							<th style="vertical-align: middle;text-align: center;width:6%"></th>
							<th style="vertical-align: middle;text-align: center;width:4%"></th>
							<th style="vertical-align: middle;text-align: center;width:4%"></th>
		                </tr>
		            </thead>
		            <tbody>
		            <?php if(count($acciones)>0): ?>
		            	<?php $__currentLoopData = $acciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
			                <td style="vertical-align: middle;text-align: center;">
		                       	<?php if($accion->MESES_ASIGNACION==0): ?>
		                       		<span class="fa fa-circle fa-2x" aria-hidden="true" style="font-size: 30px; color: #3ADF00;"></span>
		                        <?php elseif($accion->MESES_ASIGNACION==1): ?>
		                        	<span class="fa fa-circle fa-2xr" aria-hidden="true" style="font-size: 30px; color: #F1C40F ;"></span>
		                        <?php else: ?>
		                        	<span class="fa fa-circle fa-2x" aria-hidden="true" style="font-size: 30px; color: #FF0000 ;"></span>
		                        <?php endif; ?>
	                    	</td>
	                    	<td style="vertical-align: middle;text-align: center;">
		                       	<?php echo e($accion->FECHA_CARGA); ?>

	                    	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php echo e($accion->NOMBRE_EMPRESA); ?><br>
		                		CU: <?php echo e($accion->COD_UNICO); ?><br>
		                		<?php if($modoEjecutivo or $modoJefe): ?>
		                			EJ Delegado: <?php echo e($accion->NOMBRE_EC); ?><br>
		                		<?php elseif($modoEjecutivoProducto): ?>
		                			EN: <?php echo e($accion->NOMBRE_EN); ?><br>
		                		<?php endif; ?>		                		
		                	</td>

		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->GRUPO_ECONOMICO); ?></td>		                	
		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->ESTRATEGIA); ?></td>
		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->ACCION); ?>

		                		<?php if($accion->TOOLTIP != '*'): ?>
                        		<i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e($accion->TOOLTIP); ?>" aria-hidden="true"></i>
                    			<?php endif; ?>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;"><?php echo e($accion->CATEGORIA); ?></td>

		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php echo e(number_format($accion->VENTAS,0,'.',',')); ?><br>
		                		<?php echo e(number_format($accion->COSTO_VENTAS,0,'.',',')); ?>

		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php echo e(number_format($accion->DEUDA_IBK/1000,0,'.',',')); ?><br>
		                		<?php echo e(number_format($accion->SOW*100,0,'.',',')); ?>%
		                	</td>

		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEjecutivoProducto): ?>
		                		<a class="lnkEditEtapa" href="" etapa="<?php echo e($accion->ID_ETAPA); ?>" cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">
		                			<?php echo e($accion->ETAPA); ?>

		                		</a>
		                		<?php else: ?>
		                			<?php echo e($accion->ETAPA); ?>

		                		<?php endif; ?>
		                	</td>

		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEjecutivoProducto): ?>
		                		<a class="lnkEditKPI" href="" kpi="<?php echo e($accion->KPI); ?>" tipoKPI="<?php echo e($accion->TIPO_KPI); ?>" cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">		                			
		                			<?php echo e(number_format($accion->KPI/1000,0,'.',',')); ?>

		                		</a>
		                		<?php else: ?>		                			
		                			<?php echo e(number_format($accion->KPI/1000,0,'.',',')); ?>

		                		<?php endif; ?>
		                	</td>	
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEjecutivoProducto): ?>
		                		<a class="lnkEditMes" href="" mesActiv="<?php echo e($accion->MES_ACTIVACION); ?>" cliente="<?php echo e($accion->NUM_DOC); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" accion="<?php echo e($accion->ID_ACCION); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">
		                			<?php echo e($accion->MES_ACTIVACION); ?>

		                		</a>
		                		<?php else: ?>
		                			<?php echo e($accion->MES_ACTIVACION); ?>

		                		<?php endif; ?>
		                	</td>
		                			
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEdicion or $permisoAsesoria): ?>
		                		<a href="#" class="lnkNotas" lead="<?php echo e($accion->NUM_DOC); ?>" usuarioRegistro="<?php echo e($accion->NOMBRE_REGISTRO_ACCION); ?>" flgAccion="<?php echo e($accion->FLG_ACCION); ?>" ejecutivo="<?php echo e($usuario->getValue('_registro')); ?>" idAccion="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">+Añadir una nueva nota</a>
		                		<?php else: ?>
		                		<a href="#" class="lnkNotas" lead="<?php echo e($accion->NUM_DOC); ?>" usuarioRegistro="<?php echo e($accion->NOMBRE_REGISTRO_ACCION); ?>" flgAccion="<?php echo e($accion->FLG_ACCION); ?>" ejecutivo="<?php echo e($usuario->getValue('_registro')); ?>" idAccion="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" style="text-decoration: underline;">Visualizar notas</a>
		                		<?php endif; ?>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<a href="<?php echo e(route('be.micontacto.index')); ?>?documento=<?php echo e($accion->NUM_DOC); ?>" style ="padding:8px;"> <i class="fa fa-phone fa-2x" data-toggle="tooltip" title="" data-placement="bottom"  aria-hidden="true"  data-original-title="Contacto"></i></a>
		                	</td>
		                	<td style="vertical-align: middle;text-align: center;">
		                		<?php if($modoEjecutivoProducto): ?>
		                		<a href="#" style ="padding:8px;" id ="btnEliminarAccion"> <i class="fa fa-trash fa-2x btnEliminarAccion" data-toggle="tooltip" title="" documentoE="<?php echo e($accion->NUM_DOC); ?>" accionE="<?php echo e($accion->ID_ACCION); ?>" tooltip="<?php echo e($accion->TOOLTIP); ?>" nombreAccion="<?php echo e($accion->ACCION); ?>" nombreCliente="<?php echo e($accion->NOMBRE_EMPRESA); ?>" data-placement="bottom" aria-hidden="true"  data-original-title="Eliminar"></i></a>
		                		<?php endif; ?>
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
		   	<?php endif; ?>
    	 	<?php echo e($acciones->appends(array_merge($busqueda,$orden))->links()); ?>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarAccion">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Accion Comercial</h4>
            </div>
            <form method="POST" id="frmEliminarAccion" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.eliminar')); ?>">
                <input hidden="" name="documentoE"  id="documentoE" value="">
                <input hidden="" name="accionE"  id="accionE" value="">
                <input hidden="" name="tooltip"  id="tooltip" value="">

                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Nombre del Cliente:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreCliente"  disabled="" style="text-align: center; width: 160%;">
	                        </div>
                    	</div><br><br>   

                    	<div class="col-md-9 col-sm-9 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Acción comercial:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreAccion"  disabled="" style="text-align: center;width: 160%;">
	                        </div>
                    	</div><br><br>

                    	<label class="control-label col-md-3 col-sm-3 col-xs-12">¿Por que eliminas esta acción?</label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="eliminar" id="eliminar" onchange="listaEliminar(this.value)" >
                                <option value="3">No Interesado</option>                                
                                <option value="2">No Califica</option>
                                <option value="1">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col-md-3 col-sm-3 "></div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="xmotivo" id="motivo">
                                <option value="1" >Mala experiencia con IBK</option>
								<option value="2" >Desea productos mas adelante</option>
								<option value="3" >Suficientes Bancos</option>
								<option value="4" >No entrega documentos</option>
								<option value="5" >Tasa / plazo / otras condiciones</option>
								<option value="6" ">No se cuenta con producto requerido</option>
								<option value="7" >Pasivero</option>
                            </select>
                        </div>
						<div class="col-md-3 col-sm-3 "></div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        	</br>
                            <textarea id="comentario" class="form-control" rows="3" placeholder="Escriba su comentario aqui..." name="eliminarComentario"></textarea>
                        </div>                        	

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /.Modal Editar Etapa -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarEtapa">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar Etapa</h4>
            </div>
            <form id="frmEditarEtapa" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.update-etapa')); ?>" method="POST">
                <div class="modal-body">
                    <input class="hidden" name="accion">
                    <input class="hidden" name="cliente">
                    <input class="hidden" name="etapaActual">
                    <input class="hidden" name="tooltip">

                    <div class="form-group">

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Nombre del Cliente:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreCliente"  disabled="" style="text-align: center; width: 100%;">
	                        </div>
                    	</div><br><br>   

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Acción comercial:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreAccion"  disabled="" style="text-align: center;width: 100%;">
	                        </div>
                    	</div><br><br>

                    	<div class="col-md-12 col-sm-12 col-xs-12"> 
	                        <label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Etapa:</label>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                            <select id="cboEtapaAccion" class="form-control" name="etapa" >
	                                <option value="">Elige la nueva etapa</option>
	                                <?php $__currentLoopData = $etapas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etapa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                <option value="<?php echo e($etapa->ID_ETAPA); ?> "  <?php echo e(($etapa->ID_ETAPA == $busqueda['etapa'])? 'selected="selected"':''); ?>>
	                                    <?php echo e($etapa->ETAPA); ?></option>
	                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                            </select>
	                        </div>
                    	</div>
                    	
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Editar Mes Activ-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarMesActiv">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Mes de Activación</h4>
            </div>
            <form id="frmEditarMesActiv" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.update-mes')); ?>" method="POST">
                <div class="modal-body">
                    <input class="hidden" name="accion">
                    <input class="hidden" name="cliente">
                    <input class="hidden" name="mesActiv">
                    <input class="hidden" name="tooltip">

                    <div class="form-group">

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Nombre del Cliente:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreCliente"  disabled="" style="text-align: center; width: 100%;">
	                        </div>
                    	</div><br><br>   

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Acción comercial:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreAccion"  disabled="" style="text-align: center;width: 100%;">
	                        </div>
                    	</div><br><br>

                    	<div class="col-md-12 col-sm-12 col-xs-12"> 
	                        <label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Mes de Activación:</label>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                            <select id="cboMesActivModal" class="form-control" name="mesActivCambio">
	                                <option value="">Elige el mes de Activación</option>	                                
	                                <?php $__currentLoopData = $mesesActivacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                    <option value="<?php echo e($mes->MES); ?>"><?php echo e($mes->MES); ?></option>
                    			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	                
	                            </select>
	                        </div>
                    	</div>
                    	
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarKPI">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Volumen Proyectado Mensual</h4>
            </div>
            <form id="frmEditarKPI" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.update-kpi')); ?>" method="POST">
                <div class="modal-body">
                    <input class="hidden" name="accion">
                    <input class="hidden" name="cliente">
                    <input class="hidden" name="kpi">
                    <input class="hidden" name="tipoKPI">
                    <input class="hidden" name="tooltip">

                    <div class="form-group">

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Nombre del Cliente:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreCliente"  disabled="" style="text-align: center; width: 100%;">
	                        </div>
                    	</div><br><br>   

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Acción comercial:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreAccion"  disabled="" style="text-align: center;width: 100%;">
	                        </div>
                    	</div><br><br>

                    	<div class="col-md-12 col-sm-12 col-xs-12"> 
	                        <label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Volumen Proyectado Mensual: </label>
	                        <div class="col-md-6 col-sm-6 col-xs-6">
	                            <input type="text" class="form-control formatInputNumber" id="kpiModif" name="kpi" style="width: 170px" placeholder="Volumen Proyectado Mensual: (S/ Miles)">
	                        </div>
                    	</div>
                    	
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /.Modal Editar FechaFin -->
<div class="modal fade " tabindex="-1" role="dialog" id="modalEditarFechaFin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Fecha Inicio y Fin</h4>
            </div>
            <form id="frmEditarFechaFin" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.update-fechafin')); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="accion">
                    <input type="hidden" name="cliente">
                    <input type="hidden" name="tipo">


						<div class="form-group divFecha">
		        	        <label class="control-label col-sm-2">Fecha Inicio</label>                
			                <div class="col-sm-4">
			                    <div class="input-group">
			                        <div class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
			                        <input class="form-control dfecha"  type="text" id="txtFecha" name="fInicio" placeholder="Ingresar fecha inicio">
			                    </div>
			                </div>

			                 <label class="control-label col-sm-2">Fecha Fin</label>                
			                <div class="col-sm-4">
			                    <div class="input-group">
			                        <div class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
			                        <input class="form-control dfecha"  type="text" id="txtFecha" name="fFin" placeholder="Ingresar fecha fin">
			                    </div>
			                </div>
			            </div>                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /.Modal Notas -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNotas">
	    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if($modoEdicion or $permisoAsesoria): ?>
                <h4 class="modal-title">Agregar Nota</h4>
                <?php else: ?>
                <h4 class="modal-title">Visualizar Notas</h4>
                <?php endif; ?>
            </div>
                <div class="modal-body">
					<?php $classForm = ''; 
						if (!in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosBE(),\App\Entity\Usuario::getAnalistasInternosBE(),[\App\Entity\Usuario::ROL_JEFATURA_BE],\App\Entity\Usuario::getEjecutivosProductoBE())))
							$classForm = 'hidden';

						if ($permisoAsesoria)
							$classForm = '';
					?>
                	
                	<form method="POST" id="frmAgregarNota" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.nota.agregar')); ?>">

                		<input type="hidden" name="lead" >
                		<input type="hidden" name="idAccion">
                		<input type="hidden" name="tooltip">
                		<input type="hidden" name="ejecutivo" value="<?php echo e($usuario->getValue('_registro')); ?>">
						

						<div class="col-md-12 col-sm-12 col-xs-12 hidden">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right">Accion delegada por:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="usuarioRegistro"  disabled="" style="text-align: center; width: 100%;font-weight: bold;background-color: #A4F0BA">
	                        </div>
	                        <br><br>
                    	</div>

                		<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Nombre del Cliente:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreCliente"  disabled="" style="text-align: center; width: 100%;">
	                        </div>
	                        <br><br> 
                    	</div>  

                    	<div class="col-md-12 col-sm-12 col-xs-12">                    		
	                    	<label class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">Acción comercial:</label>
	                        <div class="col-md-8 col-sm-8 col-xs-8">
	                            <input name="nombreAccion"  disabled="" style="text-align: center;width: 100%;">
	                        </div>
	                        <br><br>
                    	</div>

	                    <div class="form-group  <?php echo e($classForm); ?>">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nota:</label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <textarea class="form-control" rows="3" placeholder="Escribe aqui..." name="nota"></textarea>
	                        </div>
	                    </div>
	                    <div class="form-group  <?php echo e($classForm); ?>">
	                    	<button class="btn btn-success pull-right" type="submit">Guardar</button>
	                    	<button class="btn btn-success pull-right hidden btn-loading" disabled="disabled"><i class="fa fa-spinner fa-spin fa-fw"></i> Guardando</button>
	                    </div>
					</form>
                	
					<div class="ln_solid"></div>

                    <ul id="listaNotas" class="list-unstyled top_profiles scroll-view" style="height: auto;">
                    	<li class="media event cargando-resultados">
							<div class="media-body">
								<p style="text-align: center;"><i class="fa fa-spinner fa-spin fa-fw"></i></p>
							</div>
						</li>
                    	<li class="media event sin-resultados hidden">
							<div class="media-body">
							 	<p style="text-align: center;">No existen notas previas</p> 
							</div>
						</li>
                    </ul>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modal Agregar AccionComercial -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarAccion">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalAgrandar" style="bottom: -300px;right: 200px;width: 300px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ingresar Acción Comercial</h4>

				<div class="alert alert-warning alert-dismissible" id="alertaRep" style="margin-bottom: 0px;margin-top: 20px; font-weight: bold;background-color:#FFFF80;color: black " hidden>				  			  
				</div>

            </div>
            <div class="modal-body">


                <form id="frmNuevaAccionComercial" class="form-horizontal form-label-left" action="<?php echo e(route('be.misacciones.registro-accion')); ?>" method="POST">					
                	<div class="row">
                	<div id="divBusquedaCU" style="width: 250px;margin-left: 20px;">                   		
                        <label class="control-label">Número de CU:</label>
                        <div class="input-group">
                            <input type="text" class="form-control formatInputNumber" placeholder="Ingresar CU" maxlength="11" id="txtCodUnico" name="codUnico">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnBuscarCliente">
                                	<i class="fa fa-spinner fa-spin fa-fw fa-1x margin-bottom hidden"></i>
                                	<i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                	</div>

                    	<div id="divDatosClienteEjecutivo" class="hidden">                    		
	                        <div class="form-group col-md-5">
	                            <label>Nombre</label>
	                            <input class="form-control" readonly="readonly" name="nombre">
	                        </div>                        
	                        <div class="form-group col-md-3">
	                            <label>Ejecutivo</label>
	                            <input class="form-control" readonly="readonly" name="nomEjecutivo">
	                        </div>
                    	</div>
                    </div>

                    	<input class="hidden" id="numDocBuscar" readonly="readonly" name="numDoc">
                    	<br>
                    <div id="divNuevaAccionCliente" class="hidden">     

                    	<?php $__currentLoopData = $accionesEstrategia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estrategia =>$acciones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<?php if($estrategia=="CRECER EN COLOCACIONES" && ($modoEjecutivoProducto || $permisoAsesoria)): ?>
                    		<?php continue; ?>
                    	<?php else: ?>
                    	<div class="row">
                    		
                    		<div class="col-md-2" style="vertical-align: middle">
	                        	<?php if($estrategia=="CRECER EN COLOCACIONES"): ?>
	                    			<div class="x_panel" style="text-align: center;height: 132px">
	                    		<?php elseif($estrategia=="RENTABILIZAR CLIENTES"): ?>
	                    			<div class="x_panel" style="text-align: center;height:322px ">
	                    		<?php else: ?>
	                    			<div class="x_panel" style="text-align: center;height:172px ">
	                    		<?php endif; ?>
	                    			<div id="tituloEstrategia">
	                        		<div  class="titEstrategia" ><?php echo e($estrategia); ?></div>
	                        		<div class="titEstrategia" style="color:#C70039;">+KPI: <?php echo e($acciones[0]->TIPO_KPI); ?></div>      		
	                        		<?php if($acciones[0]->TIPO_KPI!="TX"): ?><div class="titEstrategia" style="color: #C70039">(MILES DE S/)</div><br><?php endif; ?>
	                        		</div>                        		
	                        	</div>                    			
                    		</div>

                    		<div class="col-xs-10 col-md-10">
	                        	<div class="x_panel paddingXPanel" style="">
	                        		<?php $__currentLoopData = $acciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        			<?php if(($acc->NOMBRE=="CAMBIOS - SPOT/DERIVADOS" ||$acc->NOMBRE=="INVESTMENT BANKINGS (FEES)") && 
	                        			($modoEjecutivoProducto|| $permisoAsesoria)): ?>
	                        				<?php continue; ?>
	                        			<?php else: ?>
	                        			<?php if($estrategia=="CRECER EN COLOCACIONES"): ?>
	                        			<div id="accionX" class="col-xs-2 col-md-2" style="height: 120px">
	                        			<?php else: ?> 
	                        			<div id="accionX" class="col-xs-2 col-md-2" style="height: 150px">
	                        			<?php endif; ?>
		                        			<div class="form-check form-group" id="divCheck" style="margin-bottom: 0px">
											    <label class="form-check-label tamForm"  >
											    <input type="checkbox" class="form-check-input checkAccion" id="checkAccion" name="checkAccion[]" value="<?php echo e($acc->ID_CAMP_EST); ?>" >			
											    	<?php echo e($acc->NOMBRE); ?></label>
											</div>
		                        			<?php if($modoEjecutivo or $modoAnalista or $permisoAsesoria): ?>
												<?php if($estrategia!="CRECER EN COLOCACIONES" && $acc->NOMBRE!="CAMBIOS - SPOT/DERIVADOS" && $acc->NOMBRE!="INVESTMENT BANKINGS (FEES)"): ?>	
												<div class="divDelegado form-group" id="divDelegado">													
																					
													<select id="cboDelegado" class="form-control cboDelegado tamForm paddingForm" name="cboDelegado[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  disabled>
														<?php if($permisoAsesoria): ?>			                    					
				                    							<option value="">SELECCIONE CASH</option>
				                    					<?php else: ?>
				                    							<option value="NO DELEGAR">NO DELEGAR</option>
				                    					<?php endif; ?>
								                    	<?php $__currentLoopData = $eProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                            			<option value="<?php echo e($ejecutivo->REGISTRO); ?>"><?php echo e($ejecutivo->NOMBRE); ?></option>
				                        				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                        				</select>
												</div>
													
												<?php endif; ?>
		                        			<?php endif; ?>

											<?php if(!$permisoAsesoria): ?>
			                        			<?php if($estrategia!="CRECER EN COLOCACIONES" && $acc->NOMBRE!="CAMBIOS - SPOT/DERIVADOS" && $acc->NOMBRE!="INVESTMENT BANKINGS (FEES)"): ?>

				                        			<?php if($modoEjecutivo or $modoAnalista): ?>
				                        			<div id="inputKPI" class="form-group">
														
					                        			<input type="text" class="form-control formatInputNumber hidden tamForm paddingForm kpiAccion" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
				                        			</div>
				                        			
														<div class ="form-group" id="divFechaFin2">						
										                    <div class="input-group divFechaFin hidden" id="divFechaFin" style="width: 150px;">               
											                    <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar" for="txtFechaFin"></i></div>
											                    <input class="form-control dfecha fechaFin"  type="text" id="txtFechaFin" name="fFin[<?php echo e($acc->ID_CAMP_EST); ?>]" placeholder="Ingresar fecha fin" style="font-size: 11px;height:25px;padding-right: 10px;" disabled>
												            </div>
														</div>
														
													<?php else: ?>
													<div id="inputKPI" class="form-group">
															
					                        			<input type="text" class="form-control formatInputNumber tamForm paddingForm kpiAccion" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;" placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
				                        			</div>
				                        			
													<?php endif; ?>
												<?php else: ?>
													<div id="inputKPI" class="form-group">
														
					                        			<input type="text" class="form-control formatInputNumber tamForm paddingForm kpiAccion" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
				                        			</div>
				                        			

				                        			<?php if($modoEjecutivo or $modoAnalista): ?>
														<div class ="form-group" id="divFechaFin2">												
					                        					
										                    <div class="input-group" id="divFechaFin" style="width: 150px;">	        	                     
											                    <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
											                    <input class="form-control dfecha fechaFin"  type="text" id="txtFechaFin" name="fFin[<?php echo e($acc->ID_CAMP_EST); ?>]" placeholder="Ingresar fecha fin" style="font-size: 11px;height:25px;padding-right: 10px;" disabled>
												            </div>
														</div>
														
													<?php endif; ?>
												<?php endif; ?>

												<?php if(!$modoEjecutivo and !$modoAnalista): ?>
													<div class="" id="divMesActivacion">												
				                        					
									                    <div class="form-group">				        	                     
															<select id="cboMesActiv" class="form-control tamForm paddingForm cboMesActiv" style="padding-right: 10px;" name="cboMesActiv[<?php echo e($acc->ID_CAMP_EST); ?>]" disabled>
						                    					<option value="">Elegir Mes</option>
						                    					<?php $__currentLoopData = $mesesActivacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                            			<option value="<?php echo e($mes->MES); ?>"><?php echo e($mes->MES); ?></option>
					                        					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				                    	
					                        				</select>
											            </div>
													</div>
												<?php endif; ?>		
											<?php endif; ?>									
	                        			</div>
	                        		<?php endif; ?>
	                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php if($estrategia!="CRECER EN COLOCACIONES"): ?>
                    			    
                    			   	<div class="form-group col-xs-4 col-md-4" style="height: 150px">
			                        <label class="control-label">Nota:</label>
			                        <div class="">
			                            <textarea class="form-control" rows="6" placeholder="Escribe aqui..." name="notaAccion[<?php echo e($estrategia); ?>]" id="notaAccion" disabled></textarea>
			                        </div>
                    			   	</div>
                    				<?php endif; ?>
	                        	</div>
                        	</div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    	
                    
                    <div class="clearfix"></div>
                    <div id="botonesAgregarAccion" class="modal-footer hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="btnGuardarAcciones" class="btn btn-success" type="submit" disabled>Guardar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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

<?php $__env->startSection('js-scripts'); ?>

<?php if(session('popUpLogueo') && $modoComunicacion): ?>
	<script type="text/javascript">
		$('#modalComunicacion').modal();
	</script>
<?php endif; ?>

<script>

 	function revalidateFechas(){
        for (var i = 50; i < 67; i++) {
            $('#frmNuevaAccionComercial').formValidation('revalidateField', 'fFin['+i+']');
        }
        
    }

    function revalidateFormAccionComercial(){
        revalidateFechas();
        for (var i = 50; i < 67; i++) {            
            $('#frmNuevaAccionComercial').formValidation('revalidateField', 'kpiAccion['+i+']');        
            $('#frmNuevaAccionComercial').formValidation('revalidateField', 'cboMesActiv['+i+']');        
        }
    }

	function updateEstrella(cliente,accion,tooltip){

	    $.ajax({
                url: APP_URL + 'be/misacciones/update-estrella',
                type: 'POST',
                data:{ cliente:cliente,
                	  accion:accion,
                	  tooltip:tooltip
                },
                success: function (result) {
                         console.log('Hola ajax');
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al actualizar la estrella');
                }
        });
	}

	function getEtapasAccion(accion){

		var cboEtapaAccion = $('#cboEtapaAccion');
    	cboEtapaAccion.find('option:not(:first)').remove();

		$.ajax({
            	type: "GET",
            	data: {
            		accion: accion
            	},
            	url: APP_URL + 'be/utils/get-etapas-by-accion',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboEtapaAccion.append($("<option></option>")
            				.attr("value", value.ID_ETAPA).text(value.ETAPA));
            		});            		
            	}
            });
    }


	function initializeFormEditarEtapa() {		
        $('#frmEditarEtapa').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                etapa: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una etapa'
                        },
                        callback: {
                            message: 'La etapa seleccionada es la misma a la actual',
                            callback: function (value, validator, $field) {
                                return value != $('input[name="etapaActual"').val();
                            }
                        }
                    }
                }
            }
        })
		.off('success.form.fv')
        .on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
                    fv = $form.data('formValidation');
            $form.formValidation('disableSubmitButtons', true);


            // Enviamos el formulario en ajax, si todo sale bien Cambiamos el estado
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    $('#modalEditarEtapa').modal('hide');
                    $form.formValidation('destroy', true);
                    link = $('.lnkEditEtapa[lead="' + $form.find('input[name="lead"]').val() + '"]');                   
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al actualizar la etapa, inténtelo mas tarde');
                }
            });
        });
    }


    function listaEliminar(tipo) {

        $('#motivo option').remove();

        $("#motivo").css("display", "block");
        $("#comentario").css("display", "block");

        if (tipo == "1") {
        	$("#motivo").css("display", "none");
            //$("#comentario").css("display", "block");           
        }

        if (tipo == "2") {
            $('#motivo').append('<option value="1" >Cumplimiento</option>');
            $('#motivo').append('<option value="2" >Situación Financiera</option>');
            $('#motivo').append('<option value="3" >Cáracter</option>');
            //$("#comentario").css("display", "block");    
        }

        if (tipo == "3") {
            $('#motivo').append('<option value="1" >Mala experiencia con IBK</option>');
            $('#motivo').append('<option value="2" >Desea productos mas adelante</option>');
            $('#motivo').append('<option value="3" >Suficientes Bancos</option>');
            $('#motivo').append('<option value="4" >No entrega documentos</option>');
            $('#motivo').append('<option value="5" >Tasa / plazo / otras condiciones</option>');
            $('#motivo').append('<option value="6" ">No se cuenta con producto requerido</option>');
            $('#motivo').append('<option value="7" >Pasivero</option>');
           //$("#comentario").css("display", "block");    
        }

    }

    
    $(document).ready(function () {

    	// Estrella de ejecutivo
        $("table .glyphicon-star").popover({ 
            trigger: "manual" ,
            html : true,
            content: function() {
                return $('#templatePopoverTag').html();
            } 
        }).on("mouseenter", function () {
            var _this = this;
            var rol=$(_this).attr('rol');
            if (rol==20){
	            var colorActual= $(_this).attr('style').substring(24);
	            //console.log(colorActual);
	            if (colorActual=='rgb(241, 196, 15);'){
	            	//console.log("Cambiamos a gris");
	            	$(_this).css('color','rgb(128, 128, 128)');
	            }
	            else if (colorActual=='rgb(128, 128, 128);'){
	            	//console.log("Cambiamos a amarillo");
	            	$(_this).css('color','rgb(241, 196, 15)');
	            }
            }
        }).on("mouseleave", function () {
            var _this = this;
            var rol=$(_this).attr('rol');
            if (rol==20){
	            var colorActual= $(_this).attr('style').substring(24);
	            //console.log(colorActual);
	            if (colorActual=='rgb(241, 196, 15);'){
	            	//console.log("Cambiamos a gris");
	            	$(_this).css('color','rgb(128, 128, 128)');
	            }
	            else if (colorActual=='rgb(128, 128, 128);'){
	            	//console.log("Cambiamos a amarillo");
	            	$(_this).css('color','rgb(241, 196, 15)');
	            }
        	}
            
        }).on("click", function () {
        	var _this = this;
        	var rol=$(_this).attr('rol');
        	if (rol==20){
	            var cliente=$(_this).attr('cliente');
	            var accion=$(_this).attr('accion');
	            var tooltip=$(_this).attr('tooltip');

	            updateEstrella(cliente,accion,tooltip);

	            var colorActual= $(_this).attr('style').substring(24);
	            //console.log(colorActual);
	            if (colorActual=='rgb(241, 196, 15);'){
	            	//console.log("Cambiamos a gris");
	            	$(_this).css('color','rgb(128, 128, 128)');
	            }
	            else if (colorActual=='rgb(128, 128, 128);'){
	            	//console.log("Cambiamos a amarillo");
	            	$(_this).css('color','rgb(241, 196, 15)');
	            }
            }
        });


		$('.checkAccion').change(function(){		

			if($(this).attr('checked')!=undefined){
				$(this).closest('div').parent().find('#cboDelegado').attr('disabled',true);
				$(this).closest('div').parent().find('#kpiAccion').attr('disabled',true);
				$(this).closest('div').parent().find('#txtFechaFin').attr('disabled',true);
				$(this).closest('div').parent().find('#cboMesActiv').attr('disabled',true);

				$(this).removeAttr('checked');
				
				if($(this).closest('div').parent().find('#cboDelegado').val()!=undefined){	
					$(this).closest('div').parent().find('#kpiAccion').addClass('hidden');
					$(this).closest('div').parent().find('#divFechaFin').addClass('hidden');
				}
				$('#btnGuardarAcciones').removeAttr('disabled');
				$('#btnGuardarAcciones').removeClass('disabled');
				$("#alertaRep").attr('hidden',true);

				$('#frmNuevaAccionComercial').formValidation('destroy', true);
                initializeFormAccionComercial();
                revalidateFormAccionComercial();
				$(this).closest('div').parent().find('#kpiAccion').val('');
				$(this).closest('div').parent().find('#txtFechaFin').val('');

			}else{			
				$(this).attr('checked',true);
				$(this).closest('div').parent().find('#cboDelegado').removeAttr('disabled');
				$(this).closest('div').parent().find('#kpiAccion').removeAttr('disabled');
				$(this).closest('div').parent().find('#txtFechaFin').removeAttr('disabled');
				$(this).closest('div').parent().find('#cboMesActiv').removeAttr('disabled');	

				if($(this).closest('div').parent().find('#cboDelegado').val()=="NO DELEGAR"){	
					$(this).closest('div').parent().find('#kpiAccion').removeClass('hidden');
					$(this).closest('div').parent().find('#divFechaFin').removeClass('hidden');
				}
				$('#btnGuardarAcciones').removeAttr('disabled');
				$('#btnGuardarAcciones').removeClass('disabled');
				$("#alertaRep").attr('hidden',true);

			  }	

			if($('.checkAccion:checked').length==0){
           		$('#btnGuardarAcciones').attr('disabled',true);
           		$(this).closest('div').parent().parent().find('#notaAccion').attr('disabled',true);
        	}else{         
           		$(this).closest('div').parent().parent().find('#notaAccion').removeAttr('disabled');
        	}

		});


		$('.cboDelegado').change(function(){			

			if($(this).val()=="NO DELEGAR"){
				//Mostrar KPI y mostrar Fecha inicio
				$(this).closest('div').parent().find('#kpiAccion').removeClass('hidden');
				$(this).closest('div').parent().find('#divFechaFin').removeClass('hidden');
			}
			else{
				//No mostrar nada
				$(this).closest('div').parent().find('#kpiAccion').addClass('hidden');
				$(this).closest('div').parent().find('#divFechaFin').addClass('hidden');
			}
						

		});


		

        $('.formatInputNumber').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });


        $('[data-toggle="tooltip"]').tooltip();



        $('.dfecha').each(function() {
                    $(this).datepicker({
                        maxViewMode: 1,
                        daysOfWeekDisabled: "0,6",
                        language: "es",
                        autoclose: true,
                        startDate: "+1d",
                        endDate: "+365d",
                        format: "yyyy-mm-dd",
                    })
                     .on('changeDate', function(e) {
            // Revalidate the date field
            	revalidateFechas();            	
        	});
        });


        /************** ACTUALIZAR ETAPA *****************/

        /* Modal Editar Etapa*/
        $('.lnkEditEtapa').click(function (e) {
            e.preventDefault();
            $('#frmEditarEtapa input[name="etapaActual"]').val($(this).attr('etapa'));
            $('#frmEditarEtapa input[name="accion"]').val($(this).attr('accion'));
            $('#frmEditarEtapa input[name="cliente"]').val($(this).attr('cliente'));
            $('#frmEditarEtapa input[name="tooltip"]').val($(this).attr('tooltip'));
            $('#frmEditarEtapa input[name="nombreAccion"]').val($(this).attr('nombreAccion'));
            $('#frmEditarEtapa input[name="nombreCliente"]').val($(this).attr('nombreCliente'));
            $('#modalEditarEtapa').modal();            
            getEtapasAccion($(this).attr('accion'));
            //initializeFormEditarEtapa();
        });

        /*Modal Editar KPI*/
        $('.lnkEditKPI').click(function (e) {
            e.preventDefault();
            $('#frmEditarKPI input[name="kpi"]').val($(this).attr('kpi'));
            $('#frmEditarKPI input[name="accion"]').val($(this).attr('accion'));
            $('#frmEditarKPI input[name="cliente"]').val($(this).attr('cliente'));
            $('#frmEditarKPI input[name="tooltip"]').val($(this).attr('tooltip'));
            $('#frmEditarKPI input[name="nombreAccion"]').val($(this).attr('nombreAccion'));
            $('#frmEditarKPI input[name="nombreCliente"]').val($(this).attr('nombreCliente'));
            $('#modalEditarKPI').modal();            
        });

        /* Modal Editar Mes Activación*/
        $('.lnkEditMes').click(function (e) {
            e.preventDefault();
            $('#frmEditarMesActiv input[name="mesActiv"]').val($(this).attr('mesActiv'));
            $('#frmEditarMesActiv input[name="accion"]').val($(this).attr('accion'));
            $('#frmEditarMesActiv input[name="cliente"]').val($(this).attr('cliente'));
            $('#frmEditarMesActiv input[name="tooltip"]').val($(this).attr('tooltip'));
            $('#frmEditarMesActiv input[name="nombreAccion"]').val($(this).attr('nombreAccion'));
            $('#frmEditarMesActiv input[name="nombreCliente"]').val($(this).attr('nombreCliente'));
            $('#frmEditarMesActiv input[name="tipoKPI"]').val($(this).attr('tipoKPI'));
            $('#modalEditarMesActiv').modal();          
        });

        /************* ACTUALIZAR FECHA FIN *************/
         $('.lnkEditFecha').click(function (e) {
            e.preventDefault();
            $('#frmEditarFechaFin input[name="accion"]').val($(this).attr('accion'));
            $('#frmEditarFechaFin input[name="tipo"]').val($(this).attr('tipo'));            
            $('#frmEditarFechaFin input[name="fInicio"]').val($(this).attr('fInicio'));
            $('#frmEditarFechaFin input[name="fFin"]').val($(this).attr('fFin'));
            $('#frmEditarFechaFin input[name="cliente"]').val($(this).attr('cliente'));
            $('#modalEditarFechaFin').modal();         
            
        });
  

        /************** AGREGAR NUEVA ACCION *****************/
        $('#btnAgregarAccionComercial').click(function (e) {

            $('#frmNuevaAccionComercial').trigger("reset");           
            $('input:checkbox').removeAttr('checked');
            $('.cboDelegado').attr('disabled',true);
			$('.kpiAccion').attr('disabled',true);
			$('.fechaFin').attr('disabled',true);
			$('.cboMesActiv').attr('disabled',true);

        	$('#modalAgrandar').removeClass('grande');
            $('#modalAgrandar').addClass('pequenho');
			$('#divBusquedaCU').removeClass('col-md-2');
			$('#divDatosClienteEjecutivo').addClass('hidden');
            $('#frmNuevaAccionComercial input[type="text"]').val('');                    
            $('#divNuevaAccionCliente').addClass('hidden');
            $('#frmNuevaAccionComercial .modal-footer').addClass('hidden');
            $('#modalAgregarAccion').modal(); 
            $("#alertaRep").attr('hidden',true);
            //$('#btnGuardarAcciones').attr('disabled',true);
            //revalidateFechas();
            //initializeFormAccionComercial();           
        });

        /************** ELIMINAR LEAD *****************/
        $('.btnEliminarAccion').click(function (e) {
            $('#modalEliminarAccion').modal();
            $('#modalEliminarAccion #documentoE').val($(this).attr('documentoE'));
            $('#modalEliminarAccion #accionE').val($(this).attr('accionE'));
            $('#modalEliminarAccion #tooltip').val($(this).attr('tooltip'));
            $('#modalEliminarAccion input[name="nombreAccion"]').val($(this).attr('nombreAccion'));
            $('#modalEliminarAccion input[name="nombreCliente"]').val($(this).attr('nombreCliente'));
            initializeFormEliminarAccion();
        });

        /************** BUSCAR CLIENTE *****************/
        $('#txtCodUnico').keypress(function (e) {
            //enter
            if (e.which == 13) {
                BuscarCliente($(this));
            }
        });

        $('#btnBuscarCliente').click(function (e) {
            BuscarCliente($(this));
        });

        /****** AGREGAR NOTA ******/
		$('.lnkNotas').click(function (e) {
			e.preventDefault();
            nuevoModalNotas($(this).attr('ejecutivo'),$(this).attr('lead'),$(this).attr('idAccion'),$(this).attr('tooltip'),
            	$(this).attr('nombreAccion'),$(this).attr('nombreCliente'),$(this).attr('usuarioRegistro'),$(this).attr('flgAccion'));

        });

        $('#frmNuevaAccionComercial').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
		    e.preventDefault();
		    return false;
		  }
		});
		

    /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
 		if ($('#cboBanca').length > 0){
            cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboProducto').val());
        }else{
            if ($('#cboZonal').length > 0){
                cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboProducto').val());    
            }
            else{
              if ($('#cboJefatura').length > 0){
                cboJefaturaChange($('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboZonal').val());    
              }
            }            
        }
        
        $('#cboJefatura').change(function(){
            cboJefaturaChange($(this).val(),null,null);
        });

        $('#cboZonal').change(function(){
            cboZonalChange($(this).val(),null,null,null);
        });


        $('#cboBanca').change(function(){
            cboBancaChange($(this).val(),null,null,null,null);
        });


             /****** ESTRATEGIA - ACCION - ETAPA ******/
 		if ($('#cboEstrategia').length > 0){
            cboEstrategiaChange($('#cboEstrategia').val(),$('#cboAccion').val(),$('#cboEtapa').val());
        }else{
            if ($('#cboAccion').length > 0){
                cboAccionChange($('#cboAccion').val(),$('#cboEtapa').val());    
            }             
        }        
       
        $('#cboAccion').change(function(){
            cboAccionChange($(this).val(),null);
        });

        $('#cboEstrategia').change(function(){
            cboEstrategiaChange($(this).val(),null,null);
        });

        $("#frmNuevaAccionComercial").submit(function(event) {
        	var j=0;
		    var checks=[];
		      	for (var i = 0; i < $('.checkAccion').length; i++) {
	      			if($('.checkAccion')[i].checked){
	      				checks[j]=$('.checkAccion')[i].value;
	      				j++;
	      			}                		
                }
        	var numDocBuscar=$(this).find('#numDocBuscar').val();
        	//console.log(cargarCliente(numDocBuscar,checks));
        	if(cargarCliente(numDocBuscar,checks)==true)
		        return false;		      
		   	else
		        return true;			
		  
		});


    });

	function cboDelegadoChange(zonal){
		var cboDelegado =$('.cboDelegado');

		cboDelegado.find('option:not(:first)').remove();

		$.ajax({
            	type: "GET",
            	data: {
            		zonal: zonal            		
            	},
            	url: APP_URL + 'be/utils/get-productos-by-zonal',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboDelegado.append($("<option></option>")
            				.attr("value", value.REGISTRO).text(value.NOMBRE));
            		});
            		
            	}
            });

	}
	/****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
	function cboJefaturaChange(jefatura,ejecutivo,zonal) {

		
	 	var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de ejecutivos
            cboEjecutivo.find('option:not(:first)').remove();
            
            //Si selecciona cualquier otro resultado
            cboEjecutivo.prop('disabled', true);
            $.ajax({
            	type: "GET",
            	data: {
            		jefatura: jefatura,
            		zonal: zonal
            	},
            	url: APP_URL + 'be/utils/get-ejecutivos-by-jefatura',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboEjecutivo.append($("<option></option>")
            				.attr("value", value.REGISTRO).text(value.NOMBRE));
            		});
            		if (ejecutivo){
            			cboEjecutivo.val(ejecutivo);
            		}
            		cboEjecutivo.prop('disabled', false);
            	}
            });
        }

    function cboZonalChange(zonal,jefatura,ejecutivo,producto) {
    		
        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');
        	var cboProducto = $('#cboProducto');

            //Limpiamos el combobox de ejecutivos
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboProducto.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            //cboProducto.val('');
            
            //Si no selecionada nada como resultado
            if (!zonal) {
            	cboJefatura.val('');
            	cboProducto.val('');
            	cboJefatura.prop('disabled', false);
            	cboProducto.prop('disabled', false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboJefatura.prop('disabled', true);
            cboProducto.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true);

            $.ajax({
            	type: "GET",
            	data: {zonal: zonal},
            	url: APP_URL + 'be/utils/get-productos-by-zonal',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboProducto.append($("<option></option>")
            				.attr("value", value.REGISTRO).text(value.NOMBRE));
            		});
            		if (producto){
            			cboProducto.val(producto);
            		}
            		cboProducto.prop('disabled', false);
            	}
            });


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
            		cboJefaturaChange(jefatura,ejecutivo,zonal);
            	}
            });
    }    

    function cboBancaChange(banca,zonal,jefatura,ejecutivo,producto) {
    		var cboZonal = $('#cboZonal');
        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');
        	var cboProducto = $('#cboProducto');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboProducto.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            cboProducto.val('');
            
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
            		cboZonalChange(zonal,jefatura,ejecutivo,producto);
            	}
            });
    }    
    
  
	/****** ESTRATEGIA - ACCION - ETAPA ******/	
    function cboAccionChange(accion,etapa) {
        	var cboEtapa = $('#cboEtapa');        	

            //Limpiamos el combobox de ejecutivos
            cboEtapa.find('option:not(:first)').remove();

            
            //Si no selecionada nada como resultado
            if (!accion) {
            	cboEtapa.val('');
            	cboEtapa.prop('disabled', false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboEtapa.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true);
            return $.ajax({
            	type: "GET",
            	data: {accion: accion},
            	url: APP_URL + 'be/utils/get-etapas-by-accion',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboEtapa.append($("<option></option>")
            				.attr("value", value.ID_ETAPA).text(value.ETAPA));
            		});

            		if (etapa){
            			cboEtapa.val(etapa);
            		}
            		cboEtapa.prop('disabled', false);            		
            	}
            });
    }    

    function cboEstrategiaChange(estrategia,accion,etapa) {
    		var cboAccion = $('#cboAccion');
        	var cboEtapa = $('#cboEtapa');        	

            //Limpiamos el combobox de etapas
            cboAccion.find('option:not(:first)').remove();
            cboEtapa.find('option:not(:first)').remove();            
            cboEtapa.val('');
            
            //Si no selecionada nada como resultado
            if (!estrategia) {
            	cboAccion.val('');
            	cboAccion.prop('disabled',false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboAccion.prop('disabled', true);

            return $.ajax({
            	type: "GET",
            	data: {estrategia: estrategia},
            	url: APP_URL + 'be/utils/get-acciones-by-estrategia',
            	dataType: 'json',
            	success: function (json) {
            		console.log(estrategia);
            		$.each(json, function (key, value) {
            			cboAccion.append($("<option></option>")
            				.attr("value", value.ID_ACCION).text(value.ACCION));
            		});
            		if (accion){
            			cboAccion.val(accion);
            		}
            		cboAccion.prop('disabled', false);
            		cboAccionChange(accion,etapa);
            	}
            });
    }    
   		
    /****** BUSCAR ACCION COMERCIAL ******/
    function BuscarCliente(button) {

            var codUnico = $('#txtCodUnico').val();
            form = $('#frmNuevaAccionComercial');
            item = button.find('.fa-search');
            item.addClass('hidden').prev().removeClass('hidden');


            $.ajax({
                url: APP_URL + 'be/misacciones/consulta-cliente',
                type: 'GET',
                data: {
                    codUnico: codUnico
                },
                success: function (result) {
                    $('#frmNuevaAccionComercial .modal-footer').removeClass('hidden');
                    //vform = initializeFormAccionComercial();
                    
                    if (result.existe == 'si') {
                        $('#divDatosClienteEjecutivo').removeClass('hidden');
                        $('#divNuevaAccionCliente').removeClass('hidden');
                        //$('#btnGuardarAcciones').removeAttr('disabled');
                        //console.log(result.data['ZONA']);
                        cboDelegadoChange(result.data['ZONA']);
                        //Vamos a modificar los tamaños del formulario
                        $('#modalAgrandar').removeAttr('style');
                        $('#modalAgrandar').removeClass('pequenho');
                        $('#modalAgrandar').addClass('grande');
                        $('#divBusquedaCU').addClass('col-md-2');
                        $('#divDatosClienteEjecutivo').addClass('col-md-9');
                        $('#botonesAgregarAccion').removeClass('hidden');
                        form.find('input[name="codUnico"]').val(result.data['COD_UNICO']);
                        form.find('input[name="nombre"]').val(result.data['NOMBRE']);
                        form.find('input[name="numDoc"]').val(result.data['NUM_DOC']);             
                        form.find('input[name="nomEjecutivo"]').val(result.data['NOMBRE_EJECUTIVO']);
                        
                        var numDoc=result.data['NUM_DOC'];
                    	$('#frmNuevaAccionComercial').formValidation('destroy', true);
                    	initializeFormAccionComercial();             
                    	$('#btnGuardarAcciones').attr('disabled',true);      	
                        
                    } else {
                        $('#divNuevaAccionCliente').addClass('hidden');
                    }
                    item.removeClass('hidden').prev().addClass('hidden');

                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el consultar la información, inténtelo mas tarde');
                    item.removeClass('hidden').prev().addClass('hidden');
                }
            });
    }


    /****** FORM NUEVA ACCION COMERCIAL ******/
	function initializeFormAccionComercial() {
		//console.log('Ingresamos al form validation');
		
    	return $('#frmNuevaAccionComercial').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				'kpiAccion[50]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[51]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[52]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[53]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[54]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[55]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[56]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[57]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[58]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[59]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[60]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[61]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[62]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[63]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[64]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[65]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'kpiAccion[66]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese el KPI de la empresa'
				        },
				    }
				},
				'fFin[50]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[51]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[52]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[53]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[54]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[55]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[56]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[57]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[58]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[59]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[60]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[61]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[62]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[63]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[64]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[65]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'fFin[66]': {
				    validators: {
				        notEmpty: {
				            message: 'Ingrese la fecha fin'
				        },
				        date: {
				            format: 'YYYY-MM-DD',
				            message: 'Ingrese una fecha válida',
				        }
				        
				    }
				},
				'cboMesActiv[50]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				},
				'cboMesActiv[51]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				},
				'cboMesActiv[52]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[53]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[54]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[55]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[56]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[57]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[58]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[59]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[60]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[61]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[62]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[63]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[64]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[65]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				}, 
				'cboMesActiv[66]': {
				    validators: {
				        notEmpty: {
				            message: 'Debe de seleccionar un mes de activación'
				        },
				    }
				},         
              
            },
        })
		.off('success.form.fv');  

    }

    function initializeFormEliminarAccion() {
		
    	return $('#frmEliminarAccion').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				'eliminarComentario': {
				    validators: {
				        notEmpty: {
				            message: 'Debes ingresar un comentario'
				        },
				        stringLength: {
                            max: 300,
                            message: 'El comentario debe tener como máximo 300 caracteres'
                        },
				        stringLength: {
                            min: 30,
                            message: 'El comentario debe tener como mínimo 30 caracteres'
                        }
				    }
				},	        			
            },
        })
		.off('success.form.fv');  

}

    function cargarCliente(numDoc,checks){
    	//document.write(idAccion);
    	var bool=false;
    	$.ajax({
                url: "<?php echo e(route('be.misacciones.acciones-cliente')); ?>",     
                async: false,           
                type: 'GET',
                data: {
                	numDoc: numDoc,
                	checks: checks                	
                },
                success: function (result) {
                   	//console.log("HOLA");
                   	if (result.length == 0)
                   		bool=false;
                   	else{
                   		bool=true;

	                   	var accionesRepetidas="";

	                   	for (var i = 0; i < result.length-1; i++) {
	                   		accionesRepetidas=accionesRepetidas+result[i]['ACCION']+", ";
	                   	}                	
	                   		accionesRepetidas=accionesRepetidas+result[result.length-1]['ACCION'];

	                   	$("#alertaRep").removeAttr('hidden');
    					$("#alertaRep").text("OBSERVACIÓN: El cliente seleccionado ya tiene la(s) siguiente(s) accion(es) comercial(es): "+
    							accionesRepetidas+". Inténtelo nuevamente.");
                   	}
                  	
                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al consultar a base de datos');
                }
            });
    	return bool;
    }

    /****** NOTAS *****/
    function nuevoModalNotas(ejecutivo,lead,idAccion,tooltip,nombreAccion,nombreCliente,usuarioRegistro,flgAccion){
    	initializeFormNota(ejecutivo,lead,idAccion,tooltip,nombreAccion,nombreCliente,usuarioRegistro,flgAccion);
    	$('#listaNotas .sin-resultados').addClass('hidden');
    	$('#listaNotas .cargando-resultados').removeClass('hidden');
    	$('#listaNotas .item-nota').remove()
    	$('#modalNotas').modal();
    	cargarNotas(ejecutivo,lead,idAccion,tooltip);
    }

    function initializeFormNota($ejecutivo,$lead,$idAccion,$tooltip,$nombreAccion,$nombreCliente,$usuarioRegistro,$flgAccion){
    	$('#frmAgregarNota input[name="lead"]').val($lead);
    	$('#frmAgregarNota input[name="idAccion"]').val($idAccion);
    	$('#frmAgregarNota input[name="tooltip"]').val($tooltip);
    	$('#frmAgregarNota input[name="nombreAccion"]').val($nombreAccion);
    	$('#frmAgregarNota input[name="nombreCliente"]').val($nombreCliente);
    	$('#frmAgregarNota input[name="usuarioRegistro"]').val($usuarioRegistro);
    	if($flgAccion==1){    		
    		$('#frmAgregarNota input[name="usuarioRegistro"]').parent().parent().removeClass('hidden');
    	}
    	$('#frmAgregarNota textarea').val('');
    	var form = $('#frmAgregarNota').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nota: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una nota'
                        },
                        stringLength:{
                        	message: 'La longitud máxima es de 500 caracteres',
                        	max: 500,
                        }
                    }
                }
            }
        })
		.off('success.form.fv')
        .on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
                    fv = $form.data('formValidation');

            $form.formValidation('disableSubmitButtons', true);
            $form.find('.btn-success').addClass('hidden').end().find('.btn-loading').removeClass("hidden");

            $form.find()
            // Enviamos el formulario en ajax, si todo sale bien Cambiamos el estado
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    $('#frmAgregarNota textarea').val('');

                    $form.find('.btn-success').removeClass('hidden').end().find('.btn-loading').addClass("hidden");
                    $form.formValidation('disableSubmitButtons', false);

                    $('#listaNotas .sin-resultados').addClass('hidden');
                    html = '';
                    html += '<li class="media event item-nota">';
					html += '<p><strong>'+ result.NOMBRE_EJECUTIVO+' - '+result.FECHA_REGISTRO.substring(0,16) + '</strong><br>' + result.NOTA + '</p>';
					html+='<div align="right"><a class="fa fa-trash fa-2x" href="#" idnota ="'+result.NOTA_ID+'" registro="'+result.REGISTRO_EN+'" numdoc="'+result.NUM_DOC+'" onClick="eliminarNota(this)"></div></a>'
					html += '</li>';
					$('#listaNotas').prepend(html);
					$form.data('formValidation').resetForm();
					console.log($form);
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                    $form.find('.btn-success').removeClass('hidden').end().find('.btn-loading').addClass("hidden");
                    $form.formValidation('disableSubmitButtons', false);
                }
            });
        });
        form.data('formValidation').resetForm();
    }

    function cargarNotas(ejecutivo,lead,idAccion,tooltip){
    	//document.write(holis);
    	$.ajax({
                url: "<?php echo e(route('be.misacciones.nota.listar')); ?>",                
                type: 'GET',
                data: {
                	lead: lead,
                	ejecutivo: ejecutivo,
                	idAccion:idAccion,
                	tooltip:tooltip,
                },
                success: function (result) {
                   	var i;
                   	var html = '';

                   	$('#listaNotas .cargando-resultados').addClass('hidden');
                   	if (result.length == 0){
                   		$('#listaNotas .sin-resultados').removeClass('hidden');
                   		return;
                   	}

					for (i = 0; i < result.length; ++i) {
					    html += '<li class="media event item-nota">';
					    html += '<p><strong>'+ result[i].NOMBRE_EJECUTIVO  +' - '+result[i].FECHA_REGISTRO.substring(0,16)+ ' </strong><br>' + result[i].NOTA +'</p>';
					    html += '<div align="right"><a class="fa fa-trash fa-2x" href="#" idnota ="'+result[i].NOTA_ID+'" registro="'+result[i].REGISTRO_EN+'" numdoc="'+result[i].NUM_DOC+'" onClick="eliminarNota(this)"> </a></div></li>';
					}
					$('#listaNotas').find('.item-nota').remove().end().append(html);
                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                }
            });
    }


    function eliminarNota(e){    	
    	//var elem= e;
    	$.ajax({
                url: "<?php echo e(route('be.misacciones.nota.eliminar')); ?>",
                type: 'POST',
                data: {
                	id: $(e).attr('idnota'),
                	ejecutivo: $(e).attr('registro'),
                	lead: $(e).attr('numdoc'),
                },

                success: function (result) {
                	//document.write($(e).attr('idnota'));
					$(e).parent('div').parent('li').remove();		
					//cargarNotas(ejecutivo,lead);
					
                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al eliminar la nota , inténtelo mas tarde');
                }
            });
    }	


    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>