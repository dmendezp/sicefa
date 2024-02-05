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
                        <p class="card-text">{{trans('senaempresa::menu.It is a didactic')}}</p>
                        <div class="row">
                            <div class="col-4">
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
                            <div class="col-4">
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
