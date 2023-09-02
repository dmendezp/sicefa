
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <!--head-->
    @include('agrocefa::partials.head')
    @stack('head')
</head>
<body style="display: flex;background-color: #e4e9f7">
  
  <!--Sidebar-->
    @include('agrocefa::partials.sidebar')
  <!--Sidebar-->

  
  <section class="home">
    <!--Navbar-->
      @include('agrocefa::partials.navbar')
  <!--Contenido-->
  @yield('content')

  </section>

  <script src="{{ asset('agrocefa/js/sidebarclose.js')}}"></script>

</body>
</html> 