<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Maquetación</title>

        @include ("admin.layout.partials.style")
    </head>

    <body>
        <div class="flex-container">
            @yield('content')
        </div>
            @include('admin.layout.partials.js')
    </body>
</html>