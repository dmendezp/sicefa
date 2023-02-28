@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><img src="{{ asset('cefamaps/images/uploads/'.$editenviron->picture) }}" width="25" height="25">{{$editenviron->name}}</a></li>

@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-lightblue card-outline">
          <div class="card-header">
            <h3 class="m-0">{{ trans('cefamaps::menu.Edit') }} {{$editenviron->name}}</h3>
          </div>
          <div class="card-body">
            <div class="content">
              <form method="post" action="{{ route('cefamaps.admin.environment.edit')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$editenviron->id}}">
                <!-- inicio del name -->
                <div class="form-group">
                  <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::environment.Environment') }}</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $editenviron->name }}" required>
                </div>
                <!-- fin del name -->
                <!-- inicio de la imagen -->
                <div class="row align-items-start">
                  <div class="col">
                    <div class="form-group">
                      <label for="file">{{ trans('cefamaps::menu.Edit') }} {{ trans('cefamaps::environment.File') }}</label>
                      <input type="file" class="form-control" id="file" name="file" value="{{ $editenviron->picture }}" accept="image/*" style="width: 100%;">
                    </div>
                  </div>
                  <div class="col-2">
                    <img src="{{ asset('cefamaps/images/uploads/'.$editenviron->picture) }}" width="90" height="90">
                  </div>
                </div>
                <!-- fin de la imagen -->
                <!-- inicio de la descripcion -->
                <div class="form-group">
                  <label for="description">{{ trans('cefamaps::environment.Description') }}</label>
                  <input type="text" class="form-control" id="description" name="description" value="{{ $editenviron->description }}">
                </div>
                <!-- fin de la descripcion -->
                <!-- inicio de las longitudes y latitudes -->
                <div class="row align-items-center">
                  <div class="col">
                    <div class="form-group">
                      <label for="length">{{ trans('cefamaps::environment.Length') }}</label>
                      <input type="text" class="form-control" id="length" name="lengthspot" value="{{ $editenviron->length }}">
                    </div>
                  </div>
                 <div class="col">
                    <div class="form-group">
                      <label for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                      <input type="text" class="form-control" id="latitude" name="latitudespot" value="{{ $editenviron->latitude }}">
                    </div>
                  </div>
                </div>
                <!-- fin de las longitudes y latitudes -->
                <!-- inicio de los complementos para id del Farm y el id de la unidad -->
                <div class="row align-items-center">
                  <div class="col">
                    <!-- inicio para el id del Farm -->
                    <div class="form-group">
                      <label for="farm">{{ trans('cefamaps::farm.Farm') }}</label>
                      <select class="form-control select2" style="width: 100%;" name="farm" id="farm">
                        @foreach ($farm as $f)
                          <option value="{{$f->id}}">{{$f->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <!-- fin para el id del Farm -->
                  </div>
                  <div class="col">
                    <!-- inicio para el id de la unidad -->
                    <div class="form-group">
                      <label for="unit">{{ trans('cefamaps::environment.Productive units') }}</label>
                      <select class="form-control select2" style="width: 100%;" id="unit" name="unit">
                        @foreach ($unit as $u)
                          <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <!-- fin para el id de la unidad -->
                  </div>
                </div>
                <!-- fin de los complementos para id del Farm y el id de la unidad -->
                <!-- inicio de los complementos de environment -->
                <div class="row align-items-end">
                  <!-- inicio del tipo de ambiente -->
                  <div class="col-4">
                    <div class="form-group">
                      <label for="type">{{ trans('cefamaps::menu.Type') }} {{ trans('cefamaps::environment.Environment') }}</label>
                      <input type="text" class="form-control" id="type" name="type" value="{{ $editenviron->type_environment }}" required>
                    </div>
                  </div>
                  <!-- fin del tipo de ambiente -->
                  <!-- inicio de la clase de ambiente -->
                  <div class="col-4">
                    <div class="form-group">
                      <label for="class">{{ trans('cefamaps::menu.Class') }} {{ trans('cefamaps::environment.Environment') }}</label>
                      <input type="text" class="form-control" name="class" id="class" value="{{ $editenviron->environment_classroom }}" required>
                    </div>
                  </div>
                  <!-- fin de la clase de ambiente -->
                  <!-- inicio del status del environment -->
                  <div class="col-4">
                    <div class="form-group">
                      <label for="status">{{ trans('cefamaps::menu.Status') }} {{ trans('cefamaps::environment.Environment') }}</label>
                      <input type="text" class="form-control" id="status" name="status" value="{{ $editenviron->status }}" required>
                    </div>
                  </div>
                  <!-- fin del status del environment -->
                </div>
                <!-- fin de los complementos de environment -->
                <!-- inicio de la prueba -->
                <div class="form-group">
                  <label>{{ trans('cefamaps::menu.Type') }} {{ trans('cefamaps::environment.Coordinate') }}</label>
                  <select id="option" class="form-control select2">
                    <option>Seleccione...</option>
                    <option value="poligono">{{ trans('cefamaps::environment.Coordinate') }}</option>
                    <option value="evacuacion">{{ trans('cefamaps::environment.RutadeEvacuacion') }}</option>
                  </select>
                </div>
                <div class="form-group">

                
                @foreach($editenviron->coordinates as $c)
                <div id='inputFormRow'>
                          <div class='row align-items-center'>
                            <div class='col'>
                              <div class='form-group'>
                                <label for='length'>{{ trans('cefamaps::environment.Length') }}</label>
                                <input type='hidden' id='id' value='{{$c->id}}'>
                                <input type='text' class='form-control m-input' id='length' name='length[]' value='{{$c->length}}'>
                              </div>
                            </div>
                            <div class='col'>
                              <div class='form-group'>
                                <label for='latitude'>{{ trans('cefamaps::environment.Latitude') }}</label>
                                <input type='text' class='form-control  m-input' id='latitude' name='latitude[]' value='{{$c->latitude}}'>
                              </div>
                            </div>
                            <div class='col-1'>
                              <div class='form-group'>
                                <br>
                                <button id='Eliminar' type='button' class='btn btn-danger'>{{ trans('cefamaps::menu.Delete') }}</button>
                              </div>
                            </div>
                          </div>
                        </div>

                  @endforeach
                  <div id='Agregar'></div>
                            <div class='d-grid gap-2'>
                              <button id='addRow' type='button' class='btn btn-info'>{{ trans('cefamaps::menu.Add') }}</button>
                            </div>
                  <p id="aqui"></p>

                </div>
                <!-- fin de la prueba -->
                <!-- inicio boton de agregar -->
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::environment.Save') }}</button>
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
    let seleccionar = document.getElementById('option');
    let parrafo = document.getElementById('aqui');

    seleccionar.addEventListener('change', establecerOption);

    function establecerOption() {
      let eleccion = seleccionar.value;


      if (eleccion === 'poligono') {



      
                              
                              // agregar registro
                              $('#addRow').click(function () {
                              var html = "";

                              html += '<div id="inputFormRow">';
                              html += '<div class="row align-items-end">';
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
                              html += '<div class="col-1">';
                              html += '<div class="form-group">';
                              html += '<br>';
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
        
      } else if (eleccion === 'evacuacion') {
        parrafo.innerHTML +=  "<button type='button' class='btn btn-default' data-toggle='modal' data-target='#modal-default'>" +
                              "Launch Default Modal" +
                              "</button>";
      } else {
        parrafo.innerHTML +=  '';
      }
    }

  </script>

@endsection