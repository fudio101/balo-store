@extends('admin.layouts.main')
@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form action="{{route('discountStore')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mb-2 mt-3" for="code">Code:</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
                        </div>


                        <div class="form-group">
                            <label class="mb-2 mt-3" for="discount">Discount:</label>
                            <input type="number" min="1" class="form-control" id="discount"
                                   name="discount" value="{{old('discount')}}">
                        </div>


                        <div class="form-group">
                            <label class="mb-2 mt-3" for="limit_number">Limit Number:</label>
                            <input type="number" min="0" class="form-control" id="limit_number" name="limit_number"
                                   value="{{old('limit_number')}}">
                        </div>


                        <div class="form-group">
                            <label class="mb-2 mt-3" for="expiration_date">Expiration date:</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                   value="{{old('expiration_date')}}">
                        </div>


                        <div class="form-group">
                            <label class="mb-2 mt-3" for="payment_limit">Payment limit:</label>
                            <input type="number" min="0" class="form-control" id="payment_limit"
                                   name="payment_limit" value="{{old('payment_limit')}}">
                        </div>


                        <div class="form-group">
                            <label class="mb-2 mt-3" for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description"
                                   value="{{old('description')}}">
                        </div>

                        <button class="btn btn-success mt-3">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
