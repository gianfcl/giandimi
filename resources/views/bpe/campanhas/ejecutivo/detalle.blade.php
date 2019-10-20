@extends('Layouts.layout')

@section('js-libs')
<link href="{{ URL::asset('css/formValidation.min.css') }}" rel="stylesheet" type="text/css" > 
<link href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" >

<script type="text/javascript" src="{{ URL::asset('js/formvalidation/formValidation.popular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/formvalidation/language/es_CL.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

@stop


@section('pageTitle', 'Detalle de Lead')

<?php
    // Evaluar si este blade lo esta viendo el ejecutivo o un gerente
    $modoJefe = in_array(Auth::user()->ROL,[App\Entity\Usuario::ROL_GERENTE_ZONA, App\Entity\Usuario::ROL_GERENTE_CENTRO]) 
?>

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos del Lead</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Documento:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="({{ $lead->TIPO_DOCUMENTO }}) {{ $lead->NUM_DOC }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->NOMBRE_CLIENTE }}">
                        </div>
                    </div>
                    @if ($lead->TIPO_DOCUMENTO === 'RUC')
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Representante:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->REPRESENTANTE_LEGAL }}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Distrito:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->DISTRITO }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->DIRECCION }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tienda:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->TIENDA }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Giro/Actividad:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->GIRO }} - {{ $lead->ACTIVIDAD }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Score:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="{{ $lead->SCORE_BURO }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Deuda:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" readonly="readonly" value="({{ $lead->BANCO_PRINCIPAL_SSFF }}) {{ $lead->DEUDA_SSFF_MONEDA}} {{ number_format($lead->DEUDA_SSFF,0,'.',',') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos de Contacto</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblContactos" class="table table-condensed">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $key => $contacto)
                        <tr>
                            <td><label>{{ ucwords(strtolower($contacto->TIPO_CONTACTO)) }}:</label></td>
                            <td>{{ $contacto->VALOR }}</td>
                            <td>
                                <i  aria-hidden="true" class="fa fa-thumbs-o-up icon-feedback-active" data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($telefonos as $key => $telefono)
                        <tr>
                            <td><label>Telefono {{ ($key + 1) }}:</label></td>
                            <td class="cellTelefono <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'tachado' : '' ?>">{{ $telefono }}</td>
                            <td>
                                @if (!$modoJefe)
                                <i 
                                    feedback="POSITIVO"  lead="{{ $lead->NUM_DOC }}"  telefono="{{ $telefono }}" aria-hidden="true"
                                    class="icon-feedback fa fa-thumbs-o-up <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'POSITIVO') ? 'icon-feedback-active' : '' ?>" 
                                    data-toggle="tooltip" data-placement="top" title="Número correcto">
                                </i>
                                <i feedback="NEUTRO" lead="{{ $lead->NUM_DOC }}" telefono="{{ $telefono }}" aria-hidden="true" 
                                    class="icon-feedback fa fa-meh-o <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEUTRO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="No contestó">
                                        
                                </i>
                                </i>
                                <i feedback="NEGATIVO" lead="{{ $lead->NUM_DOC }}" telefono="{{ $telefono }}" aria-hidden="true" 
                                      class="icon-feedback fa fa-thumbs-o-down <?php echo (isset($feedback[$telefono]) && $feedback[$telefono] == 'NEGATIVO') ? 'icon-feedback-active' : '' ?>"
                                    data-toggle="tooltip" data-placement="top" title="Número erróneo">          
                                </i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (!$modoJefe)
                <button id="btnNuevoContacto" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Datos de Contacto</button>
                @endif
            </div>
        </div>

    </div>

    <div class="col-md-6 col-sm-6 cold-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Campañas de Cliente</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php ?>
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    @foreach ($campanhas as $key => $campanha)
                    <li role="presentation" class="<?php echo $key === key(reset($campanhas)) ? 'active' : '' ?>"><a href="#tab_camp_{{ $campanha->ID_CAMP_EST}}" id="{{ $campanha->NOMBRE}}-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ $campanha->NOMBRE}}</a></li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($campanhas as $key => $campanha)
                    <div role="tabpanel" class="tab-pane <?php echo $key === key(reset($campanhas)) ? 'active' : '' ?>" id="tab_camp_{{$campanha->ID_CAMP_EST}}">
                        <form class="form-horizontal form-label-left">
                            <?php
                                $atributos = explode('|', $campanha->ATRIBUTO);
                                $tipos = explode('|', $campanha->TIPO);
                                $valores = explode('|', $campanha->VALOR);
                                $condicional = explode('|', $campanha->CONDICIONAL);
                                
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-5">Campaña:</label>
                                    <label class="info-label col-xs-7">{{ $campanha->NOMBRE }}</label>
                                </div>
                                @foreach ($atributos as $key => $atributo)
                                    @if ($condicional[$key] == 0)
                                    <div class="form-group">
                                        <label class="control-label col-xs-5">{{ $atributos[$key] }}:</label> 
                                        <label class="info-label col-xs-7">
                                            {{ \App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key]) }}
                                        </label>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @if (count(array_filter(array_unique($condicional))) > 0 and current(array_filter(array_unique($condicional))) == 1)
                                <p style="text-decoration: underline; text-align: center; font-weight: 700">Compra de Deuda Repotenciada</p>
                                @endif
                                @foreach ($atributos as $key => $atributo)
                                    @if ($condicional[$key] > 0)
                                    <div class="form-group">
                                        <label class="control-label col-xs-5">{{ $atributos[$key] }}:</label> 
                                        <label class="info-label col-xs-7">
                                            {{ \App\Entity\Campanha::formatAtributoCampanha($tipos[$key],$valores[$key]) }}
                                        </label>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </form>

                        <div class="ln_solid"></div>
                        <div class="divGestionArea form-group">
                            <div class="divGestionInfo form-group">
                                <form class="form-horizontal form-label-left">
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Resultado:</label>
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblResultado">{{ $campanha->GESTION_RESULTADO }}</label>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) &&($campanha->GESTION_VOLVER_LLAMAR!=NULL)? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha Tentativa Contacto:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblVolverLLamar">{{ $campanha->GESTION_VOLVER_LLAMAR }}</label>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO)? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Motivo:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblMotivo">{{ $campanha->GESTION_MOTIVO }}</label>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Comentario:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblComentario">{{ isset($campanha->GESTION_COMENTARIO)? $campanha->GESTION_COMENTARIO:"-" }}</label>
                                    </div>
                                    <div class="form-group <?php echo isset($lead->FECHA_CITA) && isset($campanha->GESTION_VISITADO) ? '' : 'hidden' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Visitado:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblVisitado">{{ $campanha->GESTION_VISITADO }}</label>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) ? '' : 'hidden' ?>">
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="button" class="btn btn-sm btn-success btnEditarGestion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</button>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) ? 'hidden' : '' ?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Estado:</label> 
                                        <label class="info-label col-md-9 col-sm-9 col-xs-9 lblSinGestion" style="font-weight: 800; color: #FA503A;">SIN GESTION</label>
                                    </div>
                                    <div class="form-group <?php echo isset($campanha->GESTION_RESULTADO) ? 'hidden' : '' ?>">
                                        @if (!$modoJefe)
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <button type="button" class="btn btn-sm btn-success btnGestionar"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Gestionar</button>
                                        </div>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            <div class="divGestionForm hidden">
                                <form id="gestionForm" class="gestionForm form-horizontal" action="{{ route('bpe.campanha.ejecutivo.leads.nueva-gestion') }}" method="POST">
                                    <input type="hidden" name="campanha" value="{{ $campanha->ID_CAMP_EST }}" >
                                    <input type="hidden" name="periodo" value="{{ $campanha->PERIODO }}" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                    <input type="hidden" name="regEjecutivo" value="{{ $lead->EN_REGISTRO }}">
                                    <input type="hidden" name="lead" value="{{ $lead->NUM_DOC }}">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Resultado:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control cboResultado" name="resultado" id="resultado">
                                                <option value="">Elige una opción</option>
                                                @foreach ($resultados[$campanha->ID_CAMP_EST] as $resultado)
                                                <option value="{{ $resultado->id }}">{{ $resultado->desc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control cboMotivo" name="motivo" id="motivo">
                                                <option value="">Elige una opción</option>
                                                @foreach ($motivos as $motivo)
                                                <option value="{{ $motivo->id }}">{{ $motivo->desc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group hidden">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Tentativa:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control dpFecha" id="dpFecha" name="fecha">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control txtComentario" name="comentario" maxlength="150" id="comentario" placeholder="Max. 150 caracteres">
                                        </div>
                                    </div>

                                    @if(!empty($lead->FECHA_CITA))
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Visita:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control cboVisita" name="visita">
                                                <option value="VISITADO">Visitado</option>
                                                <option value="DESCARTADO">Descartado</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-12 form-group">
                                        <button type="button" class="btn btnCancelarGestion">Cancelar</button>
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Gestión</button>
                                    </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Detalle de Cita
                    @if($lead->CITA_ESTADO == \App\Entity\CitaEstado::REPROGRAMADO)
                        <small>*Reprogramada</small>
                    @endif
                </h2>
                <ul class="nav navbar-right panel_toolbox">

                @if (!$modoJefe)
                    @if($lead->CITA_ESTADO && in_array($lead->CITA_ESTADO,\App\Entity\CitaEstado::getEstadosParaReprogramacion()))
                    <li><a id="btnReprogramar" href="#" target="_blank" class="collapse-link">
                    <i class="fa fa-calendar" aria-hidden="true"></i> Reprogramar</a></li>
                    @endif
                @endif

            </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(empty($lead->FECHA_CITA))
                <label>No tiene cita alguna programada con el cliente</label>
                @else
                <?php $fecha = Jenssegers\Date\Date::createFromFormat('Y-m-d H:i', $lead->FECHA_CITA) ?>

                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha:</label>
                        <label class="info-label col-md-6 col-sm-6 col-xs-6">{{ $fecha->format('l j \d\e F') }}</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Hora:</label> 
                        <label class="info-label col-md-6 col-sm-9 col-xs-9">{{ $fecha->format('H:i') }}</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Contacto:</label> 
                        <label class="info-label col-md-9 col-sm-9 col-xs-9">{{ $lead->CITA_CONTACTO_PERSONA }}</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Teléfono:</label> 
                        <label class="info-label col-md-9 col-sm-9 col-xs-9">{{ $lead->CITA_CONTACTO_TELEFONO }}</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Dirección:</label> 
                        <label class="info-label col-md-9 col-sm-9 col-xs-9">{{ $lead->CITA_CONTACTO_DIRECCION }}</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Referencia:</label> 
                        <label class="info-label col-md-9 col-sm-9 col-xs-9">{{ $lead->CITA_CONTACTO_REFERENCIA }}</label>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<!-- Template de formulario de nueva gestion -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Gestiones anteriores</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="tblGestiones" class="table table-striped jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Ejecutivo</th>
                            <th>Campaña</th>
                            <th>Fecha</th>
                            <th>Resultado</th>
                            <th>Motivo/Volver LLamar</th>
                            <th>Visitado?</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($gestiones)>0)
                        @foreach ($gestiones as $gestion)
                        <tr>
                            <td>{{$gestion->EJECUTIVO}}</td>
                            <td>{{$gestion->CAMP_EST_NOMBRE}}</td>
                            <td>{{$gestion->FECHA_REGISTRO}}</td>
                            <td>{{$gestion->GESTION_RESULTADO}}</td>
                            <td>{{($gestion->FECHA_VOLVER_LLAMAR ==NULL)? $gestion->GESTION_MOTIVO: $gestion->GESTION_MOTIVO.' / '. $gestion->FECHA_VOLVER_LLAMAR}}</td>
                            <td>{{isset($gestion->VISITADO)? $gestion->VISITADO:'-'}}</td>
                            <td>{{isset($gestion->COMENTARIO)? $gestion->COMENTARIO:'-'}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="emptyResult">
                            <td colspan="7">No se encontraron gestiones previas</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.Modal Agregar Contacto -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalNuevoContacto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Contacto</h4>
            </div>
            <form id="frmNuevoContacto" class="form-horizontal form-label-left" action="{{ route('bpe.campanha.ejecutivo.leads.nuevo-contacto') }}">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="lead" value="{{ $lead->NUM_DOC }}">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Contacto:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="cboTipoContacto" id="cboTipoContacto" class="form-control">
                                <option value="TELEFONO">Teléfono</option>
                                <option value="DIRECCION">Dirección</option>
                                <option value="EMAIL">Email</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lblContacto">Teléfono:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="txtContacto" name="txtContacto" class="form-control" type="text" value="" maxlength="150">
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

<!-- /.Modal Reprogramacion -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalReprogramacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reprogramar Cita</h4>
            </div>
            <form id="frmReprogramarCita" class="form-horizontal form-label-left" action="{{route('bpe.campanha.ejecutivo.leads.reprogramar-cita') }}" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-dismissible alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Recuerda que solo puedes reprogramar una cita <strong>una sola vez</strong>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input type="hidden" name="ejecutivo" value="{{ $lead->EN_REGISTRO }}">
                    @if(!empty($lead->FECHA_CITA))
                        <input type="hidden" name="cita" value="{{ $lead->ID_CITA }}">
                    @endif
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="" >Fecha</label>
                            <input type="text" class="form-control" name="fecha" onkeydown="return false">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Hora</label>
                            <select class="form-control" name="hora">
                                @foreach($horasDisponibles as $key => $hora)
                                    <option value="{{ $key }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 form-group">
                            <table class="table table-condensed table-calendar-cita">
                                <thead> 
                                    <tr>
                                        <th></th> 
                                        @foreach ($calendario as $dia)
                                        <th>{{ $dia }}</th>
                                        @endforeach
                                    </tr> 
                                </thead> 
                                <tbody>
                                    @foreach ($horario as $khora => $hora)
                                    <tr>
                                        <th>{{ $hora }}</th>
                                        @foreach ($calendario as $kdia => $dia)
                                        <td class="celda-horario">
                                        @if (in_array($kdia.'-'.$khora,$horarioEjecutivo))
                                            <span class="glyphicon glyphicon-ban-circle" style="color: #A94442;"></span> <span style="color: #A94442;">Ocupado<span>
                                        @else
                                        </td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Reprogramar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('js-scripts')
<script>
$(document).ready(function () {


    /************ REPROGRAMACION DE CITA ******************/
    $('#btnReprogramar').click(function (e) {
        e.preventDefault();
        initializeDPReprogramacion();
        $('#modalReprogramacion').modal();
    });

    function initializeDPReprogramacion() {
        var today = new Date();
        var lastDate = new Date(today.getFullYear(), today.getMonth(0), 31);
        $("#modalReprogramacion input[name='fecha']").datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "+1d",
            endDate: lastDate,
            format: "yyyy-mm-dd"
        }).on('changeDate', function (e) {
            $(this).closest('form').formValidation('revalidateField', 'hora');
        });
    }

    $('#frmReprogramarCita').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            hora: {
                validators: {
                    remote: {
                        message: 'El horario seleccionado ya está ocupado',
                        url: APP_URL + '/bpe/campanha/validator/horarioEjecutivo',
                        data: function (validator, $field, value) {
                            return {
                                ejecutivo: validator.getFieldElements('ejecutivo').val(),
                                fecha: validator.getFieldElements('fecha').val(),
                                cita: null
                            };
                        },
                        type: 'GET'
                    }
                }
            }
        }
    });
    
    /************ NUEVO CONTACTO ******************/
    
    // Cuando se abre el modal limpiamos el formulario de contacto
    $('#btnNuevoContacto').click(function () {
        $('#cboTipoContacto').val("TELEFONO");
        $('#lblContacto').text("Teléfono:");
        $('#txtContacto').val("");
        $('#modalNuevoContacto').modal();
        initializeFormValidationContacto();
    })

    $('#modalNuevoContacto').on('hidden.bs.modal', function () {
        $('#frmNuevoContacto').formValidation('destroy', true);
    })
    
    function initializeFormValidationContacto(){
        // Validación para formulario.
        $('#frmNuevoContacto').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                txtContacto: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un dato de contacto'
                        },
                        regexp: {
                            regexp: /^([0-9]{6}|[0-9]{7}|[0-9]{9})$/,
                            message: 'El número telefónico debe tener 6, 7 ó 9 dígitos'
                        },
                        emailAddress: {
                            enabled: false,
                            message: 'El email ingresado no es válido. (miemail@dominio.com)'
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
                    $('#modalNuevoContacto').modal('hide');
                    html = '<td><label>' + $('#cboTipoContacto').find("option:selected").text() + ":" + '</label></td>'
                    html += '<td>' + $('#txtContacto').val() + '</td>'
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
            // Cada vez que cambiemos el combo de tipo de contacto, limpiamos data y re configuramos el validador para que se adapte al caso
            $('#lblContacto').text($(this).find("option:selected").text() + ":");
            $('#txtContacto').val("");
            
            switch ($(this).val()) {
                case "TELEFONO":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', true, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', true, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
                case "EMAIL":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', true, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', false, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
                case "DIRECCION":
                    $('#frmNuevoContacto')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'emailAddress')
                            //.formValidation('enableFieldValidators', 'txtContacto', false, 'stringLength')
                            .formValidation('enableFieldValidators', 'txtContacto', false, 'regexp')
                            .formValidation('revalidateField', 'txtContacto');
                    break;
            }
        });

    }

    
    /****************** FEEDBACK *********************/
    
    $('[data-toggle="tooltip"]').tooltip();

    // Cuando le de click a alguno de los botones de feedback
    $('.icon-feedback').click(function () {
        
        //Si quita un feedback
        if ($(this).hasClass('icon-feedback-active')) {
            
            $(this).parent().children('.icon-feedback').removeClass('icon-feedback-active');
            $(this).closest('tr').find('.cellTelefono').removeClass('tachado');
            $.ajax({
                type: "POST",
                data: {
                    telefono: $(this).attr('telefono'),
                    lead: $(this).attr('lead'),
                    "_token": "{{ csrf_token() }}",
                },
                url: APP_URL + '/bpe/quitar-feedback',
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
                    $('#txtTelefono').val($(this).attr('telefono'));
                case 'NEUTRO':
                    $(this).closest('tr').find('.cellTelefono').removeClass('tachado');
                    break;
            }
            
            if ($(this).attr('feedback') === 'POSITIVO') {
                $('#txtTelefono').val($(this).attr('telefono'));
            }
            
            $.ajax({
                type: "POST",
                data: {
                    telefono: $(this).attr('telefono'),
                    lead: $(this).attr('lead'),
                    feedback: $(this).attr('feedback'),
                    "_token": "{{ csrf_token() }}"
                },
                url: APP_URL + '/bpe/registrar-feedback',
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
    
    /****************** GESTIONAR CAMPAÑA-LEAD*********************/
    
    function cleanForm(form){
        form.find('select').val('');
        form.find('input[type=text]').val('');
        form.find('.cboMotivo').val('');
        form.find('.cboMotivo option:not(:first)').remove();
    }
    // Comportamiento de Botonos Gestionar/Editar/Cancelar que ocultan y muestran paneles
    $('.btnGestionar').click(function () {
        cleanForm($(this).closest('form'));
        mostrarForm($(this));

    });
    
    $('.btnEditarGestion').click(function () {
        cleanForm($(this).closest('form'));
        mostrarForm($(this));
    });
    
    $('.btnCancelarGestion').click(function () {
        var form = $(this).closest('form');
        form.formValidation('destroy', true);
        $(this).closest('.divGestionForm').addClass('hidden');
        $(this).closest('.divGestionArea').find('.divGestionInfo').removeClass("hidden");
    });
    
    function mostrarForm(button) {
        button.closest('.divGestionArea').find('.divGestionForm').removeClass("hidden");
        initializeFormValidationGestion(button.closest('.divGestionArea').find('.divGestionForm form'));
        button.closest('.divGestionInfo').addClass('hidden');
    }
    
    // Funcion para inicilizar los datepicker
    function initializeDatepicker() {
        $('.dpFecha').datepicker({
            maxViewMode: 1,
            daysOfWeekDisabled: "0,6",
            language: "es",
            autoclose: true,
            startDate: "+1d",
            endDate: "+90d",
            format: "yyyy-mm-dd"
        }).on('changeDate', function (e) {
            $(this).closest('form').formValidation('revalidateField', 'fecha');
        });
    }
    
    
    // FORMULARIO
    //Elimina todas las opciones de motivo excepto la primera (necesario para evitar problemas al enviar formulario)
    $('.cboMotivo option').not(':eq(0), :selected').remove();
    
    //Cuando se seleccione una opcion en Resultado
    function cboResultadoChange(combobox) {
        var resultado = combobox.val();
        var form = combobox.closest('form');
        console.log(resultado);
        //Limpiamos el combobox de motivos
        //console.log(form.find('.cboMotivo'));
        //console.log(form.find('.cboMotivo option:not(:first)'));
        
        
        //Si no selecionada nada como resultado
        if (resultado === '') {
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            form.find('.dpFecha').closest('.form-group').addClass("hidden");
            return;
        }
        
        //Si selecciona lo pensará como resultado (Modificado por nuevos requerimientos)
        /*if ($("option:selected", combobox).text() === 'LO PENSARA') {
            form.find('.cboMotivo').closest('.form-group').addClass("hidden");
            form.find('.dpFecha').closest('.form-group').removeClass("hidden");
            initializeDatepicker();
            return;
        }*/

        
        
        //Si selecciona cualquier otro resultado
        form.find('.cboMotivo').prop('disabled', true);
        form.find('.cboMotivo').closest('.form-group').removeClass("hidden");
        form.find('.dpFecha').closest('.form-group').addClass("hidden");
        
        $.ajax({
            type: "GET",
            data: {resultado: resultado},
            url: APP_URL + '/bpe/campanha/utils/get-motivo-by-resultado',
            dataType: 'json',
            success: function (json) {
                form.find('.cboMotivo option:not(:first)').remove();
                $.each(json, function (key, value) {
                    form.find('.cboMotivo').append($("<option></option>")
                            .attr("value", value.id).text(value.desc));
                });
                form.find('.cboMotivo').prop('disabled', false);
                form.formValidation('revalidateField', 'motivo');
            }
        });
    }
    
    /*Cuando se cambie el motivo*/
    function cboMotivoChange(cboMotivo){
        const motivosFecha=[64,65,66,67];
        var form = cboMotivo.closest('form');
        var valor=Number(cboMotivo.val());
        //console.log(motivosFecha.indexOf(valor),valor);
        if (motivosFecha.indexOf(valor)>=0){
            console.log("HOLA");
            form.find('.dpFecha').closest('.form-group').removeClass("hidden");
            initializeDatepicker();
        }
        else{
            form.find('.dpFecha').closest('.form-group').addClass("hidden");
        }
    }


    /*Validacion del formulario de gestión*/
    
    function initializeFormValidationGestion(form) {
        form.formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                resultado: {
                    validators: {
                        notEmpty: {
                            message: 'El resultado de la gestión es requerido'
                        }
                    }
                },
                
                motivo: {
                    validators: {
                        notEmpty: {
                            message: 'El motivo de la gestión es requerido'
                        }
                    }
                },
                fecha: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una fecha tentativa de contacto'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'La fecha no es válida'
                        }
                    }
                },
                comentario: {
                    validators: {
                        notEmpty: {
                            enabled: false,
                            message: 'El comentario es requerido'
                        },
                        stringLength: {
                            min: 10,
                            max: 150,
                            message: 'El comentario de la gestión debe tener al menos 10 caracteres'
                        }
                    }
                }
            }
        }).on('change', '.cboResultado', function () {
            cboResultadoChange($(this));
            thisForm = $(this).closest('form');
            
            if ($("option:selected", this).text() === 'LO PENSARA') {
                //Obligatorio el comentario
                thisForm.formValidation('enableFieldValidators', 'comentario', true, 'notEmpty'); 
            } else {
                thisForm.formValidation('enableFieldValidators', 'comentario', false, 'notEmpty');
            }
            thisForm.formValidation('revalidateField', 'comentario');
            
        }).on('change','.cboMotivo',function(){
            cboMotivoChange($(this))
        }).on('success.form.fv', function (e) {
            var $form = $(e.target);
            $form.formValidation('disableSubmitButtons', true);
            e.preventDefault();
            
            // Enviamos el formulario en ajax,
            $.ajax({
                url: APP_URL + 'bpe/en/nueva-gestion',
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    divInfo = $form.closest('.divGestionArea').find('.divGestionInfo');
                    
                    // Dibujando el area de gestion/campaña
                    divInfo.find('.lblResultado').text(result.GESTION_RESULTADO).closest('.form-group').removeClass("hidden");
                    divInfo.find('.lblComentario').text(!result.COMENTARIO ? '-' : result.COMENTARIO).closest('.form-group').removeClass("hidden");
                    divInfo.find('.btnEditarGestion').closest('.form-group').removeClass("hidden");
                    divInfo.find('.btnGestionar').closest('.form-group').addClass("hidden");
                    divInfo.find('.lblSinGestion').closest('.form-group').addClass("hidden");
                    
                    if (result.VISITADO === null) {
                        divInfo.find('.lblVisitado').closest('.form-group').addClass("hidden");
                    } else {
                        divInfo.find('.lblVisitado').text(result.VISITADO).closest('.form-group').removeClass("hidden");
                    }

                    /*if (result.GESTION_RESULTADO === 'LO PENSARA') {
                        divInfo.find('.lblVolverLLamar').text(result.FECHA_VOLVER_LLAMAR).closest('.form-group').removeClass("hidden");
                        divInfo.find('.lblMotivo').text(result.GESTION_MOTIVO).closest('.form-group').removeClass("hidden");
                    } else {
                        divInfo.find('.lblVolverLLamar').text(result.FECHA_VOLVER_LLAMAR).closest('.form-group').addClass("hidden");
                        divInfo.find('.lblMotivo').text(result.GESTION_MOTIVO).closest('.form-group').removeClass("hidden");
                    }
                    */
                    //console.log(result.FECHA_REGISTRO);
                    if(result.FECHA_VOLVER_LLAMAR){                        
                        divInfo.find('.lblVolverLLamar').text(result.FECHA_VOLVER_LLAMAR).closest('.form-group').removeClass("hidden");
                    }

                    //Agregando item a tabla historica de gestiones
                    html = '<td>' + result.EJECUTIVO + '</td>';
                    html += '<td>' + result.CAMP_EST_NOMBRE + '</td>';
                    html += '<td>' + result.FECHA_REGISTRO + '</td>';
                    html += '<td>' + result.GESTION_RESULTADO + '</td>';
                    html += '<td>' + (result.FECHA_VOLVER_LLAMAR ? result.GESTION_MOTIVO+' / '+result.FECHA_VOLVER_LLAMAR: result.GESTION_MOTIVO) + '</td>';
                    html += '<td>' + (!result.VISITADO ? '-' : result.VISITADO) + '</td>';
                    html += '<td>' + (!result.COMENTARIO ? '-' : result.COMENTARIO) + '</td>';
                    
                    $('#tblGestiones > tbody > tr:first').before('<tr>'+ html +'</tr>');
                    $('#tblGestiones > tbody').find('.emptyResult').remove();
                    
                    //Cerrando Formulario
                    $form.formValidation('destroy', true);
                    $form.closest('.divGestionForm').addClass("hidden");
                    divInfo.removeClass("hidden");
                    cleanForm($form);
                    
                },
                error: function (xhr, status, text) {
                    $form.closest('.divGestionForm').addClass("hidden");
                    $form.closest('.divGestionArea').find('.divGestionInfo').removeClass("hidden");
                    cleanForm($form); 
                    alert('Hubo un error al registrar su información. Inténtelo nuevamente');
                }
            });
        });
    }
    
});
</script>
@stop
