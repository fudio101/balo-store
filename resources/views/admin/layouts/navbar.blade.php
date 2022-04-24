<?php
/**
 * @author Fudio101
 * Date: 23/04/2022
 * Time: 13:03
 */
?>

<nav class="col-md-2 d-none d-md-block bg-secondary bg-opacity-10 sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column mt-5">

            <li class="nav-item">
                <a class="nav-link admin" href="{{route('admin')}}">
                    <i class="bi bi-house-fill"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link category" href="{{route('categoryIndex')}}">
                    <i class="bi bi-folder"></i>
                    Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link product" href="{{route('admin')}}">
                    <i class="bi bi-file-earmark-text"></i>
                    Products
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link order" href="{{route('admin')}}">
                    <i class="bi bi-minecart"></i>
                    Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link discount" href="{{route('admin')}}">
                    <i class="bi bi-minecart"></i>
                    Discount
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->role =="1")
                <li class='nav-item'>
                    <a class='nav-link user' href='{{route('admin')}}'>
                        <i class='bi bi-people-fill'></i>
                        Users
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
