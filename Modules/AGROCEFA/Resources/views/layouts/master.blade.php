
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <!--head-->
    @include('agrocefa::partials.head')
    @stack('head')
</head>
<body style="display: flex;">
  
  @if(request()->is('agrocefa/parameters'))
    <!-- Sidebar Parametros -->
    @include('agrocefa::partials.sidebarparameters')
  @elseif (request()->is('agrocefa/aprendiz'))
    <!--Sidebar Aprendiz-->
    @include('agrocefa::partials.sidebaraprendiz')
  @elseif (request()->is('agrocefa/user'))
  <!--Sidebar Usuario-->
    @include('agrocefa::partials.sidebarusuario')
  @else
    <!--Sidebar-->
    @include('agrocefa::partials.sidebar')
  @endif
  <!--Sidebar-->

  <!--Navbar-->
  <section class="home">
    @if (request()->is('agrocefa/aprendiz'))
      <!--Navbar Aprendiz-->
      @include('agrocefa::partials.navbaraprendiz')
    @elseif (request()->is('agrocefa/user'))
    <!--Navbar Usuario-->
      @include('agrocefa::partials.navbaraprendiz')
    @else
      @include('agrocefa::partials.navbar')
    @endif
  

  <!--Contenido-->
  @yield('content')

  </section>

  

  <script src="{{ asset('agrocefa/js/sidebarclose.js')}}"></script>

</body>
</html> 