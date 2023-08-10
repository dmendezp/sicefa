@extends('sigac::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12">
            <h1>{{ trans('sigac::index.Title') }}</h1>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-lightblue">
                            <div class="inner">
                                <h4>65</h4>
                                <p>Instructores de Contrato</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h4>300</h4>
                                <p>Aprendices Actuales</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-olive">
                            <div class="inner">
                                <h4>44</h4>
                                <p>Tecnológo Etapa Lectiva</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>10</h4>
                                <p>Tecnológos en Etapa Práctica</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-person-walking-luggage"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="1000">
                            <div class="card-body">
                                <img src="{{ asset('modules/sigac/images/burbuja-de-dialogo.gif') }}"
                                    class="card-img-top custom-img align-self-center" alt="...">
                                <div class="card-body">
                                    <h6>{{ trans('sigac::index.CardTitle1') }}</h6>
                                    <span class="card-text">{{ trans('sigac::index.CardDescription1') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="2000">
                            <div class="card-body">
                                <img src="{{ asset('modules/sigac/images/libros.gif') }}"
                                    class="card-img-top custom-img align-self-center" alt="...">
                                <div class="card-body">
                                    <h6>{{ trans('sigac::index.CardTitle2') }}</h6>
                                    <span class="card-text">{{ trans('sigac::index.CardDescription2') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-lg border-0" data-aos="fade-up" data-aos-duration="3000">
                            <div class="card-body">
                                <img src="{{ asset('modules/sigac/images/buscar.gif') }}"
                                    class="card-img-top custom-img align-self-center" alt="...">
                                <div class="card-body">
                                    <h6>{{ trans('sigac::index.CardTitle3') }}</h6>
                                    <span class="card-text">{{ trans('sigac::index.CardDescription3') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
