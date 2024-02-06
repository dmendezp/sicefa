@extends('agroindustria::layouts.master')
@section('content')

<div class="container text-center">
    <div class="row align-items-start">
      <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('modules/agroindustria/img/bonilla.jpeg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Juan Diego Bonilla Aroca</h5>
              <p class="card-text">Teg. Análisis y Desarrollo de Software</p>
              <a href="https://github.com/Dbonilla03" class="btn btn-dark"><i class="fab fa-github"></i></a>
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('modules/agroindustria/img/cadena.jpeg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">David Juliam Cadena Barrera</h5>
              <p class="card-text">Teg. Análisis y Desarrollo de Software</p>
              <a href="https://github.com/C4DENA" class="btn btn-dark"><i class="fab fa-github"></i></a>
            </div>
        </div>
      </div>
      <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{asset('modules/agroindustria/img/julian.jpeg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Julian Javier Ramirez Diaz</h5>
              <p class="card-text">Teg. Análisis y Desarrollo de Software</p>
              <a href="https://github.com/Julianchiki" class="btn btn-dark"><i class="fab fa-github"></i></a>
            </div>
        </div>
      </div>
    </div>
  </div>


  
  

@endsection