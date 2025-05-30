@php
    use Modules\SIA\Entities\ApprenticeResearcher;
@endphp

@extends('sia::layouts.master')

@push('head')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Revolution Slider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/revslider/5.4.8/css/settings.min.css">
    <style>
        .custom-section {
            background-color: #f8f9fa;
            padding: 40px 0;
            text-align: center;
        }
        .custom-section h2 {
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .custom-section p {
            color: #34495e;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .custom-section .highlight {
            color: #e74c3c;
            font-style: italic;
        }
    </style>
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('sia::mainPage.Breadcrumb_Active_Main') }}</li>
@endpush

@section('content')
    <!-- Carrusel integrado -->
    <section id="slider" class="slider slide-overlay-dark">
        <div class="rev_slider_wrapper">
            <div id="slider1" class="rev_slider" data-version="5.0">
                <ul>
                    <!-- Slide 1 -->
                    <li data-transition="zoomin" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <img src="{{ asset('modules/sia/images/index/research.webp') }}" alt="Investigación"
                            width="1920" height="1280" />
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="slide--subheadline">{{ trans('sia::mainPage.TitleWelcomeApp') }}</div>
                        </div>
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="slide--headline">{{ trans('sia::mainPage.TitleWelcome') }}</div>
                        </div>
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                            data-width="none" data-height="none" data-whitespace="nowrap"
                            data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:bottom;rX:-20deg;rY:-20deg;rZ:0deg;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="slide-action">
                                <a class="btn btn--white btn--bordered btn--rounded btn--lg" href="#research-section"
                                    id="scroll-to-section">{{ trans('sia::mainPage.ViewProjects') }}</a>
                            </div>
                        </div>
                    </li>
                    <!-- Slide 2 -->
                    <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <img src="{{ asset('modules/sia/images/index/innovation.webp') }}" alt="Innovación"
                            width="1920" height="1280" />
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="slide--subheadline">{{ trans('sia::mainPage.TitleInfoS2') }}</div>
                        </div>
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="slide--headline extend">
                                {{ trans('sia::mainPage.TextInfoS2') }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Fin del carrusel -->

    <h5 class="display-5">{{ trans('sia::mainPage.Title_General') }}</h5>
    <h5 data-aos="fade-down">{{ trans('sia::mainPage.Description_General') }}</h5>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-right">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h5 class="text-center">{{ trans('sia::mainPage.Title_Card_Projects') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Research') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Research.webp') }}" alt="Investigación"
                                    class="card-img-top" width="180px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Research') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Events') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Events.webp') }}" alt="Eventos"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Events') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">{{ trans('sia::mainPage.T_Item_Resources') }}</h5>
                            <div class="card-projects mx-auto">
                                <img src="{{ asset('modules/sia/images/cardsIndex/Resources.webp') }}" alt="Recursos"
                                    class="card-img-top" width="140px" height="260px">
                                <div class="card-body">
                                    <p class="card-text head">{{ trans('sia::mainPage.T_Name_Resources') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm" data-aos="fade-left">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-7 order-md-2">
                            <h3 class="featurette-heading">{{ trans('sia::mainPage.Title_Card_Advertising') }} <span
                                    class="text-muted">{{ trans('sia::mainPage.Title_Card_Advertising_pt2') }}</span></h3>
                            <p class="lead">{{ trans('sia::mainPage.Description_Advertising') }}</p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/sia/images/cardsIndex/Innovation.webp') }}" alt="Innovación"
                                class="img-fluid" width="290" height="290">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nueva sección centrada con colores -->
    <section class="custom-section">
        <h2>Investigación</h2>
        <h2 style="color: #3498db;">Bienvenido a S.I.A.</h2>
        <p>Descubre Nuestra Plataforma de Investigación</p>
        <h2 style="color: #e67e22;">Innovación</h2>
        <p style="color: #16a085;">Innava con Nosotros</p>
        <p>Únete a nuestra comunidad de investigadores e innovadores.</p>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3 class="text-center mt-2">{{ trans('sia::mainPage.Title_Developers') }}</h3>
                <div class="card-body">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer1.webp') }}" alt="Desarrollador 1" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
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
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer2.webp') }}" alt="Desarrollador 2" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
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
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer3.webp') }}" alt="Desarrollador 3" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
                                <p>Nelsy Yulied Gomez Morales</p>
                                <a class="btn btn-primary" href="https://www.linkedin.com/in/nelsy-yulied-gomez-morales-5b1b37267">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="btn btn-dark" href="https://github.com/nelsygomez11">
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                <img class="bd-placeholder-img rounded-circle" src="{{ asset('modules/sia/images/developers/Developer4.webp') }}" alt="Desarrollador 4" width="140" height="140">
                                <h4>{{ trans('sia::mainPage.Description_Apprentice') }}</h4>
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
                            <h5>{{ trans('sia::mainPage.View_Credits') }}</h5>
                            <i class="fas fa-chevron-down animated-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Revolution Slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/revslider/5.4.8/js/jquery.themepunch.tools.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/revslider/5.4.8/js/jquery.themepunch.revolution.min.js"></script>
    <!-- Animación de scroll -->
    <script>
        $(document).ready(function() {
            $("#slider1").revolution({
                sliderType: "standard",
                sliderLayout: "auto",
                delay: 5000,
                navigation: {
                    arrows: { enable: true }
                },
                gridwidth: 1230,
                gridheight: 720
            });

            $("#scroll-to-section").click(function() {
                $("html, body").animate({
                    scrollTop: $("#research-section").offset().top
                }, 1000);
                return false;
            });
        });
    </script>
@endpush