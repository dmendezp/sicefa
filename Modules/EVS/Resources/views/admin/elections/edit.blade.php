@extends('evs::layouts.master')

@section('title', __('Edit Election'))

@section('breadcrumb')
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.elections') }}"><i class="fas fa-calendar-alt"></i> {{ __('Elections') }}</a>
</li>
<li class="breadcrumb-item active">
	<a href="#"><i class="far fa-edit"></i> {{ __('Edit Election') }}</a>
</li>
@endsection

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="card card-purple card-outline shadow col-md-4">
				<div class="card-header">
					<h3 class="card-title">Edit Election</h3>
				</div>
				<div class="card-body">

					<!-- Alert placeholder -->
					<div id="alertPlaceholder"></div>

					{!! Form::open(['url' => 'evs/admin/election/edit/'.$election->id, 'id' => 'editElectionForm']) !!}

					<label for="name">Nombre Elección:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::text('name',$election->name, ['class'=>'form-control']) !!}
					</div>

					<label for="start_date" class="mtop16">Inicia:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						{{ Form::input('datetime-local', 'start_date', date('Y-m-d\TH:i', strtotime($election->start_date)), ['id' => 'start_date', 'class' => 'form-control']) }}
					</div>

					<label for="end_date" class="mtop16">Termina:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						{{ Form::input('datetime-local', 'end_date', date('Y-m-d\TH:i', strtotime($election->end_date)), ['id' => 'end_date', 'class' => 'form-control']) }}
					</div>

					<label for="status" class="mtop16">Estado:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="fas fa-list-ul"></i>
							</span>
						</div>
						{!! Form::select('status', getEnumValues('elections', 'status'), $election->status, ['class'=>'custom-select']) !!}
					</div>

					<br>
					{!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
					
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>

<script>
// Función para mostrar alertas de Bootstrap
function showAlert(message, type = 'danger') {
	const alertPlaceholder = document.getElementById('alertPlaceholder');
	alertPlaceholder.innerHTML = `
		<div class="alert alert-${type} alert-dismissible fade show" role="alert">
			${message}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	`;
}

document.getElementById('editElectionForm').addEventListener('submit', function(e) {
	const start = document.getElementById('start_date').value;
	const end = document.getElementById('end_date').value;

	if (!start || !end) {
		showAlert('Por favor, completa ambas fechas.');
		e.preventDefault();
		return;
	}

	const startDate = new Date(start);
	const endDate = new Date(end);

	if (startDate > endDate) {
		showAlert('La fecha de inicio no puede ser mayor a la fecha de fin.');
		e.preventDefault();
		return;
	}

	if (endDate < startDate) {
		showAlert('La fecha de fin no puede ser menor a la fecha de inicio.');
		e.preventDefault();
		return;
	}
});
</script>
@endsection
