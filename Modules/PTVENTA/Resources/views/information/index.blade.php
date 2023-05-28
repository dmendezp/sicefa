@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <div class="col-sm-6">
        <h1 class="m-0">{{-- Text --}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Acerca de:</li>
        </ol>
    </div>
@endpush

@section('content')
    <div class="p-5 text-center bg-body-tertiary">
        <div class="container py-5">
            <h1 class="text-body-emphasis">{{ $view['titleView'] }}</h1>
            <p class="col-lg-8 mx-auto lead">
                PTVenta nació en el año 2022, como un módulo de SICEFA, su objetivo es administrar la unidad productiva
                Punto de Venta del centro de formación agroindustrial "La Angostura".
            </p>
        </div>
    </div>

    <div class="b-example-divider"></div>

    <div class="container px-4 py-5">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card text-center">
                            <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                            <h3>Encuéntranos!</h3>
                            <p>Centro de Formación Agroindustrial La Angostura<br>Campoalegre, Huila</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center">
                            <i class="far fa-clock fa-3x mb-3"></i>
                            <h3>Horario de Atención</h3>
                            <p>Lunes - Viernes<br>08:00AM - 03:00PM</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center">
                            <i class="fas fa-phone fa-3x mb-3"></i>
                            <h3>Llámanos</h3>
                            <p>Próximamente</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h3>Correo Electrónico</h3>
                            <p>Próximamente</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-user-lock fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">Seguridad</h4>
                      <p class="text-body-secondary">Cuenta con un sistema de seguridad óptimo para que la información almacenada sea manejada solo por quienes se desea.</p>
                    </div>
                  </div>
              
                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-tachometer-alt fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">Eficiencia</h4>
                      <p class="text-body-secondary">Los procesos se realizan en el menor tiempo posible, haciendo que el tiempo de respuesta ante una petición sea casi instantáneo.</p>
                    </div>
                  </div>
              
                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-tachometer-alt fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">Diseño</h4>
                      <p class="text-body-secondary">Cuenta con un diseño elegante y minimalista, agradable para el cliente interno, donde puede hacer uso de este sistema sin complicaciones.</p>
                    </div>
                  </div>
              
                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-layer-group fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">Organizado</h4>
                      <p class="text-body-secondary">Toda la información al alcance de la mano, organizada de la manera más adecuada.</p>
                    </div>
                  </div>
                </div>
              </div>
              


        </div>
    </div>
@endsection

@section('scripts')
@endsection
