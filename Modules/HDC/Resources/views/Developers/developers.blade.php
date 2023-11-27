@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hdc::developers.developers') }}</li>
@endpush

@section('content')
    <div class="card card-green card-outline shadow" style="border: 12px solid #28a745;">
        <div class="card-header text-center">
            <h5 class="m-3 text-uppercase display-6 font-weight-bold">{{ trans('hdc::developers.TitleCardDevelopers') }}</h5>
        </div>
        <div class="row">
            <div class="col-md-4">

                <h3 class="text-center mt-4">{{ trans('hdc::developers.TitleApprentice') }}</h3>
                <div class="card-body">
                    <div class="container text-center mx-auto">
                        <div class="row">
                            <div class="col-lg-6 mb-12 text-center mx-auto" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/HDC/img/Mary.png') }}"
                                    alt="aldana" width="150" height="180">
                                <h5>Mary Luz Aldana Vidarte</h5>
                                <p>{{ trans('hdc::developers.NameTechnologist') }}</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/mary-luz-aldana-a0325226a/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/Aldana2005">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-success" href="">
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/laravel.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/php.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/github.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/javascript.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/fonwasome.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/boostrap.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/sweetalert-logo.png') }}"
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
                                        <img src="{{ asset('modules/HDC/img/herramientas/css.png') }}"
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
                                            <img src="{{ asset('modules/HDC/img/herramientas/jquery.png') }}"
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
                                            <img src="{{ asset('modules/HDC/img/herramientas/laragon.png') }}"
                                                 style="width: 100px; height: 100px;">
                                        </div>
                                        <a class="btn btn-success btn-block w-100"
                                            href="https://laragon.org/download/index.html"> <i class="fa-solid fa-circle-info" style="font-size: 12px; margin-right: 5px;"> Laragon</i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="card text-center"
                                    style="height: 160px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/HDC/img/herramientas/google-fonts.png') }}"
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
                                            <img src="{{ asset('modules/HDC/img/herramientas/visual.png') }}"
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































{{--   {{--   <div class="content">
        <div class="container-fluid">
            <div class="row  justify-content-md-center">
                <!-- /.col-md-6 -->
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('modules/HDC/img/Diego.png') }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Diego Andres Mendez Pastrana</h3>
                                <p class="text-muted text-center">Instructor - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('modules/HDC/img/Mary.png') }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Mary Luz Aldana Vidarte</h3>
                                <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('modules/HDC/img/David.png') }}"
                                alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">Andrés David Cumaco Rojas</h3>
                            <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                            </li>
                                <li class="list-group-item">
                                <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                            </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h5 class="m-0">{{ trans('hdc::developers.developers')}}</h5>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('modules/HDC/img/Sofia.png') }}"
                                    alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Leidy Sofia Osorio vera</h3>
                                <p class="text-muted text-center">Aprendiz - Tgo. Analisis y desarollo de software</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Facebook</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-facebook-f"></i></b></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>LinkedIn</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fab fa-linkedin-in"></i></b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <!-- /.col-md-6 -->
            </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-green card-outline shadow">
                            <div class="card-header">
                                <h3 class="card-title">
                                Créditos y reconocimientos
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <ul>
                                        <li>Plantilla AdminLTE de <a href="https://adminlte.io" title="AdminLTE" target="blank">adminlte.io/</a></li>
                                        <li>Iconos gratuitos de <a href="https://fontawesome.com/icons?d=gallery" title="Flaticon" target="blank"> fontawesome.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>

  --}}
