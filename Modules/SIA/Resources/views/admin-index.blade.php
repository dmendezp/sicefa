@extends('sia::layouts.mainPage.master-mainPage')

@push('head')
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="slider" class="slider slide-overlay-dark" style="background-color: #FFFFFF;">
        <!-- START REVOLUTION SLIDER 5.0 -->
        <div class="rev_slider_wrapper">
            <div id="slider1" class="rev_slider" data-version="5.0">
                <ul>
                    <!-- slide 1 -->
                    <li data-transition="zoomin" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/sia/images/index/1.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline" style="color: #52DE5A;">{{ trans('sia::mainPage.TitleWelcomeApp') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline" style="color: #83DE52;">{{ trans('sia::mainPage.TitleWelcome') }}</div>
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
                                <a class="btn btn--white btn--bordered btn--rounded btn--lg" href="#dashboard-section"
                                    id="scroll-to-section" style="background-color: #DED652; color: #FFFFFF;">{{ trans('sia::mainPage.ViewDashboard') }}</a>
                            </div>
                        </div>
                    </li>

                    <!-- slide 2 -->
                    <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/sia/images/index/2.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline" style="color: #52DE5A;">{{ trans('sia::mainPage.TitleInfoS2') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline extend" style="color: #83DE52;">
                                {{ trans('sia::mainPage.TextInfoS2') }}
                            </div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center" style="color: #52DE89;">
                                {{ trans('sia::mainPage.DescriptionS21') }}<br>
                                {{ trans('sia::mainPage.DescriptionS22') }}<br>
                                {{ trans('sia::mainPage.DescriptionS23') }}
                            </div>
                        </div>
                    </li>

                    <!-- slide 3 -->
                    <li data-transition="zoomout" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/sia/images/index/research-3.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline" style="color: #52DE5A;">{{ trans('sia::mainPage.TitleInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline" style="color: #83DE52;">{{ trans('sia::mainPage.TextInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center" style="color: #52DE89;">
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

    <!-- Dashboard Section -->
    <section id="dashboard" class="pb-90" style="background-color: #52DE89;">
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
                        <!-- Sección para la frase según la hora del día -->
                    </div>
                </div>
            </div>
        </div>

        <section id="divider5" class="section-divider3 bg-overlay bg-parallax bg-overlay-dark4">
            <div class="bg-section">
                <img src="{{ asset('modules/sia/images/index/research-bg.webp') }}" alt="Background" />
            </div>
            <div class="container" id="dashboard-section">
                <div class="divider--shape-1up"></div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                        <div class="heading heading-3 text--center">
                            <p class="heading--subtitle" style="color: #BEDE52;">{{ trans('sia::mainPage.TitleDashboard') }}</p>
                            <h2 class="heading--title mb-0 text-white">{{ trans('sia::mainPage.TextDashboard') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="divider--shape-4down"></div>
            </div>
        </section>

        <div class="container-fluid tabs">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="projects">
                            <div class="menu menu-board text-center">
                                <div class="row">
                                    <div class="dishes-wrapper">
                                        <!-- Project #1 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <div class="dish--tag" style="background-color: #DED652; color: #FFFFFF;">
                                                            {{ trans('sia::mainPage.TitleActive') }}</div>
                                                        <span class="dish--price" style="color: #52DE5A;">Ongoing</span>
                                                        <h3 class="dish--title" style="color: #83DE52;">
                                                            {{ trans('sia::mainPage.TitleProject1') }}
                                                        </h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc" style="color: #52DE89;">
                                                            {{ trans('sia::mainPage.TextProject1') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/projects/project-1.webp') }}"
                                                            alt="project img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Project #2 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price" style="color: #52DE5A;">Completed</span>
                                                        <h3 class="dish--title" style="color: #83DE52;">{{ trans('sia::mainPage.TitleProject2') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc" style="color: #52DE89;">
                                                            {{ trans('sia::mainPage.TextProject2') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/sia/images/projects/project-2.webp') }}"
                                                            alt="project img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Project #3 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/projects/project-3.webp') }}"
                                                            alt="project img" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price" style="color: #52DE5A;">Planned</span>
                                                        <h3 class="dish--title" style="color: #83DE52;">{{ trans('sia::mainPage.TitleProject3') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc" style="color: #52DE89;">
                                                            {{ trans('sia::mainPage.TextProject3') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Project #4 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/sia/images/projects/project-4.webp') }}"
                                                            alt="project img" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price" style="color: #52DE5A;">Ongoing</span>
                                                        <h3 class="dish--title" style="color: #83DE52;">{{ trans('sia::mainPage.TitleProject4') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc" style="color: #52DE89;">
                                                            {{ trans('sia::mainPage.TextProject4') }}
                                                        </p>
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
            </div>
        </section>
        <!-- #dashboard end -->
@endsection

@push('scripts')
    <!-- Animación que hace scroll hacia la sección especificada -->
    <script>
        $(document).ready(function() {
            $("#scroll-to-section").click(function() {
                $("html, body").animate({
                    scrollTop: $("#dashboard-section").offset().top
                }, 1000); // Puedes ajustar la velocidad (en milisegundos) según tus preferencias
                return false;
            });
        });
    </script>

    <!-- Detecta la hora de ingreso y da una frase según la jornada -->
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
                    <p class="heading--subtitle" style="color: #BEDE52;">${morningGreeting}</p>
                    <h2 class="heading--title mb-0" style="color: #52DE5A;">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc" style="color: #52DE89;">
                        ${morningQuote}
                    </p>
                `;
            } else if (horaActual >= 12 && horaActual < 18) {
                // Tarde (12:00 PM - 5:59 PM)
                fraseDelDia.innerHTML = `
                    <p class="heading--subtitle" style="color: #BEDE52;">${afternoonGreeting}</p>
                    <h2 class="heading--title mb-0" style="color: #52DE5A;">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc" style="color: #52DE89;">
                        ${afternoonQuote}
                    </p>
                `;
            } else {
                // Noche (6:00 PM - 5:59 AM)
                fraseDelDia.innerHTML = `
                    <p class="heading--subtitle" style="color: #BEDE52;">${nightGreeting}</p>
                    <h2 class="heading--title mb-0" style="color: #52DE5A;">${quote}</h2>
                    <div class="divider--shape-4"></div>
                    <p class="heading--desc" style="color: #52DE89;">
                        ${nightQuote}
                    </p>
                `;
            }
        });
    </script>
@endpush