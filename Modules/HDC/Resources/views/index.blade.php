@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::hdcgeneral.li1')}}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
    <h2 class="text-center">{{ trans('hdc::hdcgeneral.title1') }}</h2>
            <h4 class="text-center">{{( trans('hdc::hdcgeneral.caption1'))}}</h4>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h3>{{ trans('hdc::hdcgeneral.title2') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text1' )}}</p>
                    <br><br><br>
                    <h3>{{ trans('hdc::hdcgeneral.title3') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text2') }}</p>
                </div>
                <div class="col-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/fish.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/plants.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/ganado.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{ trans('hdc::hdcgeneral.title4') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{ trans('hdc::hdcgeneral.title5') }}</h3>
                    <p>{{ trans('hdc::hdcgeneral.text3') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection