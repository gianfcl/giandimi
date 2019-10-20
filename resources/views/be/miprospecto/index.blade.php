@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 


<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

@stop
<?php
    $modoLinkedin=in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosLinkedin()); 
    $modoComunicacion=in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosComunicacion());  
?>
@section('content')

<style type="text/css">
	.item-nota p{
		margin: 5px 0px;
	}

</style>

@if (!in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosBE(),\App\Entity\Usuario::getAnalistasInternosBE(),[\App\Entity\Usuario::ROL_JEFATURA_BE])))
<style type="text/css">
	#modalNotas .fa-trash {
		display: none;
	}
</style>
@endif

@section('pageTitle', 'Leads')

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
		        <form action="{{ route('be.miprospecto.lista.index') }}" class="form-horizontal">
		            <div class="row clearfix">
		                <div class="form-group col-md-5">
		                    <label for="" class="control-label col-md-3">DNI/RUC:</label>
		                    <div class="col-md-9">
		                        <input class="form-control formatInputNumber" type="text" value="{{ $busqueda['documento'] }}" name="documento">
		                    </div>
		                </div>

		                <div class="form-group col-md-5">
		                    <label for="" class="control-label col-md-3">R.Social:</label>
		                    <div class="col-md-9">
		                        <input class="form-control" type="text" value="{{ $busqueda['razonSocial'] }}" name="razonSocial">
		                    </div>
		                </div>

		                <div class="pull-right">
		                	<span class="glyphicon glyphicon-chevron-down" id="i-filtros-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
		                </div>

						@if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE())))
		                <div class="form-group col-md-3">
		                    <label for="" class="control-label col-md-3">Banca:</label>
		                    <div class="col-md-9">
		                        <select id="cboBanca" class="form-control" name="banca">
		                    		<option value="">Todos</option>
				                    	@foreach ($bancas as  $banca)
	                            			<option value="{{$banca->BANCA}}" {{($banca->BANCA == $busqueda['banca'])? 'selected="selected"':''}}
	                            			>{{$banca->BANCA}}</option>
                        				@endforeach
	                        	</select>
		                    </div>
		                </div>
		                @endif

						@if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca())))
		                <div class="form-group col-md-3">
		                    <label for="" class="control-label col-md-3">Zonal:</label>
		                    <div class="col-md-9">
		                        <select id="cboZonal" class="form-control" name="zonal">
		                    		<option value="">Todos</option>
									@foreach ($zonales as  $zonal)
                            			<option value="{{$zonal->ID_ZONAL}}" {{($zonal->ID_ZONAL == $busqueda['zonal'])? 'selected="selected"':''}}
                            			>{{$zonal->ZONAL}}</option>
                        			@endforeach
	                        	</select>
		                    </div>
		                </div>
		                @endif
						
						@if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE())))
		                <div class="form-group col-md-3">
		                    <label for="" class="control-label col-md-3">Jefatura:</label>
		                    <div class="col-md-9">
		                        <select id="cboJefatura" class="form-control" name="jefatura">
		                    		<option value="">Todos</option>
									@foreach ($jefaturas as  $jefatura)
                            			<option value="{{$jefatura->ID_JEFATURA}}" {{($jefatura->ID_JEFATURA == $busqueda['jefatura'])? 'selected="selected"':''}}
                            			>{{$jefatura->JEFATURA}}</option>
                        			@endforeach
	                        	</select>
		                    </div>
		                </div>
		                @endif
						
						@if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getBanca(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE())))
		                <div class="form-group col-md-3">
		                    <label for="" class="control-label col-md-3">Ejecutivo:</label>
		                    <div class="col-md-9">
		                        <select id="cboEjecutivo" class="form-control" name="ejecutivo">
		                    		<option value="">Todos</option>
									@foreach ($ejecutivos as  $ejecutivo)
                            			<option value="{{$ejecutivo->REGISTRO}}" {{($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''}}
                            			>{{$ejecutivo->NOMBRE}}</option>
                        			@endforeach
	                        	</select>
		                    </div>
		                </div>
		                @endif

			            <div class="row" id="filtros-avanzados" style="display: none;">
							<div class="form-group col-md-3">
			                    <label for="" class="control-label col-md-5">Semáforo:</label>
			                    <div class="col-md-7">
				                    <select class="form-control" name="semaforo">
				                    	<option value="">Todos</option>
										@foreach (\App\Entity\BE\Etapa::getSemaforos() as $key => $value)
	                            			<option value="{{$key}}" {{($key == $busqueda['semaforo'])? 'selected="selected"':''}}
	                            			>{{$value}}</option>
	                        			@endforeach
									</select>
			                    </div>
			                </div>
			                <div class="form-group col-md-5">
			                    <label for="" class="control-label col-md-3 ">Estrategia:</label>
			                    <div class="col-md-9">
			                    	<select class="form-control" name="estrategia">
			                    		<option value="">Todos</option>
										@foreach ($estrategias as  $estrategia)
	                            			<option value="{{$estrategia->ID_CAMP_EST}}" {{($estrategia->ID_CAMP_EST == $busqueda['estrategia'])? 'selected="selected"':''}}
	                            			>{{$estrategia->NOMBRE}}</option>
	                        			@endforeach
	                        		</select>
			                    </div>
			                </div>
			                <div class="form-group col-md-4">
			                    <label for="" class="control-label col-md-3">Etapa:</label>
			                    <div class="col-md-9">
			                        <select class="form-control" name="etapa">
			                        	<option>Todos</option>
			                        	@foreach ($etapas as $etapa)
	                            			<option value="{{$etapa->ID_ETAPA}}" {{($etapa->ID_ETAPA == $busqueda['etapa'])? 'selected="selected"':''}}
	                            			>{{$etapa->NOMBRE}}</option>
	                        			@endforeach
									</select>
			                    </div>
			                </div>
			                <div class="form-group col-md-3">
			                    <label for="" class="control-label col-md-5">Verificado:</label>
			                    <div class="col-md-7">
			                        <select class="form-control" name="verificado">
			                        	<option value="">Todos</option>
				                    	<option value="1" {{(1 == $busqueda['verificado'])? 'selected="selected"':''}}>Sí</option>
										<option value="0" {{('0' === $busqueda['verificado'])? 'selected="selected"':''}}>No</option>
									</select>
			                    </div>
			                </div>
			                <div class="form-group col-md-7 col-lg-5">
			                    <label for="" class="control-label col-md-3 col-lg-4">Bco. Princ:</label>
			                    <div class="col-md-7 col-lg-8">
			                        <select class="form-control" type="text" name="bcoPrincipal">
			                        	<option value="">Todos</option>
										@foreach ($bancos as $banco)
	                            			<option value="{{$banco->CODIGO}}" {{($banco->CODIGO == $busqueda['bcoPrincipal'])? 'selected="selected"':''}}>
	                            			{{$banco->NOMBRE}}</option>
	                        			@endforeach
									
			                        </select>
			                    </div>
			                </div>
			                <div class="form-group col-md-6 col-lg-4">
			                    <label for="" class="control-label col-md-4 col-lg-3">Deuda Dir.:</label>
			                    <div class="col-md-8 col-lg-9">
			                        <div class="input-group">
	  									<input type="text" class="form-control formatInputNumber" value="{{ $busqueda['minDeudaDirecta'] }}" name="minDeudaDirecta">
	  									<span class="input-group-addon" >a</span>
	  									<input type="text" class="form-control formatInputNumber" value="{{ $busqueda['maxDeudaDirecta'] }}" name="maxDeudaDirecta">
									</div>
			                    </div>
			                </div>
			                <div class="form-group col-md-6 col-lg-4">
			                    <label for="" class="control-label col-md-3 col-lg-3">Deuda Ind.:</label>
			                    <div class="col-md-9 col-lg-9">
			                    	<div class="input-group">
				                        <input type="text" class="form-control formatInputNumber" value="{{ $busqueda['minDeudaIndirecta'] }}" name="minDeudaIndirecta">
		  								<span class="input-group-addon" >a</span>
		  								<input type="text" class="form-control formatInputNumber" value="{{ $busqueda['maxDeudaIndirecta'] }}" name="maxDeudaIndirecta">
	  								</div>
			                    </div>
			                </div>
			                <div class="form-group col-md-6 col-lg-4">
			                    <label for="" class="control-label col-md-4 col-lg-3">Bco. Princ Gar.:</label>
			                    <div class="col-md-8 col-lg-9">
			                        <select class="form-control" type="text" name="bcoPrincipalGarantia">
			                        	<option>Todos</option>
			                        	@foreach ($bancosGarantias as $banco)
	                            			<option value="{{$banco->CODIGO}}" {{($banco->CODIGO == $busqueda['bcoPrincipalGarantia'])? 'selected="selected"':''}}>
	                            			{{$banco->NOMBRE}}</option>
	                        			@endforeach
									</select>
			                    </div>
			                </div>
			                <div class="form-group col-md-6 col-lg-4">
			                    <label for="" class="control-label col-md-3">Garantía.:</label>
			                    <div class="col-md-9">
			                        <div class="input-group">
	  									<input type="text" class="form-control formatInputNumber" value="{{ $busqueda['minGarantia'] }}" name="minGarantia">
	  									<span class="input-group-addon" >a</span>
	  									<input type="text" class="form-control formatInputNumber" value="{{ $busqueda['maxGarantia'] }}" name="maxGarantia">
									</div>
			                    </div>
			                </div>
			            </div>
		                <div class="col-md-1">
		                	<button class="btn btn-primary" type="submit" >Buscar</button>
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
	      		<h2>Lista</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<div class="x_content">

				@if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE()))
    			<button id="btnAgregarReferido" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Referido</button>
    			@endif

		        <table class="table table-striped jambo_table">
		            <thead>
		                <tr class="headings">
		                	@if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getJefesGerentesBE()))
		                	<th></th>
		                	@endif
		                    <th></th>
		                    <th style="width: 10%">Estrategia</th>
		                    @if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE())))
		                    	<th style="width: 10%">Ejecutivo</th>
		                    @endif
		                    <th>Empresa</th>

		                    <th style="">
	                        @if(isset($orden) && $orden['sort'] == 'deudaD')
	                            @if(isset($orden) && $orden['order'] == 'asc')
	                                <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'deudaD','order' =>'desc'])) }}">
	                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
	                            @else
	                                <a href="{{ route('be.miprospecto.lista.index', $busqueda) }}">
	                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
	                            @endif
	                        @else
	                            <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'deudaD','order' =>'asc'])) }}">
	                            <i class="fa fa-sort fa-lg order-icon"></i>
	                        @endif
                        </a> 		                    		
		                    Deuda Directa</th>

		                    <th style="">Banco Principal</th>

		                    <th style="">
	                        @if(isset($orden) && $orden['sort'] == 'deudaI')
	                            @if(isset($orden) && $orden['order'] == 'asc')
	                                <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'deudaI','order' =>'desc'])) }}">
	                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
	                            @else
	                                <a href="{{ route('be.miprospecto.lista.index', $busqueda) }}">
	                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
	                            @endif
			                @else
			                    <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'deudaI','order' =>'asc'])) }}">
			                    <i class="fa fa-sort fa-lg order-icon"></i>
			                @endif
                        </a> 
		                    Deuda Indirecta</th>

		                    <th style="">
	                        @if(isset($orden) && $orden['sort'] == 'garantia')
	                            @if(isset($orden) && $orden['order'] == 'asc')
	                                <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'garantia','order' =>'desc'])) }}">
	                                <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
	                            @else
	                                <a href="{{ route('be.miprospecto.lista.index', $busqueda) }}">
	                                <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
	                            @endif
	                        @else
	                            <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'garantia','order' =>'asc'])) }}">
	                            <i class="fa fa-sort fa-lg order-icon"></i>
	                        @endif
                        </a> 
		                    Garantía</th>

		                    <th style="">Deuda Total</th>
		                    <th style="">Etapa</th>

		                    <th style="">
	                        @if(isset($orden) && $orden['sort'] == 'dias')
		                        @if(isset($orden) && $orden['order'] == 'asc')
		                            <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'dias','order' =>'desc'])) }}">
		                            <i class="fa fa-sort-asc fa-lg order-icon-active"></i>
		                        @else
		                            <a href="{{ route('be.miprospecto.lista.index', $busqueda) }}">
		                            <i class="fa fa-sort-desc fa-lg order-icon-active"></i>
		                        @endif
		                    @else
		                        <a href="{{ route('be.miprospecto.lista.index', array_merge($busqueda,['sort' => 'dias','order' =>'asc'])) }}">
		                        <i class="fa fa-sort fa-lg order-icon"></i>
		                    @endif
                        </a> 
		                    Días</th>
							

							<th style=""></th>
		                    <th style="">Acciones</th>
		                </tr>
		            </thead>
		            <tbody>
		            @if(count($leads)>0)
		            	@foreach ($leads as $lead)
		                <tr>
		                	<?php 
		                		$color = \App\Entity\BE\Etapa::getColorSemaforo($lead->ETAPA_ID,$lead->DIAS_PENDIENTE) 
		                	?>
                			@if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getJefesGerentesBE()))
		                	<td style="vertical-align: middle; text-align: center;">
			                	<i class="fa fa-spinner fa-spin fa-fw hidden"></i>
	                            <input lead="{{ $lead->NUM_DOC }}" type="checkbox" class='chkMantener' aria-label=""
	                            <?php echo (($lead->FLAG_MANTENER_LEAD == 1)? 'checked':'') ?> />
                    		</td>
		                	@endif
		                	<td style="vertical-align: middle; text-align: center;">
		                		
		                		@if ($color)
		                			<i class="fa fa-circle fa-2x" aria-hidden="true" style="color: {{$color}};"></i>
		                		@endif
		                	</td>
		                	<td style="vertical-align: middle;">
		                		{{$lead->ESTRATEGIA_NOMBRE}}
		                	</td>
		                	@if (in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getDivisionBE(),\App\Entity\Usuario::getZonalesBE(),\App\Entity\Usuario::getJefaturasBE())))
		                    	<td style="vertical-align: middle; width: 10%;">
		                    		{{$lead->EJECUTIVO_NOMBRE}}
		                    	</td>
		                    @endif
		                	<td style="vertical-align: middle;">
			                		{{$lead->NOMBRE}}<br/>
			                		RUC: {{$lead->NUM_DOC}}<br/>
			                		CU: {{$lead->COD_UNICO}}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		S/. {{number_format($lead->DEUDA_DIRECTA,0,'.',',') }}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		{{$lead->BANCO_PRINCIPAL}}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		S/. {{number_format($lead->DEUDA_INDIRECTA,0,'.',',')}}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		S/. {{number_format($lead->GARANTIA,0,'.',',')}}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		<!--{{$lead->BANCO_GARANTIA}}-->
		                		S/. {{number_format($lead->DEUDA_TOTAL,0,'.',',') }}
		                	</td>
		                	<td style="vertical-align: middle;">
		                		@if ($lead->ETAPA_EDITABLE == '1' && in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE()))
		                			<a class="lnkEditEtapa" href="" etapa="{{$lead->ETAPA_ID}}" lead="{{$lead->NUM_DOC}}" style="text-decoration: underline;">
		                				{{$lead->ETAPA_NOMBRE}}
		                			</a>
		                		@else
		                			{{$lead->ETAPA_NOMBRE}}
		                		@endif

		                		@if ($lead->VERIFICADO == 1)
		                			<i class="fa fa-check-circle" aria-hidden="true"></i>
		                		@endif

		                	</td>
		                	<td style="vertical-align: middle;" class="diasPendiente">
		                		@if ($color)
		                			{{$lead->DIAS_PENDIENTE}}d
		                		@endif
		                	</td>
		                	<td style="vertical-align: middle;">
		                		<a href="#" class="lnkNotas" lead="{{$lead->NUM_DOC}}" ejecutivo="{{$usuario->getValue('_registro')}}" style="text-decoration: underline;">Notas</a>
		                	</td>
		                	<td style="vertical-align: middle;">
		                		<a href="{{ route('be.actividades.index') }}?documento={{$lead->NUM_DOC}}" style ="padding:8px;"> <i class="fa fa-bars fa-2x" data-toggle="tooltip" title="" data-placement="bottom"  aria-hidden="true"  data-original-title="Actividades" ></i></a>

		                		<a href="{{ route('be.micontacto.index') }}?documento={{$lead->NUM_DOC}}" style ="padding:8px;"> 
		                			@if($lead->PRIORIDAD==1)
		                				<img src = "{{ URL::asset('img/telefonoNuevo.png') }}" style="width: 40px;height: 40px">
		                			@else
		                			<i class="fa fa-phone fa-2x" data-toggle="tooltip" title="" data-placement="bottom"  aria-hidden="true"  data-original-title="Contacto" style="
									    margin-left: 10px; margin-right: 10px;"></i>
		                			@endif
		                		</a>
		      
		      					@if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE()))
		                		<a href="#" style ="padding:8px;" id ="btnEliminarLead"  documentoE="{{$lead->NUM_DOC}}"> <i class="fa fa-trash fa-2x btnEliminarLead" data-toggle="tooltip" title="" documentoE="{{$lead->NUM_DOC}}" data-placement="bottom"  aria-hidden="true"  data-original-title="Eliminar"></i></a>
		                		@endif


		                	</td>
		                </tr>
		                @endforeach
		            @else
		            <tr>
		                <td colspan="10">No se encontraron resultados</td>
		            </tr>
		            @endif
		        </tbody>
		    </table>
    	 {{ $leads->appends(array_merge($busqueda,$orden))->links() }}
			</div>
		</div>
	</div>
</div>


<!-- /.Modal Editar Etapa -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditarEtapa">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cambiar Etapa</h4>
            </div>
            <form id="frmEditarEtapa" class="form-horizontal form-label-left" action="{{ route('be.miprospecto.update-etapa') }}">
                <div class="modal-body">
                    <input type="hidden" name="lead">
                    <input type="hidden" name="etapaActual">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Etapa:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="etapa">
                                <option value="">Elige la nueva etapa</option>
                                @foreach ($etapasHabilitadas as $etapa)
                                <option value="{{$etapa->ID_ETAPA}}" {{($etapa->ID_ETAPA == $busqueda['etapa'])? 'selected="selected"':''}}>
                                    {{$etapa->NOMBRE}}</option>
                                @endforeach
                            </select>
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


<!-- /.Modal Agregar Referido -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarReferido">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Referido</h4>
            </div>
            <div class="modal-body">


                <form id="frmNuevoReferido" class="form-horizontal form-label-left" action="{{ route('be.miprospecto.registro-referido') }}" method="POST">					
                    <div class="col-lg-3">
                        <label class="control-label">Documento:</label>
                    </div>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input type="text" class="form-control formatInputNumber" placeholder="Ejm: 2015648468746" maxlength="11" id="txtDocumentoReferido" name="documento">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnBuscarReferido">
                                	<i class="fa fa-spinner fa-spin fa-fw fa-1x margin-bottom hidden"></i>
                                	<i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->


                    <input type="hidden" name="segmento" value="ME">

                    <div id="divReferidoExistente" class="hidden">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input class="form-control" readonly="readonly" name="nombre">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Calificacion SBS</label>
                            <input class="form-control" readonly="readonly" name="calificacion">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">FEVE</label>
                            <input class="form-control" readonly="readonly" name="feve">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Deuda Directa</label>
                            <input class="form-control" readonly="readonly" name="deuda">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Última Etapa</label>
                            <input class="form-control" readonly="readonly" name="etapa">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Motivo de Eliminación</label>
                            <input class="form-control" readonly="readonly" name="motivoDetalle">
                        </div>
                        <div class="form-group col-md-6">
                        	<label for="exampleInputEmail1">Fecha de Última Etapa</label>											
		                    <div class="input-group">	        	                     
			                    <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
			                    <input class="form-control"  readonly="readonly" name="fechaUltimaE">
				            </div>
						</div>
						<div class="form-group col-md-6">
                        	<label for="exampleInputEmail1">Fecha de Última Visita</label>											
		                    <div class="input-group">	        	                     
			                    <div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
			                    <input class="form-control"  readonly="readonly" name="fechaUltimaV">
				            </div>
						</div>
                        
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ejecutivo</label>
                            <input class="form-control" readonly="readonly" name="ejecutivo">
                        </div>
                        <div class="form-group col-md-12" hidden>
                            <label for="exampleInputEmail1">Sectorista</label>
                            <input class="form-control" readonly="readonly" name="sectorista">
                        </div>	                       		 
                    </div>
					
                    <div id="divReferidoNuevo" class="hidden">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input class="form-control" name="nombreNuevo">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Facturación</label>
                            <input class="form-control" name="facturacionNuevo">
                        </div>                        
                    </div>
                    <div id="divLinkedin" class="hidden">
                        <div class="form-group col-md-12">
                      	@if($modoLinkedin)
                        <img src = "{{ URL::asset('img/linkedin.png') }}" style="width: 3%; "/> <label for="exampleInputEmail1">¿Se empleó LinkedIn Sales Navigator para identificar al referido?</label>
	                        <div class="btn-group flgsLinkedin" data-toggle="buttons">
		                        <label name="botonesLinkedin" class="btn btn-default">
		                          <input type="radio" name="flgLinkedin" id="opcionSi" value="1">Sí</label>
		                        <label name="botonesLinkedin" class="btn btn-default">
		                          <input type="radio" name="flgLinkedin" id="opcionNo" value="0">No</label>	                      
							</div>
                      	
                      	@else                      	
							<input id="helpNoLinkedin" type="radio" name="flgLinkedin" value="-1" hidden checked>	
                      	@endif					
						</div>
					</div>


                    <div class="clearfix"></div>
                    <div class="modal-footer hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        @if($modoLinkedin)
                        <button type="submit" class="btn btn-success" id="botonGuardarReferido">Guardar</button>
                        @else
                        <button type="submit" class="btn btn-success" id="botonGuardarReferido2">Guardar</button>
                        @endif
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /.Modal Eliminar Lead -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarLead">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Lead</h4>
            </div>
            <form method="POST" id="frmEliminarLead" class="form-horizontal form-label-left" action="{{ route('be.miprospecto.eliminar') }}">
                <input type="hidden" name="documentoE"  id="documentoE" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Por que eliminas la Gestion:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="eliminar" id="eliminar" onchange="listaEliminar(this.value)" >
                                <option value="1">No se pudo contactar</option>
                                <option value="2">No perfil</option>
                                <option value="3">No interesado</option>
                                <option value="4">No califica</option>
                                <option value="5">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12"></div>
                        <div class="col-md-3 col-sm-3 "></div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="xmotivo" id="motivo">
                                <option value="1" >Datos de contacto errado</option>
                                <option value="2" >Cliente no responde</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12"><br></div>
                        <div class="col-md-3 col-sm-3 "></div>

                        <div class="col-md-9 col-sm-9 col-xs-12">	
							<textarea  style="" class="form-control comentarioEliminar" rows="3" placeholder="Escribe aqui..." name="eliminarComentario"></textarea>	
                        </div>
						@if($modoLinkedin)
						<div class="col-md-12"><br>
                        	<img src = "{{ URL::asset('img/linkedin.png') }}" style="width: 3%; " /> <label for="exampleInputEmail1">¿Se encontró algún decisor en Linked In Sales Navigator?</label>
	                        <div class="btn-group flgsLinkedinElim" data-toggle="buttons">
		                        <label class="btn btn-default">
		                          <input type="radio" name="flgLinkedin" id="opcionSi" value="1">Sí</label>
		                        <label class="btn btn-default">
		                          <input type="radio" name="flgLinkedin" id="opcionNo" value="0">No</label>	                      
							</div>
                      	</div>
                        @else
                        <div class="btn-group">
							<input type="radio" name="flgLinkedin" value="-1" hidden checked>	
						</div>
                      	@endif
                            

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    @if($modoLinkedin)
                        <button type="submit" class="btn btn-success" id="botonGuardarEliminar">Guardar</button>
                    @else
                        <button type="submit" class="btn btn-success" id="botonGuardarEliminar2">Guardar</button>
                    @endif
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
                <h4 class="modal-title">Agregar Nota</h4>
            </div>
                <div class="modal-body">
					<?php $classForm = ''; 
						if (!in_array($usuario->getValue('_rol'),array_merge(\App\Entity\Usuario::getEjecutivosBE(),\App\Entity\Usuario::getAnalistasInternosBE(),[\App\Entity\Usuario::ROL_JEFATURA_BE])))
							$classForm = 'hidden'
					?>
                	<form method="POST" id="frmAgregarNota" class="form-horizontal form-label-left {{$classForm}}" action="{{ route('be.miprospecto.nota.agregar') }}">
                		<input type="hidden" name="lead" >
                		<input type="hidden" name="ejecutivo" value="{{$usuario->getValue('_registro')}}">
	                    <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nota:</label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <textarea class="form-control" rows="3" placeholder="Escribe aqui..." name="nota"></textarea>
	                        </div>
	                    </div>
	                    <div class="form-group">
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

<!--Modal Comunicación-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalComunicacion" style="margin-top: 200px;">
	    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title">Comunicación</h4>-->
            </div>
                <div class="modal-body"><a href="{{route('ecosistema.principal')}}">
					<img src = "{{ URL::asset('img/comunicacionEcosistema.jpg') }}" style="width: 100%" /></a>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@stop

@section('js-scripts')
@if(session('popUpLogueo') && $modoComunicacion)
	<script type="text/javascript">
		$('#modalComunicacion').modal();
	</script>
@endif
<script>

	/* Checkbox mantener cliente */
	$('.chkMantener').click(function(){
		checkbox = $(this);
		checkbox.prev().removeClass("hidden");
		checkbox.addClass("hidden");

        $.ajax({
            type: "POST",
            data: {
                lead: $(this).attr('lead'),
                marca: $(this).is(':checked')? 1:0,
                "_token": "{{ csrf_token() }}"
            },
            url: APP_URL + '/be/micontacto/mantener-lead',
            dataType: 'json',
            success: function (json) {
            	checkbox.prev().addClass("hidden");
                checkbox.removeClass("hidden");
            },
            error: function (xhr, status, text) {
            	checkbox.prev().addClass("hidden");
                checkbox.removeClass("hidden");
            }
		});
    });


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
                    console.log(link.closest('tr'));
                    console.log(link.closest('tr').find('.fa-circle'));
                    console.log(link.closest('tr').find('.diasPendiente'));
                    link.closest('tr').find('.fa-circle').css('color',"{{\App\Entity\BE\Etapa::COLOR_SEMAFORO_VERDE}}");
                    link.closest('tr').find('.diasPendiente').html("0d");
                    link.parent().html($('#frmEditarEtapa select[name="etapa"] option:selected').html());
                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                }
            });
        });
    }

    function listaEliminar(tipo) {

        $('#motivo option').remove();

        $("#motivo").css("display", "block");
        $("#comentario").css("display", "block");
        if (tipo == "1") {

            $('#motivo').append('<option value="1" >Datos de contacto errado</option>');
            $('#motivo').append('<option value="2" >Cliente no responde</option>');

        }

        if (tipo == "2") {
            $('#motivo').append('<option value="1" >Perfil BPE</option>');
            $('#motivo').append('<option value="2" >Grupo economico</option>');
            $('#motivo').append('<option value="3" >Sector Inmobiliario</option>');
            $('#motivo').append('<option value="4" >Sector Agricola</option>');
            $('#motivo').append('<option value="5" >Otra plaza</option>');

        }

        if (tipo == "3") {
            $('#motivo').append('<option value="1" >Mala experiencia con IBK</option>');
            $('#motivo').append('<option value="2" >Desea productos mas adelante</option>');
            $('#motivo').append('<option value="3" >Suficientes Bancos</option>');
            $('#motivo').append('<option value="4" >No entrega documentos</option>');
            $('#motivo').append('<option value="5" >Tasa/plazo/otras condiciones</option>');
            $('#motivo').append('<option value="6" ">No se cuenta con producto requerido</option>');
            $('#motivo').append('<option value="7" >Pasivero</option>');

        }

        if (tipo == "4") {
            $('#motivo').append('<option value="1" >Cumplimiento</option>');
            $('#motivo').append('<option value="2" >Situacion financiera</option>');
            $('#motivo').append('<option value="3" >Caracter</option>');

        }


        if (tipo == "5") {
            $("#motivo").css("display", "none");
            //$("#comentario").css("display", "block");
        }
    }



    $(document).ready(function () {
    	$(".flgsLinkedin").click(function (e){
    			$("#botonGuardarReferido").removeAttr('disabled'); 
    			$(".checkFlag").removeClass('hidden'); 

    	});

    	$(".flgsLinkedinElim").click(function (e){
    			$("#botonGuardarEliminar").removeAttr('disabled'); 
    			$("#checkFlagElim").removeClass('hidden'); 

    	});

        $('.formatInputNumber').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('#i-filtros-dropdown').on('click', function () {
            $('#filtros-avanzados').toggle()
            $('#i-filtros-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-filtros-dropdown').toggleClass('glyphicon-chevron-up')
        })


        /************** ACTUALIZAR ETAPA *****************/

        /* Modal Editar Etapa*/
        $('.lnkEditEtapa').click(function (e) {
            e.preventDefault();
            $('#frmEditarEtapa input[name="etapaActual"]').val($(this).attr('etapa'));
            $('#frmEditarEtapa input[name="lead"]').val($(this).attr('lead'));
            $('#modalEditarEtapa').modal();
            initializeFormEditarEtapa();
        });



        /************** AGREGAR REFERIDO *****************/
        $('#btnAgregarReferido').click(function (e) {
            $('#frmNuevoReferido input[type="text"]').val('');
            $('#divReferidoNuevo').addClass('hidden');
            $('#divReferidoExistente').addClass('hidden');
            $('#divLinkedin').addClass('hidden');
            $('#frmNuevoReferido .modal-footer').addClass('hidden');
            $('#modalAgregarReferido').modal();

        });

        /************** ELIMINAR LEAD *****************/
        $('.btnEliminarLead').click(function (e) {
        	$('#frmEliminarLead').formValidation('destroy', true);
            $('#frmEliminarLead .comentarioEliminar').val('');
            $('#modalEliminarLead').modal();
            data_id = $(this).attr('documentoE');
            console.log(data_id);
            $('#modalEliminarLead #documentoE').val(data_id);
            initializeFormEliminar();
        });

        /************** BUSCAR REFERIDO *****************/
        $('#txtDocumentoReferido').keypress(function (e) {
            //enter
            if (e.which == 13) {
                buscarReferido();
            }
        });

        $('#btnBuscarReferido').click(function (e) {        	
        	
            buscarReferido($(this));
        });

        /****** AGREGAR NOTA ******/
		$('.lnkNotas').click(function (e) {
			e.preventDefault();
            nuevoModalNotas($(this).attr('ejecutivo'),$(this).attr('lead'));
        });


        /****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
 		if ($('#cboBanca').length > 0){
            cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());
        }else{
            if ($('#cboZonal').length > 0){
                cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val());    
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
            cboZonalChange($(this).val(),null,null);
        });


        $('#cboBanca').change(function(){
            cboBancaChange($(this).val(),null,null,null);
        });
    });

	
	/****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
	function cboJefaturaChange(jefatura,ejecutivo,zonal) {

		console.log(jefatura);

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

    function cboZonalChange(zonal,jefatura,ejecutivo) {

        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de ejecutivos
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
            //Si no selecionada nada como resultado
            if (!zonal) {
            	cboJefatura.val('');
            	cboJefatura.prop('disabled', false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboJefatura.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true);
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

    function cboBancaChange(banca,zonal,jefatura,ejecutivo) {
    		var cboZonal = $('#cboZonal');
        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            
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
            		cboZonalChange(zonal,jefatura,ejecutivo);
            	}
            });
    }    
        
    /****** FORM REFERIDO ******/
    function initializeFormReferido() {
        return $('#frmNuevoReferido').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombreNuevo: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese el nombre de la empresa'
                        },
                    }
                },
                facturacionNuevo: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un monto facturación'
                        },
                        integer: {
                            message: 'Ingrese un número válido'
                        },
                        callback: {
                            message: 'El monto no se encuentra en el rango adecuado (3MM - 100MM)',
                            callback: function (value, validator, $field) {
                                if ('ME' == 'ME') {
                                    return ((value >= 3000000) && (value < 25000000));
                                } else {
                                    return ((value >= 25000000) && (value <= 100000000));
                                }
                            }
                        }
                    },
                },
                calificacion: {
                    validators: {
                        callback1: {
                            alias: 'callback',
                            message: 'La empresa no califica para ser referido',
                            callback: function (value, validator, $field) {
                                return jQuery.inArray(value, ['NORMAL', 'CPP','']) > -1;
                            }
                        }
                    }
                },
                ejecutivo: {
                    validators: {
                        callback2: {
                            alias: 'callback',
                            message: 'El referido ya tiene un ejecutivo asignado',
                            callback: function (value, validator, $field) {
                                return value == '';
                            }
                        }
                    }
                },
                sectorista: {
                    validators: {
                        callback3: {
                            alias: 'callback',
                            message: 'El referido ya tiene un sectorista asignado',
                            callback: function (value, validator, $field) {
                                return value == '';
                            }
                        }
                    }
                },
                flgLinkedin: {
                    validators: {
				        notEmpty: {
				          message: 'Selecciona una opción'
				        }
				      }
                },
            }
        });
    }

    function initializeFormEliminar() {
        return $('#frmEliminarLead').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                eliminarComentario: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese el cometario'
                        },
                        stringLength:{
                        	max: 300,
                        	message: 'El comentario no puede exceder los 300 caracteres'
                        }
                    }
                },       
                flgLinkedin: {
                    validators: {
				        notEmpty: {
				          message: 'Selecciona una opción'
				        }
				      }
                },         

            }
        });
    }
    /****** BUSCAR REFEREIDO ******/
    function buscarReferido(button) {
            var documento = $('#txtDocumentoReferido').val();

            if ($.inArray($.trim(documento).length, [8, 11]) == -1) {
                alert('Formato de documento incorrecto');
                return false;
            }
            if($('#helpNoLinkedin').val()!=-1){
        		$('#frmNuevoReferido input[name="flgLinkedin"]').removeAttr('checked');
        	}
        	$('#frmNuevoReferido label[name="botonesLinkedin"]').removeClass('active');
        	$('#frmNuevoReferido label[name="botonesLinkedin"]').removeClass('focus');
            $('#divReferidoNuevo').addClass('hidden');
            $('#divReferidoExistente').addClass('hidden');
            $('#divLinkedin').addClass('hidden');
            $('#frmNuevoReferido').formValidation('destroy', true);

            form = $('#frmNuevoReferido');

            item = button.find('.fa-search');
            item.addClass('hidden').prev().removeClass('hidden');

            $.ajax({
                url: APP_URL + 'be/miprospecto/consulta-referido',
                type: 'GET',
                data: {
                    documento: documento
                },
                success: function (result) {                	/*RECARGAMOS EL MODAL*/

                    $('#frmNuevoReferido .modal-footer').removeClass('hidden');
                    vform = initializeFormReferido();
                    if (result.existe == 'si') {
                    	//console.log("HOLI");
                        $('#divReferidoExistente').removeClass('hidden');
                        $('#divLinkedin').removeClass('hidden');
                        form.find('input[name="documento"]').val(result.data['NUM_DOC']);
                        form.find('input[name="nombre"]').val(result.data['NOMBRE']);
                        form.find('input[name="calificacion"]').val(result.data['CALIFICACION']);
                        form.find('input[name="feve"]').val(result.data['FLAG_FEVE']);
                        form.find('input[name="etapa"]').val(result.data['ETAPA_NOMBRE']);
                        form.find('input[name="ejecutivo"]').val(result.data['EJECUTIVO_NOMBRE']);
                        form.find('input[name="sectorista"]').val(result.data['COD_SECT_UNIQ_EN']);
                        form.find('input[name="deuda"]').val(result.data['DEUDA_DIRECTA']);
                        form.find('input[name="motivoDetalle"]').val(result.data['MOTIVO_DETALLE']);
                        form.find('input[name="fechaUltimaE"]').val(result.data['FECHA_ETAPA']);
                        form.find('input[name="fechaUltimaV"]').val(result.data['FECHA_ACTIVIDAD']);


                        vform.formValidation('revalidateField', "calificacion");
                        vform.formValidation('revalidateField', "ejecutivo");
                        vform.formValidation('revalidateField', "sectorista");
                        //vform.formValidation('revalidateField', "flgLinkedin");
                    } else {
                        $('#divReferidoNuevo').removeClass('hidden');
                        $('#divLinkedin').removeClass('hidden');
                    }
                    item.removeClass('hidden').prev().addClass('hidden');
                    //$('#botonGuardarReferido').attr('disabled','true');

                },
                error: function (xhr, status, text) {
                    e.preventDefault();
                    alert('Hubo un error al registrar el consultar la información, inténtelo mas tarde');
                    item.removeClass('hidden').prev().addClass('hidden');
                }
            });
    }

    /****** NOTAS *****/
    function nuevoModalNotas(ejecutivo,lead){
    	initializeFormNota(ejecutivo,lead);
    	$('#listaNotas .sin-resultados').addClass('hidden');
    	$('#listaNotas .cargando-resultados').removeClass('hidden');
    	$('#listaNotas .item-nota').remove()
    	$('#modalNotas').modal();
    	cargarNotas(ejecutivo,lead);
    }

    function initializeFormNota($ejecutivo,$lead){
    	$('#frmAgregarNota input[name="lead"]').val($lead)
    	$('#frmAgregarNota textarea').val('')
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
					html += '<p><strong>'+ result.FECHA_REGISTRO.substring(0,16) + ' - </strong>' + result.NOTA + '</p>';
					html+='<div align="right"><a class="fa fa-trash fa-2x" href="#" idnota ="'+result.NOTA_ID+'" registro="'+result.REGISTRO_EN+'" numdoc="'+result.NUM_DOC+'" onClick="eliminarNota(this)"></div></a>'
					html += '</li>';
					$('#listaNotas').prepend(html);
					$form.data('formValidation').resetForm();
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

    function cargarNotas(ejecutivo,lead){
    	$.ajax({
                url: "{{route('be.miprospecto.nota.listar')}}",
                type: 'GET',
                data: {
                	lead: lead,
                	ejecutivo: ejecutivo,
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
					    html += '<p><strong>'+ result[i].FECHA_REGISTRO.substring(0,16) + ' - </strong>' + result[i].NOTA +'</p>';
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
                url: "{{route('be.miprospecto.nota.eliminar')}}",
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
@stop
