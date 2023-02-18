@extends('cefamaps::layouts.master')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
<li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i> {{ trans('cefamaps::unit.Add') }} {{ trans('cefamaps::cooordenates.Coordenates') }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::cooordenates.Coordenates') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('cefamaps.admin.config.coordenate.add') }}" method="post">
                  @csrf
                  <!-- inicio del id de los environments -->
                  <div class="form-group">
                    <label for="environ">{{ trans('cefamaps::environment.Environment') }}</label>
                    <select class="form-control select2" style="width: 100%;" name="environ" id="environ">
                      @foreach ($environ as $e)
                        <option value="{{$e->id}}">{{$e->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- fin del id de los environments -->
                  <!-- inicio de las longitudes y latitudes -->
                  <div id="inputFormRow">
                    <div class="row align-items-center">
                      <div class="col">
                        <div class="form-group">
                          <label for="length">{{ trans('cefamaps::environment.Length') }}</label>
                          <input type="text" class="form-control m-input" id="length" name="length[]" autocomplete="off">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                          <input type="text" class="form-control  m-input" id="latitude" name="latitude[]" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="input-group-append"> 
                          <button id="Eliminar" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>
                        </div>                        
                      </div>
                    </div>
                  </div>
                  <!-- fin de las longitudes y latitudes -->
                  <!-- inicio del boton para agregar un nuevo campo -->
                  <div id="Agregar"></div>
                  <div class="d-grid gap-2">
                    <button id="addRow" type="button" class="btn btn-info">{{ trans('cefamaps::menu.Add') }}</button>
                  </div>
                  <!-- fin del boton para agregar un nuevo campo -->
                  <!-- inicio boton de agregar -->
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::menu.Save') }}</button>
                  </div>
                  <!-- fin boton de agregar -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script type="text/javascript">
// agregar registro
$("#addRow").click(function () {
var html = '';

html += '<div id="inputFormRow">';
html += '<div class="row align-items-center">';
html += '<div class="col">';
html += '<div class="form-group">';
html += '<label for="length">{{ trans("cefamaps::environment.Length") }}</label>';
html += '<input type="text" class="form-control m-input" id="length" name="length[]">';
html += '</div>';
html += '</div>';
html += '<div class="col">';
html += '<div class="form-group">';
html += '<label for="latitude">{{ trans("cefamaps::environment.Latitude") }}</label>';
html += '<input type="text" class="form-control m-input" id="latitude" name="latitude[]">';
html += '</div>';
html += '</div>';
html += '<div class="col-2">';
html += '<div class="input-group-append">';
html += '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans("cefamaps::menu.Delete") }}</button>';
html += '</div>';
html += '</div>';
html += '</div>';
html += '</div>';

$('#Agregar').append(html);
});

// borrar registro
$(document).on('click', '#Eliminar', function () {
  $(this).closest('#inputFormRow').remove();
});
</script>

@endsection