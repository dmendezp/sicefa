<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SENAEMPRESA | Asistencias</title>

  <link rel="icon" href="{{ asset('AdminLTE/dist/img/logo P SENA.png')}}">

  <!-- Estilo del video senaempresa -->
  <link rel="stylesheet" href="{{ asset('senaempresa/css/main.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">   <!--{{--En esta referencia se agrega {{('')}}  --}} -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

   

   <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" type="text/css" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.css')}}">

 

  <!-- Select 2-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="{{ asset('senaempresa/css/style_senaempresa.css')}}">

  <!-- Estilos de fullcalendar -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">


   <!--  {{-- Sweatalert and toast --}} -->
 <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">

  <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">


  <!-- Estilos del Fingerprint -->
  <!-- Fonts -->
  <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('dpfp/css/estilos.css')}}">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  

</head>