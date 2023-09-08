<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bienestar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('../bienestarxd/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- Otros scripts -->
  <!-- Theme style -->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fullcalendar/main.css') }}">
  <link rel="stylesheet" href="{{ asset('../bienestarxd/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <!--styles-->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/fullcalendar/main.css') }}">

  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bienestarxd/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('../bienestarxd/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('../libs/jquery-3.6.4.min.js') }}">


  <!--css general-->

  @yield('personalizationStyle')
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
      <a href="{{ route('bienestar.home') }}" class="nav-link">Inicio</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto group">
    <!-- Botón de cambio de idioma -->
    <li class="nav-item group-append">
      <a class="nav-link" href="#">
        <img src="{{ asset('ruta-al-icono-espanol.png') }}" alt="Español">
      </a>
    </li>
    <li class="nav-item group-append">
      <a class="nav-link" href="#">
        <img src="{{ asset('ruta-al-icono-ingles.png') }}" alt="Inglés">
      </a>
    </li>
    
    <!-- Icono de usuario -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <!-- Contenido del menú desplegable de usuario -->
        <a href="#" class="dropdown-item">Perfil</a>
        <a href="#" class="dropdown-item">Configuración</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">Cerrar sesión</a>
      </div>
    </li>
  </ul>
</nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link" style="text-decoration: none; display: flex; align-items: center;">
        <i class="fas fa-hand-holding-heart" style="color: #ffffff; font-size: 60px; margin-right: 10px;"></i>
        <div>
          <span class="brand-text font-weight-dark" style="color: white; font-size: 25px">Bienestar al</span><br>
          <span class="brand-text font-weight-dark" style="color: white; font-size: 25px">Aprendiz</span>
        </div>
      </a><br>
    
      <!-- Sidebar -->
      <div class="sidebar" style="background: #28b463;">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-user"></i>
                <p>Aprendices</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-pizza-slice"></i>
                <p>Alimentación <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 1</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 2</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 3</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-house-user"></i>
                <p>Internado <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 1</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 2</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 3</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-bus"></i>
                <p>Transporte <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('bienestar.buses') }}" class="nav-link">Buses</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.drivers') }}" class="nav-link">Conductores</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('bienestar.transportroutes') }}" class="nav-link">Rutas</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Asignar Rutas</a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list"></i>
                <p>Convocatorias <i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 1</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 2</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Opción 3</a>
                </li>
              </ul>
            </li>
          </ul><br>
          <!-- Línea separadora -->
          <hr class="sidebar-divider">

          <!-- Enlace "Volver a Sicefa" -->
          <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <nav class="">
              <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                  <a href="{{ route('cefa.welcome') }}" class="nav-link {{ ! Route::is('cefa.contact.maps') ?: 'active' }}">
                    <i class="fas fa-puzzle-piece"></i>
                    <p>
                      Volver a Sicefa
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
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
            @if(Session::has('message'))
            <div class="container-fluid">
              <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: block; margin-bottom: 16px;">
                {{ Session::get('message') }}
                @if ($errors->any())
                <ul>
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
                @endif
                <script>
                  $('.alert').slideDown();
                  setTimeout(function() {
                    $('.alert').slideUp();
                  }, 10000);
                </script>
              </div>
            </div>
            @endif
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
    <!-- Page specific script -->

    @section('script')
    <!-- Configuración del DataTable -->
    <script>
      $(document).ready(function() {
        // Configura el DataTable en el elemento con el id 'miDataTable'
        $('#benefitsTable').DataTable();
      });
    </script>
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