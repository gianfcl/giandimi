@extends('Layouts.layout')

@section('pageTitle', 'Call')

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Llamadas en los ultimos 5 dias</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Ejecutivo Call</th>
                            <th style="text-align: center;"> {{ Carbon\Carbon::parse($fechas[0]->_4)->format('d-m-Y')}} </th>
                            <th style="text-align: center;"> {{ Carbon\Carbon::parse($fechas[0]->_3)->format('d-m-Y')}} </th>
                            <th style="text-align: center;"> {{ Carbon\Carbon::parse($fechas[0]->_2)->format('d-m-Y')}} </th>
                            <th style="text-align: center;"> {{ Carbon\Carbon::parse($fechas[0]->_1)->format('d-m-Y')}} </th>
                            <th style="text-align: center;"> {{ Carbon\Carbon::parse($fechas[0]->HOY)->format('d-m-Y')}} </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statsCall as $stat)
                            <tr>
                                <td>{{ $stat->NOMBRE }} <br> {{ $stat->REGISTRO_EN_AGENDADOR }}</td>
                                <td style="text-align: center;">{{ $stat->_4 }}</td>
                                <td style="text-align: center;">{{ $stat->_3 }}</td>
                                <td style="text-align: center;">{{ $stat->_2 }}</td>
                                <td style="text-align: center;">{{ $stat->_1 }}</td>
                                <td style="text-align: center;">{{ $stat->HOY }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                            
            </div>
        </div>
    </div>
</div>

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
                <table class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th class="col-md-1">Fecha de Registro</th>
                            <th class="col-md-2">Call Agendador</th>
                            <th class="col-md-2">Ejecutivo Agendado</th>
                            <th class="">Zonal/Tienda</th>
                            <th class="col-md-1">Fecha de Cita</th>
                            <th class="col-md-2">Informacion Lead</th>
                            <th class="col-md-1">Telefono</th>
                            <th class="col-md-3">Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($listaCitas)>0)
                        @foreach ($listaCitas as $cita)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($cita->FECHA_REGISTRO)->format('d-m-Y') }}</td>
                            <td> {{ $cita->NOMBRE_AG}} <br> {{ $cita->REGISTRO_EN_AGENDADOR}} </td>
                            <td> {{ $cita->NOMBRE_EN}} <br> {{ $cita->REGISTRO_EN}} </td>
                            <td>{{$cita->TIENDA}} <br> {{$cita->ZONA}}</td>
                            <td> {{ Carbon\Carbon::parse($cita->FECHA_CITA)->format('d-m-Y h:i') }}</td>
                            <td> {{ $cita->NUM_DOC}} <br> {{$cita->PERSONA_CONTACTO}} </td>
                            <td> {{$cita->TELEFONO_CONTACTO}} </td>
                            <td> {{ $cita->DIRECCION_CONTACTO}} <br> {{$cita->REFERENCIA}} </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $listaCitas->links() }}
            </div>
        </div>
    </div>
</div>

@stop