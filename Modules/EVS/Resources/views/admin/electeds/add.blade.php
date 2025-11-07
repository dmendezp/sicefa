@extends('evs::layouts.master')

@section('title', __('Add Election'))

@section('breadcrumb')
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.electeds') }}"><i class="fas fa-calendar-alt"></i> {{ __('Electeds') }}</a>
</li>
<li class="breadcrumb-item active">
	<a href="{{ route('evs.admin.electeds.add') }}"><i class="fas fa-calendar-plus"></i> {{ __('Add Elected') }}</a>
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
					
					{!! Form::open(['url' => route('evs.admin.electeds.add')]) !!}
					<label for="name">Nombre Elección:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::select('election_id', $elections, null, ['class'=>'custom-select', 'placeholder'=>'Seleccione...']) !!}
					</div>
					<div id="data-elected"></div>

					
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