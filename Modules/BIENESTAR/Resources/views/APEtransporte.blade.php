@extends('bienestar::layouts.adminlte')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


            </div>

        </div>

    </div>
    <div class="row">
    <div class="col-4">
        <br>
            <br>
            <br>
            <div class="card">
        <button>
  <span>MUNICIPIOS</span>
</button>

            </div>
            <br>
            <br>
            <div class="card">
        <button>
  <span>HORARIOS</span>
</button>

            </div>
            <br>
            <br>
            <div class="card">
        <button>
  <span>RUTAS</span>
</button>

            </div>
            <br>
            <div class="card">
        <button onclick="location.href='http://sicefapruebas.test:8081/bienestar/LIDrutas'">
  <span>LIDERES RUTAS</span>
</button>

            </div>
    </div>
    <div class="col-8">
      <div class="card-body">
        <section>
                         <img src="../bienestarxd/img1/xd.jpg" class="img-fluid" alt="...">
                         <img src="../bienestarxd/img1/tra2.jpg" class="img-fluid" alt="...">
                         <img src="../bienestarxd/img1/tra3.jpg" class="img-fluid" alt="...">
                     </section>


            </div>
    </div>
  </div>
</div>
<br>
    <br>
      <div class="container text-center">
  <div class="row">
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
    <p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>
  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
    <div class="col">
      <div class="card-bodyd">
  <div class="card-details">
<p class="text-title">Foto Intructor(a)</p>
    <p class="text-body">Nombre Instructor(a)</p>  </div>
  <button class="card-button">Mas informacion</button>
</div>
    </div>
  </div>
</div>
@endsection
