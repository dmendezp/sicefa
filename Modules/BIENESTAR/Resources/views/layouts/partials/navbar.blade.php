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