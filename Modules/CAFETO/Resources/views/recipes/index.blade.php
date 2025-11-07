@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a
            href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}"
            class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="card card-danger card-outline shadow-sm custom-border-color">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>{{ trans('cafeto::recipes.Title_Recipes')}}</em></h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.create'))
                            <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.create') }}"
                                class="btn btn-success btn-sm me-1">
                                <i class="fa-solid fa-file-circle-plus fa-fade mr-2"></i>{{ trans('cafeto::recipes.Btn_Create_Recipe') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive px-1" data-aos="zoom-in">
                <table class="table table-bordered border-secondary table-hover" id="tableRecipesCountAll">
                    <thead class="table-dark">
                        <tr class="border-dark">
                            <th>{{ trans('cafeto::recipes.1T_N') }}</th>
                            <th>
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ trans('cafeto::recipes.1T_Creation') }}
                            </th>
                            <th>{{ trans('cafeto::recipes.1T_Owner')}}</th>
                            <th class="text-center">{{ trans('cafeto::recipes.1T_Product_Name')}}</th>
                            <th class="text-center">{{ trans('cafeto::recipes.1T_Amount')}}</th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ trans('cafeto::recipes.1T_Actions') }}">
                                <i class="fas fa-arrow-circle-down"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($formulations as $f)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $f->date }}</td>
                            <td>{{ $f->person->full_name }}</td>
                            <td>{{ $f->element->product_name }}</td>
                            <td class="text-center">{{ $f->amount }}</td>
                            <td>
                                <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.details') }}" class="btn btn-outline-info btn-sm py-0" 
                                   data-toggle="tooltip" data-placement="right" title="Ver detalles">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

            /* Initialización of Datatables recipesCountAll */
            $('#tableRecipesCountAll').DataTable(dataTableOptions);
        });
    </script>
@endpush
