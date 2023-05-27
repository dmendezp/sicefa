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
<script>


function initMap() {
  const cefa = { lat: 2.612440, lng: -75.361158 };
  const map = new google.maps.Map(document.getElementById("map"), {
    scaleControl: true,
    center: cefa,
    zoom: 17,
    mapTypeId: 'satellite',
  });

  const marker = new google.maps.Marker({ 
    map, 
    position: cefa,
    title: "Cancha del CEFA",
  });

  const markercow = new google.maps.Marker({ 
    map, 
    position: { lat: 2.612115, lng: -75.360714 },
    icon: "{{ asset('cefamaps/images/cow.png') }}",
    title: "Cancha del CEFA",
  });

  const infoCancha = new google.maps.InfoWindow();

  infoCancha.setContent(
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h2 id="firstHeading" class="firstHeading">CANCHA DEL CEFA</h2>' +
    '<div id="bodyContent">' +
    "<h4> SUBTITULO</h4>"+
    "<img src='{{ asset('cefamaps/images/casona.jpg') }}' alt=''>"+
    "<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Sit, magni, officia! Doloribus alias sequi accusamus dignissimos. Blanditiis suscipit, architecto, culpa tempore veniam dignissimos, natus, eligendi tenetur in dolore laudantium voluptatibus.</p>" +
    '<p>Link de Neythan <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
    "https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
    "(last visited June 22, 2009).</p>" +
    "</div>" +
    "</div>");

  const infoCow = new google.maps.InfoWindow();

    infoCow.setContent(
    '<div id="content">COW</div>');

  marker.addListener("click", () => {
    infoCancha.open(map, marker);
  });

  markercow.addListener("click", () => {
    infoCow.open(map, markercow);
  });

  const canchaCoords = [
    { lat: 2.612305, lng: -75.361261 },
    { lat: 2.612609, lng: -75.361207 },
    { lat: 2.612562, lng: -75.361042 },
    { lat: 2.612272, lng: -75.361083 },
  ];
  // Construct the polygon.
  const cancha = new google.maps.Polygon({
    paths: canchaCoords,
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: "#FF0000",
    fillOpacity: 0.35,
  });

  cancha.setMap(map);

}

window.initMap = initMap;
</script>

@endsection