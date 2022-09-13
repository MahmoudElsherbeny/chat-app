<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'chat_app')</title>
    <meta name="description" content="real time chat_app">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <link rel="stylesheet" href="{{ url('chat_app/css/assets/bootstrap.min.css') }}">
    <!--  icons  -->
    <link rel="stylesheet" href="{{ url('chat_app/css/assets/ionicons.css') }}" />
    <link rel="stylesheet" href="{{ url('chat_app/css/assets/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ url('chat_app/css/shortcode/main.css') }}">
    <link rel="stylesheet" href="{{ url('chat_app/css/style.css') }}">

    @livewireStyles
</head>

 <body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding: 0;">
                <nav class="col-md-2 col-sm-1 col-xs-1" style="padding: 0;">
                    @include('chat_app.layouts.menu')
                </nav>

                <section class="col-md-10 col-sm-11 col-xs-11" style="padding: 0;">
                    @include('chat_app.layouts.chats_menu')
                </section>
            </div>

            <section class="col-md-8 hidden-sm hidden-xs" style="padding: 0;">
                @yield('content')
            </section>
        </div>
    </div>


    <script>
        function active(el) {
            $('.menu-item').removeClass('item-active').filter(el).toggleClass('item-active'); // remove active class from the li's and toggle the class for the clicked element
        }
    </script>

    @livewireScripts

    @yield('js_code')
</body>
</html>