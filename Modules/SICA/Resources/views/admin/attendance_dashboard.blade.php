@extends('sica::layouts.master')

@section('content')

<div class="content">
  <div class="container-fluid">

    <h3>Registros</h3>
    <div class="mtop16">
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">{{ number_format($people,0,",",".") }}</span>
        <i class="fas fa-users"></i> Personas
      </a>
      <a class="btn btn-app  btn-app-2">
        <span class="badge bg-info">{{ number_format($apprentices,0,",",".") }}</span>
        <i class="fas fa-user-graduate"></i> Aprendices
      </a>
      <a class="btn btn-app  btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-chalkboard-teacher"></i> Instructores
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-user-tie"></i> Administrativos
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">{{ number_format($courses,0,",",".") }}</span>
        <i class="fas fa-graduation-cap"></i> Cursos
      </a>
      <a class="btn btn-app btn-app-2">
        <span class="badge bg-info">0</span>
        <i class="fas fa-map-marked-alt"></i> Ambientes
      </a>

    </div>

    <h3>Resumen</h3>
    <div class="mtop16">
      <p>Tablas o graficas por evento, tipo persona, población</p>
    </div>
  </div>
</div>
@endsection
