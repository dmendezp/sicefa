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
          <li><div>
            @if (Route::has('login'))
                <div>
                    @auth
                       <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Log in</a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                </div>
            @endif</li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>

  </header><!-- End Header -->