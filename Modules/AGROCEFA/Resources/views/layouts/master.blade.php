
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <!--head-->
    @include('agrocefa::partials.head')
    @stack('head')
</head>
<body style="display: flex;">
  
  <!--Sidebar-->
    @include('agrocefa::partials.sidebar')
  <!--Sidebar-->

  <!--Navbar-->
  <section class="home">
      @include('agrocefa::partials.navbar')
  <!--Contenido-->
  @yield('content')

  </section>

  <script src="{{ asset('agrocefa/js/sidebarclose.js')}}"></script>

</body>
</html> 