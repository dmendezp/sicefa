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
				{!! Form::open(['url' => 'evs/admin/candidates/search/'.$election->id ,  'method' => 'POST']) !!}
				<div class="row">
					<div class="col-md-8">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su búsqueda', 'required']) !!}
					</div>
					<div class="col-md-4">
						{!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>

		  	@if(isset($people))
		  		@if(is_null($people))
		  			<h1>"Documento NO encontrado"</h1>
				@else					
					{!! Form::open(['route' => 'evs.admin.candidates.add.post', 'method' => 'POST', 'files' => true, 'id' => 'candidateForm']) !!}

					<label class="mtop16" for="name">Nombre: </label>
					<div>
						{{ $people->first_name." ".$people->first_last_name." ".$people->second_last_name }}
						{!! Form::hidden('election_id', $election->id) !!}
						{!! Form::hidden('person_id', $people->id) !!}
					</div>

					<label class="mtop16" for="number">Número:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-keyboard"></i></span>
						</div>
						{!! Form::number('number', null, [
							'class'=>'form-control',
							'id'=>'number',
							'required',
							'min' => 1 // ✅ Validación en HTML5
						]) !!}
					</div>

					<label class="mtop16" for="avatar">Fotografía:</label>
					<div class="input-group">
					   <span class="input-group-btn">
					     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
					       <i class="fas fa-image"></i>
					     </a>
					   </span>
					   {!! Form::file('avatar', ['class'=>'form-control', 'id'=>'avatar', 'accept'=>'image/*', 'required']) !!}
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
 		$('#lfm').filemanager('image', {prefix: route_prefix});

		// 🔎 Validación extra en JS
		document.getElementById('candidateForm')?.addEventListener('submit', function(e){
			let number = parseInt(document.getElementById('number').value.trim());
			let avatar = document.getElementById('avatar').files.length;

			if(isNaN(number) || number <= 0){
				e.preventDefault();
				alert("⚠️ El número debe ser mayor a 0.");
				return;
			}

			if(avatar === 0){
				e.preventDefault();
				alert("⚠️ Debe seleccionar una fotografía antes de guardar.");
			}
		});
  </script>
@stop
