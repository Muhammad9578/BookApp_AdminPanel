<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Travces') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">

    .navbar {
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }

    .sidenav {
        height: 100%;
        width: 100%;
        z-index: 10000;
        position: relative;
        box-shadow: 3px 0 8px rgba(0, 0, 0, 0.3);
    }
</style>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

</head>
<body>


    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 p-0">
                @include('layouts.admin.sidenav')
            </div>
            <div class="col-md-10 p-0">
                @include('layouts.admin.navbar')
                <main class="py-4">
                @yield('content')
                </main>
            </div>
        </div>
    </div>

</body>
</html>
