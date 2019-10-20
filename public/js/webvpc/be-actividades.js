
$(document).ready(function() {

    initializeDatePicker();
    function show(bloq) {
      obj = document.getElementById(bloq);
      obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
    }
    
});

function initializeDatePicker(){
    $('.dfecha').each(function() {
        $(this).datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "-365d",
            endDate: "+365d",
            format: "yyyy-mm-dd"
        })
        .datepicker('setDate', new Date())
    });
}