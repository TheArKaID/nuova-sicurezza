<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/admin/css/main.css')}}">
    @laravelPWA
    @yield('styles')
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
    @yield('content')

    <script type="text/javascript" src="{{asset('assets/admin/js/main.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    @yield('scripts')
</body>
</html>