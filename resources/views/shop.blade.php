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
                            @foreach($categories as $categoty)
                                <li data-filter=".{{Illuminate\Support\Str::slug($categoty->name, '-')}}">{{$categoty->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists">
                @foreach($products as $product)
                    <div
                        class="col-lg-4 col-md-6 text-center {{Illuminate\Support\Str::slug($product->category->name, '-')}}">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{route('product',$product->id)}}"><img
                                        src="{{$product->avatar?$product->avatarUrl:asset('assets/img/products/product-img-1.jpg')}}"
                                        alt=""></a>
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

            {{$products->onEachSide(5)->links('layouts/_pagination')}}

        </div>
    </div>
    <!-- end products -->
@endsection
