  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('cefa.bienestar.home') }}" class="nav-link"><i class="fas fa-home"></i>{{ trans('bienestar::menu.Home')}}</a>
      </li>
      @auth
            @if(checkRol('bienestar.admin'))
                <li class="nav-item d-none d-sm-inline-block mx-2">
                    <a href="{{ route('bienestar.admin.dashboard') }}" class="nav-link @if(Route::is('bienestar.admin.*')) active @endif">{{ trans('ptventa::general.admin') }}</a>
                </li>
            @endif
        @endauth
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto group">
      <!-- Botón de cambio de idioma -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ session('lang')}} <i class="fas fa-globe-americas"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Contenido del menú desplegable de usuario -->
          <a href="{{ url('lang', ['es']) }}" class="dropdown-item">Español</a>
          <a href="{{ url('lang', ['en']) }}" class="dropdown-item">Inglés</a>

        </div>
      </li>

      <!-- Icono de usuario -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Contenido del menú desplegable de usuario -->     
          <a href="#" class="dropdown-item">{{ trans('bienestar::menu.Log Out')}}</a>
        </div>
      </li>
    </ul>
  </nav>