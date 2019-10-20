<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Leads'); ?>

<?php if($resumen): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Resumen</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="col-md-3">
                <?php if($busqueda['campanha'] == ''): ?>
                    <span>Todas las campañas</span>
                <?php else: ?>
                    <span>Campaña: 
                    <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(($campanha->ID_CAMP_EST == $busqueda['campanha'])? $campanha->NOMBRE:''); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($resumen->GESTIONES * 100/$resumen->TOTAL); ?>%; min-width: 2em;">
                        <?php echo e(number_format($resumen->GESTIONES * 100/$resumen->TOTAL,0)); ?>%
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <?php echo e($resumen->GESTIONES); ?> de <?php echo e($resumen->TOTAL); ?> gestionados
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <h4 style="margin-top: 0px;">
            <?php if($resumen->CITAS_PENDIENTES == 0): ?>
                <span class="label label-default">No tienes citas pendientes</span>
            <?php else: ?>
                <span class="label label-success">Tienes <?php echo e($resumen->CITAS_PENDIENTES); ?> cita(s) pendiente(s)</span>
            <?php endif; ?>
            <?php if($resumen->CITAS_VENCIDAS > 0): ?>
                <span class="label label-danger">Tienes <?php echo e($resumen->CITAS_VENCIDAS); ?> cita(s) vencidas(s)</span>
            <?php endif; ?>
            </h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="text-align: right;">
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Consulta Lead</a>
        </div>
    </div>
</div>
</div>
</div>
<?php endif; ?>

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
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">DNI/RUC:</label>
                <div class="col-md-8 col-xs-9">
                    <input class="form-control" type="text" value="<?php echo e($busqueda['documento']); ?>" name="documento" id="txtDocumento" maxlength="15">
                </div>
            </div>
        

            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Campaña:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboCampanha" name="campanha" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($campanha->ID_CAMP_EST); ?>" <?php echo e(($campanha->ID_CAMP_EST == $busqueda['campanha'])? 'selected="selected"':''); ?>>
                            <?php echo e($campanha->NOMBRE); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Propensión:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboPropension" name="propension" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $propension; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nivel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($nivel['ID']); ?>" <?php echo e(($nivel['ID'] == $busqueda['propension'])? 'selected="selected"':''); ?>>
                            <?php echo e($nivel['NIVEL']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Mi Grupo:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboMarca" name="marca" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($marca); ?>" <?php echo e(($marca == $busqueda['marca'])? 'selected="selected"':''); ?>> <?php echo e($marca); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Nombre:</label>
                <div class="col-md-8 col-xs-9">
                    <input class="form-control" type="text" value="<?php echo e($busqueda['lead']); ?>" name="lead" id="txtLead" maxlength="75">
                </div>
            </div>
            <div class="form-group col-md-4 col-xs-12">
                <label for="" class="control-label col-md-4 col-xs-3">Distrito:</label>
                <div class="col-md-8 col-xs-9">
                    <select id="cboDistrito" name="distrito" class="form-control">
                        <option value="">---Todos----</option>
                        <?php $__currentLoopData = $distritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($distrito->DISTRITO); ?>" <?php echo e(($distrito->DISTRITO === $busqueda['distrito'])? 'selected="selected"':''); ?>>
                            <?php echo e($distrito->DISTRITO); ?></option>
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

<?php $hoy = Jenssegers\Date\Date::now(); 
?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
            <h2>Lista</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.imprimir', array_merge($busqueda,isset($orden)? $orden:[]))); ?>" target="_blank" class="collapse-link"><i class="fa fa-print"></i> Imprimir</a></li>
            </ul>
            <div class="clearfix"></div>
      </div>
      
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th></th>
                    <th style="width: 20%">
                        <?php if(isset($orden) && $orden['sort'] == 'lead'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'lead','order' =>'desc']))); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', $busqueda)); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'lead','order' =>'asc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Cliente</th>
                    <th style="width: 35%">
                        <?php if(isset($orden) && $orden['sort'] == 'direccion'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'direccion','order' =>'desc']))); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', $busqueda)); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'direccion','order' =>'asc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Dirección</th>
                    <th style="width: 10%">
                        <?php if(isset($orden) && $orden['sort'] == 'deuda'): ?>
                            <?php if(isset($orden) && $orden['order'] == 'desc'): ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'deuda','order' =>'asc']))); ?>">
                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                            <?php else: ?>
                                <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', $busqueda)); ?>">
                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar', array_merge($busqueda,['sort' => 'deuda','order' =>'desc']))); ?>">
                            <i class="fa fa-sort fa-lg order-icon"></i>
                        <?php endif; ?>
                        </a> Deuda</th>
                    <th style="width: 10%">Campañas</th>
                    <th style="width: 15%">Gestion</th>
                    <th style="width: 10%">Cita</th>
                    <?php if( Auth::user()->FLAG_TIENE_ASISTENTE_COMERCIAL == 1): ?>
                    <th >¿Enviar Asist.?</th>
                    <?php endif; ?>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php if(count($leads)>0): ?>
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="vertical-align: middle;">
                        <?php if($lead->MARCA_ESTRELLA == 1): ?>
                            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 30px; color: #1ABB9C;"></span>
                        <?php elseif($lead->MARCA_ESTRELLA == 2): ?>
                            <i aria-hidden="true" class="fa fa-handshake-o fa-2x" style="color: rgb(255,0,0);"></i>
                        <?php elseif($lead->MARCA_ESTRELLA == 3): ?>
                           <img src = "<?php echo e(URL::asset('img/derivado.png')); ?>" alt="derivado" style="width: 40px">
                        <?php elseif($lead->MARCA_ESTRELLA == 4): ?>
                           <img src = "<?php echo e(URL::asset('img/derivado.png')); ?>" alt="derivado-propenso" style="width: 40px">
                        <?php endif; ?>
                    </td>
                    <td style="vertical-align: middle;">
                        <div class="circle-tag circle-tag-<?php echo e($lead->ETIQUETA_EJECUTIVO); ?>" lead="<?php echo e($lead->NUM_DOC); ?>">
                            <?php echo e($lead->ETIQUETA_EJECUTIVO); ?>

                        </div>
                    </td>
                    <td>
                        <?php echo e($lead->TIPO_DOCUMENTO); ?>: <?php echo e($lead->NUM_DOC); ?>

                        <br/><?php echo e($lead->NOMBRE_CLIENTE); ?>

                        <?php if(empty($lead->FECHA_CITA)): ?>
                        <br/><?php echo e($lead->REPRESENTANTE_LEGAL); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($lead->DISTRITO); ?><br/>
                        <?php if(!is_null($lead->CITA_CONTACTO_DIRECCION)): ?>
                            <?php echo e($lead->CITA_CONTACTO_DIRECCION); ?>

                        <?php else: ?>
                            <?php echo e($lead->DIRECCION); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo e($lead->DEUDA_SSFF_MONEDA); ?> <?php echo e(number_format($lead->DEUDA_SSFF,0,'.',',')); ?> <br/>
                        <?php if($lead->VARIACION_DEUDA_6M_SSFF > 0): ?>
                            (<?php echo e(number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-up" style="color: #449D44"></span> )<br/>
                        <?php else: ?>
                            (<?php echo e(number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-down" style="color: #CB2431"></span> )<br/>
                        <?php endif; ?>
                        <?php echo e($lead->BANCO_PRINCIPAL_SSFF); ?><br/>
                    </td>
                    <td>
                        <?php $cpns = array_filter(explode('|',$lead->CAM_EST_ABREV)) ;
                        ?>
                        <?php $__currentLoopData = $cpns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($cpn); ?><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $gestiones = array_filter(explode('|',$lead->GESTION));?>

                        <?php $__currentLoopData = $cpns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e(!isset($gestiones[$key])? '-':ucwords(mb_strtolower($gestiones[$key], 'UTF-8'))); ?><br/>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php if(empty($lead->FECHA_CITA)): ?>
                        <label>-</label>
                        <?php else: ?>
                        <?php 
                            $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA);
                        ?>
                        <span style="<?php echo e((in_array($lead->CITA_ESTADO,[1,2,3]) && $fecha->lt($hoy))? 'color:#DB242C':''); ?>">
                        <span class="glyphicon glyphicon-calendar"></span> <span><?php echo e($fecha->format("j M")); ?></span> <br/>
                        <span class="glyphicon glyphicon-time"> </span> <span><?php echo e($fecha->format("H:i")); ?></span>
                        </span>
                        <?php endif; ?>
                    </td>
                    <?php if( Auth::user()->FLAG_TIENE_ASISTENTE_COMERCIAL == 1): ?>
                    <td style="vertical-align: middle; text-align: center;">
                            <input lead="<?php echo e($lead->NUM_DOC); ?>" type="checkbox" class='chkAsistente' aria-label=""
                            <?php echo (($lead->MARCA_ASISTENTE_COMERCIAL == '1')? 'checked':'') ?> />
                        
                    </td>
                    <?php endif; ?>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.ejecutivo.leads.detalle')); ?>?lead=<?php echo e($lead->NUM_DOC); ?>">Gestión</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">No se encontraron resultados</td>
                </tr><?php endif; ?>
            </tbody>
        </table>
        <?php echo e($leads->appends($busqueda)->links()); ?>

    </div>
</div>
</div>
</div>

<div id="templatePopoverTag" class="hidden">
    <div>
        <div class="circle-tag circle-tag-0">0</div>
        <div class="circle-tag circle-tag-1">1</div>
    </div>
    <div>
        <div class="circle-tag circle-tag-2">2</div>
        <div class="circle-tag circle-tag-3">3</div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>
    $(document).ready(function() {

        // Limpieza de formulario
        $("#btnLimpiar").click(function(){
            $(this).closest('form').find('input').val("");
            $(this).closest('form').find('select').val("");
        });

        /*********  ETIQUETA DE EJECUTIVO ***************/

        // Etiqueta de ejecutivo
        $("table .circle-tag").popover({ 
            trigger: "manual" ,
            html : true,
            content: function() {
                return $('#templatePopoverTag').html();
            } 
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 700);
        });

        $(document).on('click', '.popover .circle-tag', function() {
            var elem = $(this).closest('.popover').prev();
            var etiq = $(this).html();
            elem.removeClass()
                .addClass($(this).attr('class'))
                .html(etiq);
            $.ajax({
                type: "POST",
                data: {
                    lead: elem.attr('lead'),
                    etiqueta: etiq,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                url: APP_URL + '/bpe/en/update-etiqueta',
                dataType: 'json',
                success: function (json) {
                    console.log('ok');
                },
                error: function (xhr, status, text) {
                    console.log(status);
                }
            });
        });

        /*********  ENVIAR ASISTENTE COMERCIAL ***************/
        $('.chkAsistente').click(function(){
            console.log($(this).is(':checked'));
             $.ajax({
                type: "POST",
                data: {
                    lead: $(this).attr('lead'),
                    marca: $(this).is(':checked')? 1:0,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                url: APP_URL + '/bpe/en/enviar-asistente',
                dataType: 'json',
                success: function (json) {
                    console.log('ok');
                },
                error: function (xhr, status, text) {
                    console.log(status);
                }
            });
        });
    });



     /****** CAMPAÑA - PROPENSIÓN ******/

        if ($('#cboCampanha').length > 0){
            cboCampanhaChange($('#cboCampanha').val(),$('#cboPropension').val());    
        }                   
       
        $('#cboCampanha').change(function(){
            cboCampanhaChange($(this).val(),null);
        });
      
    function cboCampanhaChange(campanha,propension) {
            var cboPropension = $('#cboPropension');          

            //Limpiamos el combobox de propension
            cboPropension.find('option:not(:first)').remove();

            
            //Si no selecionada nada como resultado
            if (!campanha) {
                cboPropension.val('');
                cboPropension.prop('disabled', false);
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboPropension.prop('disabled', true);

            //Campañas recurrentes y estacionales
            if(campanha>=2 && campanha<=5){
                arregloPropension=["Muy Bajo","Bajo","Medio","Alto","Recomendable"];

                for (var i = 0; i < arregloPropension.length; i++) {
                    cboPropension.append($("<option></option>")
                    .attr("value", i+1).text(arregloPropension[i]));
                }


                if (propension){
                    cboPropension.val(propension);
                }

                cboPropension.prop('disabled', false);          
            }         

    }    
    

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>