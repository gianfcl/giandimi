@extends('Layouts.layout')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">

<!--FORM VALIDATION-->
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'Líneas Automáticas')

<style>
.celda-centrada{
    vertical-align: middle !important; 
    text-align: center;
}
table a,table a:hover,table a:active,table a:visited{
    text-decoration: underline;
}


.table>tbody>tr>td{
    padding: 5px;
}
</style>

<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-striped table-bordered jambo_table" id="data-table">
                    <thead>
                        <tr>
                            <th style="width: 15%">Cliente</th>                                                    
                            <th style="width: 15%">Ejecutivo Responsable</th>
                            <th style="width: 10%">Línea</th>
                            <th style="width: 40%">Último Comentario</th>
                            <th style="width: 10%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Colores de semaforos -->
@foreach(App\Entity\Infinity\Semaforo::SEMAFOROS_ME_COLORES as $key => $color)
<input id="semaforo-{{$key}}" type="hidden" value="{{$color}}">
@endforeach

<input id="icono" type="hidden" value="{{ URL::asset('img/Logo_favi.ico') }}" />


<!-- /.Modal Grupo Económico-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalControl">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>          
            <div class="modal-body">
                <form id="frmControl" class="form-horizontal form-label-left" enctype="multipart/form-data" action="{{route('infinity.me.clientes.control.guardar')}}" method="POST">
                    <input type="text" name="codUnico" id="codUnicoForm" hidden>
                    <input type="text" name="nombre" id="nombreForm" hidden>
                    <input type="text" name="flgCambio" id="flgCambioForm" hidden>

                    <div class="form-group" id="mensajeModal">
                                               
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario:</label>
                        <div class="input-group col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" rows="7" style="resize: none" placeholder="Ingresar Comentario..." name="comentarioControl" ></textarea>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </center>
                </form>
            </div>            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('js-scripts')
<script>


    $('#data-table').DataTable({
        processing: true,
        rowId: 'staffId',
        serverSide: true,
        language: {"url": "{{ URL::asset('js/Json/Spanish.json') }}"},
        ajax: '{{ route('infinity.me.clientes.control.get') }}',

        "aLengthMenu": [[25, 50, -1], [25, 50, "Todo"]],
        "iDisplayLength": 25,
        "order": [[0, "asc"]],
        columnDefs: [
        {
            targets: 0,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row) {

                var color = $('#semaforo-' + row.NIVEL_ALERTA).val();
                var alerta ='<i class="fa fa-circle" style="color:' + color + '"></i> ';
                var nombre = row.NOMBRE;
                var cu = '<br/>CU: ' + row.COD_UNICO;                

                return alerta+nombre + cu;
            }
        },
        {
            targets: 1,
            data: null,
            searchable: true,
            className: "celda-centrada",
            render: function (data, type, row) {

                html = '';
                html += 'EN: '+row.EJECUTIVO;
                html += '<br/>' + 'JEFE: '+ row.JEFATURA;

                return html;
            }
        },
        {
            targets: 2,
            data: null,
            searchable: false,
            className: "celda-centrada",
            render: function (data, type, row) {
                if (row.FLG_INFINITY == 1) {
                    return 'Automático';
                } else {
                    return '';
                }
            }
        },
        {
            targets: 3,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row) {                
                return row.COMENTARIO;              
            }
        },
        
        {
            targets: 4,
            data: null,
            className: "celda-centrada",
            render: function (data, type, row) {

                html='<a onClick="activarModalControl(this)" style="cursor:pointer" class="btnControl" cu="'+row.COD_UNICO+'" nombre="'+row.NOMBRE+'"';

                if(row.FLG_INFINITY==1)
                    html += 'flgCambio="0">Quitar</a>';
                else
                    html += 'flgCambio="1">Incluir</a>';
                
                return html;
            }
        },
        ],
        columns: [
        {data: 'NOMBRE', name: 'NOMBRE'},        
        {data: 'EJECUTIVO', name: 'EJECUTIVO'},
        {data: 'FLG_INFINITY', name: 'FLG_INFINITY', searchable: false},
        {data: 'COD_UNICO', name: 'COD_UNICO', sortable: false},
        {data: 'COD_UNICO', name: 'COD_UNICO', sortable: false},
        ]
    });
/*$(document).ready(function () {
    $('.btnControl').on("click", function () {
        console.log($(this).attr('nombre'),$(this).attr('cu'),$(this).attr('accion'));
        $('#modalControl').modal();
    })
});
*/
function activarModalControl(e){
    //console.log($(e).attr('nombre'));

    var cu=$(e).attr('cu');
    var nombre=$(e).attr('nombre');
    var flgCambio=$(e).attr('flgCambio');

    $('#frmControl').trigger("reset");
    $('#frmControl').formValidation('destroy', true);
    $('#modalControl').modal();
    initializeFormControl();
    $('#codUnicoForm').val(cu);
    $('#nombreForm').val(nombre);
    $('#flgCambioForm').val(flgCambio);

    var mensajeModal='<label class="control-label col-xs-12" >Estás seguro que deseas ';
    if (flgCambio=="1")
        mensajeModal+='agregar ';
    else 
        mensajeModal+='quitar ';

    mensajeModal+='al cliente '+nombre+' de líneas automáticas?</label>';
    console.log(mensajeModal);
    $('#mensajeModal').find('label').remove();
    $('#mensajeModal').append(mensajeModal);
}

function initializeFormControl(){
    return $('#frmControl').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           
            'comentarioControl': {
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio'
                    },
                    stringLength: {
                        max: 500,
                        min: 30,
                        message: 'El comentario debe tener entre 30 y 500 caracteres'
                    }
                }
            },
        },
    })
            .off('success.form.fv');
}
</script>
@stop



