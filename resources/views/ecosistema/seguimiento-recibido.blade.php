@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/chart.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>


<style>

.modalCargando {
	display:    none;
	position:   fixed;
	z-index:    1000;
	top:        0;
	left:       0;
	height:     100%;
	width:      100%;
	opacity: 0.7;
	background: #FFFFFF/*rgba( 255, 255, 255, .6 ) */
	url('https://k43.kn3.net/taringa/1/6/0/8/5/0/80/dnite/129.gif?3173') 
	50% 50% 
	no-repeat;
}
th {

	border-top: 0px;
	border-right: 0px;
	border-bottom: 0px;
	border-left: 0px;
}

.elementoTabla{
	vertical-align: middle;text-align: center;font-size: 12px;height: 25px;
}

.tablaPersonalizada{
	width: 100%;
	/*display: table;
    border-collapse: separate;
    border-spacing: 2px;
    -webkit-border-horizontal-spacing: 2px;
    -webkit-border-vertical-spacing: 2px;
    border-color: grey;*/
}
</style>

@stop


@section('content')
@section('pageTitle', 'Seguimiento Ecosistema Recibido')

<form action="{{ route('ecosistema.seguimiento.recibido') }}" class="form-horizontal">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Búsqueda</h2>	
				<ul class="nav navbar-right panel_toolbox">
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row clearfix">


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



									<!--<div class="form-group col-md-3">
										<label for="" class="control-label col-md-3">Ej. Negocio:</label>
										<div class="col-md-9">
											<select id="cboEjecutivo" class="form-control" name="ejecutivo">
												<option value="">Todos</option>
												@foreach ($ejecutivos as  $ejecutivo)
												<option value="{{$ejecutivo->REGISTRO}}" {{($ejecutivo->REGISTRO == $busqueda['ejecutivo'])? 'selected="selected"':''}}
													>{{$ejecutivo->NOMBRE}}</option>
													@endforeach
												</select>
											</div>
										</div>-->

										<!--<div class="form-group col-md-3">
											<label for="" class="control-label col-md-3">Fecha:</label>										
											<div class="input-group divFecha col-md-9" id="divFecha">               
												<div class="input-group-addon styleAddOn"><i class="glyphicon glyphicon-calendar fa fa-calendar" for="txtFechaAvance"></i></div>
												<input class="form-control dfecha"  type="text" id="txtFechaAvance" name="fechaAvance" placeholder="Seleccionar fecha" value="{{$busqueda['fechaAvance']}}">
											</div>
										</div>-->									


										<div class="col-md-1">
											<button class="btn btn-primary" type="submit" >Buscar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>



					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_content">
								<div class="" role="tabpanel" data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
										<li role="presentation" class="{{ Route::currentRouteName() == 'ecosistema.seguimiento.ingresado'? 'active':'' }}">
											<a href="{{ route('ecosistema.seguimiento.ingresado') }}" style="cursor: pointer;">Ingresado</a>
										</li>
										<li role="presentation" class="{{ Route::currentRouteName() == 'ecosistema.seguimiento.recibido'? 'active':'' }}">
											<a href="{{ route('ecosistema.seguimiento.recibido') }}" style="cursor: pointer;">Recibido</a>
										</li>
									</ul>									
								</div>
								<div id="contenedorPrincipal">
										<div class="col-xs-12">
										<div class="x_panel">
											<div class="x_title" style="height: auto;">
												<h2>Resumen</h2>
												<ul class="nav navbar-right panel_toolbox">
													<li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="x_content" style="display: block;">
												<div class="col-md-5 col-sm-5 col-xs-5" id="tablaEjecutivos" >
													<table class="tablaPersonalizada table-striped jambo_table" style="">
														<thead>

															<tr class="headings">		                	
																<th class="elementoTabla" style="width: 70%" >&nbsp</th>		                    
																<th class="elementoTabla" style="width: 30%" rowspan="2">N° de empresas </th>		                    

															</tr>
															<tr class="headings">                    
																<th class="elementoTabla" >&nbsp</th>

															</tr>
															<tr class="headings">		                	
																<th class="elementoTabla"></th>	                    
																<th class="elementoTabla">{{$busqueda['fechaCorte']}}</th>	                    

															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="elementoTabla" style="cursor: pointer;" id="clickTotales"><strong>Totales (+)</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->NUM_EMPRESAS_CORTE}}</strong></td>                	
															</tr>
															@if(count($resumen)>0)
															@foreach($resumen as $ejecutivo)
															<tr class="filasOcultas hidden">
																<td class="elementoTabla">
																	{{$ejecutivo->NOMBRE}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->NUM_EMPRESAS_CORTE}}
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

												</div>


												<div class="col-md-4 col-sm-4 col-xs-4" id="tablaProveedores" >
													<table class="tablaPersonalizada table-striped jambo_table" style="">
														<thead>

															<tr class="headings">		                	

																<th class="elementoTabla" style="width: 30%" rowspan="2">N° de empresas</th>		                    
																<th class="elementoTabla" colspan="7">N° de proveedores derivados</th>		                    
															</tr>
															<tr class="headings">

																<th class="elementoTabla" colspan="7">(Ingresados en la macro)</th>							        

															</tr>
															<tr class="headings">		                	

																<th class="elementoTabla">{{$busqueda['fechaAvance']}}</th>		                    
																<th class="elementoTabla">Total</th>		                    
																<th class="elementoTabla">MEL</th>		                    
																<th class="elementoTabla">GEL</th>		                    
																<th class="elementoTabla">BEP</th>		                    
																<th class="elementoTabla">BC</th>		                    
																<th class="elementoTabla">BPE</th>		                    
																<th class="elementoTabla">Mesa</th>		                    
															</tr>
														</thead>
														<tbody>
															<tr>

																<td class="elementoTabla"><strong>{{$totales->NUM_EMPRESAS}}&nbsp
																	@if($totales->NUM_EMPRESAS_CORTE<$totales->NUM_EMPRESAS)	
																	<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																	@elseif($totales->NUM_EMPRESAS_CORTE>$totales->NUM_EMPRESAS)
																	<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																	@else
																	<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																	@endif
																</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->TOTAL}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_MEL}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_GEL}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_BEP}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_BC}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_BPE}}</strong></td>	                	
																<td class="elementoTabla"><strong>{{$totales->CUENTA_MESA}}</strong></td>	                	

															</tr>
															@if(count($resumen)>0)
															@foreach($resumen as $ejecutivo)
															<tr class="filasOcultas hidden">

																<td class="elementoTabla">
																	{{$ejecutivo->NUM_EMPRESAS}}&nbsp
																	@if($ejecutivo->NUM_EMPRESAS_CORTE<$ejecutivo->NUM_EMPRESAS)	
																	<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																	@elseif($ejecutivo->NUM_EMPRESAS_CORTE>$ejecutivo->NUM_EMPRESAS)
																	<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																	@else
																	<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																	@endif
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->TOTAL}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_MEL}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_GEL}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_BEP}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_BC}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_BPE}}
																</td>	                	
																<td class="elementoTabla">
																	{{$ejecutivo->CUENTA_MESA}}
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

												</div>

												<div class="col-md-3 col-sm-3 col-xs-3" id="tablaKPI">
													<table class="tablaPersonalizada table-striped jambo_table">
														<thead>
															<tr class="headings">		                	
																<th class="elementoTabla" colspan="6">KPIs</th>		                   
															</tr>
															<tr class="headings">		                	
																<th class="elementoTabla" colspan="3">Volumen S/ MM</th>		                    
																<th class="elementoTabla" colspan="3">Proveedores Nuevos</th>	
															</tr>
															<tr class="headings">		                	
																<th class="elementoTabla">Ecosistema</th>		                    
																<th class="elementoTabla">Real</th>		                    
																<th class="elementoTabla">Meta</th>		                    
																<th class="elementoTabla">N°</th>		                    
																<th class="elementoTabla">Real</th>		                    
																<th class="elementoTabla">Meta</th>	                   

															</tr>
														</thead>
														<tbody>
															<tr >
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>	                	
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>	                	
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>	                	
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>	                	
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>	                	
																<td class="elementoTabla"><strong><?php echo rand(0,100) ?></strong></td>              

															</tr>
															@if(count($resumen)>0)
															@foreach($resumen as $ejecutivo)
															<tr class="filasOcultas hidden">
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
																</td>	                	
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
																</td>	                		
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
																</td>	                	
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
																</td>   
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
																</td>   
																<td class="elementoTabla">
																	<?php echo rand(0,100) ?>
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

												</div>
											</div>
										</div>
									</div>
								</div>

									<div class="col-xs-12">
										<div class="x_panel">
											<div class="x_title" style="height: auto;">
												<h2>Evolución de Ecosistema Ingresado</h2>
												<ul class="nav navbar-right panel_toolbox">
													<li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="x_content" style="display: block;">
												<center>
													<canvas id="canvas"></canvas>
												</center>
											</div>
										</div>
									</div>

									<div class="col-xs-12">
										<div class="x_panel">
											<div class="x_title" style="height: auto;">
												<h2>Proveedores status de gestión</h2>
												<ul class="nav navbar-right panel_toolbox">
													<li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="x_content" style="display: block;">
												<table class="table table-striped table-bordered jambo_table" id="tblStatusGestion" style="width: 100%">
													<thead>
														<tr>
															<th>Fecha Ingreso</th>
															<th>Estado</th>
															<th>Banca</th>
															<th>Grupo/Zonal</th>
															<th>Asignado a</th>
															<th>Empresa</th>
															<th>Potencial</th>
															<th>Ejecutivo que lo refiere</th>
															<th>Empresa que lo refiere</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					<div class="modalCargando"><!-- Place at bottom of page --></div>

					@stop

					@section('js-scripts')


					<script type="text/javascript">
						$(document).ready(function () {
						cargarStatusGestion($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val()); //Mostramos la datatable
						cargaDataGraficos($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val()); //Graficamos
						//Damos un valor inicial para que las filas se mantengan ocultas

						$('#clickTotales').val("0");

						$('#clickTotales').on("click", function () {
							
							if( $('#clickTotales').val()=="0"){
								$('.filasOcultas').removeClass('hidden');	
								$('#clickTotales').val("1");	
								var alturaMinima= 1450+document.getElementsByClassName("filasOcultas").length/3*25;
								$('.right_col').css('min-height',  alturaMinima+'px');
								
							}
							else{
								$('.filasOcultas').addClass('hidden');	
								$('#clickTotales').val("0");
								$('.right_col').css('min-height', '1400px');
							}
						});


						$('.dfecha').each(function() {
							$(this).datepicker({
								maxViewMode: 1,
				                        //daysOfWeekDisabled: "0,6",
				                        language: "es",
				                        autoclose: true,
				                        startDate: "-365d",
				                        endDate: "-1d",
				                        format: "yyyy-mm-dd",
				                    })
							.on('changeDate', function(e) {
				            // Revalidate the date field
				            console.log("Hola");            	
				        });
						});
						/****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
						if ($('#cboBanca').length > 0){
							cboBancaChange($('#cboBanca').val(),$('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboProducto').val());
						}else{
							if ($('#cboZonal').length > 0){
								cboZonalChange($('#cboZonal').val(),$('#cboJefatura').val(),$('#cboEjecutivo').val(),$('#cboProducto').val());    
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
							cboZonalChange($(this).val(),null,null,null);
						});


						$('#cboBanca').change(function(){
							cboBancaChange($(this).val(),null,null,null,null);
						});
					});

						function cargarStatusGestion(banca,zonal,jefatura){
							datatable = $('#tblStatusGestion').DataTable({
								processing: true,
								serverSide: true,
								aaSorting: [],
								language: {"url": APP_URL + "dataTables.spanish.lang"},
								ajax: {
									url : APP_URL + 'ecosistema/seguimiento-ingresado-status',
									data: {
										banca: banca,
										zonal: zonal,
										jefatura: jefatura,
									}
								},

								columns: [
								{data:'FECHA_INGRESO'},
								{data:'ESTADO'},
								{data:'BANCA'},
								{data:'ZONAL'},
								{data:'ASIGNADO_A'},
								{data:'EMPRESA'},
								{data:'POTENCIAL'},
								{data:'EJECUTIVO_REFIERE'},
								{data:'EMPRESA_REFIERE'}


								]
							});

						}

						function cboDelegadoChange(zonal){
							var cboDelegado =$('.cboDelegado');

							cboDelegado.find('option:not(:first)').remove();

							$.ajax({
								type: "GET",
								data: {
									zonal: zonal            		
								},
								url: APP_URL + 'be/utils/get-productos-by-zonal',
								dataType: 'json',
								success: function (json) {
									$.each(json, function (key, value) {
										cboDelegado.append($("<option></option>")
											.attr("value", value.REGISTRO).text(value.NOMBRE));
									});

								}
							});

						}
						/****** BANCA - ZONAL - JEFATURA - EJECUTIVO ******/
						function cboJefaturaChange(jefatura,ejecutivo,zonal) {


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

        function cboZonalChange(zonal,jefatura,ejecutivo,producto) {

        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');
        	var cboProducto = $('#cboProducto');

            //Limpiamos el combobox de ejecutivos
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            //cboProducto.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            //cboProducto.val('');
            
            //Si no selecionada nada como resultado
            if (!zonal) {
            	cboJefatura.val('');
            	cboProducto.val('');
            	cboJefatura.prop('disabled', false);
            	cboProducto.prop('disabled', false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboJefatura.prop('disabled', true);
            cboProducto.prop('disabled', true);
            //cboEjecutivo.prop('disabled', true);

            $.ajax({
            	type: "GET",
            	data: {zonal: zonal},
            	url: APP_URL + 'be/utils/get-productos-by-zonal',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboProducto.append($("<option></option>")
            				.attr("value", value.REGISTRO).text(value.NOMBRE));
            		});
            		if (producto){
            			cboProducto.val(producto);
            		}
            		cboProducto.prop('disabled', false);
            	}
            });


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

        function cboBancaChange(banca,zonal,jefatura,ejecutivo,producto) {
        	var cboZonal = $('#cboZonal');
        	var cboJefatura = $('#cboJefatura');
        	var cboEjecutivo = $('#cboEjecutivo');
        	var cboProducto = $('#cboProducto');

            //Limpiamos el combobox de jefaturas
            cboZonal.find('option:not(:first)').remove();
            cboJefatura.find('option:not(:first)').remove();
            cboEjecutivo.find('option:not(:first)').remove();
            cboProducto.find('option:not(:first)').remove();
            cboEjecutivo.val('');
            cboProducto.val('');
            
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
            		cboZonalChange(zonal,jefatura,ejecutivo,producto);
            	}
            });
        }    

        /*** GRAFICOS ****/

        function cargaDataGraficos(banca,zonal,jefatura){

        	$.ajax({
        		type: "GET",
        		data: {
        			banca: banca,       		
        			zonal: zonal,           		
        			jefatura: jefatura,jefatura           		
        		},
        		async:false,
        		url: APP_URL + 'ecosistema/seguimiento-ingresado/graficar',
        		success: function (result) {
        			console.log(result);
        			var fechas=[];
        			var proveedores=[];
        			var empresas=[];
        			for (var i = 0; i < result.length; i++) {
        				fechas.push(result[i]['FECHA']);
        				proveedores.push(result[i]['NUM_PROVEEDORES']);
        				empresas.push(result[i]['NUM_EMPRESAS']);
        			}


        			var lineChartData = {
        				labels: fechas,
        				datasets: [{
        					label: 'N° de proveedores referidos',
        					borderColor: window.chartColors.green,
        					backgroundColor: window.chartColors.green,
        					fill: false,
        					data: proveedores,
        					yAxisID: 'y-axis-1',
        				}, {
        					label: 'N° de empresas',
        					borderColor: window.chartColors.blue,
        					backgroundColor: window.chartColors.blue,
        					fill: false,
        					data: empresas,
        					yAxisID: 'y-axis-2'
        				}]
        			};

        			window.onload = function() {
        				var ctx = document.getElementById('canvas').getContext('2d');
        				window.myLine = Chart.Line(ctx, {
        					data: lineChartData,
        					options: {
        						responsive: true,
        						hoverMode: 'index',
        						stacked: false,
        						scales: {
        							yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',

							// grid line settings
							gridLines: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
							},
						}],
					}
				}
			});


        			}; 

        			$('#canvas').css('width','70%');  
        			$('#canvas').css('height','70%');  

        		}
        	});

        	





	}



</script>
@stop