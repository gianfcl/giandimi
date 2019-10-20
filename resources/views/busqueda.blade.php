<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
        <script async="" src="/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container bs-docs-container">
            <div class="row">
                <h2>Teléfonos</h2>

                <form action="/busqueda" class="form-inline">
                    <div class="form-group">
                        <select name="tipoBusqueda" class="form-control">
                            <option value="1">Por Documento</option>
                            @if ($tipoBusqueda == 2) 
                            <option value="2" selected>Por Cliente</option>
                            @else
                            <option value="2" >Por Cliente</option>
                            @endif 

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="termino" size="20" value="{{ $termino }}" class="form-control" tabindex="1">
                    </div>
                    <button type="submit" class="btn btn-primary"> Buscar</button>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Nro. Documento</td>
                            <td>Cliente</td>
							<td>Fuente Fijo</td>
							<td>Fijo 1</td>
							<td>Fijo 2</td>
							<td>Fuente Celular</td>
                            <td>Cell 1</td>
							<td>Cell 2</td>
							
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($telefonos)>0)
                        @foreach ($telefonos as $telf)
                        <tr>
                            <td>{{ $telf->NUM_DOC }}</td>
                            <td>{{ $telf->NOMBRE_CLIENTE }} </td>
                            <td>{{ $telf->FUENTE_FIJO }}</td>
							<td>{{ $telf->TELEFONO_FIJO1 }}</td>
							<td>{{ $telf->TELEFONO_FIJO2 }}</td>
							<td>{{ $telf->FUENTE_CEL }}</td>
							<td>{{ $telf->TELEFONO_CEL1 }}</td>
							<td>{{ $telf->TELEFONO_CEL2 }}</td>
                        </tr>@endforeach
                        @else
                        <tr>
                            <td colspan="4">No se encontraron resultados</td>
                        </tr>@endif
                    </tbody>
                </table>
                {{ $telefonos->appends(['tipoBusqueda' => $tipoBusqueda, 'termino' => $termino])->links() }}
            </div>
        </div>
    </body>
</html>
