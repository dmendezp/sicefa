@extends('cefamaps::layouts.master')

@foreach ($viewenvironments as $v)
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-city"></i>
                {{ trans('cefamaps::environment.Breadcrumb_Active_Environment') }}</a></li>
        <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school"></i>
                {{ $v->class_environment->name }}</a></li>
    @endsection
@endforeach

@section('style')
    <link rel="stylesheet" href="{{ asset('modules/cefamaps/css/viewenviron.css') }}">
@endsection

@foreach ($viewenvironments as $v)
    @section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-lightblue card-outline">
                            @foreach ($unit as $un)
                            <div class="card-header">
                                <h3 class="m-0">Ver Ambientes de : <em>{{ $un->name }}</em></h3>
                            </div>
                            @endforeach
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inicio El modal para que aparezacan todas la paginas -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ trans('cefamaps::page.Page') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover"
                                colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-start">
                            @foreach ($v->pages as $p)
                                <div class="col-4">
                                    <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal"
                                        data-target="#modal{{ $p->id }}">{{ $p->name }}</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin El modal para que aparezacan todas la paginas -->

        <!-- Inicio El modal para mostrar la pagina -->
        @foreach ($v->pages as $p)
            <div class="modal fade" id="modal{{ $p->id }}">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $p->name }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover"
                                    colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>{!! $p->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Fin El modal para mostrar la pagina -->
    @endsection
@endforeach

@section('script')
    <script>
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

            var iconBase = '{{ asset('modules/cefamaps/images/bank.png') }}';

            // Inicio poligono
            @foreach ($viewenvironments as $e)

                @if ($e->type_environment === 'EvacuationRoute')
                    // Dibujar una línea para la ruta de evacuación
                    const path{{ $e->id }} = [
                        @foreach ($e->coordinates as $c)
                            { lat: {{ $c->latitude }}, lng: {{ $c->length }} },
                        @endforeach
                    ];
                    const line{{ $e->id }} = new google.maps.Polyline({
                        path: path{{ $e->id }},
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    line{{ $e->id }}.setMap(map);
                @else
                    // Dibujar un polígono para otros tipos de entornos
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
                @endif

                // Agregar marcadores comunes para todos los entornos
                const marker{{ $e->id }} = new google.maps.Marker({
                    position: {
                        lat: {{ $e->latitude }},
                        lng: {{ $e->length }}
                    },
                    map: map,
                    title: "{{ $e->name }}",
                    icon: iconBase,
                });

                const infoCultivo{{ $e->id }} = new google.maps.InfoWindow();

                infoCultivo{{ $e->id }}.setContent(
                    '<div class="card-content">' +
                    '<div class="button-container">' +
                    '<h2>{{ trans('cefamaps::page.Page') }}</h2>' +
                    '<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#modal-lg">{{ $e->name }}</button>' +
                    '</div>' +
                    '<div class="image-container">' +
                    '<img src="{{ asset('modules/cefamaps/images/uploads/' . $e->picture) }}" alt="Imagen de la tarjeta" class="image">' +
                    '<div class="image-text">' +
                    '<p>{{ $e->description }}</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                marker{{ $e->id }}.addListener("click", () => {
                    infoCultivo{{ $e->id }}.open(map, marker{{ $e->id }});
                });

            @endforeach
            // Fin del poligono
        }
    </script>
@endsection
