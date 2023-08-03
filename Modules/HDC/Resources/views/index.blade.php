@extends('hdc::layouts.master')

@section('content')
<br>
<center><h1>Bienvenido a HDC</h1></center>
<center><h6>(HUELLA DE CARBONO)</h6></center>
<br>
<center><h1>¿Que Es Huella de Carbono?</h1></center>
<pre><h5>Huella de carbono es un termino que se utiliza para medir la cantidad de emisiones de gases efecto invernadero (GEI), 
principalmente el dioxido de carbono (CO2)que son liberadas a la atmósfera debido a las actividades humanas,
como la quema de combustibles fósiles, la deforestación y la producción industrial.
</h5>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{!! asset('modules/HDC/img/huella-de-carbono.jpg') !!}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{!! asset('modules/HDC/img/Auto.jpg') !!}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{!! asset('modules/HDC/img/Planeta-verde.jpg') !!}" class="d-block w-200" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<center><h1>MISION</h1></center>
<main class="container">  
    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">Grafica Mensual</h3>
            <br>

          <div class="col-auto d-none d-lg-block">
            <img src="{!! asset('HDC/img/descarga.png') !!}"width="200px" height="250px" class="card-img-top" alt="...">
          </div>
        </div>
      </div>
@endsection
