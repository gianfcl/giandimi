@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('css/switchery.min.css') }}" rel="stylesheet" type="text/css">

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/jsContacto.js') }}"></script>
@stop

@section('content')

@section('pageTitle', 'Mi Contacto')

<style type="text/css">
.twitter-typeahead, .tt-hint, .tt-input, .tt-menu { width: 100%; }
</style>
<input id="idContactoSeleccionado" type="hidden" value="@if(isset($idContacto)) {{ $idContacto }} @else @endif" name="">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<form action="{{ route('be.micontacto.index') }}" class="form-horizontal" method="GET">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="" class="control-label col-md-4">DNI/RUC:</label>
							<div class="col-md-8">
								<input class="form-control formatInputNumber" id="filtroDNIRUC" type="text" value="{{ $busqueda['documento']}}" name="documento" maxlength="15">
							</div>
						</div>
						<div class="form-group col-md-4">
							<label for="" class="control-label col-md-4">Razón Social:</label>
							<div class="col-md-8">
								<input class="form-control" type="text" value="<?php echo ($lead? $lead->NOMBRE: '') ?>" name="razonSocial" id="txtRazonSocial">
							</div>
						</div>
						<div class="form-group col-md-4">
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@if($lead)
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<form action="{{ route('be.micontacto.update-datos') }}" method="POST" id="frmDatosCliente">
					<input name="numdoc" value="{{$lead->NUM_DOC}}" type="hidden">
                    
                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                    <fieldset disabled>
                    @endif

					<div class="col-md-2 form-group">
						<h4>{{$lead->NOMBRE}}</h4>
						<span>RUC: {{$lead->NUM_DOC}}</span><br/>
						@if ($lead->COD_UNICO)
                            <span>CU: {{$lead->COD_UNICO}}</span><br/>
                        @endif
						<span>Categoría: {{$lead->CATEGORIA}}</span>
					</div>
					<div class="col-md-2 form-group">
						<label for="">Departamento</label>
						<select id="cboDepartamento" name="departamento" class="form-control">
							<option value="">---Todos----</option>
							@foreach ($departamentos as $departamento)
							<option value="{{$departamento->DEPARTAMENTO}}" {{ ($departamento->DEPARTAMENTO == $lead->DEPARTAMENTO)? 'selected="selected"':''}}> {{$departamento->DEPARTAMENTO}}
							</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2 form-group">
						<label for="">Provincia</label>
						<select id="cboProvincia" name="provincia" class="form-control">
							<option value="">---Todos----</option>
							@foreach ($provincias as $provincia)
							<option value="{{$provincia->PROVINCIA}}" {{ ($provincia->PROVINCIA == $lead->PROVINCIA)? 'selected="selected"':''}}> {{$provincia->PROVINCIA}}
							</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2 form-group">
						<label for="">Distrito</label>
						<select id="cboDistrito" name="distrito" class="form-control">
							<option value="">---Todos----</option>
							@foreach ($distritos as $distrito)
							<option value="{{$distrito->DISTRITO}}" {{ ($distrito->DISTRITO == $lead->DISTRITO)? 'selected="selected"':''}}> {{$distrito->DISTRITO}}
							</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2 form-group">
						<label for="">Dirección</label>
						<input type="text" class="form-control" name="direccion" value="{{$lead->DIRECCION}}" maxlength="150">
					</div>
					<div class="col-md-2 form-group">
						<label for="">Teléfono</label> 
						<input type="text" class="form-control" name="telefono" value="{{$lead->TELEFONO}}" maxlength="9"> 
						<button type="submit" class="btn btn-success hidden" style="float: right; margin-top: 15px;" >Guardar</button>
                        <a class="btn btn-default hidden" style="float: right; margin-top: 15px;" href="{{ route('be.micontacto.index',['documento' => $lead->NUM_DOC]) }}">Cancelar</a> 
					</div>

                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                    </fieldset>
                    @endif

				</form>
			</div>
		</div>
	</div>
</div>
@elseif($cliente)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form action="{{ route('be.micontacto.update-datos') }}" method="POST" id="frmDatosCliente">
                    <input name="numdoc" value="{{$cliente->NUM_DOC}}" type="hidden">
                    
                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                    <fieldset disabled>
                    @endif

                    <div class="col-md-2 form-group">
                        <h4>{{$cliente->NOMBRE_EMPRESA}}</h4>
                        <span>RUC: {{$cliente->NUM_DOC}}</span><br/>
                        @if ($cliente->COD_UNICO)
                            <span>CU: {{$cliente->COD_UNICO}}</span><br/>
                        @endif
                        <span>Categoría: {{$cliente->CATEGORIA}}</span>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Departamento</label>
                        <select id="cboDepartamento" name="departamento" class="form-control">
                            <option value="">---Todos----</option>
                            @foreach ($departamentos as $departamento)
                            <option value="{{$departamento->DEPARTAMENTO}}" {{ ($departamento->DEPARTAMENTO == $cliente->DEPARTAMENTO)? 'selected="selected"':''}}> {{$departamento->DEPARTAMENTO}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Provincia</label>
                        <select id="cboProvincia" name="provincia" class="form-control">
                            <option value="">---Todos----</option>
                            @foreach ($provincias as $provincia)
                            <option value="{{$provincia->PROVINCIA}}" {{ ($provincia->PROVINCIA == $cliente->PROVINCIA)? 'selected="selected"':''}}> {{$provincia->PROVINCIA}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Distrito</label>
                        <select id="cboDistrito" name="distrito" class="form-control">
                            <option value="">---Todos----</option>
                            @foreach ($distritos as $distrito)
                            <option value="{{$distrito->DISTRITO}}" {{ ($distrito->DISTRITO == $cliente->DISTRITO)? 'selected="selected"':''}}> {{$distrito->DISTRITO}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$cliente->DIRECCION}}" maxlength="150">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Teléfono</label> 
                        <input type="text" class="form-control" name="telefono" value="{{$cliente->TELEFONO}}" maxlength="9"> 
                        <button type="submit" class="btn btn-success hidden" style="float: right; margin-top: 15px;" >Guardar</button>
                        <a class="btn btn-default hidden" style="float: right; margin-top: 15px;" href="{{ route('be.micontacto.index',['documento' => $cliente->NUM_DOC]) }}">Cancelar</a> 
                    </div>

                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                    </fieldset>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
@endif

@if($lead or $cliente)
<div class="row">
    <div class="col-md-3">
        <div id="panelListaContactos" class="x_panel">
            <ul class="nav nav-pills nav-stacked">
                @foreach($contactos as $contacto)
                <!--FLG_VIGENTE=2 ES PARA LOS CONTACTOS DE ECOSISTEMA-->
                <li class="@if(($contacto->ID_CONTACTO) == $idContacto) active @else  @endif" idcontacto="{{$contacto->ID_CONTACTO}}"><a href="#">{{$contacto->NOMBRE}} {{$contacto->APELLIDO_PATERNO}}  @if($contacto->FLG_VIGENTE==2)<img src = "{{ URL::asset('img/ecosistema.png') }}" style="width: 20px;height: 20px;border-bottom-width: 10px;margin-bottom: 5px;margin-left: 5px;">@endif
                    <i class="fa fa-trash-o" data-toggle="tooltip" title="Eliminar" data-placement="bottom" style="float : right;" aria-hidden="true" onclick="cboQuitarContacto({{$contacto->ID_CONTACTO}},{{$busqueda['documento']}})"></i></a> </li>
                @endforeach
            </ul>

            @if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)) and $usuario->getValue('_rol')!=\App\Entity\Usuario::ROL_ANALISTA_EXTERNO_ZONAL_BE)
                <button id="btnNuevoContacto" type="button" class="btn btn-primary" style="margin-top: 15px"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Contacto</button>
            @endif
            
        </div>
    </div>
    <div class="col-md-5">
        <div id="panelEditarContacto" class="x_panel hidden">
            <div class="x_title">
                <h2>Detalles</h2>
                <!-- 
                <ul class="nav navbar-right panel_toolbox" style="min-width: 0px;">
                  <li><a class="close-link"><i class="fa fa-pencil btnEditarContacto"></i></a>
                  </li>
                </ul>
                !-->
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach($contactos as $contacto)
                <form idcontacto="{{$contacto->ID_CONTACTO}}" class="hidden formEditarContacto" action="{{route('be.micontacto.update-contacto')}}" method="POST">
                    
                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)) or $usuario->getValue('_rol')==\App\Entity\Usuario::ROL_ANALISTA_EXTERNO_ZONAL_BE   )
                    <fieldset disabled>
                    @endif

                    <input type="hidden" name="idcontacto" value="{{$contacto->ID_CONTACTO}}">
                    @if($lead)
                        <input type="hidden" name="numdoc"  value="{{$lead->NUM_DOC}}">
                    @else
                        <input type="hidden" name="numdoc"  value="{{$cliente->NUM_DOC}}">
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Documento</label>
                                <select class="form-control" name="tipoDocumento">
                                    <option value="DNI">DNI</option>
                                    <option value="Carnet de Extranjeria">Carnet de Extranjeria</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group ">
                                <label >N° Documento</label>
                                <input type="text" class="form-control"  id="numdoc" name="numdoccontacto" value="{{$contacto->NUM_DOC_CONTACTO}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label >Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombres" value="{{$contacto->NOMBRE}}" maxlength="25">
                    </div>

                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control" name="apaterno" id="apaterno" value="{{$contacto->APELLIDO_PATERNO}}" maxlength="25">
                    </div>

                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control" name="amaterno" value="{{$contacto->APELLIDO_MATERNO}}" maxlength="25">
                    </div>

                    <div class="form-group">
                        <label>Cargo</label>
                        <input type="text" class="form-control" name="cargo" value="{{$contacto->CARGO}}" maxlength="25">
                    </div>

                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$contacto->DIRECCION}}" maxlength="150">
                    </div>

                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="text" class="form-control" name="email" value="{{$contacto->EMAIL}}" maxlength="50">
                    </div>

                    @if($lead)
                    <a class="btn btn-default hidden" href="{{ route('be.micontacto.index',['documento' => $lead->NUM_DOC, 'idContacto' => $contacto->ID_CONTACTO]) }}">Cancelar</a> 
                    @else
                    <a class="btn btn-default hidden" href="{{ route('be.micontacto.index',['documento' => $cliente->NUM_DOC, 'idContacto' => $contacto->ID_CONTACTO]) }}">Cancelar</a> 
                    @endif
                    <button type="submit" class="btn btn-success hidden">Guardar</button>

                    @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)) or  $usuario->getValue('_rol')==\App\Entity\Usuario::ROL_ANALISTA_EXTERNO_ZONAL_BE   )
                    </fieldset>
                    @endif

                </form>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div id="panelInfoContacto" class="x_panel hidden">
            <div class="x_title">
                <h2>Teléfonos</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblContactos" class="table table-condensed">
                    <tbody>
                        @foreach($addContactos as $addContacto)
                        <tr class="hidden" idContacto="{{$addContacto->ID_CONTACTO}}">
                            <td><label>{{$addContacto->TIPO_CONTACTO}}:</label></td>
                            <td class="cellTelefono <?php echo ($addContacto->FEEDBACK == 'NEGATIVO') ? 'tachado' : '' ?>">{{ $addContacto->VALOR }}
                                @if ($addContacto->ANEXO)
                                    - Anexo: {{$addContacto->ANEXO}}
                                @endif
                            </td>
                            <td>
                                @if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                                    
                                <i feedback="POSITIVO"  lead="{{ $addContacto->ID_CONTACTO }}"  valor="{{ $addContacto->VALOR }}" aria-hidden="true"
                                    class="icon-feedback
                                    fa fa-thumbs-o-up <?php echo ($addContacto->FEEDBACK == 'POSITIVO') ? 'icon-feedback-active' : '' ?>" 
                                    data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>

                                <i feedback="NEGATIVO"  lead="{{ $addContacto->ID_CONTACTO }}"  valor="{{ $addContacto->VALOR }}" aria-hidden="true"
                                    class="icon-feedback
                                    fa fa-thumbs-o-down <?php echo ($addContacto->FEEDBACK == 'NEGATIVO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="Número erróneo">          
                                </i>
                                @else
                                    @if ($addContacto->FEEDBACK == 'POSITIVO')
                                        <i aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto">
                                        </i>
                                    @endif
                                    @if ($addContacto->FEEDBACK == 'NEGATIVO')
                                        <i aria-hidden="true" class="fa fa-thumbs-o-down icon-feedback icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número erróneo">
                                        </i>
                                    @endif
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if(in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)) and $usuario->getValue('_rol')!=\App\Entity\Usuario::ROL_ANALISTA_EXTERNO_ZONAL_BE)
                    <button class="btn btn-primary btnNuevoNumero"> Agregar Datos Contacto</button>
                @endif
                
            </div>      
        </div>

        <div id="panelEncuestaContacto"" class="x_panel hidden">
            <div class="x_title">
                <h2>Encuestas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach($contactos as $contacto)
                <div class="row hidden encuestaRow" idcontacto="{{$contacto->ID_CONTACTO}}">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>Tipo de Contacto</h5>
                        </div>
                        <div class="col-md-9">
                            <div class="btn-group  col-md-12" role="group" aria-label="...">
                                <button contacto="{{$contacto->ID_CONTACTO}}" type="button" class="btn col-md-4
                                    <?php echo in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true))? 'btnTipoContacto':''?>
                                    <?php echo (isset($contacto->TIPO_CONTACTO['Comercial']))? 'btn-success' : 'btn-default' ?>" 
                                    tipo="Comercial" data-toggle="tooltip" data-placement="top" title="Encargado de la relación comercial con el banco">Comercial</button>
                                <button contacto="{{$contacto->ID_CONTACTO}}" type="button" class="btn col-md-4
                                    <?php echo in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true))? 'btnTipoContacto':''?>
                                    <?php echo (isset($contacto->TIPO_CONTACTO['Crediticio']))? 'btn-success' : 'btn-default' ?>" 
                                    tipo="Crediticio" data-toggle="tooltip" data-placement="top" title="Temas crediticios, procesos de evaluación y renovación de líneas de crédito">Crediticio</button>
                                <button contacto="{{$contacto->ID_CONTACTO}}" type="button" class="btn col-md-4
                                    <?php echo in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true))? 'btnTipoContacto':''?>
                                    <?php echo (isset($contacto->TIPO_CONTACTO['Operativo']))? 'btn-success' : 'btn-default' ?>" 
                                    tipo="Operativo" data-toggle="tooltip" data-placement="top" title="Encargado de realizar consultas o solicitar pedidos">Operativo</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h5>¿Contacto para encuestar?</h5>
                        </div>
                        <div class="col-md-9 row">
                            <div class="col-md-12">
                                <div class="col-md-4" align="center">
                                    <input 
                                        @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                                            readonly="readonly" 
                                        @endif
                                        type="checkbox" class="js-switch js-check-change " <?php echo (isset($contacto->TIPO_CONTACTO['Comercial']) && $contacto->TIPO_CONTACTO['Comercial'] == '1')? 'checked' : '' ?> tipo="Comercial" contacto="{{$contacto->ID_CONTACTO}}"/>
                                </div>
                                <div class="col-md-4" align="center">
                                    <input
                                        @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                                            readonly="readonly" 
                                        @endif
                                        type="checkbox" class="js-switch js-check-change " <?php echo (isset($contacto->TIPO_CONTACTO['Crediticio']) && $contacto->TIPO_CONTACTO['Crediticio'] == '1')? 'checked' : '' ?> tipo="Crediticio" contacto="{{$contacto->ID_CONTACTO}}" />
                                </div>
                                <div class="col-md-4" align="center">
                                    <input
                                        @if(!in_array($usuario->getValue('_rol'),\App\Entity\Usuario::getAnalistasEjecutivosBE(true)))
                                            readonly="readonly" 
                                        @endif
                                        type="checkbox" class="js-switch js-check-change " <?php echo (isset($contacto->TIPO_CONTACTO['Operativo']) && $contacto->TIPO_CONTACTO['Operativo'] == '1')? 'checked' : '' ?> tipo="Operativo" contacto="{{$contacto->ID_CONTACTO}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>              
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoNumero">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Teléfono</h4>
            </div>
            <form id="frmNuevoNumero" class="form-horizontal form-label-left" action="{{ route('be.micontacto.add-contacto-data') }}">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="lead">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="tipocontacto" id="cboTipoContacto" class="form-control">
                                <option value="Celular">Celular</option>
                                <option value="Trabajo">Trabajo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="telefono" class="form-control" type="text" value="" maxlength="9">
                        </div>
                    </div>

                    <div class="form-group hidden">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Anexo:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="anexo" class="form-control" type="text" value="" maxlength="7">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalContactoNuevo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Contacto</h4>
            </div>
            <form id="frmNuevoContacto" class="form-horizontal form-label-left" action="{{ route('be.micontacto.agregar-contacto') }}" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="lead">
                    @if($lead)
                        <input name="numdoc" id="numdocAgregado" value="{{$lead->NUM_DOC}}" type="hidden">
                    @else
                        <input name="numdoc" id="numdocAgregado" value="{{$cliente->NUM_DOC}}" type="hidden">
                    @endif
                    <input name="eNegocio" id="eNegocioAgregado" value="{{ Auth::user()->NOMBRE }}" type="hidden">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="nombres" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Apellido Paterno:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="apepat" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Apellido Materno:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="apemat" class="form-control" type="text" value="" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Cargo:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="cargo" class="form-control" type="text" value="" maxlength="25">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="telefono" class="form-control" type="text" value="" maxlength="9">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Dirección:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="direccion" class="form-control" type="text" value="">
                        </div>
                    </div>

                    <div class="form-group divTelefono divData">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Email :</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="email" class="form-control" type="text" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@else
    @if((!$lead && $busqueda['documento']) || (!$cliente && $busqueda['documento']))
        <span >No se encontraron resultados</span>
    @endif
@endif


@stop

@section('js-scripts')
<script>

	 //QUITAR CONTACTO
	 function cboQuitarContacto(idContacto,numDocumento) {	   
	 	if(confirm('¿Estas seguro de elimiar el contacto?'))
	 	{	 		               		 	
                     window.location.href = APP_URL + '/be/micontacto/quitar-contacto?idContacto='+idContacto+'&numdoc='+numDocumento;	 			
	 	}	 	
	 }

     
	 /************UBIGEO****************/

	 function cboProvinciaChange(provincia,distrito) {
	 	var cboDistrito = $('#cboDistrito');

            //Limpiamos el combobox de distritos
            cboDistrito.find('option:not(:first)').remove();
            
            //Si no selecionada nada como resultado
            if (!provincia) {
            	cboDistrito.val('');
            	cboDistrito.prop('disabled', false);
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboDistrito.prop('disabled', true);
            $.ajax({
            	type: "GET",
            	data: {provincia: provincia},
            	url: APP_URL + '/utils/get-distritos-by-provincia',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboDistrito.append($("<option></option>")
            				.attr("value", value.DISTRITO).text(value.DISTRITO));
            		});
            		if (distrito){
            			cboDistrito.val(distrito);
            		}
            		cboDistrito.prop('disabled', false);
            	}
            });
        }

        function cboDepartamentoChange(departamento,provincia,distrito) {
        	var cboProvincia = $('#cboProvincia');
        	var cboDistrito = $('#cboDistrito');

            //Limpiamos el combobox de distritos
            cboProvincia.find('option:not(:first)').remove();
            cboDistrito.find('option:not(:first)').remove();
            cboDistrito.val('');
            
            //Si no selecionada nada como resultado
            if (departamento === '') {
            	cboProvincia.val('');
            	return;
            }
            
            //Si selecciona cualquier otro resultado
            cboProvincia.prop('disabled', true);
            cboDistrito.prop('disabled', true);

            return $.ajax({
            	type: "GET",
            	data: {departamento: departamento},
            	url: APP_URL + '/utils/get-provincias-by-departamento',
            	dataType: 'json',
            	success: function (json) {
            		$.each(json, function (key, value) {
            			cboProvincia.append($("<option></option>")
            				.attr("value", value.PROVINCIA).text(value.PROVINCIA));
            		});
            		if (provincia){
            			cboProvincia.val(provincia);
            		}
            		cboProvincia.prop('disabled', false);
            		cboProvinciaChange(provincia,distrito);

            	}
            });
        }


        /* Autocompletado busqueda razon social*/
        function autocompleteCliente(){
        	var engine = new Bloodhound({
        		remote: {
        			url: APP_URL + '/be/micontacto/autocomplete-cliente?termino=%Q%',
        			wildcard: '%Q%'
        		},
        		datumTokenizer: Bloodhound.tokenizers.whitespace,
        		queryTokenizer: Bloodhound.tokenizers.whitespace
        	});
        	$('#txtRazonSocial').typeahead({
        		minLength: 3
        	}, {
        		display: 'NOMBRE',
        		source: engine.ttAdapter(),
        //name: 'resultadosEN',
        templates: {
        	empty: [
        	'<div class="list-group search-results-dropdown"><div class="list-group-item">No hay resultados</div></div>'
        	],
        	suggestion: function (data) {
        		return '<div class="list-group-item"><a href="' + APP_URL + '/be/micontacto?documento=' + data.NUM_DOC + '">' + data.NOMBRE + '</a></div>'
        	}
        }
    })
        }

        $(document).ready(function(){


        	autocompleteCliente();
            //
            $('[data-toggle="tooltip"]').tooltip();

        	/***** MENU DE CONTACTOS *****/
        	$('#panelListaContactos').on('click','ul li',function(){
        		idContacto = $(this).attr('idcontacto');
        		$(this).siblings().removeClass('active');
        		$(this).addClass('active');

        		$('#panelEditarContacto').removeClass('hidden');
        		$('#panelEditarContacto').find('form').addClass('hidden');
        		$('#panelEditarContacto').find('form[idcontacto='+idContacto+']').removeClass('hidden');

        		$('#panelInfoContacto').removeClass('hidden');
        		$('#panelInfoContacto').find('tr').addClass('hidden');
        		$('#panelInfoContacto').find('tr[idcontacto='+idContacto+']').removeClass('hidden');


        		$('#panelEncuestaContacto').removeClass('hidden');
        		$('#panelEncuestaContacto').find('.encuestaRow').addClass('hidden');
        		$('#panelEncuestaContacto').find('.encuestaRow[idcontacto='+idContacto+']').removeClass('hidden');

        	});
        	

        	var idContacto = $('#idContactoSeleccionado').val();
        	if(idContacto == " " || idContacto == undefined){
        		var idContacto= "0";
        	}  else{        		
        		console.log($('#idContactoSeleccionado').val());
                if ($('#panelListaContactos').find('li[idcontacto='+idContacto+']').length > 0){

                    $('#panelListaContactos').find('li[idcontacto='+idContacto+']').siblings().removeClass('active');
                    $('#panelListaContactos').find('li[idcontacto='+idContacto+']').addClass('active');

                    $('#panelEditarContacto').removeClass('hidden');
                    $('#panelEditarContacto').find('form').addClass('hidden');
                    $('#panelEditarContacto').find('form[idcontacto='+idContacto+']').removeClass('hidden');


                    $('#panelInfoContacto').removeClass('hidden');
                    $('#panelInfoContacto').find('tr').addClass('hidden');
                    $('#panelInfoContacto').find('tr[idcontacto='+idContacto+']').removeClass('hidden');


                    $('#panelEncuestaContacto').removeClass('hidden');
                    $('#panelEncuestaContacto').find('.encuestaRow').addClass('hidden');
                    $('#panelEncuestaContacto').find('.encuestaRow[idcontacto='+idContacto+']').removeClass('hidden');
                }


        	}      	        	


        	/**** NUEVO CONTACTO ******/
        	$('#btnNuevoContacto').click(function () {
            //$('#cboTipoContacto').val("TELEFONO");            
            $('#modalContactoNuevo input').val("");
            $('#modalContactoNuevo #numdocAgregado').val($('#filtroDNIRUC').val());   
            $('#modalContactoNuevo #eNegocioAgregado').val("{{ Auth::user()->REGISTRO }}");        
            $('#modalContactoNuevo').modal();
            //initializeFormValidationNuevoContacto();
        })

        $('#modalContactoNuevo').on('hidden.bs.modal', function () {
        	$('#frmNuevoContacto').formValidation('destroy', true);
        });        	
        

        $('#frmNuevoContacto').formValidation({
            framework: 'bootstrap',
            icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                nombres: {
                    validators: {
                        notEmpty: {
                           message: 'El nombre del contacto es obligatorio'
                       },
                       regexp: {
                           regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                           message: 'El nombre solo puede tener caracteres alfabéticos'
                       }
                   }
                },
                apepat: {
                    validators: {
                        notEmpty: {
                            message: 'El apellido paterno del contacto es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El apellido solo puede tener caracteres alfabéticos'
                        }
                    }
                },
                apemat: {
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El apellido solo puede tener caracteres alfabéticos'
                        }
                    }
                },
               cargo: {
                    validators: {
                        notEmpty: {
                            message: 'El cargo del contacto es obligatorio'
                        },
                        regexp: {
                            regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
                            message: 'El cargo solo puede tener caracteres alfabéticos'
                        }
                    }
                },        		
                telefono: {
                    validators: {
                        notEmpty: {
                           message: 'Ingrese el teléfono del contacto'
                        },
                        regexp: {
                           regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                           message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                        }
                    }
                },
                direccion: {
                    validators: {
                        regexp: {
                           regexp: /^[a-zA-Z0-9ñÑáéíóúü#°().,\- ]+$/,
                           message: 'La dirección tiene uno o mas caracteres no válidos'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'El email del contacto es obligatorio'
                        },
                        emailAddress: {
                           message: 'El email ingresado no es válido'
                       }
                    }
                }
            }
        });
          /**** NUEVO TELEFONO ******/

          $('.btnNuevoNumero').click(function () {
            $('#modalNuevoNumero input').val("");
            $('#modalNuevoNumero input[name="lead"]').val($('#panelListaContactos ul>li.active').attr('idContacto'));
            $('#modalNuevoNumero input[name="anexo"]').parent('form-group').addClass('hidden');
            $('#modalNuevoNumero').modal();
            initializeFormValidationNuevoNumero();
        })

          $('#modalNuevoNumero').on('hidden.bs.modal', function () {
           $('#frmNuevoNumero').formValidation('destroy', true);
       })

        function initializeFormValidationNuevoNumero(){
            // Validación para formulario.
            $('#frmNuevoNumero').formValidation({
            	framework: 'bootstrap',
            	icon: {
            		valid: 'glyphicon glyphicon-ok',
            		invalid: 'glyphicon glyphicon-remove',
            		validating: 'glyphicon glyphicon-refresh'
            	},
            	fields: {
            		telefono: {
            			validators: {
            				notEmpty: {
            					message: 'Ingrese el teléfono del contacto'
            				},
            				regexp: {
            					regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
            					message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
            				}
            			}
            		},
            		anexo: {
            			validators: {
            				regexp: {
            					regexp: /^([0-9]+)$/,
            					message: 'El anexo debe tener solo dígitos'
            				}
            			}
            		}
            	}
            }).on('success.form.fv', function (e) {
                // El form se envía por AJAX
                e.preventDefault();
                var $form = $(e.target),
                fv = $form.data('formValidation');
                $form.formValidation('disableSubmitButtons', true);
                
                
                // Enviamos el formulario en ajax, si todo sale bien se agrega a la tabla de contactos la data
                $.ajax({
                	url: $form.attr('action'),
                	type: 'POST',
                	data: $form.serialize(),
                	success: function (result) {
                		$('#modalNuevoNumero').modal('hide');
                		html = '<td><label>' + $('#cboTipoContacto').find("option:selected").text() + ":" + '</label></td>'
                		html += '<td>' + result.telefono;
                        if (result.anexo){
                            html += ' - Anexo: ' + result.anexo;
                        }
                        html += '</td>'
                		html += '<td>' + '<i  aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto"></i>' +'</td>';
                		if ($('#tblContactos > tbody > tr').length > 0){
                			$('#tblContactos > tbody').prepend('<tr>' + html + '</tr>');
                		}
                		else{
                			$('#tblContactos > tbody').html('<tr>' + html + '</tr>');   
                		}
                		$form.formValidation('destroy', true);
                	},
                	error: function (xhr, status, text) {
                		e.preventDefault();
                		alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
                	}
                });
            }).on('change', '#cboTipoContacto', function () {
                form = $(this).closest('form');
                if ($(this).val() == 'Trabajo') {
                    form.find('input[name="anexo"]').closest('.form-group').removeClass("hidden");
                }else{
                    form.find('input[name="anexo"]').closest('.form-group').addClass("hidden");
                }
            });
        }

        


        /* ENCUESTA - TIPO CONTACTO */
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
        	var switchery = new Switchery(html, { size: 'big' });
        });



        $('#panelEncuestaContacto').on('click','.btnTipoContacto',function(){
        	if ($(this).hasClass('btn-default')){
        		$(this).removeClass('btn-default').addClass('btn-success');
        	}else{
        		$(this).removeClass('btn-success').addClass('btn-default');
        	}
        });


        $('body').on('click','.btnTipoContacto',function(){
        	var button = $(this);
        	$.ajax({
        		url: APP_URL + 'be/micontacto/set-contacto-tipo',
        		type: 'POST',
        		data: {
        			idcontacto: button.attr('contacto'),
        			tipo: button.attr('tipo'),
        			active: button.hasClass('btn-success')
        		},
        		success: function (result) {

        		},
        		error: function (xhr, status, text) {
        			e.preventDefault();
        			alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
        		}
        	});
        });

        $('body').on('change','.js-check-change',function(){
        	var item = $(this);

        	$.ajax({
        		url: APP_URL + 'be/micontacto/set-contacto-encuesta',
        		type: 'POST',
        		data: {
        			idcontacto: item.attr('contacto'),
        			tipo: item.attr('tipo'),
        			active: item.is(":checked")
        		},
        		success: function (result) {

        		},
        		error: function (xhr, status, text) {
        			e.preventDefault();
        			alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
        		}
        	});
        });

        /* FEEDBACK */
        $('.icon-feedback').click(function () {

        //Si quita un feedback
        if ($(this).hasClass('icon-feedback-active')) {

        	$(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
        	$(this).closest('tr').find('.cellTelefono').removeClass('tachado');
        	$.ajax({
        		type: "POST",
        		data: {
        			valor: $(this).attr('valor'),
        			lead: $(this).attr('lead'),
        			"_token": "{{ csrf_token() }}",
        		},
        		url: APP_URL + 'be/micontacto/quitar-feedback',
        		dataType: 'json',
        		success: function (json) {
        			console.log('listo!');
        		},
        		error: function (xhr, status, text) {
        			alert(text);        			
        		}
        	});
        } else {
            //Si agrega o cambia un feedback
            $(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
            $(this).addClass('icon-feedback-active');
            
            switch ($(this).attr('feedback')) {
            	case 'NEGATIVO':
            	$(this).closest('tr').find('.cellTelefono').addClass('tachado');
            	break;
            	case 'POSITIVO':
            	$(this).closest('tr').find('.cellTelefono').removeClass('tachado');
            }
            
            $.ajax({
            	type: "POST",
            	data: {
            		valor: $(this).attr('valor'),
            		lead: $(this).attr('lead'),
            		feedback: $(this).attr('feedback'),
            		"_token": "{{ csrf_token() }}"
            	},
            	url: APP_URL + 'be/micontacto/add-feedback',
            	dataType: 'json',
            	success: function (json) {
            		console.log('listo!');
            	},
            	error: function (xhr, status, text) {
            		alert(text);
            		$(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
            	}
            });
        }
    });


        /* FORMULARIO DATOS DE LEAD*/

        $('#frmDatosCliente select').change(function(){
        	$(this).closest('form').find('.btn').removeClass('hidden');
        });
        $('#frmDatosCliente').on('keypress','input',function(){
        	$(this).closest('form').find('.btn').removeClass('hidden');
        });

        $('#frmDatosCliente').formValidation({
        	framework: 'bootstrap',
        	icon: {
        		valid: 'glyphicon glyphicon-ok',
        		invalid: 'glyphicon glyphicon-remove',
        		validating: 'glyphicon glyphicon-refresh'
        	},
        	fields: {
        		telefono: {
        			validators: {
        				regexp: {
        					regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
        					message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
        				},
        			}
        		},
        		direccion: {
        			validators: {
        				regexp: {
        					regexp: /^[a-zA-Z0-9ñÑáéíóúü#°().,\- ]+$/,
        					message: 'La dirección ingresada tiene un caracter no válido'
        				},
        			}
        		}
        	}
        }).on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
            fv = $form.data('formValidation');
            $form.formValidation('disableSubmitButtons', true);
            
            
            // Enviamos el formulario en ajax, si todo sale bien se agrega a la tabla de contactos la data
            $.ajax({
            	url: $form.attr('action'),
            	type: 'POST',
            	data: $form.serialize(),
            	success: function (result) {
            		$form.find('.btn').addClass('hidden');
            	},
            	error: function (xhr, status, text) {
            		e.preventDefault();
            		alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
            	}
            });
        })



        /*Form Update Contacto*/

        $('.formEditarContacto select').change(function(){
        	$(this).closest('form').find('.btn').removeClass('hidden');
        });
        $('.formEditarContacto').on('keypress','input',function(){
        	$(this).closest('form').find('.btn').removeClass('hidden');
        });
        /*$('.formEditarContacto').on('click','button',function(){            
            var nombres = $(this).parent('form').find('#nombres').val()
            var apaterno = $(this).parent('form').find('#apaterno').val()
            var idContacto = $(this).parent('form').attr('idcontacto')
            console.log(nombres);
            console.log(apaterno);
            console.log(idContacto);
            console.log(nombres + " "+ apaterno);
            $('#panelListaContactos').find('li[idcontacto='+idContacto+'] a').text(nombres + " "+ apaterno)                                    
        });*/

        $('.formEditarContacto').formValidation({
        	framework: 'bootstrap',
        	icon: {
        		valid: 'glyphicon glyphicon-ok',
        		invalid: 'glyphicon glyphicon-remove',
        		validating: 'glyphicon glyphicon-refresh'
        	},
        	fields: {
        		numdoccontacto: {
        			validators: {
        				stringLength: {
        					min: 8,
        					max: 8,
        					message: 'El documento debe tener 8 dígitos'
        				},
        				regexp: {
        					regexp: /^[0-9]+$/,
        					message: 'El documento solo puede tener dígitos'
        				}
        			}
        		},
        		nombre: {
        			validators: {
        				notEmpty: {
        					message: 'El nombre del contacto es obligatorio'
        				},
        				regexp: {
        					regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
        					message: 'El nombre solo puede tener caracteres alfabéticos'
        				}
        			}
        		},
        		apaterno: {
        			validators: {
        				notEmpty: {
        					message: 'El apellido del contacto es obligatorio'
        				},
        				regexp: {
        					regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
        					message: 'El apellido solo puede tener caracteres alfabéticos'
        				}
        			}
        		},
        		amaterno: {
        			validators: {
        				regexp: {
        					regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
        					message: 'El apellido solo puede tener caracteres alfabéticos'
        				}
        			}
        		},
        		cargo: {
        			validators: {
        				notEmpty: {
        					message: 'El apellido del contacto es obligatorio'
        				},
        				regexp: {
        					regexp: /^[a-zA-ZñÑáéíóúü ]+$/,
        					message: 'El cargo solo puede tener caracteres alfabéticos'
        				}
        			}
        		},
        		direccion: {
        			validators: {
        				regexp: {
        					regexp: /^[a-zA-Z0-9ñÑáéíóúü#°().,\- ]+$/,
        					message: 'La dirección tiene uno o mas caracteres no válidos'
        				}   
        			}
        		},
        		email: {
        			validators: {
        				emailAddress: {
        					message: 'El email ingresado no es válido'
        				},
                        notEmpty: {
                            message: 'El email es obligatorio'
                        },
        			}
        		}
        	}
        }).on('success.form.fv', function (e) {
            // El form se envía por AJAX
            e.preventDefault();
            var $form = $(e.target),
            fv = $form.data('formValidation');
            $form.formValidation('disableSubmitButtons', true);
            
            
            // Enviamos el formulario en ajax, si todo sale bien se agrega a la tabla de contactos la data
            $.ajax({
            	url: $form.attr('action'),
            	type: 'POST',
            	data: $form.serialize(),
            	success: function (result) {
            		$form.find('.btn').addClass('hidden'); 
                    var nombres = $form.find('#nombres').val()
                    var apaterno = $form.find('#apaterno').val()
                    var idContacto = $form.attr('idcontacto')
                    $form.formValidation('destroy', true);
                    $('#panelListaContactos').find('li[idcontacto='+idContacto+'] a').text(nombres + " "+ apaterno)                                                                  
            	},
            	error: function (xhr, status, text) {
            		e.preventDefault();
            		alert('Hubo un error al registrar el dato de contacto, inténtelo mas tarde');
            	}
            });
        });

         $('.formatInputNumber').keyup(function () {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        });
        
        /************UBIGEO****************/
        if ($('#cboDepartamento').length > 0){
        	cboDepartamentoChange($('#cboDepartamento').val(),$('#cboProvincia').val(),$('#cboDistrito').val());
        }else{
        	if ($('#cboProvincia').length > 0){
        		cboProvinciaChange($('#cboProvincia').val(),$('#cboDistrito').val());    
        	}            
        }
        
        $('#cboProvincia').change(function(){
        	cboProvinciaChange($(this).val(),null);
        });

        $('#cboDepartamento').change(function(){
        	cboDepartamentoChange($(this).val(),null,null);
        });
    });


</script>
@stop