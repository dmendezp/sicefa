@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('Falta Cometida')}}</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table id="missing" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">{{ trans('sigac::general.T_Name')}}</th>
                                                <th class="text-center">{{ trans('Tipo')}}</th>
                                                <th class="text-center">
                                                    <a data-bs-toggle="modal" data-bs-target="#createfault">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($missings as $missing)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $missing->name }}</td>
                                                    <td class="text-center">{{ $missing->type }}</td>
                                                    <td class="text-center">
                                                        <div class="opts">
                                                            <a  data-bs-toggle="modal" data-bs-target="#editfault{{$missing->id}}">
                                                                <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Falta">
                                                                    <i class="fas fa-edit"></i>
                                                                </b>
                                                            </a>
                                                            @include('sigac::committee.missing.edit')
                                                            <a class="delete-fault"  data-fault-id="{{ $missing->id }}">
                                                                <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Falta">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </b>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <form id="delete-fault-form-{{ $missing->id }}"
                                                        action="{{ route('sigac.academic_coordination.committee.missing.destroy', ['id' => $missing->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @include('sigac::committee.missing.create')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $('#missing').DataTable({
    });

    $(document).ready(function() {
            $('.delete-fault').on('click', function(event) {
            var special_program_id = $(this).data('fault-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-fault-form-' + special_program_id).submit();
                }
            });
        });
    });
    
</script>
@endpush
