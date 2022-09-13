<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('chat_app/css/assets/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('chat_app/css/assets/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('chat_app/css/login/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('chat_app/css/login/main.css') }}">

    @livewireStyles
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('chat_app/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-50 p-r-50 p-t-55 p-b-54">

                @yield('content')

            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>