@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 46px;">
        <div class="col-md-12 table-responsive">
            <h3>Product Management</h3>

            <a href="{{route('productCreate')}}">
                <button class="btn btn-success">Add Product</button>
            </a>

            <table class="table table-striped table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Quantity Sold</th>
                    <th>Import</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                {{--            {{dd($data[0])}}--}}
                @foreach($data as $item)
                    <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>
                            <div style="text-align: center;">
                                <img src="{{$item->avatar}}" style="height: 100px; object-fit: contain;" alt=""/>
                            </div>
                        </td>
                        <td> {{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->category->name}}</td>
                        <td> {{$item->quantity}}</td>
                        <td> {{$item->quantity_sold}}</td>
                        <td style="width: 50px">
                            <div style="text-align: center;">
                                <button onclick="importGoods( {{$item->id}} )" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </td>
                        <td style="width: 50px">
                            <a href="">
                                <div style="text-align: center;">
                                    <button class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button>
                                </div>
                            </a>
                        </td>
                        <td style="width: 50px">
                            <div style="text-align: center;">
                                <button onclick="deleteProduct( {{$item->id}} )" class="btn btn-danger"><i
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteProduct(id) {
            const option = confirm('Are you sure you want to delete this product?');
            if (!option) return;

            $.ajax({
                type: 'DELETE',
                url: '{{route('productIndex')}}/' + id,
                data: {
                    'id': id
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }

        function importGoods(id) {
            const quantity = prompt('How many products do you want to import?');
            if (!quantity) return;

            $.ajax({
                type: 'POST',
                url: '{{route('productIndex')}}/import/' + id,
                data: {
                    'quantity': quantity
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }
    </script>
@endsection
