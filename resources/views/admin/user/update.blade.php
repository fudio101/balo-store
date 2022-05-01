@extends('admin.layouts.main')

@section('content')
    <div class="row" style="margin-top: 48px;">
        <div class="col-md-12 table-responsive">
            <h3>{{$title}}</h3>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5 style="color: red;">{{1}}</h5>
                </div>
                <div class="panel-body">
                    <form class="mb-5" method="post" onsubmit="return validateForm();">
                        @csrf
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="usr">Full Name:</label>
                            <input type="text" class="form-control" id="usr" name="fullname"
                                   value="{{1}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="usr">Username:</label>
                            <input type="text" class="form-control" id="usrn" name="username"
                                   value="{{1}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="usr">Role:</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">-- Select --</option>
                                <option value="{{1}}"></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{1}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                   value="{{1}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{1}}">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="password">Password:</label>
                            <input type="password" class="form-control"
                                   id="password" name="password" minlength="6">
                        </div>
                        <div class="form-group">
                            <label class="mt-3 mb-2" for="password_confirmation">Password Verification:</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" minlength="6">
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
        function validateForm() {
            const pwd = $('#pwd').val();
            const confirmPwd = $('#confirmation_pwd').val();
            if (pwd !== confirmPwd) {
                alert("Password does not match, please check again")
                return false
            }
            return true
        }
    </script>
@endsection
