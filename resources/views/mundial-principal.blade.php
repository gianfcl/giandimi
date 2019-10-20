<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">

  <title>¡La VPConnect Vive el Mundial!</title>

  <!-- Fonts 
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  -->
  
  <!-- CSS-->
  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  

  <!--JS-->
  <script type="text/javascript"  src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>       
  <script type="text/javascript" src="{{ URL::asset('js/impl.js') }}"></script>
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
      <script src="{{ URL::asset('js/respond.min.js') }}"></script>

  <![endif]-->
 	
  @yield('js-libs')

	<style>		
		@font-face {
      font-family: 'dusha';
      src: url('<?php echo config('app.url'); ?>fonts/dusha.woff2') format('woff2'), /* Super Modern Browsers */
           url('<?php echo config('app.url'); ?>fonts/dusha.woff') format('woff'); /* Pretty Modern Browsers */ 
    } 

    body {
	    font-family: 'dusha', Fallback, sans-serif;
	    min-height: 2000px;
    	padding-top: 70px;
    }


	.navbar {
		background-image: url("https://www.fifa.com/assets/img/tournaments/17/2018/common/fwc_darkbluebg.png");
		background-repeat: repeat;
		background-color: #0f4583;
	}

	th{
				background-color: #0f4583;
				font-size: 24px;
				color:white;
	}

	td{
			background-color: #FFFFFF;
			font-size: 16px;
	}


	</style>
  <script>
    
  </script>
</head>

<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
	$modoInteligencia = in_array(Auth::user()->ROL,[666]) ;

	
?>

<body class="nav-md">
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <h1 class='col-md-10 col-sm-10 col-xs-10' style="line-height: .8; font-size: 32px; color: #fff;">Polla Mundial Rusia 2018</h1>
        @if(!$modoInteligencia)
	        <form method="post" action="{{ route('login.attempt') }}" >
	          <input title="Regresar a la VPConnect" type=image src = "{{ URL::asset('img/vpconnect_white_Mundial.png') }}" style="width: 15%; margin-left: 0px;" />
	        </form>
        @else
	        <form action="{{ route('logout') }}" >
	          <input title="Cerrar sesión" type=image src = "{{ URL::asset('img/vpconnect_white_Mundial.png') }}" style="width: 15%; margin-left: 0px;" />
	        </form>
        @endif
        <h1 class='col-md-9 col-sm-9 col-xs-9' style="line-height: .8; font-size: 20px; color: #fff;">{{$puesto->NOMBRE}}</h1>        
        <h1 style="line-height: .8; font-size: 20px; color: #fff; text-align: left;">Mi Puntaje: {{$puesto->PUNTOS}}<br><a class="lnkRanking" href="" ranking={{$ranking}} style="color: #fff;text-decoration: underline;">Mi Puesto:</a> {{$puesto->PUESTO_BANCA}}

        </h1>


    </nav>
    <br>
    <br>
    <br>


    <div class="container" style="padding-top: 20px">
    	<div class="alert alert-warning" role="alert" style="font-size: 18px;"> <strong>Atención!</strong> Recuerda ingresar tus resultados del día <strong>sábado y domingo</strong> ya que la VPConnect solo está disponible dentro de la red de Interbank.</div>

    	<div style="float: right;"><span class ="lnkRanking" style="color: #000; font-size: 20px; text-decoration: underline; cursor: pointer;">Ranking</span></div>
    	<!--
    	<div style="float: left;"><span style="color: #000; font-size: 20px; text-decoration: underline; cursor: pointer;""> Ver días anteriores</span></div>
    	!-->
    	<div class="clearfix"></div>

    	@include('flash::message')
    	<h1>Fase de Grupos
    		<div class="pull-right">
		    	<span class="glyphicon glyphicon-chevron-down" id="i-grupos-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
			</div>
		</h1>    	

		<div class="row" id="partidos-grupos" style="" hidden>
		@foreach ($grupos as $key => $partidos)
		<div style="margin-bottom: 35px;">
			<h1 class="fecha">{{$key}}</h1>
			<form id="formFecha" method="POST" action="{{route('mundial.insertar')}}">
		        <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;" width="20%">Local</th>                	
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>		                	
							<th style="text-align: center;" width="20%">Visitante</th>                      
							<th style="text-align: center;" width="10%">Hora</th>                                         
							<th style="text-align: center;" width="10%">Marcador</th>                     
		                	<th style="text-align: center;" width="10%">Puntos</th>		                	
		                </tr>
		            </thead>
		            <tbody>
	        			@foreach ($partidos as $partido)
		                  @if($partido->DIF_FECHA>=0)
		                      <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}">
		                  @else
		  	        			    <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}" disabled>
		                  @endif
	        			<tr>
	        				<td style="text-align: center;">
	        					{{$partido->NOMBRE_LOCAL}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENL;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: bottom;">
	                    		@if($partido->DIF_FECHA>=0)
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}">
	                    		@else
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}" disabled>
	                    		@endif
	                    		<br>
                  			</td>

                  			<td style="text-align: center; vertical-align: bottom;">vs</td>

							<td style="text-align: center; vertical-align: bottom;">
							@if($partido->DIF_FECHA>=0)
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}">
							@else
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}" disabled>
							@endif
							<br>
							</td>

	        				<td style="text-align: center; ">
	        					{{$partido->NOMBRE_VISITA}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENV;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: middle;">
	        					{{$partido->HORA_CAD}}<br>		            					
	        				</td>

							@if(!($partido->DIF_FECHA>=0))
							<td style="text-align: center;vertical-align: middle; color:green">{{$partido->LOCAL_REAL}} - {{$partido->VISITANTE_REAL}}</td>

							<td style="text-align: center; vertical-align: middle; color:green">{{$partido->PUNTOS}}</td>
							@else
							<td style="text-align: center; vertical-align: middle; color:green">- - -</td>
							<td style="text-align: center; vertical-align: middle; color:green">Pendiente</td>
							@endif
	        			</tr>
	        			@endforeach
		        	</tbody>
		    	</table>
				<button type="format" class="btn btn-success btnGuardar" style="float: right"> Guardar</button>
				<div class="clearfix"></div>
			</form>
		</div>
		@endforeach
	</div>

	    <h1>Octavos de final
    		<div class="pull-right">
		    	<span class="glyphicon glyphicon-chevron-down" id="i-octavos-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
			</div>
		</h1>    	

		<div class="row" id="partidos-octavos" style="" hidden>
		@foreach ($octavos as $key => $partidos)
		<div style="margin-bottom: 35px;">
			<h1 class="fecha">{{$key}}</h1>
			<form id="formFecha" method="POST" action="{{route('mundial.insertar')}}">
		        <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;" width="20%">Local</th>                	
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>		                	
							<th style="text-align: center;" width="20%">Visitante</th>                      
							<th style="text-align: center;" width="10%">Hora</th>                                         
							<th style="text-align: center;" width="10%">Marcador</th>                     
		                	<th style="text-align: center;" width="10%">Puntos</th>		                	
		                </tr>
		            </thead>
		            <tbody>
	        			@foreach ($partidos as $partido)
		                  @if($partido->DIF_FECHA>=0)
		                      <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}">
		                  @else
		  	        			    <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}" disabled>
		                  @endif
	        			<tr>
	        				<td style="text-align: center;">
	        					{{$partido->NOMBRE_LOCAL}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENL;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: bottom;">
	                    		@if($partido->DIF_FECHA>=0)
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}">
	                    		@else
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}" disabled>
	                    		@endif
	                    		<br>
                  			</td>

                  			<td style="text-align: center; vertical-align: bottom;">vs</td>

							<td style="text-align: center; vertical-align: bottom;">
							@if($partido->DIF_FECHA>=0)
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}">
							@else
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}" disabled>
							@endif
							<br>
							</td>

	        				<td style="text-align: center; ">
	        					{{$partido->NOMBRE_VISITA}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENV;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: middle;">
	        					{{$partido->HORA_CAD}}<br>		            					
	        				</td>

							@if(!($partido->DIF_FECHA>=0))
							<td style="text-align: center;vertical-align: middle; color:green">{{$partido->LOCAL_REAL}} - {{$partido->VISITANTE_REAL}}</td>

							<td style="text-align: center; vertical-align: middle; color:green">{{$partido->PUNTOS}}</td>
							@else
							<td style="text-align: center; vertical-align: middle; color:green">- - -</td>
							<td style="text-align: center; vertical-align: middle; color:green">Pendiente</td>
							@endif
	        			</tr>
	        			@endforeach
		        	</tbody>
		    	</table>
				<button type="format" class="btn btn-success btnGuardar" style="float: right"> Guardar</button>
				<div class="clearfix"></div>
			</form>
		</div>
		@endforeach
	</div>

		    <h1>Cuartos de final
    		<div class="pull-right">
		    	<span class="glyphicon glyphicon-chevron-down" id="i-cuartos-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
			</div>
		</h1>    	

		<div class="row" id="partidos-cuartos" style="" hidden>
		@foreach ($cuartos as $key => $partidos)
		<div style="margin-bottom: 35px;">
			<h1 class="fecha">{{$key}}</h1>
			<form id="formFecha" method="POST" action="{{route('mundial.insertar')}}">
		        <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;" width="20%">Local</th>                	
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>		                	
							<th style="text-align: center;" width="20%">Visitante</th>                      
							<th style="text-align: center;" width="10%">Hora</th>                                         
							<th style="text-align: center;" width="10%">Marcador</th>                     
		                	<th style="text-align: center;" width="10%">Puntos</th>		                	
		                </tr>
		            </thead>
		            <tbody>
	        			@foreach ($partidos as $partido)
		                  @if($partido->DIF_FECHA>=0)
		                      <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}">
		                  @else
		  	        			    <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}" disabled>
		                  @endif
	        			<tr>
	        				<td style="text-align: center;">
	        					{{$partido->NOMBRE_LOCAL}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENL;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: bottom;">
	                    		@if($partido->DIF_FECHA>=0)
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}">
	                    		@else
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}" disabled>
	                    		@endif
	                    		<br>
                  			</td>

                  			<td style="text-align: center; vertical-align: bottom;">vs</td>

							<td style="text-align: center; vertical-align: bottom;">
							@if($partido->DIF_FECHA>=0)
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}">
							@else
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}" disabled>
							@endif
							<br>
							</td>

	        				<td style="text-align: center; ">
	        					{{$partido->NOMBRE_VISITA}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENV;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: middle;">
	        					{{$partido->HORA_CAD}}<br>		            					
	        				</td>

							@if(!($partido->DIF_FECHA>=0))
							<td style="text-align: center;vertical-align: middle; color:green">{{$partido->LOCAL_REAL}} - {{$partido->VISITANTE_REAL}}</td>

							<td style="text-align: center; vertical-align: middle; color:green">{{$partido->PUNTOS}}</td>
							@else
							<td style="text-align: center; vertical-align: middle; color:green">- - -</td>
							<td style="text-align: center; vertical-align: middle; color:green">Pendiente</td>
							@endif
	        			</tr>
	        			@endforeach
		        	</tbody>
		    	</table>
				<button type="format" class="btn btn-success btnGuardar" style="float: right"> Guardar</button>
				<div class="clearfix"></div>
			</form>
		</div>
		@endforeach
	</div>

	<h1>Semifinales
    		<div class="pull-right">
		    	<span class="glyphicon glyphicon-chevron-up" id="i-semis-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
			</div>
		</h1>    	

		<div class="row" id="partidos-semis" style="">
		@foreach ($semis as $key => $partidos)
		<div style="margin-bottom: 35px;">
			<h1 class="fecha">{{$key}}</h1>
			<form id="formFecha" method="POST" action="{{route('mundial.insertar')}}">
		        <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;" width="20%">Local</th>                	
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>		                	
							<th style="text-align: center;" width="20%">Visitante</th>                      
							<th style="text-align: center;" width="10%">Hora</th>                                         
							<th style="text-align: center;" width="10%">Marcador</th>                     
		                	<th style="text-align: center;" width="10%">Puntos</th>		                	
		                </tr>
		            </thead>
		            <tbody>
	        			@foreach ($partidos as $partido)
		                  @if($partido->DIF_FECHA>=0)
		                      <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}">
		                  @else
		  	        			    <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}" disabled>
		                  @endif
	        			<tr>
	        				<td style="text-align: center;">
	        					{{$partido->NOMBRE_LOCAL}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENL;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: bottom;">
	                    		@if($partido->DIF_FECHA>=0)
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}">
	                    		@else
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}" disabled>
	                    		@endif
	                    		<br>
                  			</td>

                  			<td style="text-align: center; vertical-align: bottom;">vs</td>

							<td style="text-align: center; vertical-align: bottom;">
							@if($partido->DIF_FECHA>=0)
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}">
							@else
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}" disabled>
							@endif
							<br>
							</td>

	        				<td style="text-align: center; ">
	        					{{$partido->NOMBRE_VISITA}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENV;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: middle;">
	        					{{$partido->HORA_CAD}}<br>		            					
	        				</td>

							@if(!($partido->DIF_FECHA>=0))
							<td style="text-align: center;vertical-align: middle; color:green">{{$partido->LOCAL_REAL}} - {{$partido->VISITANTE_REAL}}</td>

							<td style="text-align: center; vertical-align: middle; color:green">{{$partido->PUNTOS}}</td>
							@else
							<td style="text-align: center; vertical-align: middle; color:green">- - -</td>
							<td style="text-align: center; vertical-align: middle; color:green">Pendiente</td>
							@endif
	        			</tr>
	        			@endforeach
		        	</tbody>
		    	</table>
				<button type="format" class="btn btn-success btnGuardar" style="float: right"> Guardar</button>
				<div class="clearfix"></div>
			</form>
		</div>
		@endforeach
	</div>

	<h1>Podio
    		<div class="pull-right">
		    	<span class="glyphicon glyphicon-chevron-up" id="i-podio-dropdown" style="font-size: 20px; cursor: pointer;" aria-hidden="true"></span>
			</div>
		</h1>    	

		<div class="row" id="partidos-podio" style="">
		@foreach ($podio as $key => $partidos)
		<div style="margin-bottom: 35px;">
			<h1 class="fecha">{{$key}}</h1>
			<form id="formFecha" method="POST" action="{{route('mundial.insertar')}}">
		        <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;" width="20%">Local</th>                	
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>
		                	<th style="text-align: center;" width="10%"></th>		                	
							<th style="text-align: center;" width="20%">Visitante</th>                      
							<th style="text-align: center;" width="10%">Hora</th>                                         
							<th style="text-align: center;" width="10%">Marcador</th>                     
		                	<th style="text-align: center;" width="10%">Puntos</th>		                	
		                </tr>
		            </thead>
		            <tbody>
	        			@foreach ($partidos as $partido)
		                  @if($partido->DIF_FECHA>=0)
		                      <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}">
		                  @else
		  	        			    <input type="hidden" name="partido[]" value="{{$partido->ID_PARTIDO}}" disabled>
		                  @endif
	        			<tr>
	        				<td style="text-align: center;">
	        					{{$partido->NOMBRE_LOCAL}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENL;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: bottom;">
	                    		@if($partido->DIF_FECHA>=0)
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}">
	                    		@else
	                        		<input type="text" maxlength="1" size="1" name="local[]" value="{{$partido->GOLES_LOCAL}}" disabled>
	                    		@endif
	                    		<br>
                  			</td>

                  			<td style="text-align: center; vertical-align: bottom;">vs</td>

							<td style="text-align: center; vertical-align: bottom;">
							@if($partido->DIF_FECHA>=0)
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}">
							@else
							    <input type="text" maxlength="1" size="1" name="visitante[]" value="{{$partido->GOLES_VISITANTE}}" disabled>
							@endif
							<br>
							</td>

	        				<td style="text-align: center; ">
	        					{{$partido->NOMBRE_VISITA}}<br>
	        					<img src="<?php echo config('app.url').$partido->IMAGENV;?>" style="width: 60px;"></td>

	        				<td style="text-align: center; vertical-align: middle;">
	        					{{$partido->HORA_CAD}}<br>		            					
	        				</td>

							@if(!($partido->DIF_FECHA>=0))
							<td style="text-align: center;vertical-align: middle; color:green">{{$partido->LOCAL_REAL}} - {{$partido->VISITANTE_REAL}}</td>

							<td style="text-align: center; vertical-align: middle; color:green">{{$partido->PUNTOS}}</td>
							@else
							<td style="text-align: center; vertical-align: middle; color:green">- - -</td>
							<td style="text-align: center; vertical-align: middle; color:green">Pendiente</td>
							@endif
	        			</tr>
	        			@endforeach
		        	</tbody>
		    	</table>
				<button type="format" class="btn btn-success btnGuardar" style="float: right"> Guardar</button>
				<div class="clearfix"></div>
			</form>
		</div>
		@endforeach
	</div>


	</div>
<!-- Footer -->
<footer class="page-footer font-small blue pt-4 mt-4">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright: Inteligencia Comercial
  </div>
  <!-- Copyright -->

</footer>

<!-- /.Modal Editar Etapa -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalRanking">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" style="text-align: center;">TOP 25:
                	@if($area==0) BANCA PEQUEÑA EMPRESA 
                	@elseif($area==1) BANCA EMPRESA Y CORPORATIVA 
                	@elseif($area==2) INTELIGENCIA Y SUS AMIGUITOS
                	@endif
                </h3>
            </div>
            <table class="table table-striped" style="align-self: center; margin-bottom: 10px;">
		            <thead>
		                <tr class="headings">		                	
		                	<th style="text-align: center;">Puesto</th>                	
		                	<th style="text-align: center;">Registro</th>
		                	<th style="text-align: center;">Nombre</th>
		                	<th style="text-align: center;">Puntaje</th>                	
		                </tr>
		            </thead>
		            <tbody>
		            	@foreach ($ranking as $puesto)		            		        			
	        			<tr>
	        				<td style="text-align: center;">{{$puesto->PUESTO_BANCA}}</td>
	        				<td style="text-align: center;">{{$puesto->REGISTRO}}</td>
	        				<td style="text-align: center;">{{$puesto->NOMBRE}}</td>
	        				<td style="text-align: center;">{{$puesto->PUNTOS}}</td>
	        				</tr>
	        			@endforeach	        				
		        	</tbody>
		    	</table>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
@yield('js-scripts')
</html>


<script>
    
	$('#i-grupos-dropdown').on('click', function () {
            $('#partidos-grupos').toggle()
            $('#i-grupos-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-grupos-dropdown').toggleClass('glyphicon-chevron-up')
    })

	$('#i-octavos-dropdown').on('click', function () {
            $('#partidos-octavos').toggle()
            $('#i-octavos-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-octavos-dropdown').toggleClass('glyphicon-chevron-up')
    })

    $('#i-cuartos-dropdown').on('click', function () {
            $('#partidos-cuartos').toggle()
            $('#i-cuartos-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-cuartos-dropdown').toggleClass('glyphicon-chevron-up')
    })

    $('#i-semis-dropdown').on('click', function () {
            $('#partidos-semis').toggle()
            $('#i-semis-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-semis-dropdown').toggleClass('glyphicon-chevron-up')
    })

    $('#i-podio-dropdown').on('click', function () {
            $('#partidos-podio').toggle()
            $('#i-podio-dropdown').toggleClass('glyphicon-chevron-down')
            $('#i-podio-dropdown').toggleClass('glyphicon-chevron-up')
    })

	$('.lnkRanking').click(function (e) {
        e.preventDefault();      
        $('#modalRanking').modal();
    });

	$('input[type="text"]').keydown(function (e) {

		// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }

        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.btnGuardar').click(function(){
    	form = $(this).closest('form');

    	if (true){
    		
    	}else{

    	}


    });
</script>