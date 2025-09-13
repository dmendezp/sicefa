@extends('evs::layouts.master')

@section('title','Juries')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.juries') }}"><i class="fas fa-gavel"></i> {{ __('Juries') }}</a>
</li>
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.juries.add',$election->id) }}"><i class="fas fa-plus"></i> {{ __('Agregar Juries') }}</a>
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

          <!-- Formulario de búsqueda -->
          <div class="form_search" id="form_search">
            {!! Form::open(['url' => 'evs/admin/juries/search/'.$election->id, 'method'=>'POST', 'id'=>'searchForm']) !!}
              <div class="row">
                <div class="col-md-8">
                  {!! Form::text('search', null, [
                      'class' => 'form-control',
                      'placeholder' => 'Ingrese su búsqueda',
                      'id' => 'search',
                      'required'
                  ]) !!}
                  <div class="invalid-feedback">Debe ingresar un documento para buscar.</div>
                </div>
                <div class="col-md-4">
                  {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                </div>
              </div>
            {!! Form::close() !!}
          </div>

          <!-- Formulario de agregar jurado -->
          @if(isset($person))     
            {!! Form::open(['url' => route('evs.admin.juries.add'), 'method'=>'POST', 'id'=>'juryForm']) !!}
              <label class="mtop16" for="name">Nombre: </label>
              <div>
                {{ $person->first_name." ".$person->first_last_name." ".$person->second_last_name }}
                {!! Form::hidden('election_id', $election->id, ['required']) !!}
                {!! Form::hidden('person_id', $person->id, ['required']) !!}
              </div>

              <label class="mtop16" for="password">Asignar contraseña:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                </div>
                {!! Form::password('password', [
                    'class'=>'form-control',
                    'id'=>'password',
                    'required',
                    'minlength'=>6,
                    'placeholder'=>'Mínimo 6 caracteres'
                ]) !!}
                <div class="invalid-feedback">Debe ingresar una contraseña (mínimo 6 caracteres).</div>
              </div>

              <div class="text-center">
                {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
              </div>
            {!! Form::close() !!}
          @endif

          @if($_POST && !isset($person))
            <div class="mtop16"><h5>"Documento NO encontrado"</h5></div>
          @endif  

        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<script>
  // Validación Bootstrap + extra JS
  document.addEventListener('DOMContentLoaded', function () {
      // Formularios
      const searchForm = document.getElementById('searchForm');
      const juryForm   = document.getElementById('juryForm');

      // Validación búsqueda
      if(searchForm){
        searchForm.addEventListener('submit', function(e){
          let search = document.getElementById('search').value.trim();
          if(search === ""){
            e.preventDefault();
            document.getElementById('search').classList.add('is-invalid');
          }
        });
      }

      // Validación jurado
      if(juryForm){
        juryForm.addEventListener('submit', function(e){
          let password = document.getElementById('password').value.trim();
          if(password.length < 6){
            e.preventDefault();
            document.getElementById('password').classList.add('is-invalid');
          }
        });
      }
  });
</script>

@stop
