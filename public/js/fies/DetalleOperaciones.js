function dateParse(date){


    var year = date.substr(0,4);
    var month= date.substr(5,2);
    var monthNames = ["initial","Ene", "Feb", "Mar", "Abr", "May", "Jun",
    "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    var dateDesembolso = monthNames[month]+"-"+year;
    return dateDesembolso;

}
$(document).ready(function() {

     /* $('select').attr("disabled",true);
    $('input').attr("disabled",true);
    $('.tblCuotas button').attr("disabled",false);
    $('.input button').attr("disabled",false);*/


    $('textarea').css("resize","none");
    $('.contEstaciones').find('select').attr("disabled","false");
    $('.contEstaciones').find('input').attr("disabled","false");
    $('.contEstaciones').find('textarea').attr("disabled","false");

    $('.contDesembolCronograma .tile_count').find('select').attr("disabled","false");
    $('.contDesembolCronograma .tile_count').find('input').attr("disabled","false");
    $('.contComisionCronograma .tile_count').find('select').attr("disabled","false");
    $('.contComisionCronograma .tile_count').find('input').attr("disabled","false");
    

    var mesProbableDesembolso = $('#mesProbableDesembolso').attr("value");
    $('#mesProbableDesembolso').val(mesProbableDesembolso);
    var añoProbableDesembolso = $('#añoProbableDesembolso').attr("value");
    $('#añoProbableDesembolso').val(añoProbableDesembolso);
    var mesProbableDesembolso = $('#mesProbableCuota').attr("value");
    $('#mesProbableCuota').val(mesProbableDesembolso);
    var añoProbableDesembolso = $('#añoProbableDesembolso').attr("value");
    $('#añoProbableDesembolso').val(añoProbableDesembolso);
    var monedaDesembolso = $('#monedaDesembolso').attr("value");
    $('#monedaDesembolso').val(monedaDesembolso);
    var monedaComision = $('#monedaComision').attr("value");
    $('#monedaComision').val(monedaComision);


    $(".formatInputNumber").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value ) {
                return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{3})$/, '$1,$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });

    $('.chkSinExito').click(function(){
      if (this.checked)  { 
        $(this).parents('.form-group').find('select').attr("disabled",false); 
        $(this).parents(".tab-pane").find('.txtComentario').attr("disabled",false); 
    }
    else {
        $(this).parents('.form-group').find('select').attr("disabled",true); 
        $(this).parents(".tab-pane").find('.txtComentario').attr("disabled",true);  }                   
    });


        	//iniciar el datepicker()
            $('.dfecha').each(function() {
                $(this).datepicker({
                    maxViewMode: 1,
                    daysOfWeekDisabled: "0,6",
                    language: "es",
                    autoclose: true,
                    startDate: "-365d",
                    endDate: "+365d",
                    format: "yyyy-mm-dd"
                }).on('changeDate', function (e) {
                    //$(this).closest('form').formValidation('revalidateField', 'hora');
                });
                //.datepicker('setDate', new Date())
            });

            //ediciones


            $(".btnEdProducto").click(function(){  
                $(this).parents(".tile_stats_count").find('.btnEdProducto').css("display","none");        
                //$(this).parents(".tab-pane").findbntEditarS('button').attr("disabled",false);        
                $(this).parents(".tile_stats_count").find('select').attr("disabled",false); 
                $(this).parents(".tile_stats_count").find('.btnOkProducto').css("display",""); 
                $(this).parents(".tile_stats_count").find('.btnCaProducto').css("display","");
                //$(this).parents(".tile_stats_count").find('select').css("display","none"); 

            }); 

            $(".btnCaProducto").click(function(){   
                $(this).parents(".tile_stats_count").find('.btnEdProducto').css("display","");        
                //$(this).parents(".tab-pane").find('button').attr("disabled",false);        
                $(this).parents(".tile_stats_count").find('select').attr("disabled",true); 
                $(this).parents(".tile_stats_count").find('.btnOkProducto').css("display","none"); 
                $(this).parents(".tile_stats_count").find('.btnCaProducto').css("display","none");
                //$(this).parents(".tile_stats_count").find('select').css("display","none"); 

            }); 


            $(".bntEditarS").click(function(){   
                $(this).parents(".tab-pane").find('select').attr("disabled",false);        
                //$(this).parents(".tab-pane").find('button').attr("disabled",false);        
                $(this).parents(".tab-pane").find('input').attr("disabled",false); 
                //$(this).parents(".tab-pane").find('textarea').attr("disabled",false); 
                $(this).parents(".tab-pane").find('.btnGuardarS').css("display",""); 
                $(this).parents(".tab-pane").find('.btnCancelarS').css("display","");
                $(this).parents(".tab-pane").find('.bntEditarS').css("display","none"); 


                if( $(this).parents(".tab-pane").find('.chkSinExito').prop('checked') ) {  
                    $(this).parents(".tab-pane").find('.listSinExito').attr("disabled",false);       
                    $(this).parents(".tab-pane").find('textarea').attr("disabled",false);  }
                    else{ 
                        $(this).parents(".tab-pane").find('.listSinExito').attr("disabled",true);
                        $(this).parents(".tab-pane").find('textarea').attr("disabled",true);  }

                        


                    }); 

            $(".btnCancelarS").click(function(){            
                $(this).parents(".tab-pane").find('select').attr("disabled",true);        
                        //$(this).parents(".tab-pane").find('button').attr("disabled",true);        
                        $(this).parents(".tab-pane").find('input').attr("disabled",true); 
                         //$(this).parents(".tab-pane").find('.txtComentario').attr("disabled",true); 
                         $(this).parents(".tab-pane").find('.btnGuardarS').css("display","none"); 
                         $(this).parents(".tab-pane").find('.btnCancelarS').css("display","none"); 
                         $(this).parents(".tab-pane").find('.bntEditarS').css("display",""); 

                     }); 

            $("#btnGuardarS").click(function(){                    
                            /*$(this).closest("div").find('select').attr("disabled",true);

                            $(this).closest("div").find('input').attr("disabled",true);
                            $(this).closest("div").find('button').css("display","");
                            $(this).closest("div").find('button').next('button').css("display","none");
                            $(this).closest("div").find('button').next('button').next('button').css("display","none");*/

                        });

            $(".bntEditar").click(function(){  
              console.log("hey");          
              $(this).parents(".x_panel").find('select').attr("disabled",false);        
              $(this).parents(".x_panel").find('button').attr("disabled",false);        
              $(this).parents(".x_panel").find('input').attr("disabled",false); 
              $(this).parents(".x_panel").find('.btnGuardar').css("display",""); 
              $(this).parents(".x_panel").find('.btnCancelar').css("display",""); 
              $(this).parents(".x_panel").find('.btnNevaCuota').css("display",""); 
              $(this).css("display","none");

          }); 

                       /*$(".btnCancelar").click(function(){    
                        $(this).parents(".x_panel").find('select').attr("disabled",true);        
                        $(this).parents(".x_panel").find('button').attr("disabled",true);        
                        $(this).parents(".x_panel").find('input').attr("disabled",true); 
                        $(this).parents(".x_panel").find('.btnGuardar').css("display","none"); 
                        $(this).parents(".x_panel").find('.btnCancelar').css("display","none"); 
                        $(this).parents(".x_panel").find('.btnNevaCuota').css("display","none"); 
                        $(this).parents(".x_panel").find('.btnEditar').css("display",""); 

                    }); */

                    $('.btnEditarDesCom').click(function(){
                        $(this).css("display","none");
                        $(this).parents('.tile_count').find('select').attr("disabled",false);
                        $(this).parents('.tile_count').find('button').attr("disabled",false);
                        $(this).parents('.tile_count').find('input').attr("disabled",false);
                        $(this).parents('.tile_count').find('.btnOkDesCom').css("display","");
                        $(this).parents('.tile_count').find('.btnCancelarDesCom').css("display","");     
                    });

                    $('.btnCancelarDesCom').click(function(){
                        $(this).css("display","none");
                        $(this).parents('.tile_count').find('select').attr("disabled",true);
                        $(this).parents('.tile_count').find('button').attr("disabled",true);
                        $(this).parents('.tile_count').find('input').attr("disabled",true);
                        $(this).parents('.tile_count').find('.btnOkDesCom').css("display","none");
                        $(this).parents('.tile_count').find('.btnEditarDesCom').css("display","");     
                    });

                	//fin ediciones

                    /************************* NUEVA CUOTA-DESEMBOLSO ********************************/
                    // Cuando se abre el modal limpiamos el formulario de contacto
                    $('.btnNevaCuota').click(function () {    

                        var tipoCuota = $(this).attr("id")

                        $('#txtMonto').val("");
                        $('#txtMonto').val("");
                        $('#inMonto').attr("disabled",false);
                        $('#cboMesProbableMonto').attr("disabled",false);        
                        $('#tipoOperacionAdd').val($(this).parents('.row .tile_count').find('.tipoOperacion').val());  
                        

                        
                        if(tipoCuota=="btnNevaCuotaDesembolso") { $('.valorCese').text("DESEMBOLSADO"); }
                        else { $('.valorCese').text("COBRADO");} 
                        
                        $('#modalNuevoCuota').modal();
                        //initializeFormValidationContacto();
                    });        

                    $('#btnGuardarCuota').click(function () {   
                        $('#modalNuevoCuota').modal('hide');    
                    });      

                    $('.cerrarEstacion').click(function () {
                        //$('#cboMesProbableMonto').val("Mes");
                        //$('#lblMonto').text("Monto");
                        $('#modalCerrarEstacion').modal();
                        //initializeFormValidationContacto();
                    }); 




                    $('.btnEditarCuota').click(function(){

                        var monto = $(this).parents('tr').find('.montoD').text();
                        
                        //var fechaDesembolso = $(this).parents('tr').find('.estadoD').text();
                        var fecha = $(this).parents('tr').find('.fechaD').text();
                        var codOperacion= $(this).parents('div').find('#codOperacionDes').val();
                        var estado = $(this).parents('tr').find('.estadoD').text();
                        var registro =$(this).parents('tr').attr("class");
                        var tipo = $(this).parents('tr').find('.tipo').val();


                        
                        if(tipo=="DESEMBOLSO") 
                        {
                           $('.valorCese').text("DESEMBOLSADO");
                           $('.valorCese').attr("value","DESEMBOLSADO"); 
                       }
                       else { 
                        $('.valorCese').text("COBRADO");
                        $('.valorCese').attr("value","COBRADO"); 
                    } 
                    $('#inMontoA').val(monto);
                    $('#inMontoA').attr("disabled",false);
                    $('#cboMesProbableA').attr("disabled",false);
                    $('#cboMesProbableA').val(fecha);
                    $('#inFecha').val(fecha);
                    $('#selEstadoA').val(estado);
                    $('#inTipoCuota').val(tipo);
                    $('#modalEditarCuota').modal();
                });                                         



                    $('.btnQuitarCuota').click(function(){

                        var fechaDesembolso = $(this).parents('tr').find('.fechaD').text();
                        var codOperacion=$(this).parents('div').find('#codOperacionDes').val();
                        var tipoOperacion =$(this).parents('tr').find('.tipo').val();
                        var registro =$(this).parents('tr').attr("class");            
                /*console.log(registro);
                console.log("Codigo de Operación "+codOperacion);
                console.log("Fecha de Desembolso " +fechaDesembolso);
                console.log(APP_URL+"fies/ejecutivo/eliminar-cuota?fecha="+fechaDesembolso+"&codOperacion="+codOperacion);*/
                $.ajax({
                    type: "GET",
                    contentType: "application/json",
                    url: APP_URL+"fies/ejecutivo/eliminar-cuota?fecha",//="+fechaDesembolso+"&codOperacion="+codOperacion,
                    //dataType: "json",
                    data: {

                        fecha: fechaDesembolso,
                        codOperacion : codOperacion,
                        tipo : tipoOperacion 
                    },
                    success: function (response){                   
                        if(response){

                            $('.'+registro).css("display","none");
                        }
                    },
                }); 
            });



                    /************************* NUEVA OPERACION ********************************/
                // Cuando se abre el modal limpiamos el formulario de contacto
                $('#btnNuevaOperacion').click(function () {
                    //$('#cboMesProbableMonto').val("Mes");
                    //$('#lblMonto').text("Monto");

                    $('#inRuc').val("");
                    $('#inCU').val("");
                    $('#inRazonSocial').val("");
                    $('#inEFies').val("");
                    $('#inMProbable').val("");
                    $('#inDesembolso').val("");
                    $('#lblMontoEqu').text("= 0.00");
                    $('#inComision').val("");
                    $('#inComisionPorcentaje').val("");
                    $('#inComisionSoles').val("");
                    $('#inComisionValor').val("");

                    $('#lblComisionEqui').text("= 0.00");
                    $('#inRazonSocial').removeAttr('readonly');
                    $('#inCU').removeAttr('readonly');      
                    $('#modalNuevaOperacion').modal();
                    //initializeFormValidationContacto();
                });   


                 //Consultar Cliente
                 $('#btnBuscarCliente').click(function (){
                    var ruc = $(this).parents('.modal-body').find('#inRuc').val()
                    
                    $.ajax({
                        type: "GET",
                        contentType: "application/json",
                            url: APP_URL +"fies/ejecutivo/consultar-cliente",//="+fechaDesembolso+"&codOperacion="+codOperacion,
                            //dataType: "json",
                            data: {
                                ruc: ruc
                            },
                            success: function (response){                   
                                if(response){   

                                    if(typeof response["COD_UNICO"] != "undefined"){

                                        $('#inCU').val(response["COD_UNICO"]);
                                        $('#inRazonSocial').val(response["RAZONSOCIAL"]);
                                        $('#sectorEconomicoOperacion').val(response["SECTOR_ECONOMICO"]);
                                        $('#grupoEconomicoOperacion').val(response["GRUPOECONOMICO"]);
                                        $('#bancaOperacion').val(response["BANCA"]);
                                        $('#segmentoEconomicoOperacion').val(response["SEGMENTO"]);
                                        $('#zonaOperacion').val(response["ZONAL"]);
                                        $('#regEjNegocioOperacion').val(response["LOGIN"]);
                                        $('#inRazonSocial').attr('readonly','readonly');
                                        $('#inCU').attr('readonly','readonly');
                                        $('#alertClienteWorng').css("display","none");;
                                    }else{                                        
                                       $('#alertClienteWorng').css("display","");
                                       $('#inRazonSocial').removeAttr('readonly');
                                       $('#inCU').removeAttr('readonly');
                                       $('#inCU').val('');
                                       $('#inRazonSocial').val('');
                                       $('#sectorEconomicoOperacion').val('');
                                       $('#grupoEconomicoOperacion').val('');
                                       $('#bancaOperacion').val('');
                                       $('#segmentoEconomicoOperacion').val('');
                                       $('#zonaOperacion').val('');
                                       $('#regEjNegocioOperacion').val('');
                                   }
                               }
                           },
                       }); 
                }); 


                 $("#monedaComision").change(function () {

                    var tipo = $('#monedaComision').val();  
                    if(tipo=="procentual"){
                        $('#inpComision').val('');    
                    }

                });






             });



