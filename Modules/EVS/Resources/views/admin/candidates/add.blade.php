
@extends('evs::layouts.master')

@section('title','Candidates')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.candidates') }}"><i class="fas fa-id-card-alt"></i> {{ __('Candidates') }}</a>
</li>
<li class="breadcrumb-item active">
  <a href=""><i class="fas fa-plus"></i> {{ __('Agregar Candidato') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

		<div class="row justify-content-center">
        <div class="card card-purple card-outline shadow col-md-4">
          <div class="card-header">
            <h3 class="card-title">{{ $election->name }}</h3>
          </div>
          <!-- /.card-header -->
          	<div class="card-body">
          <!-- Timelime example  -->

          	<div class="form_search" id="form_search">
				{!! Form::open(['url' => 'evs/admin/candidates/search/'.$election->id]) !!}
				<div class="row">
					<div class="col-md-8">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		  	@if(isset($people))
		  		@if(is_null($people))
		  			<h1>"Documento NO encontrado"<h1>
				@else					
					{!! Form::open(['url' => route('evs.admin.candidates.add')]) !!}
					<label class="mtop16" for="name">Nombre: </label>
					<div>
						{{ $people->first_name." ".$people->first_last_name." ".$people->second_last_name }}
						{!! Form::hidden('election_id', $election->id, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
						{!! Form::hidden('person_id', $people->id, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
						
					</div>
					<label class="mtop16" for="name">Número:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::number('number',null, ['class'=>'form-control']) !!}
					</div>
					<label class="mtop16" for="name">Fotografía:</label>
					<div class="input-group">
					   <span class="input-group-btn">
					     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
					       <i class="fas fa-image"></i>
					     </a>
					   </span>
					   {!! Form::text('avatar',null, ['class'=>'form-control','id'=>'thumbnail']) !!}
					</div>
					<div id="holder" style="margin-top:15px;max-height:100px;"></div>
						
					
					<div class="text-center">
					{!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
					</div>
					{!! Form::close() !!}
				@endif
			@endif	

      		</div>


      </div>

  </section>
  <script>
  	var route_prefix = "/filemanager";
  </script>

  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
	
 <script>
    //var route_prefix = base+"/filemanager";
 		$('#lfm').filemanager('image', {prefix: route_prefix});
  </script>




@stop