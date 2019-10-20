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
            <th">Estrategia</th>
            <th style="width: 17%">Cliente</th>
            <th style="width: 30%">Dirección</th>
            <th>Teléfonos</th>
            <th>Deuda SSFF</th>
            <th>Atrasos</th>
            <th>Saldo Disponible</th>
            <th>Gestion</th>
        </tr>
    </thead>
    <tbody>
        @if(count($clientes)>0)
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->NOMBRE_CAMP}}</td>
            <td>
                CU: {{ $cliente->COD_UNICO }}
                <br/>{{ $cliente->NOMBRE_CLIENTE }}
                @if($cliente->REPRESENTANTE_LEGAL)
                <br/>RRLL: {{$cliente->REPRESENTANTE_LEGAL}}
                @endif
            </td>
            <td>
                {{ $cliente->DISTRITO }}<br/>
                {{ $cliente->DIRECCION }}
            </td>
            <td>
                @if (!is_null($cliente->TELEFONO1))
                    {{ $cliente->TELEFONO1 }}<br/>
                @endif
                @if (!is_null($cliente->TELEFONO2))
                    {{ $cliente->TELEFONO2 }}<br/>
                @endif
                @if (!is_null($cliente->TELEFONO3))
                    {{ $cliente->TELEFONO3 }}<br/>
                @endif
                @if (!is_null($cliente->TELEFONO4))
                    {{ $cliente->TELEFONO4 }}<br/>
                @endif
            </td>
            <td>
                S/. {{ number_format($cliente->DEUDA_SSFF,0,'.',',') }} <br/>
                {{ $cliente->BANCO_PRINCIPAL_SSFF }}<br/>
            </td>
            <td>
                Promedio: {{$cliente->ATRASO_PROMEDIO}} d
                Último:   {{$cliente->ATRASO_ULTIMO}} d
            </td>
            <td>
                S/. {{number_format($cliente->MONTO_DISPONIBLE,0,'.',',')}}
            </td>
            <td>
                {{$cliente->DESCRIPCION_RESULTADO}}
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