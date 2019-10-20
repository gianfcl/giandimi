<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    table {
    border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    td{
      font-size: 10px;  
    }

</style>
<body>
<table style="width: 100%">
    <thead>
        <tr>
            <th style="width: 17%">Cliente</th>
            <th style="width: 30%">Dirección</th>
            <th style="width: 10%">Teléfonos</th>
            <th style="width: 08%">Deuda</th>
            <th style="width: 10%">Campañas</th>
            <th style="width: 15%">Gestion</th>
            <th style="width: 10%">Cita</th>
        </tr>
    </thead>
    <tbody>
        @if(count($leads)>0)
        @foreach ($leads as $lead)
        <tr>
            <td>
                {{ $lead->TIPO_DOCUMENTO }}: {{ $lead->NUM_DOC }}
                <br/>{{ $lead->NOMBRE_CLIENTE }}
                @if(empty($lead->FECHA_CITA))
                <br/>{{$lead->REPRESENTANTE_LEGAL}}
                @endif
                @if(empty($lead->CITA_CONTACTO_PERSONA))
                <br/>Contacto: {{$lead->CITA_CONTACTO_PERSONA}}
                @endif
            </td>
            <td>
                {{ $lead->DISTRITO }}<br/>
                Dirección: 
                @if (!is_null($lead->CITA_CONTACTO_DIRECCION))
                    {{ $lead->CITA_CONTACTO_DIRECCION }}
                @else
                    {{ $lead->DIRECCION }}
                @endif
                <br/>
                @if (!is_null($lead->CITA_CONTACTO_REFERENCIA))
                    Referencia: {{ $lead->CITA_CONTACTO_REFERENCIA }}
                @endif
            </td>
            <td>
                @if (!is_null($lead->CITA_CONTACTO_TELEFONO))
                    {{ $lead->CITA_CONTACTO_TELEFONO }}<br/>
                @endif
                <?php $addTelefonos = (!is_null($lead->TELEFONOS_ADD)? explode('|',$lead->TELEFONOS_ADD): []);?>
                @foreach ($addTelefonos as $telefono)
                    {{ $telefono }}<br/>
                @endforeach
                @if (!is_null($lead->TELEFONO1))
                    {{ $lead->TELEFONO1 }}<br/>
                @endif
                @if (!is_null($lead->TELEFONO2))
                    {{ $lead->TELEFONO2 }}<br/>
                @endif
                @if (!is_null($lead->TELEFONO3))
                    {{ $lead->TELEFONO3 }}<br/>
                @endif
                @if (!is_null($lead->TELEFONO4))
                    {{ $lead->TELEFONO4 }}<br/>
                @endif
            </td>
            <td>
                {{ $lead->DEUDA_SSFF_MONEDA}} {{ number_format($lead->DEUDA_SSFF,0,'.',',') }} <br/>
                @if($lead->VARIACION_DEUDA_6M_SSFF > 0)
                ({{ number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',') }}%<span class="glyphicon glyphicon-arrow-up" style="color: #449D44"></span> )<br/>
                @else
                ({{ number_format($lead->VARIACION_DEUDA_6M_SSFF,0,'.',',') }}%<span class="glyphicon glyphicon-arrow-down" style="color: #CB2431"></span> )<br/>
                @endif
                {{ $lead->BANCO_PRINCIPAL_SSFF }}<br/>
            </td>
            <td>
                <?php $cpns = explode('|',$lead->CAM_EST_NOMBRE) ?>
                @foreach ($cpns as $cpn)
                {{$cpn}}<br/>
                @endforeach
            </td>
            <td>
                <?php $gestiones = $lead->GESTION? explode('|',$lead->GESTION): [];?>
                @if(count($gestiones) == 0)
                <label>-</label>
                @endif

                @foreach ($gestiones as $gest)
                {{ empty($gest)? '-':ucwords(mb_strtolower($gest, 'UTF-8')) }}<br/>
                @endforeach
            </td>
            <td>
                @if(empty($lead->FECHA_CITA))
                <label>-</label>
                @else
                <?php $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i',$lead->FECHA_CITA) ?>
                {{ $fecha->format("j M") }} <br/>
                {{ $fecha->format("H:i") }}
                @endif
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">No se encontraron resultados</td>
        </tr>@endif
    </tbody>
</table>
</body>