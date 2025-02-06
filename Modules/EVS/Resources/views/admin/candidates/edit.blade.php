
@extends('evs::layouts.master')

@section('title','Candidates')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.candidates') }}"><i class="fas fa-id-card-alt"></i> {{ __('Candidates') }}</a>
</li>
<li class="breadcrumb-item active">
  <a href=""><i class="fas fa-edit"></i> {{ __('Editar Candidato') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

		<div class="row justify-content-center">
        <div class="card card-purple card-outline shadow col-md-4">
          <div class="card-header">
            <h3 class="card-title">{{ $name_election }}</h3>
          </div>
          <!-- /.card-header -->
          	<div class="card-body">
          <!-- Timelime example  -->
					
					{!! Form::open(['url' => 'evs/admin/candidates/edit/'.$candidate->id]) !!}
					<label for="name">Nombre: </label>
					<div>
						{{ $name_people }}
					</div>
					<label class="mtop16" for="name">Número:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
						</div>
						{!! Form::number('number',$candidate->number, ['class'=>'form-control']) !!}
					</div>
					<label class="mtop16" for="name">Fotografía:</label>
					<div class="input-group">
					   <span class="input-group-btn">
					     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
					       <i class="fas fa-image"></i>
					     </a>
					   </span>
					   {!! Form::text('avatar',$candidate->avatar, ['class'=>'form-control','id'=>'thumbnail']) !!}
					</div>
					<div id="holder" style="margin-top:15px;max-height:100px;">
						<img src="{{ asset('storage/'.$candidate->avatar) }}" style="height: 5rem;">
					</div>
					
					<div class="text-center">
					{!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
					</div>
					
					{!! Form::close() !!}

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