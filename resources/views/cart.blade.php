<?php
/**
 * @author Fudio101
 * Date: 21/06/2022
 * Time: 0:19
 */
?>
@extends('layouts.main')

@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-remove">#</th>
                                <th class="product-image">Product Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cart)
                                @foreach($cart as $item)
                                    <tr class="table-body-row cart">
                                        <td class="product-remove">
                                            <a class="delete-cart-item" data-route="{{route('deleteCardItem')}}"
                                               data-id="{{$item[0]->id}}">
                                                <i class="far fa-window-close"></i>
                                            </a>
                                        </td>
                                        <td class="product-image"><img
                                                src="{{$item[0]->avatar?$item[0]->avatarUrl:asset('assets/img/products/product-img-1.jpg')}}"
                                                alt="">
                                        </td>
                                        <td class="product-name">{{$item[0]->name}}</td>
                                        <td class="product-price">{{$item[0]->vndPrice}} VND</td>
                                        <td class="product-quantity">
                                            <input name="quantity" min="0" step="1" type="number" value="{{$item[1]}}">
                                            <input name="id" hidden value="{{$item[0]->id}}">
                                        </td>
                                        <td class="product-total">{{$item[2]}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-body-row">
                                    <td colspan="6">
                                        <span>Have no item here</span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="total-data">
                                <td><strong>Subtotal: </strong></td>
                                <td>{{ number_format($total, 0, '', ',')}} VND</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Shipping: </strong></td>
                                <td>25,000 VND</td>
                            </tr>
                            @if($discount>0)
                                <tr class="total-data">
                                    <td><strong>Discount: </strong></td>
                                    <td>{{ number_format($discount, 0, '', ',')}} VND</td>
                                </tr>
                            @endif
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>{{ number_format($total + 25000 - $discount, 0, '', ',')}} VND</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            <a id="updateCart" data-route="{{route('updateCart')}}" class="boxed-btn">Update Cart</a>
                            <a href="{{route('checkout')}}" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h3>Apply Coupon</h3>
                        <div class="coupon-form-wrap">
                            <form method="post" action="{{route('applyCoupon')}}">
                                @csrf
                                <p><input type="text" name="couponCode" placeholder="Coupon"></p>
                                <p><input type="submit" value="Apply"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
