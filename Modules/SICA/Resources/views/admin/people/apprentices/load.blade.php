@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="card card-orange card-outline shadow col-md-6">
          <div class="card-header">
            <h3 class="card-title">Cargar Aprendices</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            {!! Form::open(['url' => route('sica.admin.people.apprentices.load'), 'files' => 'true','enctype'=>'multipart/form-data', 'class'=>'']) !!}
            <div class="form_load" id="form_load">
              <div class="form-group">

              <div class="input-group">
                {{ Form::input('file', 'archivo', @$_REQUEST['archivo'], ['id' => 'archivo', 'class' => 'form-control', 'required' => 'required', 'aria-describedby'=>'inputGroupFile', 'aria-label'=>'Upload']) }}
                {!! Form::submit('Cargar', ['id' => 'inputGroupFile','class' => 'btn btn-outline-secondary']) !!}
              </div>
            </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
      <div id="divResultado">
        
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection

