{{-- CRUD Parametro Actividad --}}
<div class="card" >
    <div class="card-header">
        {{ trans('agrocefa::parameters.EmployeeType') }}
        @auth
            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearemployeetype"><i
                        class='bx bx-plus icon'></i>
                </button>
            @endif
        @endauth
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-4">{{ trans('agrocefa::parameters.2T_Name') }}</th>
                        <th class="col-2">{{ trans('agrocefa::parameters.2T_Price') }}</th>
                        <th class="col-2">{{ trans('agrocefa::parameters.2T_Year') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                <th class="col-3">{{ trans('agrocefa::parameters.2T_Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeetypes as $employeetype)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employeetype->name }}</td>
                            <td>{{ $employeetype->price }}</td>
                            <td>{{ $employeetype->year }}</td>
                            @auth
                                @if (Auth::user()->havePermission('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.manage'))
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit-employeetype" data-bs-toggle="modal"
                                            data-bs-target="#editaremployeetype_{{ $employeetype->id }}"
                                            data-employeetype-id="{{ $employeetype->id }}"><i class='bx bx-edit icon'></i></button>
                                        <button class="btn btn-danger btn-sm btn-delete-employeetype" data-employeetype-id="{{ $employeetype->id }}"><i class='bx bx-trash icon'></i></button>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                        <form id="delete-employeetype-form-{{ $employeetype->id }}"
                            action="{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.employeetype.destroy', ['id' => $employeetype->id]) }}"
                            method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
{{-- Modal Actividad --}}
<div class="modal fade" id="crearemployeetype" tabindex="-1" aria-labelledby="crearemployeetype" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Tipo de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.employeetype.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', trans('agrocefa::parameters.Modal_Name_EmployeeType')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('price', trans('agrocefa::parameters.Modal_Price_EmployeeType')) !!}
                    {!! Form::number('price', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('year', trans('agrocefa::parameters.Modal_Year_EmployeeType')) !!}
                    {!! Form::number('year', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Otros campos del formulario según tus necesidades -->
                <br>
                {!! Form::submit(trans('agrocefa::parameters.Btn_Register_EmployeeType'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

{{-- Modal de Edición Actividad --}}
@foreach ($employeetypes as $employeetype)
    <div class="modal fade" id="editaremployeetype_{{ $employeetype->id }}" tabindex="-1"
        aria-labelledby="editaractividadLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Tipo de Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.employeetype.update', 'id' => $employeetype->id], 'method' => 'POST']) !!}
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        {!! Form::label('name', trans('agrocefa::parameters.Modal_Name_EmployeeType')) !!}
                        {!! Form::text('name', $employeetype->name, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('price',trans('agrocefa::parameters.Modal_Price_EmployeeType')) !!}
                        {!! Form::number('price', $employeetype->price, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('year', trans('agrocefa::parameters.Modal_Year_EmployeeType')) !!}
                        {!! Form::number('year', $employeetype->year, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <!-- Otros campos del formulario según tus necesidades -->
                    <br>
                    {!! Form::submit(trans('agrocefa::parameters.Btn_Update_EmployeeType'), ['class' => 'btn btn-primary','id' => 'standcolor']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endforeach


<script>
    $('.btn-edit-employeetype').on('click', function(event) {
        var activityId = $(this).data('employeetype-id');

        // Obtener los datos de la actividad desde algún lugar (puede ser una API, base de datos, etc.)
        var activityData = activitiesData.find(function(employeetype) {
            return employeetype.id === activityId;
        });

        // Llenar los campos del formulario con los datos de la actividad
        $('#name').val(activityData.name);
        $('#price').val(activityData.price);
        $('#year').val(activityData.year);

        // Construir la URL del formulario con el ID de la actividad
        var formAction = '{{ route('agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.employeetype.update', ['id' => 'ACTIVITY_ID']) }}';
        formAction = formAction.replace('ACTIVITY_ID', activityId);

        // Actualizar la URL del formulario con el ID de la actividad
        $('#edit-employeetype-form').attr('action', formAction);
    });

    // Asegúrate de que los datos de las actividades estén disponibles aquí
    var activitiesData = [
        // ... Lista de objetos de actividad con sus propiedades ...
    ];
</script>

<script>
    $('.btn-delete-employeetype').on('click', function(event) {
        var activityId = $(this).data('employeetype-id');

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
                document.getElementById('delete-employeetype-form-' + activityId).submit();
            }
        });
    });
</script>
