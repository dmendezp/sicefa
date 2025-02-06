<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SICEFA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swaphttps://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @include('layouts/emails/head')

    @section('stylesheet')
    @show


</head>
<body class="antialiased">

    {{-- @include('layouts/partials/PntCarg') --}}
<div class="wrapper">        
    @include('layouts/emails/header')

    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                @section('content') @show
            </div>
        </div>
    </div>
</div>

    @include('layouts/emails/scripts')

    </body>
</html>