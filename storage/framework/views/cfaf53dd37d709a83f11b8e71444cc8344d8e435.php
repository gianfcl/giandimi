<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <link rel="shortcut icon" href="<?php echo e(URL::asset('img/ibk.png')); ?>">

        <title><?php echo $__env->yieldContent('pageTitle'); ?> - VPConnect</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        -->

        <!-- CSS-->
        <link href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(URL::asset('css/custom/custom.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(URL::asset('css/custom/webvpc.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(URL::asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(URL::asset('css/font-awesome-5.7.1.min.css')); ?>" rel="stylesheet" type="text/css">


        <!--JS-->

        <script type="text/javascript"  src="<?php echo e(URL::asset('js/jquery-1.12.4.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>       
        <script type="text/javascript" src="<?php echo e(URL::asset('js/impl.js?v001')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/typeahead.bundle.js')); ?>"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php echo e(URL::asset('js/html5shiv.js')); ?>"></script>
            <script src="<?php echo e(URL::asset('js/respond.min.js')); ?>"></script>
          <![endif]-->
        <?php echo $__env->yieldContent('js-libs'); ?>

        <script>
var APP_URL = "<?php echo config('app.url'); ?>";
var APP_PUBLIC_URL = "<?php echo config('app.url'); ?>";
        </script>



    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view" style="width: 100%">
                        <div class="navbar nav_title" style="border: 0; height: auto;">
                            <a href="#" class="site_title" style="margin-top: 20px;"><img src = "<?php echo e(URL::asset('img/vpconnect_white.png')); ?>" style="width: 80%; " /></a>

                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_info" style="padding-top: 15px;">
                                <span>Bienvenido,</span>
                                <h2><?php echo e(Auth::user()->NOMBRE); ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar_menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <!--
                                    <?php if( in_array(Auth::user()->ROL, [20,21,22,23,24,25,26,29,30,666])): ?>
                                      <li class="<?php echo e((Route::currentRouteName() == 'mundial.principal')? 'active':''); ?>" style="background-color: #cc3232;">
                                            <a href="<?php echo e(route('mundial.principal')); ?>" target="_blank" style="text-decoration: underline;"><i class="fa fa-futbol-o"></i> ¡La VPConnect vive el Mundial!</a>
                                      </li>
                                    <?php endif; ?>
                      
                                    -->

                                    <?php if(in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getEncuestadores())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'encuesta.interna.principal')? 'active':''); ?>" style="background-color: #cc3232;">
                                        <a href="<?php echo e(route('encuesta.interna.principal')); ?>"><i class="fas fa-user"></i> Encuesta de Satisfacción</a>
                                    </li>
                                    <?php endif; ?>


                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_EJECUTIVO_NEGOCIO): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.ejecutivo.leads.listar')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.leads.listar')); ?>"><i class="glyphicon glyphicon-th-list"></i> Leads</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.ejecutivo.clientes.cartera')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera')); ?>"><i class="glyphicon glyphicon-briefcase"></i> Cartera</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.consulta-nuevos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><i class="glyphicon glyphicon-user"></i> Consulta Lead</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>                


                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_ASISTENTE_COMERCIAL): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.asistente.leads.listar')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.asistente.leads.listar')); ?>"><i class="glyphicon glyphicon-th-list"></i> Leads</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.ejecutivo.clientes.cartera')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.ejecutivo.clientes.cartera')); ?>"><i class="glyphicon glyphicon-briefcase"></i> Cartera</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.consulta-nuevos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><i class="glyphicon glyphicon-user"></i> Consulta Lead</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( in_array(Auth::user()->ROL,App\Entity\Usuario::getGerentes())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.gerente.ejecutivo.resumen')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.gerente.ejecutivo.resumen')); ?>"><i class="glyphicon glyphicon-th-list"></i> Ejecutivos</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.consulta-nuevos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><i class="glyphicon glyphicon-user"></i> Consulta Lead</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.herramientas.resumen-citas')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.herramientas.resumen-citas')); ?>"><i class="glyphicon glyphicon-calendar"></i> Resumen Citas</a>
                                    </li>
                                    <li class="">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_GERENTE_ZONA || Auth::user()->ROL == App\Entity\Usuario::ROL_GERENTE_CENTRO ): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.gerente.reasignacion.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.gerente.reasignacion.index')); ?>"><i class="glyphicon glyphicon-random"></i> Reasignación Leads</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.jefe.citas-reporte')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.jefe.citas-reporte')); ?>"><i class="glyphicon glyphicon-time"></i> Lista de citas</a>
                                    </li>

                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_GERENTE_ZONA || Auth::user()->ROL == App\Entity\Usuario::ROL_GERENTE_CENTRO): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.soporte.asignar.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.soporte.asignar.index')); ?>"><i class="glyphicon glyphicon-send"></i> Asignacion Leads</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_CALL): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.call.cita.nuevo')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.call.cita.nuevo')); ?>"><i class="glyphicon glyphicon-calendar"></i> Agendar Cita</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_SOPORTE): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.consulta-nuevos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><i class="glyphicon glyphicon-user"></i> Consulta Lead</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.soporte.asignar.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.soporte.asignar.index')); ?>"><i class="glyphicon glyphicon-send"></i> Asignacion Leads</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_RIESGO_BPE): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.consulta-nuevos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.consulta-nuevos')); ?>"><i class="glyphicon glyphicon-user"></i> Consulta Lead</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_JEFE_CALL): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.herramientas.resumen-call')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.herramientas.resumen-call')); ?>"><i class="glyphicon glyphicon-headphones"></i> Resumen Call</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.herramientas.resumen-citas')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.herramientas.resumen-citas')); ?>"><i class="glyphicon glyphicon-calendar"></i> Resumen Citas</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.gerente.reasignacion.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.gerente.reasignacion.index')); ?>"><i class="glyphicon glyphicon-random"></i> Reasig. Leads</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_ADMINISTRADOR): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.herramientas.resumen-call')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.herramientas.resumen-call')); ?>"><i class="glyphicon glyphicon-headphones"></i> Resumen Call</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.gerente.reasignacion.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.gerente.reasignacion.index')); ?>"><i class="glyphicon glyphicon-random"></i> Reasig. Leads</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'bpe.campanha.soporte.asignar.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('bpe.campanha.soporte.asignar.index')); ?>"><i class="glyphicon glyphicon-send"></i> Asignacion Leads</a>
                                    </li>
                                    <li class="<?php echo e(1==1? 'active':''); ?>">
                                        <a href="#" class="lnkBotonera"><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</a>
                                    </li>
                                    <?php endif; ?>
                                    <!-- FIES-->
                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_EJECUTIVO_FIES): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'fies.operaciones.ejecutivo.operaciones.listar')? 'active':''); ?>">
                                        <a href="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.listar')); ?>"><i class="glyphicon glyphicon-th-list"></i> Operaciones</a>
                                    </li>

                                    <?php endif; ?>

                                    <?php if( Auth::user()->ROL == App\Entity\Usuario::ROL_JEFE_FIES): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'fies.operaciones.ejecutivo.operaciones.listar')? 'active':''); ?>">
                                        <a href="<?php echo e(route('fies.operaciones.ejecutivo.operaciones.listar')); ?>"><i class="glyphicon glyphicon-th-list"></i> Operaciones</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( in_array(Auth::user()->ROL,App\Entity\Usuario::getEquipoBE()) ): ?>
                                    <?php if(in_array(Auth::user()->ROL,App\Entity\Usuario::getJefesGerentesBE())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.resumen.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.resumen.index')); ?>"><i class="glyphicon glyphicon-stats"></i> Resumen</a>
                                    </li>
                                    <?php endif; ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.miprospecto.lista.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.miprospecto.lista.index')); ?>"><i class="glyphicon glyphicon-user"></i> Prospectos</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.actividades.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.actividades.index')); ?>"><i class="glyphicon glyphicon-list"></i> Actividades</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.micontacto.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.micontacto.index')); ?>"><i class="glyphicon glyphicon-earphone"></i> Contactos</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.creditos.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.creditos.index')); ?>"><i class="glyphicon glyphicon-alert"></i>  Alertas Internas</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.misacciones.lista.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.misacciones.lista.index')); ?>"><i class="glyphicon glyphicon-list"></i>  Acciones Comerciales</a>
                                    </li>


                                    <?php if(in_array(Auth::user()->REGISTRO,App\Entity\Usuario::getUsuariosPruebaInfinity())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'infinity.me.clientes')? 'active':''); ?>">
                                        <a href="<?php echo e(route('infinity.me.clientes')); ?>"><i class="fas fa-infinity"></i>  Líneas Automáticas</a>
                                    </li>
                                    <?php endif; ?>

                                    <!--<li class="<?php echo e((Route::currentRouteName() == 'ecosistema.principal')? 'active':''); ?>">
                                      <a href="<?php echo e(route('ecosistema.principal')); ?>"><img src = "<?php echo e(URL::asset('img/ecosistemaBlanco.png')); ?>" style="width: 25px;height: 25px;"> Ecosistema</a>
                                    </li>-->

                                    <li class="<?php echo e((Route::currentRouteName() == 'ecosistema.principal' or Route::currentRouteName() == 'ecosistema.seguimiento.ingresado')? 'active':''); ?>">
                                        <a><img src = "<?php echo e(URL::asset('img/ecosistemaBlanco.png')); ?>" style="width: 25px;height: 25px;"> Ecosistema <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu desplegable" 
                                            style="<?php echo e((Route::currentRouteName() == 'ecosistema.principal' or Route::currentRouteName() == 'ecosistema.seguimiento.ingresado')? 'display: block;':'display: none;'); ?>">
                                            <li><a href="<?php echo e(route('ecosistema.principal')); ?>"><i class="glyphicon glyphicon-search"></i> Buscar</a></li>
                                            <li><a href="<?php echo e(route('ecosistema.seguimiento.ingresado')); ?>"><i class="glyphicon glyphicon-stats"></i> Reporte</a></li>
                                        </ul>
                                    </li>

                                    <?php endif; ?>

                                    <?php if( in_array(Auth::user()->ROL,App\Entity\Usuario::getEjecutivosProductoBE()) ): ?>              
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.misacciones.lista.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.misacciones.lista.index')); ?>"><i class="glyphicon glyphicon-user"></i>  Acciones Comerciales</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.actividades.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.actividades.index')); ?>"><i class="glyphicon glyphicon-list"></i> Actividades</a>
                                    </li>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.micontacto.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.micontacto.index')); ?>"><i class="glyphicon glyphicon-earphone"></i> Contactos</a>
                                    </li>           
                                    <!--<li class="<?php echo e((Route::currentRouteName() == 'ecosistema.principal')? 'active':''); ?>">
                                      <a href="<?php echo e(route('ecosistema.principal')); ?>"><img src = "<?php echo e(URL::asset('img/ecosistemaBlanco.png')); ?>" style="width: 25px;height: 25px;"> Ecosistema</a>
                                    </li>-->

                                    <li class="<?php echo e((Route::currentRouteName() == 'ecosistema.principal' or Route::currentRouteName() == 'ecosistema.seguimiento.ingresado' or Route::currentRouteName() == 'ecosistema.seguimiento.recibido')? 'active':''); ?>">
                                        <a><img src = "<?php echo e(URL::asset('img/ecosistemaBlanco.png')); ?>" style="width: 25px;height: 25px;"> Ecosistema <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu desplegable" 
                                            style="<?php echo e((Route::currentRouteName() == 'ecosistema.principal' or Route::currentRouteName() == 'ecosistema.seguimiento.ingresado')? 'display: block;':'display: none;'); ?>">
                                            <li><a href="<?php echo e(route('ecosistema.principal')); ?>"><i class="glyphicon glyphicon-search"></i> Buscar</a></li>
                                            <li><a href="<?php echo e(route('ecosistema.seguimiento.ingresado')); ?>"><i class="glyphicon glyphicon-stats"></i> Reporte</a></li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(in_array(Auth::user()->ROL,App\Entity\Usuario::getEquipoRiesgosME())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.creditos.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.creditos.index')); ?>"><i class="glyphicon glyphicon-alert"></i>  Alertas Internas</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if( in_array(Auth::user()->ROL, [App\Entity\Usuario::ROL_ROBOT_TD])): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'be.micontacto.index')? 'active':''); ?>">
                                        <a href="<?php echo e(route('be.micontacto.index')); ?>"><i class="glyphicon glyphicon-earphone"></i> Contactos</a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(in_array(Auth::user()->ROL, App\Entity\Usuario::getAccesoSSRS())): ?>
                                    <li class="<?php echo e((Route::currentRouteName() == 'saldos' or Route::currentRouteName() == 'variaciones')? 'active':''); ?>">
                                        <a href="#"><i class="glyphicon glyphicon-stats"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu desplegable" 
                                            style="<?php echo e((Route::currentRouteName() == 'saldos' or Route::currentRouteName() == 'variaciones')? 'display: block;':'display: none;'); ?>">
                                            <li class="<?php echo e((Route::currentRouteName() == 'saldos')? 'active':''); ?>">
                                                <a href="<?php echo e(route('saldos')); ?>"><i class="glyphicon glyphicon-list-alt"></i> Saldos Diarios</a>
                                            </li>
                                            <li class="<?php echo e((Route::currentRouteName() == 'variaciones')? 'active':''); ?>">
                                                <a href="<?php echo e(route('variaciones')); ?>"><i class="glyphicon glyphicon-list-alt"></i> Principales Var.</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>

                                    <li class="<?php echo e((Route::currentRouteName() == 'pass.change')? 'active':''); ?>">
                                        <a href="<?php echo e(route('pass.change')); ?>"><i class="fa fa-key"></i> Password</a>
                                    </li> 

                                </ul>
                            </div>

                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="glyphicon glyphicon-align-justify"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right" style="width: auto;">
                                <li class="">
                                    <a href="<?php echo e(route('logout')); ?>">

                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                            <div style="float: left; width: 80%; text-align: center;">
                                <!--
                                <h4 style="font-size: 25px; margin-top: 15px">TRABAJO PARA ESTUDIAR MI MAESTRIA</h4>
                                -->
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div id="content" class="right_col" role="main" style="min-height: 1550px;">
                    <div style="margin-top: 4%;">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h3><?php echo $__env->yieldContent('pageTitle'); ?></h3>
                                </div>
                                <div class="text-right">
                                    <?php echo $__env->yieldContent('tituloDerecha'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="modalBotonera">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <font size=6><i class="glyphicon glyphicon-info-sign"></i> Repositorio de guías</font>
                        <div class="modal-body" >                  
                            <font size=4><p style="text-align: center;">
                                Para acceder al repositorio de guías de Banca Pequeña Empresa, copia el siguiente enlace 
                                en tu Explorador de Windows: 
                            </p></font>
                            <font size=4><p style="text-decoration: underline;text-align: center;">
                                \\grupoib.local\dfs3\BPE\Mundial_BPE\Control_de_Gestión
                                \Ejecutivos\EjecutivosG\Protocolo_Comercial\Guías
                            </p></font>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </body>
    <?php echo $__env->yieldContent('js-scripts'); ?>
</html>

<script type="text/javascript">

    $('.lnkBotonera').click(function () {
        $('#modalBotonera').modal();
    })

</script>
