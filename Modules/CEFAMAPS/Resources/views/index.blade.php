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
        position: adsi,
        map: map,
        tittle: "Cultivo de arroz",
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
    }
</script>

@endsection
