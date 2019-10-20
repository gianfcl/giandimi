<?php $__env->startSection('js-libs'); ?>
<link href="<?php echo e(URL::asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo e(URL::asset('css/formValidation.min.css')); ?>" rel="stylesheet" type="text/css" > 
<link href="<?php echo e(URL::asset('css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet" type="text/css" >
<link href="<?php echo e(URL::asset('css/custom/webfies.css')); ?>" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap-datepicker.es.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(URL::asset('js/fies/DetalleOperaciones.js')); ?>"></script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('pageTitle', 'Detalle de Operaciones'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">
      <div class="x_title">
       <h2>General - <?php echo e($operacion->NOMBRE_CLIENTE); ?></h2>
       <?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
       <ul class="nav navbar-right panel_toolbox">
         <li>
          <a  class="close-link bntEditar" id="">
           <span class="fa fa-pencil-square-o">Editar</span>
         </a>
       </li>
     </ul>
     <?php endif; ?>
     <div class="clearfix"></div>
   </div>
   <div class="x_content">
     <?php if(count($operacion)>0): ?>
     <form   class="form-horizontal" method="post"  action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.informacion')); ?>" >
       <div class="row">
        <div class="form-group col-md-4 col-xs-12">
         <label for="" class="control-label col-md-4 col-xs-3">RUC:</label>
         <div class="col-md-8 col-xs-9">
          <input class="form-control EditGeneral" disabled="true" type="text" name="ruc" value="<?php echo e($operacion->NUM_DOC); ?>" name="documento" id="txtDocumento" maxlength="15" onkeypress="return valida(event)">
          <input type="hidden" name="codOperacion" value="<?php echo e($operacion->COD_OPERACION); ?>" >


        </div>
      </div>


      <div class="form-group col-md-4 col-xs-12">
       <label for="" class="control-label col-md-4 col-xs-3">CU:</label>
       <div class="col-md-8 col-xs-9">
         <input class="form-control EditGeneral" disabled="true" type="text" name="cu" value="<?php echo e($operacion->COD_UNICO); ?>" name="grupoEconomico" id="txtgrupoEconomico" maxlength="50" onkeypress="return valida(event)">
       </div>
     </div>


     <div class="form-group col-md-4 col-xs-12">
      <label for="" class="control-label col-md-4 col-xs-3">Grupo Económico:</label>
      <div class="col-md-8 col-xs-9">
       <input class="form-control EditGeneral" disabled="true" type="text" name="grupoEconomico"value="<?php echo e($operacion->GRUPO_ECONOMICO); ?>" name="Actividad" id="txtActividad" maxlength="50">
     </div>
   </div>
 </div>
 <div class="form-group col-md-4 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Actividad:</label>
   <div class="col-md-8 col-xs-9">
    <input class="form-control EditGeneral" disabled="true" type="text" name="sector" value="<?php echo e($operacion->SECTOR); ?>" name="Banca" id="txtBanca" maxlength="25">
  </div>
</div>
<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Banca:</label>
 <div class="col-md-8 col-xs-9">
  <input class="form-control EditGeneral" disabled="true" type="text" readonly="readonly" name="banca"value="<?php echo e($operacion->BANCA); ?>" name="gZonal" id="txtgZonal" maxlength="25">
</div>
</div>

<div class="form-group col-md-4 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Grupo Zonal</label>
  <div class="col-md-8 col-xs-9">
   <input class="form-control EditGeneral" disabled="true" readonly="readonly" type="text" name="grupoZonal" value="<?php echo e($operacion->GRUPO_ZONAL); ?>" name="eNegocio" id="txteNegocio" maxlength="30">
 </div>
</div>


<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Segmento:</label>
 <div class="col-md-8 col-xs-9">

  <select class="form-control EditGeneral" disabled="true" name="segmento"" name="estatusPipeline" id="txtSegmento" >
   <option><?php echo e($operacion->SEGMENTO); ?> </option>
   <option>Gran empresa</option>
   <option>Mediana empresa</option>
 </select>
</div>
</div>

<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">E. Negocio:</label>
 <div class="col-md-8 col-xs-9">
  <input class="form-control EditGeneral" disabled="true" type="text" name="regEjeNegocio" value="<?php echo e($operacion->REG_EJECUTIVO_NEGOCIO); ?>" name="Segmento" id="txtSegmento" maxlength="15">

</div>
</div>

<div class="form-group col-md-4 col-xs-12">
 <?php echo e($operacion->NOM_EJECUTIVO_NEGOCIO); ?>


</div>


<div></div>


<div class="col-md-5 col-sm-12 col-xs-12"></div>
<div class="col-md-4 col-sm-12 col-xs-12">

 <?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?>        
 <button type="button"  onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'" style="display: none;" id="CancelarGeneral" class="btn btn-sm btn-primary btnCancelar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;" id="GuardarGeneral" class="btn btn-sm btn-primary btnGuardar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Guardar</button>  
 <?php endif; ?>

</div>
<div> </div>


</form>
<?php else: ?>
<div><span>No se Encontraron resultados</span></div>
<?php endif; ?>
</div>

</div>
<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="x_panel contEstaciones">
  <div class="x_title">
   <h2>Estación</h2>
   <ul class="nav navbar-right panel_toolbox">
   </ul>
   <div class="clearfix"></div>
 </div>
 <div class="x_content">


   <div class="row row tile_count">
    <div class="col-md-3"></div>
    <form class="form-horizontal" method="POST"  action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.producto')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" > 
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
       <span class="count_top"><i class="fa"></i>Producto:</span>
       <?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
       <button type="button" href="" class="close-link btnEdProducto" id="">
        <span class="fa fa-pencil-square-o">Editar</span>
      </button> 
      <button   type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'" class="close-link btnCaProducto" style="display:none;"">
        <span class="fa fa-close"> Cancelar</span>
      </button>
      <button  type="submit" href="" class="close-link btnOkProducto" style="display:none;"">
        <span class="fa fa-check">Ok</span>
      </button>

      <?php endif; ?>
      <select class="form-control" name="producto"  >
        <option><?php echo e($operacion->PRODUCTO); ?></option>  
        <option value="Pagaré" >Pagaré</option>
        <option value="Carta Fianza" >Carta Fianza</option>
        <option value="Leasing" >Leasing</option>
      </select>  

    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa"></i>Estación: </span> 
      <input class="form-control EditGeneral" disabled="true" type="text" name="estacion" value="<?php echo e($operacion->ULTIMO_ESTACION); ?>" name="Banca" id="txtBanca" maxlength="25">      
    </div>

    <div class="col-md-5 col-sm-12 col-xs-12"></div>
    <div class="col-md-4 col-sm-12 col-xs-12">
      <button type="button" style="display: none;" id="CancelarGeneral" class="btn-sm btn-primary btnCancelar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
      <button style="display: none;" id="GuardarGeneral" class="btn btn-sm btn-primary btnGuardar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Guardar</button>      
    </div>
    <div> </div>



  </form>

  <div>			        	
  </div>
</div>
<div></div>
<div style="margin-top: 25px;">
 <div class="col-xs-2">
   <!-- required for floating -->
   <!-- Nav tabs -->
   <ul class="nav nav-tabs tabs-left">
     <li <?php if($estacion==1): ?>) 
     class="active" 
     <?php endif; ?>>
     <a href="#pipeline" data-toggle="tab">Pipeline</a>
   </li>
   <li <?php if($estacion==2): ?>) 
   class="active" 
   <?php endif; ?>><a href="#cotizacion" data-toggle="tab">Cotización</a>
 </li>
 <li <?php if($estacion==3): ?>) 
 class="active" 
 <?php endif; ?>><a href="#fies" data-toggle="tab">FIES</a>
</li>
<li <?php if($estacion==4): ?>) 
class="active" 
<?php endif; ?>><a href="#riesgos" data-toggle="tab">Riesgos</a>
</li>
<li <?php if($estacion==5): ?>) 
class="active" 
<?php endif; ?> ><a href="#aprobado" data-toggle="tab"  >Aprobado</a>
</li>
</ul>
</div>

<div class="col-xs-10">
  <div class="tab-content">

    <!--pipeline-->
    <div class="tab-pane row <?php if($estacion==1): ?>
    active
    <?php endif; ?>" id="pipeline">
    <form  method="POST"  action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.pipeline')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" >
     <div class=" col-md-6 col-xs-6">
      <div class="form-group col-md-12 col-xs-12">
       <label for="" class="control-label col-md-4 col-xs-3">Fecha de ingreso:</label>
       <div class="col-md-8 col-xs-9">
        <input class="form-control" type="text" name="fechaIngreso"  readonly="readonly" id="Text2" maxlength="15"  
        value=<?php if(isset($estAtributo[0]->VALOR)): ?> 
        <?php echo e($estAtributo[0]->VALOR); ?>  
        <?php else: ?>  
        <?php endif; ?>  > 

      </div>
    </div>
    <input type="hidden" name="fechaRegistroPipeline" value="<?php echo e($estAtributo[0]->VALOR); ?> " />


    <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Estatus:</label>
     <div class="col-md-8 col-xs-9">
      <select class="form-control" name="estatusPipeline">
        <option><?php if(isset($estAtributo[1]->VALOR)): ?> 
         <?php echo e($estAtributo[1]->VALOR); ?>  
         <?php else: ?> --Seleccione--
       <?php endif; ?> </option>
       <option>Falta información</option>
       <option>Revisión FIES</option>
       <option>En consulta</option>
       <option>Revisión Banca</option>
     </select>	
   </div>	                

 </div>
 <div class="form-group col-md-12 col-xs-12">
  <label  class="control-label col-md-4 col-xs-3">Sin Éxito:</label>
  <div class="col-md-1 col-xs-1">
   <input type="checkbox" name="sePipeline" class="chkSinExito" aria-label="" value="sin Exito"
   <?php echo ((isset($estAtributo[2]->VALOR))? 'checked':'') ?> />
 </div>
 <div class="col-md-7 col-xs-8">
   <select class="form-control listSinExito" name="motivoSEPipeline">
    <option><?php if(isset($estAtributo[3]->VALOR)): ?> 
     <?php echo e($estAtributo[3]->VALOR); ?>  
     <?php else: ?> --Seleccione--
   <?php endif; ?> </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>	
</div>



</div>
<div class="divEstacion">
 <?php if($estAtributo[5]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ): ?> 

 <?php else: ?>
 <button type="button"   style="display: none;" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'"   class="btnCancelarS btnEditarEstacion" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;"  class="btnGuardarS btnEditarEstacion"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
 <button type="button"  style="display: ;" class="bntEditarS btnEditarEstacion "  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
 <?php endif; ?>

</div>

</div>  

<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
   <textarea   type="text" class="form-control txtComentario" name="comentarioPipeline"  id="comentarioPipe" placeholder="Max. 150 caracteres"><?php if(isset($estAtributo[4]->VALOR)): ?> <?php echo e($estAtributo[4]->VALOR); ?><?php endif; ?></textarea>
 </div>



</div>            


</form>
<?php if($estAtributo[5]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ): ?> 

<?php else: ?>    
<div style="float: right;">         
  <button   type="button" style="display: ;" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=1'"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
<?php endif; ?>


</div>
<!--COTIZACION-->
<div class="tab-pane row <?php if($estacion==2): ?>) 
active
<?php endif; ?> " id="cotizacion">

<form  method="POST" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cotizacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" >

  <div class="col-md-6 col-xs-6">
    <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Fecha de envío:</label>
     <div class="col-md-8 col-xs-9">
      <input class="form-control dfecha txt" type="text" id="txtFecha" name="fechaEnvioCotizacion" onkeydown="return false" onkeypress="return validaLetras(event)" value=<?php if(isset($estAtributo[6]->VALOR)): ?>
      <?php echo e($estAtributo[6]->VALOR); ?>   
      <?php endif; ?>  >

    </div>
  </div>


  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Estatus:</label>
   <div class="col-md-8 col-xs-9">
     <select class="form-control" name="estatusCotizacion">
       <option><?php if(isset($estAtributo[7]->VALOR)): ?> 
        <?php echo e($estAtributo[7]->VALOR); ?>  
        <?php else: ?> --Seleccione--
      <?php endif; ?> </option>
      <option>En espera de resupuesta del cliente</option>
      <option>Revision FIES</option>
      <option>En consulta</option>
      <option>Revisión Banca</option>
    </select>	
  </div>	                
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Probabilidad:</label>
  <div class="col-md-8 col-xs-9">
   <select class="form-control" name="probabilidadCotizacion">
     <option><?php if(isset($estAtributo[8]->VALOR)): ?> 
      <?php echo e($estAtributo[8]->VALOR); ?>  
      <?php else: ?> --Seleccione--
    <?php endif; ?> </option>
    <option>Baja</option>
    <option>Media</option>
    <option>Alta</option>
  </select>	
</div>	                
</div>	

<div class="form-group col-md-12 col-xs-12">


 <label for="" class="control-label col-md-4 col-xs-3">Sin Éxito:</label>

 <div class="col-md-1 col-xs-1">
  <input lead="#" type="checkbox"  class="chkSinExito" aria-label="" name="seCotizacion"
  <?php echo ((isset($estAtributo[9]->VALOR))? 'checked':'') ?> />
</div>

<div class="col-md-7 col-xs-8">
  <select class="form-control listSinExito" name="motivoSECotizacion">
   <option><?php if(isset($estAtributo[10]->VALOR)): ?> 
     <?php echo e($estAtributo[10]->VALOR); ?>  
     <?php else: ?> --Seleccione--
   <?php endif; ?> </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>	
</div>


<div class="divEstacion">


 <?php if($estAtributo[12]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ): ?> 


 <?php else: ?>
 <?php if($estAtributo[5]->VALOR=="1" ): ?>
 <button type="button" style="display: none;" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;"  class="btnGuardarS btnEditarEstacion"   class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
 <button type="button" style="display:  ;" class="bntEditarS btnEditarEstacion "  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
 <?php endif; ?>
 <?php endif; ?>

</div>



</div>



</div>

<div class="form-group col-md-6 col-xs-6">
  <label class="control-label col-md-4 col-xs-3">Comentario:</label>
  <div class="col-md-8 col-xs-9">
    <textarea    class="form-control txtComentario
    " name="comentarioCotizacion" id="comentarioCoti" placeholder="Max. 150 caracteres"><?php if(isset($estAtributo[11]->VALOR)): ?> <?php echo e($estAtributo[11]->VALOR); ?><?php endif; ?></textarea>
  </div>

</div>


</form>

<?php if( ($estAtributo[12]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA") ||  empty($estAtributo[6]->VALOR)): ?> 

<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" ): ?>
<div style="float: right;">  
 <button type="button" style="display:  ;"   onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=2'" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
<?php endif; ?>

<?php endif; ?>

</div>
<!-- FIES-->
<div class="tab-pane row <?php if($estacion==3): ?>) 
active
<?php endif; ?>" id="fies">
<form  method="POST" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.fies')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" >
 <div class="col-md-6 col-xs-6">		
  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Fecha de cotización aceptada:</label>
   <div class="col-md-8 col-xs-9">
    <input class="form-control dfecha" type="text" name="fechaIngresoCotizacion" id="dFechaFiies" onkeypress="return validaLetras(event)" value=<?php if(isset($estAtributo[13]->VALOR)): ?>       <?php echo e($estAtributo[13]->VALOR); ?>   
    <?php endif; ?> >
  </div>
</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-2 col-xs-3">Estatus:</label>
 <div class="col-md-5 col-xs-4">
   <select class="form-control" name="estatusFies">
     <option><?php if(isset($estAtributo[14]->VALOR)): ?> 
      <?php echo e($estAtributo[14]->VALOR); ?>  
      <?php else: ?> --Seleccione--
    <?php endif; ?> </option>
    <option>Revision FIES</option>
    <option>En consulta</option>
    <option>Revisión Banca</option>
  </select>	
</div>
<label for="" class="control-label col-md-2 col-xs-2">Fecha:</label>
<div class="col-md-3 col-xs-3">
  <input class="form-control dfecha" type="text"  name="fechaEstatusFies" id="dFechaFiesGestion" onkeypress="return validaLetras(event)" maxlength="15" value=<?php if(isset($estAtributo[15]->VALOR)): ?> 
  <?php echo e($estAtributo[15]->VALOR); ?>   
  <?php endif; ?>>	
</div>

</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Comité:</label>
 <div class="col-md-8 col-xs-9">
  <select class="form-control" name="comiteFies">
    <option><?php if(isset($estAtributo[16]->VALOR)): ?> 
     <?php echo e($estAtributo[16]->VALOR); ?>  
     <?php else: ?> --Seleccione--
   <?php endif; ?> </option>
   <option>Central</option>
   <option>Ejecutivo</option>
   <option>Gerente de División</option>
   <option>Subgerente</option>
 </select>	
</div>	                
</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Tipo:</label>
 <div class="col-md-8 col-xs-9">
  <select class="form-control" name="tipoFies">
   <option><?php if(isset($estAtributo[17]->VALOR)): ?> 
    <?php echo e($estAtributo[17]->VALOR); ?>  
    <?php else: ?> --Seleccione--
  <?php endif; ?> </option>
  <option>Simple</option>
  <option>Complejo</option>
</select>	
</div>	                
</div>	

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Probabilidad:</label>
 <div class="col-md-8 col-xs-9">
  <select class="form-control" name="probabilidadFies" >
    <option><?php if(isset($estAtributo[18]->VALOR)): ?> 
     <?php echo e($estAtributo[18]->VALOR); ?>  
     <?php else: ?> --Seleccione--
   <?php endif; ?> </option>
   <option>Baja</option>
   <option>Media</option>
   <option>Alta</option>
 </select>	
</div>
</div>	

<div class="form-group col-md-12 col-xs-12">	

 <label for="" class="control-label col-md-4 col-xs-3">Sin Éxito:</label>

 <div class="col-md-1 col-xs-1">
  <input lead="#" type="checkbox" class="chkSinExito" aria-label="" name="seFies"
  <?php echo ((isset($estAtributo[19]->VALOR))? 'checked':'') ?> />
</div>
<div class="col-md-7 col-xs-8">
  <select class="form-control listSinExito" name="motivoSEFies">
   <option><?php if(isset($estAtributo[20]->VALOR)): ?> 
    <?php echo e($estAtributo[20]->VALOR); ?>  
    <?php else: ?> --Seleccione--
  <?php endif; ?> </option>
  <option>Denegada por Riegos</option>
  <option>Denegada por FIES</option>
  <option>Denegada por el cliente</option>
  <option>Falta información</option>
</select>	
</div>
<?php if($estAtributo[22]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"): ?> 


<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" ): ?>
<button type="button"   style="display:  ;" class="bntEditarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>

<button type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'" style="display: none;"   class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>

<?php endif; ?>
<?php endif; ?>

</div>
</div>

<div class="row top_tiles col-md-6 col-xs-6">
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
   <div class="tile-stats">

    <div class="icon"><i class="fa fa-suitcase"></i></div>
    <div class="count"><?php echo e($diasOpe->TIEMPO_FIES); ?> </div>
    <h3>FIES</h3>
  </div>
</div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-user"></i></div>
   <div class="count"><?php echo e($diasOpe->TIEMPO_CLIENTE); ?></div>
   <h3>Clientes</h3>
 </div>
</div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-university"></i></div>
   <div class="count"><?php echo e($diasOpe->TIEMPO_BANCA); ?></div>
   <h3>Banca</h3>
 </div>
</div>
</div>

<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea  class="form-control txtComentario" name="comentarioFies"  id="comentario" placeholder="Max. 150 caracteres"><?php if(isset($estAtributo[21]->VALOR)): ?> <?php echo e($estAtributo[21]->VALOR); ?><?php endif; ?></textarea>

</div>




</div>
</form>   
<?php if($estAtributo[22]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ||  empty($estAtributo[13]->VALOR)  ): ?>

<?php else: ?>

<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && isset($estAtributo[14]->VALOR)): ?> 
<div style="float: right;">  
 <button type="button" style="display: <?php if($estAtributo[22]->VALOR=="1" ): ?> none <?php endif; ?> ;"  onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=3'" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
<?php endif; ?>

<?php endif; ?>  


</div>
<!--RIEGOS-->
<div class="tab-pane row <?php if($estacion==4): ?>) 
active
<?php endif; ?>" id="riesgos">
<form  method="POST" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.riesgos')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" >              	
 <div class="col-md-6 col-xs-6">
   <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Fecha recepción:</label>
     <div class="col-md-8 col-xs-9">
       <input class="form-control dfecha" type="text"  name="fechaRecepcionRiesgos" id="dFechaRiesgos" maxlength="15" onkeypress="return validaLetras(event)" value=<?php if(isset($estAtributo[23]->VALOR)): ?> 
       <?php echo e($estAtributo[23]->VALOR); ?>   
       <?php endif; ?>>
     </div>
   </div>

   <div class="form-group col-md-12 col-xs-12">
    <label for="" class="control-label col-md-2 col-xs-3">Estatus:</label>
    <div class="col-md-5 col-xs-4">
     <select class="form-control" name="estatusRiesgos">
       <option><?php if(isset($estAtributo[24]->VALOR)): ?> 
        <?php echo e($estAtributo[24]->VALOR); ?>  
        <?php else: ?> --Seleccione--
      <?php endif; ?> </option>
      <option>Revisión Riesgos</option>
      <option>En consulta</option>
      <option>Revisión Banca</option>
      <option>Revision FIES</option>
    </select>	
  </div>
  <label for="" class="control-label col-md-2 col-xs-2">Fecha:</label>
  <div class="col-md-3 col-xs-3">
   <input class="form-control dfecha" type="text"  name="fechaEstatusRiesgos" id="dFechaRiesgosGestion" onkeypress="return validaLetras(event)" maxlength="15" value=<?php if(isset($estAtributo[25]->VALOR)): ?> 
   <?php echo e($estAtributo[25]->VALOR); ?>   
   <?php endif; ?>>
 </div>
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">WF:</label>
  <div class="col-md-8 col-xs-9">
   <input class="form-control" type="text"  name="wfRiesgos" id="Text5" maxlength="15" onkeypress="return valida(event)" value=<?php if(isset($estAtributo[26]->VALOR)): ?> 
   <?php echo e($estAtributo[26]->VALOR); ?>   
   <?php endif; ?>>
 </div>                
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Probabilidad:</label>
  <div class="col-md-8 col-xs-9">
   <select class="form-control" name="probabilidadRiesgos">
     <option><?php if(isset($estAtributo[27]->VALOR)): ?> 
      <?php echo e($estAtributo[27]->VALOR); ?>  
      <?php else: ?> --Seleccione--
    <?php endif; ?> </option>
    <option>Baja</option>
    <option>Media</option>
    <option>Alta</option>
  </select>	
</div>	                
</div>	

<div class="form-group col-md-12 col-xs-12">	
  <label for="" class="control-label col-md-4 col-xs-3">Sin Éxito:</label>

  <div class="col-md-1 col-xs-1">
   <input lead="#" type="checkbox"aria-label=""  class="chkSinExito" name="seRiesgos"
   <?php echo ((isset($estAtributo[28]->VALOR))? 'checked':'') ?> />
 </div>
 <div class="col-md-7 col-xs-8">
   <select class="form-control listSinExito" name="motivoSERiesgos">
    <option><?php if(isset($estAtributo[29]->VALOR)): ?> 
     <?php echo e($estAtributo[29]->VALOR); ?>  
     <?php else: ?> --Seleccione--
   <?php endif; ?> </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>	
</div> 
</div>
<?php if($estAtributo[31]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ): ?> 

<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" ): ?>
<button type="button" style="display: ;" class="bntEditarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>

<button style="display: none;"   type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>

<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
<?php endif; ?>
<?php endif; ?>


</div>
<div class="row top_tiles col-md-16 col-xs-6">
 <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
   <div class="tile-stats">
    <div class="icon"><i class="fa fa-suitcase"></i></div>
    <div class="count"><?php echo e($diasOpe->TIEMPO_FIES); ?></div>
    <h3>FIES</h3>
  </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-user"></i></div>
   <div class="count"><?php echo e($diasOpe->TIEMPO_CLIENTE); ?></div>
   <h3>Clientes</h3>
 </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-university"></i></div>
   <div class="count"><?php echo e($diasOpe->TIEMPO_BANCA); ?></div>
   <h3>Banca</h3>
 </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
  <div class="tile-stats">
    <div class="icon"><i class="fa fa-university"></i></div>
    <div class="count"><?php echo e($diasOpe->TIEMPO_RIESGOS); ?></div>
    <h3>Riesgos</h3>
  </div>
</div>
</div>

<div class="form-group col-md-16 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea    class="form-control txtComentario" name="comentarioRiesgos" id="comentario" placeholder="Max. 150 caracteres"><?php if(isset($estAtributo[30]->VALOR)): ?> <?php echo e($estAtributo[30]->VALOR); ?>  <?php endif; ?></textarea>


</div>

</div>
</form> 	 

<?php if($estAtributo[31]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"   ||  empty($estAtributo[23]->VALOR)): ?> 

<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && isset($estAtributo[23]->VALOR) && isset($estAtributo[25]->VALOR)): ?>
<div style="float: right;">  
  <button  type="button"  style="display: <?php if($estAtributo[31]->VALOR=="1" ): ?> none <?php endif; ?> ;"   onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=4'" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
<?php endif; ?>
<?php endif; ?>         
</div>
<!--APROBADO-->
<div class="tab-pane row <?php if($estacion==5): ?>
active
<?php endif; ?>" id="aprobado">
<form  method="POST" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.aprobado')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>" >
 <div class="col-md-6 col-xs-6">
  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Fecha de aprobación:</label>
   <div class="col-md-8 col-xs-9">
    <input class="form-control dfecha" type="text"  name="fechaAprobacion" id="Text7" maxlength="15" onkeypress="return validaLetras(event)" value=<?php if(isset($estAtributo[32]->VALOR)): ?> 
    <?php echo e($estAtributo[32]->VALOR); ?>   
    <?php endif; ?>>
  </div>
</div>


<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Tipo de comisión:</label>
  <div class="col-md-8 col-xs-9">
   <select class="form-control" name="tipoComisionAprobado">
    <option><?php if(isset($estAtributo[33]->VALOR)): ?> 
      <?php echo e($estAtributo[33]->VALOR); ?>  
      <?php else: ?> --Seleccione--
    <?php endif; ?> </option>
    <option>Estructurado</option>
    <option>Pre-cancelacion</option>
    <option>Waiver</option>
    <option>Asesoria</option>
  </select>	
</div>
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-3 col-xs-2">Garantía:</label>
  <div class="col-md-3 col-xs-5">
   <input class="form-control" type="text" name="garantiaAprobado" id="Text8" maxlength="15" onkeypress="return valida(event)" value=<?php if(isset($estAtributo[34]->VALOR)): ?> 
   <?php echo e($estAtributo[34]->VALOR); ?>   
   <?php endif; ?>>
 </div>   
 <div class="col-md-4 col-xs-3">
   <select class="form-control"  name="tipoGarantiaAprobado">
     <option><?php if(isset($estAtributo[35]->VALOR)): ?> 
      <?php echo e($estAtributo[35]->VALOR); ?>  
      <?php else: ?> --Seleccione--
    <?php endif; ?> </option>
    <option>%</option>
    <option>PEN</option>
    <option>USD</option>
  </select>	
</div> 


</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-3 col-xs-3">Convenant:</label>
 <div class="col-md-3 col-xs-2">
  <select class="form-control" name="flagCovenantAprobado" id="selectConvenant">

   <?php if(isset($estAtributo[36]->VALOR)): ?> 
   <option><?php echo e($estAtributo[36]->VALOR); ?>  </option>
   <?php if($estAtributo[36]->VALOR=='Si'): ?>
   <option>No</option>
   <?php else: ?>
   <option>Si</option>
   <?php endif; ?>
   <?php else: ?>
   <option>No</option>
   <option>Si</option>
   <?php endif; ?>
 </select>	
</div> 

<div class="col-md-6 col-xs-5" name="opcionCovenant" id="listConvenant" style="display: none;">
  <div class="form-check">
   <label class="form-check-label">


    <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant1" id="1" value="1" aria-label="..." <?php echo ((isset($estAtributo[37]->VALOR))? 'checked':'') ?>>
    Cobertura servicio de deuda
  </label>
</div>
<div class="form-check">
 <label class="form-check-label">
  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant2" id="2" value="1" aria-label="..." <?php echo ((isset($estAtributo[38]->VALOR))? 'checked':'') ?>>
  Ratio de liquidez
</label>
</div> 
<div class="form-check">
 <label class="form-check-label">


  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant3" id="3" value="1" aria-label="..." <?php echo ((isset($estAtributo[39]->VALOR))? 'checked':'') ?>>
  Apalancamiento Contable
</label>
</div> 
<div class="form-check">
 <label class="form-check-label">
  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant4" id="4" value="1" aria-label="..." <?php echo ((isset($estAtributo[40]->VALOR))? 'checked':'') ?>>
  Apalancamiento Financiero
</label>
</div>

</div> 


</div>

<div class="form-group col-md-12 col-xs-12 sinExito">	
 <label for="" class="control-label col-md-4 col-xs-3">Sin Éxito:</label>

 <div class="col-md-1 col-xs-1">
  <input lead="#" type="checkbox" aria-label="" class="chkSinExito" name="seAprobado"

  <?php echo ((isset($estAtributo[41]->VALOR))? 'checked':'') ?> />
</div>
<div class="col-md-7 col-xs-8" id="tipoCovenant">
  <select class="form-control listSinExito" name="motivoSEAprobado">
   <option><?php if(isset($estAtributo[42]->VALOR)): ?> 
    <?php echo e($estAtributo[42]->VALOR); ?>  
    <?php else: ?> --Seleccione--
  <?php endif; ?> </option>
  <option>Denegada por Riegos</option>
  <option>Denegada por FIES</option>
  <option>Denegada por el cliente</option>
  <option>Falta información</option>
</select> 
</div> 
</div>
<?php if($estAtributo[44]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"   ): ?> 

<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && $estAtributo[31]->VALOR=="1" ): ?>
<button type="button" style="display: ;" class="bntEditarS"  id="btnAprobado" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
<button style="display: none;" type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
<?php endif; ?>
<?php endif; ?>
</div>
<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea   class="form-control txtComentario" name="comentarioAprobado"  id="comentario" placeholder="Max. 150 caracteres"><?php if(isset($estAtributo[43]->VALOR)): ?>          <?php echo e($estAtributo[43]->VALOR); ?>  
  <?php endif; ?></textarea>                                            

</div>

</div>
</form>  

<?php if($estAtributo[44]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ||  empty($estAtributo[32]->VALOR)): ?> 

<?php else: ?>
<?php if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && $estAtributo[31]->VALOR=="1"): ?>
<div style="float: right;">  

 <button  type="button"  style="display: <?php if($estAtributo[44]->VALOR=="1" ): ?> none <?php endif; ?> ;"   onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=5'" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>

</div>
<?php endif; ?>
<?php endif; ?>          
</div>





</div>

<div class="clearfix"></div>

</div>
</div>
</div>
</div>

</div>
</div>


<div class="col-md-6 col-sm-6 col-xs-6">

  <div class="x_panel contDesembolCronograma">
   <div class="x_title">
    <h2>Desembolsos</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">       
   <div class="row tile_count desembolso">
     <?php if(count($infoProductos)>0): ?>
     <form type="GET" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.actualizar-Operacion')); ?>">
      <div class="col-md-2"></div>
      <div class="col-md-4 col-sm-4 col-xs-7 tile_stats_count content">
       <input type="hidden" name="codOperacion" value="<?php echo e($operacion->COD_OPERACION); ?>" >
       <input type="hidden" name="tipo" value="<?php echo e($infoProductos->TIPO); ?>">
       <span class="count_top"><i class="fa"></i>Monto:</span>
       <div class="form-group col-md-12 col-xs-12" style=" padding-right: 0px;    padding-left: 0px;">
        <div class="col-md-5 col-xs-5">
         <select id="monedaDesembolso" name="moneda" class="form-control" style="padding-right: 0px;" value="<?php echo e($infoProductos->MONEDA); ?>">	                            
          <option value="PEN">PEN</option>
          <option value="USD">USD</option>
        </select>	
      </div>    
      <div class="col-md-7 col-xs-7" style="padding-right: 0px;  padding-left: 2px;">			              

        <input class="form-control formatInputNumber" onkeypress="return valida(event)" type="text"  name="montoTotal" id="inDesembolsoClass" maxlength="15" value="<?php echo e(number_format((int)$infoProductos->MONTO,0,'.',',')); ?>">

        


      </div>   			                                          
    </div>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
   <span class="count_top Cronograma"><i class="fa"></i>Año :</span>
   <select class="form-control" name="mesProbable" id="mesProbableDesembolso" value="<?php echo e(substr($infoProductos->MES_PROBABLE,0,3)); ?>">

    <?php $__currentLoopData = $meses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
    <option value="<?php echo e($mes); ?>"><?php echo e($mes); ?></option>   
  }
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
 <span class="count_top Cronograma"><i class="fa"></i>Mes :</span>
 <select class="form-control" name="añoProbable" id="añoProbableDesembolso" value="<?php echo e(substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?>">     
  <option value="<?php echo e(substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?>"><?php echo e(substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?></option>                                        
  <?php $__currentLoopData = $años; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $año): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
  <option value="<?php echo e($año); ?>"><?php echo e($año); ?></option>   
}
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
<button  type="button"  href="#contDesembolCronograma" class="close-link btnEditarDesCom" id=""><span class="glyphicon glyphicon-edit"></span></button>

<button  type="button" type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'" href="#contDesembolCronograma" style="display: none;" class="close-link btnCancelarDesCom" id=""><span class="glyphicon glyphicon-remove"></span></a></button>
<button    type="submit" style="display: none;" class="close-link btnOkDesCom" id=""><span class="glyphicon glyphicon-ok"></span></button>
<?php endif; ?>
<input type="hidden" id="codOperacion" value="<?php echo e($operacion->COD_OPERACION); ?>">
</form>
<?php else: ?>
<div ><span>No se Encontraron resultados</span></div>       
<?php endif; ?>

<table id="tblCuotasDesembolso" class="table table-condensed" >
 <thead>

   <tr>
     <th style="vertical-align: middle; text-align: center;">Mes</th>	
     <th style="vertical-align: middle; text-align: center;">Monto</th>
     <th style="vertical-align: middle; text-align: center;">Estado</th>

     <th style="vertical-align: middle; text-align: center;">Fecha</th>
     <th style="vertical-align: middle; text-align: center;"></th>
   </tr>
 </thead>

 <tbody>
  <?php if(count($cuotaDesembolsos)>0): ?>
  <?php  $conta=1?>
  <?php $__currentLoopData = $cuotaDesembolsos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuotaDesembolso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr class="tr-<?php echo $conta;?>-<?php echo e($cuotaDesembolso->TIPO); ?>">
   <td class="mesProb" style="vertical-align: middle; text-align: center;"><?php echo e($cuotaDesembolso->MES); ?></td>
   <td class="montoD numberMiles" style="vertical-align: middle; text-align: center;"><?php echo e(number_format((int)$cuotaDesembolso->MONTO,0,'.',',')); ?></td>
   <td class="estadoD" style="vertical-align: middle; text-align: center;"><?php echo e($cuotaDesembolso->ESTATUS); ?></td>
   <td class="fechaD" style="vertical-align: middle; text-align: center;"><?php echo e($cuotaDesembolso->FECHA); ?></td>
   <td style="vertical-align: middle; text-align: center;">
     <?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
     <button class="btn btn-sm btn-danger btnEditarCuota">Editar</button>
     <button type="button"  class="btn btn-sm btn-danger btnQuitarCuota ">Quitar</button>
     <input type="hidden" class="tipo" name="tipo" value="<?php echo e($cuotaDesembolso->TIPO); ?>">
     <?php endif; ?>
   </td>
 </tr>
 <?php  $conta=$conta+1?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
 <?php else: ?>
 <tr>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
 </tr> 
 <?php endif; ?>                        
</tbody>
</table>
<?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
<button id="btnNevaCuotaDesembolso" class="btn btn-sm btn-primary btnNevaCuota"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</button>
<?php endif; ?>
<?php if(count($infoProductosC)>0): ?>
<input type="hidden" class="tipoOperacion" name="tipo" value="<?php echo e($infoProductos->TIPO); ?>">
<?php endif; ?>
</div>    	   					
</div>
</div>
</div>

<div class="col-md-6 col-sm-6 col-xs-6">

 <div class="x_panel contDesembolCronograma">
   <div class="x_title">
    <h2>Comisión</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">       
   <div class="row tile_count comision">
     <?php if(count($infoProductosC)>0): ?>
     <form id="formComisionActualizar" type="GET" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.actualizar-Operacion')); ?>">
       <div class="col-md-2"></div>
       <div class="col-md-4 col-sm-4 col-xs-7 tile_stats_count content">
        <input type="hidden" name="codOperacion" value="<?php echo e($operacion->COD_OPERACION); ?>" >
        <input type="hidden" name="tipo" value="<?php echo e($infoProductosC->TIPO); ?>">
        <input type="hidden" name="moneda" value="<?php echo e($infoProductosC->MONEDA); ?>">
        <span class="count_top"><i class="fa"></i>Monto:</span>
        <div class="form-group col-md-12 col-xs-12" style=" padding-right: 0px;    padding-left: 0px;">
          <div class="col-md-5 col-xs-5">
            <select id="tipoComision"  class="form-control" style="padding-right: 0px;" value="<?php echo e($infoProductosC->MONEDA); ?>">        
             <option value="procentual">%</option>                      
             <option value="Importe">Importe</option>

           </select> 
         </div>   
         <div class="col-md-7 col-xs-7" style="padding-right: 0px;  padding-left: 2px;">                   

           <input  class="form-control formatInputNumber comisionInput "  id="inComisionValor"  type="text"  name="comisionValor" id="Text8"  maxlength="15" value="<?php echo e(number_format((int)$infoProductosC->MONTO,0,'.',',')); ?>">

           <input  class="form-control InputsNumber comisionInput"  id="inComisionPorcentaje" type="hidden"  name="comisionProcentaje" id="Text8"  maxlength="15" value="<?php echo e(round(((int)$infoProductosC->MONTO/(int)$infoProductos->MONTO)*100)); ?>%">
           <input  class="form-control" type="hidden"  name="valorDesembolso" id="valorDesembolso"  maxlength="15" value="<?php echo e($infoProductos->MONTO); ?>">
           <input id="inComisionSoles"  placeholder="Disabled input"  class="form-control " type="text"  readonly="readonly" name="montoTotal" id="Text8" maxlength="15" value="<?php echo e(number_format((int)$infoProductosC->MONTO,0,'.',',')); ?>">

         </div>                                                  
       </div>

     </div>
     <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
       <span class="count_top Cronograma"><i class="fa"></i>Mes. :</span>                                  
       <select class="form-control" name="mesProbable" id="mesProbableCuota" value="<?php echo e(substr($infoProductosC->MES_PROBABLE,0,3)); ?>">

        <?php $__currentLoopData = $meses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
        <option value="<?php echo e($mes); ?>"><?php echo e($mes); ?></option>   
      }
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
    <span class="count_top Cronograma"><i class="fa"></i>Año. :</span>
    <select class="form-control" name="añoProbable" id="añoProbableCuota" value="<?php echo e(substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?>">                                        
     <option value="<?php echo e(substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?>"><?php echo e(substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))); ?></option>
     <?php $__currentLoopData = $años; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $año): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
     <option value="<?php echo e($año); ?>"><?php echo e($año); ?></option>   
   }
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>
</div>
<?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
<button  type="button"  href="#contDesembolCronograma" class="close-link btnEditarDesCom" id=""><span class="glyphicon glyphicon-edit"></span></button>
<button  type="button" type="button" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.detalle')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>'" href="#contDesembolCronograma" style="display: none;" class="close-link btnCancelarDesCom" id=""><span class="glyphicon glyphicon-remove"></span></a></button>

<button    type="submit" style="display: none;" class="close-link btnOkDesCom" id=""><span class="glyphicon glyphicon-ok"></span></button>
<?php endif; ?>
<input type="hidden" id="codOperacionDes" value="<?php echo e($operacion->COD_OPERACION); ?>">
</form>
<?php else: ?>
<div ><span>No se Encontraron resultados</span></div>       
<?php endif; ?>
<table id="tblCuotasDesembolso" class="table table-condensed" >
  <thead>

   <tr>
     <th style="vertical-align: middle; text-align: center;">Mes</th>  
     <th style="vertical-align: middle; text-align: center;">Monto</th>
     <th style="vertical-align: middle; text-align: center;">Estado</th>

     <th style="vertical-align: middle; text-align: center;">Fecha</th>
     <th style="vertical-align: middle; text-align: center;"></th>
   </tr>
 </thead>
 <tbody>
   <?php if(count($cuotasComisiones)>0): ?>
   <?php  $conta=1?>
   <?php $__currentLoopData = $cuotasComisiones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuotasComision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <tr class="tr-<?php echo $conta;?>-<?php echo e($infoProductosC->TIPO); ?>">

    <td class="mesProb" style="vertical-align: middle; text-align: center;"><?php echo e($cuotasComision->MES); ?></td>
    <td class="montoD" style="vertical-align: middle; text-align: center;"><?php echo e(number_format((int)$cuotasComision->MONTO,0,'.',',')); ?></td>
    <td class="estadoD" style="vertical-align: middle; text-align: center;"><?php echo e($cuotasComision->ESTATUS); ?></td>
    <td class="fechaD" style="vertical-align: middle; text-align: center;"><?php echo e($cuotasComision->FECHA); ?></td>
    <td style="vertical-align: middle; text-align: center;">
      <?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
      <button class="btn btn-sm btn-danger btnEditarCuota">Editar</button>
      <button type="button"  class="btn btn-sm btn-danger btnQuitarCuota ">Quitar</button>     
      <?php endif; ?>                                 
    </td>
    <input type="hidden" class="tipo" name="tipo" value="<?php echo e($cuotasComision->TIPO); ?>">
  </tr>
  <?php  $conta=$conta+1?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                         
  <?php else: ?>
  <tr>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
 </tr>  
 <?php endif; ?>  
</tbody>
</table>
<?php if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ): ?> 
<button id="btnNevaCuotaComision" class="btn btn-sm btn-primary btnNevaCuota"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</button>
<?php endif; ?>
<?php if(count($infoProductosC)>0): ?>
<input type="hidden" class="tipoOperacion" name="tipo" value="<?php echo e($infoProductosC->TIPO); ?>">
<?php endif; ?>
</div>                  
</div>
</div>
</div>

<?php if($estAtributo[44]->VALOR=="1" &&  $operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  &&  Auth::user()->ROL =="12"  ): ?>
<div style="float: right;">  
 <button  type="button"  style="display: ;" onclick="window.location.href='<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cerrarEstacion')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>&idEstacion=6'"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Terminar Operacion</button>
</div>
<?php endif; ?>


<!-- /.Modal Agregar Cuota Desembolso -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoCuota">
  <div class="modal-dialog" role="document">
   <div class="modal-content">

     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Agregar Cuota</h4>
     </div>
     <form id="formCuotaAgregar" method="POST" class="form-horizontal form-label-left" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.cargar-cronograma')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>">
       <div class="modal-body">
        <input type="hidden" name="_token" value="" >
        <input type="hidden" name="lead" value="">
        <input type="hidden" name="tipo" id="tipoOperacionAdd" value="">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Probable:</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input class="form-control dfecha" type="text"  name="fecha" id="cboMesProbableMonto" maxlength="15">
          </div>
        </div>
        <div class="form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Monto:</label>
         <div class="col-md-9 col-sm-9 col-xs-12">
           <input id="inMonto" name="monto" class="form-control formatInputNumber" type="text" onkeypress="return valida(event)" maxlength="150">
         </div>
       </div>
       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Estado:</label>                          
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select name="estado" class="form-control" id="selEstado" style="padding-right: 0px;">
           <option value="PENDIENTE">PENDIENTE</option>
           <option value="DESEMBOLSADO" class="valorCese">DESEMBOLSADO</option>                              
         </select> 
       </div>                       
     </div>
   </div>
   <div class="modal-footer">
   </div>
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
   <button type="submit" class="btn btn-primary" id="btnGuardarCuota">Guardar</button>
 </form>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /.Modal Editar Cuota desembolso/comision -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarCuota">
 <div class="modal-dialog" role="document">

   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Editar Cuota</h4>
     </div>
     <form id="formCuotaEditar" method="POST" class="form-horizontal form-label-left" action="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.actualizar-cuota')); ?>?codOperacion=<?php echo e($operacion->COD_OPERACION); ?>">
       <div class="modal-body">
        <input type="hidden" name="_token" value="" >
        <input type="hidden" name="lead" value="">
        <input type="hidden" name="fechaRegistro" id="inFecha" value="">
        <input type="hidden" name="tipo"  id="inTipoCuota" value="">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Probable:</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input class="form-control dfecha" type="text"  name="fecha" id="cboMesProbableA" maxlength="15">
          </div>
        </div>
        <div class="form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Monto:</label>
         <div class="col-md-9 col-sm-9 col-xs-12">
           <input id="inMontoA" name="monto" class="form-control formatInputNumber" type="text" onkeypress="return valida(event)" maxlength="150">
         </div>
       </div>

       <div class="form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Estado:</label>                          
         <div class="col-md-9 col-sm-9 col-xs-12">
          <select name="estado" class="form-control" id="selEstadoA" style="padding-right: 0px;">
            <option value="PENDIENTE">PENDIENTE</option>

            <option value="DESEMBOLSADO" class="valorCese" >DESEMBOLSADO</option>  

          </select> 
        </div>                       
      </div>
    </div>
    <div class="modal-footer">
    </div>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary" id="btnGuardarActCuota">Guardar</button>
  </form>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /.Modal  Agregar Cuota Comision-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevaCuotaComision">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title">Agregar Cuota</h4>
   </div>
   <form id="" class="form-horizontal form-label-left">
    <div class="modal-body">
      <input type="hidden" name="_token" value="" >
      <input type="hidden" name="lead" value="">
      <div class="form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12">Mes:</label>
       <div class="col-md-9 col-sm-9 col-xs-12">
        <input class="form-control dfecha" type="text" value="15/10/2017" name="monto" id="cboMesProbableMonto" maxlength="15">
      </div>
    </div>
    <div >
      <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblMonto">Monto:</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
       <input id="inMonto" name="" class="form-control" type="text" onkeypress="return valida(event)" maxlength="150">
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
</div><!-- /.modal -->

</div>

<script>
 function valida(e){
  tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
     return true;
   }

    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }



  function validaLetras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
     return true;
   }

    // Patron de entrada, en este caso solo acepta numeros
    patron =/[^a-zA-Z0-9´+{}.-ñ ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }
  $(document).ready(function(){

   var flgConvenant = $( '#selectConvenant' ).val();
   var bntEditar = $('#btnAprobado').css("display");

   if(flgConvenant=='Si'){
    $('#listConvenant').css('display','');
    $('#checkConvenant').attr("disabled",false);
  }else   
  {
    $('#listConvenant').css('display','none');
    $('#checkConvenant').attr("disabled",true);
  } 


  $( '#selectConvenant' ).change(function() {
   var flgConvenant = $(this).val();
   var bntEditar = $('#btnAprobado').css("display");

   if(flgConvenant=='Si' && bntEditar=='none'){
    $('#listConvenant').css('display','');
    $('#checkConvenant').attr("disabled",false);
  }else   
  {
    $('#listConvenant').css('display','none');
    $('#checkConvenant').attr("disabled",true);
  }

});



  /**/

  var tipo = $('#tipoComision').val(); 
  if(tipo=="procentual"){
    $('#inComisionPorcentaje').attr("type","text");
    $('#inComisionValor').attr("type","hidden");

  }else{
    $('#inComisionPorcentaje').attr("type","hidden");
    $('#inComisionValor').attr("type","text");   
  }


  var tipo = $('#tipoComision').val(); 
  if(tipo=="procentual"){
   $('#inComisionPorcentaje').attr("type","text");
   $('#inComisionValor').attr("type","hidden");
 }else{
  $('#inComisionPorcentaje').attr("type","hidden");
  $('#inComisionValor').attr("type","text");   
}

/**/

$("#tipoComision").change(function () {                        
 var tipo = $('#tipoComision').val(); 
 $('#inComisionPorcentaje').val('');
 $('#inComisionValor').val(''); 
 if(tipo=="procentual"){
  $('#inComisionPorcentaje').attr("type","text");
  $('#inComisionValor').attr("type","hidden");
}else{
  $('#inComisionPorcentaje').attr("type","hidden");
  $('#inComisionValor').attr("type","text");   
}

});

$(".formatInputNumber").on({
 "focus": function (event) {
   $(event.target).select();0
 },
 "keyup": function (event) {
   $(event.target).val(function (index, value ) {
     return value.replace(/\D/g, "")
     .replace(/([0-9])([0-9]{3})$/, '$1,$2')
     .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
   });
 }
});

$(".comisionInput").keyup(function () {
  var tipo=$('#tipoComision').val();
  var valueDesembolso=0;
  var value=0;
  
  var valueDesembolso = $("#inDesembolsoClass").val();
  
  if(valueDesembolso==""){
   valueDesembolso=0;
 }

 var value = $(this).val();  



 if(tipo=="procentual"){
   var value = value.replace(/,/g, "");
   var valueDesembolso = valueDesembolso.replace(/,/g, "");

   var valorComision=(parseInt(value)*parseInt(valueDesembolso))/100;                
   /*if(isNaN(valorComision)){
     valorComision=0;
   }*/

   $("#inComisionSoles").val(valorComision);
 }else{
   var val= 
   console.log('sin comas  '+value.replace(/,/g,""));
   console.log(parseInt(value.replace(/,/g, ""))+'..'+parseInt(valueDesembolso.replace(/,/g, "")));
   if(parseInt(value.replace(/,/g, ""))-parseInt(valueDesembolso.replace(/,/g, ""))<=0){
     $("#inComisionSoles").val(value); 
   }else{
     console.log('mayor');
     $("#inComisionSoles").val(valueDesembolso); 
   }

   //$("#inComisionSoles").val(value);   

 }


});


                     //FORMVALIDATION %
                     $('#formComisionActualizar').formValidation({
                       framework: 'bootstrap',
                       icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                      },
                      fields: {
                        comisionProcentaje: {
                         validators: {
                          between: {
                           min: 0,
                           max: 100,
                           message: 'Ingrese valores entre 0 y 100'
                         }
                       }
                     },
                     comisionValor: {
                      validators: {
                       callback: {
                        message: 'Excede al desembolso',
                        callback: function (value, validator, $field) {
                                // Determine the numbers which are generated in captchaOperation
                                var valor = parseInt(value.replace(/,/g, ""));
                                console.log(valor);
                                if(valor<=<?php echo e($infoProductos->MONTO); ?>){
                                  return true;
                                }else{
                                  return false;
                                }                                
                              }
                            }
                          }
                        }
                      }
                    });

                     $('#formCuotaAgregar').formValidation({
                       framework: 'bootstrap',
                       icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                      },
                      fields: {
                        fecha: {
                         validators: {
                          notEmpty: {
                            message: 'La Fecha es requerida'
                          }
                        }
                      },
                      monto: {
                        validators: {
                         notEmpty: {
                           message: 'El Monto es requerida'
                         }
                       }
                     },
                     estado: {
                       validators: {
                        notEmpty: {
                          message: 'La Estado es requerida'
                        }
                      }
                    }

                  }
                });

                     $('#formCuotaEditar').formValidation({
                       framework: 'bootstrap',
                       icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                      },
                      fields: {
                        fecha: {
                         validators: {
                          notEmpty: {
                            message: 'La Fecha es requerida'
                          }
                        }
                      },
                      monto: {
                        validators: {
                         notEmpty: {
                           message: 'El Monto es requerida'
                         }
                       }
                     },
                     inComisionValor: {
                       validators: {
                        notEmpty: {
                          message: 'La Estado es requerida'
                        }
                      }
                    }

                  }
                });  

                   }); 
                 </script>
                 <?php $__env->stopSection(); ?>
<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>