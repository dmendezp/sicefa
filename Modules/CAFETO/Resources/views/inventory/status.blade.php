@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
            class="text-decoration-none">{{ trans('cafeto::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::inventory.Breadcrumb_Active_Status_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="row mb-3" data-aos="fade-up">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center bg-warning py-1 rounded-2">
                        <strong>{{ trans('cafeto::inventory.Title_Table_To_Expired') }}</strong>
                    </h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableProductsToExpire">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('cafeto::inventory.3T_Amount') }}</th>
                                    <th>{{ trans('cafeto::inventory.3T_Product') }}</th>
                                    <th class="text-center">{{ trans('cafeto::inventory.3T_Expiration_Date') }}</th>
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
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center bg-danger py-1 rounded-2">
                        <strong>{{ trans('cafeto::inventory.Title_Table_Expired') }}</strong>
                    </h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableExpiredProducts">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('cafeto::inventory.3T_Amount') }}</th>
                                    <th>{{ trans('cafeto::inventory.3T_Product') }}</th>
                                    <th class="text-center">{{ trans('cafeto::inventory.3T_Expiration_Date') }}</th>
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

@include('cafeto::layouts.partials.plugins.datatables')

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

            /* Initialización of Datatables ProductsToExpired */
            $('#tableProductsToExpire').DataTable(dataTableOptions);
            /* Initialización of Datatables ExpiredProducts */
            $('#tableExpiredProducts').DataTable(dataTableOptions);
        });
    </script>
@endpush
