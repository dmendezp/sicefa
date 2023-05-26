@extends('cefamaps::layouts.master')

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h5 class="m-0">{{ trans('cefamaps::menu.Overview map') }}</h5>
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
  Swal.fire({
    html:
    "<div class='estrella'></div>" +
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
    const adsi = { lat: 2.61265158990476, lng: -75.36091880830087 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15, /* El zoom del mapa */
      center: adsi,
      mapTypeId: 'satellite' /* El tipo de mapa */
    });

    // para el icono
    var iconBase = '{{ asset("sica/favicon.ico") }}';

    // The marker, positioned at Uluru
    const markerGeneral = new google.maps.Marker({
      position: { lat: 2.612165, lng: -75.361426 },
      map: map,
      tittle: "General CEFA",
      icon: iconBase,
    });

    markerGeneral.addListener("click", () => {
      infoGeneral.open(map, markerGeneral);
    });

    // Define the LatLng coordinates for the polygon's path.
    const CoordsGeneral = [
      { lat: 2.606621, lng: -75.363508 },
      { lat: 2.612202, lng: -75.363501 },
      { lat: 2.613634, lng: -75.363694 },
      { lat: 2.613733, lng: -75.363703 },
      { lat: 2.614021, lng: -75.363476 },
      { lat: 2.614151, lng: -75.363466 },
      { lat: 2.614289, lng: -75.363521 },
      { lat: 2.614365, lng: -75.363512 },
      { lat: 2.614491, lng: -75.363438 },
      { lat: 2.614814, lng: -75.363566 },
      { lat: 2.614878, lng: -75.363612 },
      { lat: 2.614946, lng: -75.363617 },
      { lat: 2.615057, lng: -75.363585 },
      { lat: 2.615144, lng: -75.363589 },
      { lat: 2.615178, lng: -75.363608 },
      { lat: 2.615246, lng: -75.363606 },
      { lat: 2.615344, lng: -75.363583 },
      { lat: 2.615395, lng: -75.363549 },
      { lat: 2.615624, lng: -75.363572 },
      { lat: 2.615809, lng: -75.363636 },
      { lat: 2.615816, lng: -75.363687 },
      { lat: 2.618133, lng: -75.360720 },
      { lat: 2.616547, lng: -75.359769 },
      { lat: 2.615155, lng: -75.358997 },
      { lat: 2.614501, lng: -75.358717 },
      { lat: 2.612047, lng: -75.357666 },
      { lat: 2.611102, lng: -75.357799 },
      { lat: 2.610682, lng: -75.357742 },
      { lat: 2.610405, lng: -75.357866 },
      { lat: 2.609920, lng: -75.357997 },
      { lat: 2.609535, lng: -75.357956 },
      { lat: 2.609313, lng: -75.358052 },
      { lat: 2.608706, lng: -75.358629 },
      { lat: 2.608109, lng: -75.358812 },
      { lat: 2.607562, lng: -75.359222 },
      { lat: 2.607487, lng: -75.359399 },
      { lat: 2.607578, lng: -75.359850 },
      { lat: 2.607557, lng: -75.360002 },
      { lat: 2.606799, lng: -75.360229 },
      { lat: 2.606642, lng: -75.360442 },
      { lat: 2.606657, lng: -75.360635 },
      { lat: 2.607416, lng: -75.362194 },
      { lat: 2.607431, lng: -75.362366 },
      { lat: 2.606738, lng: -75.362559 },
      { lat: 2.606490, lng: -75.362802 },
      { lat: 2.606116, lng: -75.362979 },
      { lat: 2.606146, lng: -75.363303 },
      { lat: 2.606404, lng: -75.363394 },
    ];
      
    // Construct the polygon.
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

  }

</script>

@endsection
