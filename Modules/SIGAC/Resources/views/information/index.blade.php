@extends('sigac::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sigac::about.Breadcrumb_Active_About') }}</li>
@endpush

@section('content')
    <div class="p-3 text-center bg-body-tertiary">
        <div class="container" data-aos="zoom-in">
            <p class="col-lg-8 mx-auto lead">
                {{ trans('sigac::about.General_Description') }}
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
                            <h4>{{ trans('sigac::about.Card_Title_Find') }}</h4>
                            <p>{{ trans('sigac::about.Card_Text_Find') }}<br>Campoalegre, Huila</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right">
                            <i class="fa-solid fa-share-nodes fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.Card_Title_Social_Media') }}</h4>
                            <div class="social-links">
                                <a href="https://bienestaraprendiceslaangostura.blogspot.com/" target="_blank"
                                    style="text-decoration: none;">
                                    <div id="blog" class="social-btn flex-center">
                                        <i class="fab fa-blogger"></i><span>Blog</span>
                                    </div>
                                </a>

                                <a href="https://www.facebook.com/p/SENA-Empresa-La-Angostura-100080230447627/"
                                    target="_blank" style="text-decoration: none;">
                                    <div id="facebook" class="social-btn flex-center">
                                        <i class="fab fa-facebook"></i><span>Facebook</span>
                                    </div>
                                </a>

                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div id="instagram" class="social-btn flex-center">
                                        <i class="fab fa-instagram"></i><span>Instagram</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right" data-aos-duration="700">
                            <i class="fas fa-phone fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.Card_Title_Contact') }}</h4>
                            <p>{{ trans('sigac::about.Card_Text_Soon') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card bg-info text-center" data-aos="fade-right">
                            <i class="fas fa-envelope fa-2x mb-3"></i>
                            <h4>{{ trans('sigac::about.Card_Title_Email') }}</h4>
                            <p>{{ trans('sigac::about.Card_Text_Soon') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-left">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div
                                class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-user-lock fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.Card_Title_Security') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.Card_Text_Security') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div
                                class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-tachometer-alt fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.Card_Title_Efficiently') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.Card_Text_Efficiently') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div
                                class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-tachometer-alt fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.Card_Title_Desing') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.Card_Text_Desing') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex align-items-start gap-2">
                        <div class="feature-card rounded-1 p-3 bg-white text-center">
                            <div
                                class="feature-icon-small d-inline-flex align-items-center justify-content-center text-info">
                                <i class="fas fa-layer-group fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-semibold mb-0">{{ trans('sigac::about.Card_Title_Organized') }}</h4>
                                <p class="text-secondary">{{ trans('sigac::about.Card_Text_Organized') }}</p>
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
