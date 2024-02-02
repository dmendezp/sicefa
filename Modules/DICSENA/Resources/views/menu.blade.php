@extends('dicsena::layouts.master')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  @include('dicsena::layouts.partials.navbar')
</nav>

<div class="container mt-1" style="display: flex; justify-content: center; align-items: center;">
  <div class="row" style="width: 100%;">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card text-center" style="box-shadow: 0 0 90px rgba(70,130,180,0.5); margin: 100px;">
        <div class="card-body">
          <a href="{{ route ('dicsena.instructor.guidepost.index')}}">
            <i class="fas fa-upload fa-3x"></i>
            <p>Upload Guides</p>
          </a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card text-center" style="box-shadow: 0 0 90px rgba(70,130,180,0.5); margin: 100px;">
        <div class="card-body">
          <a href="{{route ('dicsena.instructor.glossary.index')}}">
            <i class="fas fa-plus fa-3x"></i>
            <p>Add Words</p>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection