@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>

            <table class="table table-striped table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $item)
                    <tr style="height: 90px;">
                        <th>{{$loop->index+1}}</th>
                        <td><a href="{{route('orderShow',$item->id)}}">{{$item->order_code}}</a></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            @if ($item->order_status_id == 1)
                                <label class="badge bg-info">Paid</label>
                            @elseif ($item->order_status_id == 2)
                                <label class="badge bg-info">Delivering</label>
                            @elseif ($item->order_status_id == 3)
                                <label class="badge btn-primary">Delivered</label>
                            @else
                                <label class="badge btn-danger">Canceled</label>
                            @endif
                        </td>
                        <td>
                            @if ($item->order_status_id == 1)
                                <button onclick="changeStatus({{$item->id}}, 2)" class="btn btn-sm btn-success">Approve
                                </button>
                                <button onclick="changeStatus({{$item->id}}, 4)" class="btn btn-sm bg-warning">Cancel
                                </button>
                            @elseif ($item->order_status_id == 2)
                                <button onclick="changeStatus({{$item->id}}, 3)" class="btn btn-sm btn-success">Received
                                </button>
                                <button onclick="changeStatus({{$item->id}}, 4)" class="btn btn-sm bg-warning">Cancel
                                </button>
                            @endif
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
        function changeStatus(id, status) {
            $.ajax({
                type: 'POST',
                url: '{{route('orderUpdateStatus')}}',
                data: {
                    'id': id,
                    'order_status_id': status
                },
                success: function (data) {
                    confirm(data['message'])
                    location.reload()
                }
            });
        }
    </script>
@endsection
