<?php
/**
 * @author Fudio101
 * Date: 20/06/2022
 * Time: 23:37
 */
?>
@extends('layouts.main')

@section('content')
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".strawberry">Strawberry</li>
                            <li data-filter=".berry">Berry</li>
                            <li data-filter=".lemon">Lemon</li>
                            <li data-filter=".avocado">Avocado</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="{{asset('assets/img/products/product-img-1.jpg')}}" alt=""></a>
                        </div>
                        <h3>Strawberry</h3>
                        <p class="product-price"><span>Per Kg</span> 85$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center berry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
                        </div>
                        <h3>Berry</h3>
                        <p class="product-price"><span>Per Kg</span> 70$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center lemon">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
                        </div>
                        <h3>Lemon</h3>
                        <p class="product-price"><span>Per Kg</span> 35$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center avocado">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="assets/img/products/product-img-4.jpg" alt=""></a>
                        </div>
                        <h3>Avocado</h3>
                        <p class="product-price"><span>Per Kg</span> 50$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="assets/img/products/product-img-5.jpg" alt=""></a>
                        </div>
                        <h3>Green Apple</h3>
                        <p class="product-price"><span>Per Kg</span> 45$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center strawberry">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{route('product',1)}}"><img src="assets/img/products/product-img-6.jpg" alt=""></a>
                        </div>
                        <h3>Strawberry</h3>
                        <p class="product-price"><span>Per Kg</span> 80$ </p>
                        <a href="{{route('cart')}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection
