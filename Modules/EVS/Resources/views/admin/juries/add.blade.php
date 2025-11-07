
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
          <!-- Timelime example  -->
            <div class="form_search" id="form_search">
              {!! Form::open(['url' => 'evs/admin/juries/search/'.$election->id]) !!}
              <div class="row">
                <div class="col-md-8">
                  {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda']) !!}
                </div>
                <div class="col-md-4">
                  {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>

      @if(isset($person))     
          {!! Form::open(['url' => route('evs.admin.juries.add')]) !!}
          <label class="mtop16" for="name">Nombre: </label>
          <div>
            {{ $person->first_name." ".$person->first_last_name." ".$person->second_last_name }}
            {!! Form::hidden('election_id', $election->id, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
            {!! Form::hidden('person_id', $person->id, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
            
          </div>
          <label class="mtop16" for="name">Asignar contraseña:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="far fa-keyboard"></i>
              </span>
            </div>
            {!! Form::password('password', ['class'=>'form-control']) !!}
          </div>
          
          
          {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
          
          {!! Form::close() !!}
        @endif
        @if($_POST && !isset($person))
            <div class="mtop16"><h5>"Documento NO encontrado"</h5></div>
        @else    
        @endif  

        </div>
    </div>
  </section>
    <!-- /.content -->



@stop