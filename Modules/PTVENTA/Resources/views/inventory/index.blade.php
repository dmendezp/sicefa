@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a></li>
    <li class="breadcrumb-item active">Productos</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">
            <div class="row bg-light">
                <div class="col-auto">
                    <i class="fas fa-search"></i>
                    <label class="form-label-sm">Productos: </label>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option value="1">Todos</option>
                        <option value="2">Disponibles</option>
                        <option value="3">Productos por vencer</option>
                        <option value="4">Productos vencidos</option>
                    </select>
                </div>
                <div class="col"></div>
                <div class="col-auto pe-2">
                    <a href="{{ route('ptventa.inventory.create') }}" class="btn btn-success btn-sm"> Registrar entrada </a>
                </div>
                <div class="col-auto ps-0">
                    <a href="{{ route('ptventa.inventory.pdf') }}" class="btn btn-danger btn-sm"> <strong>PDF</strong> </a>
                </div>
                <div class="col-auto ps-0">
                    <a href="{{ route('ptventa.inventory.status') }}" class="btn btn-success btn-sm"> <strong>Estado</strong> </a>
                </div>

            </div>
            <hr>
            <h6 class="text-center bg-secondary py-1 rounded-2"><strong>Todos los productos</strong></h6>
            <div class="table-responsive">
                <table class="table table-hover" id="inventories-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Categoría</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td><strong>{{ $inventory->element->name }}</strong></td>
                                <td class="text-center">{{ $inventory->element->category->name }}</td>
                                <td class="text-center"><strong>{{ $inventory->price }}</strong></td>
                                <td class="text-center">{{ $inventory->stock }}</td>
                                <td class="text-center"><strong>{{ $inventory->amount }}</strong></td>
                                <td class="text-center">
                                    @if ($inventory->state == 'Disponible')
                                        <b class="bg-success rounded-5 ps-2 pe-2" style="font-size: 12px;">Disponible</b>
                                    @else
                                        <b class="bg-gradient-dark rounded-5 ps-2 pe-2" style="font-size: 12px;">No disponible</b>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
    <script>
        $(document).ready(function () {
            // Configuración de Datatables para la tabla de registros de inventario
            $('#inventories-table').DataTable({
                language: language_datatables, // Agregar traducción a español
                "order": [],
                "columnDefs": [{
                    "targets": [2,3,4,5,6],
                    "orderable": false
                }]
            });
        });
    </script>
@endpush
