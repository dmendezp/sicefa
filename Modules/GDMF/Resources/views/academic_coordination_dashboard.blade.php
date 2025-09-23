@extends('gdmf::layouts.master')

@push('head')

@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::index.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Bienvenido a GDMF</h1>
            <p class="lead fw-bold">Sistema de Gestión de Materiales de Formación - SENA La Angostura</p>
        </div>

        <!-- Tarjetas resumen -->
        <div class="row g-4 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card text-white card-color h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-2x mb-2"></i>
                        <h5 class="card-title">Total Materiales</h5>
                        <p class="card-text fs-4">156</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white card-color h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-tags fa-2x mb-2"></i>
                        <h5 class="card-title">Categorías</h5>
                        <p class="card-text fs-4">12</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white card-color h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5 class="card-title">Instructores</h5>
                        <p class="card-text fs-4">23</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white card-color h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-book-reader fa-2x mb-2"></i>
                        <h5 class="card-title">Fichas activas</h5>
                        <p class="card-text fs-4">8</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección informativa -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('modules/gdmf/images/gifs/pregunta.gif') }}"
                                class="card-img-top custom-img align-self-center" alt="...">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">¿Qué es GDMF?</h5>
                                <p class="card-text">Es un sistema creado para gestionar de forma eficiente todos los
                                    materiales de formación en el centro educativo del SENA, permitiendo el seguimiento,
                                    categorización y trazabilidad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row g-0">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('modules/gdmf/images/gifs/controlar.gif') }}"
                                class="card-img-top custom-img align-self-center" alt="...">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">¿Qué puedes hacer?</h5>
                                <p class="card-text">Puedes registrar, actualizar y visualizar materiales por categoría,
                                    asignarlos a instructores y fichas, e identificar qué materiales están en uso o
                                    disponibles.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script>
        document.getElementById("scrollButton").addEventListener("click", function() {
            var scrollHeight = 500; // Altura de desplazamiento deseada (ajusta este valor según tus necesidades)
            window.scrollTo({
                top: scrollHeight,
                behavior: "smooth"
            });
        });
    </script>
@endpush
