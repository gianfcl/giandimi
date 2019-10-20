$(document).ready(function() {
    $('#html5Form').formValidation();      
    $('#agregar').click(buscarLead);
    $('#btn_asignar').click(asignarLeads);
    $('#btn_asignar_cancelar').click(cancelarAsignacion);
    setTypeaheadEN()
    tablaLeadsReset()
});

var contadorLeads = 0;
var leads = new Array();
var en = {};
var citasEN = [];

var buscarLead = function() {
    var num_doc = $("#num_doc").val()
    var nom_cli = $("#nom_cli").val()

    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: "reasignacionConsultar",
        data: {
            num_doc: num_doc 
        },
        success: agregarLead
    })
}

var agregarLead = function(result) {
    if (result.length == 0){
        return null;
    }

    console.log(result)

    var txtCliente = "RUC: " + result.NUM_DOC + "\n" + "Empresa: " + result.NOMBRE_CLIENTE
    var txtEjecutivo = "Registro: " + result.REGISTRO_EN + "\n" + "Ejecutivo: " + result.NOMBRE
    var txtUbicacion = "Zonal: " + (result.ZONAL == null ? "-": result.ZONAL) + "\n" +
                       "Tienda: " + (result.TIENDA == null ? "-": result.TIENDA) + "\n" + 
                       "Distrito: " + (result.DISTRITO == null ? "-": result.DISTRITO)
    var txtCita = result.FECHA_CITA == null ? 'No hay citas progamadas' : result.FECHA_CITA
    var txtCanal = result.CANAL_ACTUAL

    leads.push(result.NUM_DOC);
    var fechaValida = verificarCita(result)
    contadorLeads += 1;

    if (contadorLeads == 1) {
        $("#tablaLeadsBody").empty()
    }

    $("#tablaLeadsBody")
        .append($('<tr>')
            .attr({
                id: contadorLeads.toString()
            })
            .append($('<td>')
                .text(contadorLeads.toString())
            )
            .append($('<td>')
                .text(txtCliente)
                .css('white-space', 'pre')
            )
            .append($('<td>')
                .text(txtEjecutivo)
                .css('white-space', 'pre')
            )
            .append($('<td>')
                .text(txtUbicacion)
                .css('white-space', 'pre')
            )
            .append($('<td>')
                .text(txtCita)
                .css('background-color', fechaValida? '': '#dc3545')
                .css('color', fechaValida? '': 'white')
            )
            .append($('<td>')
                .text(txtCanal)
            )
            .append($('<td>')
                .append($('<button>')
                    .addClass("btn btn-danger")
                    .text("Quitar")
                    .click(quitarLead)
                )
                .append(fechaValida? null: $('<button>')
                    .addClass("btn btn-primary")
                    .text("Reagendar")
                    .click(showModalReagendar)
                )
            )
        );
}

var quitarLead = function(){
    contadorLeads -= 1;

    var row = $(this).parent().parent()

    var index = parseInt(row.attr('id'))
    leads.splice(index-1, 1)

    row.remove()

    if (contadorLeads == 0) {
        tablaLeadsReset()
    }

    return null;
}

var asignarLeads = function(){
    $.ajax({
        type: "POST",
        url: APP_URL + "reasignacionAsignar",
        data: {
            leads: JSON.stringify(leads),
            en: JSON.stringify(en),
            "_token": $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            console.log("yeah")
        }
    })
}

var tablaLeadsReset = function(){
    $("#tablaLeadsBody")
        .append($("<tr>")
            .append($("<td>")
                .text("No hay leads agregados")
                .attr({
                    colspan: 7
                })
                .css("text-align", "center")
            )    
        )
}

var setTypeaheadEN = function(ejecutivos){
    var engine = new Bloodhound({
        remote: {
            url: 'reasignacionBuscarEN?registro_en=%Q%',
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

    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: "getHorarioEN",
        data: {
            en: en.REGISTRO
        },
        success: function(result){
            citasEN = result
        }
    })

    $("#busqueda_en_div").hide()
    $("#ejecutivo_asignado")
        .text(en.NOMBRE)
    $("#ejecutivo_asignado_div")
        .show()
    $("#btn_asignar")
        .removeClass("disabled")
        .text("Asignar a " + sg.NOMBRE)
    $("#btn_asignar_cancelar").show()
}

var cancelarAsignacion = function() {
    en = {}
    $("#busqueda_en_div").show()
    $("#busqueda_en").val("")
    $("#ejecutivo_asignado_div")
        .hide()
    $("#btn_asignar")
        .addClass("disabled")
        .text("Asignar")
    $("#btn_asignar_cancelar").hide()
}

var verificarCitas = function() {

}

var verificarCita = function(cita) {
    for (var i = citasEN.length - 1; i >= 0; i--) {
        if ((citasEN[i].FECHA_CITA.substring(0, 9) == cita.FECHA_CITA.substring(0, 9))
            && (citasEN[i].TIPO_HORARIO == cita.TIPO_HORARIO)) {
            console.log("nope")
            return false //si se cruza
        }
    }
    console.log("ok")
    return true
}

var showModalReagendar = function() {
    console.log("uhm")
    $("#modalReprogramacion").modal('show')
}