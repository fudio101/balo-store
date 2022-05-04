@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <h3>Order Details</h3>
        </div>
        <div class="col-md-8 table-responsive">
            <table class="table table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <th>{{$loop->index}}</th>
                        <td><img src="{{$item->product->avatarUrl}}" style="height: 120px" alt=""/></td>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->product->price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price*$item->quantity}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <th>{{$subtotal}}</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Discount</th>
                    <th>{{$order->coupon}}</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Subtotal</th>
                    <th>{{max($subtotal - $order->coupon, 0)}}</th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered table-hover" style="margin-top: 20px;">
                <tr>
                    <th>Name:</th>
                    <td>{{$order->name}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{$order->email}}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>{{$order->address}}</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>{{$order->phone}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
