function cboCentroChange(centro,tienda) {
    var cboTienda = $('#cboTienda');
    
    //Limpiamos el combobox de tiendas
    cboTienda.find('option:not(:first)').remove();
    
    //Si no selecionada nada como resultado
    if (!centro) {
        cboTienda.val('');
        cboTienda.prop('disabled', false);
        return;
    }
    
    //Si selecciona cualquier otro resultado
    cboTienda.prop('disabled', true);
    $.ajax({
        type: "GET",
        data: {centro: centro},
        url: APP_URL + '/bpe/campanha/utils/get-tiendas-by-centro',
        dataType: 'json',
        success: function (json) {
            $.each(json, function (key, value) {
                cboTienda.append($("<option></option>")
                        .attr("value", value.ID_TIENDA).text(value.TIENDA));
            });
            if (tienda){
                cboTienda.val(tienda);
            }
            cboTienda.prop('disabled', false);
        }
    });
}

function cboZonalChange(zonal,centro,tienda) {
    var cboCentro = $('#cboCentro');
    var cboTienda = $('#cboTienda');
    
    //Limpiamos el combobox de tiendas
    cboCentro.find('option:not(:first)').remove();
    cboTienda.find('option:not(:first)').remove();
    cboTienda.val('');
    
    //Si no selecionada nada como resultado
    if (zonal === '') {
        cboCentro.val('');
        return;
    }
    
    //Si selecciona cualquier otro resultado
    cboCentro.prop('disabled', true);
    cboTienda.prop('disabled', true);

    return $.ajax({
        type: "GET",
        data: {zonal: zonal},
        url: APP_URL + '/bpe/campanha/utils/get-centros-by-zonal',
        dataType: 'json',
        success: function (json) {
            $.each(json, function (key, value) {
                cboCentro.append($("<option></option>")
                        .attr("value", value.ID_CENTRO).text(value.CENTRO));
            });
            if (centro){
                cboCentro.val(centro);
            }
            cboCentro.prop('disabled', false);
            cboCentroChange(centro,tienda);
            
        }
    });
}

$(document).ready(function() {

    $('#cboCentro').change(function(){
        cboCentroChange($(this).val(),null);
    });

    $('#cboZonal').change(function(){
        cboZonalChange($(this).val(),null,null);
    });

    $('.input-daterange input').each(function() {
        $(this).datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "-60d",
            endDate: "+30d",
            format: "yyyy-mm-dd"
        })

        .datepicker('setDate', new Date())
    });

    if ($('#req_fechaIni').text() != '') {
        $('#dp_fechaIni').datepicker('setDate', $('#req_fechaIni').text())
    }
    if ($('#req_fechaFin').text() != '') {
        $('#dp_fechaFin').datepicker('setDate', $('#req_fechaFin').text())
    }
});