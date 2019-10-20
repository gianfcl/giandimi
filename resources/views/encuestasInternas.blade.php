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
<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
	$permisoResumen=in_array(Auth::user()->REGISTRO,['B32408','B10592','B9411','B34601','B14971']);
?>


@section('content')
<style type="text/css">
div.clasificacion {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

div.clasificacion input {
  position: absolute;
  top: -25px;

}

div.clasificacion label.estrellaX {
  float: right;
  color: grey;
}

div.clasificacion label.activo.estrellaX:hover,
div.clasificacion label.activo.estrellaX:hover ~ label.activo.estrellaX,
div.clasificacion input:checked ~ label.activo.estrellaX {
  color: orange;
  cursor: pointer;
}

textarea{
		resize: none;
	}
</style>
@section('pageTitle', 'Evaluación de Satisfacción')
<p style="font-size: 16px" align="justify">Los siguientes colaboradores recibirán tu evaluación como parte de sus indicadores de mejora continua,  te pedimos emitir tu valoración con la mayor objetividad posible. ¡Muchas gracias!</p>
<form id="frmEncuesta" class="form-horizontal form-label-left" action="{{ route('encuesta.guardar') }}" method="POST">
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
	<div class="x_panel" style="min-height: 533px">		
		<div class="x_content" style="display: block;">
		<label style="font-size: 16px">Preguntas: </label> <br>
			@if(count($preguntas)>0)
				@foreach($preguntas as $pregunta)
					@if($pregunta->ID_PREGUNTA==0 or $pregunta->ID_PREGUNTA==4)
							@continue	
					@else
							<p>P{{$pregunta->ID_PREGUNTA}}.- {{$pregunta->PREGUNTA}}</p>		
					@endif
				@endforeach
			@else
					<p>No se encontraron resultados...</p>
			@endif
		</div><br>
		<label style="font-size: 16px">Nivel de las estrellas: </label> <br>
		<label style="font-size: 20px;color: orange">★ </label> Muy insatisfecho<br>
		<label style="font-size: 20px;color: orange">★★ </label> Insatisfecho<br>
		<label style="font-size: 20px;color: orange">★★★ </label> Neutro<br>
		<label style="font-size: 20px;color: orange">★★★★ </label> Satisfecho<br>
		<label style="font-size: 20px;color: orange">★★★★★ </label> Muy satisfecho<br>
		
		<center><br>

			@if(count($analistas)>0)
			<button id="btnGuardarEncuesta" class="btn btn-success" type="submit" style="font-size: 16px">Guardar Encuesta</button>   
			@endif
			@if($permisoResumen)
			<a href="{{route('encuesta.interna.resumen')}}">
			<button id="btnResumen" class="btn btn-default" type="button" style="font-size: 16px">Ver Resultados</button>    </a>
			@endif
		</center>              	
	</div>
</div>

@if(count($analistas)>0)
		@foreach($analistas as $analista)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
			<div class="x_panel" style="min-height: 533px" >
				<div class="x_title" style="height: 200px">
					<h4 style="text-align: center;margin-bottom: 5px;">{{$analista->NOMBRE}}</h4>
					<center>
						<label>{{$analista->AREA}} </label><br>

						<img src="<?php echo config('app.url').$analista->URL_FOTO;?>" style="width: 130px;height: 130px;"/>    
						<br>
						<br>
						
					</center>
					
				</div>
				<div class="x_content" style="display: block;">
							<div class="preguntasAnalista">
							<div class="pregunta0"> 
								<center>
										<label style="font-size: 12px">¿Has interactuado con {{$analista->PRIMER_NOMBRE}} en los últimos 3 meses?</label><br> <input type="checkbox" class="js-switch checkAnalista" name="checkAnalista[{{$analista->REGISTRO}}]" value="{{$analista->REGISTRO}}" <?php echo ($analista->FLG_RECONOCE==1 ? 'checked' : '');?>><br>
								</center>
							</div>
							@foreach($preguntas as $pregunta)
								@if($pregunta->ID_PREGUNTA==0)
										@continue
								@elseif($pregunta->ID_PREGUNTA==4)
										<textarea class="form-control" rows="5" id="pregunta4" name="sugerencia[{{$analista->REGISTRO}}]" placeholder="{{$preguntas[4]->PREGUNTA}} {{$analista->PRIMER_NOMBRE}}?" disabled required>{{$analista->SUGERENCIA}}</textarea>			
								@else
									<?php 
										if($pregunta->ID_PREGUNTA==1)
											$estrellaPregunta=$analista->PREGUNTA_1;
										else if ($pregunta->ID_PREGUNTA==2)
											$estrellaPregunta=$analista->PREGUNTA_2;
										else if ($pregunta->ID_PREGUNTA==3)
											$estrellaPregunta=$analista->PREGUNTA_3;
									 ?>									 
									<div class="conjuntoEstrellas" >
									
										<center style="height: 40px">
										<div class="clasificacion" style="margin-bottom: 0px;" ><label style="margin-top: 10px;">P{{$pregunta->ID_PREGUNTA}}: &nbsp; </label>
									    <input disabled id="radio1{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" type="radio" name="estrellas[{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}]" value="5" <?php echo ($estrellaPregunta==5 ? 'checked' : '');?>><!--
									    --><label class="estrellaX" for="radio1{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}"  style="font-size: 30px;">★</label><!--
									    --><input disabled id="radio2{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" type="radio" name="estrellas[{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}]" value="4" <?php echo ($estrellaPregunta==4 ? 'checked' : '');?>><!--
									    --><label class="estrellaX" for="radio2{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" style="font-size: 30px;">★</label><!--
									    --><input disabled id="radio3{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" type="radio" name="estrellas[{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}]" value="3" <?php echo ($estrellaPregunta==3 ? 'checked' : '');?>><!--
									    --><label class="estrellaX" for="radio3{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" style="font-size: 30px;">★</label><!--
									    --><input disabled id="radio4{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" type="radio" name="estrellas[{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}]" value="2" <?php echo ($estrellaPregunta==2 ? 'checked' : '');?>><!--
									    --><label class="estrellaX" for="radio4{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" style="font-size: 30px;">★</label><!--
									    --><input disabled id="radio5{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" type="radio" name="estrellas[{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}]" value="1" required <?php echo ($estrellaPregunta==1 ? 'checked' : '');?>><!--
									    --><label class="estrellaX" for="radio5{{$pregunta->ID_PREGUNTA}}-{{$analista->REGISTRO}}" style="font-size: 30px;">★</label>
									  </div>			
									  </center>
									</div>							


								@endif
							@endforeach
						</div>							
				</div>
			</div>
		</div>
		@if($analista->RNK%3==0)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			
		</div>
		@endif
		@endforeach

@else
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" >
		<div class="x_panel">
			<div class="x_content" style="display: block;">
				<p>No se encontraron resultados...</p>
			</div>
		</div>
	</div>
@endif
@stop
</form>

@section('js-scripts')
<script type="text/javascript">
	$(document).ready(function () {


		//Iniciando los switchs
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		elems.forEach(function(html) {
		  var switchery = new Switchery(html);
		});


		//Mostramos de antemano todos los que están checked
		$('.checkAnalista:checked').each(
		    function() {
		        var divPreguntasAnalista=$(this).closest('div').parent();
				divPreguntasAnalista.find('label').addClass('activo');
				divPreguntasAnalista.find('input').removeAttr('disabled');
				divPreguntasAnalista.find('textarea').removeAttr('disabled');	
		    }
		);



		$('.checkAnalista').change(function(){		

			if($(this).attr('checked')!=undefined){
				$(this).removeAttr('checked');
				var divPreguntasAnalista=$(this).closest('div').parent();
				divPreguntasAnalista.find('label').removeClass('activo');
				divPreguntasAnalista.find('input').attr('disabled','true');
				divPreguntasAnalista.find('textarea').attr('disabled','true');
				
				console.log("Sin check");

			}else{			
				$(this).attr('checked',true);
				var divPreguntasAnalista=$(this).closest('div').parent();
				divPreguntasAnalista.find('label').addClass('activo');
				divPreguntasAnalista.find('input').removeAttr('disabled');
				divPreguntasAnalista.find('textarea').removeAttr('disabled');
				
				console.log("Con check");

			}	

		});
	});
</script>
@stop
