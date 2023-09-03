@extends('agrocefa::layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('agrocefa/css/specie.css') }}">

    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Exitoso',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro Eliminado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <div class="container" style="margin-left: 20px">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Parametrizacion</h1>
            </div>
        </div>
        <div class="row">
            {{-- Columna 1 --}}
            <div class="col-md-6">
                {{-- CRUD Parametro Actividad --}}
                <div class="card">
                    <div class="card-header">
                        Actividad
                        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad"><i
                                class='bx bx-plus icon'></i></button>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-1">Nombre</th>
                                    <th class="col-1">Tipo</th>
                                    <th class="col-2">Descripción</th>
                                    <th class="col-1">Periodo</th>
                                    <th class="col-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->activity_type->name }}</td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->period }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm btn-edit-activity" data-bs-toggle="modal"
                                                data-bs-target="#editaractividad_{{ $activity->id }}"
                                                data-activity-id="{{ $activity->id }}"><i
                                                    class='bx bx-edit icon'></i></button>
                                            <button class="btn btn-danger btn-sm btn-delete-activity" data-bs-toggle="modal"
                                                data-bs-target="#eliminaractividad_{{ $activity->id }}"><i
                                                    class='bx bx-trash icon'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                {{-- Modal Actividad --}}
                <div class="modal fade" id="crearactividad" tabindex="-1" aria-labelledby="crearactividad"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Asistencia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['route' => 'agrocefa.activity.create', 'method' => 'POST']) !!}
                                @csrf
                                <div class="form-group">
                                    {!! Form::label('activity_type_id', 'Tipo de Actividad') !!}
                                    {!! Form::select('activity_type_id', $activityTypes->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre de la actividad') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Descripción') !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('period', 'Periodo') !!}
                                    {!! Form::select(
                                        'period',
                                        ['Diario' => 'Diario', 'Quincenal' => 'Quincenal', 'Mensual' => 'Mensual', 'Anual' => 'Anual'],
                                        null,
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                                <!-- Otros campos del formulario según tus necesidades -->
                                <br>
                                {!! Form::submit('Registrar Actividad', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal de Edición Actividad --}}
                @foreach ($activities as $activity)
                    <div class="modal fade" id="editaractividad_{{ $activity->id }}" tabindex="-1"
                        aria-labelledby="editaractividadLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Actividad</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['route' => ['agrocefa.activity.edit', 'id' => $activity->id], 'method' => 'POST']) !!}
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        {!! Form::label('activity_type_id', 'Tipo de Actividad') !!}
                                        {!! Form::select('activity_type_id', $activityTypes->pluck('name', 'id'), $activity->activity_type_id, [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre de la Actividad') !!}
                                        {!! Form::text('name', $activity->name, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('description', 'Descripción') !!}
                                        {!! Form::text('description', $activity->description, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('period', 'Periodo') !!}
                                        {!! Form::text('period', $activity->period, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <!-- Otros campos del formulario según tus necesidades -->
                                    <br>
                                    {!! Form::submit('Actualizar Actividad', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($activities as $activity)
                    <div class="modal fade" id="eliminaractividad_{{ $activity->id }}" tabindex="-1"
                        aria-labelledby="eliminaractividadLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminaractividadLabel">Eliminar Actividad</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar esta actividad?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['route' => ['agrocefa.activity.delete', 'id' => $activity->id], 'method' => 'POST']) !!}
                                    @csrf
                                    @method('DELETE')
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- CRUD Parametro Especie --}}
                <div class="card">
                    <div class="card-header">
                        Especies
                        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearspecie"><i
                                class='bx bx-plus icon'></i></button>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Ciclo de vida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($species as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->lifecycle }}</td>
                                        <td>
                                            <div class="button-group">
                                                <button class="btn btn-primary btn-sm btn-edit-specie"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editarEspecieModal_{{ $a->id }}"
                                                    data-specie-id="{{ $a->id }}"><i
                                                        class='bx bx-edit icon'></i></button>
                                                <form action="{{ route('agrocefa.species.destroy', ['id' => $a->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class='bx bx-trash icon'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- Columna 2 --}}
            <div class="col-md-6">
                {{-- CRUD Parametro Variedad --}}
                <div class="card">
                    <div class="card-header">
                        Variedad
                        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#"><i
							class='bx bx-plus icon'></i></button>
					</div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($species as $a)
                                        <tr>
                                            <td>{{ $a->id }}</td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->lifecycle }}</td>
                                            <td>
                                                <a href="{{ route('agrocefa.species.edit', ['id' => $a->id]) }}"
                                                    class="btn btn-primary btn-sm"><i
													class='bx bx-edit icon'></i></a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#eliminarAsistenciaModal"><i
													class='bx bx-trash icon'></i></button>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Modal agregar Especie --}}
                <div class="modal fade" id="crearspecie" tabindex="-1" aria-labelledby="crearspecie"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Especie</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['route' => 'agrocefa.species.store', 'method' => 'POST']) !!}
                                @csrf
                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre:') !!}
                                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lifecycle', 'Ciclo de vida:') !!}
                                    {!! Form::select('lifecycle', ['Transitorio' => 'Transitorio', 'Permanente' => 'Permanente'], null, [
                                        'id' => 'lifecycle',
                                        'class' => 'form-control',
                                        'required',
                                    ]) !!}
                                </div>
                                <!-- Agrega más campos según tus necesidades -->
                                <br>
                                {!! Form::submit('Registrar Especie', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal editar especie --}}
                @foreach ($species as $a)
                    <div class="modal fade" id="editarEspecieModal_{{ $a->id }}" tabindex="-1"
                        aria-labelledby="editarEspecieModalLabel_{{ $a->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarEspecieModalLabel_{{ $a->id }}">Editar
                                        Especie</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open([
                                        'route' => ['agrocefa.species.update', 'id' => $a->id],
                                        'method' => 'POST',
                                        'id' => "editSpeciesForm_{$a->id}",
                                    ]) !!}
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        {!! Form::label("name_{$a->id}", 'Nombre:') !!}
                                        {!! Form::text('name', $a->name, ['id' => "name_{$a->id}", 'class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label("lifecycle_{$a->id}", 'Ciclo de vida:') !!}
                                        {!! Form::select('lifecycle', ['Transitorio' => 'Transitorio', 'Permanente' => 'Permanente'], $a->lifecycle, [
                                            'id' => "lifecycle_{$a->id}",
                                            'class' => 'form-control',
                                            'required',
                                        ]) !!}
                                    </div>
                                    <!-- Agrega más campos según tus necesidades -->
                                    <br>
                                    {!! Form::submit('Actualizar Especie', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <br>
            </div>
        </div>
        <br>
    </div>
    <br>
    <br>

    <div class="row">
        {{-- CRUD parametro Cultivo --}}
        <div class="card" style="width: 90%; margin-left: 40px">
            <div class="card-header">
                Cultivo
                <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearcrop"><i
					class='bx bx-plus icon'></i></button>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" style="width: 90%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Área Sembrada</th>
                            <th>Fecha de Siembra</th>
                            <th>Densidad</th>
                            <th>Ambiente</th>
                            <th>Variedad</th>
                            <th>Fecha Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($crop as $a)
                            <tr>
                                <td>{{ $a->id }}</td>
                                <td>{{ $a->name }}</td>
                                <td>{{ $a->sown_area }}</td>
                                <td>{{ $a->seed_time }}</td>
                                <td>{{ $a->density }}</td>
                                <td>{{ $a->environment_id }}</td>
                                <td>{{ $a->variety_id }}</td>
                                <td>{{ $a->finish_date }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-edit-crop"
                                        data-bs-id="{{ $a->id }}"><i
										class='bx bx-edit icon'></i></button>
                                    <button class="btn btn-danger btn-sm btn-delete-crop" data-bs-toggle="modal"
                                        data-bs-target="#eliminarCropModal{{ $a->id }}"><i
										class='bx bx-trash icon'></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <script>
        $('.btn-edit-activity').on('click', function(event) {
            var activityId = $(this).data('activity-id');

            // Obtener los datos de la actividad desde algún lugar (puede ser una API, base de datos, etc.)
            var activityData = activitiesData.find(function(activity) {
                return activity.id === activityId;
            });

            // Llenar los campos del formulario con los datos de la actividad
            $('#activity_type_id').val(activityData.activity_type_id);
            $('#name').val(activityData.name);
            $('#description').val(activityData.description);
            $('#period').val(activityData.period);

            // Construir la URL del formulario con el ID de la actividad
            var formAction = '{{ route('agrocefa.activity.edit', ['id' => 'ACTIVITY_ID']) }}';
            formAction = formAction.replace('ACTIVITY_ID', activityId);

            // Actualizar la URL del formulario con el ID de la actividad
            $('#edit-activity-form').attr('action', formAction);
        });

        // Asegúrate de que los datos de las actividades estén disponibles aquí
        var activitiesData = [
            // ... Lista de objetos de actividad con sus propiedades ...
        ];
    </script>

    {{-- SCRIPT EDITAR ESPECIE --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('.btn-edit-specie').on('click', function(event) {
            var specieId = $(this).data('specie-id'); // Obtener el ID de la especie desde el botón

            // Imprime el ID en la consola para verificar
            console.log('Especie ID:', specieId);

            // Obtener los valores de los campos de edición
            var name = $('#name_' + specieId).val();
            var lifecycle = $('#lifecycle_' + specieId).val();

            // Llenar los campos del formulario con los datos de la especie
            $('#editSpeciesForm_' + specieId + ' #name').val(name);
            $('#editSpeciesForm_' + specieId + ' #lifecycle').val(lifecycle);

            // Construir la URL del formulario con el ID de la especie
            var formAction = '{{ route('agrocefa.species.update', ['id' => 'SPECIE_ID']) }}';
            formAction = formAction.replace('SPECIE_ID', specieId);

            // Actualizar la URL del formulario con el ID de la especie
            $('#editSpeciesForm_' + specieId).attr('action', formAction);
        });
    </script>
@endsection
