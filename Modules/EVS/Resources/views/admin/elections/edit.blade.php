@extends('evs::layouts.master')

@section('title', __('Add Elections'))

@section('breadcrumb')
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.elections') }}"><i class="fas fa-calendar-alt"></i> {{ __('Elections') }}</a>
</li>
<li class="breadcrumb-item active">
	<a href="#"><i class="far fa-edit"></i></i> {{ __('Edit Election') }}</a>
</li>
@endsection

@section('content')
<!-- Main content -->
<div class="content">

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="card card-purple card-outline shadow col-md-4">
				<div class="card-header">
					<h3 class="card-title">Edit Election</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					
					{!! Form::open(['url' => 'evs/admin/election/edit/'.$election->id]) !!}
					<label for="name">Nombre Elección:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::text('name',$election->name, ['class'=>'form-control']) !!}
					</div>
					<label for="module" class="mtop16">Inicia:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						
						{{ Form::input('dateTime-local', 'start_date', date('Y-m-d\TH:i', strtotime($election->start_date)), ['id' => 'start_date', 'class' => 'form-control']) }}
					</div>
					<label for="icon" class="mtop16">Termina:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-calendar-alt"></i>
							</span>
						</div>
						{{ Form::input('dateTime-local', 'end_date', date('Y-m-d\TH:i', strtotime($election->end_date)), ['id' => 'end_date', 'class' => 'form-control']) }}
					</div>
					<label for="icon" class="mtop16">Estado:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="fas fa-list-ul"></i>
							</span>
						</div>
						{!! Form::select('status', getEnumValues('elections', 'status'), $election->status, ['class'=>'custom-select']) !!}
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