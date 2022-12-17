@extends('cefamaps::layouts.master')

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h5 class="m-0">Mapa General</h5>
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
@endsection
@section('script')

<script type="text/javascript">
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
      "</div>");

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
