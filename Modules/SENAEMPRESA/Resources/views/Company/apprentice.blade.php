@extends('senaempresa::layouts.master')
@section('stylesheet')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <h1 class="display-4">SENAEMPRESA</h1>
                        <p class="lead">Sistema Digital de Gestión Integral de Recursos Humanos.</p>
                        <hr class="my-4">
                        <p class="card-text">Es un modelo didáctico de empresa, que busca impartir y trasmitir a el aprendiz
                            los conocimientos administrativos, productivos, técnicos, financieros, ambientales, y de
                            comercialización adquiridos en el proceso de formación por medio del manejo real de una empresa
                            en las diferentes áreas y unidades productivas.</p>
                        <div class="row">
                            <div class="col-4">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(39, 174, 96);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $vacanciesCount }}</h3>
                                        <p>Vacantes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-plane-arrival"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}"
                                        class="small-box-footer">More
                                        info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <section id="hero">
                        <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('AdminLTE/dist/img/logo P SENA.png') }}" class="img-fluid animated zoom"
                                alt="">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
