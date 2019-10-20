<?php $__env->startSection('content'); ?>
<div class="dashboard_graph panelesdesign" style="margin-bottom: 3px;">

    <div class="row x_title">
        <div class="col-md-1"><i class="fa fa-table" "></i></div>
        <div class="col-md-11">
            <h3 class="titulocabecera"><B>GESTION DE LEADS</B></h3>
        </div>

    </div>
   
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
        <div  style="margin-top: 15px;">

			  	<div id="filter_global">
                <label>Global - general</label>
                <input type="text" class="global_filter form-control" placeholder="Numero de Documento" id="global_filter">
                <input type="checkbox" class="global_filter " id="global_filter">
                <input type="checkbox" class="global_filter" id="global_filter" checked="checked">
           		</div>

			  	<div id="filter_col1" data-column="0">
                <label>columan - cpñ</label>
                <input type="text" class="column_filter form-control" placeholder="Numero de Documento" id="col0_filter">
                <input type="checkbox" class="column_filter " id="col0_regex">
                <input type="checkbox" class="column_filter" id="col0_smart" checked="checked">
           		</div>


			
            <div class="table-responsive">
                <table id="leads" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    	<th>Cpñ</th>
                                        <th>Cliente</th>
                         	            <th>Contacto</th>
                                        <th>Deuda</th>
                                        <th>Score</th>
                                        <th>Gestion</th>
                                        <th>Citas</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
								<tfoot>
						            <tr>
						               <th>Cpñ</th>
                                        <th>Cliente</th>
                         	            <th>Contacto</th>
                                        <th>Deuda</th>
                                        <th>Score</th>
                                        <th>Gestion</th>
                                        <th>Citas</th>
                                        <th>Detalles</th>
						            </tr>
						        </tfoot>    
						        <tbody>
						     	<?php $__currentLoopData = $leadtabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								
								 	<tr>
						        		<td><?php echo e($lead->REGISTRO_EN); ?></td>
						        		<td><?php echo e($lead->PERIODO); ?></td>
						        		<td><?php echo e($lead->TIPO_CAMPANHA); ?></td>
						        		<td><?php echo e($lead->ZONAL); ?></td>
						        		<td><?php echo e($lead->CENTRO); ?></td>
						        		<td><?php echo e($lead->TIENDA); ?></td>
						        		<td><?php echo e($lead->COD_UNICO); ?></td>
						        		<td><?php echo e($lead->NUM_DOC); ?></td>
						        	</tr>
								
								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						        	<!--<tr>
						        		<td>ala primera</td>
						        		<td>segunda</td>
						        		<td>ssegunda</td>
						        		<td>tercera</td>
						        		<td>cuarta</td>
						        		<td>quinta</td>
						        		<td>sexta</td>
						        		<td>sexta</td>

						        	</tr>
						        	<tr>
						        		<td>bela primera</td>
						        		<td>segunda</td>
						        		<td>ssegunda</td>
						        		<td>tercera</td>
						        		<td>cuarta</td>
						        		<td>zt</td>
						        		<td>sexta</td>
						        		<td>sexta</td>
						        	</tr>-->
						        </tbody>
                            </table>
            </div>

        </div>
    </div>


    <div class="clearfix"></div>
</div>



<script>
					 function filterGlobal () {
					    $('#leads').DataTable().search(
					        $('#global_filter').val(),
					        $('#global_regex').prop('checked'),
					        $('#global_smart').prop('checked')
					    ).draw();
					}
					 
					function filterColumn ( i ) {
					    $('#leads').DataTable().column( i ).search(
					        $('#col'+i+'_filter').val(),
					        $('#col'+i+'_regex').prop('checked'),
					        $('#col'+i+'_smart').prop('checked')
					    ).draw();
					}
					 
					$(document).ready(function() {
					    $('#leads').DataTable();
					 
					    $('input.global_filter').on( 'keyup click', function () {
					        filterGlobal();
					    } );
					 
					    $('input.column_filter').on( 'keyup click', function () {
					        filterColumn( $(this).parents().attr('data-column') );
					    } );
					} );

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>