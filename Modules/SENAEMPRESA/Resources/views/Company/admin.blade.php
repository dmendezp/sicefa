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
                        <div class="d-flex justify-content-around">
                            <div class="col 2">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $registeredStaffCount }}</h3>
                                        <p>Personal</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.admin.staff.index') }}" class="small-box-footer">More
                                        info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col 2">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $totalPositionsCount }}</h3>
                                        <p>Cargos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-smile-beam"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.admin.positions.index') }}" class="small-box-footer">More
                                        info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col 2">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $registeredphasesCount }}</h3>
                                    <p>Fases SenaEmpresa</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <a href="{{ route('senaempresa.admin.phases.index') }}" class="small-box-footer">More info
                                    <i class="fas fa-arrow-circle-right"></i></a>
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
