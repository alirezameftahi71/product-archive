<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Game Archive</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav-bar></nav-bar>
        <b-container fluid>
            @yield('content')
        </b-container>
        <footer-bar></footer-bar>
        <div class="loader loader-default" data-text data-blink></div>
        <flash-message></flash-message>
        @yield('modals')
    </div>
    <script src="/js/app.js"></script>
    @yield('scripts')
</body>

</html>
