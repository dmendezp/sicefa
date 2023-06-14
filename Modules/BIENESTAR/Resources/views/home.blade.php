@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="../bienestarxd/img1/sen3.jpg" class="img-fluid" alt="...">

            </div>
        </div>
        <div class="container text-center">
  <div class="row">
    <div class="col-4">
      <div class="cardss" style="width: 18rem;">
  <img src="../bienestarxd/img1/tra3.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h1 class="card-title">Bienestar</h1>
    <p class="card-text">Se atienden los problemas e inquietudes de nuestros aprendices</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Eventos</li>
    <li class="list-group-item">Asistencias</li>
    <li class="list-group-item">Beneficios</li>
  </ul>
  <div class="card-body">
    <a href="{{ route('bienestar.APEsena') }}" class="card-link">Consultar</a>
  </div>
</div>

    </div>
    <div class="col-8">
        <div class="card mb-3">
  <img src="../bienestarxd/img1/sen1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
</div>

    </div>
    
  </div>
</div>
    </div>
</div>
@endsection
