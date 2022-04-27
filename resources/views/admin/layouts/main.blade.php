<?php
/**
 * @author Fudio101
 * Date: 23/04/2022
 * Time: 12:57
 */
?>

    <!DOCTYPE html>
<html style="height: 100%;" lang="vi">

@include('admin.layouts.head',['title'=>$title])

<body style="height: 100%;">
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow navbar-custom">

    <a class="navbar-brand col-sm-3 col-md-2 mr-0 ms-4 fs-6" href="#">BaloStore</a>

    <ul class="navbar-nav px-3">
        <a class="nav-link" onclick="logout()" href="#">Logout</a>
        <li class="nav-item text-nowrap">
        </li>

    </ul>

</nav>

<div class="container-fluid" style="height: 100%;">
    <div class="row" style="height: 100%;">
        {{--    Navbar    --}}
        @include('admin.layouts.navbar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <!-- hien thi tung chuc nang cua trang quan tri START-->
        @yield('content')
        <!-- END -->
        </main>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        path =
        var active = $(`.nav-link.${path}`);
        active.addClass("active");

    });

    function logout() {
        $.ajax({
            type: 'POST',
            url: '{{route('logout')}}',
            success: function (data) {
                window.location.replace('{{route('login')}}');
            }
        });
    }
</script>

@yield('js')

</body>

</html>
