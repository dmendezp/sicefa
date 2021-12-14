<!-- ======= Header ======= -->
  <header id="header" class="fixed-top"style="background-color: rgb(249, 89, 40, 0.7); ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/') }}">SICEFA</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
          <li><a class="nav-link scrollto" href="#ptoventa">Punto de venta</a></li>
          <li><a class="nav-link scrollto" href="#modules">Modulos</a></li>
          <li><a class="nav-link scrollto" href="#cefa">Map</a></li>
          <li><a class="nav-link scrollto" href="#why-us">SENA-Empresa</a></li>
          <li><a class="nav-link scrollto" href="#about">Acerca</a></li>
          <li><a class="nav-link scrollto" href="#contact">PQRS</a></li>
          <li class="dropdown">
              @auth
                 <a href="{{ url('/home') }}">{{ Auth::user()->nickname }}</a>
                <ul>
                  <li><a href="#">Cambiar contraseña</a></li>
                  <li>
                    
                <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Salir</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                </form>

                  </li>
                </ul>              
              @else
                  <a href="{{ route('login') }}">Log in</a>
              @endauth            

          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>

  </header><!-- End Header -->