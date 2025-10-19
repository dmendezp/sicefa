@extends('cafeto::layouts.mainPage.master-mainPage')

@push('head')
    <title>{{ __('cafeto::mainPage.TitlePage', [], app()->getLocale()) }}</title>
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/instructor/index.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="slider" class="slider slide-overlay-dark section-hero">
        <!-- START REVOLUTION SLIDER 5.0 -->
        <div class="rev_slider_wrapper">
            <div id="slider1" class="rev_slider" data-version="5.0">
                <ul>
                    <!-- Slide 1 -->
                    <li data-transition="zoomin" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/cafeto/images/index/coffee.webp') }}" alt="Slide Background Image"
                             width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ __('cafeto::mainPage.TitleWelcomeApp', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ __('cafeto::mainPage.TitleWelcome', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                             data-width="none" data-height="none"
                             data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">{{ __('cafeto::mainPage.WelcomeDescription', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                             data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[175%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-start="1250" data-splitin="none" data-splitout="none"
                             data-basealign="slide" data-responsive_offset="on" data-responsive="off">
                            <div class="slide-action">
                                <a class="btn btn--custom" href="#espresso-section" id="scroll-to-section">
                                    {{ __('cafeto::mainPage.ViewProducts', [], app()->getLocale()) }}
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Slide 2 -->
                    <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/cafeto/images/index/coffee-2.webp') }}" alt="Slide Background Image"
                             width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-130"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ __('cafeto::mainPage.TitleInfoS2', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline extend">{{ __('cafeto::mainPage.TextInfoS2', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="20"
                             data-width="none" data-height="none"
                             data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ __('cafeto::mainPage.DescriptionS21', [], app()->getLocale()) }}<br>
                                {{ __('cafeto::mainPage.DescriptionS22', [], app()->getLocale()) }}<br>
                                {{ __('cafeto::mainPage.DescriptionS23', [], app()->getLocale()) }}
                            </div>
                        </div>
                    </li>
                    <!-- Slide 3 -->
                    <li data-transition="zoomout" data-slotamount="default" data-easein="Power4.easeInOut"
                        data-easeout="Power4.easeInOut" data-masterspeed="2000">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('modules/cafeto/images/index/coffee-3.webp') }}" alt="Slide Background Image"
                             width="1920" height="1280" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="-65"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--subheadline">{{ __('cafeto::mainPage.TitleInfoS3', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"
                             data-whitespace="nowrap" data-width="none" data-height="none"
                             data-frames='[{"delay":1750,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--headline">{{ __('cafeto::mainPage.TextInfoS3', [], app()->getLocale()) }}</div>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center" data-voffset="100"
                             data-width="none" data-height="none"
                             data-frames='[{"delay.2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <div class="slide--bio text--center">
                                {{ __('cafeto::mainPage.DescriptionS31', [], app()->getLocale()) }}<br>
                                {{ __('cafeto::mainPage.DescriptionS32', [], app()->getLocale()) }}<br>
                                {{ __('cafeto::mainPage.DescriptionS33', [], app()->getLocale()) }}
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
    <section id="menuBoard" class="section-menu">
        <div class="container">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="heading heading-1 mb-50 text--center quote-section" id="frase-del-dia"
                         data-morning-greeting="{{ __('cafeto::mainPage.Morning', [], app()->getLocale()) }}"
                         data-quote="{{ __('cafeto::mainPage.Quote', [], app()->getLocale()) }}"
                         data-morning-quote="{{ __('cafeto::mainPage.MorningQuote', [], app()->getLocale()) }}"
                         data-afternoon-greeting="{{ __('cafeto::mainPage.Afternoon', [], app()->getLocale()) }}"
                         data-afternoon-quote="{{ __('cafeto::mainPage.AfternoonQuote', [], app()->getLocale()) }}"
                         data-night-greeting="{{ __('cafeto::mainPage.Night', [], app()->getLocale()) }}"
                         data-night-quote="{{ __('cafeto::mainPage.NightQuote', [], app()->getLocale()) }}">
                    </div>
                </div>
            </div>
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
                            <p class="heading--subtitle">{{ __('cafeto::mainPage.TitleMenu', [], app()->getLocale()) }}</p>
                            <h2 class="heading--title mb-0 text-white">{{ __('cafeto::mainPage.TextMenu', [], app()->getLocale()) }}</h2>
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
                        <div class="tab-pane fade in active" id="drinks">
                            <div class="menu menu-board text-center">
                                <div class="row">
                                    <div class="dishes-wrapper">
                                        <!-- Dish #1 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <div class="dish--tag">{{ __('cafeto::mainPage.TitlePopular', [], app()->getLocale()) }}</div>
                                                        <span class="dish--price">$3.000</span>
                                                        <h3 class="dish--title">{{ __('cafeto::mainPage.TitleCapuccino', [], app()->getLocale()) }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">{{ __('cafeto::mainPage.TextCapuccino', [], app()->getLocale()) }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/9.webp') }}" alt="Cappuccino" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dish #2 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$1.500</span>
                                                        <h3 class="dish--title">{{ __('cafeto::mainPage.TitleAmerican', [], app()->getLocale()) }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">{{ __('cafeto::mainPage.TextAmerican', [], app()->getLocale()) }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-left"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/10.webp') }}" alt="Americano" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dish #3 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/11.webp') }}" alt="Farmer’s Brew" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$1.500</span>
                                                        <h3 class="dish--title">{{ __('cafeto::mainPage.TitleFarmer', [], app()->getLocale()) }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">{{ __('cafeto::mainPage.TextFarmer', [], app()->getLocale()) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dish #4 -->
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="row dish-panel">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--img">
                                                        <div class="divider--shape-right"></div>
                                                        <img src="{{ asset('modules/cafeto/images/menu-board/12.webp') }}" alt="Coffee Slushie" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="dish--content">
                                                        <span class="dish--price">$2.000</span>
                                                        <h3 class="dish--title">{{ __('cafeto::mainPage.TitleSlushie', [], app()->getLocale()) }}</h3>
                                                        <div class="divider--shape-4"></div>
                                                        <p class="dish--desc">{{ __('cafeto::mainPage.TextSlushie', [], app()->getLocale()) }}</p>
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
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Smooth scroll to section -->
    <script>
        $(document).ready(function() {
            $("#scroll-to-section").click(function(event) {
                event.preventDefault();
                $("html, body").animate({
                    scrollTop: $("#espresso-section").offset().top
                }, 1000);
            });
        });
    </script>

    <!-- Daily quote based on time of day -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const horaActual = new Date().getHours();
            const fraseDelDia = document.getElementById("frase-del-dia");

            const messages = {
                morning: {
                    greeting: "{{ __('cafeto::mainPage.Morning', [], app()->getLocale()) }}",
                    quote: "{{ __('cafeto::mainPage.Quote', [], app()->getLocale()) }}",
                    description: "{{ __('cafeto::mainPage.MorningQuote', [], app()->getLocale()) }}"
                },
                afternoon: {
                    greeting: "{{ __('cafeto::mainPage.Afternoon', [], app()->getLocale()) }}",
                    quote: "{{ __('cafeto::mainPage.Quote', [], app()->getLocale()) }}",
                    description: "{{ __('cafeto::mainPage.AfternoonQuote', [], app()->getLocale()) }}"
                },
                night: {
                    greeting: "{{ __('cafeto::mainPage.Night', [], app()->getLocale()) }}",
                    quote: "{{ __('cafeto::mainPage.Quote', [], app()->getLocale()) }}",
                    description: "{{ __('cafeto::mainPage.NightQuote', [], app()->getLocale()) }}"
                }
            };

            let message;
            if (horaActual >= 6 && horaActual < 12) {
                message = messages.morning;
            } else if (horaActual >= 12 && horaActual < 18) {
                message = messages.afternoon;
            } else {
                message = messages.night;
            }

            fraseDelDia

.innerHTML = `
                <p class="heading--subtitle">${message.greeting}</p>
                <h2 class="heading--title mb-0">${message.quote}</h2>
                <div class="divider--shape-4"></div>
                <p class="heading--desc">${message.description}</p>
            `;
        });
    </script>
@endpush