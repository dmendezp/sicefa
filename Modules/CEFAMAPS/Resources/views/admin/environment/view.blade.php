@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school-flag"></i> {{ trans('cefamaps::menu.Polyvalent') }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::environment.Environment') }} - {{ trans('cefamaps::menu.Polyvalent') }}</h3>
            </div>
            <div class="card-body">
              <div class="row align-items-start">
                <form>
                  <select name="environment_classroom" class="form-control select2" onchange="this.form.submit()">
                    <option value="">Selecciona un usuario</option>
                    @foreach ($environ as $user)
                      <option value="{{ $user->id }}" {{ $user->id == request('environment_classroom') ? 'selected' : '' }}>
                        {{ $user->environment_classroom }}
                      </option>
                    @endforeach
                  </select>
                </form>
                <div id="map"></div>
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

    // Inicio poligono
    @if($selectedUser)

    // The marker, positioned at Uluru
    const marker{{$selectedUser->id}} = new google.maps.Marker({
      position: { lat: {{$selectedUser->latitude}},  lng: {{$selectedUser->length}} },
      map: map,
      tittle: "{{$selectedUser->name}}",
    });
      
    const infoCultivo{{$selectedUser->id}} = new google.maps.InfoWindow();

    infoCultivo{{$selectedUser->id}}.setContent(
      '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h2 id="firstHeading" class="firstHeading">{{$selectedUser->name}}</h2>'+
        '<div id="bodyContent">'+
          '<img src="{{ asset("cefamaps/images/uploads/".$selectedUser->picture) }}" width="100">'+
          '<p>{{$selectedUser->description}}</p>'+
          '<a href="{{ url("/cefamaps/environment/view/".$selectedUser->id) }}">Link para {{$selectedUser->name}}</a>'+
        '</div>'+
      '</div>'
    );

    marker{{$selectedUser->id}}.addListener("click", () => {
      infoCultivo{{$selectedUser->id}}.open(map, marker{{$selectedUser->id}});
    });

    // Define the LatLng coordinates for the polygon's path.
    const Coords{{$selectedUser->id}} = [
      @foreach($selectedUser->coordinates as $c)
        { lat: {{$c->latitude}}, lng: {{$c->length}} },
      @endforeach
    ];
      
    // Construct the polygon.
    const Polygon{{$selectedUser->id}} = new google.maps.Polygon({
      paths: Coords{{$selectedUser->id}},
      // color de los bordes del area
      strokeColor: "#076EF1",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      // color de adentro del area
      fillColor: "#FF0000",
      fillOpacity: 0.35,
    });
    Polygon{{$selectedUser->id}}.setMap(map);

    @endif
    // Fin del poligono

  }

</script>

@endsection
