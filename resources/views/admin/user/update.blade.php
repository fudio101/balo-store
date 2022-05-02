@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>{{$user->username}}</h4>
                </div>
                <div class="panel-body">
                    <form class="mb-5" action="{{route('userUpdate',$user->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="name">Full Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="role">Role:</label>
                            <select class="form-control" name="role" id="role">
                                <option value="">-- Select --</option>
                                @foreach($userGroups as $item)
                                    <option
                                        value="{{$item->id}}" {{$user->role!=$item->id?:'selected'}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="1" {{$user->gender!=0?:'selected'}}>Male</option>
                                <option value="0" {{$user->gender!=1?:'selected'}}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="phone">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="{{$user->phone}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{$user->address}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="password">New Password:</label>
                            <input type="password" class="form-control"
                                   id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="password_confirmation">New Password Verification:</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation">
                        </div>
                        <button class="btn btn-success my-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    </script>
@endsection
