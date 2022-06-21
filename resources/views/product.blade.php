<?php
/**
 * @author Fudio101
 * Date: 20/06/2022
 * Time: 23:51
 */
?>
@extends('layouts.main')

@section('content')
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img
                            src="{{$product->avatar?$product->avatarUrl:asset('assets/img/products/product-img-1.jpg')}}"
                            alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{$product->name}}</h3>
                        <p class="single-product-pricing">{{$product->vndPrice}} VND</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi
                            cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi
                            perferendis eos eum modi! Tempora, earum.</p>
                        <div class="single-product-form">
                            <form id="add-{{$product->id}}" action="{{route('addCart')}}" method="post">
                                <input type="number" name="quantity" min="1" step="1" value="1">
                                <input hidden name="productId" value="{{$product->id}}">
                                @csrf
                            </form>
                            <a onclick="document.getElementById('add-{{$product->id}}').submit();" class="cart-btn"><i
                                    class="fas fa-shopping-cart"></i> Add to
                                Cart</a>
                            <p><strong>Categories: </strong>{{$product->category->name}}</p>
                        </div>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div
                        class="col-lg-4 col-md-6 {{($loop->index + 1) % 3 != 0 ?:'offset-lg-0 offset-md-3'}} text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{route('product', $product->id)}}">
                                    <img
                                        src="{{$product->avatar?$product->avatarUrl:asset('assets/img/products/product-img-1.jpg')}}"
                                        alt="">
                                </a>
                            </div>
                            <h3>{{$product->name}}</h3>
                            <p class="product-price">{{$product->vndPrice}} VND</p>
                            <form id="add-{{$product->id}}" action="{{route('addCart')}}" method="post">
                                <input hidden name="productId" value="{{$product->id}}">
                                @csrf
                                <a onclick="document.getElementById('add-{{$product->id}}').submit();" class="cart-btn"><i
                                        class="fas fa-shopping-cart"></i> Add to
                                    Cart</a>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
@endsection
