@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::about.Breadcrumb_Active_About') }}</li>
@endpush

@section('content')
    <div class="p-3 text-center bg-body-tertiary">
        <div class="container" data-aos="zoom-in">
            <p class="col-lg-8 mx-auto lead">
                {{ trans('ptventa::about.Description_About') }}
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-3">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-right" data-aos-duration="700">
                            <i class="fas fa-map-marked-alt fa-2x mb-3"></i>
                            <h4>{{ trans('ptventa::about.Title_Card_Find') }}</h4>
                            <p>{{ trans('ptventa::about.Text_Card_Find') }}<br>Campoalegre, Huila</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-right">
                            <i class="far fa-clock fa-2x mb-3"></i>
                            <h4>{{ trans('ptventa::about.Title_Card_Schedule') }}</h4>
                            <p>{{ trans('ptventa::about.Text_Card_Schedule') }}<br>08:00AM - 03:00PM</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-right" data-aos-duration="700">
                            <i class="fas fa-phone fa-2x mb-3"></i>
                            <h4>{{ trans('ptventa::about.Title_Card_Contact') }}</h4>
                            <p>{{ trans('ptventa::about.Text_Card_Contact') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card text-center" data-aos="fade-right">
                            <i class="fas fa-envelope fa-2x mb-3"></i>
                            <h4>{{ trans('ptventa::about.Title_Card_Email') }}</h4>
                            <p>{{ trans('ptventa::about.Text_Card_Email') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-left">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex align-items-start gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                            <i class="fas fa-user-lock fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Title_Card_Security') }}</h4>
                            <p class="text-body-secondary">{{ trans('ptventa::about.Text_Card_Security') }}</p>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                            <i class="fas fa-tachometer-alt fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Title_Card_Efficiently') }}</h4>
                            <p class="text-body-secondary">{{ trans('ptventa::about.Text_Card_Efficiently') }}</p>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                            <i class="fas fa-tachometer-alt fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Title_Card_Desing') }}</h4>
                            <p class="text-body-secondary">{{ trans('ptventa::about.Text_Card_Desing') }}</p>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div
                            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-success bg-gradient rounded-1 p-2">
                            <i class="fas fa-layer-group fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-semibold mb-0">{{ trans('ptventa::about.Title_Card_Organized') }}</h4>
                            <p class="text-body-secondary">{{ trans('ptventa::about.Text_Card_Organized') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
