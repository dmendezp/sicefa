<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Desplazamiento de Funcionarios</title>
    <link rel="icon" href="{{ asset('modules/gdf/images/Contacto/logo_sena.jpg') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{asset('modules/gdf/css/layouts/masterusers.css')}}">

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
            <li style="margin-right: 20px;">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-home"></i> Inicio
                </a>
            </li>
    
            @auth
                @if (checkRol('gdf.admin'))
                    <li style="margin-right: 20px;">
                        <a class="nav-link" href="{{ route('cefa.gdf.admin.welcome') }}">
                            <i class="fas fa-user-shield"></i> Administrador
                        </a>
                    </li>
                
                @elseif (checkRol('gdf.funcionario'))
                    <li style="margin-right: 20px;">
                        <a class="nav-link" href="{{ route('cefa.gdf.funcionario.welcome') }}">
                            <i class="fas fa-user-shield"></i> Funcionario
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer>
        <strong>&copy; 2023-2025 <a href="#">GDF</a>.</strong>
