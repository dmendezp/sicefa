@extends('ganaderia::layouts.master')

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="m-0">Registro de Ganado</h3>
            </div>
            <div class="card-body">
              <form action="register_animal.php" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Nombre Animal</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Nombre de Animal" name="nombre" required="value=" value="{{ old('name') }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Identificacion</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Codigo" name="identificacion" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Raza</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Raza" name="raza" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Madre</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Nombre Madre" name="madre" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Peso</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Peso" name="peso" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Sexo</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Sexo" name="Sexo" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Fecha de Nacimiento</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="small mb-1" for="inputFirstName">Color</label>
                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Ingresa Color " name="Color" required="">
                    </div>
                  </div>
                  <a href="{{ 'cattle/guardar' }}" class="btn btn-info" style="text-align:right">GUARDAR</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
