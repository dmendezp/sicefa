<!-- ======= Header ======= -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<header id="header" class="fixed-top"style="background-color: rgb(249, 89, 40, 0.7); ">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="{{ route('cefa.welcome') }}">SICEFA</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    <nav id="navbar-top" class="navbar" style="margin-right: 20px">
      <div class="navbar-nav">
          <div class="dropdown d-lg-none">
            <a class="nav-link scrollto" data-toggle="dropdown" href="#">
                Menu
            </a>
            <div class="dropdown-menu">
                <a class="nav-link scrollto" href="{{ route('cefa.welcome') }}">Inicio</a>
                <a class="nav-link scrollto" href="{{ route('cefa.developers') }}">Desarrolladores</a>
            </div>
        </div>
          <div class="dropdown d-lg-none">
              @auth
              <a href="{{ route('cefa.home') }}">{{ Auth::user()->nickname }}</a>
              <div class="dropdown-menu">
                  <a href="{{ route('cefa.password.change.index') }}">Cambiar contraseña</a>
                  <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Salir</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
              @else
              <a href="{{ route('login', ['redirect' => url()->current()]) }}">Log in</a>
              @endauth
          </div>
          <div class="dropdown lang d-lg-none">
              <a class="nav-link scrollto" data-toggle="dropdown" href="#">
                  {{ session('lang') }} <i class="fas fa-globe"></i>
              </a>
              <div class="dropdown-menu">
                  <a href="{{ url('lang',['es']) }}" class="dropdown-item scrollto">Español</a>
                  <a href="{{ url('lang',['en']) }}" class="dropdown-item scrollto">English</a>
              </div>
          </div>
      </div>
  </nav>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="{{ route('cefa.welcome') }}">Inicio</a></li>
        <li><a class="nav-link scrollto" href="{{ route('cefa.developers') }}">Desarrolladores</a></li>
        <li class="dropdown">
            @auth
                <a href="{{ route('cefa.home') }}">{{ Auth::user()->nickname }}</a>
              <ul>
                <li><a href="{{ route('cefa.password.change.index') }}">Cambiar contraseña</a></li>
                <li>
                  
              <a href="{{ route('logout') }}" class="d-block" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Salir</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
              </form>

                </li>
              </ul>              
            @else
                <a href="{{ route('login', ['redirect' => url()->current()]) }}">Log in</a>
            @endauth            

        </li>
        <li class="dropdown">
          <a class="nav-link scrollto" data-toggle="dropdown" href="#">
            {{ session('lang') }} <i class="fas fa-globe"></i>
          </a>
          <ul>
            <li><a href="{{ url('lang',['es']) }}" class="dropdown-item scrollto">Español</a></li>
            <li><a href="{{ url('lang',['en']) }}" class="dropdown-item scrollto">English</a></li>
          </ul>
        </li>
      </ul>

    </nav><!-- .navbar -->

  </div>

</header><!-- End Header -->