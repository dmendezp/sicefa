@extends('dicsena::layouts.master')

@section('content')

<div class="container mt-3">
  <span class="border border-danger"></span>
  <div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card text-center">
        <div class="card-body">
          <a href="{{ route ('cefa.dicsena.guidepost.index')}}">
            <i class="fas fa-upload fa-3x"></i>
            <p>Subir Guias</p>
          </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card text-center">
        <div class="card-body">
          <a href="{{route ('cefa.dicsena.glossary.index')}}">
            <i class="fas fa-plus fa-3x"></i>
            <p>Agregar Palabras</p>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection('content')