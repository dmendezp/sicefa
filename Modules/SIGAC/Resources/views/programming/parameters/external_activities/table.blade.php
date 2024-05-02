<div>
    <div class="table-responsive">
        <table id="external_activities" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ trans('sigac::general.T_Name')}}</th>
                    <th class="text-center">{{ trans('sigac::general.T_Description')}}</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#crearactividad">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($external_activities as $e)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $e->name }}</td>
                        <td class="text-center">{{ $e->description }}</td>
                        <td class="text-center">
                            <div class="opts">
                                <a  data-bs-toggle="modal" data-bs-target="#editExternal_activity{{$e->id}}">
                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Actividad Externa">
                                        <i class="fas fa-edit"></i>
                                    </b>
                                </a>
                                @include('sigac::programming.parameters.external_activities.edit')
                                <a class="delete-external_activity"  data-externalactivity-id="{{ $e->id }}">
                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Actividad Externa">
                                        <i class="fas fa-trash-alt"></i>
                                    </b>
                                </a>
                            </div>
                        </td>
                        <form id="delete-externalactivity-form-{{ $e->id }}"
                            action="{{ route('sigac.wellbeing.programming.parameters.external_activities.destroy', ['id' => $e->id]) }}"
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
@include('sigac::programming.parameters.external_activities.create')

<script>
    $(document).ready(function() {
            $('.delete-external_activity').on('click', function(event) {
            var external_activity_id = $(this).data('externalactivity-id');

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
                    document.getElementById('delete-externalactivity-form-' + external_activity_id).submit();
                }
            });
        });
    });
    
</script>