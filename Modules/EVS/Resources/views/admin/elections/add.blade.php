@extends('evs::layouts.master')

@section('title', __('Add Election'))

@section('breadcrumb')
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.elections') }}"><i class="fas fa-calendar-alt"></i> {{ __('Elections') }}</a>
</li>
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.elections.add') }}"><i class="fas fa-calendar-plus"></i> {{ __('Add Election') }}</a>
</li>
@endsection

@section('content')
<!-- Main content -->
<div class="content">

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="card card-purple card-outline shadow col-md-4">
				<div class="card-header">
					<h3 class="card-title">Add Election</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					
					{!! Form::open(['url' => route('evs.admin.elections.add')]) !!}
					<label for="name">Nombre Evento:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::text('name',null, ['class'=>'form-control']) !!}
					</div>
					<label for="start_date" class="mtop16">Inicia:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						{{ Form::input('dateTime-local', 'start_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
					</div>
					<label for="end_date" class="mtop16">Termina:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						{{ Form::input('dateTime-local', 'end_date', null, ['id' => 'game-date-time-text', 'class' => 'form-control']) }}
					</div>
					
					{!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
					
					{!! Form::close() !!}
					
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>
</div><!-- /.container-fluid -->
<!-- /.content -->
@stop