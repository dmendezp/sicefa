@extends('agrocefa::layouts.master')


@section('content')


<div class="container">
    <h3>Reporte Consumo</h3>
<div class="container my-5">
  <div class="row">
    <div class="table-responsive">
        <table id="example" class="table table-striped" style="width: 100%">
            <caption>
              Ejemplo de DataTable
            </caption>
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Compañia</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="table_users"></tbody>
          </table>
    </div>
  </div>

</div>


@endsection