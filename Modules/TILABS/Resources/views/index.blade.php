@extends('tilabs::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <h1 class="display-4">{{ trans('tilabs::mainPage.Title_Welcome') }}</h1>
                        <p class="lead">{{ trans('tilabs::mainPage.Text_Welcome') }}</p>
                        <hr class="my-4">
                        <p>{{ trans('tilabs::mainPage.Description') }}</p>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>6</h4>
                                <p>{{ trans('tilabs::mainPage.Laboratories') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-school"></i>
                            </div>
                        </div>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>89</h4>
                                <p>{{ trans('tilabs::mainPage.Computers') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                        </div>
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>30</h4>
                                <p>{{ trans('tilabs::mainPage.Loans') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-share"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <section id="hero">
                        <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('modules/tilabs/images/devices.png') }}" class="img-fluid animated zoom" alt="">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
