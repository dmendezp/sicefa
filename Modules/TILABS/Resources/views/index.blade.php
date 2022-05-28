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
          <p>Te presentamos algunos registros importantes en TI-LABS:</p>
                <a class="btn btn-app">
                  <span class="badge bg-info">14783</span>
                  <i class="fas fa-users"></i> Personas
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">1242</span>
                  <i class="fas fa-user-graduate"></i> Aprendices
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">891</span>
                  <i class="fas fa-chalkboard-teacher"></i> Instructores
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">67</span>
                  <i class="fas fa-user-tie"></i> Administrativos
                </a>

                <a class="btn btn-app">
                  <span class="badge bg-info">3</span>
                  <i class="fas fa-laptop-code"></i> Aplicaciones
                </a>


                <a class="btn btn-app">
                  <span class="badge bg-info">53</span>
                  <i class="fas fa-warehouse"></i> U. Productivas
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">18</span>
                  <i class="fas fa-user-tag"></i> Roles
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">26</span>
                  <i class="fas fa-user-shield"></i> Usuarios
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">33</span>
                  <i class="fas fa-map-marked-alt"></i> Ambientes
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">300</span>
                  <i class="fas fa-cash-register"></i> Productos
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">53</span>
                  <i class="fas fa-graduation-cap"></i> Programas
                </a>
                <a class="btn btn-app">
                  <span class="badge bg-info">53</span>
                  <i class="fas fa-tractor"></i> Maquinaria
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
    
