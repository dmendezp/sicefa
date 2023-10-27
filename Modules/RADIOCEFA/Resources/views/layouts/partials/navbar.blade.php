<!-- Navbar -->
  <nav class="navbar navbar-expand bg-light border-dark" style="height: 4rem; ">
    <img src="{{asset('radi__cefa/logover.png') }}" alt="Logo" width="80" height="50" class="d-inline-block align-text-start" style="margin-left: 10px; margin-right: 6px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav m-3">
      <li class="nav-item">
        <a href="{{ route('inicioRadio') }}" class="nav-link text-success">Inicio</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('cronograma') }}" class="nav-link text-success">Cronograma</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('Expresate') }}" class="nav-link text-success">expresate</a>
      </li>
      <li class="nav-item">
      <a href="{{ route('aboutus') }}" class="nav-link text-success">Sobre Nosotros</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link text-success">Unete</a>
      </li>

      <li class="dropdown text-success nav-link">
              @auth
                 <a href="{{ route('cefa.home') }}">{{ Auth::user()->nickname }}</a>
                <ul>
                  <li><a href="#">Cambiar contraseña</a></li>
                  <li>
                    
                <a href="{{ route('logout') }}" class="d-block " onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Salir</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                </form>

                  </li>
                </ul>              
              @else
                  <a href="{{ route('login') }}" class="text-success" >Log in</a>
              @endauth            

          </li>
          
    </ul>
  </nav>
  <!-- /.navbar -->