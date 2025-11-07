
@extends('evs::layouts.master')

@section('title','Juries')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.juries') }}"><i class="fas fa-gavel"></i> {{ __('Juries') }}</a>
</li>
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.juries.edit',$juries->id) }}"><i class="fas fa-plus"></i> {{ __('Editar Juries') }}</a>
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
  
          {!! Form::open(['url' => 'evs/admin/juries/edit/'.$juries->id]) !!}
          <label class="mtop16" for="name">Nombre: </label>
          <div>
            {{ $name_people }}
          
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


        </div>
    </div>
  </section>
    <!-- /.content -->



@stop