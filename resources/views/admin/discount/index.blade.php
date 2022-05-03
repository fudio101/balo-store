@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>

            <a href="{{route('discountCreate')}}">
                <button class="btn btn-success">Add Product</button>
            </a>

            <table class="table table-striped table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Limit number</th>
                    <th>Number used</th>
                    <th>Expiration days</th>
                    <th>Payment limit</th>
                    <th>Description</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $item)
                    <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>{{$item->code}}</td>
                        <td>{{$item->discount}}</td>
                        <td>{{$item->limit_number}}</td>
                        <td>{{$item->number_used}}</td>
                        <td>{{$item->expiration_day}} days</td>
                        <td>{{$item->payment_limit}}</td>
                        <td>{{$item->description}}.</td>
                        <td style="width: 50px">
                            <a href="{{route('discountEdit',$item->id)}}" style="text-align: center;">
                                <button class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button>
                            </a>
                        <td style="width: 50px">
                            <div style="text-align: center;">
                                <button onclick="deleteDiscount({{$item->id}})" class="btn btn-danger"><i
                                        class="bi bi-x"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function deleteDiscount(id) {
            const option = confirm('Are you sure you want to delete this product?');
            if (!option) return;

            $.ajax({
                type: 'DELETE',
                url: '{{route('discountIndex')}}/' + id,
                data: {
                    'id': id
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }
    </script>
@endsection

