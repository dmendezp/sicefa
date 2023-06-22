@extends('ptventa::layouts.master')

@push('head')
    <link href="{{ asset('libs/AOS-2.3.1/dist/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/table_status.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">{{ trans('ptventa::statusInventory.Inventory')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::statusInventory.Product Status')}}</li>
@endpush

@section('content')
    <div class="container" data-aos="fade-down">
        <div class="d-flex justify-content-around">
            <div class="col-9">
                <h6 class="text-center bg-secondary py-2 rounded-2"><strong>{{ trans('ptventa::statusInventory.All Products')}}</strong></h6>
            </div>
            <div class="col-3">
                <a href="{{ route('ptventa.inventory.low') }}" class="btn btn-success"> {{ trans('ptventa::statusInventory.Registration of Low')}} <i class="far fa-hand-point-down"></i> </a>
            </div>
        </div>
    </div>
    <hr data-aos="fade-left" data-aos-duration="3000">
    <div class="card border-success mb-3" data-aos="fade-up">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center bg-danger py-1 rounded-2"><strong>{{ trans('ptventa::statusInventory.Expired')}}</strong></h6>
                    <div class="tabla-container">
                        <table class="table table-hover table-bordered" id="tableExpiredProducts">
                            <thead class="table-secondary">
                                <th class="text-center">{{ trans('ptventa::statusInventory.Amount')}}</th>
                                <th>{{ trans('ptventa::statusInventory.Products')}}</th>
                                <th class="text-center">{{ trans('ptventa::statusInventory.Expiration Date')}}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <div class="tabla-container">
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
                <div class="col-md-6">
                    <h6 class="text-center bg-warning py-1 rounded-2"><strong>{{ trans('ptventa::statusInventory.To Expired')}}</strong></h6>
                    <div class="tabla-container">
                        <table class="table table-hover table-bordered" id="tableProductsToExpire">
                            <thead class="table-secondary">
                                <th class="text-center">{{ trans('ptventa::statusInventory.Amount')}}</th>
                                <th>{{ trans('ptventa::statusInventory.Products')}}</th>
                                <th class="text-center">{{ trans('ptventa::statusInventory.Expiration Date')}}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <div class="tabla-container">
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
            /* Initialización of Datatables CashCount */
            $('#tableExpiredProducts').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
            /* Initialización of Datatables CashCountAll */
            $('#tableProductsToExpire').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
        });
    </script>
@endpush
