<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <link rel="shortcut icon" href="<?php echo e(URL::asset('img/paddy/paddy.png')); ?>">

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
    <body class="left-menu">  
        
        <div class="menu-wrapper">
            <div class="mobile-menu">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.html"><img src="images/logo-normal.png" alt=""></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </nav>
            </div><!-- end mobile-menu -->

            <header class="vertical-header">
                <div class="vertical-header-wrapper">
                    <nav class="nav-menu">
                        <div class="logo">
                            <a href="index.html"><img src="images/logo.png" alt=""></a>
                        </div><!-- end logo -->

                        <div class="margin-block"></div>
                </div><!-- end vertical-header-wrapper -->
            </header><!-- end header -->
        </div><!-- end menu-wrapper -->

        <div id="wrapper">

            <div id="home" class="video-section js-height-full">
                
            </div>

            <footer class="section footer">
            </footer><!-- end footer -->

            <div class="section copyrights">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="cop-logo">
                                <img src="images/logo-normal.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 text-right">
                            <div class="cop-links">
                                <ul class="list-inline">
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end wrapper -->

        <!-- jQuery Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/carousel.js"></script>
        <script src="js/parallax.js"></script>
        <script src="js/rotate.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/masonry.js"></script>
        <script src="js/masonry-4-col.js"></script>
        <!-- VIDEO BG PLUGINS -->
        <script src="videos/libs/swfobject.js"></script> 
        <script src="videos/libs/modernizr.video.js"></script> 
        <script src="videos/libs/video_background.js"></script> 
        <script>
            jQuery(document).ready(function($) {
                var Video_back = new video_background($("#home"), { 
                    "position": "absolute", //Follow page scroll
                    "z-index": "-1",        //Behind everything
                    "loop": true,           //Loop when it reaches the end
                    "autoplay": true,       //Autoplay at start
                    "muted": true,          //Muted at start
                    "mp4":"videos/video.mp4" ,     //Path to video mp4 format
                    "video_ratio": 1.7778,              // width/height -> If none provided sizing of the video is set to adjust
                    "fallback_image": "images/dummy.png",   //Fallback image path
                    "priority": "html5"             //Priority for html5 (if set to flash and tested locally will give a flash security error)
                });
            });
        </script>

    </body>
<?php echo $__env->yieldContent('js-scripts'); ?>
</html>