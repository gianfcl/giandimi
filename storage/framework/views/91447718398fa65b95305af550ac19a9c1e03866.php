<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
    $modoJefe = in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO,
      App\Entity\Usuario::ROL_ADMINISTRADOR,App\Entity\Usuario::ROL_GERENTE_TIENDA]) ;
    $modoAsistente=Auth::user()->ROL==App\Entity\Usuario::ROL_ASISTENTE_COMERCIAL;
?>


<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Cartera'); ?>

<?php if($resumen and $resumen->TOTAL!=0): ?>
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
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
            <div class="col-md-2">
                Avance:                 
            </div>
            <div class="col-md-6">

                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($resumen->GESTIONES * 100/$resumen->TOTAL); ?>%; min-width: 2em;">
                        <?php echo e(number_format($resumen->GESTIONES * 100/$resumen->TOTAL,0)); ?>%
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <?php echo e(number_format($resumen->GESTIONES,0)); ?> de <?php echo e(number_format($resumen->TOTAL,0)); ?> gestiones
            </div>
            <div class="col-md-1">
            </div>
        </div>
        
        <?php if(!($modoJefe or $modoAsistente)): ?>
        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
            <div class="col-md-2">
                Meta:
            </div>
            <div class="col-md-6">
                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($resumen->AVANCE_META); ?>%; min-width: 2em;">
                        <?php echo e(number_format($resumen->AVANCE_META)); ?>%
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <?php echo e(number_format($resumen->COLOCACION/1000)); ?> K / <?php echo e(number_format($resumen->META/1000)); ?> K
            </div>
            <div class="col-md-1">
            </div>
        </div>
        <?php endif; ?>
        <div class="col-lg-2 col-md-2 col-sm-5 col-xs-12">
            <div class="col-md-4">
                Crecer:  </div>
            <div class="col-md-7">
               S/. <?php echo e(number_format($resumen->CRECER,0,'.',',')); ?>

            </div>
        </div>

         <?php if(!($modoJefe or $modoAsistente)): ?>
        <div class="col-lg-2 col-md-2 col-sm-5 col-xs-12">
            <h4 style="margin-top: 0px;">
                  <span class="label label-danger">Tienes <?php echo e($resumen->LINEAS_VENCER); ?> línea(s) próxima(s) a vencer</span>
            </h4>
        </div>
        <?php endif; ?>
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
                  <label for="" class="control-label col-md-4 col-xs-3">Código Único:</label>
                  <div class="col-md-8 col-xs-9">
                      <input class="form-control" type="text" value="<?php echo e($busqueda['codigo']); ?>" name="codigo" id="txtCodigo" maxlength="15">
                  </div>
              </div>

            <div><input class="hidden" value="<?php echo e($busqueda['ejecutivo']); ?>" name="ejecutivo"></div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Nombre:</label>
                  <div class="col-md-8 col-xs-9">
                      <input class="form-control" type="text" value="<?php echo e($busqueda['cliente']); ?>" name="cliente" id="txtCliente" maxlength="75">
                  </div>
              </div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Score:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboSegmento" name="segmento" class="form-control">
                        <option value="">---Todos----</option>
                        <option value="Bajo"<?php echo e(("Bajo"==$busqueda['segmento'])?'selected="selected"':''); ?>)>Bajo</option>
                        <option value="mBajo"<?php echo e(("mBajo"==$busqueda['segmento'])?'selected="selected"':''); ?>)>Medio Bajo</option>
                        <option value="Medio"<?php echo e(("Medio"==$busqueda['segmento'])?'selected="selected"':''); ?>)>Medio</option>                      
                      </select>
                  </div>
              </div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Estrategia:</label>
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
                  <label for="" class="control-label col-md-4 col-xs-3">Distrito:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboDistrito" name="distrito" class="form-control">
                          <option value="">---Todos----</option>
                          <?php $__currentLoopData = $distritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($distrito->DISTRITO); ?>" <?php echo e(($distrito->DISTRITO == $busqueda['distrito'])? 'selected="selected"':''); ?>>
                              <?php echo e($distrito->DISTRITO); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Producto Principal:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboProducto" name="producto" class="form-control">
                          <option value="">---Todos----</option>
                          <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($producto->PRODUCTO_PRINCIPAL); ?>" <?php echo e(($producto->PRODUCTO_PRINCIPAL == $busqueda['producto'])? 'selected="selected"':''); ?>>
                              <?php echo e($producto->PRODUCTO_PRINCIPAL); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Motivo de Bloqueo:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboBloqueo" name="bloqueo" class="form-control">
                          <option value="">---Todos----</option>
                          <?php $__currentLoopData = $motivosB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloqueo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($bloqueo->MOTIVO_BLOQUEO); ?>" <?php echo e(($bloqueo->MOTIVO_BLOQUEO == $busqueda['bloqueo'])? 'selected="selected"':''); ?>>
                              <?php echo e($bloqueo->MOTIVO_BLOQUEO); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Canal:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboCanal" name="canal" class="form-control">
                          <option value="">---Todos----</option>
                          <?php $__currentLoopData = $canales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($canal->CANAL); ?>" <?php echo e(($canal->CANAL == $busqueda['canal'])? 'selected="selected"':''); ?>>
                              <?php echo e($canal->CANAL); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>       

              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Canal de Atención:</label>
                  <div class="col-md-8 col-xs-9">
                      <select id="cboCanalAtencion" name="canalAtencion" class="form-control">
                          <option value="">---Todos----</option>
                          <?php $__currentLoopData = $canalesAtencion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($canal->CANAL_ATENCION); ?>" <?php echo e(($canal->CANAL_ATENCION == $busqueda['canalAtencion'])? 'selected="selected"':''); ?>>
                              <?php echo e($canal->CANAL_ATENCION); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
              </div>       

              <?php if(!$modoJefe and !$modoAsistente): ?>
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
            <?php endif; ?>    

<?php if($modoJefe): ?>
<?php if( Auth::user()->ROL != App\Entity\Usuario::ROL_GERENTE_TIENDA): ?>



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
            
<?php endif; ?>      
              <div class="form-group col-md-4 col-xs-12">
                  <label for="" class="control-label col-md-4 col-xs-3">Ejecutivo:</label>
                  <div class="col-md-8 col-xs-9">
                      <select  id="cboEjecutivo" name="ejecutivo" class="form-control">
                           <option value="">---Todos----</option>
                           <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($ejecutivo->REGISTRO); ?>" <?php echo e(($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''); ?>> <?php echo e($ejecutivo->NOMBRE); ?>

                                </option>     
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
                      </select>
                  </div>
              </div>         
<?php endif; ?>

<?php if($modoAsistente): ?>
    <div class="form-group col-md-4 col-xs-12">
          <label for="" class="control-label col-md-4 col-xs-3">Ejecutivo:</label>
          <div class="col-md-8 col-xs-9">
              <select  id="cboEjecutivo" name="ejecutivo" class="form-control">
                   <option value="">---Todos----</option>
                   <?php $__currentLoopData = $ejecutivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <option value="<?php echo e($ejecutivo->REGISTRO); ?>" <?php echo e(($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''); ?>> <?php echo e($ejecutivo->NOMBRE); ?>

                        </option>     
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
              </select>
          </div>
    </div>         
<?php endif; ?>  
  <div class="col-md-1 col-xs-1"></div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="proximosBloq">
        <label class="form-check-label" for="exampleCheck1">Próximos Bloqueos</label>
    </div>



            </div>
            <div class="form-group">
              <div class="col-md-6 col-xs-6">
                <button type="button" class="btn" id="btnLimpiar">Limpiar</button>
              
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                <?php if(!($modoJefe or $modoAsistente)): ?>
              
                <button type="submit" class="btn btn-success" name="flgCanal" value="1">A gestionar</button></div>
                <?php endif; ?>
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
              <?php if(!($modoJefe or $modoAsistente)): ?>
                <li><a href="<?php echo e(route('bpe.campanha..ejecutivo.cartera.imprimir', array_merge($busqueda,isset($orden)? $orden:[]))); ?>" target="_blank" class="collapse-link"><i class="fa fa-print"></i> Imprimir</a></li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-striped jambo_table">
            <thead>
                <tr class="headings">
                    <th></th>
                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'campanha'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'campanha','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'campanha','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>        
                    </a> Estrategia</th>


                    <th style="width: 20%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'cliente'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'cliente','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'cliente','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Cliente</th>


                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'numProd'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'numProd','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'numProd','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Producto</th>


                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'score'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'score','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'score','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Score</th>


                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'deuda'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'deuda','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'deuda','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Deuda</th>

                    <th style="width: 10%; text-align: center">Atraso Prom. / Últ.</th>

                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'aprobado'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'aprobado','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'aprobado','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Monto Aprobado</th>

                    <th style="width: 10%; text-align: center">
                    <?php if(isset($orden) && $orden['sort'] == 'disponible'): ?>
                        <?php if(isset($orden) && $orden['order'] == 'asc'): ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'disponible','order' =>'desc']))); ?>">
                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
                        <?php else: ?>
                            <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', $busqueda)); ?>">
                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera', array_merge($busqueda,['sort' => 'disponible','order' =>'asc']))); ?>">
                        <i class="fa fa-sort fa-lg order-icon"></i>
                    <?php endif; ?>
                    </a> Monto Disponible</th>

                    <th style="width: 10%; text-align: center">Gestion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($clientes)>0): ?>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="vertical-align: middle; ">
                    <?php if(!$modoJefe and !$modoAsistente): ?>
                        <div class="circle-tag circle-tag-<?php echo e($cliente->ETIQUETA_EJECUTIVO); ?>" lead="<?php echo e($cliente->NUM_DOC); ?>">
                              <?php echo e($cliente->ETIQUETA_EJECUTIVO); ?>

                        </div>
                    <?php endif; ?>
                    </td>

                    <td style="vertical-align: middle; text-align: center">
                    <?php if($cliente->HISTORIA != $cliente->ID_CAMP_EST): ?>
                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="Estrategia Inicial: <?php echo e($cliente->NOMB_HISTORIA); ?>" aria-hidden="true"></i>
                    <?php endif; ?>

                    <?php if($modoJefe or $modoAsistente): ?>
                      <a ><?php echo e($cliente->NOMBRE); ?> <!--NOMBRE ESTRATEGIA--></a>
                    <?php else: ?>
                      <a style="text-decoration: underline;" href="#" class="lnkCambiarCampanha" idCampanha="<?php echo e($cliente->ID_CAMP_EST); ?>" nCampanha="<?php echo e($cliente->NOMBRE); ?>" doc="<?php echo e($cliente->NUM_DOC); ?>" nomCliente="<?php echo e($cliente->NOMBRE_CLIENTE); ?>">
                        <?php echo e($cliente->NOMBRE); ?> <!--NOMBRE ESTRATEGIA-->                       
                      </a>
                    <?php endif; ?>
                     <?php if($cliente->SALDO_CDD != NULL && $cliente->BANCO_CDD !=NULL): ?>
                        <br/><i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="CDD: <?php echo e($cliente->BANCO_CDD); ?> <?php echo e(number_format($cliente->SALDO_CDD/1000,0,'.',',')); ?>M " aria-hidden="true"></i>
                      <?php endif; ?>
                    </td style="vertical-align: middle; text-align: center">
                    <td style="vertical-align: middle; text-align: center">
                        CU: <?php echo e($cliente->COD_UNICO); ?>

                        <br/><?php echo e($cliente->NOMBRE_CLIENTE); ?>

                        <?php if(empty($cliente->FECHA_CITA)): ?>
                        <br/><?php echo e($cliente->REPRESENTANTE_LEGAL); ?>

                        <?php endif; ?>
                        <?php if($modoJefe or $modoAsistente): ?>
                        EN: <?php echo e($cliente->NOMBRE_EN); ?>

                        <?php endif; ?>
                    </td>

                    <td style="vertical-align: middle; text-align: center">
                      <?php if($cliente->MOTIVO_BLOQUEO != '' && $cliente->MOTIVO_BLOQUEO !=NULL): ?>
                        <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="Bloqueo: <?php echo e($cliente->MOTIVO_BLOQUEO); ?>" aria-hidden="true"></i>
                      <?php endif; ?>
                    <?php echo e($cliente->PRODUCTO_PRINCIPAL); ?> (<?php echo e($cliente->NUMERO_PRODUCTOS); ?>)
                         <?php if($cliente->FECHA_VENCIMIENTO_LINEA !=NULL): ?>
                        <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="Fecha Vencimiento: <?php echo e($cliente->FECHA_VENCIMIENTO_LINEA); ?>" aria-hidden="true"></i>
                      <?php endif; ?>
                    </td>
                    <td style="vertical-align: middle; text-align: center">
                      <?php echo e($cliente->SCORE_COMPORTAMIENTO); ?>

                    </td>
                    <td style="vertical-align: middle; text-align: center">
                        <?php echo e($cliente->DEUDA_SSFF_MONEDA); ?> <?php echo e(number_format($cliente->DEUDA_SSFF,0,'.',',')); ?> <br/>
                        <?php if($cliente->VARIACION_DEUDA_6M_SSFF > 0): ?>
                            (<?php echo e(number_format($cliente->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-up" style="color: #449D44"></span> )<br/>
                        <?php else: ?>
                            (<?php echo e(number_format($cliente->VARIACION_DEUDA_6M_SSFF,0,'.',',')); ?>%<span class="glyphicon glyphicon-arrow-down" style="color: #CB2431"></span> )<br/>
                        <?php endif; ?>
                        <?php echo e($cliente->BANCO_PRINCIPAL_SSFF); ?><br/>
                    </td>
                    <td style="vertical-align: middle; text-align: center"><?php echo e($cliente->ATRASO_PROMEDIO); ?>d /<?php echo e($cliente->ATRASO_ULTIMO); ?>d</td>
                    <td style="vertical-align: middle; text-align: center">S/. <?php echo e(number_format($cliente->MONTO_APROBADO,2,'.',',')); ?></td>
                    <td style="vertical-align: middle; text-align: center">S/. <?php echo e(number_format($cliente->MONTO_DISPONIBLE,2,'.',',')); ?></td>
                    <td style="vertical-align: middle; text-align: center"><?php echo e($cliente->DESCRIPCION_RESULTADO); ?></td>
                    <?php if($modoJefe or $modoAsistente): ?>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera-detalle')); ?>?cliente=<?php echo e($cliente->NUM_DOC); ?>&ejecutivo=<?php echo e($cliente->REGISTRO_EN); ?>">Detalle</a>
                    </td>
                    <?php else: ?>
                    <td style="vertical-align: middle; text-align: center;">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera-detalle')); ?>?cliente=<?php echo e($cliente->NUM_DOC); ?>&ejecutivo=<?php echo e($cliente->REGISTRO_EN); ?>">Gestión</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">No se encontraron resultados</td>
                </tr><?php endif; ?>
            </tbody>
        </table>
        <?php echo e($clientes->appends($busqueda)->links()); ?>

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

<!-- Cambio de campaña -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCampanhaCambio">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar Campaña de Cliente</h4>
            </div>
            <form id="frmCambioCampanha" method="POST" class="form-horizontal form-label-left" action="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cambiar-campanha')); ?>">
                <div class="modal-body">
                    <input type="hidden" id= "clienteUpdate" name="clienteUpdate" value="">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblNombreCliente">Nombre Cliente: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <!--Nombre de la campaña-->
                            <input id="nomClienteUpdate" class="form-control" type="text" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblCampanhaActual">Campaña Actual: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <!--Nombre de la campaña-->
                            <input id="nombreCamp" class="form-control" type="text" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Campañas Activas: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="cboCampanhasActivas" id="cboCampanhasActivas" class="form-control">
                                <option value="MENSAJE">Elegir una campaña activa</option>
                               <?php $__currentLoopData = $campanhas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campanha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <!--Validar que no salga la campaña actual-->
                               <option value="<?php echo e($campanha->ID_CAMP_EST); ?>"><?php echo e($campanha->NOMBRE); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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





       /************ CAMBIO DE CAMPAÑA ******************/
    
    // Cuando se abre el modal limpiamos el formulario de contacto
    $('.lnkCambiarCampanha').click(function () {

        var idCampanha = $(this).attr('idCampanha');
        var nomCampanha = $(this).attr('nCampanha');
        var numDoc = $(this).attr('doc');
        var nomCli = $(this).attr('nomCliente');
        $('#cboCampanhasActivas').val("MENSAJE");
        $('#lblCampanhaActual').text("Campaña Actual");
        //document.write(nomCampanha,' ',numDoc,' ',nomCli);

        $('#nombreCamp').attr('placeholder',nomCampanha);
        $('#clienteUpdate').attr('value',numDoc);
        $('#nomClienteUpdate').attr('placeholder',nomCli);
        $('#idActual').attr('value',idCampanha)

        $('#modalCampanhaCambio').modal();
        //initializeFormValidationContacto();
    })

    //$('#modalCampanhaCambio').on('hidden.bs.modal', function () {
    //    $('#frmCambioCampanha').formValidation('destroy', true);
    //})

    });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})



  /*****COMBOBOX DE ZONALES-CENTROS-TIENDAS-EJECUTIVOS*****/

   function cboTiendaChange(tienda,ejecutivo) {

            var cboEjecutivo = $('#cboEjecutivo');
            //Limpiamos el combobox de ejecutivos           
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
            //Si no selecionada nada como resultado
            if (!tienda) {
                cboEjecutivo.val('');
                cboEjecutivo.prop('disabled', false);
                return;
            }
            
            //document.write(ejecutivo);
            //Si selecciona cualquier otro resultado
            cboEjecutivo.prop('disabled', true);


            $.ajax({
                type: "GET",
                data: {tienda: tienda},
                url: APP_URL + '/bpe/campanha/utils/get-ejecutivos-by-tienda',
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

      function cboCentroChange(centro,tienda,ejecutivo) {
            var cboTienda = $('#cboTienda');
            var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de tiendas
            cboTienda.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
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
                    cboTiendaChange(tienda,ejecutivo);
                }
            });
        }

        function cboZonalChange(zonal,centro,tienda,ejecutivo) {
            var cboCentro = $('#cboCentro');
            var cboTienda = $('#cboTienda');
            var cboEjecutivo = $('#cboEjecutivo');
            
            //Limpiamos el combobox de tiendas
            cboCentro.find('option:not(:first)').remove();
            cboTienda.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
            //Si no selecionada nada como resultado
            if (zonal === '') {
                cboCentro.val('');
                return;
            }
            
            //Si selecciona cualquier otro resultado
            cboCentro.prop('disabled', true);
            cboTienda.prop('disabled', true);
            cboEjecutivo.prop('disabled', true);

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
                    cboCentroChange(centro,tienda,ejecutivo);
                   
                    
                }
            });
        }

    $(document).ready(function() {

        //Si existe Zonal
        if ($('#cboZonal').length > 0){
            cboZonalChange($('#cboZonal').val(),$('#cboCentro').val(),$('#cboTienda').val(),$('#cboEjecutivo').val());
        }else{
            if ($('#cboCentro').length > 0){
                cboCentroChange($('#cboCentro').val(),$('#cboTienda').val(),$('#cboEjecutivo').val());    
            }
            else{
              if ($('#cboTienda').length > 0){
                cboTiendaChange($('#cboTienda').val(),$('#cboEjecutivo').val());    
              }
            }            
        }
        
        $('#cboTienda').change(function(){
            cboTiendaChange($(this).val(),null);
        });

        $('#cboCentro').change(function(){
            cboCentroChange($(this).val(),null,null);
        });


        $('#cboZonal').change(function(){
            cboZonalChange($(this).val(),null,null,null);
        });

    });

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>