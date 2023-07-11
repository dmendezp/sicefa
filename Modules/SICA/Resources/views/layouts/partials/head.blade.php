<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SICA | {{ $title }}</title>
  <!-- Favicons -->
  <link href="{{ asset('sica/favicon.ico') }}" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Loading the v6 core styles and the Solid and Brands styles -->
  <link href="{{ asset('fontawesome6/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome6/css/brands.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome6/css/solid.css') }}" rel="stylesheet">

  <!-- update existing v5 CSS to use v6 icons and assets -->
  <link href="{{ asset('fontawesome6/css/v5-font-face.css') }}" rel="stylesheet">


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fullcalendar/lib/main.css') }}">
  <link rel="stylesheet" href="{{ asset('sica/css/style.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  {{-- Sweatalert and toast --}}
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">

  <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

</head>
