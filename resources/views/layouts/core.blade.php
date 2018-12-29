<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('img/favicon.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
</head>
<body>
<header>
    <div class="row">
        <nav class="navbar navbar-dark bg-dark
        col-md-12" style="padding: 0 30px">
            <a class="navbar-brand" href="/">
                <img class="navbar-logo"
                     src="{{asset
                ('img/logo.png')}}" alt="Logo">
            </a>
            <a href="/faggot-test">Тест на
                пидора</a>
        </nav>
    </div>
</header>
@yield('content')
<script type="text/javascript"
        src="{{asset('js/app.js')}}"></script>
</body>
</html>
