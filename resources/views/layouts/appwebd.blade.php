<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>THE Mart - HTML5 BOOTSTRAP TEMPLATE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="{{ asset('css/meanmenu.min.css') }}">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- font-awesome css -->
   {{--  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> --}}
    <!-- fancybox css -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <!-- flaticon css -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <!-- slick css -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @livewireStyles
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!--Preloader area -->
    <div id="preloader">
        <div id="status" class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!--Popup overlay-->
    {{--       <div id="mailchimp-popup">
            <div class="mailchimp-popup-content">
                <h4 class="title">Let Shop With Us</h4>
                <div class="mailchimp-caption-1">
                    <span>Get Touch With us Email here</span>
                </div>
                <form id="mc-form">
                    <input id="mc-email" class="input-block-level" type="email" placeholder="Subscrible Your Email" required />
                    <button class="btn1" type="submit">Submit</button>
                </form>
            </div>
            <div class="mailchimp-popup-img">
                <img alt="" src="images/banner/popup.jpg" />
            </div>
        </div> --}}

    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                        <div class="top-l-social">
                            <ul class="list-inline">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="text-right top-linked">
                            <ul class="list-inline">
                                <li><a href="login.html"><i class="fa fa-unlock-alt"></i><span>Login</span></a></li>
                                <li><a href="login.html"><i class="fa fa-pencil"></i><span>Register</span></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i><span>Wishlist</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{ $menud }}


        <!--Offset wrapper end here-->
    </header>

    {{ $slot }}

    <!--Daily deal area end here-->
    <!--Footer area start here-->
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="subs-form wow animated fadeInDown" data-wow-duration="1.5s">
                            <form>
                                <input type="email" placeholder="Enter Your Email">
                                <button type="submit">Subscribe <i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-content">
                            <div class="logo-foo">
                                <a href="index.html"><img src="images/logo/logo2.png" alt="" /></a>
                            </div>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                                Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis
                                sem nibh id elit.</p>
                            <ul class="list-inline foo-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <ul class="list-inline foo-con-info">
                                <li><i class="fa fa-home"></i><span>Uk Street, Green Home City, London.</span></li>
                                <li><i class="fa fa-envelope"></i><span>info@yourtheme.com</span></li>
                                <li><i class="fa fa-phone"></i><span>+910-73602 : +924-15588</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="copyright">
                            <p>Webstrot © 2022 Powered by The Mart. All Rights Reserved Mike</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer area end here-->

    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- tether js -->
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- owl.carousel js -->

    <!-- magnific popup js -->

    <!-- meanmenu js -->
    <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
    <!-- jarallax js -->
    <script src="{{ asset('js/jarallax.min.js') }}"></script>
    <!-- jquery-ui js -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- downCount JS -->
    <script src="{{ asset('js/jquery.downCount.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- touchspin js -->
    <script src="{{ asset('js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- fancybox js -->
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- plugins js -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://kit.fontawesome.com/ae5eaac834.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    @livewireScripts

</body>

</html>
