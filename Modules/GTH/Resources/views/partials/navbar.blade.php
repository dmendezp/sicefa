<nav class="navbar">
    <button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>

    <div class="navbar-links">
      <a href="{{route('index.view')}}" class="navbar-link" id="inicio">Inicio</a>
      <a href="{{route('attendance.view')}}" class="navbar-link" id="inicio"><i class='bx bx-list-check icon'></i>Asistencia</a>
      <a href="{{ url('lang',['en']) }}" class="navbar-link" style="margin-right: 60px;"><i class="bi bi-globe icon"></i>Ingles
      </a>
      <a href="{{ url('lang',['es']) }}" class="navbar-link" style="margin-right: 120px"><i class="bi bi-translate icon"></i>Español
      </a>
      <a href="{{route('login')}}" class="navbar-link" style="margin-left: 150px;"><i class='bx bx-lock icon'></i>Login</a>
    </div>
  </nav>