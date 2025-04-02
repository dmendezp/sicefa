@extends('sia::layouts.master')

@push('head')

@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sia::mainPage.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <h5 class="display-5">{{ trans('sia::mainPage.Title_General') }}</h5>
    <h5 data-aos="fade-down">{{ trans('sia::mainPage.Description_General') }}</h5>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-right">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h5 class="text-center">{{ trans('sia::mainPage.Title_Card_Projects') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Research') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Research.webp') }}" alt="ResearchImage"
                                    class="card-img-top" width="180px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Research') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Events') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Events.webp') }}" alt="EventsImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Events') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Resources') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Resources.webp') }}" alt="ResourcesImage"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Resources') }}</p>
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
                            <h3 class="featurette-heading">{{ trans('sia::mainPage.Title_Card_Advertising') }} <span
                                    class="text-muted">{{ trans('sia::mainPage.Title_Card_Advertising_pt2') }}</span></h3>
                            <p class="lead">{{ trans('sia::mainPage.Description_Advertising') }} </p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/sia/images/cardsIndex/Innovation.webp') }}" alt="InnovationImage"
                                class="img-fluid" width="290" height="290">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
