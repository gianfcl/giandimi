@extends('Layouts.Plantilla')

@section('js-libs')
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/numeral.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/multiselect.min.js') }}"></script>
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/multiselect.min.css') }}" rel="stylesheet" type="text/css">
@stop
@section('content')
@section('pageTitle', 'Productos')
<div class="x_panel">
        <div>
            <label>Nombre</label>
            <input type="text" id="inputnombre" name="inputnombre">
        </div>

        <div>
            <label>Descripcion</label>
            <select name="inputdescripcion" id="inputdescripcion" class="selectpicker" multiple="multiple" title="Seleccione una descripcion"  data-size="4" tabindex="-1" data-selected-text-format="count>1" data-count-selected-text= "{0} Seleccione una descripcion">
                <option value="">Todos</option>
                <option value="fruta">fruta</option>
                <option value="verdura">verdura</option>
            </select>
        </div>

        <div>
            <label>Empresa</label>
            <select name="selectempresas" id="selectempresas" class="selectpicker" multiple="multiple" title="Seleccione una empresa"  data-size="4" tabindex="-1" data-selected-text-format="count>1" data-count-selected-text= "{0} Seleccione una empresa">
                <option value="">Todos</option>
                <option value="1">empresa1</option>
                <option value="2">empresa2</option>
                <option value="3">empresa3</option>
            </select>
        </div>
        <button id="limpiar">Limpiar</button>
        <button id="buscar" type="submit">Consultar</button>
</div>
<table class="table table-striped jambo_table" id="data-table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>EMPRESA FABRICANTE</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop
@section('js-scripts')
<script type="text/javascript">
$(document).ready(function() {
   tabla();
});
function tabla(descripcion=null,id_empresa=null) {
    $('#data-table').DataTable({
        processing: true,
        rowId: 'staffId',
        serverSide: true,
        language: {"url": "{{ URL::asset('js/Json/Spanish.json') }}"},
        ajax: {
            type : "post",
            url : "{{ route('productos.datables') }}",
            data: {
                "descripcion" : descripcion ? descripcion : null,
                "id_empresa" : id_empresa ? id_empresa : null,
            }
        },
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row) {
                    return row.nombre;
                }
            },
            {
                targets: 1,
                render: function (data, type, row) {

                    return row.descripcion;
                }
            },
            {
                targets: 2,
                render: function (data, type, row) {
                    return row.empresa;
                }
            },
            {
                targets: 3,
                searchable : false,
                render: function (data, type, row) {
                    return "";
                }
            },
        ],
        columns: [
            {data: 'nombre', name: 'TP.nombre'},
            {data: 'descripcion', name: 'TP.descripcion'},
            {data: 'empresa', name: 'EM.empresa'},
        ]
    });
}

$("#inputdescripcion").change(function () {
    $('#data-table').DataTable().destroy();
    tabla($(this).val(),$("#selectempresas").val() ? $("#selectempresas").val() : null);
});

$("#selectempresas").change(function () {
    $('#data-table').DataTable().destroy();
    tabla($("#inputdescripcion").val() ? $("#inputdescripcion").val() : null,$(this).val());
});
</script>
@stop