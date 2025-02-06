@extends('cafeto::layouts.mainPage.master-mainPage')

@push('head')
@endpush

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
                        <img src="{{ asset('modules/cafeto/images/index/coffee.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('cafeto::mainPage.TitleWelcomeApp') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ trans('cafeto::mainPage.TitleWelcome') }}</div>
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
                                    id="scroll-to-section">{{ trans('cafeto::mainPage.ViewProducts') }}</a>
                            </div>
                        </div>

                    </li>

                    <!-- slide 2 -->
                    <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                        <img src="{{ asset('modules/cafeto/images/index/coffee-2.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('cafeto::mainPage.TitleInfoS2') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline extend">
                                {{ trans('cafeto::mainPage.TextInfoS2') }}
                            </div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ trans('cafeto::mainPage.DescriptionS21') }}<br>
                                {{ trans('cafeto::mainPage.DescriptionS22') }}<br>
                                {{ trans('cafeto::mainPage.DescriptionS23') }}
                            </div>
                        </div>
                    </li>

                    <!-- slide 3 -->
                    <li data-transition="zoomout" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                        <img src="{{ asset('modules/cafeto/images/index/coffee-3.webp') }}" alt="Slide Background Image"
                            width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ trans('cafeto::mainPage.TitleInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"
                            data-whitespace="nowrap" data-width="none" data-height="none"
                            data-frames='[{"delay":1750,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ trans('cafeto::mainPage.TextInfoS3') }}</div>
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                            data-width="none" data-height="none"
                            data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ trans('cafeto::mainPage.DescriptionS31') }} <br>
                                {{ trans('cafeto::mainPage.DescriptionS32') }} <br>
                                {{ trans('cafeto::mainPage.DescriptionS33') }}
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
                        data-morning-greeting="{{ trans('cafeto::mainPage.Morning') }}"
                        data-quote="{{ trans('cafeto::mainPage.Quote') }}"
                        data-morning-quote="{{ trans('cafeto::mainPage.MorningQuote') }}"
                        data-afternoon-greeting="{{ trans('cafeto::mainPage.Afternoon') }}"
                        data-afternoon-quote="{{ trans('cafeto::mainPage.AfternoonQuote') }}"
                        data-night-greeting="{{ trans('cafeto::mainPage.Night') }}"
                        data-night-quote="{{ trans('cafeto::mainPage.NightQuote') }}">
                        <!-- Seccion para la frase segun la hora del dia -->
                    </div>
                </div>
                <!-- .col-md-8 end -->
            </div>
            <!-- .row end -->
        </div>

        <section id="divider5" class="section-divider3 bg-overlay bg-parallax bg-overlay-dark4">
            <div class="bg-section">
                <img src="{{ asset('modules/cafeto/images/index/26.webp') }}" alt="Background" />
            </div>
            <div class="container" id="espresso-section">
                <div class="divider--shape-1up"></div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                        <div class="heading heading-3 text--center">
                            <p class="heading--subtitle">{{ trans('cafeto::mainPage.TitleMenu') }}</p>
                            <h2 class="heading--title mb-0 text-white">{{ trans('cafeto::mainPage.TextMenu') }}</h2>
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
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <div class="dish--tag">
                                                            {{ trans('cafeto::mainPage.TitlePopular') }}</div>
                                                        <span class="dish--price">$3.000</span>
                                                        <h3 class="dish--title">
                                                            {{ trans('cafeto::mainPage.TitleCapuccino') }}
                                                        </h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">
                                                            {{ trans('cafeto::mainPage.TextCapuccino') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/9.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #2 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$1.500</span>
                                                        <h3 class="dish--title">{{ trans('cafeto::mainPage.TitleAmerican') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">
                                                            {{ trans('cafeto::mainPage.TextAmerican') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/10.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #3 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/11.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$1.500</span>
                                                        <h3 class="dish--title">{{ trans('cafeto::mainPage.TitleFarmer') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">
                                                            {{ trans('cafeto::mainPage.TextFarmer') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .col-md-6 end -->
                                        <!-- Dish #4 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/12.webp') }}"
                                                            alt="dish img" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$2.000</span>
                                                        <h3 class="dish--title">{{ trans('cafeto::mainPage.TitleSlushie') }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">
                                                            {{ trans('cafeto::mainPage.TextSlushie') }}
                                                        </p>
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
