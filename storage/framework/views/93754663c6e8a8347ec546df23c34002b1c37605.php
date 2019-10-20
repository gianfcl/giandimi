<!doctype html>
<html class="no-js" lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo e(URL::asset('img/paddy/paddy.png')); ?>">

        <title><?php echo $__env->yieldContent('pageTitle'); ?> - Paddy</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        -->
        <!-- <link rel="shortcut icon" href="<?php echo e(URL::asset('genious/images/favicon.ico')); ?>" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?php echo e(URL::asset('genious/images/apple-touch-icon.png')); ?>"> -->

        <!-- CSS-->
        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/css/fonts-googleapis.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/css/fonts-googleapis-2.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/css/carousel.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('genious/style.css')); ?>">

        <!-- VIDEO BG PLUGINS -->
        <script src="videos/libs/swfobject.js"></script> 
        <script src="videos/libs/modernizr.video.js"></script> 
        <script src="videos/libs/video_background.js"></script>

        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/jquery.min.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/bootstrap.min.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/carousel.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/parallax.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/rotate.js')); ?>"></script> 
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/custom.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/masonry.js')); ?>"></script>
        <script type="text/javascript"  src="<?php echo e(URL::asset('genious/js/masonry-4-col.js')); ?>"></script>

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
    <body class="left-menu">
        
        <div class="menu-wrapper">
            <header class="vertical-header">
                <div class="vertical-header-wrapper">
                    <nav class="nav-menu">
                        <div class="logo">
                            <a href="#"><img src="<?php echo e(URL::asset('img/paddy/paddy_logo_2.png')); ?>" alt=""></a>
                        </div><!-- end logo -->
                        <div class="profile clearfix">
                            <div class="profile_info" style="padding-top: 15px;">
                                <span>Bienvenido,</span>
                                <h5 style="color: white"><?php echo e(Auth::user()->NOMBRE); ?></h5>
                            </div>
                        </div>

                        <div class="margin-block"></div>
                        <div id="sidebar_menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li class="<?php echo e((Route::currentRouteName() == 'productos')? 'active':''); ?>">
                                        <a href="<?php echo e(route('productos')); ?>"><i class="fa fa-key"></i> Productos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
        </div>

        <div id="wrapper">
            <div id="home">
                <div class="row" style="width: 10%;margin-left: 1320px">
                    <ul class="nav navbar-nav navbar-right" style="width: auto;">
                        <li class="">
                            <a href="<?php echo e(route('logout')); ?>">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="content" class="right_col" role="main" style="min-height: 900px;">
                <div style="margin-top: 4%;">
                    <div class="page-title" style="width: 90%;">
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
            <footer class="section footer">
            </footer>
        </div>
        <script>
            jQuery(document).ready(function($) {
                var Video_back = new video_background($("#home"), { 
                    "position": "absolute", //Follow page scroll
                    "z-index": "-1",        //Behind everything
                    "loop": true,           //Loop when it reaches the end
                    "autoplay": true,       //Autoplay at start
                    "muted": true,          //Muted at start
                    "mp4":"<?php echo e(URL::asset('img/paddy/videos/video.mp4')); ?>" ,     //Path to video mp4 format
                    "video_ratio": 1.7778,              // width/height -> If none provided sizing of the video is set to adjust
                    "fallback_image": "<?php echo e(URL::asset('img/paddy/images/dummy.png')); ?>",   //Fallback image path
                    "priority": "html5"             //Priority for html5 (if set to flash and tested locally will give a flash security error)
                });
            });
        </script>

    </body>
<?php echo $__env->yieldContent('js-scripts'); ?>
</html>