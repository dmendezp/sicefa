@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h3>Solicitudes</h3>
            <div class="mtop16">
                <p>No hay solucitudes pendientes</p>
            </div>
            <h3>Registros</h3>
            <div class="mtop16">
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($people, 0, ',', '.') }}</span>
                    <i class="fas fa-users"></i> Personas
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info">{{ number_format($apprentices, 0, ',', '.') }}</span>
                    <i class="fas fa-user-graduate"></i> Aprendices
                </a>
                <a class="btn btn-app  btn-app-2">
                    <span class="badge bg-info">{{ number_format($instructors, 0, ',', '.') }}</span>
                    <i class="fas fa-chalkboard-teacher"></i> Instructores
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">0</span>
                    <i class="fas fa-user-tie"></i> Administrativos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($courses, 0, ',', '.') }}</span>
                    <i class="fas fa-graduation-cap"></i> Cursos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($environments, 0, ',', '.') }}</span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($elements, 0, ',', '.') }}</span>
                    <i class="fas fa-cash-register"></i> Productos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($machinery, 0, ',', '.') }}</span>
                    <i class="fas fa-tractor"></i> Maquinaria
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($productive_units, 0, ',', '.') }}</span>
                    <i class="fas fa-warehouse"></i> U. Productivas
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($apps, 0, ',', '.') }}</span>
                    <i class="fas fa-laptop-code"></i> Aplicaciones
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($roles, 0, ',', '.') }}</span>
                    <i class="fas fa-user-tag"></i> Roles
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($users, 0, ',', '.') }}</span>
                    <i class="fas fa-user-shield"></i> Usuarios
                </a>
            </div>
        </div>
    </div>
@endsection
