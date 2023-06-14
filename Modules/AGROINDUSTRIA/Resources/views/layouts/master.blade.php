<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module AGROINDUSTRIA</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/agroindustria.css') }}"> --}}
       <link rel="stylesheet" href="{{asset('cssagroindustria/cssunidades.css')}}">
       <link rel="stylesheet" href="{{asset('cssagroindustria/styleinvb.css')}}">
       <link rel="stylesheet" href="{{asset('cssagroindustria/styleindex.css')}}">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
       <script src="https://kit.fontawesome.com/6364639265.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm navbar-Dark" style="background-color:white;">
        <a class="navbar-brand" href="#">K I R B I</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('agroindustria.index')}}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.unidd')}}">Unidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agroindustria.solicitud')}}">Solicitud</a>
                </li>
            </ul>
        </div>
    </nav>
        @yield('content')
        
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/agroindustria.js') }}"></script> --}}
    </body>
</html>
