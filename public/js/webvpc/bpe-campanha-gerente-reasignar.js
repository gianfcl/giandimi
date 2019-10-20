leads = []
en = {}
citasEN = []
citasEnConflicto = false
nroCitasEnConflicto = 0

$(document).ready(function() {
    resetVariables()
    $('#agregar').click(buscarLead);
    $('#btnCancelar').click(cancelarAsignacion);
    setTypeaheadEN()
});

var resetVariables = function() {
    leads = new Array();
    en = {};
    citasEN = [];

    citasEnConflicto = false
    nroCitasEnConflicto = 0
}

var buscarLead = function() {
    var num_doc = $("#num_doc").val();
    $("#num_doc").val('')

    if ($.trim(num_doc).length < 6){
        alert('Ingrese un DNI/RUC válido');
        return;
    }

    if (leads.indexOf(num_doc) !== -1){
        alert('El lead seleccionado ya ha sido agregado');
        return;
    }

    $('#agregar').prop('disabled', true);
    $.ajax({
        type: "GET",
        contentType: "application/json",
        url: APP_URL + "/bpe/tools/consultar-lead",
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

    row.find('.lblNumero').text((leads.length).toString());
    row.find('.lblTipoDocumento').text(result.TIPO_DOCUMENTO);
    row.find('.lblDocumento').text(result.NUM_DOC);
    row.find('.lblLead').text(result.NOMBRE_CLIENTE);
    row.find('.lblCanal').text(result.CANALES);

    // Si hay ejecutivo
    if (result.EN_REGISTRO){
        row.find('.divAreaEjecutivo').removeClass("hidden");
        row.find('.lblRegistro').text(result.EN_REGISTRO);
        row.find('.lblEjecutivo').text(result.EN_NOMBRE);
    }else{
        row.find('.divAreaSinEjecutivo').removeClass("hidden");
    }

    // Si hay tienda
    if (result.TIENDA){
        row.find('.divAreaTienda').removeClass("hidden");
        row.find('.lblTienda').text(result.TIENDA);
        row.find('.lblZona').text(result.ZONAL);
    }else{
        row.find('.divAreaSinTienda').removeClass("hidden");
    }

    // Si hay Cita
    if (result.ID_CITA !== null){
        row.find('.lblFecha').removeClass('hidden').text(result.FECHA_CITA.substring(0, 10));
        row.find('.lblHora').removeClass('hidden').text(result.FECHA_CITA.substring(11, 16));
        row.find('input[name="cita[]"]').val(result.ID_CITA);

        // Si hay conflicto de cita
        if(hayCruceHorario(result)){
            row.find('.divAreaConflictoCita').removeClass("hidden");
            row.find('.lblFecha').css('color', 'red');
            row.find('.lblHora').css('color', 'red');
            citasEnConflicto = true
            nroCitasEnConflicto = nroCitasEnConflicto + 1
        }

    }else{
        row.find('.lblSinCitas').removeClass('hidden');
    }
    
    row.find('input[name="lead[]"]').val(result.NUM_DOC);

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
                    colspan: 7
                })
                .css("text-align", "center")
            )    
        )
}

var setTypeaheadEN = function(ejecutivos){
    var engine = new Bloodhound({
        remote: {
            url: APP_URL + '/bpe/tools/consultar-ejecutivo?registro_en=%Q%',
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
        url: APP_URL + "/bpe/tools/consultar-horario-ejecutivo",
        data: {
            en: en.REGISTRO
        },
        success: function(result){
            citasEN = result;
        }
    })

    $("#txtEjecutivo").val(en.REGISTRO);
    $("#busqueda_en").val(en.REGISTRO + ' - ' + en.NOMBRE).attr('disabled','disabled').css("background-color", "");
    $("#btnCancelar").removeClass("hidden");
    checkAsignacion();
}

var cancelarAsignacion = function() {
    resetVariables()
    $("#tablaLeadsBody > tr").remove();
    $("#busqueda_en").val('').removeAttr('disabled');
    $("#btnCancelar").addClass("hidden");
    $('#txtEjecutivo').val('');
}

var hayCruceHorario = function(cita) {
    for (var i = citasEN.length - 1; i >= 0; i--) {
        if ((citasEN[i].FECHA_CITA.substring(0, 10) == cita.FECHA_CITA.substring(0, 10))
            && (citasEN[i].TIPO_HORARIO == cita.TIPO_HORARIO)) {
            return true //si se cruza
        }
    }
    return false
}

//Valida formulario
var checkAsignacion = function(){
    if (leads.length > 0 && $('#txtEjecutivo').val() !== '' && citasEnConflicto == 0){
        $('#btnAsignar').removeAttr('disabled');
    }else{
        $('#btnAsignar').prop('disabled', 'disabled');
    }

    
}

/************ REPROGRAMACION DE CITA ******************/
$('#tablaLeads').on('click','.btnReparar', function (e) {
    e.preventDefault();
    initializeFormReparar();
    $('#modalReprogramacion').find('input[name="lead"]').val($(this).closest('tr').find('input[name="lead[]"]').val());
    $('#modalReprogramacion').modal();

});

var initializeFormReparar = function () {
    var today = new Date();
    var lastDate = new Date(today.getFullYear(), today.getMonth(0), 31);
    $("#modalReprogramacion input[name='fecha']").datepicker({
        maxViewMode: 1,
        daysOfWeekDisabled: "0,6",
        language: "es",
        autoclose: true,
        startDate: "+1d",
        endDate: lastDate,
        format: "yyyy-mm-dd"
    }).on('changeDate', function (e) {
        $(this).closest('form').formValidation('revalidateField', 'hora');
    });

    $('#frmReprogramarCita').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            hora: {
                validators: {
                    remote: {
                        message: 'El horario seleccionado ya está ocupado',
                        url: APP_URL + '/bpe/campanha/validator/horarioEjecutivo',
                        data: function (validator, $field, value) {
                            return {
                                //ejecutivo: validator.getFieldElements('ejecutivo').val(),
                                ejecutivo: $('#txtEjecutivo').val(),
                                fecha: validator.getFieldElements('fecha').val(),
                                cita: null
                            };
                        },
                        type: 'GET'
                    }
                }
            }
        }
    }).on('success.form.fv', function (e) {
        //Cuando se aceptar cambio de fecha en formulario
        e.preventDefault();
        var $form = $(e.target),

        //Buscamos la fila del lead a cambiar la fecha en la tabla 
        inputLead = $('#tablaLeads').find(':input[name="lead[]"]').filter(function(){return this.value==$form.find('input[name="lead"]').val()});
        row = inputLead.closest('tr');

        // Ingresamos los nuevos valores de fecha y hora en los campos ocultos
        fecha = $form.find('input[name="fecha"]').val();
        hora = $form.find('select[name="hora"]').val();
        row.find('input[name="fecha[]"]').val(fecha).val();
        row.find('input[name="hora[]"]').val(hora).val();

        //Cambios el css de conflicto de fecha
        row.find('.divAreaConflictoCita').addClass("hidden");
        row.find('.lblFecha').text(fecha).css('color', '');
        row.find('.lblHora').text(hora).css('color', '');

        //Cerramos el modal
        nroCitasEnConflicto = nroCitasEnConflicto - 1
        if (nroCitasEnConflicto == 0){
            $('#btnAsignar').prop('disabled', false);
            citasEnConflicto = false
        }

        $("#modalReprogramacion").modal('hide');
    });
}