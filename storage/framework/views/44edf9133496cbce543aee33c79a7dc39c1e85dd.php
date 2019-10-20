<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <link rel="shortcut icon" href="<?php echo e(URL::asset('img/ibk.png')); ?>">

        <title><?php echo $__env->yieldContent('pageTitle'); ?> - Paddy</title>

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
    </body>
    <?php echo $__env->yieldContent('js-scripts'); ?>
</html>

<script type="text/javascript">

</script>