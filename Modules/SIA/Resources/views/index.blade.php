@php

@endphp

@extends('sia::layouts.mainPage.master-mainPage')

@push('head')
@endpush
<style>
    .blog-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.1);
    }

    .blog-card-img img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .blog-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-card-title {
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
    }

    .blog-card-description {
        flex: 1;
        font-size: 0.95rem;
        color: #555;
        margin-bottom: 10px;
    }

    .blog-card-date {
        font-size: 0.8rem;
        color: #999;
        margin-bottom: 10px;
    }

    .btn-outline-primary {
        border-radius: 50px;
        font-size: 0.9rem;
    }
</style>
@section('content')
    <!-- Hero Section -->
    <section id="slider" class="slider slide-overlay-dark">
        <!-- START REVOLUTION SLIDER 5.0 -->
        <div class="rev_slider_wrapper">
            <div id="slider1" class="rev_slider" data-version="5.0">
                <ul>
                    <!-- slide 1 -->
                    <li data-transition="zoomin" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE Imagen de Negative-Space en Pixabay -->
                        <img src="{{ asset('modules/sia/images/index/1.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('sia::mainPage.TitleWelcomeApp') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ trans('sia::mainPage.TitleWelcome') }}</div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                        </div>

                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                            data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                            data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power3.easeOut;"
                            data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                            data-transform_out="y:[175%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                            data-mask_out="x:inherit;y:inherit;" data-start="1250" data-splitin="none" data-splitout="none"
                            data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:bottom;rX:-20deg;rY:-20deg;rZ:0deg;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-basealign="slide" data-responsive_offset="on" data-responsive="off">
                            <div class="slide-action">
                                <a class="btn btn--white btn--bordered btn--rounded btn--lg" href="#espresso-section"
                                    id="scroll-to-section">{{ trans('sia::mainPage.ViewProducts') }}</a>
                            </div>
                        </div>
                    </li>

                    <!-- slide 2 -->
                    <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                        <img src="{{ asset('modules/sia/images/index/2.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('sia::mainPage.TitleInfoS2') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline extend">
                                {{ trans('sia::mainPage.TextInfoS2') }}
                            </div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ trans('sia::mainPage.DescriptionS21') }}<br>
                                {{ trans('sia::mainPage.DescriptionS22') }}<br>
                                {{ trans('sia::mainPage.DescriptionS23') }}
                            </div>
                        </div>
                    </li>

                    <!-- slide 3 -->
                    <li data-transition="zoomout" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                        <img src="{{ asset('modules/sia/images/index/3.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('sia::mainPage.TitleInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ trans('sia::mainPage.TextInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ trans('sia::mainPage.DescriptionS31') }} <br>
                                {{ trans('sia::mainPage.DescriptionS32') }} <br>
                                {{ trans('sia::mainPage.DescriptionS33') }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- END REVOLUTION SLIDER -->
        </div>
        <!-- END OF SLIDER WRAPPER -->
    </section>

    <!-- Menu Board -->
    <section id="menuBoard" class="pb-90">
        <div class="container">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="heading heading-1 mb-50 text--center" id="frase-del-dia"
                        data-morning-greeting="{{ trans('sia::mainPage.Morning') }}"
                        data-quote="{{ trans('sia::mainPage.Quote') }}"
                        data-morning-quote="{{ trans('sia::mainPage.MorningQuote') }}"
                        data-afternoon-greeting="{{ trans('sia::mainPage.Afternoon') }}"
                        data-afternoon-quote="{{ trans('sia::mainPage.AfternoonQuote') }}"
                        data-night-greeting="{{ trans('sia::mainPage.Night') }}"
                        data-night-quote="{{ trans('sia::mainPage.NightQuote') }}">
                        <!-- Seccion para la frase segun la hora del dia -->
                    </div>
                </div>
                <!-- .col-md-8 end -->
            </div>
            <!-- .row end -->
        </div>

        <section id="divider5" class="section-divider3 bg-overlay bg-parallax bg-overlay-dark4">
            <div class="bg-section">
                <img src="{{ asset('modules/sia/images/index/26.webp') }}" alt="Background" />
            </div>
            <div class="container" id="espresso-section">
                <div class="divider--shape-1up"></div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                        <div class="heading heading-3 text--center">
                            <p class="heading--subtitle">{{ trans('sia::mainPage.TitleMenu') }}</p>
                            <h2 class="heading--title mb-0 text-white">{{ trans('sia::mainPage.TextMenu') }}</h2>
                        </div>
                    </div>
                    <!-- .col-md-8 end -->
                </div>
                <!-- .row end -->
                <div class="divider--shape-4down"></div>
            </div>
            <!-- .container end -->
        </section>
        <!-- #divider1 end -->

        <!-- .container end -->
        <div class="container-fluid tabs">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- .tab-pane end -->
                        <div class="tab-pane fade in active" id="drinks">
                            <!-- Menu #7 -->
                            <div class="menu menu-board text-center">
                                <div class="row">
                                    <div class="dishes-wrapper">
                                        <!-- Dish #1 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <!-- Imagen 1 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/sebi.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <!-- Imagen 2 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/agricola.webp') }}"
                                                            alt="dish img extra" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #2 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <!-- Imagen 1 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/tedaf.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <!-- Imagen 2 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/idear.webp') }}"
                                                            alt="dish img extra" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #3 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <!-- Imagen 1 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/agrogestion.avif') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <!-- Imagen 2 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/fisenso.avif') }}"
                                                            alt="dish img extra" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #4 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <!-- Imagen 1 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/agroindustrial.avif') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <!-- Imagen 2 -->
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/menu-board/sippa.avif') }}"
                                                            alt="dish img extra" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                    </div>
                                    <!-- .row end -->
                                </div>
                                <!-- .row end -->
                            </div>
                        </div>
                        <!-- .tab-pane end -->
                    </div>
                    <!-- .tabs-content end -->
                </div>
                <!-- .col-md-12 end -->
            </div>
            <!-- .row end -->
        </div>
    </section>
    <!-- #menuBoard end -->
    <!-- Sección de Eventos Programados -->
    <section id="events" class="pt-80 pb-80 bg-gray">
        <div class="container">
            <div class="row mb-50 text-center">
                <div class="col-md-12">
                    <div class="heading heading-2">
                        <p class="heading--subtitle text-primary">Próximos Eventos</p>
                        <h2 class="heading--title">No te pierdas nuestros próximos eventos</h2>
                        <div class="divider--shape-4"></div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($events as $event)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="blog-card h-100 shadow-sm">
                            <div class="blog-card-img">
                                <img src="{{ $event->event_image ? asset($event->event_image) : asset('modules/sia/images/default-event.jpg') }}"
                                    alt="Imagen evento" class="img-fluid">
                            </div>
                            <div class="blog-card-body">
                                <h5 class="blog-card-title">{{ $event->name }}</h5>
                                <p class="blog-card-description">{{ Str::limit($event->description, 120) }}</p>
                                <p class="blog-card-date">
                                    <i class="fas fa-calendar-alt me-2 m"></i>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                                    - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                                </p>
                                <p class="blog-card-date">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}
                                </p>
                                <p class="blog-card-date">
                                    <i class="fas fa-user me-2"></i>Organiza: {{ $event->organizer }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">No hay eventos programados por ahora.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección de Publicaciones Destacadas - Diseño Editorial Mejorado -->
    <section id="publications" class="pt-80 pb-80 bg-light">
        <div class="container">
            <div class="row mb-50 text-center">
                <div class="col-md-12">
                    <div class="heading heading-2">
                        <p class="heading--subtitle text-primary">Publicaciones recientes</p>
                        <div class="divider--shape-4"></div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($publications as $publication)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="blog-card h-100 shadow-sm">
                            <div class="blog-card-img">
                                <img src="{{ $publication->image ? asset($publication->image) : asset('modules/sia/images/default-publication.jpg') }}"
                                    alt="Imagen publicación" class="img-fluid">
                            </div>
                            <div class="blog-card-body">
                                <h5 class="blog-card-title">{{ $publication->title }}</h5>
                                <p class="blog-card-description">
                                    {{ Str::limit($publication->description, 120) }}
                                </p>
                                <p class="blog-card-date">
                                    <small class="text-muted">Publicado el
                                        {{ \Carbon\Carbon::parse($publication->publication_date)->format('d/m/Y') }}</small>
                                </p>
                                <a href="{{ asset($publication->pdf_path) }}" target="_blank"
                                    class="btn btn-outline-primary w-100">
                                    <i class="fas fa-file-pdf me-2"></i> Ver PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">No hay publicaciones disponibles por ahora.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Animacion que hace scroll hacia la seccion de especificada -->
    <script>
        $(document).ready(function() {
            $("#scroll-to-section").click(function() {
                $("html, body").animate({
                    scrollTop: $("#espresso-section").offset().top
                }, 1000); // Puedes ajustar la velocidad (en milisegundos) según tus preferencias
                return false;
            });
        });
    </script>

    <!-- Detecta la hora de ingreso y da una frase segun la jornada -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var horaActual = new Date().getHours();
            var fraseDelDia = document.getElementById("frase-del-dia");

            var morningGreeting = fraseDelDia.getAttribute("data-morning-greeting");
            var quote = fraseDelDia.getAttribute("data-quote");
            var morningQuote = fraseDelDia.getAttribute("data-morning-quote");
            var afternoonGreeting = fraseDelDia.getAttribute("data-afternoon-greeting");
            var afternoonQuote = fraseDelDia.getAttribute("data-afternoon-quote");
            var nightGreeting = fraseDelDia.getAttribute("data-night-greeting");
            var nightQuote = fraseDelDia.getAttribute("data-night-quote");

            if (horaActual >= 6 && horaActual < 12) {
                // Mañana (6:00 AM - 11:59 AM)
                fraseDelDia.innerHTML = `
                    <p class="heading--subtitle">${morningGreeting}</p>
                    <h2 class="heading--title mb-0">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc">
                        ${morningQuote}
                    </p>
                `;
            } else if (horaActual >= 12 && horaActual < 18) {
                // Tarde (12:00 PM - 5:59 PM)
                fraseDelDia.innerHTML = `
                    <p class="heading--subtitle">${afternoonGreeting}</p>
                    <h2 class="heading--title mb-0">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc">
                        ${afternoonQuote}
                    </p>
                `;
            } else {
                // Noche (6:00 PM - 5:59 AM)
                fraseDelDia.innerHTML = `
                    <p class="heading--subtitle">${nightGreeting}</p>
                    <h2 class="heading--title mb-0">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc">
                        ${nightQuote}
                    </p>
                `;
            }
        });
    </script>
@endpush
