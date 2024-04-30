@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('hdc.admin.table') }}">{{ trans('hdc::ConsumptionRegistry.Title_Card_Records_Saver') }}</a></li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>{{ trans('hdc::ConsumptionRegistry.Title_Card_Records_Saver') }}</strong></h2>
            </div>

            <div class="card-body">
                <a href="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.formulario') }}" class="btn btn-success mb-2">
                    <i class="fa-solid fa-plus"></i>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_productive_unit')}}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Activities')}}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Date')}}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Environmental_Aspect')}}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Quantity')}}</th>
                                <th>{{ trans('hdc::ConsumptionRegistry.Title_Header_Table_Column_Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos->sortByDesc('execution_date') as $dato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dato->activity->productive_unit->name }}</td>
                                    <td>{{ $dato->activity->name }}</td>
                                    <td>
                                        @if ($dato->execution_date instanceof \Carbon\Carbon)
                                            {{ $dato->execution_date->format('Y-m-d') }}
                                        @else
                                            {{ $dato->execution_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($dato->environmental_aspect_labors as $envasp)
                                                <li>{{ $envasp->environmental_aspect->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($dato->environmental_aspect_labors as $envasp)
                                                <li>{{ $envasp->amount }} {{ $envasp->environmental_aspect->measurement_unit->abbreviation }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <form action="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.delete', $dato->id) }}" method="post" id="formEliminar{{ $dato->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btnEliminar" type="button" data-form-id="formEliminar{{ $dato->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('hdc.'.getRoleRouteName(Route::currentRouteName()).'.edit', $dato) }}" class="btn btn-primary btnUpdat">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btnEliminar');

            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener('click', () => {
                    const formId = deleteButton.dataset.formId;
                    const form = document.getElementById(formId);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de manera convencional
                            form.submit();
                        } else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });
        });
    </script>
@endpush
