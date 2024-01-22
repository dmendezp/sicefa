@extends('cefamaps::layouts.master')

@section('style')
    <style>
        body {
            color: green;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-fire-extinguisher"></i> {{ trans('cefamaps::sst.Breadcrumb_SST') }}</a>
    </li>
@endsection

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('cefamaps\images\SST\seguridad4.jpg') }}" style="width: 1250px; height: 650px">
                <div class="carousel-caption d-none d-md-block">
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- /.col-md-6 -->
                            <div class="col-lg-12">
                                <div class="card card-lightblue card-outline">
                                    <div class="card-header">
                                        <h5 class="m-0">{{ trans('cefamaps::sst.Title_Card_SST') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="map"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('cefamaps\images\SST\seguridad3.jpg') }}" style="width: 1200px; height: 650px">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('cefamaps\images\SST\seguridad4.jpg') }}" style="width: 1200px; height: 650px">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <br>

        <p class="card-text">{{ trans('cefamaps::sst.Title_Card_Info') }}</p>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/HQTVF9P2R7o"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <br>
                <div class="col-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/OagpAw4zY3c"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.carousel').carousel();
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
                zoom: 16,
                center: adsi,
                mapTypeId: 'satellite'
            });

            // Inicio poligono
            @foreach ($environ as $e)

                // The marker, positioned at Uluru
                const marker{{ $e->id }} = new google.maps.Marker({
                    position: {
                        lat: {{ $e->latitude }},
                        lng: {{ $e->length }}
                    },
                    map: map,
                    tittle: "{{ $e->name }}",
                });

                const infoCultivo{{ $e->id }} = new google.maps.InfoWindow();

                infoCultivo{{ $e->id }}.setContent(
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h2 id="firstHeading" class="firstHeading">{{ $e->name }}</h2>' +
                    '<div id="bodyContent">' +
                    '<img src="{{ asset('cefamaps/images/uploads/' . $e->picture) }}" width="100">' +
                    '<p>{{ $e->description }}</p>' +
                    '<a href="{{ url('/cefamaps/environment/view/' . $e->id) }}">Link para {{ $e->name }}</a>' +
                    '</div>' +
                    '</div>'
                );

                marker{{ $e->id }}.addListener("click", () => {
                    infoCultivo{{ $e->id }}.open(map, marker{{ $e->id }});
                });

                // Define the LatLng coordinates for the polygon's path.
                const Coords{{ $e->id }} = [
                    @foreach ($e->coordinates as $c)
                        {
                            lat: {{ $c->latitude }},
                            lng: {{ $c->length }}
                        },
                    @endforeach
                ];

                // Construct the polygon.
                const Polygon{{ $e->id }} = new google.maps.Polygon({
                    paths: Coords{{ $e->id }},
                    // color de los bordes del area
                    strokeColor: "#076EF1",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    // color de adentro del area
                    fillColor: "#FF0000",
                    fillOpacity: 0.35,
                });
                Polygon{{ $e->id }}.setMap(map);
            @endforeach
            // Fin del poligono
        }
    </script>
@endsection
