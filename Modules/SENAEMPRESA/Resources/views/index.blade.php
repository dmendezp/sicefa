@extends('senaempresa::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('senaempresa.name') !!}
    </p>

    <div id="carouselExampleControls"  class="carousel slide " data-ride="carousel">
  <div class="carousel-inner " style="width:95%; height:50%; padding-left:4%; ">
    <div class="carousel-item active">
      <img class="d-block" src="{{ asset('AdminLTE/dist/img/logo P SENA.png')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block " src="{{ asset('senaempresa/images/chosa.jpg')}}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block "  src="{{ asset('senaempresa/images/Aviso Modelo Final.jpg')}}" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


@endsection
