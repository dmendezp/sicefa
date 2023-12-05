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
                            <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#img1)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Junior Stiven Medina Hernandez</h2>
                    <p class="position">{{trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development')}}</p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">

                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-facebook"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-twitter"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-linkedin"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-pinterest"></div>
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
                            <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#img2)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Jennifer Marin Montealegre</h2>
                    <p class="position">{{trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development')}}</p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-facebook"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-twitter"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-linkedin"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-pinterest"></div>
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
                            <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" fill="url(#img3)" />
                        </svg>
                    </div>
                    <h2 class="card-name">Diego Alejandro Penagos Ninco</h2>
                    <p class="position">{{trans('senaempresa::menu.Apprentice - Tgo. Software Analysis & Development')}}</p>
                    <div class="row mx-5 mb-5 mt-3 justify-content-center">
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-facebook"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-twitter"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-linkedin"></div>
                        </div>
                        <div class="col-3 px-0 py-1">
                            <div class="py-3 fab fa-pinterest"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">
                            Créditos y reconocimientos
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <ul>
                                <li>Plantilla AdminLTE de <a href="https://adminlte.io" title="AdminLTE"
                                        target="blank">adminlte.io/</a></li>
                                <li>Iconos gratuitos de <a href="https://fontawesome.com/icons?d=gallery" title="Flaticon"
                                        target="blank"> fontawesome.com</a></li>
                            </ul>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
