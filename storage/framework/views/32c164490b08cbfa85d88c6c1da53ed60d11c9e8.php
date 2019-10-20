<body bgcolor="#ffffff" onload="cargar()">
<form name="datos" method="get">
<input type="hidden" name="indicador" id="indicador" value="0">
<input type="hidden" name="txtBanco" id="txtBanco" value="0011">


<div id="consulta" style="display: ">
  
</div>

<div id="respuesta" style="display: ">

<table border="0" align="left" style="max-width:900px">
    <tbody><tr>
      <td width="35" align="center"><p class="t1"><span style="color:#383dba">Entidad</span></p></td>
      <td width="6">&nbsp;</td>
      <td width="45" align="center"><p class="t1"><span style="color:#383dba">Oficina</span></p></td>
      <td width="6">&nbsp;</td>
      <td width="80" align="center"><p class="t1"><span style="color:#383dba">Cuenta</span></p></td>
      <td width="75">&nbsp;</td>
    </tr>
    <tr align="center" valign="middle">
      <td align="center">
      <p class="n1">0011</p></td>
      <td align="center">-</td>
      <td align="center"><input name="txtOficina" type="text" id="txtOficina" size="4" maxlength="4" onkeypress="return validKey(INT_PATTERN)" onkeyup="return saltarOficina()" value="0015"></td>
      <td align="center">-</td>
      <td align="center"><input name="txtCuenta" type="text" id="txtCuenta" size="10" maxlength="10" onkeypress="return validKey(INT_PATTERN)" onkeyup="return saltarCuenta()" value="1425368752"></td>
      <input name="txtCci" type="hidden" id="txtCci" size="1" maxlength="2" onkeypress="return validKey(INT_PATTERN)" onkeyup="return saltarCci()" value="50">
      <td align="left" valign="middle">
        <input type="button" name="btnConvertidor" id="btnConvertidor" value="Convertir" onclick="javascript:validar(this.form);">
</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
     <tr height="25px">
	  <td colspan="8" valign="top"><p class="t2">
      <b>
      	<span style="color:#383dba">Su cuenta Interbancaria CCI es:
      	</span>
      </b>
      </p></td>
    </tr>
    <tr>
      <td colspan="8"><p class="t3">
      	</p><div id="nuevoNroCuenta"><h3>011 - 015 - 001425368752  - 50</h3></div>      	
	   </td>
    </tr>
    <tr>
      <td colspan="8" align="center"><a href="javascript:limpiar();"> Limpiar</a></td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
  </tbody></table>
  
</div>



</form>

<div style="clear: both; display: block;"></div></body>

<script type="text/javascript" src="https://www.bbvacontinental.pe/fbin/js/iframeResizer.contentWindow.min.js"></script>
<script>
(document.all) ? document.write('<link rel=stylesheet type="text/css" href="https://extranetperu.grupobbva.pe/Contiweb/paginas/lib/tlbsie.css">') : document.write('<link rel=stylesheet type="text/css" href="https://extranetperu.grupobbva.pe/Contiweb/paginas/lib/tlbsnn.css">')

function getDigitoUno(banco,oficina){
	var num = banco + oficina;
	pesos = new Array(0,1,2,1,0,2,1,2);
	var suma = 0;
	var digitoUno = null;
	var res = 0;
	
	for(var i=0; i< num.length;i++)
	{
		digito = parseInt(num.substring(i,i+1));
		var res = parseInt(digito * pesos[i]);
		if(res >= 10)
		{
			var primerNum = parseInt(res / 10);
			var segundoNum = parseInt(res % 10);
			res = primerNum + segundoNum;	
		}
		suma = suma + res;
	}
	if ((suma % 10) != 0)
		suma = 10 - (parseInt(suma % 10));
	else
		suma = parseInt(suma % 10);
		
	digitoUno = suma + 	"";
	
	return digitoUno;
}

function getDigitoDos(control,cuenta){
	var num = control + cuenta;console.log(num);
	var pesos = new Array(1,2,1,2,1,2,1,2,1,2);
	var suma = 0;
	var digitoDos = null;
	var res = 0;
	
	for(i=0; i < num.length;i++)
	{
		digito = parseInt(num.substring(i,i+1));
		res = parseInt(digito * pesos[i]);
		if(res >= 10)
		{
			primerNum = parseInt(res / 10);
			segundoNum = parseInt(res % 10);
			res = parseInt(primerNum + segundoNum);	
		}
		suma = suma + res;
	}console.log(suma);
	if ((suma % 10) != 0)
		suma = 10 - (parseInt(suma % 10));
	else
		suma = parseInt(suma % 10);
	console.log(suma);
	
	digitoDos = suma+"";
	return digitoDos;
}

function obtenerCci(form){
	var txtOficina = document.getElementById('txtOficina');
	var txtCuenta = document.getElementById('txtCuenta');
	//var txtCci = document.getElementById('txtCci');
	
	banco    = document.getElementById("txtBanco").value;
	oficina  = txtOficina.value;
	dCuenta  = txtCuenta.value;
	d1 = getDigitoUno(banco, oficina);
	d2 = getDigitoDos (dCuenta.substring(0, 2), dCuenta.substring(2));
	dControl = d1 + d2;
	document.getElementById('txtCci').value = dControl;
	
	control  = dCuenta.substring(0,2);
	cuenta   = dCuenta.substring(2);
	
	//digitoDos = getDigitoDos(control, cuenta);
	//banco=banco.substring(1,4);
	//oficina=oficina.substring(1,4);
	//cuenta="00" + dCuenta;	
	enviar(form);		

}

function validar(form){
	var txtOficina = document.getElementById('txtOficina');
	var txtCuenta = document.getElementById('txtCuenta');
	//var txtCci = document.getElementById('txtCci')

	if(txtOficina.value.length < 4){
 		alert('Debe de ingresar el Código de Oficina'); 
 		txtOficina.focus();
 		txtOficina.select();		
	 	//enviarError();
 		return false;
 	}
 	
 	if(!esNumero(txtOficina.value)){
 		alert('Debe de ingresar solo valores numéricos'); 		
 		txtOficina.focus();
 		txtOficina.select(); 		
	 	//enviarError();
 		return false;
 	}
	 
	if(txtCuenta.value.length < 10) {
		alert('Debe de ingresar el Número de Cuenta');
		txtCuenta.focus();
 		txtCuenta.select(); 
	  	//enviarError();
		return false;
	 }

 	if(!esNumero(txtCuenta.value)){
 		alert('Debe de ingresar solo valores numéricos'); 		
 		txtCuenta.focus();
 		txtCuenta.select(); 		
	 	//enviarError();
 		return false;
 	}

	obtenerCci(form);
}

function enviar(form){
	//if(validar()){
		//response.sendRedirect("convertidorCCI_resultado.jsp?txtBanco=333"); 
		form.action="convertidorCCI.jsp?" ;
		form.indicador.value = "1";
		//alert("pasooo");
		//form.submit();
	//}
}

/*function enviarError(){
		window.location.href = "convertidorCCI.jsp";
}*/

/*function limpiar(){
	document.getElementById('txtOficina').value='';
	document.getElementById('txtCuenta').value='';
	document.getElementById('txtCci').value='';
	window.location.href = "convertidorCCI.jsp";
}*/

function mostrar(){
	//alert("Indicador");
	//alert(document.getElementById("indicador").value);
	if (document.getElementById("indicador").value == "0") {
		/*document.getElementById("consulta").display=" ";
		//document.getElementById("consulta").display='inline';
		document.getElementById("respuesta").display='none';
		*/
		document.getElementById("consulta").style.visibility = 'visible';
		document.getElementById("respuesta").style.visibility = 'hidden';
	} else {
		/*document.getElementById("consulta").display=none;
		//document.getElementById("respuesta").display='none';
		document.getElementById("respuesta").display='inline';
		*/
		document.getElementById("consulta").style.visibility = 'hidden';
		document.getElementById("respuesta").style.visibility = 'visible';
		
	}
}
// ?indicador=0&txtBanco=0011&txtOficina=&txtCuenta=&txtCci=&txtOficina=&txtCuenta=&txtCci= uuu
//var Parametros = new Array(10); 
var Parametros = new Array(); 

function cargar(){
	var nroCuentaMostrar = "";
	
	var ListaParametros=document.location.search.split("&");
	//alert(ListaParametros[0]);
	
	document.getElementById('txtOficina').focus();	
	
    for (var i=0; i<ListaParametros.length; i++) {
       //separa nombre valor
       /*texto=new Array();
       alert(ListaParametros[i]);
       
       texto=ListaParametros[i].split("=");
       y=0;
       Parametros[i,y]=texto[0];
       alert(Parametros[i,y]);
       y=y+1
       Parametros[i,y]=texto[1];
       alert(Parametros[i,y]);
       */
       texto=new Array(2);
       texto = ListaParametros[i].split("=");
       Parametros[i] = texto;       
	}
	
	if(Parametros.length > 4) {		
		var valorCuenta = Parametros[3][1];
		
		if(valorCuenta != "") {
			valorCuenta = valorCuenta.substring(0, 10) + ' ' +  valorCuenta.substring(11); 
		}
		
		nroCuentaMostrar = "<h3>" + Parametros[1][1].substring(1) + ' - ' + Parametros[2][1].substring(1) + ' - ' + 
			Parametros[1][1].substring(0, 1) + Parametros[2][1].substring(0, 1) +
			valorCuenta	+ ' - ' + 
			Parametros[4][1] + "</h3>";
		document.getElementById('nuevoNroCuenta').innerHTML = nroCuentaMostrar;
	}
}

var INT_PATTERN=/\d{0,}/;

function validKey(format){	
	el = event.srcElement;	
	
	tecla = (document.all) ? event.keyCode : event.which; 

	if(tecla >= 97 && tecla <= 122) {
		event.keyCode -= 32;
	}
	
	if(tecla == 241) {
		event.keyCode = 209;
	}
	
	str1 = el.value;
	rango1 = document.selection.createRange().duplicate();
	while(rango1.expand("character"));

	var text = str1.substr(0,str1.length-rango1.text.length)
		+ String.fromCharCode(event.keyCode) + rango1.text ;
	var arr = format.exec(text);
	return (arr!=null && text==arr[0]);
}

var lNumeros='1234567890';

function esNumero(o){
	var valid = '' + lNumeros;
	
	for(i=0; i<o.length; i++){
		if(valid.indexOf(o.substring(i,i+1))<0)
			return false;
	}
	return true;
}

function saltarOficina(){
	var txtOficina = document.getElementById('txtOficina');
	var txtCuenta = document.getElementById('txtCuenta');
	var long = txtOficina.value.length;
	
			
		if(long == 4) {
			txtOficina.blur();
			txtCuenta.focus();				
		}
	
	
	return true;
}

function saltarCuenta(){
	var txtCuenta = document.getElementById('txtCuenta');
	var btnConvertidor = document.getElementById('btnConvertidor');
	var long = txtCuenta.value.length;
	if(long == 10) {
			btnConvertidor.focus();		
		}
	return true;
}

</script>