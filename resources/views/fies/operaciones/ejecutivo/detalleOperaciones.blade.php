 @extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ URL::asset('css/custom/webfies.css') }}" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/fies/DetalleOperaciones.js') }}"></script>
@stop



@section('pageTitle', 'Detalle de Operaciones')

@section('content')
<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">
      <div class="x_title">
       <h2>General - {{ $operacion->NOMBRE_CLIENTE }}</h2>
       @if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
       <ul class="nav navbar-right panel_toolbox">
         <li>
          <a  class="close-link bntEditar" id="">
           <span class="fa fa-pencil-square-o">Editar</span>
         </a>
       </li>
     </ul>
     @endif
     <div class="clearfix"></div>
   </div>
   <div class="x_content">
     @if(count($operacion)>0)
     <form   class="form-horizontal" method="post"  action="{{ route('fies.operaciones.ejecutivo.operaciones.informacion') }}" >
       <div class="row">
        <div class="form-group col-md-4 col-xs-12">
         <label for="" class="control-label col-md-4 col-xs-3">RUC:</label>
         <div class="col-md-8 col-xs-9">
          <input class="form-control EditGeneral" disabled="true" type="text" name="ruc" value="{{ $operacion->NUM_DOC }}" name="documento" id="txtDocumento" maxlength="15" onkeypress="return valida(event)">
          <input type="hidden" name="codOperacion" value="{{ $operacion->COD_OPERACION }}" >


        </div>
      </div>


      <div class="form-group col-md-4 col-xs-12">
       <label for="" class="control-label col-md-4 col-xs-3">CU:</label>
       <div class="col-md-8 col-xs-9">
         <input class="form-control EditGeneral" disabled="true" type="text" name="cu" value="{{ $operacion->COD_UNICO }}" name="grupoEconomico" id="txtgrupoEconomico" maxlength="50" onkeypress="return valida(event)">
       </div>
     </div>


     <div class="form-group col-md-4 col-xs-12">
      <label for="" class="control-label col-md-4 col-xs-3">Grupo Económico:</label>
      <div class="col-md-8 col-xs-9">
       <input class="form-control EditGeneral" disabled="true" type="text" name="grupoEconomico"value="{{ $operacion->GRUPO_ECONOMICO }}" name="Actividad" id="txtActividad" maxlength="50">
     </div>
   </div>
 </div>
 <div class="form-group col-md-4 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Actividad:</label>
   <div class="col-md-8 col-xs-9">
    <input class="form-control EditGeneral" disabled="true" type="text" name="sector" value="{{ $operacion->SECTOR }}" name="Banca" id="txtBanca" maxlength="25">
  </div>
</div>
<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Banca:</label>
 <div class="col-md-8 col-xs-9">
  <input class="form-control EditGeneral" disabled="true" type="text" readonly="readonly" name="banca"value="{{ $operacion->BANCA }}" name="gZonal" id="txtgZonal" maxlength="25">
</div>
</div>

<div class="form-group col-md-4 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Grupo Zonal</label>
  <div class="col-md-8 col-xs-9">
   <input class="form-control EditGeneral" disabled="true" readonly="readonly" type="text" name="grupoZonal" value="{{ $operacion->GRUPO_ZONAL }}" name="eNegocio" id="txteNegocio" maxlength="30">
 </div>
</div>


<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Segmento:</label>
 <div class="col-md-8 col-xs-9">

  <select class="form-control EditGeneral" disabled="true" name="segmento"" name="estatusPipeline" id="txtSegmento" >
   <option>{{ $operacion->SEGMENTO }} </option>
   <option>Gran empresa</option>
   <option>Mediana empresa</option>
 </select>
</div>
</div>

<div class="form-group col-md-4 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">E. Negocio:</label>
 <div class="col-md-8 col-xs-9">
  <input class="form-control EditGeneral" disabled="true" type="text" name="regEjeNegocio" value="{{ $operacion->REG_EJECUTIVO_NEGOCIO }}" name="Segmento" id="txtSegmento" maxlength="15">

</div>
</div>

<div class="form-group col-md-4 col-xs-12">
 {{ $operacion->NOM_EJECUTIVO_NEGOCIO }}

</div>


<div></div>


<div class="col-md-5 col-sm-12 col-xs-12"></div>
<div class="col-md-4 col-sm-12 col-xs-12">

 @if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  )        
 <button type="button"  onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'" style="display: none;" id="CancelarGeneral" class="btn btn-sm btn-primary btnCancelar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;" id="GuardarGeneral" class="btn btn-sm btn-primary btnGuardar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Guardar</button>  
 @endif

</div>
<div> </div>


</form>
@else
<div><span>No se Encontraron resultados</span></div>
@endif
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
    <form class="form-horizontal" method="POST"  action="{{ route('fies.operaciones.ejecutivo.operaciones.producto') }}?codOperacion={{$operacion->COD_OPERACION}}" > 
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
       <span class="count_top"><i class="fa"></i>Producto:</span>
       @if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
       <button type="button" href="" class="close-link btnEdProducto" id="">
        <span class="fa fa-pencil-square-o">Editar</span>
      </button> 
      <button   type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'" class="close-link btnCaProducto" style="display:none;"">
        <span class="fa fa-close"> Cancelar</span>
      </button>
      <button  type="submit" href="" class="close-link btnOkProducto" style="display:none;"">
        <span class="fa fa-check">Ok</span>
      </button>

      @endif
      <select class="form-control" name="producto"  >
        <option>{{ $operacion->PRODUCTO }}</option>  
        <option value="Pagaré" >Pagaré</option>
        <option value="Carta Fianza" >Carta Fianza</option>
        <option value="Leasing" >Leasing</option>
      </select>  

    </div>

    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa"></i>Estación: </span> 
      <input class="form-control EditGeneral" disabled="true" type="text" name="estacion" value="{{ $operacion->ULTIMO_ESTACION }}" name="Banca" id="txtBanca" maxlength="25">      
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
     <li @if($estacion==1)) 
     class="active" 
     @endif>
     <a href="#pipeline" data-toggle="tab">Pipeline</a>
   </li>
   <li @if($estacion==2)) 
   class="active" 
   @endif><a href="#cotizacion" data-toggle="tab">Cotización</a>
 </li>
 <li @if($estacion==3)) 
 class="active" 
 @endif><a href="#fies" data-toggle="tab">FIES</a>
</li>
<li @if($estacion==4)) 
class="active" 
@endif><a href="#riesgos" data-toggle="tab">Riesgos</a>
</li>
<li @if($estacion==5)) 
class="active" 
@endif ><a href="#aprobado" data-toggle="tab"  >Aprobado</a>
</li>
</ul>
</div>

<div class="col-xs-10">
  <div class="tab-content">

    <!--pipeline-->
    <div class="tab-pane row @if($estacion==1)
    active
    @endif" id="pipeline">
    <form  method="POST"  action="{{ route('fies.operaciones.ejecutivo.operaciones.pipeline') }}?codOperacion={{$operacion->COD_OPERACION}}" >
     <div class=" col-md-6 col-xs-6">
      <div class="form-group col-md-12 col-xs-12">
       <label for="" class="control-label col-md-4 col-xs-3">Fecha de ingreso:</label>
       <div class="col-md-8 col-xs-9">
        <input class="form-control" type="text" name="fechaIngreso"  readonly="readonly" id="Text2" maxlength="15"  
        value=@if(isset($estAtributo[0]->VALOR)) 
        {{ $estAtributo[0]->VALOR }}  
        @else  
        @endif  > 

      </div>
    </div>
    <input type="hidden" name="fechaRegistroPipeline" value="{{ $estAtributo[0]->VALOR }} " />


    <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Estatus:</label>
     <div class="col-md-8 col-xs-9">
      <select class="form-control" name="estatusPipeline">
        <option>@if(isset($estAtributo[1]->VALOR)) 
         {{ $estAtributo[1]->VALOR }}  
         @else --Seleccione--
       @endif </option>
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
    <option>@if(isset($estAtributo[3]->VALOR)) 
     {{ $estAtributo[3]->VALOR }}  
     @else --Seleccione--
   @endif </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>  
</div>



</div>
<div class="divEstacion">
 @if($estAtributo[5]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ) 

 @else
 <button type="button"   style="display: none;" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'"   class="btnCancelarS btnEditarEstacion" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;"  class="btnGuardarS btnEditarEstacion"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
 <button type="button"  style="display: ;" class="bntEditarS btnEditarEstacion "  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
 @endif

</div>

</div>  

<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
   <textarea   type="text" class="form-control txtComentario" name="comentarioPipeline"  id="comentarioPipe" placeholder="Max. 150 caracteres">@if(isset($estAtributo[4]->VALOR)) {{ $estAtributo[4]->VALOR }}@endif</textarea>
 </div>



</div>            


</form>
@if($estAtributo[5]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ) 

@else    
<div style="float: right;">         

<<<<<<< HEAD

  <button   type="button" style="display: ;"  onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'1')"   class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>


=======
  <button   type="button" style="display: ;"  onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'1')"   class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>

>>>>>>> JG-0001
</div>
@endif


</div>
<!--COTIZACION-->
<div class="tab-pane row @if($estacion==2)) 
active
@endif " id="cotizacion">

<form  method="POST" action="{{ route('fies.operaciones.ejecutivo.operaciones.cotizacion') }}?codOperacion={{$operacion->COD_OPERACION}}" >

  <div class="col-md-6 col-xs-6">
    <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Fecha de envío:</label>
     <div class="col-md-8 col-xs-9">
      <input class="form-control dfecha txt" type="text" id="txtFecha" name="fechaEnvioCotizacion" onkeydown="return false" onkeypress="return validaLetras(event)" value=@if(isset($estAtributo[6]->VALOR))
      {{ $estAtributo[6]->VALOR }}   
      @endif  >

    </div>
  </div>


  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Estatus:</label>
   <div class="col-md-8 col-xs-9">
     <select class="form-control" name="estatusCotizacion">
       <option>@if(isset($estAtributo[7]->VALOR)) 
        {{ $estAtributo[7]->VALOR }}  
        @else --Seleccione--
      @endif </option>
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
     <option>@if(isset($estAtributo[8]->VALOR)) 
      {{ $estAtributo[8]->VALOR }}  
      @else --Seleccione--
    @endif </option>
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
   <option>@if(isset($estAtributo[10]->VALOR)) 
     {{ $estAtributo[10]->VALOR }}  
     @else --Seleccione--
   @endif </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>  
</div>


<div class="divEstacion">


 @if($estAtributo[12]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ) 


 @else
 @if($estAtributo[5]->VALOR=="1" )
 <button type="button" style="display: none;" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
 <button style="display: none;"  class="btnGuardarS btnEditarEstacion"   class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
 <button type="button" style="display:  ;" class="bntEditarS btnEditarEstacion "  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
 @endif
 @endif

</div>



</div>



</div>

<div class="form-group col-md-6 col-xs-6">
  <label class="control-label col-md-4 col-xs-3">Comentario:</label>
  <div class="col-md-8 col-xs-9">
    <textarea    class="form-control txtComentario
    " name="comentarioCotizacion" id="comentarioCoti" placeholder="Max. 150 caracteres">@if(isset($estAtributo[11]->VALOR)) {{ $estAtributo[11]->VALOR }}@endif</textarea>
  </div>

</div>


</form>

@if( ($estAtributo[12]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA") ||  empty($estAtributo[6]->VALOR)) 

@else
@if($estAtributo[5]->VALOR=="1" )
<div style="float: right;">  
 <button type="button" style="display:  ;"   onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'2')"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
@endif

@endif

</div>
<!-- FIES-->
<div class="tab-pane row @if($estacion==3)) 
active
@endif" id="fies">
<form  method="POST" action="{{ route('fies.operaciones.ejecutivo.operaciones.fies') }}?codOperacion={{$operacion->COD_OPERACION}}" >
 <div class="col-md-6 col-xs-6">    
  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Fecha de inicio evaluación FIES:</label>
   <div class="col-md-5 col-xs-6">
    <input class="form-control dfecha" type="text" name="fechaIngresoCotizacion" id="dFechaFiies" onkeypress="return validaLetras(event)" value=@if(isset($estAtributo[13]->VALOR))       {{ $estAtributo[13]->VALOR }}   
    @endif >
  </div>
  <label for="" class="control-label col-md-2 col-xs-2">Cliente Acepto:</label>
  <div class="col-md-1 col-xs-1">
   <input type="checkbox" name="aceptaCotizacion" class="check" aria-label="" value="sin Exito"
   <?php echo ((isset($estAtributo[23]->VALOR))? 'checked':'') ?> />
  </div>
</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-2 col-xs-3">Estatus:</label>
 <div class="col-md-5 col-xs-4">
   <select class="form-control" name="estatusFies">
     <option>@if(isset($estAtributo[14]->VALOR)) 
      {{ $estAtributo[14]->VALOR }}  
      @else --Seleccione--
    @endif </option>
    <option>Revision FIES</option>
    <option>En consulta</option>
    <option>Revisión Banca</option>
  </select> 
</div>
<label for="" class="control-label col-md-2 col-xs-2">Fecha:</label>
<div class="col-md-3 col-xs-3">
  <input class="form-control dfecha" type="text"  name="fechaEstatusFies" id="dFechaFiesGestion" onkeypress="return validaLetras(event)" maxlength="15" value=@if(isset($estAtributo[15]->VALOR)) 
  {{ $estAtributo[15]->VALOR }}   
  @endif> 
</div>

</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Comité:</label>
 <div class="col-md-8 col-xs-9">
  <select class="form-control" name="comiteFies">
    <option>@if(isset($estAtributo[16]->VALOR)) 
     {{ $estAtributo[16]->VALOR }}  
     @else --Seleccione--
   @endif </option>
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
   <option>@if(isset($estAtributo[17]->VALOR)) 
    {{ $estAtributo[17]->VALOR }}  
    @else --Seleccione--
  @endif </option>
  <option>Simple</option>
  <option>Complejo</option>
</select> 
</div>                  
</div>  

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-4 col-xs-3">Probabilidad:</label>
 <div class="col-md-8 col-xs-9">
  <select class="form-control" name="probabilidadFies" >
    <option>@if(isset($estAtributo[18]->VALOR)) 
     {{ $estAtributo[18]->VALOR }}  
     @else --Seleccione--
   @endif </option>
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
   <option>@if(isset($estAtributo[20]->VALOR)) 
    {{ $estAtributo[20]->VALOR }}  
    @else --Seleccione--
  @endif </option>
  <option>Denegada por Riegos</option>
  <option>Denegada por FIES</option>
  <option>Denegada por el cliente</option>
  <option>Falta información</option>
</select> 
</div>
@if($estAtributo[22]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA") 


@else
@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" )
<button type="button"   style="display:  ;" class="bntEditarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>

<button type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'" style="display: none;"   class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>

@endif
@endif

</div>
</div>

<div class="row top_tiles col-md-6 col-xs-6">
  <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
   <div class="tile-stats">

    <div class="icon"><i class="fa fa-suitcase"></i></div>
    <div class="count">{{ $diasOpe->TIEMPO_FIES }} </div>
    <h3>FIES</h3>
  </div>
</div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-user"></i></div>
   <div class="count">{{ $diasOpe->TIEMPO_CLIENTE}}</div>
   <h3>Clientes</h3>
 </div>
</div>
<div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-university"></i></div>
   <div class="count">{{ $diasOpe->TIEMPO_BANCA }}</div>
   <h3>Banca</h3>
 </div>
</div>
</div>

<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea  class="form-control txtComentario" name="comentarioFies"  id="comentario" placeholder="Max. 150 caracteres">@if(isset($estAtributo[21]->VALOR)) {{ $estAtributo[21]->VALOR }}@endif</textarea>

</div>




</div>
</form>   
@if($estAtributo[22]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ||  empty($estAtributo[13]->VALOR)  )

@else

@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && isset($estAtributo[14]->VALOR)) 
<div style="float: right;">  
 <button type="button" style="display: @if($estAtributo[22]->VALOR=="1" ) none @endif ;"   onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'3')"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
@endif

@endif  


</div>
<!--RIEGOS-->
<div class="tab-pane row @if($estacion==4)) 
active
@endif" id="riesgos">
<form  method="POST" action="{{ route('fies.operaciones.ejecutivo.operaciones.riesgos') }}?codOperacion={{$operacion->COD_OPERACION}}" >                
 <div class="col-md-6 col-xs-6">
   <div class="form-group col-md-12 col-xs-12">
     <label for="" class="control-label col-md-4 col-xs-3">Fecha recepción:</label>
     <div class="col-md-8 col-xs-9">
       <input class="form-control dfecha" type="text"  name="fechaRecepcionRiesgos" id="dFechaRiesgos" maxlength="15" onkeypress="return validaLetras(event)" value=@if(isset($estAtributo[24]->VALOR)) 
       {{ $estAtributo[24]->VALOR }}   
       @endif>
     </div>
   </div>

   <div class="form-group col-md-12 col-xs-12">
    <label for="" class="control-label col-md-2 col-xs-3">Estatus:</label>
    <div class="col-md-5 col-xs-4">
     <select class="form-control" name="estatusRiesgos">
       <option>@if(isset($estAtributo[25]->VALOR)) 
        {{ $estAtributo[25]->VALOR }}  
        @else --Seleccione--
      @endif </option>
      <option>Revisión Riesgos</option>
      <option>En consulta</option>
      <option>Revisión Banca</option>
      <option>Revision FIES</option>
    </select> 
  </div>
  <label for="" class="control-label col-md-2 col-xs-2">Fecha:</label>
  <div class="col-md-3 col-xs-3">
   <input class="form-control dfecha" type="text"  name="fechaEstatusRiesgos" id="dFechaRiesgosGestion" onkeypress="return validaLetras(event)" maxlength="15" value=@if(isset($estAtributo[26]->VALOR)) 
   {{ $estAtributo[26]->VALOR }}   
   @endif>
 </div>
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">WF:</label>
  <div class="col-md-8 col-xs-9">
   <input class="form-control" type="text"  name="wfRiesgos" id="Text5" maxlength="15" onkeypress="return valida(event)" value=@if(isset($estAtributo[27]->VALOR)) 
   {{ $estAtributo[27]->VALOR }}   
   @endif>
 </div>                
</div>

<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Probabilidad:</label>
  <div class="col-md-8 col-xs-9">
   <select class="form-control" name="probabilidadRiesgos">
     <option>@if(isset($estAtributo[28]->VALOR)) 
      {{ $estAtributo[28]->VALOR }}  
      @else --Seleccione--
    @endif </option>
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
   <?php echo ((isset($estAtributo[29]->VALOR))? 'checked':'') ?> />
 </div>
 <div class="col-md-7 col-xs-8">
   <select class="form-control listSinExito" name="motivoSERiesgos">
    <option>@if(isset($estAtributo[30]->VALOR)) 
     {{ $estAtributo[30]->VALOR }}  
     @else --Seleccione--
   @endif </option>
   <option>Denegada por Riegos</option>
   <option>Denegada por FIES</option>
   <option>Denegada por el cliente</option>
   <option>Falta información</option>
 </select>  
</div> 
</div>
@if($estAtributo[32]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA" ) 

@else
@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" )
<button type="button" style="display: ;" class="bntEditarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>

<button style="display: none;"   type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>

<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
@endif
@endif


</div>
<div class="row top_tiles col-md-16 col-xs-6">
 <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
   <div class="tile-stats">
    <div class="icon"><i class="fa fa-suitcase"></i></div>
    <div class="count">{{ $diasOpe->TIEMPO_FIES }}</div>
    <h3>FIES</h3>
  </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-user"></i></div>
   <div class="count">{{ $diasOpe->TIEMPO_CLIENTE}}</div>
   <h3>Clientes</h3>
 </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <div class="tile-stats">
   <div class="icon"><i class="fa fa-university"></i></div>
   <div class="count">{{ $diasOpe->TIEMPO_BANCA }}</div>
   <h3>Banca</h3>
 </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
  <div class="tile-stats">
    <div class="icon"><i class="fa fa-university"></i></div>
    <div class="count">{{ $diasOpe->TIEMPO_RIESGOS }}</div>
    <h3>Riesgos</h3>
  </div>
</div>
</div>

<div class="form-group col-md-16 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea    class="form-control txtComentario" name="comentarioRiesgos" id="comentario" placeholder="Max. 150 caracteres">@if(isset($estAtributo[31]->VALOR)) {{ $estAtributo[31]->VALOR }}  @endif</textarea>


</div>

</div>
</form>    

@if($estAtributo[32]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"   ||  empty($estAtributo[24]->VALOR) ) 

@else
@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && isset($estAtributo[24]->VALOR) && isset($estAtributo[26]->VALOR) && $estAtributo[25]->VALOR =="Revisión Riesgos")
<div style="float: right;">  
  <button  type="button"  style="display: @if($estAtributo[31]->VALOR=="1" ) none @endif ;"   onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'4')"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>
</div>
@endif
@endif         
</div>
<!--APROBADO-->
<div class="tab-pane row @if($estacion==5)
active
@endif" id="aprobado">
<form  method="POST" action="{{ route('fies.operaciones.ejecutivo.operaciones.aprobado') }}?codOperacion={{$operacion->COD_OPERACION}}" >
 <div class="col-md-6 col-xs-6">
  <div class="form-group col-md-12 col-xs-12">
   <label for="" class="control-label col-md-4 col-xs-3">Fecha de aprobación:</label>
   <div class="col-md-8 col-xs-9">
    <input class="form-control dfecha" type="text"  name="fechaAprobacion" id="Text7" maxlength="15" onkeypress="return validaLetras(event)" value=@if(isset($estAtributo[33]->VALOR)) 
    {{ $estAtributo[33]->VALOR }}   
    @endif>
  </div>
</div>


<div class="form-group col-md-12 col-xs-12">
  <label for="" class="control-label col-md-4 col-xs-3">Tipo de comisión:</label>
  <div class="col-md-8 col-xs-9">
   <select class="form-control" name="tipoComisionAprobado">
    <option>@if(isset($estAtributo[34]->VALOR)) 
      {{ $estAtributo[34]->VALOR }}  
      @else --Seleccione--
    @endif </option>
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
   <select class="form-control"  name="garantiaAprobado">
     <option>@if(isset($estAtributo[35]->VALOR)) 
          {{ $estAtributo[35]->VALOR }}  
          @else --Seleccione--
        @endif </option>
        <option>Si</option>
        <option>No</option>
    </select> 
  
 </div>   
 
 <input type="hidden" name="tipoGarantiaAprobado" value="PEN" >


</div>

<div class="form-group col-md-12 col-xs-12">
 <label for="" class="control-label col-md-3 col-xs-3">Convenant:</label>
 <div class="col-md-3 col-xs-2">
  <select class="form-control" name="flagCovenantAprobado" id="selectConvenant">

   @if(isset($estAtributo[37]->VALOR)) 
   <option>{{ $estAtributo[37]->VALOR }}  </option>
   @if($estAtributo[37]->VALOR=='Si')
   <option>No</option>
   @else
   <option>Si</option>
   @endif
   @else
   <option>No</option>
   <option>Si</option>
   @endif
 </select>  
</div> 

<div class="col-md-6 col-xs-5" name="opcionCovenant" id="listConvenant" style="display: none;">
  <div class="form-check">
   <label class="form-check-label">


    <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant1" id="1" value="1" aria-label="..." <?php echo ((isset($estAtributo[38]->VALOR))? 'checked':'') ?>>
    Cobertura servicio de deuda
  </label>
</div>
<div class="form-check">
 <label class="form-check-label">
  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant2" id="2" value="1" aria-label="..." <?php echo ((isset($estAtributo[39]->VALOR))? 'checked':'') ?>>
  Ratio de liquidez
</label>
</div> 
<div class="form-check">
 <label class="form-check-label">


  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant3" id="3" value="1" aria-label="..." <?php echo ((isset($estAtributo[40]->VALOR))? 'checked':'') ?>>
  Apalancamiento Contable
</label>
</div> 
<div class="form-check">
 <label class="form-check-label">
  <input class="form-check-input position-static checkConvenant" type="checkbox" name="covenant4" id="4" value="1" aria-label="..." <?php echo ((isset($estAtributo[41]->VALOR))? 'checked':'') ?>>
  Apalancamiento Financiero
</label>
</div>

</div> 


</div>

<div class="form-group col-md-12 col-xs-12 sinExito"> 
 <label for="" class="control-label col-md-4 col-xs-3">Sin Éxito:</label>

 <div class="col-md-1 col-xs-1">
  <input lead="#" type="checkbox" aria-label="" class="chkSinExito" name="seAprobado"

  <?php echo ((isset($estAtributo[42]->VALOR))? 'checked':'') ?> />
</div>
<div class="col-md-7 col-xs-8" id="tipoCovenant">
  <select class="form-control listSinExito" name="motivoSEAprobado">
   <option>@if(isset($estAtributo[43]->VALOR)) 
    {{ $estAtributo[43]->VALOR }}  
    @else --Seleccione--
  @endif </option>
  <option>Denegada por Riegos</option>
  <option>Denegada por FIES</option>
  <option>Denegada por el cliente</option>
  <option>Falta información</option>
</select> 
</div> 
</div>
@if($estAtributo[45]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"   ) 

@else
@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && $estAtributo[32]->VALOR=="1" )
<button type="button" style="display: ;" class="bntEditarS"  id="btnAprobado" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
<button style="display: none;" type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'"  class="btnCancelarS" id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</button>
<button style="display: none;"  class="btnGuardarS"  id="" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
@endif
@endif
</div>
<div class="form-group col-md-6 col-xs-6">
 <label class="control-label col-md-4 col-xs-3">Comentario:</label>
 <div class="col-md-8 col-xs-9">
  <textarea   class="form-control txtComentario" name="comentarioAprobado"  id="comentario" placeholder="Max. 150 caracteres">@if(isset($estAtributo[44]->VALOR))          {{ $estAtributo[44]->VALOR }}  
  @endif</textarea>                                            

</div>

</div>
</form>  

@if($estAtributo[45]->VALOR=="1" || $operacion->ULTIMO_ESTACION=="PERDIDA"  ||  empty($estAtributo[33]->VALOR)) 

@else
@if($estAtributo[5]->VALOR=="1" && $estAtributo[12]->VALOR=="1" && $estAtributo[22]->VALOR=="1" && $estAtributo[32]->VALOR=="1")
<div style="float: right;">  

 <button  type="button"  style="display: @if($estAtributo[45]->VALOR=="1" ) none @endif ;"    onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'5')"  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Cerrar Estacion</button>

</div>
@endif
@endif          
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
     @if(count($infoProductos)>0)
     <form type="GET" action="{{ route('fies.operaciones.ejecutivo.operaciones.actualizar-Operacion') }}">
      <div class="col-md-2"></div>
      <div class="col-md-4 col-sm-4 col-xs-7 tile_stats_count content">
       <input type="hidden" name="codOperacion" value="{{ $operacion->COD_OPERACION }}" >
       <input type="hidden" name="tipo" value="{{ $infoProductos->TIPO}}">
       <span class="count_top"><i class="fa"></i>Monto:</span>
       <div class="form-group col-md-12 col-xs-12" style=" padding-right: 0px;    padding-left: 0px;">
        <div class="col-md-5 col-xs-5">
         <select id="monedaDesembolso" name="moneda" class="form-control" style="padding-right: 0px;" value="{{$infoProductos->MONEDA}}">                             
          <option value="PEN">PEN</option>
          <option value="USD">USD</option>
        </select> 
      </div>    
      <div class="col-md-7 col-xs-7" style="padding-right: 0px;  padding-left: 2px;">                   

        <input class="form-control formatInputNumber" onkeypress="return valida(event)" type="text"  name="montoTotal" id="inDesembolsoClass" maxlength="15" value="{{ number_format((int)$infoProductos->MONTO,0,'.',',') }}">

        


      </div>                                                  
    </div>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
   <span class="count_top Cronograma"><i class="fa"></i>Año :</span>
   <select class="form-control" name="mesProbable" id="mesProbableDesembolso" value="{{substr($infoProductos->MES_PROBABLE,0,3)}}">

    @foreach( $meses as $mes){
    <option value="{{$mes}}">{{$mes}}</option>   
  }
  @endforeach
</select>
</div>
<div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
 <span class="count_top Cronograma"><i class="fa"></i>Mes :</span>
 <select class="form-control" name="añoProbable" id="añoProbableDesembolso" value="{{substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}">     
  <option value="{{substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}">{{substr($infoProductos->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}</option>                                        
  @foreach( $años as $año){
  <option value="{{$año}}">{{$año}}</option>   
}
@endforeach
</select>
</div>
@if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
<button  type="button"  href="#contDesembolCronograma" class="close-link btnEditarDesCom" id=""><span class="glyphicon glyphicon-edit"></span></button>

<button  type="button" type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'" href="#contDesembolCronograma" style="display: none;" class="close-link btnCancelarDesCom" id=""><span class="glyphicon glyphicon-remove"></span></a></button>
<button    type="submit" style="display: none;" class="close-link btnOkDesCom" id=""><span class="glyphicon glyphicon-ok"></span></button>
@endif
<input type="hidden" id="codOperacion" value="{{ $operacion->COD_OPERACION }}">
</form>
@else
<div ><span>No se Encontraron resultados</span></div>       
@endif

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
  @if(count($cuotaDesembolsos)>0)
  <?php  $conta=1?>
  @foreach($cuotaDesembolsos as $cuotaDesembolso)
  <tr class="tr-<?php echo $conta;?>-{{ $cuotaDesembolso->TIPO }}">
   <td class="mesProb" style="vertical-align: middle; text-align: center;">{{$cuotaDesembolso->MES}}</td>
   <td class="montoD numberMiles" style="vertical-align: middle; text-align: center;">{{ number_format((int)$cuotaDesembolso->MONTO,0,'.',',') }}</td>
   <td class="estadoD" style="vertical-align: middle; text-align: center;">{{$cuotaDesembolso->ESTATUS}}</td>
   <td class="fechaD" style="vertical-align: middle; text-align: center;">{{$cuotaDesembolso->FECHA}}</td>
   <td style="vertical-align: middle; text-align: center;">
     @if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
     <button class="btn btn-sm btn-danger btnEditarCuota">Editar</button>
     <button type="button"  class="btn btn-sm btn-danger btnQuitarCuota ">Quitar</button>
     <input type="hidden" class="tipo" name="tipo" value="{{ $cuotaDesembolso->TIPO }}">
     @endif
   </td>
 </tr>
 <?php  $conta=$conta+1?>
 @endforeach 
 @else
 <tr>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
 </tr> 
 @endif                        
</tbody>
</table>
@if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
<button id="btnNevaCuotaDesembolso" class="btn btn-sm btn-primary btnNevaCuota"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</button>
@endif
@if(count($infoProductosC)>0)
<input type="hidden" class="tipoOperacion" name="tipo" value="{{ $infoProductos->TIPO }}">
@endif
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
     @if(count($infoProductosC)>0)
     <form id="formComisionActualizar" type="GET" action="{{ route('fies.operaciones.ejecutivo.operaciones.actualizar-Operacion') }}">
       <div class="col-md-2"></div>
       <div class="col-md-4 col-sm-4 col-xs-7 tile_stats_count content">
        <input type="hidden" name="codOperacion" value="{{ $operacion->COD_OPERACION }}" >
        <input type="hidden" name="tipo" value="{{ $infoProductosC->TIPO }}">
        <input type="hidden" name="moneda" value="{{ $infoProductosC->MONEDA }}">
        <span class="count_top"><i class="fa"></i>Monto:</span>
        <div class="form-group col-md-12 col-xs-12" style=" padding-right: 0px;    padding-left: 0px;">
          <div class="col-md-5 col-xs-5">
            <select id="tipoComision"  class="form-control" style="padding-right: 0px;" value="{{$infoProductosC->MONEDA}}">        
             <option value="procentual">%</option>                      
             <option value="Importe">Importe</option>

           </select> 
         </div>   
         <div class="col-md-7 col-xs-7" style="padding-right: 0px;  padding-left: 2px;">                   

           <input  class="form-control formatInputNumber comisionInput "  id="inComisionValor"  type="text"  name="comisionValor" id="Text8"  maxlength="15" value="{{ number_format((int)$infoProductosC->MONTO,0,'.',',') }}">

           <input  class="form-control InputsNumber comisionInput"  id="inComisionPorcentaje" type="hidden"  name="comisionProcentaje" id="Text8"  maxlength="15" value="{{(( (float) $infoProductosC->MONTO/ (float) $infoProductos->MONTO)*100)}}%">
           <input  class="form-control" type="hidden"  name="valorDesembolso" id="valorDesembolso"  maxlength="15" value="{{ $infoProductos->MONTO }}">
           <input id="inComisionSoles"  placeholder="Disabled input"  class="form-control " type="text"  readonly="readonly" name="montoTotal" id="Text8" maxlength="15" value="{{ number_format((int)$infoProductosC->MONTO,0,'.',',') }}">

         </div>                                                  
       </div>

     </div>
     <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
       <span class="count_top Cronograma"><i class="fa"></i>Mes. :</span>                                  
       <select class="form-control" name="mesProbable" id="mesProbableCuota" value="{{substr($infoProductosC->MES_PROBABLE,0,3)}}">

        @foreach( $meses as $mes){
        <option value="{{$mes}}">{{$mes}}</option>   
      }
      @endforeach
    </select>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
    <span class="count_top Cronograma"><i class="fa"></i>Año. :</span>
    <select class="form-control" name="añoProbable" id="añoProbableCuota" value="{{substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}">                                        
     <option value="{{substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}">{{substr($infoProductosC->MES_PROBABLE,4,strlen($infoProductos->MES_PROBABLE))}}</option>
     @foreach( $años as $año){
     <option value="{{$año}}">{{$año}}</option>   
   }
   @endforeach
 </select>
</div>
@if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
<button  type="button"  href="#contDesembolCronograma" class="close-link btnEditarDesCom" id=""><span class="glyphicon glyphicon-edit"></span></button>
<button  type="button" type="button" onclick="window.location.href='{{ route('fies.operaciones.ejecutivo.operaciones.detalle') }}?codOperacion={{$operacion->COD_OPERACION}}'" href="#contDesembolCronograma" style="display: none;" class="close-link btnCancelarDesCom" id=""><span class="glyphicon glyphicon-remove"></span></a></button>

<button    type="submit" style="display: none;" class="close-link btnOkDesCom" id=""><span class="glyphicon glyphicon-ok"></span></button>
@endif
<input type="hidden" id="codOperacionDes" value="{{ $operacion->COD_OPERACION }}">
</form>
@else
<div ><span>No se Encontraron resultados</span></div>       
@endif
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
   @if(count($cuotasComisiones)>0)
   <?php  $conta=1?>
   @foreach($cuotasComisiones as $cuotasComision)
   <tr class="tr-<?php echo $conta;?>-{{ $infoProductosC->TIPO }}">

    <td class="mesProb" style="vertical-align: middle; text-align: center;">{{$cuotasComision->MES}}</td>
    <td class="montoD" style="vertical-align: middle; text-align: center;">{{ number_format((int)$cuotasComision->MONTO,0,'.',',') }}</td>
    <td class="estadoD" style="vertical-align: middle; text-align: center;">{{$cuotasComision->ESTATUS}}</td>
    <td class="fechaD" style="vertical-align: middle; text-align: center;">{{$cuotasComision->FECHA}}</td>
    <td style="vertical-align: middle; text-align: center;">
      @if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
      <button class="btn btn-sm btn-danger btnEditarCuota">Editar</button>
      <button type="button"  class="btn btn-sm btn-danger btnQuitarCuota ">Quitar</button>     
      @endif                                 
    </td>
    <input type="hidden" class="tipo" name="tipo" value="{{ $cuotasComision->TIPO }}">
  </tr>
  <?php  $conta=$conta+1?>
  @endforeach                         
  @else
  <tr>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
   <td>-</td>
 </tr>  
 @endif  
</tbody>
</table>
@if($operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  ) 
<button id="btnNevaCuotaComision" class="btn btn-sm btn-primary btnNevaCuota"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</button>
@endif
@if(count($infoProductosC)>0)
<input type="hidden" class="tipoOperacion" name="tipo" value="{{ $infoProductosC->TIPO }}">
@endif
</div>                  
</div>
</div>
</div>

@if($estAtributo[44]->VALOR=="1" &&  $operacion->ULTIMO_ESTACION<>"TERMINADO" && $operacion->ULTIMO_ESTACION<>"PERDIDA"  &&  Auth::user()->ROL =="12"  )
<div style="float: right;">  
 <button  type="button"  style="display: ;" onclick="cboTerminarOperacion({{$operacion->COD_OPERACION}},'6')" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Terminar Operacion</button>
</div>
@endif


<!-- /.Modal Agregar Cuota Desembolso -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoCuota">
  <div class="modal-dialog" role="document">
   <div class="modal-content">

     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title">Agregar Cuota</h4>
     </div>
     <form id="formCuotaAgregar" method="POST" class="form-horizontal form-label-left" action="{{ route('fies.operaciones.ejecutivo.operaciones.cargar-cronograma') }}?codOperacion={{$operacion->COD_OPERACION}}">
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
     <form id="formCuotaEditar" method="POST" class="form-horizontal form-label-left" action="{{ route('fies.operaciones.ejecutivo.operaciones.actualizar-cuota') }}?codOperacion={{$operacion->COD_OPERACION}}">
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
function cboTerminarOperacion(codOpe,estacion) { 
    if(codOpe==7){

             if(confirm('¿Estas seguro de Cerrar la Operacion?'))
             {
                window.location.href= APP_URL + '/fies/ejecutivo/cerrarEstacion?idEstacion='+estacion+'&codOperacion='+codOpe;
               /*$.ajax({
                 type: "GET", 
                 url: APP_URL + '/fies/ejecutivo/terminarOperacion',
                 dataType: 'json',
                 data: {idEstacion: estacion, codOperacion: codOpe},
                 success: function (response) { 
                    if(response){ 
                     window.location.href= APP_URL + '/be/micontacto?documento='+numDocumento;
                   }


                 }, 
               });*/
             } 
        }else {
             if(confirm('¿Estas seguro de Terminar la Estacion?'))
             {
                window.location.href= APP_URL + '/fies/ejecutivo/cerrarEstacion?idEstacion='+estacion+'&codOperacion='+codOpe;
               /*$.ajax({
                 type: "GET", 
                 url: APP_URL + '/fies/ejecutivo/terminarOperacion',
                 dataType: 'json',
                 data: {idEstacion: estacion, codOperacion: codOpe},
                 success: function (response) { 
                    if(response){ 
                     window.location.href= APP_URL + '/be/micontacto?documento='+numDocumento;
                   }


                 }, 
               });*/
             } 

        }

   }



 function valida(e){
  tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
     return true;
   }

    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9.]/;
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

   var valorComision=(parseFloat(value)*parseFloat(valueDesembolso))/100;                
   /*if(isNaN(valorComision)){
     valorComision=0;
   }*/

   $("#inComisionSoles").val(valorComision);
 }else{
   var val= 
   console.log('sin comas  '+value.replace(/,/g,""));
   console.log(parseFloat(value.replace(/,/g, ""))+'..'+parseFloat(valueDesembolso.replace(/,/g, "")));
   if(parseFloat(value.replace(/,/g, ""))-parseFloat(valueDesembolso.replace(/,/g, ""))<=0){
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
                                var valor = parseFloat(value.replace(/,/g, ""));
                                console.log(valor);
                                if(valor<={{ $infoProductos->MONTO }}){
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
                 @stop