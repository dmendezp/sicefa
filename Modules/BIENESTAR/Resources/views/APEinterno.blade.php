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
    <div class="col-3">

      <br>
      <div class="card">
        <button>
          <span>INTERNOS ACTIVOS</span>
        </button>
      </div>
      <br>
      <br>
    </div>
    <br>
    <div class="col-3">
      <div class="card-body">
        <div class="card">
          <button>
            <span>INTERNOS EGRESADOS</span>
          </button>
        </div>
        <br>
        <br>
      </div>
    </div>
    <br>
    <br>
    <div class="col-3">
      <div class="card-body">
        <div class="card">
          <button>
            <span>BLOQUES</span>
          </button>
        </div>
        <br>
      </div>
    </div>
    <br>
    <br>
    <div class="container text-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table id="miDataTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Aprendiz</th>
                  <th>Programa</th>
                  <th>Ficha</th>
                  <th>Apoyo Alimentacion</th>
                  <th>Apoyo Transporte</th>
                  <th>Apoyo Internado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Juancho</td>
                  <td>Adso</td>
                  <td>2500871</td>
                  <td>Recibe 00%</td>
                  <td>Recibe 100%</td>
                  <td>no recibe</td>
                </tr>
                <!-- Agrega más filas con los datos que deseas mostrar -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection