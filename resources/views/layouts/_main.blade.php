<?php
/**
 * @author Fudio101
 * Date: 04/05/2022
 * Time: 13:47
 */
?>


    <!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    @yield('head')
    <title>{{$title}}</title>
</head>

<body>
<div class="apps">
    {{--    Header  --}}
    @include('layouts.header')

    {{--    Navbar  --}}
    @include('layouts.navbar')

    {{--    Content     --}}
    @yield('content')

    {{--    Footer  --}}
    @include('layouts.footer')

    {{--    Scroll to top   --}}
    @include('layouts.scroll-top')
</div>
</body>
@yield('js')
</html>
