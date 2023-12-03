<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AGROINDUSTRIA | {{$title}}</title>
       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/agroindustria.css') }}"> --}}
        <link rel="icon" href="{{asset('modules/agroindustria/favicon.ico')}}">       
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/cssunidades.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/storer/styleinvb.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/styleindex.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/navbar.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/styleU.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/productos.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/styleFormulation.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/styleRequest.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/deliveries.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/activity.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/labor.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/instructor/deliveries.css')}}">
       <link rel="stylesheet" href="{{asset('modules/agroindustria/css/storer/inventory.css')}}">
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

        {{-- Scripts que deben ser iniciados en el head para que sirvan sus funcionalidades--}}
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>