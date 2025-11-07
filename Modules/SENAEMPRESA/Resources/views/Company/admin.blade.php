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
                        <p class="lead">{{ trans('senaempresa::menu.Digital System for Comprehensive Human Resources Management.') }}</p>
                        <hr class="my-4">
                        <p class="card-text"> {{trans('senaempresa::menu.It is a didactic')}}</p>
                        <div class="d-flex justify-content-around">
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(36, 94, 171);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $registeredphasesCount }}</h3>
                                        <p>{{ trans('senaempresa::menu.SenaEmpresa Phases') }}</p>
                                    </div>

                                    <div class="icon">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index') }}"
                                        class="small-box-footer" style="text: white;">{{ trans('senaempresa::menu.More info') }}
                                        <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(122, 36, 171);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $postulatesCount }}</h3>
                                        <p>{{ trans('senaempresa::menu.Postulates') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index') }}"
                                        class="small-box-footer text-white">
                                        {{ trans('senaempresa::menu.More info') }} <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(171, 36, 57);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $totalPositionsCount }}</h3>
                                        <p>{{ trans('senaempresa::menu.Position') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-smile-beam"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.positions.index') }}"
                                        class="small-box-footer">{{ trans('senaempresa::menu.More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(241, 196, 15);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $registeredStaffCount }}</h3>
                                        <p>{{ trans('senaempresa::menu.Staff') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.index') }}"
                                        class="small-box-footer">{{ trans('senaempresa::menu.More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(26, 188, 156);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $prestamosPrestados }}</h3>
                                        <p>{{trans('senaempresa::menu.Loans')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-sign-language"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index') }}"
                                        class="small-box-footer">{{ trans('senaempresa::menu.More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col">
                                <!-- small box -->
                                <div class="small-box" style="background: rgb(39, 174, 96);">
                                    <div class="inner" style="color: white;">
                                        <h3>{{ $vacanciesCount }}</h3>
                                        <p>{{trans('senaempresa::menu.Vacant')}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-plane-arrival"></i>
                                    </div>
                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}"
                                        class="small-box-footer">{{ trans('senaempresa::menu.More info') }} <i class="fas fa-arrow-circle-right"></i></a>
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
