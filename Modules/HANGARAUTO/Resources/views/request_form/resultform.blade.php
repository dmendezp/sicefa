@extends('hangarauto::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('cefa.parking.table') }}">{{ trans('hangarauto::solicitar.Tilte_Card_Records_Saver') }}</a></li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>{{ trans('hangarauto::solicitar.Tilte_Card_Records_Saver') }}</strong></h2>
            </div>

            <div class="card-body">
                <a href="{{ route('cefa.parking.solicitar') }}" class="btn btn-primary mb-2">
                    <i class="fa-solid fa-plus"></i>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Name')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Travel_date')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Return_Date')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Department')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_City')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_numstudents')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_reason_for_trip')}}</th>
                                <th>{{ trans('hangarauto::solicitar.Title_Header_Table_Column_Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $dato)
                                <tr>
                                    <td>{{ $dato->id }}</td>
                                    <td>{{ $dato->name }}</td>
                                    <td>{{ $dato->travel_date }}</td>
                                    <td>{{ $dato->return_date }}</td>
                                    <td>{{ $dato->department }}</td>
                                    <td>{{ $dato->city }}</td>
                                    <td>{{ $dato->num_students }}</td>
                                    <td>{{ $dato->reason }}</td>
                                    <td>
                                        <form action="{{ route('hangarauto.'.getRoleRoueName(Route::currentRouteName()).'.delete', $dato->id) }}" method="post" id="formEliminar{{ $dato->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btnEliminar" type="button" data-form-id="formEliminar{{ $dato->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{ route('hangarauto.'.getRoleRouteName(Route::currentRouteName()).'.edit', $dato) }}" class="btn btn-primary btnUpdat">
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