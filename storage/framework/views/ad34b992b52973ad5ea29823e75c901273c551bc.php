<?php $__env->startSection('js-libs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageTitle', 'Consulta de Leads'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h2>Búsqueda</h2>
			<ul class="nav navbar-right panel_toolbox">
        	</ul>
        	<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<form class="form-horizontal" action="">
				<div class="form-group col-md-6">
	                <label for="" class="control-label col-md-2">DNI/RUC:</label>
	                <div class="col-md-6">
	                    <input class="form-control" type="text" value="<?php echo e($nro_doc); ?>" name="nro_doc" >
	                </div>
	                <div class="col-md-4">
	                	<button class="btn btn-primary" type="submit" id="boton_consultar"><span class="glyphicon glyphicon-search"></span> Consultar</button>	
	                </div>
	                
            	</div>
			</form>
		</div>		
	</div>

	<?php if($lead): ?>
	<div class="x_panel" id="resultados">
		<div class="x_title">
			<h2>Datos del Lead</h2>
			<ul class="nav navbar-right panel_toolbox">
        	</ul>
        	<div class="clearfix"></div>
		</div>
		<div class="x_content row">
			<div class='col-md-6'>
				<form class="form-horizontal form-label-left">
					<div class="form-group">
						<label class='col-md-3 control-label'>RUC</label>
						<div class="col-md-9">
							<input type="text" name="ruc" class='form-control' value="<?php echo e($lead->NUM_DOC); ?>" readonly="readonly">	
						</div>						
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>CU</label>
						<div class='col-md-9'>
							<input type="text" name="cu" class='form-control' value="<?php echo e($lead->COD_UNICO); ?>"" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Nombre/R.Social</label>
						<div class='col-md-9'>
							<input type="text" name="nombre" class='form-control' value="<?php echo e($lead->NOMBRE_CLIENTE); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Representante</label>
						<div class='col-md-9'>
							<input type="text" name="repr" class='form-control'  value="<?php echo e($lead->REPRESENTANTE_LEGAL); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Distrito</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control'  value="<?php echo e($lead->DISTRITO); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Segmento</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="<?php echo e($lead->SEGMENTO); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Riesgo</label>
						<div class='col-md-9'>
							<input type="text" name="riesgo" class='form-control' value="<?php echo e($lead->SCORE_BURO); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Deuda SSFF</label>
						<div class='col-md-9'>
							<input type="text" name="deuda" class='form-control' value="S/. <?php echo e($lead->DEUDA_SSFF); ?>" readonly="readonly">
						</div>
					</div>
					<?php if($lead->FLG_ES_CLIENTE == 1): ?>
						<div class="form-group">
							<label class='col-md-3 control-label'>Atraso Último</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->ATRASO_ULTIMO); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Atraso Promedio</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->ATRASO_PROMEDIO); ?>" readonly="readonly">
							</div>
						</div>
					<?php endif; ?>
				</form>
			</div>
			<div class='col-md-6'>
				<form class='form-horizontal form-label-left'>
					<div class="form-group">
						<label class='col-md-3 control-label'>Actividad</label>
						<div class='col-md-9'>
							<input type="text" name="actividad" class='form-control' value="<?php echo e($lead->ACTIVIDAD); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Giro</label>
						<div class='col-md-9'>
							<input type="text" name="giro" class='form-control' value="<?php echo e($lead->GIRO); ?>" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Asignado A</label>
						
							<?php if($lead->EN_NOMBRE): ?>
							<div class='col-md-9'>
							<input type="text" name="nombre" class='form-control' value="<?php echo e($lead->EN_NOMBRE); ?>" readonly="readonly">
							</div>
							<?php else: ?>
							<label class="info-label col-md-9 col-sm-9 col-xs-9" style="font-weight: 800; color: #FA503A;">LIBRE</label>
							<?php endif; ?>
						
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Zonal</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="<?php echo e($lead->ZONAL); ?>" readonly="readonly">
						</div>
					</div>	
					<div class="form-group">
						<label class='col-md-3 control-label'>Tienda</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="<?php echo e($lead->TIENDA); ?>" readonly="readonly">
						</div>
					</div>

					<?php 
						$canales = $lead->CANALES? explode('|',$lead->CANALES): [];
						$canales = array_unique($canales);
					 ?>

					<?php if($lead->FLG_ES_CLIENTE == 0): ?>
						<div class="form-group">
							<label class='col-md-3 control-label'>Canal</label>
							<?php if(count($canales) > 0): ?>
								<?php $__currentLoopData = $canales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($key == 0): ?>
										<div class="col-md-9">
											<input type="text" name="nombre" class='form-control' value="<?php echo e($canal); ?>" readonly="readonly" />
										</div>
										</div>
									<?php else: ?>
										<div class="form-group">
											<div class='col-md-9 col-md-offset-3'>
												<input type="text" name="nombre" class='form-control' value="<?php echo e($canal); ?>" readonly="readonly">
											</div>
										</div>
									<?php endif; ?>
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<label class="info-label col-md-9 col-sm-9 col-xs-9" style="font-weight: 800; color: #FA503A;">LIBRE</label>
							<?php endif; ?>
						</div>
					<?php endif; ?>			
					

					<?php if($lead->FLG_ES_CLIENTE == 1): ?>
						<div class="form-group">
							<label class='col-md-3 control-label'>Producto Principal</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->PRODUCTO_PRINCIPAL); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Número de Productos</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->NUMERO_PRODUCTOS); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Score Comportamiento</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->SCORE_COMPORTAMIENTO); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Calificación SBS</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->CALIFICACION_SBS); ?>" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Ultima Fecha Evaluacion</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="<?php echo e($lead->ULTIMA_FECHA_EVALUACION); ?>" readonly="readonly">
							</div>
						</div>
					<?php endif; ?>
				</form>						
			</div>
		</div>
	</div>

	<div class="x_panel">
		<div class="x_title">
			<h2>Campañas asignadas al Lead</h2>
			<ul class="nav navbar-right panel_toolbox">
        	</ul>
        	<div class="clearfix"></div>        	
		</div>
		<div class="x_content">
			<table id="" class="table table-striped jambo_table">
                <thead>
                    <tr class="headings">
                        <th>Campaña</th>
                        <th>Atributos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($campanhas)>0 && $lead->FLG_ES_CLIENTE == 0): ?>
	                    <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                    <tr>
		                        <td><?php echo e($campanha->NOMBRE); ?></td>	                        
	                        	<td>
		                        	<?php
	                            	$atributos = explode('|', $campanha->ATRIBUTO);
	                            	$tipos = explode('|', $campanha->TIPO);
	                            	$valores = explode('|', $campanha->VALOR);
	                            	$condicional = explode('|', $campanha->CONDICIONAL);

	                            	$arrayKeys = array_keys($atributos);
									$lastArrayKey = array_pop($arrayKeys);
	                            	?>

	                            	<?php $__currentLoopData = $atributos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $atributo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            		<?php if($condicional[$key] == 0): ?>
			                            	- <?php echo e($atributos[$key]); ?>:
			                            	<?php echo e(\App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key])); ?>

		                            	<?php endif; ?>
	                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<br>
									<?php if(count(array_filter(array_unique($condicional))) > 0 and current(array_filter(array_unique($condicional))) == 1): ?>
                                	<b>Compra de Deuda Repotenciada</b>
                                	<?php endif; ?>
									
	                            	<?php $__currentLoopData = $atributos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $atributo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            		<?php if($condicional[$key] > 0): ?>
			                            	- <?php echo e($atributos[$key]); ?>:
			                            	<?php echo e(\App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key])); ?>

		                            	<?php endif; ?>
	                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        	</td>
		                    </tr>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                <?php else: ?>
	                	<tr><td colspan="7">No hay campañas asignadas</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
		</div>
	</div>



		<?php if( Auth::user()->ROL != App\Entity\Usuario::ROL_SOPORTE): ?>
		<div class="x_panel" id="gestiones">
			<div class="x_title">
				<h2>Histórico de Gestiones</h2>
				<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>        	
			</div>
			<div class="x_content">
				<table id="tblGestiones" class="table table-striped jambo_table">
	                <thead>
	                    <tr class="headings">
	                        <th>Ejecutivo</th>
	                        <th>Campaña</th>
	                        <th>Fecha</th>
	                        <th>Resultado</th>
	                        <th>Motivo/Volver Llamar</th>
	                        <th>Visitado?</th>
	                        <th>Comentario</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php if(count($gestiones)>0): ?>
		                    <?php $__currentLoopData = $gestiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                    <tr>
		                        <td><?php echo e($gestion->EJECUTIVO); ?></td>
		                        <td><?php echo e($gestion->CAMP_EST_NOMBRE); ?></td>
		                        <td><?php echo e($gestion->FECHA_REGISTRO); ?></td>
		                        <td><?php echo e($gestion->GESTION_RESULTADO); ?></td>
		                        <td><?php echo e(($gestion->GESTION_RESULTADO == 'LO PENSARA')? $gestion->FECHA_VOLVER_LLAMAR: $gestion->GESTION_MOTIVO); ?></td>
		                        <td><?php echo e(isset($gestion->VISITADO)? $gestion->VISITADO:'-'); ?></td>
		                        <td><?php echo e(isset($gestion->COMENTARIO)? $gestion->COMENTARIO:'-'); ?></td>
		                    </tr>
		                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                <?php else: ?>
		                	<tr><td colspan="7">No se encontraron gestiones previas</td></tr>
	                    <?php endif; ?>
	                </tbody>
	            </table>
			</div>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="x_panel" id="gestiones">
		<div class="x_title">
			<h2>Lead</h2>
			<ul class="nav navbar-right panel_toolbox">
        	</ul>
        	<div class="clearfix"></div>        	
		</div>
		<div class="x_content">
			No se encontraron resultados
		</div>
	</div>
	<?php endif; ?>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>