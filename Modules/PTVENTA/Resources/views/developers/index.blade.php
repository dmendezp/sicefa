@extends('ptventa::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link href="{{asset('libs/AOS-2.3.1/dist/aos.css')}}" rel="stylesheet">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">Desarrolladores y Créditos</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3 class="text-center mt-2">Desarrolladores</h3>
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-6 mb-4" data-aos="zoom-in">
                                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                    preserveaspectratio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#777" />
                                    <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                                </svg>
                                <h4>Aprendiz</h4>
                                <p>Jesús David Guevara Munar</p>
                                <a class="btn btn-primary" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-dark" href="#"><i class="fab fa-github"></i></a>
                                <a class="btn btn-info" href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="col-lg-6 mb-4" data-aos="zoom-in">
                                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                    preserveaspectratio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#777" />
                                    <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                                </svg>
                                <h4>Aprendiz</h4>
                                <p>Manuel Steven Ossa Lievano</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/manuel-steven-ossa-lievano-014b3b267/"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-dark" href="https://github.com/SrManuel-1"><i class="fab fa-github"></i></a>
                                <a class="btn btn-info" href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="col-lg-6 mb-4" data-aos="zoom-in">
                                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                    preserveaspectratio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#777" />
                                    <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                                </svg>
                                <h4>Aprendiz</h4>
                                <p>Nelsy Yulied Gomez Morales</p>
                                <a class="btn btn-primary" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-dark" href="#"><i class="fab fa-github"></i></a>
                                <a class="btn btn-info" href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="col-lg-6 mb-4" data-aos="zoom-in">
                                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140"
                                    preserveaspectratio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#777" />
                                    <text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                                </svg>
                                <h4>Aprendiz</h4>
                                <p>Anyi Katherine Rojas Arce</p>
                                <a class="btn btn-primary" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-dark" href="#"><i class="fab fa-github"></i></a>
                                <a class="btn btn-info" href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <a class="btn" id="scrollButton"><h5>Ver los créditos</h5> <i class="fas fa-chevron-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" data-aos="zoom-in-up">
                <div class="container">
                    <h3 class="text-center mt-2">Créditos</h3>
                    <div class="row">
                        <div class="col-sm-6 col-md-3" >
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between" >
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/Laravel.png') }}" alt="" class="img-fluid w-100" style="max-height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Laravel v9.x</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://laravel.com/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"  style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/PHP.png') }}" alt="" style="width: 100; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>PHP</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://www.php.net/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/Datatables_logo_square.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Datatables</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://datatables.net/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/adminLTE3.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>AdminLTE3</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://adminlte.io/">Más Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/fontawesome.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>FontAwesome v.5.15.4</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://fontawesome.com/icons">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/googlefonts.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Google Fonts - Quicksand</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://fonts.google.com/specimen/Quicksand?preview.text=Infinity%20Mellow&preview.text_type=custom&selection.family=Yellowtail&sidebar.open=true&query=quicksa">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/descarga.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Pixabay</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://pixabay.com/es/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/sweetalert2.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>SweetAlert2</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://sweetalert2.github.io/">Más Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/JavaScript-logo.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Javascript</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://developer.mozilla.org/es/docs/Web/JavaScript">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/jquery.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Jquery</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://jquery.com/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/CSS3_logopng.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>CSS3</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://developer.mozilla.org/es/docs/Web/CSS">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/Bootstrap_logo.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Bootstrap v5.3</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://getbootstrap.com/">Más Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/codepen.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Codepen</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://codepen.io/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/livewire.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Livewire</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://laravel-livewire.com/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/laravelcollective.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Laravel Collective</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://laravelcollective.com/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/uiverse.jpg') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>UI Verse</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://uiverse.io/">Más Info</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/xammp.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Xampp</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://www.apachefriends.org/es/index.html">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/sqlyog.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>SQLyog</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://webyog.com/product/sqlyog/">Más Info</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/ptventa/images/sponsor/logotipo-de-github.png') }}" alt="" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Git Hub</h6>
                                    </div>
                                    <a class="btn btn-success btn-block w-100" href="https://github.com/">Más Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("scrollButton").addEventListener("click", function() {
            var scrollHeight = 500; // Altura de desplazamiento deseada (ajusta este valor según tus necesidades)
            window.scrollTo({
                top: scrollHeight,
                behavior: "smooth"
            });
        });
    </script>
    <script src="{{asset('libs/AOS-2.3.1/dist/aos.js')}}"></script>
    <script>
        AOS.init();
    </script>
@endpush
