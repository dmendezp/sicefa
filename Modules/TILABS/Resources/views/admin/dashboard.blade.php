@extends('tilabs::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="jumbotron">
                        <h1 class="display-4">TI-LABS</h1>
                        <p class="lead">
                            {{ trans('tilabs::mainPage.Text_Welcome') }}
                        </p>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="fas fa-dolly-flatbed"></i>
                                            {{ trans('tilabs::mainPage.Title_Transfer_Requests') }}</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h4>0</h4>
                                                            <p>{{ trans('tilabs::mainPage.Text_Entry') }}</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-sign-in-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h4>0</h4>
                                                            <p>{{ trans('tilabs::mainPage.Text_Exit') }}</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-sign-out-alt"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="fas fa-clipboard-list"></i> {{ trans('tilabs::mainPage.Title_Registers') }}</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h4>6</h4>
                                                        <p>{{ trans('tilabs::mainPage.Laboratories') }}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-school"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h4>89</h4>
                                                        <p>{{ trans('tilabs::mainPage.Computers') }}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-laptop"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
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
                                            <div class="col-6">
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h4>2</h4>
                                                        <p>{{ trans('tilabs::mainPage.Overdue') }}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fas fa-hourglass-end"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <section id="hero">
                        <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('tilabs/images/devices.png') }}" class="img-fluid animated zoom"
                                alt="">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
