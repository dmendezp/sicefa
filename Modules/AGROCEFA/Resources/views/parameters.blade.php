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
							<form action="" method="POST">
								@csrf
								<div class="form-group">
									<label for="activity_type_id">Tipo de Actividad</label>
									<select name="activity_type_id" id="activity_type_id" class="form-control">

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

	@endsection
