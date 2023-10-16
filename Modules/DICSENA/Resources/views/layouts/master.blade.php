<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Module DICSENA</title>
    <!--boostrap import-->
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    {{-- Laravel Mix - CSS File --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/dicsena.css') }}"> --}}
    <!--fontawesome import-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="{{ asset('Datatables-1.13.4/datatables.css') }}" rel="stylesheet">

    <!-- Loading the v6 core styles and the Solid and Brands styles -->
    <link href="{{ asset('fontawesome6/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome6/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome6/css/solid.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-globe"></i> DICSENA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('cefa.dicsena.menu')}}">Panel</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a class="button" href="{{ route ('cefa.dicsena.home.index')}}">Logout</a>
                </span>
            </div>
        </div>
    </nav>


    <div id="wrapper">
        @section('content')
        @show
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/dicsena.js') }}"></script> --}}
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>

        <footer class="main-footer" style="background-color: #3C3B6E; color: white; ">
            <p style="text-align: center;">Use exclusive for apprentices of SENA</p>
            <p style="text-align: center;">&copy; 2023</p>
        </footer>

    </div>


</body>

</html>