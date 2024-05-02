@extends('gth::layouts.master')

@section('content')
@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">{{ trans('gth::menu.Officials') }}</h1>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                            data-bs-target="#crearModal">
                            {{ trans('gth::menu.Create Type of Officials') }}
                        </button>
                        <table id="employeetype" class="table table-striped table-bordered shadow-lg mt-4"
                            style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('gth::menu.ID number') }}</th>
                                    <th scope="col">{{ trans('gth::menu.Name') }}</th>
                                    <th scope="col">{{ trans('gth::menu.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employe)
                                    <tr>
                                        <td>{{ $employe->id }}</td>
                                        <td>{{ $employe->person->document_number }}</td>
                                        <td>{{ $employe->person->full_name }}</td>
                                        <form action="{{ route('cefa.gth.officials.delete', $employe->id) }}" method="POST"
                                            class="btnEliminar" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="" class="btn btn-warning editar-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editarModal_{{ $employe->id }}"
                                                    data-employe-id="{{ $employe->id }}"
                                                    data-employe-documment="{{ $employe->document_number }}"
                                                    data-employe-full_name="{{ $employe->full_name }}"
                                                    data-employe-contract_number="{{ $employe->contract_number }}"
                                                    data-employe-contract_date="{{ $employe->contract_date }}"
                                                    data-employe-professional_card_number="{{ $employe->professional_card_number }}"
                                                    data-employe-professional_card_issue_date="{{ $employe->professional_card_issue_date }}"
                                                    data-employe-employee_type_id="{{ $employe->employee_type_id }}"
                                                    data-employe-position_id="{{ $employe->position_id }}"
                                                    data-employe-risk_type="{{ $employe->risk_type }}"
                                                    data-employe-state="{{ $employe->state }}"> {{ trans('gth::menu.Edit') }}</a>
                                                <button type="submit" class="btn btn-danger"
                                                    data-id="{{ $employe->id }}">{{ trans('gth::menu.Delete') }}</button>
                                            </td>
                                        </form>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('gth::employees.new_officials')
    @include('gth::employees.edit_officials')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Detecta cambios en el campo "Número de Documento"
        $('#document_number').on('change', function() {
            var numeroDocumento = $(this).val();

            // Realiza una solicitud AJAX para obtener los datos de la persona
            $.ajax({
                url: '{{ route('cefa.gth.getPersonDatas') }}',
                method: 'GET',
                data: {
                    document_number: numeroDocumento
                },
                success: function(data) {
                    // Rellena los campos con los datos de la persona
                    $('#full_name').val(data.full_name);

                    // Llena el campo oculto 'person_id' con el ID de la persona
                    $('#person_id').val(data.id);
                },
                error: function() {
                    // Maneja errores si es necesario
                }
            });
        });
    </script>

@endsection
