<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module RADIOCEFA</title>

       @include('layouts/partials/head')
        {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/radiocefa.css') }}"> --}}

    </head>
    <body>
        
        @yield('content')
        @include('layouts/partials/scripts')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/radiocefa.js') }}"></script> --}}
    </body>
</html>
