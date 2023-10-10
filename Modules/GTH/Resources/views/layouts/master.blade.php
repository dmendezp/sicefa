<!DOCTYPE html>
<html lang="en">
<head>
  @include('gth::partials.head')

@yield('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <div class="wrapper">
    @include('gth::partials.navbar')

    @if (request()->is('gth/attendance'))
        @include('gth::partials.asistenciasidebar')
    @else
        @include('gth::partials.sidebar')
    @endif
</div>

  <main class="content">
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @yield('js')
 <br><br><br><br><br><br><br><br><br><br>
    @include('gth::partials.footer')

  <script src="script.js"></script>
  @section('js')
  @show
</body>
</html>
