<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SC REAL-ESTATE</title>
        <meta name="description" content="GARO is a real-estate template">
        <meta name="author" content="Kimarotec">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

        <!-- Place favicon.ico  the root directory -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="{{ asset('seekers_assets/assets/img/slide1/icon.png'); }}" type="image/x-icon">

        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/normalize.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/font-awesome.min.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/fontello.css'); }}">
        <link href="{{ asset('seekers_assets/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css'); }}" rel="stylesheet">
        <link href="{{ asset('seekers_assets/assets/fonts/icon-7-stroke/css/helper.css'); }}" rel="stylesheet">
        <link href="{{ asset('seekers_assets/assets/css/animate.css'); }}" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/bootstrap-select.min.css'); }}"> 
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/select2.min.css'); }}"> 
        <link rel="stylesheet" href="{{ asset('seekers_assets/bootstrap/css/bootstrap.min.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/icheck.min_all.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/price-range.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/owl.carousel.css'); }}">  
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/owl.theme.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/owl.transitions.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/lightslider.min.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/style.css'); }}">
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/responsive.css'); }}">
         
        <link rel="stylesheet" href="{{ asset('seekers_assets/assets/css/dataTables.bootstrap.min.css'); }}">

        <?php 
                if(request()->is('seeker/map*','seeker/properties*')){
                    echo '<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.js"></script>
                            <link
                            href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.5.0/mapbox-gl.css"
                            rel="stylesheet"
                            />
                            <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
                            <link
                            rel="stylesheet"
                            href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
                            type="text/css"
                            />';
                }
        ?>
    </head>
    <body style="background-color: #111111">

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->


        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8  col-xs-12">
                        <div class="header-half header-call">
                            <p>
                                <span><i class="pe-7s-call"></i> +639 102 727 943</span>
                                <span><i class="pe-7s-mail"></i> screalestate21@gmail.com</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
                        <div class="header-half header-social">
                            <ul class="list-inline">
                                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-vine"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>         
        <!--End top header -->

        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a  href="{{ route('home');}}"><img src="{{ asset('seekers_assets/assets/img/slide1/logosc.png');}}" alt="" style="width: 210px;margin-top:30px;" ></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation"> 
                    <div class="button navbar-right">

                    <?php if(empty(auth()->user()->users_id) ){ ?>
                        <a href="{{ route('seeker.login');}}"><button class="navbar-btn nav-button wow bounceInRight login" >Login</button></a>
                    <?php }else{ ?>
                        <a href="{{ route('seeker.profile'); }}" ><button class="navbar-btn nav-button wow bounceInRight" ><i class="fa fa-user"></i> My Account</button></a>
                    <?php } ?> 
                    <?php if(empty(auth()->user()->users_id)){ ?>
                        <a href="{{ route('seeker.create');}}"><button class="navbar-btn nav-button wow fadeInRight" >Sign Up</button></a>
                    <?php }else{ ?> 
                        <a href="{{ route('seeker.logout');}}"><button class="navbar-btn nav-button wow fadeInRight" >Logout</button></a>
                    <?php } ?> 
                    </div> 
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                            <a href="{{ route('home');}}" class="dropdown-toggle {{ (request()->is('/')) ? 'active' : '' }}">Home</a>
    
                        </li>

                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="{{ (request()->is('seeker/properties*')) ? 'active' : '' }}" href="{{ route('seeker.properties'); }}">Properties</a></li> 
                      
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="{{ (request()->is('seeker/search-agent*')) ? 'active' : '' }}" href="{{ route('seeker.search_agent'); }}">Search Agents</a></li>
                        
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="{{ (request()->is('seeker/map*')) ? 'active' : '' }}" href="{{ route('seeker.map'); }}">Map</a></li> 
                        <?php if(!empty(auth()->user()->users_id)){ ?>
                        <li class="wow fadeInDown" data-wow-delay="0.1s"><a class="{{ (request()->is('seeker/favorite*')) ? 'active' : '' }}" href="{{ route('seeker.show_favorite_property'); }}">Favorites</a></li>  
                       
                        <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="{{ route('seeker.submit_report'); }}" class="{{ (request()->is('seeker/submit_report*')) ? 'active' : '' }}">Report</a></li> 
                        <?php } ?> 
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->