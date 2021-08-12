<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if( !empty($app_token) )
        <meta name="x-app-name" content="{{ $app_name }}"/>
        <meta name="x-app-token" content="{{ $app_token }}"/>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('images/brandiology-logo.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    @yield('head')
</head>
<body>
    <div id="app" v-cloak></div>
    @if(config('app.env') === 'production')
        <script src="{{ mix('/dist/manifest.js') }}"></script>
        <script src="{{ mix('/dist/vendor.js') }}"></script>
    @else
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
    @endif
    @yield('content')
</body>
</html>
