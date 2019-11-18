@extends('Layouts.Plantilla')

@section('js-libs')
@stop
@section('content')
@section('pageTitle', 'Productos')
<div>
    <button id="btnagregar" class="btn btn-primary">Agregar</button>
</div>
<table class="table">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>EMPRESA FABRICANTE</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($productos))
        @foreach($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->descripcion}}</td>
                <td>{{$producto->empresa}}</td>
                <td><button idpro="{{$producto->id}}" nombre="{{$producto->nombre}}" descripcion="{{$producto->descripcion}}" empresa="{{$producto->id_empresa_fabricantes}}" class="btn btn-primary" id="btneditar">Editar</button></td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<div class="modal fade" tabindex="-1" role="dialog" id="modalArticulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Producto</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('productos.editarticulo')}}">
                    <input class="idpro" type="text" name="id">
                    <div class="form-group">
                        <label class="col-md-6">Nombre</label>
                        <div class="col-md-6">
                            <input class="form-control nombre" type="text" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6">Descripción</label>
                        <div class="col-md-6">
                            <input class="form-control descripcion" type="text" name="descripcion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6">Empresa</label>
                        <div class="col-md-6">
                            <select class="form-control empresa" name="empresa">
                                <option value="Seleccione una Empresa"></option>
                                @if(!empty($empresas))
                                @foreach($empresas as $empresa)
                                <option value="{{$empresa->id_empresa}}">{{$empresa->empresa}}</option>
                                @endforeach
                                @endif
                            </select>
                            <!--input class="form-control empresa" type="text" name="empresa"-->
                        </div>
                    </div>
                    <button class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
@section('js-scripts')
<script type="text/javascript">
    $(document).on("click","#btnagregar",function() {
       $("#modalArticulo").modal();
       $(".idpro").val("");
       $(".nombre").val("");
       $(".descripcion").val("");
    });

    $(document).on("click","#btneditar",function() {
       $("#modalArticulo").modal();
       $(".idpro").val($(this).attr("idpro"));
       $(".nombre").val($(this).attr("nombre"));
       $(".descripcion").val($(this).attr("descripcion"));
    });
</script>
@stop