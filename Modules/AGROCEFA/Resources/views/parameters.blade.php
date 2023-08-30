	@extends('agrocefa::layouts.master')

	@section('content')
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	

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
						<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad">Agregar Asistencia</button>
					</div>
					<div class="card-body">
						<table class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Descripcion</th>
									<th>Periodo</th>
									<th>Acciones</th>
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
										<button class="btn btn-primary btn-sm btn-edit-activity" data-bs-toggle="modal" data-bs-id="{{ $activity->id }}">Editar</button>
										<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<br>
				{{-- CRUD Parametro Variedad --}}
				<div class="card">
					<div class="card-header">
						Variedad
						<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearactividad">Agregar Asistencia</button>
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
			<div class="modal fade" id="editarActividadModal{{ $activity->id }}" tabindex="-1" aria-labelledby="editarActividadModal{{ $activity->id }}" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="agregarAsistenciaModalLabel">Editar Actividad</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="{{ route('agrocefa.activity.edit', ['activity' => $activity->id]) }}" method="POST">
								@csrf
								@method('PUT') <!-- Agrega el método PUT -->
								<div class="form-group">
									<label for="activity_type_id">Tipo de Actividad</label>
									<select name="activity_type_id" id="activity_type_id" class="form-control">
										<!-- Opciones de tipo de actividad -->
									</select>
								</div>
								<div class="form-group">
									<label for="name">Nombre de la Actividad</label>
									<input type="text" name="name" id="name" class="form-control" value="{{ $activity->name }}" required>
								</div>
								<!-- Otros campos del formulario según tus necesidades -->
								<br>
								<button type="submit" class="btn btn-primary">Actualizar Actividad</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			{{-- Columna 2 --}}
			<div class="col-md-6">
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
			</div>
			{{-- MOdal Especie --}}
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
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
    // Obtén todos los botones de edición
    const editButtons = document.querySelectorAll(".btn-edit-activity");

    // Agrega un evento de clic a cada botón de edición
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Obtén el ID de la actividad desde el atributo data-bs-id
            const activityId = button.getAttribute("data-bs-id");

            // Verifica en la consola que se está obteniendo el ID correctamente
            console.log(`Clic en botón de editar para actividad con ID ${activityId}`);

            // Construye el ID del modal utilizando el ID de la actividad
            const modalId = `#editarActividadModal${activityId}`;

            // Verifica en la consola el ID del modal construido
            console.log(`Modal ID: ${modalId}`);

            // Obtén el modal correspondiente
            const modal = new bootstrap.Modal(document.querySelector(modalId));

            // Abre el modal
            modal.show();
        });
    });
});
	

	</script>

	@endsection
