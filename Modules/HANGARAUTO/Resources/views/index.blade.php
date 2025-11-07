@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::general.Indicator_Homepage') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">{{ trans('hangarauto::general.title1') }}</h2>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h3>{{ trans('hangarauto::general.title2') }}</h3>
                    <p>{{ trans('hangarauto::general.text1') }}</p>
                    <br><br><br>
                    <h3>{{ trans('hangarauto::general.title3') }}</h3>
                    <p>{{ trans('hangarauto::general.text2') }}</p>
                </div>
                <div class="col-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('modules/HANGARAUTO/img/roseador.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HANGARAUTO/img/tractor.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HANGARAUTO/img/rastrilladora.jpg') }}" class="d-block w-100" alt="...">
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
    </div>
@endsection
