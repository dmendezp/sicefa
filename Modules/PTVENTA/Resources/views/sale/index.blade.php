@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('ptventa.sale.index') }}" class="text-decoration-none">Ventas</a></li>
    <li class="breadcrumb-item active">Hoy</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body pt-0">

            <a href="{{ route('ptventa.sale.register') }}" class="btn btn-sm btn-success my-2">
                <i class="far fa-plus"></i>
                Registrar Venta
            </a>
            <div class="table-responsive">
                <table class="table table-hover" id="sales-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- @foreach ($movements as $movement) --}}
                            <tr>
                                <td class="text-center">1</td>
                                <td>Jesús David Guevara Munar</td>
                                <td class="text-center">08:45 am</td>
                                <td class="text-center"><strong>$ 12.500</strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Punto de venta</td>
                                <td class="text-center">08:47 am</td>
                                <td class="text-center"><strong>$ 2.500</strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Punto de venta</td>
                                <td class="text-center">09:08 am</td>
                                <td class="text-center"><strong>$ 23.800</strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Punto de venta</td>
                                <td class="text-center">09:27 am</td>
                                <td class="text-center"><strong>$ 6.500</strong></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-0" title="Ver detalles">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
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
            $('#sales-table').DataTable({
                language: language_datatables, // Agregar traducción a español
                "order": [],
                "columnDefs": [{
                    "targets": [4],
                    "orderable": false
                }]
            });
        });
    </script>
@endpush
