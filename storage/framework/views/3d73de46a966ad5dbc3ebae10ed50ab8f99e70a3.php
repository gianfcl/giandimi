<?php $__env->startSection('js-libs'); ?>

<link href="<?php echo e(URL::asset('css/pnotify.custom.min.css')); ?>" rel="stylesheet">

<script type="text/javascript" src="<?php echo e(URL::asset('js/pnotify.custom.min.js')); ?>"></script>

<!-- START SIGMA IMPORTS -->
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/sigma.core.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/conrad.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/utils/sigma.utils.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/utils/sigma.polyfills.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/sigma.settings.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.dispatcher.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.configurable.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.graph.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.camera.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.quad.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/classes/sigma.classes.edgequad.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/captors/sigma.captors.mouse.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/captors/sigma.captors.touch.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/sigma.renderers.canvas.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/sigma.renderers.webgl.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/sigma.renderers.svg.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/sigma.renderers.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/webgl/sigma.webgl.nodes.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/webgl/sigma.webgl.nodes.fast.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/webgl/sigma.webgl.edges.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/webgl/sigma.webgl.edges.fast.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/webgl/sigma.webgl.edges.arrow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.labels.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.hovers.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.nodes.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edges.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edges.curve.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edges.arrow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edges.curvedArrow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edgehovers.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edgehovers.curve.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edgehovers.arrow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.edgehovers.curvedArrow.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/canvas/sigma.canvas.extremities.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.utils.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.nodes.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.edges.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.edges.curve.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.labels.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/renderers/svg/sigma.svg.hovers.def.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/middlewares/sigma.middlewares.rescale.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/middlewares/sigma.middlewares.copy.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/misc/sigma.misc.animation.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/misc/sigma.misc.bindEvents.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/misc/sigma.misc.bindDOMEvents.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/src/misc/sigma.misc.drawHovers.js')); ?>"></script>
<!-- END SIGMA IMPORTS -->

<!-- NO OVERLAP -->
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/plugins/sigma.layout.noverlap/sigma.layout.noverlap.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/plugins/sigma.plugins.animate/sigma.plugins.animate.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/sigma.js-1.2.1/plugins/sigma.plugins.dragNodes/sigma.plugins.dragNodes.js')); ?>"></script>


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


* { box-sizing: border-box; }

.autocomplete {
	/*the container must be positioned relative:*/
	position: relative;
	display: inline-block;
}
input {
	border: 1px solid transparent;
	background-color: #f1f1f1;
	padding: 10px;
	font-size: 14px;
}
input[type=text] {
	background-color: #f1f1f1;
	width: 100%;
}
input[type=submit] {
	background-color: DodgerBlue;
	/*color: #fff;*/
}
.autocomplete-items {
	position: absolute;
	border: 1px solid #d4d4d4;
	border-bottom: none;
	border-top: none;
	z-index: 99;
	/*position the autocomplete items to be the same width as the container:*/
	top: 100%;
	left: 0;
	right: 0;
}
.autocomplete-items div {
	padding: 10px;
	cursor: pointer;
	background-color: #fff; 
	border-bottom: 1px solid #d4d4d4;   
}
.autocomplete-items div:hover {
	/*when hovering an item:*/
	background-color: #e9e9e9; 
}
.autocomplete-active {
	/*when navigating through the items using the arrow keys:*/
	background-color: DodgerBlue !important; 
	color: #ffffff; 
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pageTitle', 'Ecosistema'); ?>


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
				<div class="row clearfix">				
					<div class="form-group col-md-2 col-xs-6">
						<!--<label for="" class="control-label col-md-4">RUC: </label>-->
						<!--<div class="col-md-12">
							<input class="form-control formatInputNumber" style="font-size: 16px" type="text" value="" name="ruc" id="rucBuscar" placeholder="RUC">
						</div>-->
						<div class="autocomplete col-md-12" >
							<input class="formatInputNumber" type="text" value="" name="ruc" id="rucBuscar" placeholder="RUC">
						</div>
					</div>
					<div class="form-group col-md-2 col-xs-6">
						<!--<label for="" class="control-label col-md-4">Código Único: </label>-->
						<!--<div class="col-md-12">
							<input class="formatInputNumber" style="font-size: 16px" type="text" value="" name="cu" id="cuBuscar" placeholder="Código Único">
						</div>-->
						<div class="autocomplete col-md-12" >
							<input class="formatInputNumber" type="text" value="" name="cu" id="cuBuscar" placeholder="Código Único">
						</div>
					</div>
					<div class="form-group col-md-4 col-xs-12" >
						<!--<label for="" class="control-label col-md-4">Razón Social: </label>-->
						<!--<div class="col-md-12">
							<input class="form-control formatInputNumber" style="font-size: 16px" type="text" value="" name="razon" id="razonBuscar" placeholder="Razón Social">
						</div>-->
						<div class="autocomplete col-md-12">
							<input type="text" value="" name="razon" id="razonBuscar" placeholder="Razón Social">
						</div>
					</div>
					<div class="col-md-1 col-xs-6">
					</div>
					<div class="col-md-1 col-xs-6">
						<button class="btn btn-primary" style="font-size: 16px;margin-top: 5px;" type="button" id="btnBuscarEcosistema" ><i class="fa fa-search"></i> Buscar</button>						
						<!--<form class="form-horizontal" method="POST">
							<input style="margin-bottom: 0px;" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
							<button type="submit" class="btn btn-success">Prueba Email</button>
						</form>-->
					</div>
					<div class="col-md-2 col-xs-6">
						<a class="btn btn-success pText customButtonThin" style="font-size: 16px;margin-top: 5px;"  href="<?php echo e(URL::asset('herramientas/Macro_Ecosistema_Final.xlsm')); ?>" download="Macro_Ecosistema.xlsm"  style="padding-right: 5px; padding-left: 5px;color:white"><i class="fa fa-download"></i> Descargar Macro</a>              
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel hidden" style="min-height: 650px" id="panelGrafo">		

			<div class="x_content">
				<div id="leyendaGrafo" hidden>
					<div class="form-group">
						<label style="margin-top: 10px" class="control-label col-md-3">Leyenda: </label>
					</div><br><br>
					<div class="form-group">
						<div class="col-md-1" style="width: 50px;padding-right: 0px;">
							<i class="fa fa-circle" style="font-size: 40px;color:#92D050;"></i>
						</div>
						<label style="margin-top: 10px" class="control-label col-md-11">Cliente IBK</label>
					</div><br><br>
					<div class="form-group">
						<div class="col-md-1" style="width: 50px;padding-right: 0px;">
							<i class="fa fa-circle" style="font-size: 40px;color:#FFD966;"></i>
						</div>
						<label style="margin-top: 10px" class="control-label col-md-11">No Cliente IBK</label>
					</div><br><br>
					<div class="form-group">
						<div class="col-md-1" style="width: 50px;padding-right: 0px;">
							<img src = "<?php echo e(URL::asset('img/click.gif')); ?>" style="width: 40px;height: 40px">
						</div>
						<label style="margin-top: 10px" class="control-label col-md-11">Detalle</label>
					</div>					
				</div>
				<div id="container">
					<style>
					#graph-container {
						top: 0;
						bottom: 0;
						left: 0;
						right: 0;
						position: absolute;
					}

				</style>
				<div id="graph-container" style="min-height: 620px;">
					<div id="noEncontrado" hidden>
						<center>
							<h3 style="color:#8CD4F5">No se encontraron resultados <i class="fa fa-sitemap"></i> </h3>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel hidden" style="min-height: 650px" id="panelEmpresa">
		<div class="x_title">
			<div class="col-md-12">
				<h4 id="nombreEmpresa">Información</h4>	
			</div>
			<div class="col-md-12">
				<p style="margin-bottom: 0px;">*Montos expresados en miles</p>
			</div>		
			<ul class="nav navbar-right panel_toolbox"></ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_title">	
			<ul class="nav navbar-right panel_toolbox"></ul>
			<div class="clearfix" id="clearfixInfoPrincipal"></div>
		</div>
		<div class="x_title">
			<ul class="nav navbar-right panel_toolbox"></ul>
			<div class="clearfix" id="clearfixInfoDeuda"></div>
		</div>
		<!--<div class="x_title">
			<ul class="nav navbar-right panel_toolbox"></ul>
			<div class="clearfix" id="clearfixCashInOut"></div>
		</div>-->
		<div class="x_title">
			<ul class="nav navbar-right panel_toolbox"></ul>
			<div class="clearfix" id="clearfixAsignacionEcosistema"></div>
		</div>
		<div class="x_content">
			<div id="informacionEmpresa">

			</div>
		</div>
	</div>
</div>
</div>


<div class="modalCargando"><!-- Place at bottom of page --></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js-scripts'); ?>
<script>

	$(document).ready(function () {

		var empresasAutocomplete;
		obtenerEmpresasEcosistema(empresasAutocomplete);		

		$('#btnBuscarEcosistema').on("click", function (e) {

			buscarClick();
			console.log("BUSCADOR");
		});

		

		$('#rucBuscar').keypress(function (e) {
            //enter
            if (e.which == 13) {
            	$('.modalCargando').css('display','block');
            	console.log("RUC");
            	$("#graph-container").find( "canvas" ).remove();
            	$("#noEncontrado").attr('hidden','true');
            	$("#leyendaGrafo").attr('hidden','true');
            	var rucBuscar=$('#rucBuscar').val().trim();
            	construirGrafo(rucBuscar);
            }
        });

		$('#cuBuscar').keypress(function (e) {
            //enter
            if (e.which == 13) {
            	$('.modalCargando').css('display','block');
            	console.log("CU");
            	$("#graph-container").find( "canvas" ).remove();
            	$("#noEncontrado").attr('hidden','true');
            	$("#leyendaGrafo").attr('hidden','true');
            	var rucBuscar=$('#rucBuscar').val().trim();
            	var cuBuscar=$('#cuBuscar').val().trim();
            	var razonBuscar=$('#razonBuscar').val().trim();
            	//Debemos de buscar el ruc
            	if (rucBuscar==''){
            		buscarRucCuRazon(cuBuscar,razonBuscar);				
            		rucBuscar=$('#rucBuscar').val().trim();
            	}

            	$('#rucBuscar').val(rucBuscar);
            	$('#cuBuscar').val(cuBuscar);
            	$('#razonBuscar').val(razonBuscar);
            	construirGrafo(rucBuscar);
            }
        });

		$('#razonBuscar').keypress(function (e) {
            //enter
            if (e.which == 13) {
            	$('.modalCargando').css('display','block');
            	console.log("RAZON");
            	$("#graph-container").find( "canvas" ).remove();
            	$("#noEncontrado").attr('hidden','true');
            	$("#leyendaGrafo").attr('hidden','true');
            	var rucBuscar=$('#rucBuscar').val().trim();
            	var cuBuscar=$('#cuBuscar').val().trim();
            	var razonBuscar=$('#razonBuscar').val().trim();
            	//Debemos de buscar el ruc
            	if (rucBuscar==''){
            		buscarRucCuRazon(cuBuscar,razonBuscar);				
            		rucBuscar=$('#rucBuscar').val().trim();
            	}

            	$('#rucBuscar').val(rucBuscar);
            	$('#cuBuscar').val(cuBuscar);
            	$('#razonBuscar').val(razonBuscar);
            	construirGrafo(rucBuscar);
            }
        });


		
	});
	
	function buscarClick(){
			$('.modalCargando').css('display','block');
			$("#graph-container").find( "canvas" ).remove();
			$("#noEncontrado").attr('hidden','true');
			$("#leyendaGrafo").attr('hidden','true');

			var rucBuscar=$('#rucBuscar').val().trim();
			var cuBuscar=$('#cuBuscar').val().trim();
			var razonBuscar=$('#razonBuscar').val().trim();


			//Debemos de buscar el ruc
			if (rucBuscar==''){
				buscarRucCuRazon(cuBuscar,razonBuscar);				
				rucBuscar=$('#rucBuscar').val().trim();
			}
			
			$('#rucBuscar').val(rucBuscar);
			$('#cuBuscar').val(cuBuscar);
			$('#razonBuscar').val(razonBuscar);
			construirGrafo(rucBuscar);
	}

	function buscarRucCuRazon(cuBuscar,razonBuscar){
		
		$.ajax({
			type: "GET",
			url: APP_URL + 'ecosistema/buscar-ruc',
			async: false,  
			data:{
				cuBuscar:cuBuscar,
				razonBuscar:razonBuscar,
			},
			success: function (result) {
				$('#rucBuscar').val(result);
				//$('.modalCargando').css('display','none');
			}

		});
	}

	function obtenerEmpresasEcosistema(empresasAutocomplete){
		$.ajax({
			type: "GET",
			url: APP_URL + 'ecosistema/obtener-empresas',			
			async: false,  
			success: function (result) {				
				empresasAutocomplete=result;
				console.log(empresasAutocomplete);
				autocomplete(document.getElementById("razonBuscar"), empresasAutocomplete);
			}
		});
	}

	function filtroGrafo(N,result,rucBuscar){
		var arrayFiltro=[];
		for (i = 0; i < N; i++){
			if(result[i]['RUC']==rucBuscar){
				arrayFiltro.push(result[i]['RUC']);
				nombreEmpresa=result[i]['NOMBRE'];
				var adyacentes=result[i]['ADYACENTES'];
				for (j=0;j<adyacentes.length;j++){
					arrayFiltro.push(adyacentes[j]['RUC']);
				}
				break;
			}
		}
		var busqueda=[];
		busqueda.push(arrayFiltro);
		busqueda.push(nombreEmpresa);
		return busqueda;
	}

	function obtenerCoordenadas(radio){
		var coord=[];
		var angulo=Math.random();
		var x=Math.cos(angulo*2*Math.PI)*radio;
		var y=Math.sin(angulo*2*Math.PI)*radio;

		coord.push(x);
		coord.push(y);
		return coord;
	}

	function construirGrafo(rucBuscar){
		$.ajax({
			type: "GET",
			url: APP_URL + 'ecosistema/obtener',
			success: function (result) {
				if (rucBuscar==''){
					rucBuscar=$('#rucBuscar').val().trim();
				}
				var i,s,N = result.length;
				var g = {
					nodes: [],
					edges: []
				};	
				var longitudMaxima=30;

				$('#panelGrafo').removeClass('hidden');
				var busqueda=filtroGrafo(N,result,rucBuscar);
				var arrayFiltro=busqueda[0];
				var nombreEmpresa=busqueda[1];

				getInfoNodo(rucBuscar,nombreEmpresa);
				if(arrayFiltro.length==0){
					$("#noEncontrado").removeAttr('hidden');
					$("#leyendaGrafo").attr('hidden','true');
				}
				else{					
					$("#leyendaGrafo").removeAttr('hidden');
					$('#rucBuscar').val('');
					$('#cuBuscar').val('');
					$('#razonBuscar').val('');
					// Dibujamos los nodos principales
					for (i = 0; i < N; i++){			
						//Buscamos si se encuentra en la relación principal
						if (arrayFiltro.indexOf(result[i]['RUC'])!=-1){
							var coord=obtenerCoordenadas(0.4);
							
							//Determinamos el color
							$color='';
							if(result[i]['RUC']==rucBuscar)
								$color='#043DAF';
							else if (result[i]['FLAG_DIFERENCIADOR']==0)
								$color='#FFD966';
							else 
								$color='#92D050';

							if(result[i]['NOMBRE'].length>=longitudMaxima)
								result[i]['NOMBRE']=result[i]['NOMBRE'].substring(0, longitudMaxima)+'...';
							
							var nodoPrincipal={
								id: 'n'+result[i]['RUC'],
								label: result[i]['NOMBRE'],
								x: result[i]['RUC']==rucBuscar?0:coord[0],
								y: result[i]['RUC']==rucBuscar?0:coord[1],
								size: result[i]['RUC']==rucBuscar?1:0.5,
								color: $color,
							};

							g.nodes.push(nodoPrincipal);
						}
					}

					
					//Dibujamos los adyacentes de cada principal
					for (i = 0; i < N; i++){
						if (arrayFiltro.indexOf(result[i]['RUC'])!=-1) {

							//Buscaré la posición de los principales
							var rucPosicion= result[i]['RUC'];
							for(a=0;a<g.nodes.length;a++){
								if(g.nodes[a]['id']==('n'+rucPosicion)){
									xPosicion=g.nodes[a]['x'];
									yPosicion=g.nodes[a]['y'];
									break;
								}
							}


							//Si lo encuentro
							var adyacentes=result[i]['ADYACENTES'];				
							for(j=0;j<adyacentes.length;j++){
								encontrado=false;
								for(a=0;a<g.nodes.length;a++){
									if(g.nodes[a]['id']==('n'+adyacentes[j]['RUC'])){
										encontrado=true;
										break;
									}
								}
								if(!encontrado){
									var coord=obtenerCoordenadas(0.2);
									//Determinamos el color
									$color='';
									if (adyacentes[j]['FLAG_DIFERENCIADOR']==0)
										$color='#FFD966';
									else 
										$color='#92D050';

									if(adyacentes[j]['NOMBRE'].length>=longitudMaxima)
										adyacentes[j]['NOMBRE']=adyacentes[j]['NOMBRE'].substring(0, longitudMaxima)+'...';									

									g.nodes.push({
										id: 'n'+adyacentes[j]['RUC'],
										label: adyacentes[j]['NOMBRE'],
										x: coord[0]+xPosicion,
										y: coord[1]+yPosicion,
										size: 0.5,
										color: $color,
									});
								}

							}
						}
					}

					var edges=0;
					for (i = 0; i < N; i++){
						if (arrayFiltro.indexOf(result[i]['RUC'])!=-1){ //Si lo encuentro
							var idPrincipal='n'+result[i]['RUC'];
							var adyacentes=result[i]['ADYACENTES'];

							for(j=0;j<adyacentes.length;j++){
								if(adyacentes[j]['TIPO']=='C'){
									g.edges.push({
										id: 'e' + edges,
										source: 'n' +adyacentes[j]['RUC'],
										target: idPrincipal,
										type:'arrow',
										size: Math.random(),
										color: '#AFAFAF'
									});
								}
								else{
									g.edges.push({
										id: 'e' + edges,
										source: idPrincipal,
										target: 'n' +adyacentes[j]['RUC'],
										type:'arrow',
										size: Math.random(),
										color: '#AFAFAF'
									});
								}
								edges=edges+1;
							}
						}
					}

					// Instantiate sigma:
					s = new sigma({
						graph: g,
						container: 'graph-container',
						settings: {
							minNodeSize: 15,
							maxNodeSize: 30,
							minEdgeSize: 4,
							maxEdgeSize: 4,
							doubleClickEnabled: false,
						}
					});


					// Initialize the dragNodes plugin:
					var dragListener = sigma.plugins.dragNodes(s, s.renderers[0]);
					var entroDrag=false;
					var click=0;
					var rucClick='';
					
					dragListener.bind('startdrag', function(event) {
						console.log(event);
					});
					dragListener.bind('drag', function(event) {
						entroDrag=true;
					});
					dragListener.bind('drop', function(event) {

					});
					dragListener.bind('dragend', function(event) {
						var rucNodo=event.data.node.id.substring(1,100);
						var nombreNodo=event.data.node.label;
						
						if(rucClick!=rucNodo){
							click=0;
							rucClick=rucNodo;
						}

						if(!entroDrag){
							getInfoNodo(rucNodo,nombreNodo);

							if(click>0){
								$("#graph-container").find( "canvas" ).remove();
								$("#noEncontrado").attr('hidden','true');
								$("#leyendaGrafo").attr('hidden','true');
								var rucBuscar=rucNodo;
								construirGrafo(rucBuscar);
								click=0;
							}
							click+=1;
						}
						entroDrag=false;
					});

					// Configure the noverlap layout:
					var noverlapListener = s.configNoverlap({
						nodeMargin: 0.1,
						scaleNodes: 1.05,
						gridSize: 75,
					  easing: 'quadraticInOut', // animation transition function
					  duration: 10000   // animation duration. Long here for the purposes of this example only
					});
					// Bind the events:
					noverlapListener.bind('start stop interpolate', function(e) {
						console.log(e.type);
						if(e.type === 'start') {
							console.time('noverlap');
						}
						if(e.type === 'interpolate') {
							console.timeEnd('noverlap');
						}
					});
					// Start the layout:
					s.startNoverlap();

				}
			}
		});
}

function formatoComas(x) {
	if(x!='-')
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	else return x;
}

function getInfoNodo(rucNodo,nombreNodo){
	$('.modalCargando').css('display','block');
	var infoNodo='No se encontró información';
	$.ajax({
		type: "GET",
		url: APP_URL + 'ecosistema/obtener-nodo',
		data:{
			rucNodo:rucNodo,
		},
		success: function (result) {
			console.log(result);
			$('#clearfixInfoDeuda').find('div').remove();
			//$('#clearfixCashInOut').find('div').remove();
			$('#clearfixAsignacionEcosistema').find('div').remove();
			$('#informacionEmpresa').find('div').remove();
			$('#clearfixInfoPrincipal').find('div').remove();
			
			if (result.length>0){
				var info=result[0];
				$('#panelEmpresa').removeClass('hidden');
				$("#nombreEmpresa").text(info['NOMBRE']);				
				$('#clearfixInfoPrincipal').append('<div class="col-md-12"><label class="control-label col-md-3 col-sm-3 col-xs-2">Sectorista: </label><p class="control-label col-md-9 col-sm-9 col-xs-10" style="padding-left: 5px;">'+info['SECTORISTA']+'</p></div>');

				html='<div class="col-md-6 col-sm-12">';
				html+='<label class="control-label col-md-6 ">Documento: </label><p class="control-label col-md-6">'+info['NUM_DOC']+'</p>';
				html+='<label class="control-label col-md-6 ">Código Único: </label><p class="control-label col-md-6">'+info['CODUNICOCLI']+'</p>';
				html+='</div>';
				html+='<div class="col-md-6 col-sm-12">';
				html+='<label class="control-label col-md-6 ">Banca:</label><p class="control-label col-md-6">'+info['BANCA']+'</p>';
				html+='<label class="control-label col-md-6 ">Facturación(*): </label><p class="control-label col-md-6">'+'S/ '+formatoComas(info['FACTURACION'])+'</p>';
				html+='</div>';
				$('#clearfixInfoPrincipal').append(html);

				html='<div class="col-md-6 col-sm-12">';
				html+='<label class="control-label col-md-7 ">Deuda SSFF(*): </label><p class="control-label col-md-5">'+'S/ '+formatoComas(info['COL_DIRECTAS'])+'</p>';
				html+='<label class="control-label col-md-7 ">Deuda IBK(*): </label><p class="control-label col-md-5">'+'S/ '+formatoComas(info['DEUDA_IBK'])+'</p>';
				html+='<label class="control-label col-md-7 ">Pago a proveedores(*): </label><p class="control-label col-md-5">'+'S/ '+formatoComas(info['PAGO_PROVEEDORES'])+'</p>';
				html+='<label class="control-label col-md-7 ">Banco Principal: </label><p class="control-label col-md-5">'+info['BANCO_PRINCIPAL']+'</p>';
				html+='<label class="control-label col-md-7 ">Calif. SBS: </label><p class="control-label col-md-5">'+info['CALIFICACION_SBS']+'</p>';
				html+='</div>';

				html+='<div class="col-md-6 col-sm-12">';
				html+='<label class="control-label col-md-7 ">¿Cliente Activo?: </label><p class="control-label col-md-5">'+info['CLIENTE_ACTIVO_IBK']+'</p>';
				html+='<label class="control-label col-md-7 ">¿Cuenta IBK?: </label><p class="control-label col-md-5">'+info['TIENE_CUENTA_IBK']+'</p>';
				html+='<label class="control-label col-md-7 ">FEVE: </label><p class="control-label col-md-5">'+info['FEVE']+'</p>';
				html+='<label class="control-label col-md-7 ">Nivel TIE: </label><p class="control-label col-md-5">'+info['NIVEL_TIE']+'</p>';
				html+='</div>';
				
				$('#clearfixInfoDeuda').append(html);

				
				var antesLabel='<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-6">';
				var despuesLabel='</label> <p class="control-label col-md-9 col-sm-9 col-xs-6">';
				var despuesValue='</p></div>';
				
				if(info['FECHA_ECOSISTEMA']==null)
					info['FECHA_ECOSISTEMA']='-';
				if(info['FECHA_ETAPA']==null)
					info['FECHA_ETAPA']='-';

				html='<div class="col-md-12">';
				html+='<label class="control-label" style="text-decoration:underline">¿Quién está gestionando mi Ecosistema?</label>';
				html+=antesLabel+'Reponsable: '+despuesLabel+info['RESPONSABLE_ECOSISTEMA']+despuesValue;
				html+=antesLabel+'Fecha: '+despuesLabel+info['FECHA_ECOSISTEMA']+despuesValue;
				html+='</div>';
				$('#clearfixAsignacionEcosistema').append(html);

				html='<div class="col-md-12">';
				html+='<label class="control-label" style="text-decoration:underline">¿Cuál fue la última gestión?</label>';
				if (info['ETAPA']!='NO ASIGNADO'){
					html+=antesLabel+'Responsable: '+despuesLabel+info['RESPONSABLE_GESTION']+despuesValue;
					html+=antesLabel+'Fecha: '+despuesLabel+info['FECHA_ETAPA']+despuesValue;
				}
				html+=antesLabel+'Etapa: '+despuesLabel+info['ETAPA']+despuesValue;
				if (info['ETAPA']=='ELIMINADO'){
					html+=antesLabel+'Detalle: '+despuesLabel+info['MOTIVO']+' - '+info['DETALLE']+despuesValue;
				}
				html+='</div>';
				$('#informacionEmpresa').append(html);	

			}
			else{
				$("#nombreEmpresa").text("No se encontró información");		
				$('#panelEmpresa').addClass('hidden');
			}
			$('.modalCargando').css('display','none');
		}
	});


}

/*Funciones de autocompletado*/
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
  	var a, b, i, val = this.value;
  	/*close any already open lists of autocompleted values*/
  	closeAllLists();
  	if (!val) { return false;}
  	currentFocus = -1;
  	/*create a DIV element that will contain the items (values):*/
  	a = document.createElement("DIV");
  	a.setAttribute("id", this.id + "autocomplete-list");      
  	a.setAttribute("class", "autocomplete-items");
  	/*append the DIV element as a child of the autocomplete container:*/
  	this.parentNode.appendChild(a);
  	/*for each item in the array...*/

  	//Coincidencia de n caracteres
  	var nCar=3;
  	if(val.length>=nCar){
  		for (i = 0; i < arr.length; i++) {
  			/*check if the item starts with the same letters as the text field value:*/
  			if (
        	//arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()
        	arr[i].toUpperCase().indexOf(val.toUpperCase()) > -1
        	) {
  				//La primera coincidencia del elemento
        		var posicion=arr[i].toUpperCase().indexOf(val.toUpperCase());


  				/*create a DIV element for each matching element:*/
  			b = document.createElement("DIV");
  			/*make the matching letters bold:*/
          //b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          //b.innerHTML = arr[i].substr(0, val.length);
          b.innerHTML = arr[i].substr(0, posicion).toUpperCase();
          b.innerHTML += '<strong>' + arr[i].substr(posicion, val.length).toUpperCase() + "</strong>";
          b.innerHTML += arr[i].substr(posicion+val.length).toUpperCase();
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
          	/*insert the value for the autocomplete text field:*/
          	inp.value = this.getElementsByTagName("input")[0].value;
          	console.log("CLICK RAZON");
          		
          		buscarClick();
          		
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
      }
  }
}
});
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
  	var x = document.getElementById(this.id + "autocomplete-list");
  	if (x) x = x.getElementsByTagName("div");
  	if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
    } else if (e.keyCode == 13) {
    	/*If the ENTER key is pressed, prevent the form from being submitted,*/
    	e.preventDefault();
    	if (currentFocus > -1) {
    		/*and simulate a click on the "active" item:*/
    		if (x) x[currentFocus].click();
    	}
    }
});
  function addActive(x) {
  	/*a function to classify an item as "active":*/
  	if (!x) return false;
  	/*start by removing the "active" class on all items:*/
  	removeActive(x);
  	if (currentFocus >= x.length) currentFocus = 0;
  	if (currentFocus < 0) currentFocus = (x.length - 1);
  	/*add class "autocomplete-active":*/
  	x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
  	/*a function to remove the "active" class from all autocomplete items:*/
  	for (var i = 0; i < x.length; i++) {
  		x[i].classList.remove("autocomplete-active");
  	}
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
    	if (elmnt != x[i] && elmnt != inp) {
    		x[i].parentNode.removeChild(x[i]);
    	}
    }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
	closeAllLists(e.target);
});
}
</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>