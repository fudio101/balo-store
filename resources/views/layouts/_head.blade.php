<?php
/**
 * @author Fudio101
 * Date: 20/06/2022
 * Time: 22:39
 */
?>

@if(env('APP_URL')!=='http://localhost')
    <!-- fontawesome -->
{{--    <link rel="stylesheet" href="{{secure_asset('assets/css/all.min.css')}}">--}}
    <script src="https://kit.fontawesome.com/4f6aca3e42.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{secure_asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/owl.carousel.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/magnific-popup.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/animate.css')}}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/meanmenu.min.css')}}">
    <!-- main style -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/main.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{secure_asset('assets/css/responsive.css')}}">
    <!-- jquery -->
    <script src="{{secure_asset('assets/js/jquery-1.11.3.min.js')}}"></script>
    <!-- toastr notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@else
    <!-- fontawesome -->
{{--    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">--}}
        <script src="https://kit.fontawesome.com/4f6aca3e42.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css')}}">
    <!-- main style -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <!-- jquery -->
    <script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
    <!-- toastr notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endif
<!-- csrf -->
<meta name="csrf-token" content="{{ csrf_token() }}">
