<?php
/**
 * @author Fudio101
 * Date: 20/06/2022
 * Time: 22:37
 */
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Balo store</title>

    <!-- favicon -->
    {{--    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">--}}
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    @include('layouts._head')
    @yield('head')
</head>
<body>

<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<!--PreLoader Ends-->

<!-- header -->
@include('layouts._header')
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <input type="text" placeholder="Keywords">
                        <button type="submit">Search <i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->

@yield('top-custom')

<!-- content -->
@yield('content')
<!-- end content -->

<!-- logo carousel -->
@include('layouts._logo-carousel')
<!-- end logo carousel -->

<!-- footer -->
@include('layouts._footer')
<!-- end footer -->

<!-- copyright -->
@include('layouts._copyright')
<!-- end copyright -->

<!-- jquery -->
<script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- count down -->
<script src="{{asset('assets/js/jquery.countdown.js')}}"></script>
<!-- isotope -->
<script src="{{asset('assets/js/jquery.isotope-3.0.6.min.js')}}"></script>
<!-- waypoints -->
<script src="{{asset('assets/js/waypoints.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<!-- mean menu -->
<script src="{{asset('assets/js/jquery.meanmenu.min.js')}}"></script>
<!-- sticker js -->
<script src="{{asset('assets/js/sticker.js')}}"></script>
<!-- main js -->
<script src="{{asset('assets/js/main.js')}}"></script>

</body>
</html>
