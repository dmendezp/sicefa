<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('modules/dicsena/css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/dicsena/css/content.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/dicsena/css/pro.css') }}">
        <title>Module DICSENA</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/dicsena.css') }}"> --}}
       <!--fontawesome import-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>
    <body>
    @include('dicsena::layouts.partials.navbar')
        @yield('content')
        </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
    @include('sica::layouts.partials.footer')
</div>
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/dicsena.js') }}"></script> --}}
    </body>
</html>
