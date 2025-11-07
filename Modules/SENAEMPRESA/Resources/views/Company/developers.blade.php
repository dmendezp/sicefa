@extends('senaempresa::layouts.master')
@section('stylesheet')
    <link href="{{ asset('modules/senaempresa/css/contact.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid px-5 py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h1 class="text-center">
                    <strong><em><span>{{ $title }}</span></em></strong>
                </h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card text-center rounded-0 border-0" id="card1">
                    <div class="hex-img mt-5 mb-4">
                        <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="img1" patternUnits="userSpaceOnUse" width="100" height="100">
                                    <image xlink:href="{{ asset('modules/senaempresa/images/Contacto/Medina.jpg') }}"
                                        x="-25" width="150" height="100" />
                                </pattern>
                            </defs>
                            <circle cx="50" cy="50" r="49" fill="url(#img1)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Junior Stiven Medina Hernandez</h2>
                    <p class="position">{{ trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development') }}
                    </p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">
                        <div class="col-3 px-0 py-1">
                            <a href="https://www.facebook.com/stiven.medina.56614/?locale=es_LA">
                                <div class="py-3 fab fa-facebook"></div>
                            </a>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <a href="https://github.com/Junior6580">
                                <div class="py-3 fab fa-github"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card text-center rounded-0 border-0" id="card2">
                    <div class="hex-img mt-5 mb-4">
                        <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="img2" patternUnits="userSpaceOnUse" width="100" height="100">
                                    <image xlink:href="{{ asset('modules/senaempresa/images/Contacto/Marin.jpg') }}" x="-25"
                                        width="150" height="100" />
                                </pattern>
                            </defs>
                            <circle cx="50" cy="50" r="49" fill="url(#img2)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Jennifer Marin Montealegre</h2>
                    <p class="position">{{ trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development') }}
                    </p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">
                        <div class="col-3 px-0 py-1">
                            <a href="https://www.facebook.com/jennyfer.marin.5473?locale=es_LA">
                                <div class="py-3 fab fa-facebook"></div>
                            </a>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <a href="https://github.com/Jennyferm05">
                                <div class="py-3 fab fa-github"></div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-4">
                <div class="card text-center rounded-0 border-0" id="card3">
                    <div class="hex-img mt-5 mb-4">
                        <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="img3" patternUnits="userSpaceOnUse" width="100" height="100">
                                    <image xlink:href="{{ asset('modules/senaempresa/images/Contacto/Penagos.jpg') }}"
                                        x="-25" width="150" height="100" />
                                </pattern>
                            </defs>
                            <circle cx="50" cy="50" r="49"  fill="url(#img3)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Diego Alejandro Penagos Ninco</h2>
                    <p class="position">{{ trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development') }}
                    </p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">
                        <div class="col-3 px-0 py-1">
                            <a href="https://www.facebook.com/profile.php?id=100008824414757&locale=es_LA">
                                <div class="py-3 fab fa-facebook"></div>
                            </a>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <a href="https://github.com/diego222709">
                                <div class="py-3 fab fa-github"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="container">
                        <h1 class="text-center">
                            <strong><em><span>Créditos y reconocimientos</span></em></strong>
                        </h1>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/laravel.webp') }}"
                                                alt="Laravel-logo" class="img-fluid w-100" style="max-height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>Laravel</h6>
                                        </div>
                                        <a class="btn  btn-block w-100" href="https://laravel.com/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/php.webp') }}"
                                                alt="PHP-logo" class="img-fluid w-100" style="max-height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>PHP</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://www.php.net/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/datatables_logo.webp') }}"
                                                alt="Datatables-logo" class="img-fluid w-100" style="max-height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>Datatables</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://datatables.net/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/adminlte3.webp') }}"
                                                alt="Datatables-logo" class="img-fluid w-100" style="max-height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>AdminLTE3</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://datatables.net/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/fontawesome.webp') }}"
                                                alt="Fontawesome-logo" style="width: 100px; height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>FontAwesome</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://fontawesome.com/icons">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/sweetalert2.webp') }}"
                                                alt="Sweetalert2-logo" style="width: 100px; height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>SweetAlert2</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://sweetalert2.github.io/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/bootstrap_logo.webp') }}"
                                                alt="VSCode-logo" style="width: 100px; height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>Bootstrap</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://getbootstrap.com/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card text-center" style="height: 200px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div class="align-self-center">
                                            <img src="{{ asset('modules/senaempresa/images/Contacto/github_logotipo.webp') }}"
                                                alt="GitHub-logo" style="width: 100px; height: 100px;">
                                        </div>
                                        <div class="text-truncate" style="max-height: 40px;">
                                            <h6>Git Hub</h6>
                                        </div>
                                        <a class="btn btn-block w-100" href="https://github.com/">Más
                                            Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
