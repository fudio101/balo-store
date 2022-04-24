@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-top:24px">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 m-5" id="card">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-cart-plus-fill" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 4rem">{{number_format($total, 0, ',', '.')}}</div>
                <div>Products</div>
            </div>
        </div>

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 my-5 mx-auto">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-shop" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 4rem">{{number_format($total_, 0, ',', '.')}}</div>
                <div>Total products</div>
            </div>
        </div>

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 m-5">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-bell-fill" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 4rem">{{ number_format($orders, 0, ',', '.') }}</div>
                <div>Orders to be processed</div>
            </div>
        </div>

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 m-5">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-truck" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 4rem">{{ number_format($deliveringOders, 0, ',', '.') }}</div>
                <div>Orders are being delivered</div>
            </div>
        </div>

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 my-5 mx-auto">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-truck-flatbed" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 4rem">{{ number_format($deliveredOders, 0, ',', '.') }}</div>
                <div>Orders delivered</div>
            </div>
        </div>

        <div class="col-md-3 shadow-lg mb-5 bg-body rounded px-3 py-4 m-5">
            <div class="rounded-circle bg-info" style="height: 5.5rem;width: 5.5rem;">
                <center>
                    <i class="bi bi-cash-coin" style="color:white; font-size: 3.5rem;"></i>
                </center>
            </div>
            <div class="ms-3">
                <div style="font-size: 30px" id="revenue"></div>
                <div>Sales revenue</div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#revenue').text(new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format({{$revenue}}));
            });
        </script>

    </div>
@endsection
