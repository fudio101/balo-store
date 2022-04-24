<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng Nhập</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{asset('assets/images/store-solid.svg')}}"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body
    style="background-image: url({{asset('assets/images/background-admin1.jpg')}}); background-size: cover; background-repeat: no-repeat;">
<div class="container">
    <div class="panel panel-primary shadow-lg"
         style="width: 480px; margin: 50px auto 0;background-color: white; padding: 10px; border-radius: 5px; box-shadow: 2px 2px #9ac9f5;">
        <div class="panel-heading">
            <h2 class="text-center">Đăng Nhập</h2>
            @if (session('status'))
                <p style="color: red;" class="text-center">{{ session('status') }}</p>
            @endif
        </div>
        <div class="panel-body">
            <form method="post">

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                </div>

                <div class="form-group">
                    <label for="pwd">Mật Khẩu:</label>
                    <input type="password" class="form-control" id="pwd" name="password" minlength="6">
                </div>

                <button class="btn btn-success">Đăng Nhập</button>
                @csrf
            </form>
        </div>
    </div>
</div>
</body>
</html>
