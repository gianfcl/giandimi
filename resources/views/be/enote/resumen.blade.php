 	<?php
		$factor = 1;
		$factorTexto = "Miles"
 	?>
<div class="row">	
	<div class="col-md-9 col-sm-9 col-xs-9"><span>Saldo Punta (S/. {{$factorTexto}}) <small>{{\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_SD',$busqueda['periodo'])}}</small></span></div>
	<div class="col-md-3 col-sm-3 col-xs-3"><span>Saldo Promedio (S/. {{$factorTexto}})<small>{{\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_SD',$busqueda['periodo'])}}</small></span></div>
	<div class="col-md-3 col-sm-3 col-xs-3">	
			<table class="table table-striped jambo_table" style="width:100%;">
				 <thead>
			        <tr class="headings" style="height: 58px">
			            <th style="width: 20%; text-align: center;"></th>
			            <th style="width: 40%; text-align: center;">Saldo Inicial</th>
			            <th style="width: 40%; text-align: center;">Saldo Actual</th>
			        </tr>
			    </thead>
			    <tbody> 
			    	 <?php
			    	 	$salIni = 0;
			    	 	$salAct = 0;
			    	 ?>

			    	 @foreach ($resumenSaldos as $resumenSaldo)
			    	 <tr>
			    	 	
			            <td style="padding: 1.5px; text-align: left;">{{$resumenSaldo->TIPO_PRODUCTO}}</td>  
			            <td style="padding: 1.5px; text-align: center;">{{number_format($resumenSaldo->SALDO_INICIAL/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenSaldo->SALDO_ACTUAL/$factor,0,'.',',')}} 
			              	<?php
				              	if($resumenSaldo->SALDO_ACTUAL>$resumenSaldo->SALDO_INICIAL){
									$orientacion = 'up';
				              	}else{
				              		$orientacion = 'down';
								}				              	
			              	?>			              	
			              	<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
			              	@if ($resumenSaldo->SALDO_INICIAL <> 0)
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenSaldo->SALDO_ACTUAL/$resumenSaldo->SALDO_INICIAL)}}
							@else
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenSaldo->SALDO_ACTUAL/1)}}
							@endif
			              	">
			              	</i>

			            </td> 
			            <?php
			            	$salIni =  $salIni + $resumenSaldo->SALDO_INICIAL;
			            	$salAct =  $salAct + $resumenSaldo->SALDO_ACTUAL;
			            ?>	

			          </tr>
			         @endforeach  
			         <tr>
			         	<td style="padding: 1.5px; text-align: left;">TOTAL COL.</td>  
			         	<td style="padding: 1.5px; text-align: center;">{{number_format($salIni/$factor,0,'.',',')}}
			         	</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($salAct/$factor,0,'.',',')}}
			         		<?php
				              	if($salAct>$salIni){
									$orientacion = 'up';
				              	}else{
				              		$orientacion = 'down';
								}				              	
			              	?>			              	
			              	<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
							@if ($salIni <> 0)
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salAct/$salIni)}}
							@else
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salAct/1)}}
							@endif	
			         		"></i>	
			         	</td>  		
			         </tr>	
			    </tbody>	
			</table>
	</div>	
	<div class="col-md-1 col-sm-1 col-xs-1">
			<table class="table table-striped jambo_table" style="width:100%; padding: 0px;">
				 <thead>
			        <tr class="headings" style="height: 58px">
			            <th style="width: 100%; text-align: center;">Caídas</th>
			        </tr>
			    </thead>
			    <tbody> 
			    	<?php
			    	  	$totCaida = 0;
			    	 ?>

			    	 @foreach ($resumenCaidas as $resumenCaida)
			    	 <tr>
			            <td style="padding: 1.5px; text-align: center;">{{number_format($resumenCaida->MONTO_CAIDA/$factor,0,'.',',')}}</td>  	
			            <?php
			            	$totCaida =  $totCaida + $resumenCaida->MONTO_CAIDA;
			            ?>
			         </tr>
			         @endforeach  
			         <tr>
			         	<td style="padding: 1.5px; text-align: center;">{{number_format($totCaida/$factor,0,'.',',')}}</td>  
			         </tr>	
			    </tbody>	
			</table>
	</div>
	<div class="col-md-2 col-sm-2 col-xs-2">	
			<table class="table table-striped jambo_table" style="width:100%">
				<col>
				<colgroup span="3"></colgroup>
				<thead>
					<tr class="headings">
						<th colspan="3" scope="colgroup" style="width: 100%; text-align: center;padding: 2px;">Desembolso</th>
					</tr>
					<tr class="headings">
						<th scope="col" style="width: 10%; text-align: center;">Compromiso</th>
					  	<th scope="col" style="width: 10%; text-align: center;">Certero</th>
					  	<th scope="col" style="width: 10%; text-align: center;">Cotización</th>
					</tr>
				</thead>
				 <tbody> 
				 	<?php
			    	 	$totCompr = 0;
			    	 	$totMontCert = 0;
			    	 	$totMontEncot = 0;
			    	 ?>
			    	 @foreach ($resumenDesembolsos as $resumenDesembolso)
			    	 <tr>
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenDesembolso->COMPROMISO/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenDesembolso->MONTO_CERT/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenDesembolso->MONTO_ENCOT/$factor,0,'.',',')}}</td> 
			            <?php
			            	$totCompr += $resumenDesembolso->COMPROMISO;
			            	$totMontCert += $resumenDesembolso->MONTO_CERT;
			            	$totMontEncot += $resumenDesembolso->MONTO_ENCOT;
			            ?>
			          </tr>
			         @endforeach  
			         <tr>
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totCompr/$factor,0,'.',',')}}</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totMontCert/$factor,0,'.',',')}}</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totMontEncot/$factor,0,'.',',')}}</td>  
			         </tr>	
			    </tbody>
			</table>
	</div>		
	<div class="col-md-3 col-sm-3 col-xs-3">
			<table class="table table-striped jambo_table" style="width:100%">
				<col>
				<colgroup span="3"></colgroup>
				<thead>
					<tr class="headings">
						<th colspan="3" scope="colgroup" style="width: 100%; text-align: center;padding: 2px;">Proyección del Saldo Cierre</th>
					</tr>
					<tr class="headings">
						<th scope="col" style="width: 10%; text-align: center;">Compromiso</th>
					  	<th scope="col" style="width: 10%; text-align: center;">Certero</th>
					  	<th scope="col" style="width: 10%; text-align: center;">Cotización</th>
					</tr>
				</thead>
				<tbody> 
				 	<?php
			    	 	$totSalCompr = 0;
			    	 	$totProyCert = 0;
			    	 	$totProyEncot = 0;
			    	 	$totMeta = 0;
			    	 ?>
			    	 @foreach ($resumenProyeccInicial as $key => $resumenProyeccInicial1)
			    	 <tr>
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenProyeccInicial1->SALDO_PROYEC_CERT/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format(($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT)/$factor,0,'.',',')}}
			            	<?php
			            			if ($resumenMetas[$key]->META <> 0){
							    	$ProyecCert = ($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT)/$resumenMetas[$key]->META;
									}else{
							    	$ProyecCert = ($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT);
									}
			            		
			            			
			            			if ($resumenMetas[$key]->META <> 0){
							    	$ProyecEnCot = ($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT +$resumenDesembolsos[$key]->MONTO_ENCOT)/$resumenMetas[$key]->META;
									}else{
							    	$ProyecEnCot = ($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT +$resumenDesembolsos[$key]->MONTO_ENCOT);
									}
			            		
			            		
			            	?>
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($ProyecCert)}}"></i>
			            	
			            </td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format(($resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT+$resumenDesembolsos[$key]->MONTO_ENCOT)/$factor,0,'.',',')}}
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($ProyecEnCot)}}"></i>			            
			            </td> 

			            <?php
			            	$totSalCompr += $resumenProyeccInicial1->SALDO_PROYEC_CERT;
			            	$totProyCert += $resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT;
			            	$totProyEncot += $resumenSaldos[$key]->SALDO_ACTUAL - $resumenCaidas[$key]->MONTO_CAIDA + $resumenDesembolsos[$key]->MONTO_CERT+$resumenDesembolsos[$key]->MONTO_ENCOT;
			            	$totMeta += $resumenMetas[$key]->META;
			            ?>
			          </tr>
			         @endforeach  
			         <tr>
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totSalCompr/$factor,0,'.',',')}}</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totProyCert/$factor,0,'.',',')}} 
			         		<i class="fa fa-circle" style="color: 			         		
			         		@if($totMeta<>0)
								{{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($totProyCert/$totMeta)}}
			         		
			         		@else
			         			{{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($totProyCert)}}
			         		@endif
			         		?>
			         		"></i>
			         	</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totProyEncot/$factor,0,'.',',')}}
			         		<i class="fa fa-circle" style="color: 			         		
			         		@if($totMeta<>0)
								{{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($totProyEncot/$totMeta)}}
			         		@else			         		
			         			{{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($totProyEncot)}}
			         		@endif			         		
			         		"></i>
			         	</td>  
			         </tr>	
			    </tbody>

				 
			</table>
	</div>	
	<div class="col-md-3 col-sm-3 col-xs-3">		
		<table class="table table-striped jambo_table" style="width:100%">
			<thead>
			    <tr class="headings" style="height: 58px">
			        <th style="width: 25%; text-align: center;">Ppto. Mes</th>
			        <th style="width: 25%; text-align: center;">Saldo Actual</th>
			        <th style="width: 30%; text-align: center;">Gap</th>
			        <th style="width: 20%; text-align: center;">Avance</th>
			    </tr>
			</thead>
			<tbody> 
				 	<?php
			    	 	$totppto = 0;
			    	 	$totSaldoProm = 0;
			    	 	$totGap = 0;
			    	 	$totAvance = 0;
			    	 ?>
			    	 @foreach ($resumenMetas as $resumenMeta)
			    	 <tr>
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenMeta->META/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenMeta->SALDO_PROMEDIO/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenMeta->GAP/$factor,0,'.',',')}} 
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenMeta->AVANCE/100)}}"></i>
			            </td> 
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenMeta->AVANCE,0,'.',',')}}%</td> 
			            <?php
			            	$totppto += $resumenMeta->META;
			            	$totSaldoProm += $resumenMeta->SALDO_PROMEDIO;
			            	$totGap += $resumenMeta->GAP;

			            ?>
			          </tr>
			         @endforeach 

			         <?php
			         	if($totppto<>0){
			         		$totAvance =  ($totSaldoProm/$totppto)* 100;
			         	}			         	
			         	else{
			         		$totAvance =  ($totSaldoProm)* 100;
			         	}
			         ?> 
			         <tr>
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totppto/$factor,0,'.',',')}}</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totSaldoProm/$factor,0,'.',',')}}</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totGap/$factor,0,'.',',')}}
			         		<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($totGap/100)}}"></i>
			         	</td>  
			         	<td style="padding: 1.5px; text-align: right;">{{number_format($totAvance,0,'.',',')}}%</td>  
			         </tr>	
			    </tbody>
		</table>
	</div>	
</div>			



