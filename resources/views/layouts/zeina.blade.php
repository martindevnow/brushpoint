<!DOCTYPE html>
    <!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <title>BrushPoint Innovations</title>

        <!--[if lt IE 9]>
        <script type="text/javascript" src="/js/ie-fixes.js"></script>
        <script type="text/javascript" src="/js/_excanvas.compiled.js"></script>
        <link rel="stylesheet" href="/css/ie-fixes.css">
        <![endif]-->

        <meta name="description" content="Brushpoint Innovations">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--- This should placed first off all other scripts -->

             <link rel="stylesheet" href="/css/font-awesome-ie7.css">
             <link rel="stylesheet" href="/css/font-awesome-ie7.min.css">
             <link rel="stylesheet" href="/css/font-awesome.css">
             <link rel="stylesheet" href="/css/font-awesome.min.css">
             <link rel="stylesheet" href="/css/revolution_settings.css">
             <link rel="stylesheet" href="/css/bootstrap.min.css">
             <!-- <link rel="stylesheet" href="/css/eislider.css">
             <link rel="stylesheet" href="/css/tipsy.css">
             <link rel="stylesheet" href="/css/prettyPhoto.css">
             <link rel="stylesheet" href="/css/isotop_animation.css">
             <link rel="stylesheet" href="/css/animate.css"> -->
             <link rel="stylesheet" href="/css/flexslider.css">
             <link rel="stylesheet" href="/css/brushpoint.css">






            <link href='/css/style.css' rel='stylesheet' type='text/css'>
            <link href='/css/responsive.css' rel='stylesheet' type='text/css'>
            <link href="/css/skins/flat-blue.css" rel='stylesheet' type='text/css' id="skin-file">


        <!--
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        -->
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
        <script type="text/javascript" src="/js/respond.js"></script>
<![endif]-->
        <link rel="stylesheet" href="/css/color-chooser.css">



@include('layouts.partials._analytics')



        <style>
        .bp-breadcrumb {
            color: #ffffff;
            margin-top: -5px;
            background-color: #0032a1;
            border-radius: 0px;
            border: none;
            margin-top: -14px;
            min-height: 42px;
            padding-top: 10px;
        }
        .bp-cart {
            color: #ffffff;
            margin-top: -5px;
            background-color: #0032a1;
            border-radius: 0px;
            border: none;
            margin-top: -14px;
            min-height: 42px;
            padding-top: 10px;
        }
        .bp-header {
            background-image: url("/images/background/top-dark-12.5p.jpg");
            background-repeat: repeat-x;
            min-height: 72px;;

        }
        h1.h1-page-title {
            color: #0031a0;
            font-size: 2.5em;
            font-style: bold;
            margin-top: 7px;
        }
        h2.h2-page-desc {
            color: #0031a0;
            font-size: 2em;
            margin-top: 7px;
        }

        .bp-footer {
            background-image: url("/images/background/bottom-dark-12.5p.jpg");
            background-repeat: repeat-x;
            /*border-bottom: 1px solid #000000;*/
        }

        .contact-title {
            color: white;
            text-transform: uppercase;

        }
        .contact-details {
            color: white;
        }
        .bp-footer-content {
            margin: 1%;
            padding-bottom: 0px;
            background-color: #0032a1;
            width: 100%;
            padding: 2px 15px 0px 13px;
            // padding-left: 10px;;
            // border: 3px solid black;
            background-color: #0032a1;
            min-height: 65px;
        }

        .footer-col-md-3 {
            padding-bottom: 0px;
            // width: 25%;
            // margin: 1%;
            padding-left: 13px;
            padding-top: 2px;
            min-height: 65px;
            // border: 2px solid red;
            padding-left: 2px;
            padding-right: 2px;
        }
        .footer-link a {
            color: #FFFFFF;
            text-decoration: none;
        }

        .thumbnail {
            color:#2A2A2A;
            margin-right:5px;
            border-radius:0.2em;
            margin-bottom:5px;
            /*background-color:#E9F7FE;*/
            padding:5px;
            border-color:#DADADA;
            border-style:solid;
            border-width:thin;
            font-size:15px
            text-align: center;
            min-height: 250px;
        }

        .product-thumbnail {
            /*width:420px;*/
            /*height:108px;*/
            overflow:hidden;
            /*border-color:#DADADA;
            border-style:solid;
            border-width:thin;*/
            /*background-color:pink;*/
            min-width: 100px;
            width: 100%;;

            min-height: 150px;
        }


        .product-thumbnail a img {
            display : block;
            margin : auto;
        }

        .product-caption
        {
            margin-bottom: 0px;
            padding: 5px 5px 0 5px;
        }
        .product-caption h3 {
            margin-bottom: 0px;
            padding-bottom: 0px;
            font-size: 16px;
        }

        .product-detail-btn {
            font-size: 10px;
            padding: 2px 5px 2px 5px;
            margin: -10px 0 2px 0;

        }
        .h1-page-title a:hover {
            text-decoration: none;
            color: #337AB7;
        }
        .h1-page-title a {
            color: #0031A0;

        }


        .purchase-name {
            margin-bottom: 2px;
        }
        .purchase-price {
            margin-bottom: 2px;
            color: #C24F00;
        }


        .addToCart-form {
            height: 34px;
            font-size: 16px;
        }
        .cart-item-quantity {
            width: 45px;
            height: 40px;
            padding: 2px 2px 2px 8px;
            margin-top: -10px;
            font-size: 18px;
            margin-bottom: 0px;
        }
        .cart-contents th {
            font-size: 18px;
            /*padding-top: 8px;;*/
        }
        .cart-contents > tbody > tr > td {
            font-size: 16px;
            padding-top: 16px;
        }
        .btn-float-right {
            float: right;
        }






        @media (max-width: 767px){
            .breadcrumb-container {
              float: right;

            }


        }

        @media (max-width: 991px) and (min-width: 767px)
        {
            .logo{
                padding: 0px;
            }
            .img-logo {
                content: url('/images/logo/brushpoint.jpg');
                width: 200px;
                height: auto;
            }
            .bp-nav-header {
                padding 0px;
            }
        }

        </style>

        @yield('header_inside')

    </head>
<body>



<div id="wrapper"  >

<div class="top_wrapper">

    <!-- Header -->
    <header id="header">
        <div class="container">

            <div class="row header">

                <!-- Logo -->
                <div class="col-md-5 col-sm-3 col-xs-10 logo">
                    <a href="/">
                        <img src="/images/logo/bpi_longlogo.jpg" alt="Brushpoint Innovations" class="img-responsive img-logo"/>
                    </a>
                </div>
                <!-- //Logo// -->


                <!-- Navigation File -->
                <div class="col-md-7 col-sm-9 bp-nav-header">

                    <!-- Mobile Button Menu -->
                    <div class="mobile-menu-button">
                        <i class="icon-reorder"></i>
                    </div>
                    <!-- //Mobile Button Menu// -->


                    @include('zeina.nav')


                    <!-- Mobile Nav. Container -->
                    <ul class="mobile-nav">
                        <li class="responsive-searchbox">
                            <!-- Responsive Nave -->
                            <form action="#" method="get">
                                <input type="text" class="searchbox-inputtext" id="searchbox-inputtext-mobile" name="s" />
                                <button class="icon-search"></button>
                            </form>
                            <!-- //Responsive Nave// -->
                        </li>
                    </ul>
                    <!-- //Mobile Nav. Container// -->
                </div>
                <!-- Nav -->
            </div>
        </div>
    </header>
    <!-- //Header// -->
</div><!--.top wrapper end -->

<!--
<div class="loading-container">
    <div class="loading">
        <i></i><i></i>
    </div>
    <div class="loading-fallback">
         <img src="/images/loading.gif" alt="Loading"/>
    </div>
    <div class="loading-text">
        loading..
    </div>
</div>
-->

<!-- <div class="content-wrapper hide-until-loading"> -->
<div class="content-wrapper">
    @yield('header_bottom')
    <div class="body-wrapper" style="padding-top: 30px; padding-bottom: 30px; ">
        <div class="container">
            <div class="row">
                @include('layouts.partials._flash')
            </div>
        </div>
        @yield('content')
    </div>  <!-- END div  body-wrapper -->
</div><!--.content-wrapper end -->



<footer>
    <div class="footer bp-footer">
        @yield('footer')

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="copyright-text">&copy; 2015 BrushPoint Innovations</div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div><!-- wrapper end -->



<script type="text/javascript" src="/js/_jq.js"></script>

<script type="text/javascript" src="/js/_jquery.placeholder.js"></script>





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="/js/activeaxon_menu.js" type="text/javascript"></script>
<script src="/js/animationEnigne.js" type="text/javascript"></script>
<script src="/js/bootstrap.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/easypiecharts.js" type="text/javascript"></script>
<script src="/js/ie-fixes.js" type="text/javascript"></script>
<script src="/js/jquery.base64.js" type="text/javascript"></script>
<script src="/js/jquery.carouFredSel-6.2.1-packed.js" type="text/javascript"></script>
<script src="/js/jquery.cycle.js" type="text/javascript"></script>
<script src="/js/jquery.cycle2.carousel.js" type="text/javascript"></script>
<script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="/js/jquery.easytabs.js" type="text/javascript"></script>
<script src="/js/jquery.eislideshow.js" type="text/javascript"></script>
<script src="/js/jquery.flexslider.js" type="text/javascript"></script>
<script src="/js/jquery.infinitescroll.js" type="text/javascript"></script>
<script src="/js/jquery.isotope.js" type="text/javascript"></script>
<script src="/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
<script src="/js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="/js/jQuery.scrollPoint.js" type="text/javascript"></script>
<script src="/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
<script src="/js/jquery.themepunch.revolution.js" type="text/javascript"></script>
<script src="/js/jquery.tipsy.js" type="text/javascript"></script>
<script src="/js/jquery.validate.js" type="text/javascript"></script>
<script src="/js/jQuery.XDomainRequest.js" type="text/javascript"></script>
<script src="/js/retina.js" type="text/javascript"></script>
<script src="/js/timeago.js" type="text/javascript"></script>
<script src="/js/tweetable.jquery.js" type="text/javascript"></script>
<script src="/js/zeina.js" type="text/javascript"></script>


<script>
$(".purchase-thumbnail").mouseover(function() {
    var thumbnailImage = $(this).attr("src");
    var lengthOfExtension = "115.png".length * -1;
    var fullImage = thumbnailImage.slice(0,lengthOfExtension);
    $("#product-show-image").attr("src", fullImage+"555.png");
});
</script>


</body>
</html>
