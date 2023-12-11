
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
  <style>
    .my-custom-popup-class {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        top: 15%; /* Ajusta este valor según sea necesario */
        transform: translateY(-50%);
    }
</style>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 15000,
            customClass: {
                popup: 'my-custom-popup-class',
            },
        });
    </script>
@endif
  </section>

 
  @include('agrocefa::partials.script')
</body>
</html> 