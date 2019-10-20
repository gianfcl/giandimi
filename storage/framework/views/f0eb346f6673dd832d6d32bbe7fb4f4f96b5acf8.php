<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >


<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/webvpc/be-actividades.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/modernizr.js')); ?>"></script>




<link rel="stylesheet" href="../css/style.css">  


<?php $__env->stopSection(); ?>
<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
    $modoJefe = in_array(Auth::user()->ROL,App\Entity\Usuario::getJefesGerentesBE()) ;
    $modoEdicion=in_array(Auth::user()->ROL,array_merge(App\Entity\Usuario::getAnalistasInternosBE(),App\Entity\Usuario::getEjecutivosBE(),App\Entity\Usuario::getEjecutivosProductoBE()));
    $modoEjecutivo=in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosBE());
    $modoAnalista=in_array(Auth::user()->ROL,App\Entity\Usuario::getAnalistasInternosBE());
    $modoEjecutivoProducto=in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosProductoBE());

    $modoLinkedin=in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosLinkedin());

?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('pageTitle', 'Actividades'); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="" class="form-horizontal">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="control-label col-md-4">DNI/RUC:</label>
                            <div class="col-md-8">
                                <input class="form-control formatInputNumber"  type="text" value="<?php echo ($lead ? $lead->NUM_DOC : '') ?>" name="documento" maxlength="15">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="" class="control-label col-md-4">Razón Social:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="<?php echo ($lead ? $lead->NOMBRE : '') ?>" name="razonSocial" id="txtRazonSocial">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<?php if($lead): ?>
<div class="col-md-3 col-xs-12">
    <div class="row">
        <div class="col-md-12">
            <div id="panelListaContactos" class="x_panel" style="overflow: hidden;" >
                <div class="x_title">
                    <h2><?php echo e($lead->NOMBRE); ?></h2>                 
                    <div class="clearfix"></div>        
                </div>

                <div class="x_content">
                    <br>
                    
                     <div class="form-group">
                        <label class="control-label col-md-8 col-sm-8 col-xs-12">Deuda Directa</label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12"><?php echo e($lead->DEUDA_DIRECTA? 'S/. ' . number_format($lead->DEUDA_DIRECTA,0,'.',','):'-'); ?> </label>
                    </div>

                    <input class="form-control" id="filtroDNIRUC" type="hidden" value="<?php echo e($lead->NUM_DOC); ?>">
                    
                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-md-8 col-sm-8 col-xs-12">Banco Principal</label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12"><?php echo e($lead->BANCO_PRINCIPAL? $lead->BANCO_PRINCIPAL:'-'); ?> </label>
                    </div>

                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-md-8 col-sm-8 col-xs-12">Categoria</label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12"><?php echo e($lead->CATEGORIA); ?></label>

                    </div>

                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-md-8 col-sm-8 col-xs-12">Estrategia</label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12"><?php echo e($lead->ESTRATEGIA_NOMBRE); ?></label>

                    </div>

                    <br><br>
                    <div class="ln_solid"></div>
                    <br><br>
                </div>      


            </div>
        </div>
    </div>
</div>
<?php elseif($cliente): ?>
<div class="col-md-3 col-xs-12">
    <div class="row">
        <div class="col-md-12">
            <div id="panelListaContactos" class="x_panel" style="overflow: hidden;" >
                <div class="x_title">
                    <h4><?php echo e($cliente->NOMBRE_EMPRESA); ?></h4>                 
                    <div class="clearfix"></div>        
                </div>

                <div class="x_content">
                     <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-6">Deuda Total RCC</label>
                        <label class="control-label col-md-8 col-sm-8 col-xs-6"><?php echo e($cliente->DEUDA_TOTAL_RCC? 'S/. ' . number_format($cliente->DEUDA_TOTAL_RCC,0,'.',','):'-'); ?> </label>
                    </div>                    

                    <input class="form-control" id="filtroDNIRUC" type="hidden" value="<?php echo e($cliente->NUM_DOC); ?>">
                    
                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-6">Banco Principal</label>
                        <label class="control-label col-md-8 col-sm-8 col-xs-6"><?php echo e($cliente->BANCO_PRINCIPAL? $cliente->BANCO_PRINCIPAL:'-'); ?> </label>
                    </div>

                    <br><br>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-6">Categoria</label>
                        <label class="control-label col-md-8 col-sm-8 col-xs-6"><?php echo e($cliente->CATEGORIA); ?></label>

                    </div>

                    <br>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-6">Acción Comercial </label>
                        <?php if($accionAvanzada): ?>
                            <label class="control-label col-md-8 col-sm-8 col-xs-6"><?php echo e($accionAvanzada->NOMBRE); ?></label>
                        <?php endif; ?>
                    </div>
                    <br><br>
                    <!--
                    <?php if(count($comunicaciones)>0): ?>
                    <div>
                        <label class="control-label" style="color:#47A412;margin-bottom: 0px;margin-left: 10px;">Comunicaciones </label>
                        <ul>
                        <?php $__currentLoopData = $comunicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comunicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                            <li class="col-md-8 col-sm-8 col-xs-8" style="color:#47A412"><?php echo e($comunicacion->TIPO_COMUNICACION); ?> (<?php echo e($comunicacion->FECHA_ENVIO); ?>)</li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>-->
                    
                </div>      


            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($lead or $cliente): ?>
<!--NUEVA ACTIVIDADES-->
<div class="col-md-9 col-xs-12">
    
    <?php if(in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getAnalistasEjecutivosBE(true))) and $usuario->getValue('_rol')!=\App\Entity\Usuario::ROL_ANALISTA_EXTERNO_ZONAL_BE): ?>    
     
    <div id="panelNuevaActividad"  class="x_panel">
        <div class="x_title">
            <h2>Nueva Actividad </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"  id="btnShowActividad" href="#" ><i class="fa fa-chevron-down"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content" style="display: none;" id='divNuevaActividad'>
            <br>            
            <div class="row">
                <div class="btn-group col-md-3 col-sm-3 col-xs-12" data-toggle="buttons">

                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" style="width: 25%;" class="active"><a href="#visita" id="todas-tab" role="tab" data-toggle="tab" aria-expanded="true"  ><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                        </li>
                        <li role="presentation" style="width: 25%;" class=""><a href="#llamada" role="tab" id="visitas-tab" data-toggle="tab" aria-expanded="false"  ><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></a>
                        </li>
                        <li role="presentation" style="width: 25%;" class=""><a href="#mensaje" role="tab" id="llamadas-tab" data-toggle="tab" aria-expanded="false"  ><span class="glyphicon glyphicon-envelope" aria-hidden="true" ></span></a>
                        </li>
                    </ul>
                </div>               
            </div>
            <br>
            <div class="btn-group col-md-12 col-sm-12 col-xs-12" >
                <div class="tab-content">
                    <div class="tab-pane row active tipoActividad" id="visita" name='actividad'>
                        <form id="formValVisitas" method="post" action="<?php echo e(route('be.actividades.agregar')); ?>">
                            <?php if($lead): ?>
                                <input type="hidden" value="<?php if($lead->NUM_DOC): ?><?php echo e($lead->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php else: ?>
                                <input type="hidden" value="<?php if($cliente->NUM_DOC): ?><?php echo e($cliente->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php endif; ?>
                            <input type="hidden" value="<?php if(Auth::user()->REGISTRO): ?><?php echo e(Auth::user()->REGISTRO); ?> <?php else: ?> <?php endif; ?>" name="ejeNegocio" ></input>
                            <input type="hidden" value="VISITA" name="tipo" ></input>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <div class="form-group col-md-3 col-sm-3"></div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" id="" name="titulo" placeholder="Titulo">
                                </div>  
                                <div class="form-group col-md-3 col-sm-3"></div>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12" >

                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Fecha</label>
                                    <div class="input-prepend input-group" style="margin-bottom: 0px;">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input class="form-control dfecha"  type="text" id="txtFecha" name="fActividad" placeholder="Ingrese la fecha">
                                    </div>
                                </div>

                                <div class="form-check col-md-8 col-sm-8 col-xs-12">
                                    <br>                                    
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1" name="flgRenovacion" value="1">
                                        Actividad por Renovacion de Lineas
                                    </label>
                                </div>
                                
                                
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Ubicación</label>
                                    <input class="form-control" type="text"  placeholder="Dirección" name="ubicacion" >
                                </div>


                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Participantes Interbank</label>
                                    <div class="partibk">
                                        <div class="row participanteIbk" id="">
                                            <div class="limitParticipante">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input class="form-control txtparticipante" name="participante"  type="text"  placeholder="Ingrese el nombre">
                                                </div>
                                                <div class="col-md-3 col-sm-3 ">
                                                    <input class="form-control regParticipante" readonly="readonly"  type="text"  placeholder="Registro" name="patInterbank[]">
                                                </div>
                                                <div class="col-md-3 col-sm-3 ">
                                                    <input class="form-control areaParticipante" readonly="readonly"  type="text"  placeholder="Area">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button type="button" class="btn btn-link btnparticipanteIbk"  style="padding-top: 0px;"  >+Añadir Nuevo Participante</button><br>
                                        </div>
                                    </div>
                                    <input class="form-control hidden" name="nroParticipantesIbk" value="0">
                                </div>


                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Participantes Cliente</label>
                                    <div class="listaParticipantesCliente">
                                        <div class="row ParticipanteCliente" id="participante" style="padding : 0px;">
                                            <div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom: 10px;">
                                                <select id="" name="partCliente[]" class="form-control nuevoParticipante contarParticipante">
                                                    <option value="sinParticipante">--Seleccione--</option>
                                                    <?php if(isset($contactos )): ?>
                                                    <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($contacto->ID_CONTACTO); ?>"><?php echo e($contacto->NOMBRE); ?> <?php echo e($contacto->APELLIDO_PATERNO); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <option value="nuevo"><a href="#">+Añadir Nuevo Participante</a></option>
                                                </select>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-link btnparticipante">+Añadir Nuevo Participante</button><br>
                                    </div>
                                    <input class="form-control hidden " name="nroParticipantesCliente" value="0">
                                </div>

                                <?php if($modoEdicion): ?>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <?php if($cliente): ?>
                                    <?php if($cliente->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($cliente->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php elseif($lead): ?>
                                    <?php if($lead->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($lead->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="divAccionesArea" style="padding-top: 15px;"></div>
                                    <div >
                                        <input class="hidden" type="text" name="idAccionActividad[]">
                                        <input class="hidden"  type="text" name="cboDelegadoActividad[]">
                                        <input class="hidden"  type="text" name="cboMesActivActividad[]">
                                        <input class="hidden"  type="text" name="kpiAccionActividad[]">
                                        <input class="hidden"  type="text" name="fFinActividad[]">
                                        <textarea class="hidden"  name="notaRentabilizar"></textarea>
                                        <textarea class="hidden"  name="notaBrindar"></textarea>
                                        <input class="hidden"  type="text" name="flgAccion" value="0">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($flgLinkedinMostrar): ?>
                                <!--<div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " /><label for="exampleInputEmail1">¿Usaste LinkedIn Sales Navigator como primera fuente de contacto?
                            </label>
                            <div class="btn-group flgsLinkedinVis" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionNo" value="0">No</label>                       
                            </div>
                        </div>-->

                                <div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " /><label for="exampleInputEmail1">¿Se logró contactar al decisor a través de LinkedIn Sales Navigator?
                            </label>
                            <div class="btn-group flgsLinkedinVis" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionNo" value="0">No</label>                       
                            </div><!--<i class="glyphicon glyphicon-ok hidden" style="color: #3c763d;margin-left: 10px;font-size: 15px;" id="checkFlagVis"></i>-->
                        </div>
                        <?php else: ?>
                            <div class="form-group">
                                <input type="radio" name="flgLinkedin" value="-1" hidden checked>   
                            </div>   
                            <!--<div class="form-group">
                                <input type="radio" name="flgLinkedin2" value="-1" hidden checked>   
                            </div>--> 
                        <?php endif; ?>

                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control" type="hidden" name="hiddenTemas" />
                                    <label>Temas Comerciales</label>
                                    <textarea style="resize:  none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tComerciales"></textarea>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Temas Crediticios</label>
                                    <textarea style="resize: none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tCrediticios"></textarea>
                                </div>

                            </div>

                            <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>

                            <br>

                            <div align="right" class="col-md-12 col-sm-12 col-xs-12" >
                                <button  type="button" class="btn btn-default " data-dismiss="modal ">Cancelar</button>
                                <?php if($flgLinkedinMostrar): ?>
                                <button type="submit" class="btn btn-primary botonGuardarVisitas " id="btnGuardarCuotaCom" disabled="" >Guardar</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary botonGuardarVisitas2 " id="btnGuardarCuotaCom">Guardar</button>
                                <?php endif; ?>
                            </div> 
                        </form>
                    </div> 


                    <div class="tab-pane row tipoActividad"  id="llamada" name='actividad'> 
                        <form id="formValLlamadas" method="post" action="<?php echo e(route('be.actividades.agregar')); ?>">
                            <?php if($lead): ?>
                                <input type="hidden" value="<?php if($lead->NUM_DOC): ?><?php echo e($lead->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php else: ?>
                                <input type="hidden" value="<?php if($cliente->NUM_DOC): ?><?php echo e($cliente->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php endif; ?>
                            <input type="hidden" value="<?php if(Auth::user()->REGISTRO): ?><?php echo e(Auth::user()->REGISTRO); ?> <?php else: ?> <?php endif; ?>" name="ejeNegocio" ></input>
                            <input type="hidden" value="LLAMADA" name="tipo" ></input>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <div class="form-group col-md-3 col-sm-3"></div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" id="" name="titulo" placeholder="Titulo">
                                </div>  
                                <div class="form-group col-md-3 col-sm-3"></div>
                            </div>
                            <div class="btn-group col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label>Fecha</label>
                                    <div class="input-prepend input-group" style="margin-bottom: 0px;">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input class="form-control dfecha"  type="text" id="txtFecha" name="fActividad" placeholder="Ingrese la fecha">
                                    </div>
                                </div>

                                <div class="form-check col-md-8 col-sm-8 col-xs-12">
                                    <br><br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1" name="flgRenovacion">
                                        Actividad por Renovacion de Lineas
                                    </label>
                                </div>
                                

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Participantes Interbank</label>
                                    <div class="partibk">
                                        <div class="row participanteIbk" id="">
                                            <div class="limitParticipante">
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input class="form-control txtparticipante" name="participante"  type="text"  placeholder="Ingrese el nombre">
                                                </div>
                                                <div class="col-md-3 col-sm-3 ">
                                                    <input class="form-control regParticipante" readonly="readonly"  type="text"  placeholder="Registro" name="patInterbank[]">
                                                </div>
                                                <div class="col-md-3 col-sm-3 ">
                                                    <input class="form-control areaParticipante" readonly="readonly"  type="text"  placeholder="Area">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button type="button" class="btn btn-link btnparticipanteIbk"  style="padding-top: 0px;"  >+Añadir Nuevo Participante</button><br>
                                        </div>
                                    </div>
                                    <input class="form-control hidden" name="nroParticipantesIbk" value="0">
                                </div>


                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Participantes Cliente</label>
                                    <div class="listaParticipantesCliente">
                                        <div class="row ParticipanteCliente" id="participante" style="padding : 0px;">
                                            <div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom: 10px;">
                                                <select id="" name="partCliente[]" class="form-control nuevoParticipante contarParticipante">
                                                    <option value="sinParticipante">--Seleccione--</option>
                                                    <?php if(isset($contactos )): ?>
                                                    <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($contacto->ID_CONTACTO); ?>"><?php echo e($contacto->NOMBRE); ?> <?php echo e($contacto->APELLIDO_PATERNO); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <option value="nuevo"><a href="#">+Añadir Nuevo Participante</a></option>
                                                </select>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="button" class="btn btn-link btnparticipante">+Añadir Nuevo Participante</button><br>
                                    </div>
                                    <input class="form-control hidden " name="nroParticipantesCliente" value="0">
                                </div>
                                  <?php if($modoEdicion): ?>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <?php if($cliente): ?>
                                    <?php if($cliente->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($cliente->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php elseif($lead): ?>
                                    <?php if($lead->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($lead->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="divAccionesArea" style="padding-top: 15px;"></div>
                                    <div >
                                        <input class="hidden" type="text" name="idAccionActividad[]">
                                        <input class="hidden"  type="text" name="cboDelegadoActividad[]">
                                        <input class="hidden"  type="text" name="cboMesActivActividad[]">
                                        <input class="hidden"  type="text" name="kpiAccionActividad[]">
                                        <input class="hidden"  type="text" name="fFinActividad[]">
                                        <textarea class="hidden"  name="notaRentabilizar"></textarea>
                                        <textarea class="hidden"  name="notaBrindar"></textarea>
                                        <input class="hidden"  type="text" name="flgAccion" value="0">
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if($flgLinkedinMostrar): ?>

                                <!--<div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " /> <label for="exampleInputEmail1">¿Usaste LinkedIn Sales Navigator como primera fuente de contacto?
                            </label>
                            <div class="btn-group flgsLinkedinLlam" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionNo" value="0">No</label>                       
                            </div>
                        </div>-->

                                <div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " /> <label for="exampleInputEmail1">¿Se logró contactar al decisor a través de LinkedIn Sales Navigator?
                            </label>
                            <div class="btn-group flgsLinkedinLlam" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionNo" value="0">No</label>                       
                            </div><!--<i class="glyphicon glyphicon-ok hidden" style="color: #3c763d;margin-left: 10px;font-size: 15px;" id="checkFlagLlam"></i>-->
                        </div>
                         <?php else: ?>
                            <div class="form-group">
                            <input type="radio" name="flgLinkedin" value="-1" hidden checked>   
                            </div> |
                            <!--<div class="form-group">
                            <input type="radio" name="flgLinkedin2" value="-1" hidden checked>   
                            </div>-->
                        <?php endif; ?>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control" type="hidden" name="hiddenTemas" />
                                    <label>Temas Comerciales</label>
                                    <textarea style="resize:  none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tComerciales"></textarea>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Temas Crediticios</label>
                                    <textarea style="resize: none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tCrediticios"></textarea>
                                </div>

                            </div>
                            
                            <div class="ln_solid col-md-12 col-sm-12 col-xs-12"></div>

                            <br>
                            <div align="right" class="col-md-12 col-sm-12 col-xs-12" >
                                <button  type="button" class="btn btn-default " data-dismiss="modal ">Cancelar</button>
                                <?php if($flgLinkedinMostrar): ?>
                                <button type="submit" class="btn btn-primary botonGuardarLlamadas" id="btnGuardarCuotaCom" disabled>Guardar</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary botonGuardarLlamadas2" id="btnGuardarCuotaCom">Guardar</button>
                                <?php endif; ?>
                            </div> 
                        </form>
                    </div> 

                    <div class="tab-pane row tipoActividad"  id="mensaje" name='actividad'> 
                        <form id="formValCorreo" method="post" action="<?php echo e(route('be.actividades.agregar')); ?>">
                            <?php if($lead): ?>
                                <input type="hidden" value="<?php if($lead->NUM_DOC): ?><?php echo e($lead->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php else: ?>
                                <input type="hidden" value="<?php if($cliente->NUM_DOC): ?><?php echo e($cliente->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" name="numdoc" ></input>
                            <?php endif; ?>
                            <input type="hidden" value="<?php if(Auth::user()->REGISTRO): ?><?php echo e(Auth::user()->REGISTRO); ?> <?php else: ?> <?php endif; ?>" name="ejeNegocio" ></input>
                            <input type="hidden" value="CORREO" name="tipo" ></input>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <div class="form-group col-md-3 col-sm-3"></div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control" id="" name="titulo" placeholder="Titulo">
                                </div>  
                                <div class="form-group col-md-3 col-sm-3"></div>
                            </div>
                            <div class="btn-group col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                    <label><h4>Fecha</h4></label>
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                        <input class="form-control dfecha" type="text" id="txtFecha" placeholder="Ingrese la fecha" name="fActividad">
                                    </div>
                                </div>
                                

                                <div class="form-check col-md-8 col-sm-8 col-xs-12">
                                    <br><br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1" name="flgRenovacion">
                                        Actividad por Renovacion de Lineas
                                    </label>
                                </div>

                                  <?php if($modoEdicion): ?>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <?php if($cliente): ?>
                                    <?php if($cliente->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($cliente->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php elseif($lead): ?>
                                    <?php if($lead->COD_UNICO!=NULL): ?>
                                        <div><label>Oportunidad</label></div>
                                        <div><label id="accionesVisita" style="color: #47A412;font-size: 12px;margin-top: 10px;margin-bottom: 10px;" hidden>Acción1, Acción2,...</label></div>
                                        <button type="button" class="btn btn-link btnAgregarAccionComercial" codUnico="<?php echo e($lead->COD_UNICO); ?>">+ Añadir Acciones Comerciales</button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="divAccionesArea" style="padding-top: 15px;"></div>
                                    <div >
                                        <input class="hidden" type="text" name="idAccionActividad[]">
                                        <input class="hidden"  type="text" name="cboDelegadoActividad[]">
                                        <input class="hidden"  type="text" name="cboMesActivActividad[]">
                                        <input class="hidden"  type="text" name="kpiAccionActividad[]">
                                        <input class="hidden"  type="text" name="fFinActividad[]">
                                        <textarea class="hidden"  name="notaRentabilizar"></textarea>
                                        <textarea class="hidden"  name="notaBrindar"></textarea>
                                        <input class="hidden"  type="text" name="flgAccion" value="0">
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($flgLinkedinMostrar): ?>
                                <!--<div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " />  <label for="exampleInputEmail1">¿Usaste LinkedIn Sales Navigator como primera fuente de contacto?
                                </label>
                            <div class="btn-group flgsLinkedinCorr" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin2" id="opcionNo" value="0">No</label>                       
                            </div>
                        </div>-->
                        <div class="form-group col-md-12">
                            <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" style="width: 3%; " />  <label for="exampleInputEmail1">¿Se logró contactar al decisor a través de LinkedIn Sales Navigator?
                                </label>
                            <div class="btn-group flgsLinkedinCorr" data-toggle="buttons">
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionSi" value="1">Sí</label>
                                <label class="btn btn-default">
                                  <input type="radio" name="flgLinkedin" id="opcionNo" value="0">No</label>                       
                            </div><!--<i class="glyphicon glyphicon-ok hidden" style="color: #3c763d;margin-left: 10px;font-size: 15px;" id="checkFlagCorr"></i>-->
                        </div>
                        <?php else: ?>
                            <div class="form-group">
                            <input type="radio" name="flgLinkedin" value="-1" hidden checked>   
                        </div>  
                        <!--<div class="form-group">
                            <input type="radio" name="flgLinkedin2" value="-1" hidden checked>   
                        </div>-->  
                        <?php endif; ?>
                            </div>
                            <div class="btn-group col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                    <label><h4>Comentarios</h4></label><br>

                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" > <input class="form-control" type="hidden" name="hiddenTemas" /></div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label><h5>Temas Comerciales</h5></label>
                                    <textarea style="resize:  none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tComerciales"></textarea>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label><h5>Temas Crediticios</h5></label>
                                    <textarea style="resize: none;" class="form-control" rows="5" placeholder="Escribe aqui..." name="tCrediticios"></textarea>
                                </div>                                
                            </div>
                            <div class="ln_solid col-md-12 col-sm-12 col-xs-12">

                            </div>

                            <br>
                            <div align="right" class="col-md-12 col-sm-12 col-xs-12" >
                                <button  type="button" class="btn btn-default " data-dismiss="modal ">Cancelar</button>
                                <?php if($flgLinkedinMostrar): ?>
                                <button type="submit" class="btn btn-primary botonGuardarCorreos" id="btnGuardarCuotaCom" disabled="">Guardar</button>
                                <?php else: ?>
                                <button type="submit" class="btn btn-primary botonGuardarCorreos2" id="btnGuardarCuotaCom">Guardar</button>
                            <?php endif; ?>
                            </div> 
                        </form>
                    </div> 
                </div> 
            </div>  


        </div>
    </div>
    <?php endif; ?>

<style>
div.ex1{
    height: 78px;
    overflow:hidden;
}
div.ex2{
    overflow:visible;
}
a.read-more-link{
    cursor: pointer;
}
a.read-less-link{
    cursor: pointer;
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
}
</style>
    <!--PANEL DE HISTORIAL(VISIBLE)-->
    <div class="x_panel" id="panelHistorial">

        <div class="x_title">
            <h2>Historial de Actividades</h2>            
            <div class="clearfix"></div>
        </div>
        <div class="row col-md-12 col-sm-3 col-xs-12">
            <div class="x_content">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="tiposActividad" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" style="width: 19%;" class="active"><a role="tab" id="todas-tab" filtro="todos" data-toggle="tab" class="optionfiltros">Todas</a></li>
                        <li role="presentation" style="width: 19%;" class=""><a role="tab" id="visitas-tab" filtro="VISITA" data-toggle="tab" class="optionfiltros">Visitas</a></li>
                        <li role="presentation" style="width: 19%;" class=""><a role="tab" id="llamadas-tab" filtro="LLAMADA" data-toggle="tab" class="optionfiltros">Llamadas</a></li>
                        <li role="presentation" style="width: 19%;" class=""><a role="tab" id="cambioEstado-tab" filtro="CAMBIO" data-toggle="tab" class="optionfiltros">Cambio de Estado</a></li>
                        <li role="presentation" style="width: 19%;" class=""><a role="tab" id="correo-tab" filtro="CORREO" data-toggle="tab" class="optionfiltros">Correo</a></li>
                    </ul>
                    <div id="historiaContenido" class="tab-content">
                        <div id="" role="tabpanel" class="tab-pane fade active in" aria-labelledby="todas-tab">
                            <div style="margin-top: 50px;">
                                    <?php if(count($actividades)>0): ?>
                                    <ul class="cbp_tmtimeline" id="ActividadesLista">
                                        <?php $__currentLoopData = $actividades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actividad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>
                                            <?php echo e('CAMBIO'); ?>

                                            <?php else: ?>
                                            <?php echo e($actividad->TIPO); ?>

                                            <?php endif; ?>">
                                            <div class="cbp_tmicon">
                                                <?php
                                                switch ($actividad->TIPO) {
                                                    case 'VISITA' :
                                                        $tipoIcono = 'fa-home';
                                                        break;
                                                    case 'LLAMADA' :
                                                        $tipoIcono = 'fa-phone';
                                                        break;
                                                    case 'CORREO':
                                                        $tipoIcono = 'fa-envelope';
                                                        break;
                                                    case 'CAMBIO DE ESTADO' :
                                                        $tipoIcono = 'fa-exchange';
                                                        break;
                                                }
                                                ?>
                                                <i class="fa <?php echo e($tipoIcono); ?>"></i></div>
                                            <div class="cbp_tmlabel <?php echo $actividad->TIPO=='CAMBIO DE ESTADO'? 'cbp_tmlabel_ce':'' ?>" >
                                                <div  class="col-md-12 col-sm-12 col-xs-12" >
                                                    <div class="col-md-4 col-sm-4 col-xs-12" style="border-right: 3px solid #FFFFFF;">    
                                                    <div class="col-md-11 col-sm-11 col-xs-12">                                                        
                                                    <?php if($cliente): ?>                                                      
                                                        <h5 style="color:#46a4da ;"><strong> <?php echo e($actividad->TITULO); ?> : <?php echo e($actividad->NOMBRE_ACCION); ?></strong></h5>
                                                    <?php else: ?>
                                                        <h5 style="color:#46a4da ;"><strong> <?php echo e($actividad->TITULO); ?></strong></h5>
                                                    <?php endif; ?>
                                                    </div>
                                                    <?php if($actividad->FLG_LINKEDIN==1): ?>
                                                    <img src = "<?php echo e(URL::asset('img/linkedin.png')); ?>" title="Contacto logrado gracias a Linkedin Sales Navigator" style="width: 5%;"/>
                                                    <?php endif; ?> 
                                                        <label style="margin-top: 5px;"><?php echo e(Jenssegers\Date\Date::parse($actividad->FECHA_ACTIVIDAD)->format('j \d\e F \d\e Y')); ?></label><br>                                                    
                                                        <div class="row top" style="margin-top: 10px;">         
                                                            <div class="col-md-6">
                                                                <ul class="fa-ul">
                                                                    <li><i class="fa-li fa fa-user" style="color: #1ABB9C"></i><?php echo e($actividad->NOMBRE); ?></li>
                                                                    <?php $__currentLoopData = $actividad->P_IBK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pibk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($pibk!='' && $pibk <> $actividad->NOMBRE): ?>
                                                                            <li><i class="fa-li fa fa-user" style="color: #1ABB9C;"></i><?php echo e($pibk); ?></li>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                            <div  class="col-md-6">
                                                                <ul class="fa-ul">
                                                                    <?php $pclientes = $actividad->P_CLIENTES ?>
                                                                    <?php if(count($pclientes)>0): ?>
                                                                        <?php $__currentLoopData = $pclientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($pcliente!=''): ?>
                                                                            <li><i class="fa-li fa fa-user"></i><?php echo e($pcliente); ?></li>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <?php if($actividad->TIPO=='CAMBIO DE ESTADO'): ?>
                                                    <div  class="col-md-4 col-sm-4 col-xs-12">
                                                        <p  style="margin: 0px;" ><?php echo e($actividad->TEMAS_COMERCIALES); ?></p>
                                                        <p  style="margin: 0px;" ><?php echo e($actividad->TEMAS_CREDITICIOS); ?></p>
                                                    </div>
                                                    <?php else: ?>
                                                    <div  class="col-md-4 col-sm-4 col-xs-12">
                                                        <h4>Temas Comerciales</h4>    
                                                        <div class="ex1">             
                                                        <?php echo e($actividad->TEMAS_COMERCIALES); ?>

                                                        </div><a class="read-more-link"> Ver más...</a>  
                                                        <a class="read-less-link" hidden> Ver menos...</a>                                  
                                                    </div>
                                                    <div  class="col-md-4 col-sm-4 col-xs-12">
                                                        <h4>Temas Crediticios</h4>
                                                        <div class="ex1">             
                                                        <?php echo e($actividad->TEMAS_CREDITICIOS); ?>

                                                        </div><a  class="read-more-link" > Ver más...</a>
                                                        <a class="read-less-link" hidden> Ver menos...</a>                                   
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div align="center"><button class="btn btn-primary masActividades" pagina="2" type="button">
                                        <i class="fa fa-spinner fa-spin fa-fw hidden"></i> Más Actividades</button>
                                    </div>
                                    <?php else: ?>
                                    <div align='center' style='margin-bottom: 5px;'>
                                        <h2 id='notFound'>No se encontraron resultados</h2>
                                    </div>
                                    <?php endif; ?>
                            </div>
                        </div>                        
                    </div>
                </div>      
            </div>
        </div>
    </div>        
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="modalContactoNuevo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Contacto</h4>
            </div>
            <form id="frmNuevoContacto" class="form-horizontal form-label-left" action="<?php echo e(route('be.micontacto.agregar-contacto')); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
                    <input type="hidden" name="lead">
                    <?php if($lead): ?>
                        <input name="numdoc" id="numdocAgregado" value="<?php if($lead->NUM_DOC): ?><?php echo e($lead->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" type="hidden">
                    <?php else: ?>
                        <input name="numdoc" id="numdocAgregado" value="<?php if($cliente->NUM_DOC): ?><?php echo e($cliente->NUM_DOC); ?> <?php else: ?> <?php endif; ?>" type="hidden">
                    <?php endif; ?>
                    <input name="eNegocio" id="eNegocioAgregado" value="<?php echo e(Auth::user()->NOMBRE); ?>" type="hidden">
                    <input name="actividades" id="actividades" value="actividades" type="hidden">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="nombres" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Apellido Paterno:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="apepat" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Apellido Materno:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="apemat" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Cargo:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cargo" class="form-control" type="text" value="" maxlength="25">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="telefono" class="form-control" type="text" value="" maxlength="9">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Dirección:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="direccion" class="form-control" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Email :</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="email" class="form-control" type="text" value="">
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

<?php else: ?>
<?php if((!$lead && $busqueda['documento']) or (!$cliente && $busqueda['documento'])): ?>
<span >No se encontraron resultados</span>
<?php endif; ?>
<?php endif; ?>



<!--TERMINA PANEL DE HISTORIA(VISIBLE)-->
<div class="clearfix"></div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoParticipanteIbk">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Participante Interbank</h4>
            </div>
            <form id="" class="form-horizontal form-label-left">
                <div class="modal-body">

                    <input type="hidden" name="lead" value="">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text"  id="nombreIbk" maxlength="25">
                        </div>
                    </div>
                    <div >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Area:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="area" class="form-control">
                                <option value="">---Todos----</option>
                                <option value="">Riesgos</option>
                                <option value="">Planilla</option>
                                <option value="">Producto</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnGuardarCuotaCom">Guardar</button>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!--</div>-->
<div class="hidden row participanteIbk autocompleteParticipante" style="margin-top: 5px;" id="addParticipanteIbk">
    <div class="limitParticipante">
        <div class="col-md-6 col-sm-6 ">
            <input class="form-control txtparticipante"  type="text"  placeholder="Ingrese el nombre">
        </div>
        <div class="col-md-3 col-sm-3 ">
            <input class="form-control regParticipante" readonly="readonly"  type="text"  placeholder="Registro" name="patInterbank[]">
        </div>
        <div class="col-md-3 col-sm-3 ">
            <input class="form-control areaParticipante" readonly="readonly"  type="text"  placeholder="Area">
        </div>
    </div>
</div>


<div class="hidden ParticipanteCliente row" style="padding : 0px;" id="addParticipante">
    <div class="col-md-8 col-sm-8 col-xs-12" style="margin-bottom: 5px;">
        <select id="" name="partCliente[]" class="form-control nuevoParticipante contarParticipante">
            <option value="sinParticipante">--Seleccione--</option>
            <?php if(isset($contactos)): ?>
                <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($contacto->ID_CONTACTO); ?>"><?php echo e($contacto->NOMBRE); ?> <?php echo e($contacto->APELLIDO_PATERNO); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <option value="nuevo"><a class="optionAgrecarContacto" href="#">+Añadir Nuevo Contacto</a></option>
        </select>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <button class="btn btn-danger deleteParticipante" type="button" onclick="eliminarParticipanteCliente($(this))">Eliminar</button>                                                
    </div>
</div>


<!-- Modal Agregar AccionComercial -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarAccion">
    <div class="modal-dialog" role="document">
        <div class="modal-content grande" id="modalAgrandar">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ingresar Acción Comercial</h4>
                <div class="alert alert-warning alert-dismissible" id="alertaRep" style="margin-bottom: 0px;margin-top: 20px; font-weight: bold;background-color:#FFFF80;color: black " hidden>                           
                </div>
            </div>
            <div class="modal-body">


                <form id="frmNuevaAccionComercial" class="form-horizontal form-label-left">                    
                    <div class="row">
                    <div id="divBusquedaCU" class="col-md-2">                        
                        <label class="control-label">Número de CU:</label>
                        <div class="input-group">
                            <input type="text" class="form-control formatInputNumber" placeholder="Ingresar CU" maxlength="11" id="txtCodUnico" name="codUnico" readonly="readonly">                            
                        </div><!-- /input-group -->
                    </div>

                        <div id="divDatosClienteEjecutivo" class="col-md-10">                          
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
                    <div id="divNuevaAccionCliente" class="">                     
                        <?php $__currentLoopData = $accionesEstrategia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estrategia =>$acciones): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($estrategia=="CRECER EN COLOCACIONES" && $modoEjecutivoProducto): ?>
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
                                    <?php if($acciones[0]->TIPO_KPI!="TX"): ?><div class="titEstrategia" style="color: #C70039">(MILES DE S/.)</div><br><?php endif; ?>
                                    </div>                              
                                </div>                              
                            </div>

                            <div class="col-xs-10 col-md-10">
                                <div class="x_panel paddingXPanel" style="">
                                    <?php $__currentLoopData = $acciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(($acc->NOMBRE=="CAMBIOS - SPOT/DERIVADOS" ||$acc->NOMBRE=="INVESTMENT BANKINGS (FEES)") && $modoEjecutivoProducto): ?>
                                            <?php continue; ?>
                                        <?php else: ?>
                                        <?php if($estrategia=="CRECER EN COLOCACIONES"): ?>
                                        <div id="accionX" class="col-xs-2 col-md-2" style="height: 120px">
                                        <?php else: ?> 
                                        <div id="accionX" class="col-xs-2 col-md-2" style="height: 150px">
                                        <?php endif; ?>
                                            <div class="form-check form-group" id="divCheck" style="margin-bottom: 0px">
                                                <label class="form-check-label tamForm">
                                                <input type="checkbox" class="form-check-input checkAccion" id="checkAccion" name="checkAccion[]" value="<?php echo e($acc->ID_CAMP_EST); ?>" >           
                                                    <?php echo e($acc->NOMBRE); ?></label>
                                            </div>
                                            <?php if($modoEjecutivo or $modoAnalista): ?>
                                                <?php if($estrategia!="CRECER EN COLOCACIONES" && $acc->NOMBRE!="CAMBIOS - SPOT/DERIVADOS" && $acc->NOMBRE!="INVESTMENT BANKINGS (FEES)"): ?>  
                                                <div class="divDelegado form-group" id="divDelegado">                                                   
                                                                                    
                                                    <select id="cboDelegado" class="form-control cboDelegado tamForm paddingForm" name="cboDelegado[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  disabled>                                                     
                                                        <option value="NO DELEGAR">NO DELEGAR</option>
                                                        <?php $__currentLoopData = $eProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ejecutivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($ejecutivo->REGISTRO); ?>"><?php echo e($ejecutivo->NOMBRE); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                    
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if($estrategia!="CRECER EN COLOCACIONES" && $acc->NOMBRE!="CAMBIOS - SPOT/DERIVADOS" && $acc->NOMBRE!="INVESTMENT BANKINGS (FEES)"): ?>

                                                <?php if($modoEjecutivo or $modoAnalista): ?>
                                                <div id="inputKPI" class="form-group">
                                                    
                                                    <input type="text" class="form-control formatInputNumber hidden tamForm paddingForm" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
                                                </div>
                                                
                                                    <div class ="form-group" id="divFechaFin2">                     
                                                        <div class="input-group divFechaFin hidden" id="divFechaFin" style="width: 150px;">               
                                                            <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
                                                            <input class="form-control dfecha"  type="text" id="txtFechaFin" name="fFin[<?php echo e($acc->ID_CAMP_EST); ?>]" placeholder="Ingresar fecha fin" style="font-size: 11px;height:25px;padding-right: 10px;" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                <?php else: ?>
                                                <div id="inputKPI" class="form-group">
                                                        
                                                    <input type="text" class="form-control formatInputNumber tamForm paddingForm" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;" placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
                                                </div>
                                                
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div id="inputKPI" class="form-group">
                                                    
                                                    <input type="text" class="form-control formatInputNumber tamForm paddingForm" id="kpiAccion" name="kpiAccion[<?php echo e($acc->ID_CAMP_EST); ?>]" style="padding-right: 10px;"  placeholder="<?php echo e($acciones[0]->PLACEHOLDER); ?>" disabled>
                                                </div>
                                                

                                                <?php if($modoEjecutivo or $modoAnalista): ?>
                                                    <div class ="form-group" id="divFechaFin2">                                             
                                                            
                                                        <div class="input-group" id="divFechaFin" style="width: 150px;">                                     
                                                            <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
                                                            <input class="form-control dfecha"  type="text" id="txtFechaFin" name="fFin[<?php echo e($acc->ID_CAMP_EST); ?>]" placeholder="Ingresar fecha fin" style="font-size: 11px;height:25px;padding-right: 10px;" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if(!$modoEjecutivo and !$modoAnalista): ?>
                                                <div class="" id="divMesActivacion">                                                
                                                        
                                                    <div class="form-group">                                                 
                                                        <select id="cboMesActiv" class="form-control tamForm paddingForm" style="padding-right: 10px;" name="cboMesActiv[<?php echo e($acc->ID_CAMP_EST); ?>]" disabled>
                                                            <option value="">Elegir Mes</option>
                                                            <?php $__currentLoopData = $mesesActivacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($mes->MES); ?>"><?php echo e($mes->MES); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                     
                                                        </select>
                                                    </div>
                                                </div>
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
                    <div id="botonesAgregarAccion" class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="btnGuardarAcciones" class="btn btn-success" type="submit" disabled>Ingresar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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

    $('body').on('click','.read-more-link',function(){
        $(this).prev().removeClass('ex1').addClass('ex2');
        $(this).addClass('hidden');
        $(this).next().removeAttr('hidden');
        $(this).next().removeClass('hidden');
    });

    $('body').on('click','.read-less-link',function(){
        $(this).prev().prev().removeClass('ex2').addClass('ex1');
        $(this).prev().removeClass('hidden');
        $(this).addClass('hidden');
    });
        

    function showDiv(pageid)
    {

        if ($('#actividad').css('display') == 'none') {
            $('#actividad').show();
            $("#cerrar").attr('class', 'fa fa-chevron-up');

        } else {
            //$('#divNuevaActividad').hide();
            //$("#btnShowActividad i").attr('class', 'fa fa-chevron-down');
        }
    }

    
    function autocompleteCliente() {

        var engine = new Bloodhound({
            remote: {
                url: APP_URL + '/be/actividades/autocomplete-cliente?termino=%Q%',
                wildcard: '%Q%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        $('#txtRazonSocial').typeahead({
            minLength: 3
        }, {
            display: 'NOMBRE',
            source: engine.ttAdapter(),
            //name: 'resultadosEN',
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados</div></div>'
                ],
                suggestion: function (data) {
                    return '<div class="list-group-item"><a href="' + APP_URL + '/be/actividades?documento=' + data.NUM_DOC + '">' + data.NOMBRE + '</a></div>'
                }
            }
        })
    }

    function autocompleteParticipante(nuevo) {


        var engine = new Bloodhound({
            remote: {
                url: APP_URL + '/be/actividades/autocomplete-participante?termino=%Q%',
                wildcard: '%Q%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        nuevo.typeahead({
            minLength: 3
        },
                {
                    display: 'NOMBRE',
                    source: engine.ttAdapter(),
                    //name: 'prueba',
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados</div></div>'
                        ],
                        suggestion: function (data) {
                            return  '<div class="list-group-item"><a href="#" onclick="return false;">' + data.REGISTRO + ' - ' + data.NOMBRE + '</a></div>'
                        }
                    }
                },
                )
        nuevo.bind('typeahead:select', function (ev, suggestion) {
            $(this).parents('.limitParticipante').find('.regParticipante').val(suggestion.REGISTRO);
            $(this).parents('.limitParticipante').find('.areaParticipante').val(suggestion.AREA);
            //console.log($(this).parents('form').find('[name="nroParticipantesIbk"]').val());
            $(this).parents('form').find('[name="nroParticipantesIbk"]').val('1');
            $(this).parents('form').formValidation('revalidateField', 'nroParticipantesIbk');
        });
    }

    function eliminarParticipanteCliente(e) {
            e.closest('.ParticipanteCliente').remove();
    };
     
    

    $(document).ready(function () {

        $(".flgsLinkedinVis").click(function (e){
                $(".botonGuardarVisitas").removeAttr('disabled'); 
                $("#checkFlagVis").removeClass('hidden'); 

        });

        $(".flgsLinkedinCorr").click(function (e){
                $(".botonGuardarCorreos").removeAttr('disabled'); 
                $("#checkFlagCorr").removeClass('hidden'); 

        });

        $(".flgsLinkedinLlam").click(function (e){
                $(".botonGuardarLlamadas").removeAttr('disabled'); 
                $("#checkFlagLlam").removeClass('hidden'); 

        });

        $('#frmNuevaAccionComercial').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
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


        $('.btnAgregarAccionComercial').click(function (e) {       
            //$('#frmNuevaAccionComercial').trigger("reset");
            //$('input:checkbox').removeAttr('checked');
            //$('.cboDelegado').attr('disabled',true);
            //$('.kpiAccion').attr('disabled',true);
            //$('.fechaFin').attr('disabled',true);
            //$('.cboMesActiv').attr('disabled',true);   
            $('#frmNuevaAccionComercial input[type="text"]:disabled').val('');                  
            $("#alertaRep").attr('hidden',true);       
            $('#modalAgregarAccion').modal();
            BuscarCliente($(this).attr('codUnico'));            
                          
            //initializeFormAccionComercial();            
            //cargarCliente(numDoc);
        });
      

        /****** BUSCAR ACCION COMERCIAL ******/
    function BuscarCliente(codUnico){            

            form = $('#frmNuevaAccionComercial');        
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
                        //console.log(result.data['COD_UNICO']);
                        form.find('input[name="codUnico"]').val(result.data['COD_UNICO']);
                        form.find('input[name="nombre"]').val(result.data['NOMBRE']);
                        form.find('input[name="numDoc"]').val(result.data['NUM_DOC']);             
                        form.find('input[name="nomEjecutivo"]').val(result.data['NOMBRE_EJECUTIVO']);                        
                        $('#frmNuevaAccionComercial').formValidation('destroy', true);
                        initializeFormAccionComercial();             
                        var numDoc=result.data['NUM_DOC'];
                        $('#btnGuardarAcciones').attr('disabled',true);      
                    } else {
                        $('#divNuevaAccionCliente').addClass('hidden');
                    }                   

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
        .off('success.form.fv')
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target),        // The form instance
                fv    = $(e.target).data('formValidation'); // FormValidation instance

            var j=0;
            var checks=[];
                for (var i = 0; i < $('.checkAccion').length; i++) {
                    if($('.checkAccion')[i].checked){
                        checks[j]=$('.checkAccion')[i].value;
                        j++;
                    }                       
                }
            var numDocBuscar=$(this).find('#numDocBuscar').val();
            
            //CARGAMOS MENSAJE DE ADVERTENCIA
            if(cargarCliente(numDocBuscar,checks)==true){
                return false;             
            }
            else{

                $('#modalAgregarAccion').modal("hide");
                
                //Obtenemos acciones
                var accionesIngresar=[];
                var _cboDelegado=[];
                var _kpiAccion=[];
                var _fFin=[];
                var _cboMesActiv=[];                

                for (var k = 0; k < j; k++) {
                    var indice=checks[k]; //El id de la acción
                    
                    accionesIngresar[k]=indice;
                    //Llenaremos un arreglo con todos los datos
                    _cboDelegado[k]=$form.find('select[name="cboDelegado['+indice+']"]').val();
                    _kpiAccion[k]=$form.find('input[name="kpiAccion['+indice+']"]').val();
                    _fFin[k]=$form.find('input[name="fFin['+indice+']"]').val();
                    _cboMesActiv[k]=$form.find('select[name="cboMesActiv['+indice+']"]').val();


                }
                //Obtenemos notas
                notaRentabilizar=$form.find('textarea[name="notaAccion['+"RENTABILIZAR CLIENTES"+']"]').val();
                notaBrindar=$form.find('textarea[name="notaAccion['+"BRINDAR LA MEJOR EXPERIENCIA"+']"]').val();
                $('[name="idAccionActividad[]"]').val(accionesIngresar); 
                $('[name="cboDelegadoActividad[]"]').val(_cboDelegado); 
                $('[name="cboMesActivActividad[]"]').val(_cboMesActiv); 
                $('[name="kpiAccionActividad[]"]').val(_kpiAccion); 
                $('[name="fFinActividad[]"]').val(_fFin); 
                $('[name="notaRentabilizar"]').val(notaRentabilizar); 
                $('[name="notaBrindar"]').val(notaBrindar); 
                $('[name="flgAccion"]').val(1);         

                

                $.ajax({
                url: "<?php echo e(route('be.misacciones.acciones-ingresar')); ?>",           
                type: 'GET',
                data: {
                    accionesIngresar: accionesIngresar                  
                },
                success: function (result) {
                    
                    if (result.length == 0)
                        return;
                    else{                       

                        var accionesActividad="";

                        for (var i = 0; i < result.length-1; i++) {
                            accionesActividad=accionesActividad+result[i]['NOMBRE']+", ";
                        }                   
                            accionesActividad=accionesActividad+result[result.length-1]['NOMBRE'];

                        $("#accionesVisita").removeAttr('hidden');                        
                        $("#accionesVisita").text(accionesActividad);

                    }
                    
                },
                error: function (xhr, status, text) {
                    alert('Hubo un error al consultar a base de datos');
                }
            });

                return true; 
            }

        });  

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
        //actividades comentarios
        /*
            var readMoreHtml=$(".read-more").html();
            console.log(readMoreHtml);
            var lessText=readMoreHtml.substr(0,100);

            if(readMoreHtml.length>100){
                $(".read-more").html(lessText).append("<a href='' class='read-more-link' > [Ver más...]</a>");
            } else{
                $(".read-more").html(readMoreHtml);
            }

            $("body").on("click",".read-more-link",function(event){ 
                event.preventDefault();
                $(this).parent(".read-more").html(readMoreHtml).append("<a href='' class='show-less-link' > [Ver menos...]</a>")}); 

            $("body").on("click",".show-less-link",function(event){ 
                event.preventDefault();
                $(this).parent(".read-more").html(readMoreHtml.substr(0,100)).append("<a href='' class='read-more-link' > [Ver más...]</a>")});
        */
        //borrar participante Cliente

        //filtro de hisotrial
        $('.optionfiltros').click(function () {
            var filtro = $(this).attr('filtro');
            switch (filtro)
            {
                case 'todos':
                    $('#historiaContenido .VISITA').css('display', '');
                    $('#historiaContenido .LLAMADA').css('display', '');
                    $('#historiaContenido .CORREO').css('display', '');
                    $('#historiaContenido .CAMBIOS').css('display', '');
                    break;
                case 'VISITA':
                    $('#historiaContenido .VISITA').css('display', '');
                    $('#historiaContenido .LLAMADA').css('display', 'none');
                    $('#historiaContenido .CORREO').css('display', 'none');
                    $('#historiaContenido .CAMBIO').css('display', 'none');
                    break;
                case 'LLAMADA':
                    $('#historiaContenido .VISITA').css('display', 'none');
                    $('#historiaContenido .LLAMADA').css('display', '');
                    $('#historiaContenido .CORREO').css('display', 'none');
                    $('#historiaContenido .CAMBIO').css('display', 'none');
                    break;
                case 'CORREO':
                    $('#historiaContenido .VISITA').css('display', 'none');
                    $('#historiaContenido .LLAMADA').css('display', 'none');
                    $('#historiaContenido .CORREO').css('display', '');
                    $('#historiaContenido .CAMBIO').css('display', 'none');
                    break;
                case 'CAMBIO':
                    $('#historiaContenido .VISITA').css('display', 'none');
                    $('#historiaContenido .LLAMADA').css('display', 'none');
                    $('#historiaContenido .CORREO').css('display', 'none');
                    $('#historiaContenido .CAMBIO').css('display', '');
                    break;
            }
        });
        //masHistorial

        $('body').on('click','.masActividades',function () {

            var button = $(this);
            var documento = $('#filtroDNIRUC').val();
            button.prop('disabled',true).find('.fa').removeClass('hidden');

            $.ajax({
                type: "GET",
                data: {documento: documento, page: button.attr('pagina')},
                url: APP_URL + '/be/actividades/historialActividad',
                success: function (response) {
                    button.addClass('hidden');
                    $('#ActividadesLista').append(response);
                    var filtro = $('#tiposActividad').find('.active').find('.optionfiltros').attr('filtro');
                    switch (filtro)
                    {
                        case 'todos':
                            $('#historiaContenido .VISITA').css('display', '');
                            $('#historiaContenido .LLAMADA').css('display', '');
                            $('#historiaContenido .CORREO').css('display', '');
                            $('#historiaContenido .CAMBIOS').css('display', '');
                            break;
                        case 'VISITA':
                            $('#historiaContenido .VISITA').css('display', '');
                            $('#historiaContenido .LLAMADA').css('display', 'none');
                            $('#historiaContenido .CORREO').css('display', 'none');
                            $('#historiaContenido .CAMBIO').css('display', 'none');
                            break;
                        case 'LLAMADA':
                            $('#historiaContenido .VISITA').css('display', 'none');
                            $('#historiaContenido .LLAMADA').css('display', '');
                            $('#historiaContenido .CORREO').css('display', 'none');
                            $('#historiaContenido .CAMBIO').css('display', 'none');
                            break;
                        case 'CORREO':
                            $('#historiaContenido .VISITA').css('display', 'none');
                            $('#historiaContenido .LLAMADA').css('display', 'none');
                            $('#historiaContenido .CORREO').css('display', '');
                            $('#historiaContenido .CAMBIO').css('display', 'none');
                            break;
                        case 'CAMBIO':
                            $('#historiaContenido .VISITA').css('display', 'none');
                            $('#historiaContenido .LLAMADA').css('display', 'none');
                            $('#historiaContenido .CORREO').css('display', 'none');
                            $('#historiaContenido .CAMBIO').css('display', '');
                            break;
                    }
                },
            });
        });
        ///fin
        autocompleteCliente();
        autocompleteParticipante($('.partibk .txtparticipante'));

        $('.btnparticipanteIbk').click(function () {

            //$(this).parent('.partibk').find('.participanteIbk').last().find('.inputParticipante').removeClass('txtParticipanteNuevo');
            //$(this).parent('.partibk').find('.participanteIbk').last().find('.inputParticipante').removeClass('inputParticipante');
            item = $('#addParticipanteIbk').clone().removeClass('hidden').removeAttr('id');
            autocompleteParticipante(item.find('.txtparticipante'));
            item.insertAfter($(this).closest('.partibk').find('.participanteIbk').last());
            //$(this).parent('.partibk').find('.participanteIbk').last().find('.inputParticipante').addClass('txtParticipanteNuevo');
            //$(this).parent('.partibk').find('.participanteIbk').last().clone().insertAfter($(this).parent('.partibk').find('.participanteIbk').last());
        });

        $('.btnparticipante').click(function () {
            $('#addParticipante').clone().removeClass('hidden').insertAfter($(this).closest('form').find('.listaParticipantesCliente>.ParticipanteCliente').last());
        });



        $('body').on('change', '.nuevoParticipante', function () {
            console.log('hola');
            console.log(this.value);
            if (this.value == 'nuevo') {
                console.log('entramos a la condicion')
                $('#modalContactoNuevo input').val("");
                $('#modalContactoNuevo #numdocAgregado').val($('#filtroDNIRUC').val());
                $('#modalContactoNuevo #eNegocioAgregado').val("<?php echo e(Auth::user()->REGISTRO); ?>");
                $('#modalContactoNuevo #actividades').val("actividades");
                $('#modalContactoNuevo').modal();
            } else {
                //$(this).parents('form').find('[name="nroParticipantesCliente"]').val('1');

            }
        });


        $('.formatInputNumber').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });
        

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

        $('#frmNuevoContacto').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombres: {
                    validators: {
                        notEmpty: {
                            message: 'El nombre del contacto es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El nombre solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                apepat: {
                    validators: {
                        notEmpty: {
                            message: 'El nombre del contacto es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El apellido solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                apemat: {
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El apellido solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                cargo: {
                    validators: {
                        notEmpty: {
                            message: 'El apellido del contacto es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El cargo solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                telefono: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese el teléfono del contacto'
                        },
                        regexp: {
                            regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                            message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                        }
                    }
                },
                direccion: {
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Z0-9ñÑáéíóúü#°().,\- ]+$/,
                            message: 'La dirección tiene uno o mas caracteres no válidos'
                        }
                    }
                },
                email: {
                    validators: {
                        emailAddress: {
                            message: 'El email ingresado no es válido'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
                    fv = $form.data('formValidation');
            $form.formValidation('disableSubmitButtons', true);


            // Enviamos el formulario en ajax, si todo sale bien lo agregamos al combobox y cerramos el modal 
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {

                    var select = $('.nuevoParticipante option:selected[value="nuevo"]').parent();
                    select.append($('<option>', {
                        value: result._id,
                        text: result._nombre + ' ' + result._apaterno
                    }));
                    $('#modalContactoNuevo').modal('hide');
                    select.val(result._id);
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                }
            });
        });
        //formValVisitas
        //formValVisitas$('#<formValVisitas></formValVisitas>').

        $('#formValVisitas').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                titulo: {
                    validators: {
                        notEmpty: {
                            message: 'El titulo de la actividad es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El nombre solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                ubicacion: {
                    validators: {
                        notEmpty: {
                            message: 'La ubicacion de visita es obligatoria'
                        }
                    }
                },
                nroParticipantesIbk: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        greaterThan: {
                            value: 1,
                            message: 'Ingrese al menos un participante'
                        }
                    }
                },
                nroParticipantesCliente: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        greaterThan: {
                            value: 1,
                            message: 'Ingrese al menos un participante'
                        }
                    }
                },
                hiddenTemas: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        notEmpty: {
                            message: 'Por favor ingrese comentarios en Temas Comerciales o Temas Crediticios'
                        }
                    }
                },   
                flgLinkedin:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,       
                /*flgLinkedin2:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,      */ 

            }
        }).on('keyup', '[name="tComerciales"], [name="tCrediticios"]', function (e) {
            var tCrediticios = $('#formValVisitas').find('[name="tCrediticios"]').val();
            var tComerciales = $('#formValVisitas').find('[name="tComerciales"]').val();
            $('#formValVisitas')
                    // Update the value for hidden field
                    .find('[name="hiddenTemas"]')
                    .val(tCrediticios || tComerciales)
                    .end()
                    // Revalidate it
                    .formValidation('revalidateField', 'hiddenTemas');
        }).on('change', '[name="partCliente[]"]', function () {
            form = $(this).closest('form');
            var x = 0;
            form.find('.contarParticipante').each(function () {
                if ($(this).val() == 'sinParticipante') {
                    x = x + 0;
                } else {
                    x = x + 1;
                }
            });
            $('[name="nroParticipantesCliente"]').val(x);
            $('#formValVisitas').formValidation('revalidateField', 'nroParticipantesCliente');
        });


        $('#formValLlamadas').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                titulo: {
                    validators: {
                        notEmpty: {
                            message: 'El titulo de la actividad es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El nombre solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                ubicacion: {
                    validators: {
                        notEmpty: {
                            message: 'La ubicacion de visita es obligatoria'
                        }
                    }
                },
                nroParticipantesIbk: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        greaterThan: {
                            value: 1,
                            message: 'Seleccione al menos un participante'
                        }
                    }
                },
                nroParticipantesCliente: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        greaterThan: {
                            value: 1,
                            message: 'Seleccione al menos un participante'
                        }
                    }
                },
                hiddenTemas: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        notEmpty: {
                            message: 'Porfavor ingrese comentarios en Temas Comerciales o Temas Crediticios'
                        }
                    }
                },
                flgLinkedin:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,                 
                /*flgLinkedin2:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,   */
            }
        }).on('keyup', '[name="tComerciales"], [name="tCrediticios"]', function (e) {
            var tCrediticios = $('#formValLlamadas').find('[name="tCrediticios"]').val();
            var tComerciales = $('#formValLlamadas').find('[name="tComerciales"]').val();
            $('#formValLlamadas')
                    // Update the value for hidden field
                    .find('[name="hiddenTemas"]')
                    .val(tCrediticios || tComerciales)
                    .end()
                    // Revalidate it
                    .formValidation('revalidateField', 'hiddenTemas');
        }).on('change', '[name="partCliente[]"]', function () {
            form = $(this).closest('form');
            var x = 0;
            form.find('.contarParticipante').each(function () {
                if ($(this).val() == 'sinParticipante') {
                    x = x + 0;
                } else {
                    x = x + 1;
                }
            });
            $('[name="nroParticipantesCliente"]').val(x);
            $('#formValLlamadas').formValidation('revalidateField', 'nroParticipantesCliente');
        });
        //formValCorreo

        $('#formValCorreo').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

                titulo: {
                    validators: {
                        notEmpty: {
                            message: 'El titulo de la actividad es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El nombre solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                hiddenTemas: {
                    excluded: false, // Don't ignore me, please!
                    validators: {
                        notEmpty: {
                            message: 'Porfavor ingrese comentarios en Temas Comerciales o Temas Crediticios'
                        }
                    }
                },
                flgLinkedin:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,                 
                /*flgLinkedin2:{
                    validators: {
                        notEmpty: {
                            message: 'Por favor seleccione una opcion'
                        }
                    }
                }   ,   */
            }
        }).on('keyup', '[name="tComerciales"], [name="tCrediticios"]', function (e) {
            var tCrediticios = $('#formValCorreo').find('[name="tCrediticios"]').val();
            var tComerciales = $('#formValCorreo').find('[name="tComerciales"]').val();

            $('#formValCorreo')
                    // Update the value for hidden field
                    .find('[name="hiddenTemas"]')
                    .val(tCrediticios || tComerciales)
                    .end()
                    // Revalidate it
                    .formValidation('revalidateField', 'hiddenTemas');
        });
    });

</script>
<!-- vertical-timeline -->

<style type="text/css">

    .cbp_tmlabel{
        background-color: #F5F7FA !important;
    }

    .cbp_tmlabel_ce{
        background-color: #FCE16D !important;
    }

    #panelNuevaActividad h1,h2,h3,h4,h5,h6{
        margin: 0px;
    }
    .participanteIbk{
        padding: 0px;
    }
    .twitter-typeahead{
        width: 100%;
    }

    .cbp_tmtimeline > li .cbp_tmlabel{
        color: #9C9C9C;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>