@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hangarauto::Developers.developers') }}</li>
@endpush

@section('content')
    <div class="card card-blue card-outline shadow" style="border: 12px solid #37A4FF;">
        <div class="card-header text-center">
            <h5 class="m-3 text-uppercase display-6 font-weight-bold">{{ trans('hangarauto::developers.TitleCardDevelopers') }}</h5>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center mt-4">{{ trans('hangarauto::developers.TitleApprentice') }}</h3>
                <div class="card-body">
                    <div class="container text-center mx-auto">
                        <div class="row">
                            <div class="col-lg-6 mb-12 text-center mx-auto" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/HANGARAUTO/img/Davidr.png') }}"
                                    alt="aldana" width="150" height="180">
                                <h5>Andres David Cumaco Rojas</h5>
                                <p>{{ trans('hangarauto::developers.NameTechnologist') }}</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/david-cumaco-rojas-7020752b6/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/Davidjr16">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-success" href="#">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <br>
                    <div class="row">
                        <div class="col-sm-2 col-md-3">
                            <div class="card text-center" style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/laravel.png') }}"
                                            style="width: 200px; height: 100px;">
                                    </div>

                                    <a class="btn btn-success btn-block w-90" href="https://laravel.com/">
                                        <i class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            laravel</i>

                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="card text-center" style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/php.png') }}"
                                            style="width: 140px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-90" href="https://www.php.net/"><i
                                            class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            php</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/github.png') }}"
                                            style="width: 200px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://github.com/"><i
                                            class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            github</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/javascript.png') }}"
                                            style="width: 200px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100"
                                        href="https://developer.mozilla.org/es/docs/Web/JavaScript"><i
                                            class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            JavaScript</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/fonwasome.png') }}"
                                            style="width: 100px; height: 70px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://fontawesome.com/icons">
                                        <i class="fa-solid fa-circle-info" style="font-size: 13px; margin-right: 5px;">
                                            FontAwesome</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/boostrap.png') }}"
                                           style="width: 250px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://getbootstrap.com/">

                                        <i class="fa-solid fa-circle-info" style="font-size: 13px; margin-right: 5px;">
                                            bootstrap</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/sweetalert-logo.png') }}"
                                            style="width: 100px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://sweetalert2.github.io/"><i
                                            class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            SweetAlert2</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center"
                                style="height: 160px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/HANGARAUTO/img/herramientas/css.png') }}"
                                            style="width: 100px; height: 100px;">
                                    </div>
                                    <a class="btn btn-success btn-block w-100"
                                        href="https://developer.mozilla.org/es/docs/Web/CSS">

                                        <i class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;">
                                            CSS</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center"
                                    style="height: 160px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/HANGARAUTO/img/herramientas/jquery.png') }}"
                                                 style="width: 100px; height: 100px;">
                                        </div>
                                        <a class="btn btn-success btn-block w-100" href="https://jquery.com/"> <i
                                                class="fa-solid fa-circle-info"
                                                style="font-size: 12px; margin-right: 5px;"> Jquery</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center"
                                    style="height: 160px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/HANGARAUTO/img/herramientas/xammp.png') }}"
                                                 style="width: 100px; height: 100px;">
                                        </div>
                                        <a class="btn btn-success btn-block w-100"
                                            href="https://www.apachefriends.org/es/index.html"> <i class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;"> Xammp</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="card text-center"
                                    style="height: 160px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/HANGARAUTO/img/herramientas/google-fonts.png') }}"
                                                style="width: 120px; height: 90px;">
                                        </div>
                                        <a class="btn btn-success btn-block w-0"
                                            href="https://fonts.google.com/specimen/Quicksand?preview.text=Infinity%20Mellow&preview.text_type=custom&selection.family=Yellowtail&sidebar.open=true&query=quicksa"><i
                                                class="fa-solid fa-circle-info"
                                                style="font-size: 13px; margin-right: 5px;"> Google Fonts</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center"
                                    style="height: 160px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/HANGARAUTO/img/herramientas/visual.png') }}"
                                                style="width: 200px; height: 100px;">
                                        </div>
                                        <a class="btn btn-success btn-block w-100"
                                            href="https://code.visualstudio.com/"><i class="fa-solid fa-circle-info"
                                                style="font-size: 13px; margin-right: 5px;"> VSCode</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection