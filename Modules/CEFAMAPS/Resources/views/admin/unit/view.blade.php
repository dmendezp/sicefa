@extends('cefamaps::layouts.master')

@foreach($viewunit as $u) 
  @section('breadcrumb')  

    <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Units') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas {{ $u->productive_units->icon }}"></i> {{ $u->productive_units->name }}</a></li>
    
  @endsection
@endforeach

<!--estos cosas siempren van hay, solo cambia el href por si necesitas agregar css en la vista-->
@section('style')
	<link rel="stylesheet" href="{{ asset('cefamaps/css/viewenviron.css') }}">
  <!--este link es para que la carta se mueva, este es el css, asi que puede usar este o para que no se complique puede usar otro y pegarlo hay sin miedo
  esta es la ruta que se necesita para poder ingresar, donde esta eso en public y mas todo eso-->
@endsection
<!-- con esto puede hacer lo del css -->

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::unit.Unit') }} - </h3>
            </div>
            <div class="card-body">
              <div id="map"></div>
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
        <!--aqui es donde tiene que mirar eso, porque al darle al boton el me saca a este modal y depsues me entra al otro modal de abajo-->
      </div>
    </div>
  </div>
  <!-- Fin El modal para que aparezacan todas la paginas -->

  <!-- Inicio El modal para mostrar la pagina -->
  @foreach($pages as $p)
    <div class="modal fade" id="modal{{$p->id}}">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{$p->name}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover" colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
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
      @foreach($viewunit as $u)

      var iconBase = '{{ asset("cefamaps/images/cow.png") }}';

      // The marker, positioned at Uluru
      const marker{{$u->id}} = new google.maps.Marker({
        position: { lat: {{$u->latitude}},  lng: {{$u->length}} },
        map: map,
        tittle: "{{$u->name}}",
        icon: iconBase, /* Para poder tener un icono diferente */
      });
        
      const infoCultivo{{$u->id}} = new google.maps.InfoWindow();

      infoCultivo{{$u->id}}.setContent(
        '<div class="card-content">' +
          '<div class="button-container">' +
            '<h2>{{trans("cefamaps::page.Page")}}</h2>' +
            '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">{{$u->id}}</button>' +
          '</div>' +
          '<div class="image-container">' +
            '<img src="{{ asset("cefamaps/images/uploads/".$u->picture) }}" alt="Imagen de la tarjeta" class="image">' +
            '<div class="image-text">' +
              '<p>{{$u->description}}</p>' +
            '</div>' +
          '</div>' +
        '</div>'
      );

      marker{{$u->id}}.addListener("click", () => {
        infoCultivo{{$u->id}}.open(map, marker{{$u->id}});
      });

      // Define the LatLng coordinates for the polygon's path.
      const Coords{{$u->id}} = [
        @foreach($u->coordinates as $c)
          { lat: {{$u->latitude}}, lng: {{$u->length}} },
        @endforeach
      ];
        
      // Construct the polygon.
      const Polygon{{$u->id}} = new google.maps.Polygon({
        paths: Coords{{$u->id}},
        // color de los bordes del area
        strokeColor: "#076EF1",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        // color de adentro del area
        fillColor: "#FF0000",
        fillOpacity: 0.35,
      });
      Polygon{{$u->id}}.setMap(map);

      @endforeach
      // Fin del poligono

    }

  </script>

@endsection