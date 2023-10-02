<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('modules/dicsena/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dicsena/css/pro.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dicsena/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/dicsena/js/script.js') }}">
    <link rel="stylesheet" href="{{ asset('modules/dicsena/js/countries.js') }}">
    <title>Module DICSENA</title>
    <!--boostrap import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    {{-- Laravel Mix - CSS File --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/dicsena.css') }}"> --}}
    <!--fontawesome import-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div id="container-fluid">
        @if(Route::currentRouteName() !== 'cefa.dicsena.menu')
        @include('dicsena::layouts.partials.navbar')
        @endif
        @if(Route::currentRouteName() !== 'cefa.dicsena.guidepost.index')
        @include('dicsena::layouts.partials.navbar')
        @endif
        @section('content')
        @show
        @include('dicsena::layouts.partials.footer')
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/dicsena.js') }}"></script> --}}
    </div>
</body>

</html>