<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fullcalendar/main.css') }}">
  <link rel="stylesheet" href="{{ asset('../bienestarxd/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymoues"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--styles-->
        <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/fullcalendar/main.css') }}">

  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  <style>
      .sidebar-dark-primary{
        background: #085E6D !important;
      }
 </style>

  <!--css general-->
<link rel="stylesheet" href="{{ asset('../bienestarxd/css/styles.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
  
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('bienestarxd/AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
                        </ul>
          <img src="{{ asset('bienestarxd/AdminLTE-3.2.0/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          
        </div>
                        
                    
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
                    
          <li class="nav-item">
            <a href="{{ route('bienestar.APEsena') }}" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
                Aprendices
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bienestar.APEalimentacion') }}" class="nav-link">
              <i class="fas fa-pizza-slice"></i>
              <p>
                Alimentacion
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bienestar.APEinterno') }}" class="nav-link">
              <i class="fas fa-house-user"></i>
              <p>
                Internado
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bienestar.APEtransporte') }}" class="nav-link">
              <i class="fas fa-bus"></i>
              <p>
                Transporte
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bienestar.HISeventos') }}" class="nav-link">
              <i class="fas fa-calendar-day"></i>
              <p>
                Eventos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('bienestar.APEformulario') }}" class="nav-link">
              <i class="fas fa-clipboard-list"></i>
              <p>
                Convocatorias Apoyos
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          @yield('content')
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
<!-- js general -->
<script src="{{ asset('../bienestarxd/js/script.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/fullcalendar/main.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
<!-- Page specific script -->

@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'UTC',
      initialView: 'dayGridMonth',
      events: 'https://fullcalendar.io/api/demo-feeds/events.json',
      editable: true,
      selectable: true
    });

    calendar.render();
  });
</script>
@show

</body>
</html>
