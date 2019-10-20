@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="{{ URL::asset('css/switchery.min.css') }}"  type="text/css" >
<script type="text/javascript" src="{{ URL::asset('js/switchery.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

@stop

@section('content')
<style type="text/css">
	.registros{
		font-size: 12px;
		text-align: center;

	}

	.encabezados{
		font-size: 14px;
		text-align: center;
	}

</style>
@section('pageTitle', 'Resumen Encuestas')
<div class="row">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
      		<div class="x_title">
	      		<h2>Evaluadores</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<div class="x_content">


		        <table class="table table-striped jambo_table">
		            <thead>
		                <tr class="headings">		                	
		                    <th class="encabezados" style="vertical-align:middle;width:30% ">Evaluador</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Estado</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Total a Evaluar</th>
		                    <th class="encabezados" style="vertical-align:middle;width:40% ">Resumen</th>                    
		                </tr>
		            </thead>
		            <tbody>
						@if(count($avance)>0)
							@foreach($avance as $jefe)
				                <tr>		                	
				                	<td class="registros" style="vertical-align: middle;">
				                		<label>{{$jefe->REGISTRO_JEFE}}:</label> {{$jefe->NOMBRE}}
				                	</td>				              
				                	@if($jefe->FLG_ENCUESTA==1)
				                		<td class="registros" style="vertical-align: middle">
				                			<span style="font-size: 14px" class="label label-info">Realizado</span>
				                		</td>
				                	@else
				                		<td class="registros" style="vertical-align: middle">
				                			<span style="font-size: 14px" class="label label-warning">Pendiente</span>
				                		</td>
				                	@endif
				                	<td class="registros" style="vertical-align: middle;">{{$jefe->NUM_A_EVALUAR}}</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		@if($jefe->FLG_ENCUESTA==1)
				                		<div class="progress" >
										  <div class="progress-bar progress-bar-success" role="progressbar" style="font-size: 14px;width:{{$jefe->CONOCE*100/$jefe->NUM_A_EVALUAR}}%">
										    {{$jefe->CONOCE}}
										  </div>
										  <div class="progress-bar progress-bar-danger" role="progressbar" style="font-size: 14px;width:{{$jefe->NO_CONOCE*100/$jefe->NUM_A_EVALUAR}}%">
										    {{$jefe->NO_CONOCE}}
										  </div>
										</div>				                			
				                		@endif
				                	</td>				                	
				                </tr>
			                @endforeach
						@else
				            <tr>
				                <td colspan="4">No se encontraron resultados</td>
				            </tr>
		            	@endif
		        </tbody>
		    </table>

			</div>
		</div>
	</div>



	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
      		<div class="x_title">
	      		<h2>Colaboradores</h2>
	        	<ul class="nav navbar-right panel_toolbox">
	        	</ul>
	        	<div class="clearfix"></div>
    		</div>

    		<div class="x_content">


		        <table class="table table-striped jambo_table table-responsive">
		            <thead>
		                <tr class="headings">		                	
												<th class="encabezados" style="vertical-align:middle;width:10% ">Área</th>
		                    <th class="encabezados" style="vertical-align:middle;width:20% ">Colaborador</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Total a Evaluar</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Interactuado</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">No Interactuado</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Pregunta 1</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Pregunta 2</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Pregunta 3</th>
		                    <th class="encabezados" style="vertical-align:middle;width:10% ">Promedio Preguntas</th>
		                </tr>
		            </thead>
		            <tbody>
						@if(count($resumen)>0)
							@foreach($resumen as $analista)
				                <tr>		                	
													<td class="registros" style="vertical-align: middle;">{{$analista->AREA}}</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		{{$analista->NOMBRE}}
				                	</td>
				                	<td class="registros" style="vertical-align: middle;">{{$analista->TOTAL_EVALUADORES}}</td>
				                	<td class="registros" style="vertical-align: middle;">{{$analista->RECONOCIDO}}</td>
				                	<td class="registros" style="vertical-align: middle;">{{$analista->NO_RECONOCIDO}}</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		@if($analista->RECONOCIDO>0)
										<div class="progress">
										  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
										  aria-valuemin="0" aria-valuemax="100" style="width:{{$analista->PREGUNTA_1*100/5}}%;font-size: 12px;font-weight: bold;color: black">
										    {{number_format($analista->PREGUNTA_1,1,'.',',')}}
										  </div>
										</div>
										@endif
				                	</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		@if($analista->RECONOCIDO>0)
				                		<div class="progress">
										  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
										  aria-valuemin="0" aria-valuemax="100" style="width:{{$analista->PREGUNTA_2*100/5}}%;font-size: 12px;;font-weight: bold;color: black">
										    {{number_format($analista->PREGUNTA_2,1,'.',',')}}
										  </div>
										</div>
										@endif
				                	</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		@if($analista->RECONOCIDO>0)
				                		<div class="progress">
										  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
										  aria-valuemin="0" aria-valuemax="100" style="width:{{$analista->PREGUNTA_3*100/5}}%;font-size: 12px;font-weight: bold;color: black">
										    {{number_format($analista->PREGUNTA_3,1,'.',',')}}
										  </div>
										</div>
										@endif
				                	</td>
				                	<td class="registros" style="vertical-align: middle;">
				                		@if($analista->RECONOCIDO>0)
				                		<div class="progress">
										  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
										  aria-valuemin="0" aria-valuemax="100" style="width:{{$analista->PUNTAJE_PROMEDIO*100/5}}%;font-size: 12px;font-weight: bold;color: black">
										    {{number_format($analista->PUNTAJE_PROMEDIO,1,'.',',')}}
										  </div>
										</div>
										@endif
				                	</td>
				                </tr>
			                @endforeach
						@else
				            <tr>
				                <td colspan="9">No se encontraron resultados</td>
				            </tr>
		            	@endif
		        </tbody>
		    </table>

			</div>
		</div>
	</div>
</div>


@stop

@section('js-scripts')
<script type="text/javascript">
	$(document).ready(function () {

	});
</script>
@stop
