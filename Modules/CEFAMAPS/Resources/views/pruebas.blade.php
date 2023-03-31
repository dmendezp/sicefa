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
            
            <form>
              <select name="environments_id" onchange="this.form.submit()">
                <option value="">Selecciona un usuario</option>
                  @foreach ($class as $user)
                    <option value="{{ $user->id }}" {{ $user->id == request('environments_id') ? 'selected' : '' }}>
                      {{ $user->environment_classroom }}
                    </option>
                  @endforeach
              </select>
            </form>
            <!-- <div id="mapa"></div> -->
            @if ($selectedUser)
              <div>{{ $selectedUser->id }} - {{ $selectedUser->length }} - {{ $selectedUser->latitude }} - {{ $selectedUser->environment_classroom }}</div>
            @endif
            
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
    @if ($selectedUser)

    // The marker, positioned at Uluru
    const marker{{$selectedUser->id}} = new google.maps.Marker({
      position: { lat: {{$selectedUser->latitude}},  lng: {{$selectedUser->length}} },
      map: map,
      tittle: "{{$selectedUser->name}}",
    });
      
    // Construct the polygon.
    const Polygon{{$selectedUser->id}} = new google.maps.Polygon({
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
