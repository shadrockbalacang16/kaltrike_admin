<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ mix('/js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

        <!-- Fontfaces CSS-->
        <link href="{{{ URL::asset('css/font-face.css') }}}" rel="stylesheet" media="all">
        <!-- <link href="{{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}}" rel="stylesheet" media="all">
        <link href="{{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}}" rel="stylesheet" media="all">
        <link href="{{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}}" rel="stylesheet" media="all"> -->

        <!-- Bootstrap CSS-->
        <link href="{{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css')}}}" rel="stylesheet" media="all">
        <!-- <link href="{{{ URL::asset('vendor/animsition/animsition.min.css')}}}" rel="stylesheet" media="all"> -->

        <!-- Main CSS-->
        <link href="{{{ URL::asset('css/theme.css')}}}" rel="stylesheet" media="all">
        {{-- <script src="{{ mix('/js/app.js') }}" defer></script> --}}

        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->
    </head>

    <body>
        <div class="page-wrapper" id="app">
            @include('admin/partials.header')
            @include('admin/partials.sidebar')

            <div class="page-container">
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    @include('admin/partials.footer')
                </div>
            </div>
        </div>
    </body>

    <script>
        @yield('content')
    </script>

</html>
