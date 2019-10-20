@extends('emails.infinity.mailLayout')

@section('encabezado')
<p class="textoPersonalizado">{{$ejecutivo}} ha ingresado una visita para el cliente {{$cliente}} (CU: {{$cu}})
    la cual se encuentra pendiente de confirmación.</p>
@stop

@section('detalles')
<p class="textoPersonalizado">Puedes revisar los datos de la visita y confirmarla desde este <a class="textoPersonalizado" href="{{$url}}" style="text-decoration: underline">enlace</a> </p>
@stop


