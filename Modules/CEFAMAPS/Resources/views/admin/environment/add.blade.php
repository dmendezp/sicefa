@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i> {{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::environment.Environment') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::environment.Environment') }}</h3>
            </div>
            <div class="card-body">
              <!--div class="content"-->
                <form method="post" action="{{ route('cefamaps.admin.config.environment.add')}}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id">
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::environment.Environment') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio de la imagen -->
                  <div class="form-group">
                    <label for="file">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::environment.File') }}</label>
                    <input type="file" class="form-control" name="file" id="file" accept="image/*" required>
                  </div>
                  <!-- fin de la imagen -->
                  <!-- inicio de la descripcion -->
                  <div class="form-group">
                    <label for="description">{{ trans('cefamaps::environment.Description') }}</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                  </div>
                  <!-- fin de la descripcion -->
                  <!-- inicio de las longitudes y latitudes -->
                  <div class="row align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <label for="length">{{ trans('cefamaps::environment.Length') }}</label>
                        <input type="text" class="form-control" id="length" name="lengthspot" placeholder="2.0000">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                        <input type="text" class="form-control" id="latitude" name="latitudespot" placeholder="-2.0000">
                      </div>
                    </div>
                  </div>
                  <!-- fin de las longitudes y latitudes -->
                  <!-- inicio para el id del Farm -->
                  <div class="row align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <label for="farm">{{ trans('cefamaps::farm.Farm') }}</label>
                        <select class="form-control select2" style="width: 100%;" name="farm" id="farm">
                          @foreach ($farm as $f)
                            <option value="{{$f->id}}">{{$f->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label>{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <br>
                        <a href="#" class="btn btn-light btn-block btn-outline-success addfarm" type="button">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- fin para el id del Farm -->
                  <!-- inicio para el id de la unidad -->
                  <div class="row align-items-end">
                    <div class="col">
                      <div class="form-group">
                        <label for="unit">{{ trans('cefamaps::environment.Productive units') }}</label>
                        <select class="form-control select2" style="width: 100%;" id="unit" name="unit">
                          @foreach ($unit as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label>{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::environment.Productive units') }}</label>
                        <br>
                          <a href="#" class="btn btn-light btn-block btn-outline-success addunit" type="button">
                            <i class="fa-solid fa-square-plus"></i>
                          </a>
                      </div>
                    </div>
                  </div>
                  <!-- fin para el id de la unidad -->
                  <!-- inicio de los complementos de environment -->
                  <div class="row align-items-end">
                    <!-- inicio de la clase de ambiente -->
                    <div class="col">
                      <div class="form-group">
                        <label for="class">{{ trans('cefamaps::menu.Class') }} {{ trans('cefamaps::environment.Environment') }}</label>
                        <select class="form-control select2" style="width: 100%;" id="class" name="class" required>
                          <option value="Polivalente">{{ trans('cefamaps::environment.Environment') }} Polivalente</option>
                          <option value="TIC">{{ trans('cefamaps::environment.Environment') }} TIC</option>
                          <option value="Productivo">{{ trans('cefamaps::environment.Environment') }} Productivo</option>
                          <option value="Administradtivo">{{ trans('cefamaps::environment.Environment') }} Administradtivo</option>
                          <option value="SST">{{ trans('cefamaps::environment.Environment') }} SST</option>
                          <option value="Ambiental">{{ trans('cefamaps::environment.Environment') }} Ambiental</option>
                        </select>
                      </div>
                    </div>
                    <!-- fin de la clase de ambiente -->
                    <!-- inicio del estado del environment -->
                    <div class="col">
                      <div class="form-group">
                        <label for="status">{{ trans('cefamaps::menu.Status') }} {{ trans('cefamaps::environment.Environment') }}</label>
                        <select class="form-control select2" style="width: 100%;" id="status" name="status" required>
                          <option value="Activo">Disponible</option>
                          <option value="Inactivo">No Disponible</option>
                        </select>
                      </div>
                    </div>
                    <!-- fin del estado del environment -->
                  </div>
                  <!-- fin de los complementos de environment -->
                  <!-- inicio de la prueba -->
                  <div class="form-group">
                    <label>{{ trans('cefamaps::menu.Type') }} {{ trans('cefamaps::environment.Coordinate') }}</label>
                    <select id="option" class="form-control select2" name="type" required>
                      <option>Seleccione...</option>
                      <option value="poligono">{{ trans('cefamaps::environment.Coordinate') }}</option>
                      <option value="evacuacion">{{ trans('cefamaps::environment.RutadeEvacuacion') }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <p id="aqui"></p>
                  </div>
                  <!-- fin de la prueba -->
                  <!-- inicio boton de agregar -->
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::environment.Save') }}</button>
                  </div>
                  <!-- fin boton de agregar -->
                </form>
              <!--/div-->
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
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
        parrafo.innerHTML +=  '<div id="inputFormRow">' +
                                '<div class="row align-items-center">' +
                                  '<div class="col">' +
                                    '<div class="form-group">' +
                                      '<label for="lengthcoor">{{ trans("cefamaps::environment.Length") }}</label>' +
                                      '<input type="text" class="form-control m-input" id="lengthcoor" name="lengthcoor[]">' +
                                    '</div>' +
                                  '</div>' +
                                  '<div class="col">' +
                                    '<div class="form-group">' +
                                      '<label for="latitudecoor">{{ trans("cefamaps::environment.Latitude") }}</label>' +
                                      '<input type="text" class="form-control  m-input" id="latitudecoor" name="latitudecoor[]">' +
                                    '</div>' +
                                  '</div>' +
                                  '<div class="col-1">' +
                                    '<div class="form-group">' +
                                      '<br>' +
                                      '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans("cefamaps::menu.Delete") }}</button>' +
                                    '</div>' +
                                  '</div>' +
                                '</div>' +
                              '</div>' +
                              '<div id="Agregar"></div>' +
                              '<div class="d-grid gap-2">' +
                                '<button id="addRow" type="button" class="btn btn-info">{{ trans("cefamaps::menu.Add") }}</button>' +
                              '</div>'

                              // agregar registro
                              $('#addRow').click(function () {
                                var html = "";

                                html += '<div id="inputFormRow">';
                                html += '<div class="row align-items-end">';
                                html += '<div class="col">';
                                html += '<div class="form-group">';
                                html += '<label for="lengthcoor">{{ trans("cefamaps::environment.Length") }}</label>';
                                html += '<input type="text" class="form-control m-input" id="lengthcoor" name="lengthcoor[]">';
                                html += '</div>';
                                html += '</div>';
                                html += '<div class="col">';
                                html += '<div class="form-group">';
                                html += '<label for="latitudecoor">{{ trans("cefamaps::environment.Latitude") }}</label>';
                                html += '<input type="text" class="form-control m-input" id="latitudecoor" name="latitudecoor[]">';
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
        parrafo.innerHTML +=  '<div id="inputFormRow">' +
                                '<div class="row align-items-center">' +
                                  '<div class="col">' +
                                    '<div class="form-group">' +
                                      '<label for="length">{{ trans("cefamaps::environment.Length") }}</label>' +
                                      '<input type="text" class="form-control m-input" id="length" name="length[]">' +
                                    '</div>' +
                                  '</div>' +
                                  '<div class="col">' +
                                    '<div class="form-group">' +
                                      '<label for="latitude">{{ trans("cefamaps::environment.Latitude") }}</label>' +
                                      '<input type="text" class="form-control  m-input" id="latitude" name="latitude[]">' +
                                    '</div>' +
                                  '</div>' +
                                  '<div class="col-1">' +
                                    '<div class="form-group">' +
                                      '<br>' +
                                      '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans("cefamaps::menu.Delete") }}</button>' +
                                    '</div>' +
                                  '</div>' +
                                '</div>' +
                              '</div>' +
                              '<div id="Agregar"></div>' +
                              '<div class="d-grid gap-2">' +
                                '<button id="addRow" type="button" class="btn btn-info">{{ trans("cefamaps::menu.Add") }}</button>' +
                              '</div>'

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
      } else {
        parrafo.innerHTML +=  "";
      }
    }

  </script>

  <script type="text/javascript">
    /*
      esta es la alerta para ir a crear una UNIDAD
    */
    $(document).ready(function(){
      $(document).on("click", ".addunit", function() {
        var url = "{{ url('/cefamaps/unit/add') }}";
          Swal.fire({
          title: '{{ trans("cefamaps::menu.You Want") }} {{ trans("cefamaps::menu.Add") }} {{ trans("cefamaps::menu.A") }} {{ trans("cefamaps::unit.Unit") }}?',
          text: "Si aceptas, se eliminara todos los campos llenados",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
          }
        })
      })
    })
    /*
      esta es la alerta para ir a crear una GRANJA
    */
    $(document).ready(function() {
      $(document).on("click", ".addfarm", function() {
        var url = "{{ url('/cefamaps/farm/add') }}";
        Swal.fire({
          title: '{{ trans("cefamaps::menu.You Want") }} {{ trans("cefamaps::menu.Add") }} {{ trans("cefamaps::menu.A") }} {{ trans("cefamaps::farm.Farm") }}?',
          text: "Si aceptas, se eliminara todos los campos llenados",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=url
          }
        })
      })
    })

  </script>

@endsection
