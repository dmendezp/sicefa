@extends('agrocefa::layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<link rel="stylesheet" href="{{asset ('agrocefa/css/specie.css')}}">

	@if(session('success'))
    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro eliminado correctamente',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    @endif

    @if(session('error'))
        <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Error en el proceso, intenta de nuevo',
            showConfirmButton: false,
            timer: 1500
        })
        </script>
    @endif

<div class="container">
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
					<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad">Agregar Actividad</button>
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
                                    <button class="btn btn-primary btn-sm btn-edit-activity" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#editaractividad_{{ $activity->id }}" data-activity-id="{{ $activity->id }}">Editar</button>
                                    <button class="btn btn-danger btn-sm btn-delete-activity" style="padding: 0.20rem 0.3rem; font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#eliminaractividad_{{ $activity->id }}">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
			    </div>
			</div>
			<br>
			{{-- Modal Actividad --}}
			<div class="modal fade" id="crearactividad" tabindex="-1" aria-labelledby="crearactividad" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Asistencia</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('agrocefa.activity.create')}}" method="POST">
								@csrf
								<div class="form-group">
									<label for="activity_type_id">Tipo de Actividad</label>
									<select name="activity_type_id" id="activity_type_id" class="form-control">
										@foreach ($activityTypes as $activityType)
											<option value="{{ $activityType->id }}">{{ $activityType->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="name">Nombre de la actividad</label>
									<input type="text" name="name" id="name" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="description">Descripcion</label>
									<input type="text" name="description" id="description" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="period">Periodo</label>
									<select name="period" id="period" class="form-control">
										<option value="Diario">Diario</option>
										<option value="Quincenal">Quincenal</option>
										<option value="Mensual">Mensual</option>
										<option value="Anual">Anual</option>
									</select>
								</div>
								<!-- Otros campos del formulario según tus necesidades -->
								<br>
								<button type="submit" class="btn btn-primary">Registrar Actividad</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		
			{{-- Modal de Edición Actividad--}}
			@foreach ($activities as $activity)
			<div class="modal fade" id="editaractividad_{{ $activity->id }}" tabindex="-1" aria-labelledby="editaractividadLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Actividad</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="" action="{{ route('agrocefa.activity.edit', ['id' => $activity->id]) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label for="activity_type_id">Tipo de Actividad</label>
									<select name="activity_type_id" id="activity_type_id" class="form-control">
										@foreach ($activityTypes as $activityType)
											<option value="{{ $activityType->id }}" @if ($activityType->id === $activity->activity_type_id) selected @endif>{{ $activityType->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="name">Nombre de la Actividad</label>
									<input type="text" name="name" id="name" class="form-control" value="{{ $activity->name }}" required>
								</div>
								<div class="form-group">
									<label for="description">Descripcion</label>
									<input type="text" name="description" id="description" class="form-control" value="{{ $activity->description }}" required>
								</div>
								<div class="form-group">
									<label for="period">Periodo</label>
									<input type="text" name="period" id="period" class="form-control" value="{{ $activity->period }}" required>
								</div>
								<br>
								<button type="submit" class="btn btn-primary">Actualizar Actividad</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach

			@foreach ($activities as $activity)
			<div class="modal fade" id="eliminaractividad_{{ $activity->id }}" tabindex="-1" aria-labelledby="eliminaractividadLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="eliminaractividadLabel">Eliminar Actividad</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							¿Estás seguro de que deseas eliminar esta actividad?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<form action="{{ route('agrocefa.activity.delete', ['id' => $activity->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			{{-- CRUD Parametro Especie --}}
			<div class="card">
				<div class="card-header">
					Especies
					<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearspecie">Agregar Especie</button>
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
							@foreach($species as $a)
							<tr>
								<td>{{$a->id}}</td>
								<td>{{$a->name}}</td>
								<td>{{$a->lifecycle}}</td>
								<td>
									<div class="button-group">
									<button id="edit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarEspecieModal" data-specie-id="{{$a->id}}">Editar</button>
									<form action="{{ route('agrocefa.species.destroy', ['id' => $a->id]) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger btn-sm" id="delete">
											Eliminar
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
			{{-- CRUD Parametro Cultivo --}}
			<div class="card">
				<div class="card-header">
					Cultivo
					<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearspecie">Agregar Especie</button>
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
							@foreach($species as $a)
							<tr>
								<td>{{$a->id}}</td>
								<td>{{$a->name}}</td>
								<td>{{$a->lifecycle}}</td>
								<td>
									<a href="{{ route('agrocefa.species.edit', ['id' => $a->id]) }}" class="btn btn-primary btn-sm">Editar</a>
									<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
			<br>


		{{-- CRUD Parametro Variedad --}}
		<div class="card">
			<div class="card-header">
				Variedad
				<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad">Agregar Asistencia</button>
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
						<tr>
							<td>1</td>
							<td>Juan Pérez</td>
							<td>2023-08-12</td>
							<td>
								<a href="#" class="btn btn-primary btn-sm">Editar</a>
								<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>María López</td>
							<td>2023-08-12</td>
							<td>
								<a href="#" class="btn btn-primary btn-sm">Editar</a>
								<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>


		
	</div>

		{{-- Modal agregar Especie --}}
		<div class="modal fade" id="crearspecie" tabindex="-1" aria-labelledby="crearspecie" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="agregarAsistenciaModalLabel">Agregar Asistencia</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="{{ route('agrocefa.species.store') }}" method="POST">
							@csrf
							<div class="form-group">
								<label for="name">Nombre:</label>
								<input type="text" name="name" id="name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="lifecycle">Ciclo de vida:</label>
								<select name="lifecycle" id="lifecycle" class="form-control" required>
									<option value="Transitorio">Transitorio</option>
									<option value="Permanente">Permanente</option>
									<!-- Agrega más opciones según tus valores enum -->
								</select>
							</div>
							<br>
							<button type="submit" class="btn btn-primary">Registrar Especie</button>
						</form>
					</div>
				</div>

			</div>
		</div>

		{{-- Modal editar especie --}}
		<div class="modal fade" id="editarEspecieModal" tabindex="-1" aria-labelledby="editarEspecieModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editarEspecieModalLabel">Editar Especie</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="editSpeciesForm" action="{{ route('agrocefa.species.update', ['id' => $a->id]) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label for="name">Nombre:</label>
								<input type="text" name="name" id="name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="lifecycle">Ciclo de vida:</label>
								<select name="lifecycle" id="lifecycle" class="form-control" required>
									<option value="Transitorio">Transitorio</option>
									<option value="Permanente">Permanente</option>
									<!-- Agrega más opciones según tus valores enum -->
								</select>
							</div>
							<br>
							<button type="submit" class="btn btn-primary">Actualizar Especie</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>

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
		$('#editarEspecieModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Botón que activó el modal
			var specieId = button.data('specie-id'); // Obtener el ID de la especie desde el botón
		
			// Imprime el ID en la consola para verificar
			console.log('Especie ID:', specieId);
		
			// Construir la URL del formulario con el ID de la especie
			var formAction = '{{ route('agrocefa.species.update', ['id' => 'SPECIE_ID']) }}';
			formAction = formAction.replace('SPECIE_ID', specieId);
			
			// Actualizar la URL del formulario con el ID de la especie
			$('#editarEspecieModal form').attr('action', formAction);
		
			// ... Llenar los campos del formulario si es necesario ...
		});
		
		</script>

	@endsection