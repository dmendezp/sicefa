<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTVENTA</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('libs/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('libs/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('libs/AdminLTE-3.2.0/dist/css/adminlte.css') }}">
    {{-- Google Fonts: Local --}}
    <link rel="stylesheet" href="{{ asset('css/DashboardStyles.css') }}">
    {{-- Boostrap-5.2.0 Local --}}
    <link rel="stylesheet" href=" {{ asset('libs/Bootstrap-5.2.0/css/bootstrap.min.css') }}" crossorigin="anonymous">
    {{-- Fontawesome-free-6.2.1 Local --}}
    <link href="{{ asset('libs/Fontawesome-free-6.2.1/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/Fontawesome-free-6.2.1/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/Fontawesome-free-6.2.1/css/solid.css') }}" rel="stylesheet">

    @section('head') @show

</head>
