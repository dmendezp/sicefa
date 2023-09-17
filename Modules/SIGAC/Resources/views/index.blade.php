@extends('sigac::layouts.master')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('modules/sigac/css/infoCardStyles.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12">
            <h1 class="hmax h-lg-max h-md-max h-sm-max h-xs-max">{{ trans('sigac::index.Title') }}</h1>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>300</h4>
                                <p>Aprendices Actuales</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>10<sup style="font-size: 20px">%</sup></h4>
                                <p>Tecnológo en Etapa Práctica</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>44</h4>
                                <p>Tecnológo Etapa Lectiva</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>65</h4>
                                <p>Instructores de Planta</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>65</h4>
                                <p>Instructores de Contrato</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="d-flex flex-wrap justify-content-around gap-1">
                    <div class="card col-md-4 col-12 text-center mb-4 shadow-lg border-0" style="width: 16rem;"
                        data-aos="fade-up" data-aos-duration="1000">
                        <img src="{{ asset('modules/sigac/images/burbuja-de-dialogo.gif') }}"
                            class="card-img-top custom-img align-self-center" alt="...">
                        <div class="card-body">
                            <h5>{{ trans('sigac::index.CardTitle1') }}</h5>
                            <p class="card-text">{{ trans('sigac::index.CardDescription1') }}</p>
                        </div>
                    </div>

                    <div class="card col-md-4 col-12 text-center mb-4 shadow-lg border-0" style="width: 16rem;"
                        data-aos="fade-up" data-aos-duration="2000">
                        <img src="{{ asset('modules/sigac/images/libros.gif') }}"
                            class="card-img-top custom-img align-self-center" alt="...">
                        <div class="card-body">
                            <h5>{{ trans('sigac::index.CardTitle2') }}</h5>
                            <p class="card-text">{{ trans('sigac::index.CardDescription2') }}</p>
                        </div>
                    </div>

                    <div class="card col-md-4 col-12 text-center mb-4 shadow-lg border-0" style="width: 16rem;"
                        data-aos="fade-up" data-aos-duration="3000">
                        <img src="{{ asset('modules/sigac/images/buscar.gif') }}"
                            class="card-img-top custom-img align-self-center" alt="...">
                        <div class="card-body">
                            <h5>{{ trans('sigac::index.CardTitle3') }}</h5>
                            <p class="card-text">{{ trans('sigac::index.CardDescription3') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
