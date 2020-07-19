<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Sicurezza</title>
    <link rel="stylesheet" href="{{asset('assets/admin/css/main.css')}}">
    @laravelPWA
    <style>
      .centered {
            text-align: center;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="col-md-4"></div>
    <div class="col-md-4 centered">
        <div class="card">
            <div class="card-body"><h5 class="card-title">Login</h5>
                <div>
                    <form class="form-inline" style="display: inline-block" action="{{route('senior.login.post')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @error('username')
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input name="username" placeholder="Username" type="text" class="col-md-12 mb-2 form-control" style="width: none" required>
                        </div>
                        <div class="form-group">
                            @error('password')
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input name="password" placeholder="Password" type="password" class="col-md-12 mb-2 form-control" style="width: none" required>
                        </div>
                        <div class="form-group">
                            <button class="col-md-12 btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="vol-md-4"></div>
</body>
</html>