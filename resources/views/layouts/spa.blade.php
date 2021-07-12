<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if( !empty($app_token) )
        <meta name="x-app-name" content="{{ $app_name }}"/>
        <meta name="x-app-token" content="{{ $app_token }}"/>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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
