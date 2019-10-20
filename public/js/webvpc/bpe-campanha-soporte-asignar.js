$(document).ready(function() {
    $('#agregar').click(buscarLead);
    $('#btnCancelar').click(cancelarAsignacion);
    setTypeaheadEN();
});

var leads = new Array();
var en = {};

var buscarLead = function() {
    var num_doc = $("#num_doc").val();

    if ($.trim(num_doc).length < 6){
        alert('Ingrese un DNI/RUC válido');
        return;
    }

    if (leads.indexOf(num_doc) !== -1){
        alert('El lead seleccionado ya ha sido agregado');
        return;
    }
    if ($("#txtEjecutivo").val() === ''){
        alert('Ingresa primero el registro del ejecutivo de negocio');
        return;    
    }

    $('#agregar').prop('disabled', true);
    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: APP_URL + "/bpe/soporte/consultar-lead",
        data: {
            num_doc: num_doc,
            ejecutivo: $("#txtEjecutivo").val()
        },
        success: function (response) {
            if(response['status'] == 'ok'){
                agregarLead(response['data']);
            }else{
                alert(response['message']);
            }
            $('#agregar').prop('disabled', false);
        },
    });
}
   

function agregarLead(result) {

    if (leads.length == 0){
        $("#tablaLeadsBody").empty();
    }

    leads.push(result.NUM_DOC);

    row = $('#templateRowLead tr').clone();
    row.find('.rowNumero').html((leads.length).toString());
    row.find('.rowDocumento').html(result.TIPO_DOCUMENTO + ': ' + result.NUM_DOC);
    row.find('.rowCliente').html(result.NOMBRE_CLIENTE);
    row.find('.rowActividad').html(result.ACTIVIDAD);
    row.find('input').val(result.NUM_DOC);
    $('#num_doc').val('');
    
    $("#tablaLeadsBody").append(row);
    checkAsignacion();
}

$('#tablaLeadsBody').on('click','.btnQuitar',function(){
    var row = $(this).closest('tr');
    var lead = row.find('.rowDocumento').html();
    leads.splice(leads.indexOf(lead), 1);
    row.remove();
    if (leads.length == 0) {
        tablaLeadsReset();
    }
    checkAsignacion();
});

var tablaLeadsReset = function(){
    $("#tablaLeadsBody")
        .append($("<tr>")
            .append($("<td>")
                .text("No hay leads agregados")
                .attr({
                    colspan: 5
                })
                .css("text-align", "center")
            )    
        )
}

var setTypeaheadEN = function(ejecutivos){
    var engine = new Bloodhound({
        remote: {
            url: APP_URL + '/bpe/soporte/consultar-ejecutivo?registro_en=%Q%',
            wildcard: '%Q%'        
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });
    $('#busqueda_en').typeahead({
        minLength: 3
    }, {
        display: 'NOMBRE',
        source: engine.ttAdapter(),
        name: 'resultadosEN',
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados</div></div>'
            ],
            suggestion: function (data) {
                return '<div class="list-group-item">' + data.REGISTRO + " - " + data.NOMBRE + '</div>'
            }
        }
    })

    $('.typeahead').bind('typeahead:select', ejecutivoSeleccionado)

    $('.twitter-typeahead').css("width", "100%")
}

var ejecutivoSeleccionado = function(ev, sg){
    en = sg
    /*
    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: "bpe/gt/consultar-horario-ejecutivo",
        data: {
            en: en.REGISTRO
        },
        success: function(result){
            citasEN = result
        }
    })
    */

    $("#txtEjecutivo").val(en.REGISTRO);
    $("#busqueda_en").val(en.REGISTRO + ' - ' + en.NOMBRE).attr('disabled','disabled').css("background-color", "");
    $("#btnCancelar").removeClass("hidden");
    checkAsignacion();
}

var cancelarAsignacion = function() {
    en = {}
    leads = new Array();
    $("#busqueda_en").val('').removeAttr('disabled');
    $("#btnCancelar").addClass("hidden");
    $("#tablaLeadsBody > tr").remove()
    $('#txtEjecutivo').val('');
    checkAsignacion();
}

function checkAsignacion(){
    if (leads.length > 0 && $('#txtEjecutivo').val() !== ''){
        $('#btnAsignar').removeAttr('disabled');
    }else{
        $('#btnAsignar').attr('disabled','disabled');
    }
}