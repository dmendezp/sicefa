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
                            <img src="{{ asset('modules/cafeto/images/index/coffee.jpg') }}"
                                alt="Slide Background Image" width="1920" height="1280" />
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="-130" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--subheadline">Estación de Café del Centro de Formación</div>
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="-65" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--headline">Bienvenido a CAFETO</div>
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="20" data-width="none" data-height="none"
                                data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">

                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="100" data-width="none" data-height="none" data-whitespace="nowrap"
                                data-transform_idle="o:1;"
                                data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power3.easeOut;"
                                data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);"
                                data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                data-transform_out="y:[175%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                data-mask_out="x:inherit;y:inherit;" data-start="1250" data-splitin="none"
                                data-splitout="none"
                                data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:bottom;rX:-20deg;rY:-20deg;rZ:0deg;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-basealign="slide" data-responsive_offset="on" data-responsive="off">
                                <div class="slide-action">
                                    <a class="btn btn--white btn--bordered btn--rounded btn--lg" href="#">Book
                                        Your
                                        Table Now</a>
                                </div>
                            </div>
                        </li>

                        <!-- slide 2 -->
                        <li data-transition="slideoverdown" data-slotamount="default" data-easein="Power4.easeInOut"
                            data-easeout="Power4.easeInOut" data-masterspeed="2000">
                            <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                            <img src="{{ asset('modules/cafeto/images/index/coffee-2.jpg') }}"
                                alt="Slide Background Image" width="1920" height="1280" />
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="-130" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--subheadline">Prueba nuestra variedad</div>
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="-65" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1750,"speed":1000,"frame":"0","from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--headline extend">
                                    Sabores!
                                </div>
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="20" data-width="none" data-height="none"
                                data-frames='[{"delay":2000,"speed":300,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--bio text--center">
                                    Estamos apasionados por el café y queremos compartir contigo 
                                    una experiencia de café excepcional. <br> Explora nuestra selección 
                                    de cafés únicos de todo el mundo. Desde el delicioso capuccino 
                                    hasta el café americano, cada taza te lleva a un viaje de sabores. <br>
                                    Ven y descubre la diversidad de aromas y sabores que el mundo del 
                                    café tiene para ofrecer.
                                </div>
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="100" data-width="none" data-height="none" data-whitespace="nowrap"
                                data-frames='[{"delay":2250,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none"
                                data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-164","delay":""}]'
                                data-basealign="slide" data-responsive_offset="on" data-responsive="off">
                                <div class="slide-action">
                                    <a class="btn btn--primary btn--inverse btn--rounded btn--lg" href="#">View
                                        Menu</a>
                                </div>
                            </div>
                        </li>

                        <!-- slide 3 -->
                        <li data-transition="zoomout" data-slotamount="default" data-easein="Power4.easeInOut"
                            data-easeout="Power4.easeInOut" data-masterspeed="2000">
                            <!-- MAIN IMAGE by: Imagen de StockSnap en Pixabay -->
                            <img src="{{ asset('modules/cafeto/images/index/coffee-3.jpg') }}"
                                alt="Slide Background Image" width="1920" height="1280" />
                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="-65" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1500,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--subheadline">La calidad es la prioridad</div>
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="0" data-whitespace="nowrap" data-width="none" data-height="none"
                                data-frames='[{"delay":1750,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--headline">Acercate!</div>
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption" data-x="center" data-hoffset="0" data-y="center"
                                data-voffset="100" data-width="none" data-height="none"
                                data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-splitin="none" data-splitout="none" data-responsive_offset="on">
                                <div class="slide--bio text--center">
                                    Sumérgete en un mundo de sabores frescos y aromas tentadores. <br>
                                    Nuestros granos de café recién tostados y preparados con esmero te brindarán una experiencia única. <br>
                                    Disfruta de la perfección en cada taza y descubre la pasión que ponemos en cada café que servimos.
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
                        <div class="heading heading-1 mb-50 text--center">
                            <p class="heading--subtitle">Empieza el dia</p>
                            <h2 class="heading--title mb-0">con una gran frase!</h2>
                            <div class="divider--shape-4"></div>
                            <p class="heading--desc">
                                "Una taza de café es como un abrazo cálido para el alma, 
                                un viaje exquisito de sabores que despiertan los sentidos 
                                y te llevan a lugares donde los sueños se mezclan con la realidad."
                            </p>
                        </div>
                    </div>
                    <!-- .col-md-8 end -->
                </div>
                <!-- .row end -->
            </div>

            <section id="divider5" class="section-divider3 bg-overlay bg-parallax bg-overlay-dark4">
                <div class="bg-section">
                    <img src="{{ asset('modules/cafeto/images/index/26.jpg') }}" alt="Background" />
                </div>
                <div class="container">
                    <div class="divider--shape-1up"></div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                            <div class="heading heading-3 text--center">
                                <p class="heading--subtitle">Disfruta</p>
                                <h2 class="heading--title mb-0 text-white">Menú de Cafés</h2>
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
                                                            <div class="dish--tag">Chef Selection</div>
                                                            <span class="dish--price">$24.95</span>
                                                            <h3 class="dish--title">
                                                                Grilled American Fillet
                                                            </h3>
                                                            <div class="divider--shape-4"></div>
                                                            <p class="dish--desc">
                                                                Pork fillet, ginger, garlic, honey, pepper &
                                                                canola oil.creamy chesapeake crab dip with
                                                                artichoke, baked and topped with cheddar
                                                                cheese, with crusty bread for dipping. creamy
                                                                chesapeake crab dip with artichoke, baked and
                                                                topped with cheddar cheese.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="dish--img">
                                                            <div class="divider--shape-left"></div>
                                                            <img src="{{ asset('modules/cafeto/images/menu-board/9.jpg') }}"
                                                                alt="dish img" />
                                                            <div class="dish--overlay">
                                                                <a class="dish-popup" data-toggle="modal"
                                                                    data-target="#dishPopup13"><i
                                                                        class="fa fa-search-plus"></i></a>
                                                                <div class="modal fade" tabindex="-1" role="dialog"
                                                                    id="dishPopup13">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-times"></i>
                                                                                </button>
                                                                                <div class="row reservation">
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="popup--img">
                                                                                            <img src="{{ asset('modules/cafeto/images/menu-board/9.jpg') }}"
                                                                                                alt="dish img" />
                                                                                            <div
                                                                                                class="img-popup-overlay">
                                                                                                <div
                                                                                                    class="popup--price">
                                                                                                    $13.95
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="popup--title">
                                                                                                    Smoked Hummus
                                                                                                </h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- .col-md-12 end -->
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="content-popup">
                                                                                            <p>
                                                                                                Roast trout, English
                                                                                                asparagus, watercress &
                                                                                                royals, creamy
                                                                                                chesapeake crab
                                                                                                dip with artichoke,
                                                                                                baked and
                                                                                                topped with cheddar
                                                                                                cheese,
                                                                                                with crusty bread.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- .row end -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </div>
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
                                                            <span class="dish--price">$34.95</span>
                                                            <h3 class="dish--title">Caffè Macchiato</h3>
                                                            <div class="divider--shape-4"></div>
                                                            <p class="dish--desc">
                                                                Monkfish, onion, paella rice, garlic & smoked
                                                                paprika, creamy chesapeake crab dip with
                                                                artichoke, baked and topped with cheddar
                                                                cheese, with crusty bread for dipping. creamy
                                                                chesapeake crab dip with artichoke, baked and
                                                                topped with cheddar cheese.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="dish--img">
                                                            <div class="divider--shape-left"></div>
                                                            <img src="{{ asset('modules/cafeto/images/menu-board/10.jpg') }}"
                                                                alt="dish img" />
                                                            <div class="dish--overlay">
                                                                <a class="dish-popup" data-toggle="modal"
                                                                    data-target="#dishPopup14"><i
                                                                        class="fa fa-search-plus"></i></a>
                                                                <div class="modal fade" tabindex="-1" role="dialog"
                                                                    id="dishPopup14">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-times"></i>
                                                                                </button>
                                                                                <div class="row reservation">
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="popup--img">
                                                                                            <img src="{{ asset('modules/cafeto/images/menu-board/10.jpg') }}"
                                                                                                alt="dish img" />
                                                                                            <div
                                                                                                class="img-popup-overlay">
                                                                                                <div
                                                                                                    class="popup--price">
                                                                                                    $33.95
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="popup--title">
                                                                                                    Chicken Breast
                                                                                                </h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- .col-md-12 end -->
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="content-popup">
                                                                                            <p>
                                                                                                Red peppers, roasted
                                                                                                garlic,
                                                                                                lemon slices, olives &
                                                                                                mint,
                                                                                                creamy crab dip with
                                                                                                artichoke, baked and
                                                                                                topped
                                                                                                with cheddar cheese,
                                                                                                with
                                                                                                crusty bread for
                                                                                                dipping.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- .row end -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </div>
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
                                                            <img src="{{ asset('modules/cafeto/images/menu-board/11.jpg') }}"
                                                                alt="dish img" />
                                                            <div class="dish--overlay">
                                                                <a class="dish-popup" data-toggle="modal"
                                                                    data-target="#dishPopup15"><i
                                                                        class="fa fa-search-plus"></i></a>
                                                                <div class="modal fade" tabindex="-1" role="dialog"
                                                                    id="dishPopup15">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-times"></i>
                                                                                </button>
                                                                                <div class="row reservation">
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="popup--img">
                                                                                            <img src="{{ asset('modules/cafeto/images/menu-board/11.jpg') }}"
                                                                                                alt="dish img" />
                                                                                            <div
                                                                                                class="img-popup-overlay">
                                                                                                <div
                                                                                                    class="popup--price">
                                                                                                    $29.95
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="popup--title">
                                                                                                    Roasted Steak
                                                                                                    Roulade
                                                                                                </h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- .col-md-12 end -->
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="content-popup">
                                                                                            <p>
                                                                                                Roast trout, English
                                                                                                asparagus, watercress &
                                                                                                royals, creamy
                                                                                                chesapeake crab
                                                                                                dip with artichoke,
                                                                                                baked and
                                                                                                topped with cheddar
                                                                                                cheese,
                                                                                                with crusty bread.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- .row end -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="dish--content">
                                                            <div class="dish--tag">new</div>
                                                            <span class="dish--price">$38.95</span>
                                                            <h3 class="dish--title">Dark Coffee</h3>
                                                            <div class="divider--shape-4"></div>
                                                            <p class="dish--desc">
                                                                Monkfish, onion, paella rice, garlic & smoked
                                                                paprika, creamy chesapeake crab dip with
                                                                artichoke, baked and topped with cheddar
                                                                cheese, with crusty bread for dipping. creamy
                                                                chesapeake crab dip with artichoke, baked and
                                                                topped with cheddar cheese.
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
                                                            <img src="{{ asset('modules/cafeto/images/menu-board/12.jpg') }}"
                                                                alt="dish img" />
                                                            <div class="dish--overlay">
                                                                <a class="dish-popup" data-toggle="modal"
                                                                    data-target="#dishPopup16"><i
                                                                        class="fa fa-search-plus"></i></a>
                                                                <div class="modal fade" tabindex="-1" role="dialog"
                                                                    id="dishPopup16">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-times"></i>
                                                                                </button>
                                                                                <div class="row reservation">
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="popup--img">
                                                                                            <img src="{{ asset('modules/cafeto/images/menu-board/12.jpg') }}"
                                                                                                alt="dish img" />
                                                                                            <div
                                                                                                class="img-popup-overlay">
                                                                                                <div
                                                                                                    class="popup--price">
                                                                                                    $29.95
                                                                                                </div>
                                                                                                <h3
                                                                                                    class="popup--title">
                                                                                                    Roasted Steak
                                                                                                    Roulade
                                                                                                </h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- .col-md-12 end -->
                                                                                    <div
                                                                                        class="col-xs-12 col-sm-12 col-md-12">
                                                                                        <div class="content-popup">
                                                                                            <p>
                                                                                                Red peppers, roasted
                                                                                                garlic,
                                                                                                lemon slices, olives &
                                                                                                mint,
                                                                                                creamy crab dip with
                                                                                                artichoke, baked and
                                                                                                topped
                                                                                                with cheddar cheese,
                                                                                                with
                                                                                                crusty bread for
                                                                                                dipping.
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- .row end -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                <!-- /.modal -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="dish--content">
                                                            <span class="dish--price">$18.95</span>
                                                            <h3 class="dish--title">Espresso Coffee</h3>
                                                            <div class="divider--shape-4"></div>
                                                            <p class="dish--desc">
                                                                Monkfish, onion, paella rice, garlic & smoked
                                                                paprika, creamy chesapeake crab dip with
                                                                artichoke, baked and topped with cheddar
                                                                cheese, with crusty bread for dipping. creamy
                                                                chesapeake crab dip with artichoke, baked and
                                                                topped with cheddar cheese.
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
@endpush