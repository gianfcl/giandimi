@extends('Layouts.layout')

@section('pageTitle', 'Citas Call')

@section('js-libs')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet" type="text/css" > 
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Lista de Citas</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblCitas" class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Fecha de Cita</th>
                            <th>Ejecutivo Agendado</th>
                            <th class="">Centro</th>
                            <th>Documento</th>
                            <th>Cliente</th>
                            <th>Campaña</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Distrito</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js-scripts')
<script>
    $('#tblCitas').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 0, "desc" ]],
        language: {"url": APP_URL + "dataTables.spanish.lang"},
        ajax: {
            "url" : '{{ route('bpe.jefe.citas-data') }}',
        },
        columnDefs:[
            {
                targets:8,
                data:null,
                render:function(data,type,row){
                    return row.DIRECCION_CONTACTO + ' - ' + (row.REFERENCIA || '');
                }
            },
        ],
        columns: [
            { data: 'FECHA_CITA', name: 'WC.FECHA_CITA' },
            { data: 'NOMBRE_EN', name: 'WU2.NOMBRE' },
            { data: 'CENTRO', name: 'WT.CENTRO' },
            { data: 'NUM_DOC', name: 'WC.NUM_DOC' , searchabe: false},
            { data: 'NOMBRE_CLIENTE', name: 'WL.NOMBRE_CLIENTE' , searchabe: false},
            { data: 'CAMPANHA', name: 'WLCE.CAMPANHA' , searchabe: false},
            { data: 'PERSONA_CONTACTO', name: 'WC.PERSONA_CONTACTO' , searchabe: false},
            { data: 'TELEFONO_CONTACTO', name: 'WC.TELEFONO_CONTACTO' , searchabe: false},
            { data: 'DISTRITO', name: 'WL.DISTRITO'},
            { data: 'DIRECCION_CONTACTO', name: 'WC.DIRECCION_CONTACTO', searchabe: false },
        ]
    });
</script>
@stop