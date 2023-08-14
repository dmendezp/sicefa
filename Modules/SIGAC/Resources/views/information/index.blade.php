@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::about.About us') }}</li>
@endpush

@section('content')
    <div class="p-3 text-center bg-body-tertiary">
        <div class="container" data-aos="zoom-in">
            <p class="col-lg-8 mx-auto lead">
                {{ trans('sigac::about.Description') }}
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-3">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right" data-aos-duration="700">
                            <i class="fas fa-map-marked-alt fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.TitleCard1') }}</h4>
                            <p>{{ trans('sigac::about.TextCard1') }}<br>Campoalegre, Huila</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right">
                            <i class="far fa-clock fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.TextCard2') }}</h4>
                            <p>{{ trans('sigac::about.TextCard2') }}<br>08:00AM - 03:00PM</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right" data-aos-duration="700">
                            <i class="fas fa-phone fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.TitleCard3') }}</h4>
                            <p>{{ trans('sigac::about.TextCard') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right">
                            <i class="fas fa-envelope fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.TitleCard4') }}</h4>
                            <p>{{ trans('sigac::about.TextCard') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-left">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-user-lock fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.TitleCard1.1') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.TextCard1.1') }}</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-tachometer-alt fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.TitleCard2.2') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.TextCard2.2') }}</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-tachometer-alt fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.TitleCard3.3') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.TextCard3.3') }}</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-layer-group fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.TitleCard4.4') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.TextCard4.4') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                        
        </div>
    </div>
@endsection

@push('scripts')
@endpush
