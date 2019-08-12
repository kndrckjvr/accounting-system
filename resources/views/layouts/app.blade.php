<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Accounting System') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        @auth
        @include('layouts.sidebar_navigation')
        @endauth
        <div id="content-wrapper" class="d-flex flex-column">
            @auth
            @include('layouts.topbar_navigation')
            @endauth

            <div class="container-fluid">
                <div class="container">
                    @if(Session::has('alert'))
                        <div class="alert alert-success">
                            {{Session::get('alert')}}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('js/bootstrap-sb-admin.js') }}"></script>
</body>

</html>