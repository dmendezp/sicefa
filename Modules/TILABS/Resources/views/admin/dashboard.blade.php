@extends('tilabs::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
        <div class="col-md-6">
        
        <div class="jumbotron">
          <h1 class="display-4">TI-LABS</h1>
          <p class="lead">Sistema de prestamo de equipos y herramientas para ambientes TIC y Laboratorios.</p>
          <hr class="my-4">
          <p><i class="fas fa-dolly-flatbed"></i> Solicitudes traspaso:</p>
              <a class="btn btn-app">
                <span class="badge bg-info">0</span>
                <i class="fas fa-sign-in-alt"></i> Entrada
              </a>
              <a class="btn btn-app">
                <span class="badge bg-info">0</span>
                <i class="fas fa-sign-out-alt"></i> Salida
              </a> 
          <p><i class="fas fa-clipboard-list"></i> Registros:</p>
              <a class="btn btn-app">
                <span class="badge bg-info">6</span>
                <i class="fas fa-school"></i> Laboratorios
              </a>
              <a class="btn btn-app">
                <span class="badge bg-info">89</span>
                <i class="fas fa-laptop"></i> Equipos
              </a>
              <a class="btn btn-app">
                <span class="badge bg-info">30</span>
                <i class="fas fa-share"></i> Prestamos
              </a>
              <a class="btn btn-app">
                <span class="badge bg-info">2</span>
                <i class="fas fa-hourglass-end"></i> Vencidos
              </a>
        </div>
           
        </div>
        <div class="col-md-6">
            <section id="hero" >
                <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                  <img src="{{ asset('tilabs/images/devices.png') }}" class="img-fluid animated zoom" alt="">
                </div>
            </section>
        </div>
        </div>
    </div>
</div>
@endsection
    
