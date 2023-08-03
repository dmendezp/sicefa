@extends('ptventa::layouts.master')

@push('head')

@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('ptventa::mainPage.Main page') }}</li>
@endpush

@section('content')
    <h5 class="display-5">{{ trans('ptventa::mainPage.Title') }}</h5>
    <h5 data-aos="fade-down">{{ trans('ptventa::mainPage.Description') }}</h5>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-right">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h5 class="text-center">{{ trans('ptventa::mainPage.TitleCard') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.TitleItem1') }}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/cardsIndex/Yogurt.webp') }}" alt="YogurtImage"
                                    class="card-img-top" width="180px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.NameItem1') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.TitleItem2') }}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/cardsIndex/Lettuce.webp') }}" alt="LettuceImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.NameItem2') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('ptventa::mainPage.TitleItem3') }}</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/cardsIndex/Pineapple.webp') }}" alt="PineappleImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('ptventa::mainPage.NameItem3') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-left">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-7 order-md-2">
                            <h3 class="featurette-heading">{{ trans('ptventa::mainPage.TitleCard2') }} <span
                                    class="text-muted">{{ trans('ptventa::mainPage.SubtitleCard2') }}</span></h3>
                            <p class="lead">{{ trans('ptventa::mainPage.DescriptionCard2') }} </p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/ptventa/images/cardsIndex/Croissant.webp') }}" alt="CroissantImage"
                                class="img-fluid" width="290" height="290">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
