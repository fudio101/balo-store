<!DOCTYPE html>
<html style="height: 100%;" lang="vi">

<head>
    <title>Dashboard Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset('assets/images/store-solid.svg')}}"/>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dashboard.css1')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <!-- SummerNote -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body style="height: 100%;">
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow navbar-custom">

    <a class="navbar-brand col-sm-3 col-md-2 mr-0 ms-4 fs-6" href="#">BaloStore</a>

    <ul class="navbar-nav px-3">

        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{asset('authen/logout.php')}}">Logout</a>
        </li>

    </ul>

</nav>

<div class="container-fluid" style="height: 100%;">
    <div class="row" style="height: 100%;">
        <nav class="col-md-2 d-none d-md-block bg-secondary bg-opacity-10 sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column mt-5">

                    <li class="nav-item">
                        <a class="nav-link admin" href="{{asset('')}}">
                            <i class="bi bi-house-fill"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link category" href="{{asset('category')}}">
                            <i class="bi bi-folder"></i>
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link product" href="{{asset('product')}}">
                            <i class="bi bi-file-earmark-text"></i>
                            Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link order" href="{{asset('order')}}">
                            <i class="bi bi-minecart"></i>
                            Orders
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link discount" href="{{asset('discount')}}">
                            <i class="bi bi-minecart"></i>
                            Discount
                        </a>
                    </li>

                    @if(\Illuminate\Support\Facades\Auth::user()->role =="1")
                        <li class='nav-item'>
                            <a class='nav-link user' href='{{asset('')}}user'>
                                <i class='bi bi-people-fill'></i>
                                Users
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            <!-- hien thi tung chuc nang cua trang quan tri START-->
