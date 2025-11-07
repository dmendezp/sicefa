@extends('cafeto::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('cafeto::movement.Breadcrumb_Active_Movement') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.movements.consult') }}"
                method="POST" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label">{{ trans('cafeto::movement.Title_Initial_Date') }}</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ trans('cafeto::movement.Title_Final_Date') }}</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">{{ trans('cafeto::movement.Title_Document_Number') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa-solid fa-keyboard"></i>
                            </span>
                        </div>
                        <input type="number" name="document_number" class="form-control">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit"
                        class="btn btn-success btn-block">{{ trans('cafeto::movement.Btn_Consult') }}</button>
                </div>
            </form>
        </div>
    </div>

    @if (isset($movements) && count($movements) > 0)
        <div class="card">
            <div class="card-body">
                <div class="mt-4">
                    <table class="table table-hover" id="tableMovementsDetails">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">{{ trans('cafeto::movement.T1_Number') }}</th>
                                <th class="text-center">{{ trans('cafeto::movement.T2_Date') }}</th>
                                <th>{{ trans('cafeto::movement.T3_Role') }}</th>
                                <th>{{ trans('cafeto::movement.T4_Manager') }}</th>
                                <th>{{ trans('cafeto::movement.T5_Movement_Type') }}</th>
                                <th class="text-center">{{ trans('cafeto::movement.T6_Price') }}</th>
                                <th class="text-center">{{ trans('cafeto::movement.T7_Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movements as $movement)
                                @php $movement_type = $movement->movement_type->name @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $movement->registration_date }}</td>
                                    @php
                                        $mr = $movement->movement_responsibilities->first(function ($value, $key) {
                                            return in_array($value->role, ['CLIENTE', 'REGISTRO', 'ENTREGA']);
                                        });
                                    @endphp
                                    <td>{{ $mr->role }}</td>
                                    <td>{{ $mr->person->full_name }}</td>
                                    <td>
                                        @if ($movement_type == 'Movimiento Interno')
                                            Entrada de inventario
                                        @else
                                            {{ $movement_type }}
                                        @endif
                                    </td>
                                    <td class="text-center fw-bold">{{ priceFormat($movement->price) }}</td>
                                    <td class="text-center">
                                        @if ($movement_type == 'Venta')
                                            <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.movements.sale.show', $movement) }}"
                                                class="btn bg-olive" data-bs-toggle="tooltip" data-bs-placement="left"
                                                data-bs-title={{ trans('cafeto::movement.Tooltip') }}>
                                            @elseif ($movement_type == 'Movimiento Interno')
                                                <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.movements.entries.show', $movement) }}"
                                                    class="btn bg-olive" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    data-bs-title={{ trans('cafeto::movement.Tooltip') }}>
                                                @elseif ($movement_type == 'Baja')
                                                    <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.movements.low.show', $movement) }}"
                                                        class="btn bg-olive" data-bs-toggle="tooltip"
                                                        data-bs-placement="left"
                                                        data-bs-title={{ trans('cafeto::movement.Tooltip') }}>
                                                    @else
                                                        <a href="#">{{ $movement_type }}
                                        @endif
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
    @else
        <div class="card">
            <div class="card-body">
                <div class="mt-4">
                    <p>{{ trans('cafeto::movement.Text_Optional') }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection

@include('cafeto::layouts.partials.plugins.datatables')

@push('scripts')
    <script>
        // Función para actualizar los atributos min y max de los campos de fecha
        function updateDateAttributes() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            endDateInput.min = startDateInput.value;
            startDateInput.max = endDateInput.value;
        }

        // Eventos para actualizar los atributos al cambiar las fechas
        document.getElementById('start_date').addEventListener('change', updateDateAttributes);
        document.getElementById('end_date').addEventListener('change', updateDateAttributes);
    </script>
    <script>
        $(document).ready(function() {
            // Opciones comunes para todas las tablas DataTable
            var dataTableOptions = {

            };

            // Verifica el idioma actual y decide si agregar la opción de idioma
            if ('{{ session('lang') }}' === 'es') {
                dataTableOptions.language = language_datatables;
            }
            /* Inicialización of Datatables para movement_details */
            $('#tableMovementsDetails').DataTable(dataTableOptions);
        });
    </script>
@endpush
