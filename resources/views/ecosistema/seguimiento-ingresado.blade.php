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

.nombreJerarquia{
	vertical-align: middle;font-size: 12px;height: 25px;padding-left: 15px;
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
@section('pageTitle', 'Seguimiento Ecosistema Ingresado')

<form action="{{ route('ecosistema.seguimiento.ingresado') }}" class="form-horizontal">
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


										<div class="col-md-2">
											<button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Buscar</button>
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
											<a href="{{ route('ecosistema.seguimiento.ingresado') }}" style="cursor: pointer;">Ecosistema Ingresado</a>
										</li>
										<li role="presentation" class="{{ Route::currentRouteName() == 'ecosistema.seguimiento.recibido'? 'active':'' }}">
											<!--<a href="{{ route('ecosistema.seguimiento.recibido') }}" style="cursor: pointer;" >Recibido (Muy pronto!)</a>-->
											<a href="#" style="cursor: default;">Recibido (¡Muy pronto!)</a>
										</li>
									</ul>
									
								</div>


								<div id="contenedorAgrupado">
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
												<div class="col-md-5 col-sm-5 col-xs-5" id="tablaEjecutivosAgrup" >
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
																<td class="nombreJerarquia" style="cursor: pointer;" id="clickTotales">
																	<strong>Totales <i class="fa fa-chevron-up"></i></strong></td>	                	
																	<td class="elementoTabla"><strong>{{$totales->NUM_EMPRESAS_CORTE}}</strong></td>                	
																</tr>
																@if(count($resumenAgrupado)>0)
																@foreach($resumenAgrupado as $banca)
																<tr class="filaBanca ">
																	<td class="nombreJerarquia" style="cursor: pointer;padding-left: 30px" id="clickBanca{{$banca['BANCA']}}">
																		<strong>Banca: {{$banca['BANCA']}} <i class="fa fa-chevron-up"></i> </strong>
																	</td>	                	
																	<td class="elementoTabla">
																		<strong>{{$banca['NUM_EMPRESAS_CORTE']}}</strong>																	
																	</td>	               		
																</tr>
																@foreach($banca['ZONALES'] as $zonal)
																<tr class="filaZonal{{$zonal['BANCA']}} banca{{$banca['BANCA']}} ">
																	<td class="nombreJerarquia" style="cursor: pointer;padding-left: 45px" id="clickZonal{{$zonal['ID_ZONA']}}">
																		<strong>Zonal: {{$zonal['ZONAL']}} <i class="fa fa-chevron-up"></i> </strong>
																	</td>	                	
																	<td class="elementoTabla">
																		<strong>{{$zonal['NUM_EMPRESAS_CORTE']}}</strong>																	
																	</td>	               		
																</tr>
																@foreach($zonal['JEFATURAS'] as $jefatura)
																@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																<tr class="filaJefatura{{$jefatura['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}} ">
																	<td class="nombreJerarquia" style="cursor: pointer;padding-left: 60px" id="clickJefatura{{$jefatura['ID_JEFATURA']}}">
																		<strong>Jefatura: @if($jefatura['JEFATURA']==$zonal['ZONAL']) TODAS @else{{$jefatura['JEFATURA']}}@endif <i class="fa fa-chevron-down"></i> </strong>
																	</td>	                	
																	<td class="elementoTabla">
																		<strong>{{$jefatura['NUM_EMPRESAS_CORTE']}}</strong>																
																	</td>	               		
																</tr>
																@endif
																@foreach($jefatura['EJECUTIVOS'] as $ejecutivo)
																@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																<tr class="filaEjecutivo{{$ejecutivo['ID_JEFATURA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}} jefatura{{$jefatura['ID_JEFATURA']}} hidden">
																	@else
																	<tr class="filaJefatura{{$jefatura['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}}">
																		@endif
																		<td class="nombreJerarquia" style="padding-left: 75px">
																			{{$ejecutivo['EJECUTIVO']}}
																		</td>	                	
																		<td class="elementoTabla">
																			{{$ejecutivo['NUM_EMPRESAS_CORTE']}}																	
																		</td>	               		
																	</tr>

																	@endforeach
																	@endforeach
																	@endforeach
																	@endforeach															
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
																	@if(count($resumenAgrupado)>0)
																	@foreach($resumenAgrupado as $banca)
																	<tr class="filaBanca ">
																		<td class="elementoTabla"><strong>
																			{{$banca['NUM_EMPRESAS']}}&nbsp
																			@if($banca['NUM_EMPRESAS_CORTE']<$banca['NUM_EMPRESAS'])	
																			<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																			@elseif($banca['NUM_EMPRESAS_CORTE']>$banca['NUM_EMPRESAS'])
																			<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																			@else
																			<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																			@endif
																		</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['TOTAL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_MEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_GEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_BEP']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_BC']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_BPE']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$banca['CUENTA_MESA']}}</strong></td>	                	

																	</tr>
																	@foreach($banca['ZONALES'] as $zonal)
																	<tr class="filaZonal{{$zonal['BANCA']}} banca{{$banca['BANCA']}}  ">
																		<td class="elementoTabla"><strong>
																			{{$zonal['NUM_EMPRESAS']}}&nbsp
																			@if($zonal['NUM_EMPRESAS_CORTE']<$zonal['NUM_EMPRESAS'])	
																			<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																			@elseif($zonal['NUM_EMPRESAS_CORTE']>$zonal['NUM_EMPRESAS'])
																			<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																			@else
																			<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																			@endif
																		</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['TOTAL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_MEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_GEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_BEP']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_BC']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_BPE']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$zonal['CUENTA_MESA']}}</strong></td>	                	

																	</tr>
																	@foreach($zonal['JEFATURAS'] as $jefatura)
																	@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																	<tr class="filaJefatura{{$zonal['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}}  ">
																		<td class="elementoTabla"><strong>
																			{{$jefatura['NUM_EMPRESAS']}}&nbsp
																			@if($jefatura['NUM_EMPRESAS_CORTE']<$jefatura['NUM_EMPRESAS'])	
																			<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																			@elseif($jefatura['NUM_EMPRESAS_CORTE']>$jefatura['NUM_EMPRESAS'])
																			<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																			@else
																			<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																			@endif
																		</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['TOTAL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_MEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_GEL']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_BEP']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_BC']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_BPE']}}</strong></td>	                	
																		<td class="elementoTabla"><strong>{{$jefatura['CUENTA_MESA']}}</strong></td>	                	
																	</tr>
																	@endif
																	@foreach($jefatura['EJECUTIVOS'] as $ejecutivo)
																	@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																	<tr class="filaEjecutivo{{$ejecutivo['ID_JEFATURA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}} jefatura{{$jefatura['ID_JEFATURA']}} hidden">
																		@else
																		<tr class="filaJefatura{{$jefatura['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}}">
																			@endif																	
																			<td class="elementoTabla">
																				{{$ejecutivo['NUM_EMPRESAS']}}&nbsp
																				@if($ejecutivo['NUM_EMPRESAS_CORTE']<$ejecutivo['NUM_EMPRESAS'])	
																				<i class="fa fa-arrow-up" style="font-size: 12px;color: green"></i>
																				@elseif($ejecutivo['NUM_EMPRESAS_CORTE']>$ejecutivo['NUM_EMPRESAS'])
																				<i class="fa fa-arrow-down" style="font-size: 12px;color: red"></i>
																				@else
																				<i class="fa fa-minus" style="font-size: 12px;color:orange"></i>
																				@endif
																			</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['TOTAL']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_MEL']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_GEL']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_BEP']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_BC']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_BPE']}}</td>	                	
																			<td class="elementoTabla">{{$ejecutivo['CUENTA_MESA']}}</td>	                	

																		</tr>

																		@endforeach
																		@endforeach
																		@endforeach
																		@endforeach															
																		@endif															
																	</tbody>
																</table>

															</div>

															<!--<div class="col-md-3 col-sm-3 col-xs-3" id="tablaKPI">
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
																			<td class="elementoTabla"><strong>{{$totales->VOLUMEN_ECOSISTEMA}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$totales->VOLUMEN_REAL}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$totales->VOLUMEN_META}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$totales->PROV_TOTAL}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$totales->PROV_REAL}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$totales->PROV_META}}</strong></td>              

																		</tr>
																		@if(count($resumenAgrupado)>0)
																		@foreach($resumenAgrupado as $banca)
																		<tr class="filaBanca ">
																			<td class="elementoTabla"><strong>{{$banca['VOLUMEN_ECOSISTEMA']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$banca['VOLUMEN_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$banca['VOLUMEN_META']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$banca['PROV_TOTAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$banca['PROV_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$banca['PROV_META']}}</strong></td>             	

																		</tr>
																		@foreach($banca['ZONALES'] as $zonal)
																		<tr class="filaZonal{{$zonal['BANCA']}} banca{{$banca['BANCA']}}   ">
																			<td class="elementoTabla"><strong>{{$zonal['VOLUMEN_ECOSISTEMA']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$zonal['VOLUMEN_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$zonal['VOLUMEN_META']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$zonal['PROV_TOTAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$zonal['PROV_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$zonal['PROV_META']}}</strong></td>             	

																		</tr>
																		@foreach($zonal['JEFATURAS'] as $jefatura)
																		@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																		<tr class="filaJefatura{{$zonal['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}}  ">
																			<td class="elementoTabla"><strong>{{$jefatura['VOLUMEN_ECOSISTEMA']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$jefatura['VOLUMEN_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$jefatura['VOLUMEN_META']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$jefatura['PROV_TOTAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$jefatura['PROV_REAL']}}</strong></td>	                	
																			<td class="elementoTabla"><strong>{{$jefatura['PROV_META']}}</strong></td>             	

																		</tr>
																		@endif
																		@foreach($jefatura['EJECUTIVOS'] as $ejecutivo)
																		@if($jefatura['JEFATURA']!=$zonal['ZONAL'])
																		<tr class="filaEjecutivo{{$ejecutivo['ID_JEFATURA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}} jefatura{{$jefatura['ID_JEFATURA']}} hidden">
																			@else
																			<tr class="filaJefatura{{$jefatura['ID_ZONA']}} banca{{$banca['BANCA']}} zonal{{$zonal['ID_ZONA']}}">
																				@endif

																				<td class="elementoTabla">{{$ejecutivo['VOLUMEN_ECOSISTEMA']}}</td>	                	
																				<td class="elementoTabla">{{$ejecutivo['VOLUMEN_REAL']}}</td>	                	
																				<td class="elementoTabla">{{$ejecutivo['VOLUMEN_META']}}</td>	                	
																				<td class="elementoTabla">{{$ejecutivo['PROV_TOTAL']}}</td>	                	
																				<td class="elementoTabla">{{$ejecutivo['PROV_REAL']}}</td>	                	
																				<td class="elementoTabla">{{$ejecutivo['PROV_META']}}</td>             	

																			</tr>
																			@endforeach
																			@endforeach
																			@endforeach
																			@endforeach															
																			@endif	


																		</tbody>
																	</table>

																</div>-->

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
																<div class="chart-container" style="width: 40%">
																	<canvas id="canvas"></canvas>
																</div>												
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
															<table class="table table-striped table-bordered jambo_table display" id="tblStatusGestion" style="width: 100%">
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
						ajustarAltura();
						//Fumada para hacer el agrupamiento
						//Para desplegar lo inicial

						$('#clickTotales').val("1");
						$('#clickTotales').on("click", function () {							
							if( $('#clickTotales').val()=="0"){
								$('.filaBanca').removeClass('hidden');	
								$('#clickTotales').val("1");
								$('#clickTotales').find("i").removeClass('fa-chevron-down');
								$('#clickTotales').find("i").addClass('fa-chevron-up');								
							}
							else{
								$('.filaBanca').addClass('hidden');	
								$('#clickTotales').val("0");
								$('#clickTotales').find("i").removeClass('fa-chevron-up');
								$('#clickTotales').find("i").addClass('fa-chevron-down');

								//Oculta todos los de orden menor
								$('[class*=banca]').addClass('hidden');
								$('[class*=banca]').addClass('hidden');
							}
							ajustarAltura();
						});

						$("[id*=clickBanca]").val("1");
						$("[id*=clickBanca]").on("click", function () {		
							var idClick=$(this).attr('id');
							var banca=idClick.substring(10);

							if( $(this).val()=="0"){
								$('.filaZonal'+banca).removeClass('hidden');	
								$(this).val("1");	
								$(this).find("i").removeClass('fa-chevron-down');
								$(this).find("i").addClass('fa-chevron-up');
								
							}
							else{
								$('.filaZonal'+banca).addClass('hidden');	
								$(this).val("0");
								$(this).find("i").removeClass('fa-chevron-up');
								$(this).find("i").addClass('fa-chevron-down');
								$('[class*=banca'+banca+']').addClass('hidden');
								$('[class*=banca'+banca+']').addClass('hidden');
							}
							ajustarAltura();
						});


						$("[id*=clickZonal]").val("1");
						$("[id*=clickZonal]").on("click", function () {		
							var idClick=$(this).attr('id');
							var zonal=idClick.substring(10);

							if( $(this).val()=="0"){
								$('.filaJefatura'+zonal).removeClass('hidden');	
								$(this).val("1");	
								$(this).find("i").removeClass('fa-chevron-down');
								$(this).find("i").addClass('fa-chevron-up');
								
							}
							else{
								$('.filaJefatura'+zonal).addClass('hidden');	
								$(this).val("0");
								$(this).find("i").removeClass('fa-chevron-up');
								$(this).find("i").addClass('fa-chevron-down');

								//Oculta todos los de orden menor
								$('[class*=zonal'+zonal+']').addClass('hidden');
								$('[class*=zonal'+zonal+']').addClass('hidden');
							}
							ajustarAltura();
						});


						$("[id*=clickJefatura]").val("0");
						$("[id*=clickJefatura]").on("click", function () {		
							var idClick=$(this).attr('id');
							var jefatura=idClick.substring(13);

							if( $(this).val()=="0"){
								$('.filaEjecutivo'+jefatura).removeClass('hidden');	
								$(this).val("1");	
								$(this).find("i").removeClass('fa-chevron-down');
								$(this).find("i").addClass('fa-chevron-up');

							}
							else{
								$('.filaEjecutivo'+jefatura).addClass('hidden');	
								$(this).val("0");
								$(this).find("i").removeClass('fa-chevron-up');
								$(this).find("i").addClass('fa-chevron-down');

								//Oculta todos los de orden menor
								$('[class*=jefatura'+jefatura+']').addClass('hidden');
								$('[class*=jefatura'+jefatura+']').addClass('hidden');
							}
							ajustarAltura();
						});


						//Filtrado inicial cuando sea para todos
						if($('#cboBanca').val()==""){
							//Cerramos todo menos bancas
							$('[class*=filaEjecutivo]').addClass('hidden');	
							$("[id*=clickJefatura]").val("0");
							$("[id*=clickJefatura]").find("i").removeClass('fa-chevron-up');
							$("[id*=clickJefatura]").find("i").addClass('fa-chevron-down');

							$('[class*=filaJefatura]').addClass('hidden');	
							$("[id*=clickZonal]").val("0");
							$("[id*=clickZonal]").find("i").removeClass('fa-chevron-up');
							$("[id*=clickZonal]").find("i").addClass('fa-chevron-down');

							$('[class*=filaZonal]').addClass('hidden');	
							$("[id*=clickBanca]").val("0");
							$("[id*=clickBanca]").find("i").removeClass('fa-chevron-up');
							$("[id*=clickBanca]").find("i").addClass('fa-chevron-down');
							ajustarAltura();

						}


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


$('#example').DataTable( {
	initComplete: function () {
		this.api().columns().every( function () {
			var column = this;
			var select = $('<select><option value=""></option></select>')
			.appendTo( $(column.footer()).empty() )
			.on( 'change', function () {
				var val = $.fn.dataTable.util.escapeRegex(
					$(this).val()
					);

				column
				.search( val ? '^'+val+'$' : '', true, false )
				.draw();
			} );

			column.data().unique().sort().each( function ( d, j ) {
				select.append( '<option value="'+d+'">'+d+'</option>' )
			} );
		} );
	}
} );

function ajustarAltura(){
	var alturaMaxima= 4300;
	var filasOcultas=$('[class*=fila][class*=hidden]').length/3;
	var alturaMinima= alturaMaxima-filasOcultas*25;
	$('.right_col').css('min-height',  alturaMinima+'px');
	console.log(alturaMinima);
}

function cargarStatusGestion(banca,zonal,jefatura){
	datatable = $('#tblStatusGestion').DataTable({
		initComplete: function () {
			this.api().columns().every( function () {
				var column = this;
				var select = $('<select><option value=""></option></select>')
				.appendTo( $(column.footer()).empty() )
				.on( 'change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
						);

					column
					.search( val ? '^'+val+'$' : '', true, false )
					.draw();
				} );

				column.data().unique().sort().each( function ( d, j ) {
					select.append( '<option value="'+d+'">'+d+'</option>' )
				} );
			} );
		}, /*aqui*/
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

        /*** GRAFICOS ****/

        function cargaDataGraficos(banca,zonal,jefatura){

        	$.ajax({
        		type: "GET",
        		data: {
        			banca: banca,       		
        			zonal: zonal,           		
        			jefatura: jefatura          		
        		},
        		async:false,
        		url: APP_URL + 'ecosistema/seguimiento-ingresado/graficar',
        		success: function (result) {

        			var fechas=[];
        			var proveedores=[];
        			var empresas=[];
        			for (var i = 0; i < result.length; i++) {
        				fechas.push(result[i]['FECHA']);
        				proveedores.push(result[i]['NUM_PROVEEDORES']);
        				empresas.push(result[i]['NUM_EMPRESAS']);
        			}

        			Chart.defaults.global.elements.line.fill = false;

        			var barChartData = {
        				labels: fechas,
        				datasets: [{
        					type: 'line',
        					label: 'N° de proveedores referidos',
        					yAxisID: "ejeProveedores",
        					backgroundColor: window.chartColors.blue,
        					borderColor: window.chartColors.blue,
        					data: empresas
        				},{
        					type: 'bar',
        					label: 'N° de empresas',
        					yAxisID: "ejeEmpresas",
        					backgroundColor: "#75E492",
        					data: proveedores
        				}]
        			};


        			var ctx = document.getElementById("canvas");
					// allocate and initialize a chart
					var ch = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							tooltips: {
								mode: 'label'
							},
							responsive: true,
							scales: {
								yAxes: [{
									position: "right",
									id: "ejeEmpresas",
									ticks: {
										beginAtZero: true
									}
								}, {
									position: "left",
									id: "ejeProveedores",
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});


				}
			});



        }



    </script>
    @stop


