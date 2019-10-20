<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Ejecutivos de Negocio'); ?>

<?php if( Auth::user()->ROL != App\Entity\Usuario::ROL_GERENTE_TIENDA): ?>
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
        <form action="" class="form-horizontal" method="GET">
            <div class="row">

                <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                <div class="form-group col-md-4">
                    <label for="" class="control-label col-md-4">Zonal:</label>
                    <div class="col-md-8">
                        <select id="cboZonal" name="zonal" class="form-control">
                            <option value="">---Todos----</option>
                            <?php $__currentLoopData = $zonales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zonal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($zonal->ID_ZONA); ?>" <?php echo e(($zonal->ID_ZONA == $busqueda['zonal'])? 'selected="selected"':''); ?>> <?php echo e($zonal->ZONA); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA,App\Entity\Usuario::ROL_ADMINISTRADOR])): ?>
                <div class="form-group col-md-4">
                    <label for="" class="control-label col-md-4">Centro:</label>
                    <div class="col-md-8">
                        <select id="cboCentro" name="centro" class="form-control">
                            <option value="">---Todos----</option>
                            <?php $__currentLoopData = $centros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($centro->ID_CENTRO); ?>" <?php echo e(($centro->ID_CENTRO == $busqueda['centro'])? 'selected="selected"':''); ?>> <?php echo e($centro->CENTRO); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <?php endif; ?>

                
                <div class="form-group col-md-4">
                    <label for="" class="control-label col-md-4">Tienda:</label>
                    <div class="col-md-8">
                        <select id="cboTienda" name="tienda" class="form-control">
                            <option value="">---Todos----</option>
                            <?php $__currentLoopData = $tiendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tienda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tienda->ID_TIENDA); ?>" <?php echo e(($tienda->ID_TIENDA == $busqueda['tienda'])? 'selected="selected"':''); ?>> <?php echo e($tienda->TIENDA); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php endif; ?>


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
            <h2>Lista de Ejecutivos</h2>
            <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    
                    <th colspan="8" style="text-align: center;font-size:140%;">Campañas</th>
                    <th colspan="4" style="text-align: center;font-size:140%;">Cartera</th>
                    
                </tr>
                <tr class="headings">
                    <th style="width: 20%;text-align: center;vertical-align: middle;"><?php if(isset($orden) && $orden['field'] == 'ejecutivo'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.resumen', array_merge($busqueda,['field' => 'ejecutivo','order' =>'desc']))); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.resumen', $busqueda)); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.resumen', array_merge($busqueda,['field' => 'ejecutivo','order' =>'asc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a>Ejecutivo</th>
                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                    <th style="vertical-align: middle;text-align: center">Zonal</th>
                    <?php endif; ?>
                    <?php if( in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA,App\Entity\Usuario::ROL_ADMINISTRADOR])): ?>
                    <th style="vertical-align: middle;text-align: center">Centro</th>
                    <?php endif; ?>
                    <?php if( in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA,App\Entity\Usuario::ROL_GERENTE_CENTRO,App\Entity\Usuario::ROL_ADMINISTRADOR])): ?>
                    <th style="vertical-align: middle;text-align: center">Tienda</th>
                    <?php endif; ?>
                    
                    <th style="vertical-align: middle;text-align: center">Leads</th>
                    <th style="vertical-align: middle;text-align: center;"">% de Avance</th>
                    <th style="vertical-align: middle;text-align: center; width: 5%;">Citas Pend./Venc.</th>
                    <th style="vertical-align: middle;text-align: center"></th>

                    <th style="vertical-align: middle;text-align: center">Clientes</th>
                    <th style="vertical-align: middle;text-align: center">% de Avance</th>
                    <th style="vertical-align: middle;text-align: center; width: 5%;">Crecer Total/Pend</th>
                    <th style="vertical-align: middle;text-align: center"></th>
                </tr>
            </thead>
            <tbody>
            <?php if(count($ejecutivos)>0): ?>
                <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td style="vertical-align: middle;text-align: center">
                        Registro: <?php echo e($ejecutivo->REGISTRO_EN); ?> <br/>
                        <?php echo e($ejecutivo->NOMBRE_EN); ?>

                    </td>
                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                    <td style="vertical-align: middle;text-align: center"><?php echo e($ejecutivo->ZONA); ?></td>
                    <?php endif; ?>
                    <?php if( in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA,App\Entity\Usuario::ROL_ADMINISTRADOR])): ?>
                    <td style="vertical-align: middle;text-align: center"><?php echo e($ejecutivo->CENTRO); ?></td>
                    <?php endif; ?>
                    <?php if( in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA,App\Entity\Usuario::ROL_GERENTE_CENTRO,App\Entity\Usuario::ROL_ADMINISTRADOR])): ?>
                    <td style="vertical-align: middle;text-align: center"><?php echo e($ejecutivo->TIENDA); ?></td>
                    <?php endif; ?>
                    <!--LEADS-->
                    <?php if($ejecutivo->TOTAL==0): ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php else: ?>
                    <td style="vertical-align: middle; text-align: center;"><?php echo e($ejecutivo->LEADS); ?></td>
                    <td style="vertical-align: middle">
                        <div class="progress" style="background-color: #e4e4e4; margin-top: 8px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($ejecutivo->GESTIONES * 100/$ejecutivo->TOTAL); ?>%; min-width: 2em;">
                            <?php echo e(number_format($ejecutivo->GESTIONES * 100/$ejecutivo->TOTAL,0)); ?>%
                            </div>  
                        </div>
                    </td>
                    <td style="vertical-align: middle; text-align: center;"><?php echo e($ejecutivo->CITAS_PENDIENTES); ?> / <?php echo e($ejecutivo->CITAS_VENCIDAS); ?> </td>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.detalle')); ?>?ejecutivo=<?php echo e($ejecutivo->REGISTRO_EN); ?>">Detalles</a>
                    </td>
                    <?php endif; ?>

                    <!--CARTERA-->
                    <?php if($ejecutivo->CLIENTES==0): ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php else: ?>
                    <td style="vertical-align: middle; text-align: center;"><?php echo e(number_format($ejecutivo->CLIENTES,0)); ?></td>

                    <?php if($ejecutivo->GESTIONES_CLIENTES==0): ?>
                    <td style="vertical-align: middle;">
                        <div class="progress" style="background-color: #e4e4e4; margin-top: 8px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0; min-width: 0;">                            
                            </div>  
                        </div>
                    </td>
                    <?php else: ?>
                    <td style="vertical-align: middle;">
                        <div class="progress" style="background-color: #e4e4e4; margin-top: 8px;">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(number_format($ejecutivo->TOTAL_CRECER == 0? 0 :$ejecutivo->GESTION_CRECER*100/$ejecutivo->TOTAL_CRECER,0)); ?>%; min-width: 2em;">
                            <?php echo e(number_format($ejecutivo->TOTAL_CRECER == 0? 0 :$ejecutivo->GESTION_CRECER*100/$ejecutivo->TOTAL_CRECER,0)); ?>%
                            </div>  
                        </div>
                    </td>
                    <?php endif; ?>
                    <td style="vertical-align: middle; text-align: center;"><?php echo e(number_format($ejecutivo->TOTAL_CRECER,0)); ?> / <?php echo e(number_format($ejecutivo->TOTAL_CRECER-$ejecutivo->GESTION_CRECER,0)); ?></td>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera')); ?>?ejecutivo=<?php echo e($ejecutivo->REGISTRO_EN); ?>&zonal=<?php echo e($ejecutivo->ID_ZONA); ?>&centro=<?php echo e($ejecutivo->ID_CENTRO); ?>&tienda=<?php echo e($ejecutivo->ID_TIENDA); ?>">Detalles</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <tr>
                    <td colspan="8">No se encontraron resultados</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php echo e($ejecutivos->appends($busqueda)->links()); ?>

    </div>
</div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
    function cboCentroChange(centro,tienda) {
            var cboTienda = $('#cboTienda');
            
            //Limpiamos el combobox de tiendas
            cboTienda.find('option:not(:first)').remove();
            
            //Si no selecionada nada como resultado
            if (!centro) {
                cboTienda.val('');
                cboTienda.prop('disabled', false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboTienda.prop('disabled', true);
            $.ajax({
                type: "GET",
                data: {centro: centro},
                url: APP_URL + '/bpe/campanha/utils/get-tiendas-by-centro',
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (key, value) {
                        cboTienda.append($("<option></option>")
                                .attr("value", value.ID_TIENDA).text(value.TIENDA));
                    });
                    if (tienda){
                        cboTienda.val(tienda);
                    }
                    cboTienda.prop('disabled', false);
                }
            });
        }

        function cboZonalChange(zonal,centro,tienda) {
            var cboCentro = $('#cboCentro');
            var cboTienda = $('#cboTienda');
            
            //Limpiamos el combobox de tiendas
            cboCentro.find('option:not(:first)').remove();
            cboTienda.find('option:not(:first)').remove();
            cboTienda.val('');
            
            //Si no selecionada nada como resultado
            if (zonal === '') {
                cboCentro.val('');
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboCentro.prop('disabled', true);
            cboTienda.prop('disabled', true);

            return $.ajax({
                type: "GET",
                data: {zonal: zonal},
                url: APP_URL + '/bpe/campanha/utils/get-centros-by-zonal',
                dataType: 'json',
                success: function (json) {
                    $.each(json, function (key, value) {
                        cboCentro.append($("<option></option>")
                                .attr("value", value.ID_CENTRO).text(value.CENTRO));
                    });
                    if (centro){
                        cboCentro.val(centro);
                    }
                    cboCentro.prop('disabled', false);
                    cboCentroChange(centro,tienda);
                    
                }
            });
        }

    $(document).ready(function() {

        $('#btnLimpiar').click(function(){
            $('select').val('');
        })

        
        //Si existe Zonal
        if ($('#cboZonal').length > 0){
            cboZonalChange($('#cboZonal').val(),$('#cboCentro').val(),$('#cboTienda').val());
            //.then(function(){console.log('HOLA')});
            //cboZonalChange($('#cboZonal').val(),$('#cboCentro').val()).then(cboCentroChange($('#cboCentro').val(),$('#cboTienda').val()));
        }else{
            if ($('#cboCentro').length > 0){
                cboCentroChange($('#cboCentro').val(),$('#cboTienda').val());    
            }            
        }
        
        $('#cboCentro').change(function(){
            cboCentroChange($(this).val(),null);
        });

        $('#cboZonal').change(function(){
            cboZonalChange($(this).val(),null,null);
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>