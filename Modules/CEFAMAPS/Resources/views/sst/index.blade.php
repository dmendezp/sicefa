@extends('cefamaps::layouts.master')

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card card-lightblue card-outline">
              <div class="card-header">
                <h5 class="m-0">Vista para SST</h5>
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

    // Inicio poligono
    @foreach($environ as $e)

    // The marker, positioned at Uluru
    const marker{{$e->id}} = new google.maps.Marker({
      position: { lat: {{$e->latitude}},  lng: {{$e->length}} },
      map: map,
      tittle: "{{$e->name}}",
    });
      
    const infoCultivo{{$e->id}} = new google.maps.InfoWindow();

    infoCultivo{{$e->id}}.setContent(
      '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h2 id="firstHeading" class="firstHeading">{{$e->name}}</h2>'+
        '<div id="bodyContent">'+
          '<img src="{{ asset("cefamaps/images/uploads/".$e->picture) }}" width="100">'+
          '<p>{{$e->description}}</p>'+
          '<a href="{{ url("/cefamaps/environment/view/".$e->id) }}">Link para {{$e->name}}</a>'+
        '</div>'+
      '</div>'
    );

    marker{{$e->id}}.addListener("click", () => {
      infoCultivo{{$e->id}}.open(map, marker{{$e->id}});
    });

    // Define the LatLng coordinates for the polygon's path.
    const Coords{{$e->id}} = [
      @foreach($e->coordinates as $c)
        { lat: {{$c->latitude}}, lng: {{$c->length}} },
      @endforeach
    ];
      
    // Construct the polygon.
    const Polygon{{$e->id}} = new google.maps.Polygon({
      paths: Coords{{$e->id}},
      // color de los bordes del area
      strokeColor: "#076EF1",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      // color de adentro del area
      fillColor: "#FF0000",
      fillOpacity: 0.35,
    });
    Polygon{{$e->id}}.setMap(map);

    @endforeach
    // Fin del poligono

  }

</script>


@endsection