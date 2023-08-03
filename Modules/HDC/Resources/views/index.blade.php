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
<div class="col-auto d-none d-lg-block">
  <img src="{!! asset('HDC/img/huella-de-carbono.jpg') !!}" width="190px" height="270px" class="card-img-top" alt="......">
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
