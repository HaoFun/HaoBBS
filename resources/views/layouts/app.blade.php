<!DOCTYPE html>
{{--  app()->getLocale()會取config/app.php中的locale配置，這邊應為zh_TW  --}}
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'HaoBBS') - Laravel</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
{{--  這邊的route_class是自訂helper function  --}}
<div id="app" class="{{ route_class() }}-page">

    {{--  引入頭部  --}}
    @include('layouts.header')

    <div class="container">


        @yield('content')

    </div>

    {{--  引入底部  --}}
    @include('layouts.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>