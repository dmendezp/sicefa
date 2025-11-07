@extends('cafeto::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('cafeto::devs.Breadcrumb_Active_Devs') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3 class="text-center mt-2">{{ trans('cafeto::devs.Title_Developers') }}</h3>
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/cafeto/images/developers/JDGM0331-Profile.webp') }}" alt="JDGM0331" width="140" height="140">
                                <h4>{{ trans('cafeto::devs.Description_Apprentice') }}</h4>
                                <p>Jesús David Guevara Munar</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/jdgm0331/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/JDGM0331">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-primary" href="https://www.facebook.com/JDGM0331">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/cafeto/images/developers/SrManuel-1-Profile.webp') }}" alt="Sr-Manuel-1" width="140" height="140">
                                <h4>{{ trans('cafeto::devs.Description_Apprentice') }}</h4>
                                <p>Manuel Steven Ossa Lievano</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/manuel-steven-ossa-lievano-014b3b267/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/SrManuel-1">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-info custom-instagram-btn" href="https://www.instagram.com/st._.manuel07/">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/cafeto/images/developers/Nelsy-Profile.webp') }}" alt="Nelsy" width="140" height="140">
                                <h4>{{ trans('cafeto::devs.Description_Apprentice') }}</h4>
                                <p>Nelsy Yulied Gomez Morales</p>
                                <a class="btn btn-primary" href="www.linkedin.com/in/nelsy-yulied-gomez-morales-5b1b37267">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/nelsygomez11">
                                    <i class="fab fa-github"></i>
                                </a>
                                
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/cafeto/images/developers/ANYI-Profile.webp') }}" alt="AnyiProfile" width="140" height="140">
                                <h4>{{ trans('cafeto::devs.Description_Apprentice') }}</h4>
                                <p>Anyi Katherine Rojas Arce</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/anyi-rojas-25a003268/">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/anyi-rojas">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a class="btn btn-info custom-twitter-btn" href="https://twitter.com/AnyiRojas0">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <a class="btn" id="scrollButton">
                            <h5>{{ trans('cafeto::devs.View credits') }}</h5>
                            <i class="fas fa-chevron-down animated-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4" data-aos="zoom-in-up">
                <div class="container">
                    <h3 class="text-center mt-2">{{ trans('cafeto::devs.Credits') }}</h3>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500" style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/laravel.webp') }}" alt="Laravel-logo" class="img-fluid w-100" style="max-height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Laravel v9.x</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://laravel.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/php.webp') }}" alt="PHP-logo"
                                            style="width: 100; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>PHP</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://www.php.net/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/datatables_logo.webp') }}"
                                            alt="Datatables-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Datatables</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://datatables.net/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/adminLTE3.webp') }}"
                                            alt="AdminLTE-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>AdminLTE3</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://adminlte.io/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/fontawesome.webp') }}"
                                            alt="Fontawesome-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>FontAwesome v.5.15.4</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://fontawesome.com/icons">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/googlefonts.webp') }}"
                                            alt="GoogleFonts-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Google Fonts - Quicksand</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://fonts.google.com/specimen/Quicksand?preview.text=Infinity%20Mellow&preview.text_type=custom&selection.family=Yellowtail&sidebar.open=true&query=quicksa">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/pixabay.webp') }}"
                                            alt="Pixabay-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Pixabay</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://pixabay.com/es/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/sweetalert2.webp') }}"
                                            alt="Sweetalert2-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>SweetAlert2</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://sweetalert2.github.io/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/javascript_logo.webp') }}"
                                            alt="Javascript-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Javascript</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://developer.mozilla.org/es/docs/Web/JavaScript">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/jquery.webp') }}"
                                            alt="Jquery-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Jquery</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://jquery.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/css3_logo.webp') }}"
                                            alt="CSS3-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>CSS3</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://developer.mozilla.org/es/docs/Web/CSS">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/bootstrap_logo.webp') }}"
                                            alt="Bootstrap-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Bootstrap v5.3</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://getbootstrap.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/toastr-js.webp') }}"
                                            alt="Toastr-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Toastr-Js</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://codeseven.github.io/toastr/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/livewire.webp') }}"
                                            alt="Livewire-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Livewire</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://laravel-livewire.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="700"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/laravelcollective.webp') }}"
                                            alt="LaravelCollective-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Laravel Collective</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://laravelcollective.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/Visual_Studio_Code.webp') }}"
                                            alt="VSCode-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>VSCode</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://code.visualstudio.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="500"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/xampp.webp') }}"
                                            alt="XAMPP-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Xampp</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://www.apachefriends.org/es/index.html">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="600"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/sqlyog.webp') }}"
                                            alt="SQLYOG-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>SQLyog</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://webyog.com/product/sqlyog/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/github_logotipo.webp') }}"
                                            alt="GitHub-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Git Hub</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://github.com/">{{ trans('cafeto::devs.More Info') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <div class="card text-center" data-aos="zoom-in-up" data-aos-duration="800"
                                style="height: 200px;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div class="align-self-center">
                                        <img src="{{ asset('modules/cafeto/images/sponsor/cleavejs_logo.webp') }}"
                                            alt="Cleave.js-logo" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="text-truncate" style="max-height: 40px;">
                                        <h6>Cleave.js</h6>
                                    </div>
                                    <a class="btn btn-dark btn-block w-100"
                                        href="https://nosir.github.io/cleave.js/">{{ trans('cafeto::devs.More Info') }}</a>
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
@endpush
