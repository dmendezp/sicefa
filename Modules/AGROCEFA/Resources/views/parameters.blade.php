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
			<div class="col-md-6">
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
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Juan Pérez</td>
									<td>2023-08-12</td>
									<td><span class="badge bg-success">Presente</span></td>
									<td>
										<a href="#" class="btn btn-primary btn-sm">Editar</a>
										<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>María López</td>
									<td>2023-08-12</td>
									<td><span class="badge bg-warning text-dark">Ausente</span></td>
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
						
								<button type="submit" class="btn btn-primary">Registrar Actividad</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#agregarAsistenciaModal">Agregar Asistencia</button>
					</div>
					<div class="card-body">
						<table class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Fecha</th>
									<th>Estado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Juan Pérez</td>
									<td>2023-08-12</td>
									<td><span class="badge bg-success">Presente</span></td>
									<td>
										<a href="#" class="btn btn-primary btn-sm">Editar</a>
										<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarAsistenciaModal">Eliminar</button>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>María López</td>
									<td>2023-08-12</td>
									<td><span class="badge bg-warning text-dark">Ausente</span></td>
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
	</div>

	@endsection
