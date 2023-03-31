@extends('ganaderia::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
        <div class="col-md-6">


        <div class="jumbotron">
          <h1 class="display-4">GANADERIA</h1>
          <p class="lead">Sistema integrado de control administrativo.</p>
          <hr class="my-4">
          <p>GANADERIA administra la configuración, seguridad y los datos iniciales de todas las aplicaciones integradas en SICEFA, permitiendo la gestión eficiente de los recursos del centro de formación, incluyendo la información del personal, inventarios, localización geografica, procesos académicos, operativos y productivos.</p>

          
                
        </div>
           
        </div>
        <div class="col-md-6">
            <section id="hero" >
                <div class="order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                  <img src="{{ asset('bovinos/assets/imginicio.jpg') }}" class="img-fluid animated zoom" alt="">
                </div>
            </section>
        </div>
        </div>
    </div>
</div>
@endsection
    