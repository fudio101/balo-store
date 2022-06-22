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
    <title>{{$title}}</title>

    <!-- favicon -->
    {{--    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">--}}
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/img/logo.svg')}}">
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
                        <form method="get" action="{{route('search')}}">
                            <label for="keywords">Search For:</label>
                            <input type="text" id="keywords" name="keywords" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->
<!-- errors show -->
@if($errors->any())
    {!! implode('', $errors->all('
    <script>
        toastr.info(":message")
    </script>
    ')) !!}
@endif
@foreach (['error', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        {{--        {!! implode('', $errors->all('--}}
        {{--        <script>--}}
        {{--            toastr.info(":message")--}}
        {{--        </script>--}}
        {{--        ')) !!}--}}
        <script>
            toastr["{{$msg}}"]("{{Session::get('alert-' . $msg) }}")
        </script>
    @endif
@endforeach

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
@yield('js')
<script src="{{asset('assets/js/main.js')}}"></script>

</body>
</html>
