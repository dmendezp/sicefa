@extends('radiocefa::layouts.master')

@section('textHero')
  <h1>Radio CEFA</h1>
  <h2><p>Centro de Formación Agroindustrial</p><p>"La Angostura"</p></h2>
@endsection

@include('radiocefa::layouts/partials/hero')

@include('radiocefa::layouts/partials/navbar')

@section('content')



<!--Cards-->
<div class="container-fluid mt-3 p-3">
<div class="container">
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col-4">
      <div class="card h-100">
        <img src="{{asset('radi__cefa/senalaire.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Colaboraciones</h5>
          <p class="card-text">En nuestro centro de formacion realizamos diferentes actividades en conjunto con Radio CEFA las cuales podras disfrutar en vivo</p>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card h-100">
        <img src="{{asset('radi__cefa/senalaire.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Unidades de produccion</h5>
          <p class="card-text">Nuestro centro de formacion cuenta con diferentes unidades de producción las cuales podras conocer mediante nuestro informe mensual junto con aprendices de cada area</p>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card h-100">
        <img src="{{asset('radi__cefa/senalaire.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Entrevistas y Podcasts</h5>
          <p class="card-text">Realizamos entrevistas a diferentes invitados cada mes, no te lo pierdas cada segunro miercoles del mes</p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
{{-- end cards --}}

      <div style="text-align:center;">
        <iframe src="https://zeno.fm/player/radio-cefa" width="810" height="400" frameborder="0" scrolling="no"></iframe><a href="https://zeno.fm/" target="_blank" style="display: block; font-size: 0.9em; line-height: 10px;">A Zeno.FM Station</a>
      </div>





 <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex jus justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->
  
      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Radio CEFA
            </h6>
            <p>
              Esta es una radio institucional desarrollada por el tecnologo de Analisis y desarrollo en sistemas de informacion con el unico proposito de extendernos a personas interesadas
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Mas de Sicefa
            </h6>
            <p>
              <a href="#!" class="text-reset">Cefa maps</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Punto de Venta</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Estacion Metereologica</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Help</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contactanos</h6>
            <p><i class="fas fa-home me-3"></i> Sena La Angostura, Campoalegre</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              sicefa.agroindustrial@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> 57+ 01 234 567 88</p>
            <p><i class="fas fa-print me-3"></i> 57+ 01 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:
      <a class="text-reset fw-bold" href="https://mdbootstrap.com/">SenaLaAngostura</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
@endsection

