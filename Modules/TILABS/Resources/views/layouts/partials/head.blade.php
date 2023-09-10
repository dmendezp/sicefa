<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>TI-LABS | {{ $view['titlePage'] }}</title>
<!-- Favicons -->
<link href="{{ asset('modules/tilabs/favicon.ico') }}" rel="icon">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!--  Iconos de Font Awesome versión 6 -->
<link rel="stylesheet" href="{{ asset('libs/Fontawesome6/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('modules/tilabs/css/estilos.css?v=' . time()) }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Boostrap-5.3.0 -->
<link rel="stylesheet" href=" {{ asset('libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}" crossorigin="anonymus">
<!-- Implementacion de la libreria AOS -->
<link href="{{ asset('libs/AOS-2.3.1/dist/aos.css') }}" rel="stylesheet">