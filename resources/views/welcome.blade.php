<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News 24h</title>

        <!-- Fonts -->
        <link href="{{ asset('vendor/css/media_query.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('vendor/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('vendor/css/animate.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('vendor/css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('vendor/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>
        {{-- <link href="{{ asset('vendor/css/style_1.scss')}}" rel="stylesheet" type="text/css"/> --}}
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <script src="{{ asset('vendor/js/modernizr-3.5.0.min.js')}}"></script>
    </head>
    <body>
        <noscript>
            <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app"></div>
    </body>
    <script src='{{ asset('js/app.js')}}'></script>
    <script src="{{ asset('vendor/js/owl.carousel.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
    <!-- Waypoints -->
    <script src="{{ asset('vendor/js/jquery.waypoints.min.js')}}"></script>
    <!-- Main -->
    <script src="{{ asset('vendor/js/main.js')}}"></script>
</html>
