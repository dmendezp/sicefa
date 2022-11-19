@extends('sica::layouts.master')

@section('stylesheet')
  <style type="text/css">
    .select2-selection--single {
      height: 38px !important;
    }
    .select2-selection__arrow{
      top: 8px !important;
    }
  </style>
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="card card-orange card-outline shadow col-md-10">
          <div class="card-header">
            <h3 class="card-title">Buscar Aprendices</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- Timelime example  -->
            <div class="form_search" id="form_search">
              <div class="row">
                <div class="form-group col-md-10">
                  {!! Form::select('course_id', $courses, null, ['class'=>'form-control', 'placeholder'=>'Seleccione...','id'=>'course_id','height'=>'38px']) !!}
                </div>
              
                <div class="col-md-1">
                  {!! Form::button('Busqueda avanzada', ['class' => 'btn btn-link btn-xs']) !!}
                </div>
                <div class="col-md-1">
                  <a class="btn btn-link btn-xs" href="{{ route('sica.admin.people.apprentices.load') }}">Cargar Archivo</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="divApprentices">
        
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(function () {
      $('#course_id').select2();
    }) 

    $(document).on("change", "#course_id", function () {
      var miObjeto = new Object();
      miObjeto.course_id = $('#course_id').val();
      var myString = JSON.stringify(miObjeto);
      ajaxReplace('divApprentices','/sica/admin/people/apprentices/search',myString);     
    });
  </script>
@endsection

