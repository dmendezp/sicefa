@extends('ptventa::layouts.master')
<style type="text/css">
    .card{
  /* Estilos para la card */
  background-color: #fff;
  border-radius: 4px;
  padding: 20px;

}

.tabla-container {
  max-height: 350px; /* Establece una altura máxima para el contenedor */
  overflow: auto; /* Habilita las barras de desplazamiento cuando sea necesario */
}

.tabla-estilo {
  /* Estilos para las tablas */
  border-collapse: collapse;
  width: 100%;
}

.tabla-estilo th,
.tabla-estilo td {
  /* Estilos para las celdas de encabezado y datos */
  border: 1px solid #ddd;
  padding: 8px;
}

.tabla-estilo th {
  /* Estilos específicos para las celdas de encabezado */
  background-color: #f2f2f2;
}
</style>

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Estado de productos</li>
@endpush

@section('content')
<div class="container">
    <div class="text-end">
    <div class="col-auto pe-2">
            <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-success btn-sm"> Registro de bajas </a>
        </div>
    </div>
</div>
    <hr>
    <h6 class="text-center bg-secondary py-2 rounded-2"><strong>Todos los productos</strong></h6>
 <div class="card border-success mb-3">
    <div class="card-body">
      <div class="row">
          <div class="col-md-6">
            <h6 class="text-center bg-success py-1 rounded-2"><strong>VENCIDOS</strong></h6>
            <div class="tabla-container">
            <table class="tabla-estilo">
                <thead class="table-secondary">
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Productos</th>
                  <th class="text-center">Fecha</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                 <div class="tabla-container">
                @foreach ($productosVencidos as $producto)
                <tr>
                  <td>{{ $producto->amount }}</td>
                  <td>{{ $producto->element->name }}</td>
                  <td class="text-center">{{ $producto->expiration_date }}</td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
            </div>  
          </div>
          <div class="col-md-6">
        <h6 class="text-center bg-success py-1 rounded-2"><strong>POR VENCER</strong></h6>
        <div class="tabla-container">
          <table class="tabla-estilo">
            <thead class="table-secondary">
              <th class="text-center">Cantidad</th>
              <th class="text-center">Productos</th>
              <th class="text-center">Fecha</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            @foreach ($productosPorVencer as $producto)
            <tr>
              <td>{{ $producto->amount }}</td>
              <td>{{ $producto->element->name }}</td>
              <td class="text-center">{{ $producto->expiration_date }}</p>
            </tr>
            @endforeach
          </tbody>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>
</div>


@endsection

@include('ptventa::layouts.partials.plugins.datatables')

