@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/table_status.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Breadcrumb_Active_Status_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="row mb-3" data-aos="fade-up">
        <div class="col-6">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-center bg-warning py-1 rounded-2">
                        <strong>{{ trans('ptventa::inventory.Title_Table_To_Expired') }}</strong>
                    </h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableProductsToExpire">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('ptventa::inventory.3T_Amount') }}</th>
                                    <th>{{ trans('ptventa::inventory.3T_Product') }}</th>
                                    <th class="text-center">{{ trans('ptventa::inventory.3T_Expiration_Date') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($productosPorVencer as $producto)
                                    <tr>
                                        <td class="text-center">{{ $producto->amount }}</td>
                                        <td>{{ $producto->element->name }}</td>
                                        <td class="text-center">{{ $producto->expiration_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-center bg-danger py-1 rounded-2">
                        <strong>{{ trans('ptventa::inventory.Title_Table_Expired') }}</strong>
                    </h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableExpiredProducts">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('ptventa::inventory.3T_Amount') }}</th>
                                    <th>{{ trans('ptventa::inventory.3T_Product') }}</th>
                                    <th class="text-center">{{ trans('ptventa::inventory.3T_Expiration_Date') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($productosVencidos as $producto)
                                    <tr>
                                        <td class="text-center">{{ $producto->amount }}</td>
                                        <td>{{ $producto->element->name }}</td>
                                        <td class="text-center">{{ $producto->expiration_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.datatables')

@push('scripts')
    <script>
        $(document).ready(function() {
            // Opciones comunes para todas las tablas DataTable
            var dataTableOptions = {

            };

            // Verifica el idioma actual y decide si agregar la opción de idioma
            if ('{{ session('lang') }}' === 'es') {
                dataTableOptions.language = language_datatables;
            }

            /* Initialización of Datatables ExpiredProducts */
            $('#tableExpiredProducts').DataTable(dataTableOptions);
            /* Initialización of Datatables ProductsToExpired */
            $('#tableProductsToExpire').DataTable(dataTableOptions);
        });
    </script>
@endpush
