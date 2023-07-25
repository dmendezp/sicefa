@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">Inventario</a>
    </li>
    <li class="breadcrumb-item active">Productos</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>Lista de productos disponibles actualmente</em></h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('ptventa.inventory.create') }}" class="btn btn-success btn-sm me-1">
                            <i class="fa-solid fa-thumbs-up mr-2"></i>Registrar entrada
                        </a>
                        <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-danger btn-sm me-1">
                            <i class="fa-solid fa-thumbs-down mr-2"></i>Registrar baja
                        </a>
                        {{-- <a href="{{ route('ptventa.inventory.pdf') }}" class="btn btn-danger btn-sm me-1">PDF</a> --}}
                        <a href="{{ route('ptventa.inventory.status') }}" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-hand-middle-finger mr-2"></i>Vencidos / Por vencer
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive" data-aos="zoom-in">
                <table class="table table-hover" id="inventories-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">N°</th>
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
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><strong>{{ $inventory->element->name }}</strong></td>
                                <td class="text-center">{{ $inventory->element->category->name }}</td>
                                <td class="text-center">{{ priceFormat($inventory->price) }}</td>
                                <td class="text-center">{{ $inventory->stock }}</td>
                                <td class="text-center">{{ $inventory->amount }}</td>
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
        $(document).ready(function() {
            // Configuración de Datatables para la tabla de registros de inventario
            $('#inventories-table').DataTable({
                language: language_datatables, // Agregar traducción a español
                "order": [],
                "columnDefs": [{
                    "targets": [2, 3, 4, 5, 6],
                    "orderable": false
                }]
            });
        });
    </script>
@endpush
