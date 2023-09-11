@extends('cefamaps::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('cefamaps::mainPage.Overview_Map') }}</h5>
                        </div>
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        Swal.fire({
            html: "<div class='estrella'></div>" +
                "<div class='nubes'><img src='{{ asset('#') }}' alt=''><div class='mapa'></div></div>",
            // con este se hace para cambiar el color al cuadro blanco
            background: `-webkit-radial-gradient(#407BA0, #214154, #13242F)`,
            // con este se hace para cambiar el color a todo el fondo
            backdrop: `-webkit-radial-gradient(#407BA0, #214154, #13242F)`,
            color: '#716add',
            width: 50000,
            padding: '18em',
            showConfirmButton: false,
            timer: 3000
        })
    </script>

    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const adsi = {
                lat: 2.61265158990476,
                lng: -75.36091880830087
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                /* El zoom del mapa */
                center: adsi,
                mapTypeId: 'satellite' /* El tipo de mapa */
            });

            /* Inicio del Poligono antes de la Carretera*/
            // The marker, positioned at Uluru
            const markerGeneral = new google.maps.Marker({
                position: {
                    lat: 2.611609,
                    lng: -75.367646
                },
                map: map,
                tittle: "General CEFA",
            });

            // Nombre del Sena, dentro del marcador. 
            const infoGeneral = new google.maps.InfoWindow();
            infoGeneral.setContent(
            '<div id="content">Centro de Formación Agroindustrial Sena "La Angostura" </div>'); // Aqui va el Nombre completo del Sena. 
            markerGeneral.addListener("click", () => {
                infoGeneral.open(map, markerGeneral);
            });

            // Define the LatLng coordinates for the polygon's path.
            const CoordsGeneral = [{
                    lat: 2.622710,
                    lng: -75.368564
                },
                {
                    lat: 2.622740,
                    lng: -75.368590
                },
                {
                    lat: 2.622752,
                    lng: -75.368627
                },
                {
                    lat: 2.622732,
                    lng: -75.368651
                },
                {
                    lat: 2.622533,
                    lng: -75.368685
                },
                {
                    lat: 2.622369,
                    lng: -75.368727
                },
                {
                    lat: 2.622137,
                    lng: -75.368819
                },
                {
                    lat: 2.621937,
                    lng: -75.368885
                },
                {
                    lat: 2.621734,
                    lng: -75.368941
                },
                {
                    lat: 2.621577,
                    lng: -75.369000
                },
                {
                    lat: 2.621387,
                    lng: -75.369078
                },
                {
                    lat: 2.621233,
                    lng: -75.369141
                },
                {
                    lat: 2.621233,
                    lng: -75.369140
                },
                {
                    lat: 2.621074,
                    lng: -75.369197
                },
                {
                    lat: 2.620905,
                    lng: -75.369259
                },
                {
                    lat: 2.620884,
                    lng: -75.369274
                },
                {
                    lat: 2.620893,
                    lng: -75.369269
                },
                {
                    lat: 2.620844,
                    lng: -75.369289
                },
                {
                    lat: 2.620606,
                    lng: -75.369375
                },
                {
                    lat: 2.620446,
                    lng: -75.369444
                },
                {
                    lat: 2.620285,
                    lng: -75.369493
                },
                {
                    lat: 2.619866,
                    lng: -75.369624
                },
                {
                    lat: 2.619344,
                    lng: -75.369882
                },
                {
                    lat: 2.618922,
                    lng: -75.370058
                },
                {
                    lat: 2.618605,
                    lng: -75.370199
                },
                {
                    lat: 2.618294,
                    lng: -75.370334
                },
                {
                    lat: 2.617907,
                    lng: -75.370481
                },
                {
                    lat: 2.617374,
                    lng: -75.370681
                },
                {
                    lat: 2.617199,
                    lng: -75.370758
                },
                {
                    lat: 2.617053,
                    lng: -75.370811
                },
                {
                    lat: 2.616893,
                    lng: -75.370870
                },
                {
                    lat: 2.616687,
                    lng: -75.370955
                },
                {
                    lat: 2.616531,
                    lng: -75.371016
                },
                {
                    lat: 2.616315,
                    lng: -75.371098
                },
                {
                    lat: 2.616102,
                    lng: -75.371169
                },
                {
                    lat: 2.615982,
                    lng: -75.371217
                },
                {
                    lat: 2.615849,
                    lng: -75.371262
                },
                {
                    lat: 2.615547,
                    lng: -75.371404
                },
                {
                    lat: 2.615332,
                    lng: -75.371496
                },
                {
                    lat: 2.615185,
                    lng: -75.371560
                },
                {
                    lat: 2.615061,
                    lng: -75.371605
                },
                {
                    lat: 2.614930,
                    lng: -75.371650
                },
                {
                    lat: 2.614779,
                    lng: -75.371722
                },
                {
                    lat: 2.614605,
                    lng: -75.371797
                },
                {
                    lat: 2.614440,
                    lng: -75.371871
                },
                {
                    lat: 2.614251,
                    lng: -75.371964
                },
                {
                    lat: 2.614124,
                    lng: -75.372023
                },
                {
                    lat: 2.613962,
                    lng: -75.372093
                },
                {
                    lat: 2.613786,
                    lng: -75.372181
                },
                {
                    lat: 2.613598,
                    lng: -75.372255
                },
                {
                    lat: 2.613422,
                    lng: -75.372339
                },
                {
                    lat: 2.613248,
                    lng: -75.372425
                },
                {
                    lat: 2.613076,
                    lng: -75.372486
                },
                {
                    lat: 2.612940,
                    lng: -75.372554
                },
                {
                    lat: 2.612844,
                    lng: -75.372601
                },
                {
                    lat: 2.612761,
                    lng: -75.372645
                },
                {
                    lat: 2.612678,
                    lng: -75.372697
                },
                {
                    lat: 2.612508,
                    lng: -75.372791
                },
                {
                    lat: 2.612294,
                    lng: -75.372934
                },
                {
                    lat: 2.612060,
                    lng: -75.373045
                },
                {
                    lat: 2.611762,
                    lng: -75.373190
                },
                {
                    lat: 2.611474,
                    lng: -75.373286
                },
                {
                    lat: 2.611283,
                    lng: -75.373359
                },
                {
                    lat: 2.610952,
                    lng: -75.373492
                },
                {
                    lat: 2.610515,
                    lng: -75.373670
                },
                {
                    lat: 2.610059,
                    lng: -75.373859
                },
                {
                    lat: 2.609609,
                    lng: -75.374029
                },
                {
                    lat: 2.609274,
                    lng: -75.374175
                },
                {
                    lat: 2.608773,
                    lng: -75.374345
                },
                {
                    lat: 2.608355,
                    lng: -75.374518
                },
                {
                    lat: 2.608025,
                    lng: -75.374648
                },
                {
                    lat: 2.607754,
                    lng: -75.374757
                },
                {
                    lat: 2.607355,
                    lng: -75.374898
                },
                {
                    lat: 2.605801,
                    lng: -75.375493
                },
                {
                    lat: 2.604633,
                    lng: -75.375874
                },
                {
                    lat: 2.604631,
                    lng: -75.375215
                },
                {
                    lat: 2.604642,
                    lng: -75.374661
                },
                {
                    lat: 2.604626,
                    lng: -75.373800
                },
                {
                    lat: 2.604610,
                    lng: -75.373019
                },
                {
                    lat: 2.604613,
                    lng: -75.371364
                },
                {
                    lat: 2.604613,
                    lng: -75.368065
                },
                {
                    lat: 2.604634,
                    lng: -75.365807
                },
                {
                    lat: 2.604613,
                    lng: -75.363495
                },
                {
                    lat: 2.605127,
                    lng: -75.363736
                },
                {
                    lat: 2.605406,
                    lng: -75.363608
                },
                {
                    lat: 2.606038,
                    lng: -75.363339
                },
                {
                    lat: 2.606145,
                    lng: -75.362964
                },
                {
                    lat: 2.606458,
                    lng: -75.362818
                },
                {
                    lat: 2.606690,
                    lng: -75.362578
                },
                {
                    lat: 2.607281,
                    lng: -75.362425
                },
                {
                    lat: 2.607540,
                    lng: -75.362339
                },
                {
                    lat: 2.608038,
                    lng: -75.361993
                },
                {
                    lat: 2.608636,
                    lng: -75.362066
                },
                {
                    lat: 2.608805,
                    lng: -75.362059
                },
                {
                    lat: 2.608863,
                    lng: -75.361990
                },
                {
                    lat: 2.608924,
                    lng: -75.362006
                },
                {
                    lat: 2.609049,
                    lng: -75.361938
                },
                {
                    lat: 2.609160,
                    lng: -75.361886
                },
                {
                    lat: 2.609311,
                    lng: -75.361818
                },
                {
                    lat: 2.609441,
                    lng: -75.361742
                },
                {
                    lat: 2.609478,
                    lng: -75.361723
                },
                {
                    lat: 2.609516,
                    lng: -75.361684
                },
                {
                    lat: 2.609543,
                    lng: -75.361664
                },
                {
                    lat: 2.609573,
                    lng: -75.361642
                },
                {
                    lat: 2.609603,
                    lng: -75.361646
                },
                {
                    lat: 2.609618,
                    lng: -75.361648
                },
                {
                    lat: 2.609638,
                    lng: -75.361620
                },
                {
                    lat: 2.609650,
                    lng: -75.361613
                },
                {
                    lat: 2.609646,
                    lng: -75.361599
                },
                {
                    lat: 2.609648,
                    lng: -75.361570
                },
                {
                    lat: 2.609667,
                    lng: -75.361555
                },
                {
                    lat: 2.609672,
                    lng: -75.361549
                },
                {
                    lat: 2.609675,
                    lng: -75.361529
                },
                {
                    lat: 2.609686,
                    lng: -75.361511
                },
                {
                    lat: 2.609662,
                    lng: -75.361491
                },
                {
                    lat: 2.609674,
                    lng: -75.361467
                },
                {
                    lat: 2.609662,
                    lng: -75.361450
                },
                {
                    lat: 2.609658,
                    lng: -75.361424
                },
                {
                    lat: 2.609666,
                    lng: -75.361398
                },
                {
                    lat: 2.609693,
                    lng: -75.361396
                },
                {
                    lat: 2.609707,
                    lng: -75.361375
                },
                {
                    lat: 2.609753,
                    lng: -75.361360
                },
                {
                    lat: 2.609808,
                    lng: -75.361376
                },
                {
                    lat: 2.609821,
                    lng: -75.361341
                },
                {
                    lat: 2.609834,
                    lng: -75.361342
                },
                {
                    lat: 2.609843,
                    lng: -75.361325
                },
                {
                    lat: 2.609867,
                    lng: -75.361336
                },
                {
                    lat: 2.609921,
                    lng: -75.361316
                },
                {
                    lat: 2.610018,
                    lng: -75.361294
                },
                {
                    lat: 2.610066,
                    lng: -75.361277
                },
                {
                    lat: 2.610094,
                    lng: -75.361263
                },
                {
                    lat: 2.610111,
                    lng: -75.361237
                },
                {
                    lat: 2.610127,
                    lng: -75.361260
                },
                {
                    lat: 2.610152,
                    lng: -75.361264
                },
                {
                    lat: 2.610178,
                    lng: -75.361259
                },
                {
                    lat: 2.610207,
                    lng: -75.361268
                },
                {
                    lat: 2.610331,
                    lng: -75.361223
                },
                {
                    lat: 2.610475,
                    lng: -75.361179
                },
                {
                    lat: 2.610699,
                    lng: -75.361119
                },
                {
                    lat: 2.611000,
                    lng: -75.361034
                },
                {
                    lat: 2.611140,
                    lng: -75.360994
                },
                {
                    lat: 2.611204,
                    lng: -75.360973
                },
                {
                    lat: 2.611223,
                    lng: -75.360938
                },
                {
                    lat: 2.611215,
                    lng: -75.360915
                },
                {
                    lat: 2.611174,
                    lng: -75.360917
                },
                {
                    lat: 2.611154,
                    lng: -75.360861
                },
                {
                    lat: 2.611128,
                    lng: -75.360746
                },
                {
                    lat: 2.611099,
                    lng: -75.360707
                },
                {
                    lat: 2.611114,
                    lng: -75.360652
                },
                {
                    lat: 2.611081,
                    lng: -75.360586
                },
                {
                    lat: 2.611057,
                    lng: -75.360577
                },
                {
                    lat: 2.611030,
                    lng: -75.360463
                },
                {
                    lat: 2.611033,
                    lng: -75.360366
                },
                {
                    lat: 2.611245,
                    lng: -75.360109
                },
                {
                    lat: 2.611419,
                    lng: -75.359928
                },
                {
                    lat: 2.611658,
                    lng: -75.359740
                },
                {
                    lat: 2.611583,
                    lng: -75.359591
                },
                {
                    lat: 2.611562,
                    lng: -75.359585
                },
                {
                    lat: 2.611530,
                    lng: -75.359542
                },
                {
                    lat: 2.611524,
                    lng: -75.359502
                },
                {
                    lat: 2.611509,
                    lng: -75.359498
                },
                {
                    lat: 2.611505,
                    lng: -75.359473
                },
                {
                    lat: 2.611431,
                    lng: -75.359376
                },
                {
                    lat: 2.611390,
                    lng: -75.359356
                },
                {
                    lat: 2.611374,
                    lng: -75.359322
                },
                {
                    lat: 2.611320,
                    lng: -75.359258
                },
                {
                    lat: 2.611293,
                    lng: -75.359204
                },
                {
                    lat: 2.611296,
                    lng: -75.359176
                },
                {
                    lat: 2.611269,
                    lng: -75.359128
                },
                {
                    lat: 2.611225,
                    lng: -75.359128
                },
                {
                    lat: 2.611192,
                    lng: -75.359068
                },
                {
                    lat: 2.611165,
                    lng: -75.359019
                },
                {
                    lat: 2.611152,
                    lng: -75.358968
                },
                {
                    lat: 2.611109,
                    lng: -75.358943
                },
                {
                    lat: 2.611087,
                    lng: -75.358913
                },
                {
                    lat: 2.611083,
                    lng: -75.358874
                },
                {
                    lat: 2.611059,
                    lng: -75.358854
                },
                {
                    lat: 2.611003,
                    lng: -75.358770
                },
                {
                    lat: 2.610973,
                    lng: -75.358708
                },
                {
                    lat: 2.610951,
                    lng: -75.358676
                },
                {
                    lat: 2.610909,
                    lng: -75.358641
                },
                {
                    lat: 2.610892,
                    lng: -75.358621
                },
                {
                    lat: 2.610875,
                    lng: -75.358596
                },
                {
                    lat: 2.610852,
                    lng: -75.358560
                },
                {
                    lat: 2.610815,
                    lng: -75.358530
                },
                {
                    lat: 2.610733,
                    lng: -75.358415
                },
                {
                    lat: 2.610669,
                    lng: -75.358308
                },
                {
                    lat: 2.610659,
                    lng: -75.358287
                },
                {
                    lat: 2.610667,
                    lng: -75.358253
                },
                {
                    lat: 2.610655,
                    lng: -75.358232
                },
                {
                    lat: 2.610624,
                    lng: -75.358231
                },
                {
                    lat: 2.610601,
                    lng: -75.358171
                },
                {
                    lat: 2.610597,
                    lng: -75.358137
                },
                {
                    lat: 2.610597,
                    lng: -75.358137
                },
                {
                    lat: 2.610565,
                    lng: -75.358122
                },
                {
                    lat: 2.610532,
                    lng: -75.358053
                },
                {
                    lat: 2.610375,
                    lng: -75.357880
                },
                {
                    lat: 2.610166,
                    lng: -75.357657
                },
                {
                    lat: 2.610130,
                    lng: -75.357551
                },
                {
                    lat: 2.610159,
                    lng: -75.357425
                },
                {
                    lat: 2.610323,
                    lng: -75.357347
                },
                {
                    lat: 2.610591,
                    lng: -75.357197
                },
                {
                    lat: 2.610665,
                    lng: -75.357134
                },
                {
                    lat: 2.610761,
                    lng: -75.357099
                },
                {
                    lat: 2.610817,
                    lng: -75.357163
                },
                {
                    lat: 2.610962,
                    lng: -75.357069
                },
                {
                    lat: 2.611006,
                    lng: -75.357008
                },
                {
                    lat: 2.611016,
                    lng: -75.356943
                },
                {
                    lat: 2.611001,
                    lng: -75.356909
                },
                {
                    lat: 2.611081,
                    lng: -75.356883
                },
                {
                    lat: 2.611146,
                    lng: -75.356816
                },
                {
                    lat: 2.611301,
                    lng: -75.356801
                },
                {
                    lat: 2.611417,
                    lng: -75.356815
                },
                {
                    lat: 2.611531,
                    lng: -75.356828
                },
                {
                    lat: 2.611782,
                    lng: -75.356817
                },
                {
                    lat: 2.611939,
                    lng: -75.356793
                },
                {
                    lat: 2.612006,
                    lng: -75.356805
                },
                {
                    lat: 2.612057,
                    lng: -75.356774
                },
                {
                    lat: 2.612120,
                    lng: -75.356739
                },
                {
                    lat: 2.612131,
                    lng: -75.356619
                },
                {
                    lat: 2.612240,
                    lng: -75.356626
                },
                {
                    lat: 2.612315,
                    lng: -75.356633
                },
                {
                    lat: 2.612437,
                    lng: -75.356637
                },
                {
                    lat: 2.612535,
                    lng: -75.356666
                },
                {
                    lat: 2.612680,
                    lng: -75.356707
                },
                {
                    lat: 2.612916,
                    lng: -75.356817
                },
                {
                    lat: 2.613313,
                    lng: -75.357089
                },
                {
                    lat: 2.613662,
                    lng: -75.357261
                },
                {
                    lat: 2.613779,
                    lng: -75.357296
                },
                {
                    lat: 2.614047,
                    lng: -75.357419
                },
                {
                    lat: 2.614102,
                    lng: -75.357499
                },
                {
                    lat: 2.614154,
                    lng: -75.357504
                },
                {
                    lat: 2.614201,
                    lng: -75.357551
                },
                {
                    lat: 2.614256,
                    lng: -75.357551
                },
                {
                    lat: 2.614355,
                    lng: -75.357620
                },
                {
                    lat: 2.614500,
                    lng: -75.357639
                },
                {
                    lat: 2.614572,
                    lng: -75.357675
                },
                {
                    lat: 2.614712,
                    lng: -75.357546
                },
                {
                    lat: 2.614764,
                    lng: -75.357578
                },
                {
                    lat: 2.614850,
                    lng: -75.357515
                },
                {
                    lat: 2.614806,
                    lng: -75.357722
                },
                {
                    lat: 2.614764,
                    lng: -75.357907
                },
                {
                    lat: 2.614733,
                    lng: -75.358072
                },
                {
                    lat: 2.614727,
                    lng: -75.358195
                },
                {
                    lat: 2.614734,
                    lng: -75.358273
                },
                {
                    lat: 2.614751,
                    lng: -75.358369
                },
                {
                    lat: 2.614788,
                    lng: -75.358479
                },
                {
                    lat: 2.614839,
                    lng: -75.358591
                },
                {
                    lat: 2.614921,
                    lng: -75.358724
                },
                {
                    lat: 2.615027,
                    lng: -75.358833
                },
                {
                    lat: 2.615163,
                    lng: -75.358926
                },
                {
                    lat: 2.615261,
                    lng: -75.358983
                },
                {
                    lat: 2.615377,
                    lng: -75.359046
                },
                {
                    lat: 2.615500,
                    lng: -75.359122
                },
                {
                    lat: 2.615591,
                    lng: -75.359171
                },
                {
                    lat: 2.615589,
                    lng: -75.359210
                },
                {
                    lat: 2.615625,
                    lng: -75.359237
                },
                {
                    lat: 2.615668,
                    lng: -75.359225
                },
                {
                    lat: 2.615704,
                    lng: -75.359249
                },
                {
                    lat: 2.615723,
                    lng: -75.359300
                },
                {
                    lat: 2.615946,
                    lng: -75.359411
                },
                {
                    lat: 2.616301,
                    lng: -75.359614
                },
                {
                    lat: 2.616649,
                    lng: -75.359814
                },
                {
                    lat: 2.616997,
                    lng: -75.360042
                },
                {
                    lat: 2.616338,
                    lng: -75.360747
                },
                {
                    lat: 2.615818,
                    lng: -75.361313
                },
                {
                    lat: 2.615239,
                    lng: -75.361930
                },
                {
                    lat: 2.614692,
                    lng: -75.362550
                },
                {
                    lat: 2.614221,
                    lng: -75.363059
                },
                {
                    lat: 2.613653,
                    lng: -75.363689
                },
                {
                    lat: 2.613851,
                    lng: -75.363603
                },
                {
                    lat: 2.614033,
                    lng: -75.363475
                },
                {
                    lat: 2.614269,
                    lng: -75.363512
                },
                {
                    lat: 2.614375,
                    lng: -75.363502
                },
                {
                    lat: 2.614498,
                    lng: -75.363439
                },
                {
                    lat: 2.614673,
                    lng: -75.363510
                },
                {
                    lat: 2.614818,
                    lng: -75.363562
                },
                {
                    lat: 2.614890,
                    lng: -75.363630
                },
                {
                    lat: 2.615041,
                    lng: -75.363588
                },
                {
                    lat: 2.615172,
                    lng: -75.363606
                },
                {
                    lat: 2.615234,
                    lng: -75.363615
                },
                {
                    lat: 2.615381,
                    lng: -75.363558
                },
                {
                    lat: 2.615514,
                    lng: -75.363551
                },
                {
                    lat: 2.615668,
                    lng: -75.363582
                },
                {
                    lat: 2.615815,
                    lng: -75.363653
                },
                {
                    lat: 2.615845,
                    lng: -75.363715
                },
                {
                    lat: 2.615936,
                    lng: -75.363753
                },
                {
                    lat: 2.616204,
                    lng: -75.363814
                },
                {
                    lat: 2.616334,
                    lng: -75.363879
                },
                {
                    lat: 2.616455,
                    lng: -75.363864
                },
                {
                    lat: 2.616585,
                    lng: -75.363823
                },
                {
                    lat: 2.616724,
                    lng: -75.363861
                },
                {
                    lat: 2.617017,
                    lng: -75.363927
                },
                {
                    lat: 2.617211,
                    lng: -75.364049
                },
                {
                    lat: 2.617643,
                    lng: -75.364127
                },
                {
                    lat: 2.617729,
                    lng: -75.364157
                },
                {
                    lat: 2.617763,
                    lng: -75.364208
                },
                {
                    lat: 2.617783,
                    lng: -75.364328
                },
                {
                    lat: 2.617971,
                    lng: -75.364488
                },
                {
                    lat: 2.618094,
                    lng: -75.364568
                },
                {
                    lat: 2.618201,
                    lng: -75.364627
                },
                {
                    lat: 2.618289,
                    lng: -75.364724
                },
                {
                    lat: 2.618418,
                    lng: -75.364796
                },
                {
                    lat: 2.618563,
                    lng: -75.364815
                },
                {
                    lat: 2.618765,
                    lng: -75.364961
                },
                {
                    lat: 2.619198,
                    lng: -75.365094
                },
                {
                    lat: 2.619348,
                    lng: -75.365157
                },
                {
                    lat: 2.619578,
                    lng: -75.365173
                },
                {
                    lat: 2.619811,
                    lng: -75.365271
                },
                {
                    lat: 2.620025,
                    lng: -75.365298
                },
                {
                    lat: 2.620128,
                    lng: -75.365343
                },
                {
                    lat: 2.620140,
                    lng: -75.365381
                },
                {
                    lat: 2.620413,
                    lng: -75.365432
                },
                {
                    lat: 2.620602,
                    lng: -75.365533
                },
                {
                    lat: 2.620729,
                    lng: -75.365669
                },
                {
                    lat: 2.620864,
                    lng: -75.365826
                },
                {
                    lat: 2.620918,
                    lng: -75.366388
                },
                {
                    lat: 2.621116,
                    lng: -75.366678
                },
                {
                    lat: 2.621456,
                    lng: -75.367036
                },
                {
                    lat: 2.621796,
                    lng: -75.367418
                },
                {
                    lat: 2.622072,
                    lng: -75.367815
                },
                {
                    lat: 2.622410,
                    lng: -75.368208
                },
                {
                    lat: 2.622584,
                    lng: -75.368351
                },
                {
                    lat: 2.622710,
                    lng: -75.368564
                },
            ];

            // Construcción del poligono antes de la carretera.
            const PolygonGeneral = new google.maps.Polygon({
                paths: CoordsGeneral,
                /* color de los bordes del area */
                strokeColor: "#E4FF01",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                /* color de adentro del area */
                /* fillColor: "#FF0000", */
                fillOpacity: 0.35,
            });
            PolygonGeneral.setMap(map);
            // Aqui empieza el Poligono despues de la carretera (POTRERO)
            // The location of Uluru
            const potrero = {
                lat: 2.625673,
                lng: -75.361339
            };

            //Inicio del Poligono del potrero 
            // The marker, positioned at Uluru
            const markerPotrero = new google.maps.Marker({
                position: {
                    lat: 2.625673,
                    lng: -75.361339
                },
                map: map,
                tittle: "Potrero CEFA",
            });

            // Nombre del Sena dentro del marcador
            const infoGeneralP = new google.maps.InfoWindow();
            infoGeneralP.setContent(
            '<div id="content">Centro de Formación Agroindustrial Sena "La Angostura"</div>'); // Aqui va el Nombre completo del Sena.
            markerPotrero.addListener("click", () => {
                infoGeneralP.open(map, markerPotrero);
            });

            // Define the LatLng coordinates for the polygon's path.
            const PoGeneral = [{
                    lat: 2.616481,
                    lng: -75.359606
                },
                {
                    lat: 2.616753,
                    lng: -75.359763
                },
                {
                    lat: 2.617707,
                    lng: -75.360326
                },
                {
                    lat: 2.618939,
                    lng: -75.361077
                },
                {
                    lat: 2.619497,
                    lng: -75.361442
                },
                {
                    lat: 2.620301,
                    lng: -75.362048
                },
                {
                    lat: 2.620815,
                    lng: -75.362445
                },
                {
                    lat: 2.622434,
                    lng: -75.362542
                },
                {
                    lat: 2.624384,
                    lng: -75.362638
                },
                {
                    lat: 2.626626,
                    lng: -75.362794
                },
                {
                    lat: 2.627141,
                    lng: -75.362852
                },
                {
                    lat: 2.627546,
                    lng: -75.362897
                },
                {
                    lat: 2.627540,
                    lng: -75.363002
                },
                {
                    lat: 2.628331,
                    lng: -75.363111
                },
                {
                    lat: 2.629100,
                    lng: -75.363198
                },
                {
                    lat: 2.629853,
                    lng: -75.363261
                },
                {
                    lat: 2.630102,
                    lng: -75.363269
                },
                {
                    lat: 2.630217,
                    lng: -75.363276
                },
                {
                    lat: 2.630182,
                    lng: -75.362963
                },
                {
                    lat: 2.630141,
                    lng: -75.362711
                },
                {
                    lat: 2.630037,
                    lng: -75.362341
                },
                {
                    lat: 2.629894,
                    lng: -75.361773
                },
                {
                    lat: 2.629720,
                    lng: -75.361035
                },
                {
                    lat: 2.629564,
                    lng: -75.360563
                },
                {
                    lat: 2.629248,
                    lng: -75.360440
                },
                {
                    lat: 2.629013,
                    lng: -75.360372
                },
                {
                    lat: 2.628772,
                    lng: -75.360290
                },
                {
                    lat: 2.628644,
                    lng: -75.360253
                },
                {
                    lat: 2.628564,
                    lng: -75.360238
                },
                {
                    lat: 2.628507,
                    lng: -75.360242
                },
                {
                    lat: 2.628444,
                    lng: -75.360222
                },
                {
                    lat: 2.628205,
                    lng: -75.360143
                },
                {
                    lat: 2.628031,
                    lng: -75.360122
                },
                {
                    lat: 2.627829,
                    lng: -75.360027
                },
                {
                    lat: 2.627586,
                    lng: -75.359920
                },
                {
                    lat: 2.627537,
                    lng: -75.359892
                },
                {
                    lat: 2.627430,
                    lng: -75.359935
                },
                {
                    lat: 2.627314,
                    lng: -75.359848
                },
                {
                    lat: 2.627249,
                    lng: -75.359806
                },
                {
                    lat: 2.626974,
                    lng: -75.359752
                },
                {
                    lat: 2.626758,
                    lng: -75.359725
                },
                {
                    lat: 2.626803,
                    lng: -75.359734
                },
                {
                    lat: 2.626606,
                    lng: -75.359674
                },
                {
                    lat: 2.626371,
                    lng: -75.359713
                },
                {
                    lat: 2.626023,
                    lng: -75.359665
                },
                {
                    lat: 2.625549,
                    lng: -75.359649
                },
                {
                    lat: 2.625088,
                    lng: -75.359669
                },
                {
                    lat: 2.624967,
                    lng: -75.359594
                },
                {
                    lat: 2.624842,
                    lng: -75.359594
                },
                {
                    lat: 2.624810,
                    lng: -75.359081
                },
                {
                    lat: 2.624677,
                    lng: -75.358474
                },
                {
                    lat: 2.624152,
                    lng: -75.358617
                },
                {
                    lat: 2.623619,
                    lng: -75.358931
                },
                {
                    lat: 2.622949,
                    lng: -75.359172
                },
                {
                    lat: 2.622378,
                    lng: -75.359228
                },
                {
                    lat: 2.621699,
                    lng: -75.359290
                },
                {
                    lat: 2.621059,
                    lng: -75.359341
                },
                {
                    lat: 2.620656,
                    lng: -75.359375
                },
                {
                    lat: 2.620379,
                    lng: -75.359362
                },
                {
                    lat: 2.619794,
                    lng: -75.359066
                },
                {
                    lat: 2.619111,
                    lng: -75.358738
                },
                {
                    lat: 2.618634,
                    lng: -75.359191
                },
                {
                    lat: 2.618186,
                    lng: -75.359178
                },
                {
                    lat: 2.618145,
                    lng: -75.359125
                },
                {
                    lat: 2.618068,
                    lng: -75.359147
                },
                {
                    lat: 2.618016,
                    lng: -75.359192
                },
            ];

            // Construccion del poligono despues de la carretera.
            const PolygonGeneralPotrero = new google.maps.Polygon({
                paths: PoGeneral,
                /* color de los bordes del area */
                strokeColor: "#E4FF01",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                /* color de adentro del area */
                /* fillColor: "#FF0000", */
                fillOpacity: 0.35,
            });
            PolygonGeneralPotrero.setMap(map);

        }
    </script>
@endsection
