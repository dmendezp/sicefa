        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('modules/sigac/images/icon/graduation-cap-solid.ico') }}">
        <title>SIGAC | {{ $titlePage }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!--  Iconos de Font Awesome versión 6 -->
        <link rel="stylesheet" href="{{ asset('libs/Fontawesome6/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/sigac/css/stylesGeneral.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/sigac/css/customStyles.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/sigac/css/googlefonts.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Implementacion de la libreria AOS -->
        <link href="{{ asset('libs/AOS-2.3.1/dist/aos.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>