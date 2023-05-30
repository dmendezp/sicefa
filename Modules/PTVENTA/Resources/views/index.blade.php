@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::mainPage.Main page')}}</li>
@endpush

@section('content')
    <h1 class="display-3">{{ trans('ptventa::mainPage.Welcome to point of sale')}}</h1>
    <p data-aos="fade-down">{{ trans('ptventa::mainPage.Point of sale is a productive unit belonging to the Agroindustrial Training Center "La Angostura", here are offered the different products that are manufactured in this center, we have products that come directly from the field as well as those that are processed in the agribusiness sector.')}}</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-up" data-aos-duration="3000">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h4 class="text-center">{{ trans('ptventa::mainPage.Most popular products from the training center')}}</h4>
                            <p>{{ trans('ptventa::mainPage.News of the moment:')}}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.Fruits')}}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card6.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.Pinneapple')}}</p>>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.Milk products')}}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card3.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.Yogurt')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.Vegetables')}}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card4.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.Lettuce')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-up" data-aos-duration="3000">
                <div class="card-body">
                    <hr class="featurette-divider">
                    <div class="row featurette align-items-center">
                        <div class="col-md-7 order-md-2">
                            <h2 class="featurette-heading">{{ trans('ptventa::mainPage.Oh, yes, it is so good.')}} <span class="text-muted">{{ trans('ptventa::mainPage.See for yourself.')}}</span></h2>
                            <p class="lead">{{ trans('ptventa::mainPage.Taste some delicious Croissant, made by the best hands of the apprentices of the training center the best hands of the apprentices of the training center, i.e. of the technologists who work in the agro-industrial complex.')}} </p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/ptventa/images/Card5.jpg') }}" alt="" class="img-fluid"
                                width="300" height="300">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
@endpush
