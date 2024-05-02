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
                    <span class="badge bg-info">{{ number_format($courses, 0, ',', '.') }}</span>
                    <i class="fas fa-graduation-cap"></i> Cursos
                </a>
                <a class="btn btn-app btn-app-2">
                    <span class="badge bg-info">{{ number_format($environments, 0, ',', '.') }}</span>
                    <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
            </div>
        </div>
    </div>
@endsection
