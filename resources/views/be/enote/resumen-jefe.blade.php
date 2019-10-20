
<?php
		$factor = 1000;
		$factorTexto = "MM"
 	?>

 <style>
 	.table>tbody>tr>td{
	--padding: 0px;
 	}
 	.tiposProductos{

 	}
 </style>	
<div class="row">	
	<div class="col-md-9 col-sm-9 col-xs-9"><span>Saldo Punta (S/. {{$factorTexto}})</span></div>
	<div class="col-md-3 col-sm-3 col-xs-3"><span>Saldo Promedio (S/. {{$factorTexto}})</span></div>
	<?php
			    	 	$salIniDir = 0;
			    	 	$salActDir = 0;
			    	 	$salIniInd = 0;
			    	 	$salActInd = 0;

			    	 	$caidasDir =0;
			    	 	$caidasInd= 0;

			    	 	$comprDir = 0;
			    	 	$montoCertDir = 0;
			    	 	$montoEncotDir = 0;
			    	 	$comprInd = 0;
			    	 	$montoCertInd = 0;
			    	 	$montoEncotInd = 0;

			    	 	$saldoComprDir = 0;
			    	 	$ProyCertDir =0;
			    	 	$proyEncotDir = 0;
			    	 	$MetaDir = 0;
			    	 	$saldoComprInd = 0;
			    	 	$ProyCertInd =0;
			    	 	$proyEncotInd = 0;
			    	 	$MetaInd = 0;

			    	 	$totpptoDir = 0;
			    	 	$totSaldoPromDir = 0;
			    	 	$totGapDir = 0;
			    	 	$totAvanceDir = 0;

			    	 	$totpptoInd = 0;
			    	 	$totSaldoPromInd = 0;
			    	 	$totGapInd = 0;
			    	 	$totAvanceInd = 0;

			    	 	foreach ($resumenJefes as $resumenJefe){
			    	 		if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS"){
			    	 			$salIniDir = $salIniDir + $resumenJefe["SALDO_INICIAL"];
			    	 			$salActDir = $salActDir + $resumenJefe["SALDO_ACTUAL"];

			    	 			$caidasDir = $caidasDir + $resumenJefe["MONTO_CAIDA"]; 

			    	 			$comprDir = $comprDir + $resumenJefe["COMPROMISO"]; 
			    	 			$montoCertDir = $montoCertDir + $resumenJefe["MONTO_CERT"]; 
			    	 			$montoEncotDir = $montoEncotDir + $resumenJefe["MONTO_ENCOT"]; 

			    	 			$saldoComprDir = $saldoComprDir + $resumenJefe["SALDO_PROYEC_CERT"];
			    	 			$ProyCertDir = $ProyCertDir + $resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"];  
			    	 			$proyEncotDir = $proyEncotDir + $resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_ENCOT"] +$resumenJefe["MONTO_CERT"]; 
			    	 			$MetaDir = $MetaDir + $resumenJefe["META"]; 

			    	 			$totpptoDir = $totpptoDir + $resumenJefe["META"]; 
			    	 			$totSaldoPromDir = $totSaldoPromDir + $resumenJefe["SALDO_PROMEDIO"]; 
			    	 			$totGapDir = $totGapDir + $resumenJefe["GAP"]; 
			    	 			$totAvanceDir = $totAvanceDir + $resumenJefe["AVANCE"]; 

			    	 		}else{
			    	 			if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS"){
			    	 			$salIniInd = $salIniInd + $resumenJefe["SALDO_INICIAL"];
			    	 			$salActInd = $salActInd + $resumenJefe["SALDO_ACTUAL"];	

			    	 			$caidasInd = $caidasInd + $resumenJefe["MONTO_CAIDA"]; 	

			    	 			$comprInd = $comprInd + $resumenJefe["COMPROMISO"]; 
			    	 			$montoCertInd = $montoCertInd + $resumenJefe["MONTO_CERT"]; 
			    	 			$montoEncotInd = $montoEncotInd + $resumenJefe["MONTO_ENCOT"];

			    	 			$saldoComprInd = $saldoComprInd + $resumenJefe["SALDO_PROYEC_CERT"];
			    	 			$ProyCertInd = $ProyCertInd + $resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"];  
			    	 			$proyEncotInd = $proyEncotInd + $resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_ENCOT"] +$resumenJefe["MONTO_CERT"]; 
			    	 			$MetaInd = $MetaInd + $resumenJefe["META"]; 

			    	 			$totpptoInd = $totpptoInd + $resumenJefe["META"]; 
			    	 			$totSaldoPromInd = $totSaldoPromInd + $resumenJefe["SALDO_PROMEDIO"]; 
			    	 			$totGapInd = $totGapInd + $resumenJefe["GAP"]; 
			    	 			$totAvanceInd = $totAvanceInd + $resumenJefe["AVANCE"];
			    	 			}			    	 			
			    	 		}
						}
	?>
	<!--Primero-->
	<div class="col-md-3 col-sm-3 col-xs-3">	
			<table class="table table-striped jambo_table" style="width:100%;">
				 <thead>
			        <tr class="headings" style="height: 58px">
			            <th style="width: 50%; text-align: center;"></th>
			            <th style="width: 25%; text-align: center;">Saldo Inicial <span><small>{{\App\Entity\BE\SaldosDiarios::getParametros('FECHA_INI_SD',$busqueda['periodo'])}}</small></span></th>
			            <th style="width: 25%; text-align: center;">Saldo Actual <span><small>{{\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_SD',$busqueda['periodo'])}}</small></span></th>
			        </tr>
			    </thead>
			    <tbody> 			    	 
					 <tr>
					 	<td style="padding: 1.5px; text-align: left;" class="cabDirectas tiposProductos" ><b>DIRECTAS</b></td>  
			            <td style="padding: 1.5px; text-align: center; " class="cabDirectas tiposProductos"><b>{{number_format($salIniDir/$factor,0,'.',',')}}</b></td> 
			            <td style="padding: 1.5px; text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($salActDir/$factor,0,'.',',')}}
			            <?php
				              	if($salActDir>$salIniDir){
									$orientacion = 'up';
				              	}else{
				              		$orientacion = 'down';
								}				              	
			              	?>	</b>
			            <i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
				              	@if ($salActInd <> 0)
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salActDir/$salIniDir)}}
								@else
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salActDir/1)}}
								@endif
				              	">
				              	</i>
				        </td>
					 </tr>
			    	 @foreach ($resumenJefes as $resumenJefe)
				    	 @if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS")
				    	 <tr class="rowsDirectas" style="display: none;">			    	 	
				            <td style="padding: 1.5px; text-align: left; font-size: 0.7em;"> - {{$resumenJefe["NOMBRE"]}}</td>  
				            <td style="padding: 1.5px; text-align: center;">{{number_format($resumenJefe["SALDO_INICIAL"]/$factor,0,'.',',')}}</td>  	
				            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["SALDO_ACTUAL"]/$factor,0,'.',',')}} 
				              	<?php
				              	if($resumenJefe["SALDO_ACTUAL"]>$resumenJefe["SALDO_INICIAL"]){
									$orientacion = 'up';
				              	}else{
				              		$orientacion = 'down';
								}				              	
			              	?>	
			            		<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
				              	@if ($resumenJefe["SALDO_INICIAL"] <> 0)
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/$resumenJefe["SALDO_INICIAL"])}}
								@else
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/1)}}
								@endif
				              	">
				              	</i>

				            </td> 			            
				          </tr>
				         @endif
			         @endforeach 
			         <tr >
					 	<td style=" padding: 1.5px; text-align: left;" class="cabIndirectas tiposProductos"><b>INDIRECTAS</b></td>  
			            <td style=" padding: 1.5px;text-align: center;" class="cabIndirectas tiposProductos"><b>{{number_format($salIniInd/$factor,0,'.',',')}}</b></td> 
			            <td style=" padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($salActInd/$factor,0,'.',',')}}
			            	<?php
				              	if($salActInd>$salIniInd){
									$orientacion = 'up';
				              	}else{
				              		$orientacion = 'down';
								}				              	
			              	?>	</b>
			            		<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
				              	@if ($salActInd <> 0)
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salActInd/$salIniInd)}}
								@else
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($salActInd/1)}}
								@endif
				              	">
				              	</i>
				        </td>
					 </tr> 
					 @foreach ($resumenJefes as $resumenJefe)
				    	 @if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS")
				    	 <tr class="rowsIndirectas" style="display: none;">			    	 	
				            <td style="padding: 1.5px;text-align: left; font-size: 0.7em;"> - {{$resumenJefe["NOMBRE"]}}</td>  
				            <td style=" padding: 1.5px;text-align: center;">{{number_format($resumenJefe["SALDO_INICIAL"]/$factor,0,'.',',')}}</td>  	
				            <td style=" padding: 1.5px;text-align: right;">{{number_format($resumenJefe["SALDO_ACTUAL"]/$factor,0,'.',',')}} 
					            <?php
					              	if($resumenJefe["SALDO_ACTUAL"]>$resumenJefe["SALDO_INICIAL"]){
										$orientacion = 'up';
					              	}else{
					              		$orientacion = 'down';
									}				              	
				              	?>	
			            		<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
				              	@if ($resumenJefe["SALDO_INICIAL"] <> 0)
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/$resumenJefe["SALDO_INICIAL"])}}
								@else
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/1)}}
								@endif
				              	">
				              	</i>

				            </td> 				           
				          </tr>
				         @endif
			         @endforeach
			         <tr class="cabTotal">
			         	<td style=" padding: 1.5px;text-align: left;"><b>TOTAL COL.</b>	</td>  
			         	<td style=" padding: 1.5px;text-align: center;"><b>{{number_format(($salIniDir+$salIniInd)/$factor,0,'.',',')}}</b>
			         	</td>  
			         	<td style=" padding: 1.5px;text-align: right;"><b>{{number_format(($salActDir+$salActInd)/$factor,0,'.',',')}}
			         			<?php
					              	if(($salActDir+$salActInd)>($salIniDir+$salIniInd)){
										$orientacion = 'up';
					              	}else{
					              		$orientacion = 'down';
									}				              	
				              	?></b>	
			            		<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
							@if (($salActDir+$salActInd) <> 0)
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct(($salActDir+$salActInd)/($salIniDir+$salIniInd))}}
							@else
							    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct(($salActDir+$salActInd)/1)}}
							@endif	
			         		"></i>	
			         	</td>  		
			         </tr>
			         @foreach ($resumenJefes as $resumenJefe)
				    	 @if($resumenJefe["TIPO_PRODUCTO"]=="TOTAL")
				    	 <tr class="rowsTotal" style="display: none;">			    	 	
				            <td style="padding: 1.5px;text-align: left; font-size: 0.7em;"> - {{$resumenJefe["NOMBRE"]}}</td>  
				            <td style=" padding: 1.5px;text-align: center;">{{number_format($resumenJefe["SALDO_INICIAL"]/$factor,0,'.',',')}}</td>  	
				            <td style=" padding: 1.5px;text-align: right;">{{number_format($resumenJefe["SALDO_ACTUAL"]/$factor,0,'.',',')}} 
					            <?php
					              	if($resumenJefe["SALDO_ACTUAL"]>$resumenJefe["SALDO_INICIAL"]){
										$orientacion = 'up';
					              	}else{
					              		$orientacion = 'down';
									}				              	
				              	?>	
			            		<i class="fa fa-caret-{{$orientacion}} fa-lg" style="color: 
				              	@if ($resumenJefe["SALDO_INICIAL"] <> 0)
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/$resumenJefe["SALDO_INICIAL"])}}
								@else
								    {{\App\Entity\BE\SemaforosEnote::getColorSemaforoSalAct($resumenJefe["SALDO_ACTUAL"]/1)}}
								@endif
				              	">
				              	</i>

				            </td> 				           
				          </tr>
				         @endif
			         @endforeach	
			    </tbody>	
			</table>
	</div>	
	<!--segundo-->	
	<div class="col-md-1 col-sm-1 col-xs-1">
			<table class="table table-striped jambo_table" style="width:100%; padding: 0px;">
				 <thead>
			        <tr class="headings" style="height: 58px">
			            <th style="width: 100%; text-align: center;">Caídas</th>
			        </tr>
			    </thead>
			    <tbody> 			    						
					<tr>
			            <td style=" padding: 1.5px; text-align: center;" class="cabDirectas tiposProductos"> <b>{{number_format($caidasDir/$factor,0,'.',',')}}</b></td>  				           
			        </tr>

			    	 @foreach ($resumenJefes as $resumenJefe)
			    	 	@if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS")
					    	<tr class="rowsDirectas" style="display: none;">
					            <td style="padding: 1.5px;text-align: center;">{{number_format($resumenJefe["MONTO_CAIDA"]/$factor,0,'.',',')}}</td>  						            
					        </tr>
			        	@endif
			         @endforeach  
			         <tr>
			            <td style="padding: 1.5px;text-align: center;" class="cabIndirectas tiposProductos"><b>{{number_format($caidasInd/$factor,0,'.',',')}}</b></td>  				           
			        </tr>
			         @foreach ($resumenJefes as $resumenJefe)
			    	 	@if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS")
					    	<tr class="rowsIndirectas" style="display: none;">
					            <td style="padding: 1.5px;text-align: center;">{{number_format($resumenJefe["MONTO_CAIDA"]/$factor,0,'.',',')}}</td>  						            
					        </tr>
			        	@endif
			         @endforeach 
			         <tr class="cabTotal">
			         	<td style="padding: 1.5px;text-align: center;"><b>{{number_format(($caidasDir+$caidasInd)/$factor,0,'.',',')}}</b></td>  
			         </tr>
			         @foreach ($resumenJefes as $resumenJefe)
			    	 	@if($resumenJefe["TIPO_PRODUCTO"]=="TOTAL")
					    	<tr class="rowsTotal" style="display: none;">
					            <td style="padding: 1.5px;text-align: center;">{{number_format($resumenJefe["MONTO_CAIDA"]/$factor,0,'.',',')}}</td>  						            
					        </tr>
			        	@endif
			         @endforeach  	
			    </tbody>	
			</table>
	</div>
	<!--Tercero-->
	<div class="col-md-2 col-sm-2 col-xs-2">	
			<table class="table table-striped jambo_table" style="width:100%">
				<col>
				<colgroup span="3"></colgroup>
				<thead>
					<tr class="headings">
						<th colspan="3" scope="colgroup" style="width: 100%; text-align: center;padding: 2px;">Desembolso</th>
					</tr>
					<tr class="headings">
						<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Compromiso</th>
					  	<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Certero</th>
					  	<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Cotización</th>
					</tr>
				</thead>
				 <tbody> 
				 	<tr>
			    	 	<td style="padding: 1.5px;text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($comprDir/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($montoCertDir/$factor,0,'.',',')}}</b></td>  	
			            <td style="padding: 1.5px;text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($montoEncotDir/$factor,0,'.',',')}}</b></td> 			            
			        </tr>				 	
			    	 @foreach ($resumenJefes as $resumenJefe)
				    	@if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS") 
				    	 <tr  class="rowsDirectas" style="display: none">
				    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["COMPROMISO"]/$factor,0,'.',',')}}</td>
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_CERT"]/$factor,0,'.',',')}}</td>  	
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_ENCOT"]/$factor,0,'.',',')}}</td> 			            
				          </tr>
				        @endif  
			         @endforeach 
			         <tr>
			    	 	<td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($comprInd/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($montoCertInd/$factor,0,'.',',')}}</b></td>  	
			            <td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($montoEncotInd/$factor,0,'.',',')}}</b></td> 			            
			        </tr>				 	
			    	 @foreach ($resumenJefes as $resumenJefe)
				    	@if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS")  
				    	 <tr  class="rowsIndirectas" style="display: none">
				    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["COMPROMISO"]/$factor,0,'.',',')}}</td>
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_CERT"]/$factor,0,'.',',')}}</td>  	
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_ENCOT"]/$factor,0,'.',',')}}</td> 			            
				          </tr>
				        @endif
			         @endforeach   
			         <tr class="cabTotal">
			         	<td style="padding: 1.5px;text-align: right;"><b>{{number_format(($comprDir+$comprInd)/$factor,0,'.',',')}}</b></td>  
			         	<td style="padding: 1.5px;text-align: right;"><b>{{number_format(($montoCertDir+$montoCertInd)/$factor,0,'.',',')}}</b></td>  
			         	<td style="padding: 1.5px;text-align: right;"><b>{{number_format(($montoEncotDir+$montoEncotInd)/$factor,0,'.',',')}}</b></td>  
			         </tr>
			         @foreach ($resumenJefes as $resumenJefe)
				    	@if($resumenJefe["TIPO_PRODUCTO"]=="TOTAL") 
				    	 <tr  class="rowsTotal" style="display: none">
				    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["COMPROMISO"]/$factor,0,'.',',')}}</td>
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_CERT"]/$factor,0,'.',',')}}</td>  	
				            <td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["MONTO_ENCOT"]/$factor,0,'.',',')}}</td> 			            
				          </tr>
				        @endif  
			         @endforeach 	
			    </tbody>
			</table>
	</div>
	<!--cuarto-->
	<div class="col-md-3 col-sm-3 col-xs-3">
			<table class="table table-striped jambo_table" style="width:100%">
				<col>
				<colgroup span="3"></colgroup>
				<thead>
					<tr class="headings">
						<th colspan="3" scope="colgroup" style="width: 100%; text-align: center;padding: 2px;">Proyección del Saldo Cierre</th>
					</tr>
					<tr class="headings">
						<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Compromiso</th>
					  	<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Certero</th>
					  	<th scope="col"padding: 1.5px;style="width: 10%; text-align: center;">Cotización</th>
					</tr>
				</thead>
				<tbody> 				 	
			    	<tr>
			    	 	<td style="padding: 1.5px;text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($saldoComprDir/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px;text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format(($salActDir - $caidasDir + $montoCertDir)/$factor,0,'.',',')}}</b>			            	
			            	@if ($totpptoDir <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActDir - $caidasDir + $montoCertDir)/$totpptoDir)}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActDir - $caidasDir + $montoCertDir))}}"></i>
							@endif	

			            	
			            </td>  	
			         	<td style="padding: 1.5px;text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format(($salActDir - $caidasDir + $montoCertDir+$montoEncotDir)/$factor,0,'.',',')}}</b>			            	
			            	@if ($totpptoDir<> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActDir - $caidasDir + $montoCertDir+$montoEncotDir)/$totpptoDir)}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActDir - $caidasDir + $montoCertDir+$montoEncotDir))}}"></i>
							@endif			            	
			            </td> 
			        </tr>
			        @foreach ($resumenJefes as $resumenJefe)
			    	@if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS") 
			    	<tr class="rowsDirectas" style="display: none;">
			    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["SALDO_PROYEC_CERT"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}            	
			            	
							@if ($resumenJefe["META"] <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$resumenJefe["META"])}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/1)}}"></i>
							@endif	
			            	
			            	
			            </td>  	
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_ENCOT"] + $resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}
			            	

							@if ($resumenJefe["META"] <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"] +$resumenJefe["MONTO_ENCOT"])/$resumenJefe["META"])}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"] +$resumenJefe["MONTO_ENCOT"])}}"></i>
							@endif
			            </td> 				           
			        </tr>
			        @endif
			        @endforeach
			        <tr>
			    	 	<td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($saldoComprInd/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format(($salActInd - $caidasInd + $montoCertInd)/$factor,0,'.',',')}}</b>			

			             	@if ($totpptoInd <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActInd - $caidasInd + $montoCertInd)/$totpptoInd)}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActInd - $caidasInd + $montoCertInd))}}"></i>
							@endif	

			            	
			            	
			            </td>  	
			            <td style="padding: 1.5px;text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format(($salActInd - $caidasInd + $montoCertInd+$montoEncotInd)/$factor,0,'.',',')}}</b>
			            	
			            	@if ($totpptoInd <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActInd - $caidasInd + $montoEncotInd + $montoCertInd )/$totpptoInd)}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($salActInd - $caidasInd + $montoEncotInd + $montoCertInd ))}}"></i>
							@endif

			            	
			            </td> 			            			          
			        </tr>
			        @foreach ($resumenJefes as $resumenJefe)
			    	@if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS") 
			    	<tr class="rowsIndirectas" style="display: none;">
			    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["SALDO_PROYEC_CERT"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}            	
			            	
							@if ($resumenJefe["META"] <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$resumenJefe["META"])}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"]))}}"></i>
							@endif
		            	
			            	
			            </td>  	
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_ENCOT"]+$resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}
			            	
							@if ($resumenJefe["META"] <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"] +$resumenJefe["MONTO_ENCOT"])/$resumenJefe["META"])}}"></i>
							@else
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"] +$resumenJefe["MONTO_ENCOT"]))}}"></i>
							@endif
			            </td> 			           
			        </tr>
			        @endif
			        @endforeach 
			        <tr class="cabTotal">  
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($saldoComprDir+$saldoComprInd)/$factor,0,'.',',')}}</b></td>  
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($ProyCertDir+$ProyCertInd)/$factor,0,'.',',')}}</b> 
			         		@if (($MetaDir+$MetaInd) <> 0)
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($ProyCertDir+$ProyCertInd)/($MetaDir+$MetaInd))}}"></i>
							@else
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($ProyCertDir+$ProyCertInd)/1)}}"></i>
							@endif			         		
			         	</td> 
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($proyEncotDir+$proyEncotInd)/$factor,0,'.',',')}}</b>
			         		@if (($MetaDir+$MetaInd)<> 0)
								<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($proyEncotDir+$proyEncotInd)/($MetaDir+$MetaInd))}}"></i>
							@else
							    <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($proyEncotDir+$proyEncotInd)/1)}}"></i>
							@endif
			         		
			         	</td>  
			        </tr>	
			        @foreach ($resumenJefes as $resumenJefe)
			    	@if($resumenJefe["TIPO_PRODUCTO"]=="TOTAL") 
			    	<tr class="rowsTotal" style="display: none;">
			    	 	<td style="padding: 1.5px;text-align: right;">{{number_format($resumenJefe["SALDO_PROYEC_CERT"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}            	
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"])/$resumenJefe["META"])}}"></i>
			            	
			            </td>  	
			            <td style="padding: 1.5px;text-align: right;">{{number_format(($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_ENCOT"] +$resumenJefe["MONTO_CERT"])/$factor,0,'.',',')}}
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenJefe["SALDO_ACTUAL"] - $resumenJefe["MONTO_CAIDA"] + $resumenJefe["MONTO_CERT"] +$resumenJefe["MONTO_ENCOT"]/$resumenJefe["META"])}}"></i>
			            </td> 				           
			        </tr>
			        @endif
			        @endforeach
			    </tbody>				 
			</table>
	</div>	
	<!--quinto-->
	<div class="col-md-3 col-sm-3 col-xs-3">		
		<table class="table table-striped jambo_table" style="width:100%">
			<thead>
			    <tr class="headings" style="height: 58px">
			        <th style="width: 25%; text-align: center;">Ppto. Mes</th>
			        <th style="width: 25%; text-align: center;">Saldo Actual <span><small>{{\App\Entity\BE\SaldosDiarios::getParametros('FECHA_ACT_SD',$busqueda['periodo'])}}</small></span></th>
			        <th style="width: 30%; text-align: center;">Gap</th>
			        <th style="width: 20%; text-align: center;">Avance</th>
			    </tr>
			</thead>
			<tbody> 				 	
			    	 
					 <tr>
			    	 	<td style="padding: 1.5px; text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($totpptoDir/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px; text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($totSaldoPromDir/$factor,0,'.',',')}}</b></td>  	
			            <td style="padding: 1.5px; text-align: right;" class="cabDirectas tiposProductos"><b>{{number_format($totGapDir/$factor,0,'.',',')}} </b>
			            	@if($totpptoDir==0)
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($totSaldoPromDir/1))}}"></i>
			            	@else
							<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($totSaldoPromDir/$totpptoDir))}}"></i>
			            	@endif			            	
			            </td> 
			            @if($totpptoDir==0)
			            <td style="padding: 1.5px; text-align: right;"><b>{{number_format((0)*100,0,'.',',')}}%</b></td> 			            
			            @else
						<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($totSaldoPromDir/$totpptoDir)*100,0,'.',',')}}%</b></td> 			            
			            @endif
			            
			          </tr>
			    	 @foreach ($resumenJefes as $resumenJefe)			    	 
			    	 @if($resumenJefe["TIPO_PRODUCTO"]=="DIRECTAS")
			    	 <tr class="rowsDirectas" style="display: none;">
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["META"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["SALDO_PROMEDIO"]/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["GAP"]/$factor,0,'.',',')}} 
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenJefe["AVANCE"]/100)}}"></i>
			            </td> 
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["AVANCE"],0,'.',',')}}%</td> 			          
			          </tr>
			         @endif
			         @endforeach 
			         <tr >
			    	 	<td style="padding: 1.5px; text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($totpptoInd/$factor,0,'.',',')}}</b></td>
			            <td style="padding: 1.5px; text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($totSaldoPromInd/$factor,0,'.',',')}}</b></td>  	
			            <td style="padding: 1.5px; text-align: right;" class="cabIndirectas tiposProductos"><b>{{number_format($totGapInd/$factor,0,'.',',')}}</b> 
			           	@if($totpptoInd==0)
			            <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($totpptoInd/1))}}"></i>
			            @else
			            <i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($totSaldoPromInd/$totpptoInd))}}"></i>
			            @endif			            	
			            </td> 
			            @if($totpptoInd==0)
			            <td style="padding: 1.5px; text-align: right;"><b>{{number_format((0/1)*100,0,'.',',')}}%</b></td> 			            
			            @else
			            <td style="padding: 1.5px; text-align: right;"><b>{{number_format(($totSaldoPromInd/$totpptoInd)*100,0,'.',',')}}%</b></td> 			            
			            @endif			            
			          </tr>
			         @foreach ($resumenJefes as $resumenJefe)			    	 
			    	 @if($resumenJefe["TIPO_PRODUCTO"]=="INDIRECTAS")
			    	 <tr class="rowsIndirectas" style="display: none;">
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["META"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["SALDO_PROMEDIO"]/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["GAP"]/$factor,0,'.',',')}} 
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenJefe["AVANCE"]/100)}}"></i>
			            </td> 
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["AVANCE"],0,'.',',')}}%</td> 			            
			          </tr>
			         @endif
			         @endforeach	        
			         <tr class="cabTotal">
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($totpptoDir+$totpptoInd)/$factor,0,'.',',')}}</b></td>  
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($totSaldoPromDir+$totSaldoPromInd)/$factor,0,'.',',')}}</b></td>  
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format(($totGapDir+$totGapInd)/$factor,0,'.',',')}}</b>
			         		@if(($totpptoDir+$totpptoInd)==0)
			         		<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero((0)/1)}}"></i>
			         		@else
			         		<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero(($totSaldoPromDir+$totSaldoPromInd)/($totpptoDir+$totpptoInd))}}"></i>
			         		@endif
			         		
			         	</td>  
			         	@if(($totpptoDir+$totpptoInd)==0)
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format((($totSaldoPromDir+$totSaldoPromInd)/1)*100,0,'.',',')}}%</b></td>  
			         	@else
			         	<td style="padding: 1.5px; text-align: right;"><b>{{number_format((($totSaldoPromDir+$totSaldoPromInd)/($totpptoDir+$totpptoInd))*100,0,'.',',')}}%</b></td>  
			         	@endif
			         	
			         </tr>
			          @foreach ($resumenJefes as $resumenJefe)			    	 
			    	 @if($resumenJefe["TIPO_PRODUCTO"]=="TOTAL")
			    	 <tr class="rowsTotal" style="display: none;">
			    	 	<td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["META"]/$factor,0,'.',',')}}</td>
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["SALDO_PROMEDIO"]/$factor,0,'.',',')}}</td>  	
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["GAP"]/$factor,0,'.',',')}} 
			            	<i class="fa fa-circle" style="color: {{\App\Entity\BE\SemaforosEnote::getColorSemaforoCertero($resumenJefe["AVANCE"]/100)}}"></i>
			            </td> 
			            <td style="padding: 1.5px; text-align: right;">{{number_format($resumenJefe["AVANCE"],0,'.',',')}}%</td> 			            
			          </tr>
			         @endif
			         @endforeach		
			    </tbody>
		</table>
	</div>	
</div>			

<script type="text/javascript">
	
    $(document).ready(function(){
	  $( ".cabDirectas" ).click(function() {               
               display = $('.rowsDirectas').css('display');

               if(display=="none"){
                    $('.rowsDirectas').css('display','');
               }else{
                    $('.rowsDirectas').css('display','none');
               }               
        });
        $( ".cabIndirectas" ).click(function() {
               display = $('.rowsIndirectas').css('display');

               if(display=="none"){
                    $('.rowsIndirectas').css('display','');
               }else{
                    $('.rowsIndirectas').css('display','none');
               }               
        });
         $( ".cabTotal" ).click(function() {
               display = $('.rowsTotal').css('display');

               if(display=="none"){
                    $('.rowsTotal').css('display','');
               }else{
                    $('.rowsTotal').css('display','none');
               }               
        });
    });
</script>