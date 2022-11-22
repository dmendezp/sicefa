@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-6">
        <div class="card-header">
          <h3 class="card-title">Buscar Persona</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Timelime example  -->

          <div class="form_search" id="form_search">
            {!! Form::open(['url' => 'sica/admin/people/data/search']) !!}
            <div class="row">
              <div class="col-md-6">
                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Documento']) !!}
              </div>
              <div class="col-md-2">
                {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
              </div>
              <div class="col-md-2">
                {!! Form::button('Busqueda avanzada', ['class' => 'btn btn-link btn-xs']) !!}
              </div>
              <div class="col-md-2">
                  <a class="btn btn-link btn-xs" href="{{ route('sica.admin.people.personal_data.load') }}">Cargar Archivo</a>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

    
    

</div>
</div>

@endsection