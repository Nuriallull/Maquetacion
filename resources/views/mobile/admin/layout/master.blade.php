<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="">

        <title>Maquetación</title>

        @include("mobile.admin.layout.partials.styles")
    </head>

    <body>
        <div class="wrapper" id="app">
            
            @include("mobile.admin.layout.partials.sidebar")

            <div class="main-content">
                @yield('content') 
            </div>
        </div>      
        @include("mobile.admin.layout.partials.js")
    </body>
</html>
