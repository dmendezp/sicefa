@extends('dicsena::layouts.master')

@section('content')
<div class="navbar">
    <a class="navbar-brand" href="#">
    <i class="fas fa-globe"></i> DICSENA
    </a>
    <span class="title">Panel</span>
    <a class="button" href="{{ route ('cefa.dicsena.home.index')}}">Logout</a>
</div>

<div class="card-container">
<div class="card blue-border">
    <div class="bg"></div>
    <div class="blob"></div>
    <a href="{{ route ('cefa.dicsena.guidepost.index')}}">
      <i class="fas fa-upload fa-3x"></i> 
      <p>Subir Guias</p>
    </a>
  </div>

  <div class="card red-border">
    <div class="bg"></div>
    <div class="blob"></div>
    <a href="{{route ('cefa.dicsena.glossary.index')}}">
      <i class="fas fa-plus fa-3x"></i> 
      <p>Agregar Palabras</p>
    </a>
  </div>
</div>

</div>
<script>
$(document).ready(function() {
  $(".card").click(function() {
    $(this).toggleClass("clicked");
  });
});
</script>
@endsection('content')