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
<div class="row">
  <div class="col-4">    
    <div class="card m-5" style="width: 32rem;">
      <div class="card-title ">
        <h1 style="text-align:center;">Vota por tu favorito</h1>
      </div>
      <div class="card-body">
        <div class="row border border-dark ">
          <div class="col-6 border-dark bg-dark">
            <img src="" alt="">
          </div>
          <div class="col-6">
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-dark"><a class="text-dark" href="">An item</a></li>
              <li class="list-group-item border-dark"><a class="text-dark" href="">A second item</a></li>
              <li class="list-group-item border-dark"><a class="text-dark" href="">A third item</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>  
  </div>
  <div class="col-8">
    <div style="text-align:center;">
      <iframe src="https://zeno.fm/player/radio-cefa" width="610" height="400" frameborder="0" scrolling="no"></iframe><a href="https://zeno.fm/" target="_blank" style="display: block; font-size: 0.9em; line-height: 10px;">A Zeno.FM Station</a>
    </div>
  </div>
</div>
  
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
  

  
@include('radiocefa::layouts/partials/footer')

@endsection
