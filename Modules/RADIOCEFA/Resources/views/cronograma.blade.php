@extends('radiocefa::layouts.master')

 @section('textHero')
  <h1>Cronograma</h1>
  <h2><p>Programate en tu dia con nuestras secciones</p></h2>
@endsection
@include('radiocefa::layouts/partials/hero')

@include('radiocefa::layouts/partials/navbar')

@section('content')

<div class="details-hours">
<div class="program">
<img height="150" width="150" src="#" alt="Imagen de El Gallo">
<div class="info">
<span class="hour">De 05:00 a 11:00</span>
<h3 class="title">El Gallo</h3>
<span class="subtitle text-capitalize">Pacho Cardona; Alex Champion Rodríguez; Diego Peña; Juliana Casali</span>
</div>
</div>
</div>
@endsection