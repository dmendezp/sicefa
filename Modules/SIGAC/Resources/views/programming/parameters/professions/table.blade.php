<div>
    <div class="table-responsive">
        <table id="profession" class="display table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{trans('sigac::profession.Name')}}</th>
                    <th>{{trans('sigac::profession.Level')}}</th>
                    <th class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#addProfession">
                            <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                <i class="fas fa-plus-circle"></i>
                            </b>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professions as $p)      
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $p->name }}</td>
                        <td class="text-center">{{ $p->level }}</td>
                        <td class="text-center">
                            <div class="opts">
                                <a  data-bs-toggle="modal" data-bs-target="#editProfession{{$p->id}}">
                                    <b class="text-primary" data-toggle="tooltip" data-placement="top" title={{trans('sigac::profession.Update')}}>
                                        <i class="fas fa-edit"></i>
                                    </b>
                                </a>
                                
                                <a class="delete-profession" data-profession-id="{{ $p->id }}">
                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title={{trans('sigac::profession.Eliminate')}}>
                                        <i class="fas fa-trash-alt"></i>
                                    </b>
                                </a>
                            </div>
                        </td>
                        @include('sigac::programming.parameters.professions.edit')
                        <form id="delete-profession-form-{{ $p->id }}"
                            action="{{ route('sigac.academic_coordination.programming.profession.destroy', ['id' => $p->id]) }}"
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

@include('sigac::programming.parameters.professions.create')

<script>
    $(document).ready(function() {
            $('.delete-profession').on('click', function(event) {
            var profession_id = $(this).data('profession-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '{{trans('sigac::profession.You_Sure')}}',
                text: '{{trans('sigac::profession.This_Action_Can_Undone')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{trans('sigac::profession.Yes_Delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-profession-form-' + profession_id).submit();
                }
            });
        });
    });
</script>
