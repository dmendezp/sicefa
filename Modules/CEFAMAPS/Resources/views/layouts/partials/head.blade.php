  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="{{ csrf_token() }}">

  <title>CEFAMAPS | {{$title}}</title>
  <link href="{{ asset('sica/favicon.ico') }}" rel="icon">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cefamaps/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('cefamaps/css/styles.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- para subir una imagen -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.css')}}">
  <!-- Loading the v6 core styles and the Solid and Brands styles -->
  <link href="{{ asset('fontawesome6/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome6/css/brands.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome6/css/solid.css') }}" rel="stylesheet">
  
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5i6F3rWoYH3-xf4GCCKs6qSV4eEW4L3s"
  type="text/javascript"></script>
