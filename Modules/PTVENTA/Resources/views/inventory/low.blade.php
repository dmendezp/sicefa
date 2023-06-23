@extends('ptventa::layouts.master')

@push('head')
    <link href="{{ asset('libs/AOS-2.3.1/dist/aos.css') }}" rel="stylesheet">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.inventory.index') }}" class="text-decoration-none">{{ trans('ptventa::low.Inventory')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::low.Registration of Low')}}</li>
@endpush

@section('content')
    <h4 class="text-center py-1 rounded-2" data-aos="fade-down"><strong>{{ trans('ptventa::low.List of Low Products')}}</strong></h4>
    <hr>
    <div class="card card-success card-outline shadow-sm" data-aos="fade-up">
        <div class="card-body">
            <table class="table" id="tableProductsofLow">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">{{ trans('ptventa::low.Product')}}</th>
                        <th class="text-center">{{ trans('ptventa::low.Category')}}</th>
                        <th class="text-center">{{ trans('ptventa::low.Unit Price')}}</th>
                        <th class="text-center">{{ trans('ptventa::low.Amount')}}</th>
                        <th class="text-center">{{ trans('ptventa::low.Expiration Date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <td class="text-center">yogurt mora</td>
                    <td class="text-center">Lacteos</td>
                    <td class="text-center">1200</td>
                    <td class="text-center">3</td>
                    <td class="text-center">21/25/2023</td>
                </tbody>
            </table>
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
            /* Initialización of Datatables tableProductsofLow */
            $('#tableProductsofLow').DataTable({
                language: language_datatables, // Agregar traducción a español
            });
        });
    </script>
@endpush
