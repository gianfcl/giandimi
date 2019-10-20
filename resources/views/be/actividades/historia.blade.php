@if(count($actividades)>0)                            
@foreach($actividades as $actividad)
<li class="@if($actividad->TIPO=='CAMBIO DE ESTADO')
    {{'CAMBIO'}}
    @ELSE
    {{$actividad->TIPO}}
    @ENDIF">
    <div class="cbp_tmicon"> <?php
        switch ($actividad->TIPO) {
            case 'VISITA' :
                $tipoIcono = 'fa-home';
                break;
            case 'LLAMADA' :
                $tipoIcono = 'fa-phone';
                break;
            case 'CORREO':
                $tipoIcono = 'fa-envelope';
                break;
            CASE 'CAMBIO DE ESTADO' :
                $tipoIcono = 'fa-exchange';
                break;
        }
        ?>
        <i class="fa {{$tipoIcono}}"></i></div>
    <div class="cbp_tmlabel" style="
        @if($actividad->TIPO=='CAMBIO DE ESTADO')        {{'background-color: #FCE16D'}}         @ELSE         {{'background-color: #F5F7FA'}}         @ENDIF;">
        <div  class="col-md-12 col-sm-12 col-xs-12" >
            <div class="col-md-4 col-sm-4 col-xs-12" style="border-right: 3px solid #FFFFFF;">                                                    
                <h5 style="color:#46a4da ;"><strong> {{$actividad->TITULO}}</strong></h5>
                <label style="margin-top: 5px;">{{Jenssegers\Date\Date::parse($actividad->FECHA_ACTIVIDAD)->format('j \d\e F \d\e Y')}}</label><br>                                                    
                <div class="row top" style="margin-top: 10px;">         
                    <div class="col-md-6">
                        <ul class="fa-ul">

                            @if ($actividad->TIPO=='CAMBIO DE ESTADO')
                                <li><i class="fa-li fa fa-user"></i>{{$actividad->NOMBRE}}</li>
                            @endif

                            @foreach($actividad->P_IBK as $pibk)
                                @if($pibk!='')
                                    <li><i class="fa-li fa fa-user"></i>{{$pibk}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div  class="col-md-6">
                        <ul class="fa-ul">
                            <?php $pclientes = $actividad->P_CLIENTES ?>
                            @if(count($pclientes)>0)                                                               
                            @foreach($pclientes as $pcliente)
                            @if($pcliente!='')
                            <li><i class="fa-li fa fa-user"></i>{{$pcliente}}</li>
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>	
            @IF($actividad->TIPO=='CAMBIO DE ESTADO')
                <div  class="col-md-4 col-sm-4 col-xs-12">
                    <p  style="margin: 0px;" >{{$actividad->TEMAS_COMERCIALES}}</p>
                    <p style="margin: 0px;">{{$actividad->TEMAS_CREDITICIOS}}</p>
                </div>
            @ELSE
            <div  class="col-md-4 col-sm-4 col-xs-12">
                <h4>Temas Comerciales</h4>
                <p  style="margin: 0px;" >{{$actividad->TEMAS_COMERCIALES}}</p>

            </div>
            <div  class="col-md-4 col-sm-4 col-xs-12">
                <h4>Temas Crediticios</h4>
                <p style="margin: 0px;">{{$actividad->TEMAS_CREDITICIOS}}</p>
            </div>
            @ENDIF											
        </div>
    </div>
</li>
@endforeach
    @if ($actividades->currentPage() < $actividades->lastPage())
        <div align="center"><button class="btn btn-primary masActividades" pagina="{{($actividades->currentPage() + 1)}}" type="button">
            <i class="fa fa-spinner fa-spin fa-fw hidden"></i> Más Actividades</button>
        </div>
    @else
        <div align='center' style='margin-bottom: 5px;'>
            <h2 id='notFound'>No se encontraron más resultados</h2>
        </div>    
    @endif
@else
<div align='center' style='margin-bottom: 5px;'>
    <h2 id='notFound'>No se encontraron más resultados</h2>
</div>
@endif
