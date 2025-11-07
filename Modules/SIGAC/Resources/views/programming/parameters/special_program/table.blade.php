<div>
    <div class="table-responsive">
        <table id="special_program" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ trans('sigac::general.T_Name')}}</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#crearspecialprogram">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($special_programs as $special)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $special->name }}</td>
                        <td class="text-center">
                            <div class="opts">
                                <a  data-bs-toggle="modal" data-bs-target="#editSpecialprogram{{$special->id}}">
                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title="Actualizar Programa Especial">
                                        <i class="fas fa-edit"></i>
                                    </b>
                                </a>
                                @include('sigac::programming.parameters.special_program.edit')
                                <a class="delete-specialprogram"  data-specialprogram-id="{{ $special->id }}">
                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Programa Especial">
                                        <i class="fas fa-trash-alt"></i>
                                    </b>
                                </a>
                            </div>
                        </td>
                        <form id="delete-specialprogram-form-{{ $special->id }}"
                            action="{{ route('sigac.academic_coordination.programming.parameters.special_program.destroy', ['id' => $special->id]) }}"
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
@include('sigac::programming.parameters.special_program.create')

<script>
    $(document).ready(function() {
            $('.delete-specialprogram').on('click', function(event) {
            var special_program_id = $(this).data('specialprogram-id');

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
                    document.getElementById('delete-specialprogram-form-' + special_program_id).submit();
                }
            });
        });
    });
    
</script>