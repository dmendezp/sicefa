<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PTVENTA | {{ $view['titlePage'] }}</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}"> {{-- Iconos usados desde la plantilla adminLTE --}}
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.css') }}"> {{-- Estilos principales de adminLTE --}}
{{-- Link CSS --}}
<link rel="stylesheet" href="{{ asset('ptventa/css/styles_dashboard.css') }}"> {{-- En este archivo se modifican las propiedades de estilos de la plantilla adminLTE --}}
<link rel="stylesheet" href="{{ asset('ptventa/css/googlefonts.css') }}"> {{-- En este archivo se modifican las fuentes que se estan utilizando en la aplicacion --}}
<link rel="stylesheet" href="{{ asset('ptventa/css/card_styles.css') }}"> {{-- En este archivo se modifican las propiedades de estilos de las cards --}}
 {{-- Boostrap-5.3.0--}}
 <link rel="stylesheet" href=" {{ asset('ptventa/libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}" crossorigin="anonymous"> {{-- Se llaman todos los estilos de bootstrap 5.3.0 de manera local desde la ruta que esta mencionanda --}}

