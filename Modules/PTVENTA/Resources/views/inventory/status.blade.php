@extends('ptventa::layouts.master')

@push('head')
    <link href="{{ asset('libs/AOS-2.3.1/dist/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/table_status.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.index') }}" class="text-decoration-none">{{ trans('ptventa::statusInventory.Inventory')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::statusInventory.Product Status')}}</li>
@endpush

@section('content')
    <div class="row mb-3" data-aos="fade-up">
        <div class="col-6">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-center bg-danger py-1 rounded-2"><strong>{{ trans('ptventa::statusInventory.Expired')}}</strong></h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableExpiredProducts">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('ptventa::statusInventory.Amount')}}</th>
                                    <th>{{ trans('ptventa::statusInventory.Products')}}</th>
                                    <th class="text-center">{{ trans('ptventa::statusInventory.Expiration Date')}}</th>
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
        <div class="col-6">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-center bg-warning py-1 rounded-2"><strong>{{ trans('ptventa::statusInventory.To Expired')}}</strong></h6>
                    <div class="table table-sm table-responsive">
                        <table class="table table-hover table-bordered" id="tableProductsToExpire">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-center">{{ trans('ptventa::statusInventory.Amount')}}</th>
                                    <th>{{ trans('ptventa::statusInventory.Products')}}</th>
                                    <th class="text-center">{{ trans('ptventa::statusInventory.Expiration Date')}}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($productosPorVencer as $producto)
                                    <tr>
                                        <td class="text-center">{{ $producto->amount }}</td>
                                        <td>{{ $producto->element->name }}</td>
                                        <td class="text-center">{{ $producto->expiration_date }}</p>
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
    <script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Permite la aplicacion de datatables y la vez la traduccion de las tablas
        $(document).ready(function() {
            /* Initialización of Datatables ExpiredProducts */
            $('#tableExpiredProducts').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
            /* Initialización of Datatables ProductsToExpired */
            $('#tableProductsToExpire').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
        });
    </script>
@endpush
