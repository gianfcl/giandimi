         @extends('layouts.layout')
 
<style> 
td.details-control {
    background: fa-plus no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: fa-plus no-repeat center center;
}
</style>             
    @section('content')
            <div >
                <div class="page-title">
                    <div class="title_left" >
                    <h3>Mi Prospecto</h3>

                    </div>
                </div>
                <div class="page-title">
                
                     <div class="x_panel">
                        <div class="x_title">
                            <h2>Prospectos </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                           <table id="miprospecto" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        </div>
                    </div>
            </div>
<script> 
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    var table = $('#miprospecto').DataTable( {  
        "language": {
            "url": "js/Json/Spanish.json"
        },
        "data": [
            {
            "name": "Tiger Nixon",
            "position": "System Architect",
            "salary": "$320,800",
            "start_date": "2011/04/25",
            "office": "Edinburgh",
            "extn": "5421"
            },
            {
            "name": "Garrett Winters",
            "position": "Accountant",
            "salary": "$170,750",
            "start_date": "2011/07/25",
            "office": "Tokyo",
            "extn": "8422"
            }],
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": 'Detalles'
            },
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "salary" }
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#miprospecto tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );
</script>
		 @stop
