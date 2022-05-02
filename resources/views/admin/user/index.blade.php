@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>User Manager</h3>

            <a href="{{route('userCreate')}}">
                <button class="btn btn-success">Add User</button>
            </a>

            <table class="table table-striped table-hover" style="margin-top: 20px;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->group->name}}</td>
                        <td style="width: 50px">
                            <a href="{{route('userEdit',$user->id)}}">
                                <div style="text-align: center;">
                                    <button class="btn btn-warning"><i class="bi bi-pencil-fill"></i></button>
                                </div>
                            </a>
                        </td>
                        <td style="width: 50px">
                            @if($user->id != $item->id)
                                <div style="text-align: center;">
                                    <button onclick="deleteUser({{$item->id}})" class="btn btn-danger"><i
                                            class="bi bi-x"></i>
                                    </button>
                                </div>
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
        function deleteUser(id) {
            const option = confirm('Are you sure you want to delete this product?');
            if (!option) return;

            $.ajax({
                type: 'DELETE',
                url: '{{route('userIndex')}}/' + id,
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
