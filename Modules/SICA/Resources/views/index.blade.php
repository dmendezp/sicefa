@extends('sica::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <h1 class="display-4">SICA</h1>
                        <p class="lead">Sistema integrado de control administrativo.</p>
                        <hr class="my-4">
                        <p>SICA administra la configuración, seguridad y los datos iniciales de todas las aplicaciones
                            integradas en SICEFA, permitiendo la gestión eficiente de los recursos del centro de formación,
                            incluyendo la información del personal, inventarios, localización geografica, procesos
                            académicos, operativos y productivos.</p>
                        <p>Te presentamos algunos registros importantes en SICEFA:</p>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($people, 0, ',', '.') }}</span>
                            <i class="fas fa-users"></i> Personas
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($apprentices, 0, ',', '.') }}</span>
                            <i class="fas fa-user-graduate"></i> Aprendices
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($instructors, 0, ',', '.') }}</span>
                            <i class="fas fa-chalkboard-teacher"></i> Instructores
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">0</span>
                            <i class="fas fa-user-tie"></i> Administrativos
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($apps, 0, ',', '.') }}</span>
                            <i class="fas fa-laptop-code"></i> Aplicaciones
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($productive_units, 0, ',', '.') }}</span>
                            <i class="fas fa-warehouse"></i> U. Productivas
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($roles, 0, ',', '.') }}</span>
                            <i class="fas fa-user-tag"></i> Roles
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($users, 0, ',', '.') }}</span>
                            <i class="fas fa-user-shield"></i> Usuarios
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($environments, 0, ',', '.') }}</span>
                            <i class="fas fa-map-marked-alt"></i> Ambientes
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($elements, 0, ',', '.') }}</span>
                            <i class="fas fa-cash-register"></i> Productos
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($programs, 0, ',', '.') }}</span>
                            <i class="fas fa-graduation-cap"></i> Programas
                        </a>
                        <a class="btn btn-app">
                            <span class="badge bg-info">{{ number_format($machinery, 0, ',', '.') }}</span>
                            <i class="fas fa-tractor"></i> Maquinaria
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <section id="hero">
                        <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('general/assets/img/puzzle.png') }}" class="img-fluid animated zoom" alt="">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
