@extends('Layouts.Plantilla')

@section('js-libs')
@stop
@section('content')
@section('pageTitle', 'Productos')
<table>
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto->NOMBRE}}</td>
                <td>{{$producto->DESCRIPCION}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
@section('js-scripts')
@stop