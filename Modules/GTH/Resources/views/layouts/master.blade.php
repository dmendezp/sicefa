<!DOCTYPE html>
<html lang="en">
<head>
  @include('gth::partials.head')
</head>
<body>
    @include('gth::partials.navbar')

    @if (request()->is('gth/attendance'))
        @include('gth::partials.asistenciasidebar')
    @else
        @include('gth::partials.sidebar')
    @endif


  <main class="content">
    @yield('content')




  <script src="script.js"></script>
  @section('js')
  @show
</body>
</html>
