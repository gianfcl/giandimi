@extends('emails.infinity.mailLayout')

@section('encabezado')
<p class="textoPersonalizado">{{$ejecutivo}} ha llenado la ficha conóceme del cliente {{$cliente}} (CU: {{$cu}}).</p>
@stop

@section('detalles')
<p class="textoPersonalizado">Puedes revisar los datos de la ficha conóceme desde este <a class="textoPersonalizado" href="{{$url}}" style="text-decoration: underline">enlace</a> </p>
@stop


