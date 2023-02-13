@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><img src="{{ asset('cefamaps/images/uploads/'.$viewenviron->picture) }}" width="25" height="25"> {{ $viewenviron->name }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::environment.Environment') }} - {{ $viewenviron->name }}</h3>
            </div>
            <div class="card-body">
              <div class="row align-items-start">
                <div class="col">
                  <div class="map"></div>
                </div>
                <div class="col">
                  <h1>{{ $viewenviron->description }}</h1>
                <br>
                <h1>{{ $viewenviron->productive_units_id }}</h1>
                <br>
                <h1>{{ $viewenviron->farms_id }}</h1>
                <br>
                <h1>{{ $viewenviron->type_environment }}</h1>
                <br>
                  <h1>{{ trans('cefamaps::environment.Length') }}: {{ $viewenviron->length }}</h1>
                  <br>
                  <h1>{{ trans('cefamaps::environment.Latitude') }}: {{ $viewenviron->latitude }}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>

// Initialize and add the map
function initMap() {
    // The location of Uluru
    const adsi = { lat: 2.61265158990476, lng: -75.36091880830087 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 16,
      center: adsi,
      mapTypeId: 'satellite'
    });

    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: { lat: 2.613891,  lng: -75.360120 },
      map: map,
      tittle: "Cultivo de arroz",
    });
      
    const infoCultivo = new google.maps.InfoWindow();

    infoCultivo.setContent(
      '<div id="content">' +
      '<div id="siteNotice">' +
      "</div>" +
      '<h2 id="firstHeading" class="firstHeading">CULTIVO ARROZ</h2>' +
      '<div id="bodyContent">' +
      "<img src='{{ asset('cefamaps/images/arroz.png') }}' alt=''>"+
      "<p>El arroz se cultiva en una tierra que se inunda, ya sea con lluvia o con riego. La profundidad del agua varía de 2 a 20 pulgadas (5 a 50 cm). Arroz flotante y de aguas profundas. El arroz se cultiva en tierras altamente inundadas..</p>" +
      '<p>Link de Cultivo de Arroz  <a href="https://es.wikipedia.org/wiki/Cultivo_del_arroz">' +
      "https://es.wikipedia.org/wiki/Cultivo_del_arroz</a> " +
      "(last visited June 22, 2009).</p>" +
      "</div>" +
      "</div>"
    );

    marker.addListener("click", () => {
      infoCultivo.open(map, marker);
    });

    // Define the LatLng coordinates for the polygon's path.
    const RiceCoords = [
        { lat: 2.615338242089692, lng: -75.35958189511987 },
        { lat: 2.614780913733905, lng: -75.3608450021222 },
        { lat: 2.6128998814079414, lng: -75.3612152397913 },
        { lat: 2.6126343748683656, lng: -75.36030494639445 },
        { lat: 2.612836214517401, lng: -75.35913218489162 },
        { lat: 2.615338242089692, lng: -75.35958189511987 },
      ];

      // Coordenadas de lote de piscicultura
      const PisCoords = [    
        { lat: 2.612299, lng: -75.361779 },
        { lat: 2.612616, lng: -75.361693 },
        { lat: 2.612639, lng: -75.361787 },
        { lat: 2.612341, lng: -75.361902 },
        { lat: 2.612299, lng: -75.361779 },
      ];

      // Coordenadas de lote de arroz 2
      const Rice2Coords = [    
        { lat: 2.612886, lng: -75.359148 },
        { lat: 2.615346, lng: -75.359567 },
        { lat: 2.615530, lng: -75.359193 },
        { lat: 2.613165, lng: -75.358139 },
        { lat: 2.612894, lng: -75.359118 },
      ];
      
      // Construct the polygon.
      const RicePolygon = new google.maps.Polygon({
        paths: RiceCoords,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
      });
      RicePolygon.setMap(map);

      // Construct the polygon.
      const PisPolygon = new google.maps.Polygon({
        paths: PisCoords,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
      });
      PisPolygon.setMap(map);

     // Construct the polygon.
     const Rice2Polygon = new google.maps.Polygon({
        paths: Rice2Coords,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
      });
      Rice2Polygon.setMap(map);

  }
</script>

@endsection
