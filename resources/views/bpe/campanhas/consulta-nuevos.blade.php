@extends('Layouts.layout')

@section('js-libs')
@stop

@section('pageTitle', 'Consulta de Leads')

@section('content')

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
	                    <input class="form-control" type="text" value="{{ $nro_doc }}" name="nro_doc" >
	                </div>
	                <div class="col-md-4">
	                	<button class="btn btn-primary" type="submit" id="boton_consultar"><span class="glyphicon glyphicon-search"></span> Consultar</button>	
	                </div>
	                
            	</div>
			</form>
		</div>		
	</div>

	@if ($lead)
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
							<input type="text" name="ruc" class='form-control' value="{{ $lead->NUM_DOC }}" readonly="readonly">	
						</div>						
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>CU</label>
						<div class='col-md-9'>
							<input type="text" name="cu" class='form-control' value="{{ $lead->COD_UNICO }}"" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Nombre/R.Social</label>
						<div class='col-md-9'>
							<input type="text" name="nombre" class='form-control' value="{{ $lead->NOMBRE_CLIENTE }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Representante</label>
						<div class='col-md-9'>
							<input type="text" name="repr" class='form-control'  value="{{ $lead->REPRESENTANTE_LEGAL }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Distrito</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control'  value="{{ $lead->DISTRITO }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Segmento</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="{{ $lead->SEGMENTO }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Riesgo</label>
						<div class='col-md-9'>
							<input type="text" name="riesgo" class='form-control' value="{{ $lead->SCORE_BURO }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Deuda SSFF</label>
						<div class='col-md-9'>
							<input type="text" name="deuda" class='form-control' value="S/. {{ $lead->DEUDA_SSFF }}" readonly="readonly">
						</div>
					</div>
					@if($lead->FLG_ES_CLIENTE == 1)
						<div class="form-group">
							<label class='col-md-3 control-label'>Atraso Último</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->ATRASO_ULTIMO }}" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Atraso Promedio</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->ATRASO_PROMEDIO }}" readonly="readonly">
							</div>
						</div>
					@endif
				</form>
			</div>
			<div class='col-md-6'>
				<form class='form-horizontal form-label-left'>
					<div class="form-group">
						<label class='col-md-3 control-label'>Actividad</label>
						<div class='col-md-9'>
							<input type="text" name="actividad" class='form-control' value="{{ $lead->ACTIVIDAD }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Giro</label>
						<div class='col-md-9'>
							<input type="text" name="giro" class='form-control' value="{{ $lead->GIRO }}" readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Asignado A</label>
						
							@if ($lead->EN_NOMBRE)
							<div class='col-md-9'>
							<input type="text" name="nombre" class='form-control' value="{{ $lead->EN_NOMBRE }}" readonly="readonly">
							</div>
							@else
							<label class="info-label col-md-9 col-sm-9 col-xs-9" style="font-weight: 800; color: #FA503A;">LIBRE</label>
							@endif
						
					</div>
					<div class="form-group">
						<label class='col-md-3 control-label'>Zonal</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="{{ $lead->ZONAL}}" readonly="readonly">
						</div>
					</div>	
					<div class="form-group">
						<label class='col-md-3 control-label'>Tienda</label>
						<div class='col-md-9'>
							<input type="text" name="distrito" class='form-control' value="{{ $lead->TIENDA }}" readonly="readonly">
						</div>
					</div>

					@php
						$canales = $lead->CANALES? explode('|',$lead->CANALES): [];
						$canales = array_unique($canales);
					@endphp

					@if($lead->FLG_ES_CLIENTE == 0)
						<div class="form-group">
							<label class='col-md-3 control-label'>Canal</label>
							@if (count($canales) > 0)
								@foreach ($canales as $key => $canal)
									@if ($key == 0)
										<div class="col-md-9">
											<input type="text" name="nombre" class='form-control' value="{{ $canal }}" readonly="readonly" />
										</div>
										</div>
									@else
										<div class="form-group">
											<div class='col-md-9 col-md-offset-3'>
												<input type="text" name="nombre" class='form-control' value="{{ $canal }}" readonly="readonly">
											</div>
										</div>
									@endif
								
								@endforeach
							@else
								<label class="info-label col-md-9 col-sm-9 col-xs-9" style="font-weight: 800; color: #FA503A;">LIBRE</label>
							@endif
						</div>
					@endif			
					

					@if($lead->FLG_ES_CLIENTE == 1)
						<div class="form-group">
							<label class='col-md-3 control-label'>Producto Principal</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->PRODUCTO_PRINCIPAL }}" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Número de Productos</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->NUMERO_PRODUCTOS }}" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Score Comportamiento</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->SCORE_COMPORTAMIENTO }}" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Calificación SBS</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->CALIFICACION_SBS }}" readonly="readonly">
							</div>
						</div>
						<div class="form-group">
							<label class='col-md-3 control-label'>Ultima Fecha Evaluacion</label>
							<div class='col-md-9'>
								<input type="text" name="deuda" class='form-control' value="{{ $lead->ULTIMA_FECHA_EVALUACION }}" readonly="readonly">
							</div>
						</div>
					@endif
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
                    @if(count($campanhas)>0 && $lead->FLG_ES_CLIENTE == 0)
	                    @foreach ($campanhas as $campanha)
		                    <tr>
		                        <td>{{$campanha->NOMBRE}}</td>	                        
	                        	<td>
		                        	<?php
	                            	$atributos = explode('|', $campanha->ATRIBUTO);
	                            	$tipos = explode('|', $campanha->TIPO);
	                            	$valores = explode('|', $campanha->VALOR);
	                            	$condicional = explode('|', $campanha->CONDICIONAL);

	                            	$arrayKeys = array_keys($atributos);
									$lastArrayKey = array_pop($arrayKeys);
	                            	?>

	                            	@foreach ($atributos as $key => $atributo)
	                            		@if ($condicional[$key] == 0)
			                            	- {{ $atributos[$key] }}:
			                            	{{ \App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key]) }}
		                            	@endif
	                            	@endforeach
									<br>
									@if (count(array_filter(array_unique($condicional))) > 0 and current(array_filter(array_unique($condicional))) == 1)
                                	<b>Compra de Deuda Repotenciada</b>
                                	@endif
									
	                            	@foreach ($atributos as $key => $atributo)
	                            		@if ($condicional[$key] > 0)
			                            	- {{ $atributos[$key] }}:
			                            	{{ \App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key]) }}
		                            	@endif
	                            	@endforeach
	                        	</td>
		                    </tr>
	                    @endforeach
	                @else
	                	<tr><td colspan="7">No hay campañas asignadas</td></tr>
                    @endif
                </tbody>
            </table>
		</div>
	</div>



		@if( Auth::user()->ROL != App\Entity\Usuario::ROL_SOPORTE)
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
	                    @if(count($gestiones)>0)
		                    @foreach ($gestiones as $gestion)
		                    <tr>
		                        <td>{{$gestion->EJECUTIVO}}</td>
		                        <td>{{$gestion->CAMP_EST_NOMBRE}}</td>
		                        <td>{{$gestion->FECHA_REGISTRO}}</td>
		                        <td>{{$gestion->GESTION_RESULTADO}}</td>
		                        <td>{{($gestion->GESTION_RESULTADO == 'LO PENSARA')? $gestion->FECHA_VOLVER_LLAMAR: $gestion->GESTION_MOTIVO}}</td>
		                        <td>{{isset($gestion->VISITADO)? $gestion->VISITADO:'-'}}</td>
		                        <td>{{isset($gestion->COMENTARIO)? $gestion->COMENTARIO:'-'}}</td>
		                    </tr>
		                    @endforeach
		                @else
		                	<tr><td colspan="7">No se encontraron gestiones previas</td></tr>
	                    @endif
	                </tbody>
	            </table>
			</div>
		</div>
		@endif
	@else
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
	@endif
</div>

{{-- @section('js-scripts')
	<script type="text/javascript">
		$(document).ready(function(){

			$("#boton_consultar").click(function(){

			})
		});
	</script>
@endsection --}}

@stop