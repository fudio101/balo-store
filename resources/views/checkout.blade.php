<?php
/**
 * @author Fudio101
 * Date: 21/06/2022
 * Time: 0:31
 */
?>
@extends('layouts.main')

@section('content')
    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            Billing Detail
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form id="pay-form" method="post" action="{{route('pay')}}">
                                                @csrf
                                                <p><input type="text" name="name" placeholder="Name"></p>
                                                <p><input type="email" name="email" placeholder="Email"></p>
                                                <p><input type="tel" name="phone" placeholder="Phone"></p>
                                                <p><select id="province">
                                                        <option value="0">Province</option>
                                                        @foreach($provinces as $province)
                                                            <option
                                                                value="{{$province->id}}">{{$province->name}}</option>
                                                        @endforeach
                                                    </select></p>
                                                <p><select id="district" name="district">
                                                        <option value="">District</option>
                                                    </select></p>
                                                <p><input type="text" name="address" placeholder="Address"></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody class="order-details-body">
                            @foreach($cart as $item)
                                <tr>
                                    <td>{{$item[0]->name}}</td>
                                    <td class="text-right">{{$item[1]}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tbody class="checkout-details">
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-right">{{number_format($total, 0, '', ',').' VND'}}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td class="text-right">{{number_format(25000, 0, '', ',').' VND'}}</td>
                            </tr>
                            @if($discount>0)
                                <tr>
                                    <td>Coupon</td>
                                    <td class="text-right">{{number_format($discount, 0, '', ',').' VND'}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Total</td>
                                <td class="text-right">{{number_format($total + 25000 - $discount, 0, '', ',').' VND'}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <a onclick="$('#pay-form').submit();" class="boxed-btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
@endsection

@section('js')
    <script type="text/javascript">
        let getDistrictUrl = "{{ route('getDistrict') }}";
    </script>
@endsection
