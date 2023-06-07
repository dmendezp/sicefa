@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link href="{{asset('libs/AOS-2.3.1/dist/aos.css')}}" rel="stylesheet">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::about.About us')}}</li>
@endpush

@section('content')
    <div class="p-5 text-center bg-body-tertiary">
        <div class="container" data-aos="zoom-in">
            <h1 class="text-body-emphasis">{{ $view['titleView'] }}</h1>
            <p class="col-lg-8 mx-auto lead">
              {{ trans('ptventa::about.Born in 2022, as a module of SICEFA, its objective is to manage the Point of Sale production unit of the agro-industrial training center "La Angostura".')}}
            </p>
        </div>
    </div>

    <div class="container px-4">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-down-right">
                            <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                            <h3>{{ trans('ptventa::about.Find us!')}}</h3>
                            <p>{{ trans('ptventa::about.Agroindustrial Training Center "La Angostura"')}}<br>Campoalegre, Huila</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-down-left">
                            <i class="far fa-clock fa-3x mb-3"></i>
                            <h3>{{ trans('ptventa::about.Opening Hours')}}</h3>
                            <p>{{ trans('ptventa::about.Monday - Friday')}}<br>08:00AM - 03:00PM</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-up-right">
                            <i class="fas fa-phone fa-3x mb-3"></i>
                            <h3>{{ trans('ptventa::about.Contact Us')}}</h3>
                            <p>{{ trans('ptventa::about.Coming Soon')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-up-left">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h3>{{ trans('ptventa::about.Email Address')}}</h3>
                            <p>{{ trans('ptventa::about.Coming Soon')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-left">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-user-lock fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Security')}}</h4>
                      <p class="text-body-secondary">{{ trans('ptventa::about.It has an optimal security system so that the stored information is handled only by those who want it.')}}</p>
                    </div>
                  </div>

                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-tachometer-alt fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Efficiently')}}</h4>
                      <p class="text-body-secondary">{{ trans('ptventa::about.The processes are carried out in the shortest possible time, making the response time to a request almost instantaneous.')}}</p>
                    </div>
                  </div>

                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-tachometer-alt fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Desing')}}</h4>
                      <p class="text-body-secondary">{{ trans('ptventa::about.It has an elegant and minimalist design, pleasant for the internal customer, where he can make use of this system without complications.')}}</p>
                    </div>
                  </div>

                  <div class="col d-flex align-items-start gap-2">
                    <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                      <i class="fas fa-layer-group fs-4"></i>
                    </div>
                    <div>
                      <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Organized')}}</h4>
                      <p class="text-body-secondary">{{ trans('ptventa::about.All the information at your fingertips, organized in the most appropriate way.')}}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('libs/AOS-2.3.1/dist/aos.js')}}"></script>
    <script>
        AOS.init();
    </script>
@endpush
