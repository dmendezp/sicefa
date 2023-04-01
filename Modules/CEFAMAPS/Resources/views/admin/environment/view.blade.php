@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-school-flag"></i> {{ trans('cefamaps::menu.Polyvalent') }}</a></li>

@endsection

@section('style')
	<style>
    .card-content {
      position: relative;
      display: inline-block;
      width: 250px; /* Largo */
      height: 200px; /* Ancho */
      overflow: hidden;
    }

    .card-content .button-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      width: 100%;
      opacity: 0;
      transition: opacity 0.2s ease-in-out;
    }

    .card-content:hover .button-container {
      opacity: 1;
    }

    .card-content .button-container button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }

    .card-content .image-container {
      position: relative;
    }

    .card-content .image {
      display: block;
      width: 100%;
      height: auto;
      transition: transform 0.2s ease-in-out;
    }

    .card-content:hover .image {
      transform: scale(1.1);
    }

    .card-content .image-container .image-text {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 5px;
    }

    .card-content .image-container .image-text p {
      margin: 0;
    }

    .card-content .image {
      display: none;
    }

    .card-content:not(:hover) .image {
      display: block;
    }
	</style>
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
          <h4 class="modal-title">{{trans('cefamaps::page.Page')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover" colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
          </button>
        </div>
        @foreach($pages as $p)
        <div class="modal-body">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal{{$p->id}}">{{$p->name}}</button>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Fin El modal para que aparezacan todas la paginas -->

  <!-- Inicio El modal para mostrar la pagina -->
  <div class="modal fade" id="modal{{$p->id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{$p->name}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover" colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
          </button>
        </div>
        @foreach($pages as $p)
        <div class="modal-body">
          <p>{{!! $p->content !!}}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Fin El modal para mostrar la pagina -->

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
      @foreach($viewenviron as $e)

      // The marker, positioned at Uluru
      const marker{{$e->id}} = new google.maps.Marker({
        position: { lat: {{$e->latitude}},  lng: {{$e->length}} },
        map: map,
        tittle: "{{$e->name}}",
      });
        
      const infoCultivo{{$e->id}} = new google.maps.InfoWindow();

      infoCultivo{{$e->id}}.setContent(
        '<div class="card-content">' +
          '<div class="button-container">' +
            '<h2>{{trans("cefamaps::page.Page")}}</h2>' +
            '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">{{$e->id}}</button>' +
          '</div>' +
          '<div class="image-container">' +
            '<img src="{{ asset("cefamaps/images/uploads/".$e->picture) }}" alt="Imagen de la tarjeta" class="image">' +
            '<div class="image-text">' +
              '<p>{{$e->description}}</p>' +
            '</div>' +
          '</div>' +
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
