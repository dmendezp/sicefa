<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PTVENTA | {{ $view['titlePage'] }}</title>

<!--  Iconos de Font Awesome versión 6 -->
<link rel="stylesheet" href="{{ asset('libs/Fontawesome6/css/all.min.css') }}">
<!-- AdminLTE -->
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.css') }}"> {{-- Estilos principales de adminLTE --}}
<!-- Estilos personalizados -->
<link rel="stylesheet" href="{{ asset('modules/ptventa/css/styles_dashboard.css') }}"> {{-- En este archivo se modifican las propiedades de estilos de la plantilla adminLTE --}}
<link rel="stylesheet" href="{{ asset('modules/ptventa/css/googlefonts.css') }}"> {{-- En este archivo se modifican las fuentes que se estan utilizando en la aplicacion --}}
<link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_styles.css') }}"> {{-- En este archivo se modifican las propiedades de estilos de las cards --}}
<link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}"> {{-- En este archivo se modifican las propiedades de estilos generales --}}
<!-- Boostrap-5.3.0 -->
<link rel="stylesheet" href=" {{ asset('libs/Bootstrap-5.3.0-alpha/css/bootstrap.min.css') }}" crossorigin="anonymus">
