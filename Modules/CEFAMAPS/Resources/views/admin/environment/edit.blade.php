@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::environment.Breadcrumb_Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.index') }}"><i class="nav-icon fas fa-solid fa-chalkboard-user"></i> {{ trans('cefamaps::environment.Breadcrumb_Active_Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::environment.Breadcrumb_Active_Edit_Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><img src="{{ asset('modules/cefamaps/images/uploads/' . $editenviron->picture) }}" width="25" height="25">{{ $editenviron->name }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::environment.Title_Card_Edit_Environment') }} : <em>{{ $editenviron->name }}</em></h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.environment.edit') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editenviron->id }}">
                                <!-- Inicio del nombre -->
                                <div class="form-group">
                                    <label for="name">{{ trans('cefamaps::environment.Label_Name_Environment') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ $editenviron->name }}">
                                </div>
                                <!-- Fin del nombre -->
                                <!-- Inicio de la imagen -->
                                <div class="row align-items-start">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="file">{{ trans('cefamaps::environment.Label_Edit_File') }}</label>
                                            <input type="file" class="form-control" id="file" name="file" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <img src="{{ asset('modules/cefamaps/images/uploads/' . $editenviron->picture) }}" width="90" height="90">
                                    </div>
                                </div>
                                <!-- Fin de la imagen -->
                                <!-- Inicio de la descripción -->
                                <div class="form-group">
                                    <label for="description">{{ trans('cefamaps::environment.Label_Description_Environment') }}</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $editenviron->description }}">
                                </div>
                                <!-- Fin de la descripción -->
                                <!-- Inicio de las coordenadas -->
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="length">{{ trans('cefamaps::environment.Label_Length_Environment') }}</label>
                                            <input type="text" class="form-control" id="length" name="lengthspot" value="{{ $editenviron->length }}" placeholder="-1.2345">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="latitude">{{ trans('cefamaps::environment.Label_Latitude_Environment') }}</label>
                                            <input type="text" class="form-control" id="latitude" name="latitudespot" value="{{ $editenviron->latitude }}" placeholder="1.2345">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPunto">
                                                {{ trans('cefamaps::environment.Btn_Map') }}
                                            </button>
                                            <div class="modal fade" id="modalPunto">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h4 class="modal-title"></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <lord-icon src="https://cdn.lordicon.com/rivoakkk.json" trigger="hover" colors="primary:#000000,secondary:#000000" style="width:32px;height:32px"></lord-icon>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="mapa" style="width: 100%; height: 500px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin de las coordenadas -->
                                <!-- Unidades productivas -->
                                <div id="unidad_productiva_container">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Asignar otra Unidad Productiva</label>
                                            <br>
                                            <a href="#" class="btn btn-light btn-block btn-outline-success addunit" type="button">
                                                <i class="fa-solid fa-square-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Campo de selección de unidad productiva -->
                                    @foreach($selectedUnits as $selectedUnit)
                                    <div class="row align-items-center unidad_productiva_row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="productive_unit_id">{{ trans('cefamaps::environment.Label_Productive_Unit') }}</label>
                                                {!! Form::select('productive_unit_id[]', $unitedit, $selectedUnit, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" class="btn btn-danger delete-row">{{ trans('cefamaps::menu.Delete') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Inicio de la clase de ambiente -->
                                <div class="form-group">
                                    <label for="class">{{ trans('cefamaps::environment.Label_Environment_Class') }}</label>
                                    {!! Form::select('class_environment_id', $classenvironedit, $editenviron->class_environment_id, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
                                </div>
                                <!-- Fin de la clase de ambiente -->
                                <!-- Inicio de la finca -->
                                <div class="form-group">
                                    <label for="farm">{{ trans('cefamaps::environment.Label_Farm') }}</label>
                                    {!! Form::select('farm_id', $farm, $editenviron->farm_id, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
                                </div>
                                <!-- Fin de la finca -->
                                <!-- Inicio del estado del ambiente -->
                                <div class="form-group">
                                    <label for="status">{{ trans('cefamaps::environment.Label_Environment_Status') }}</label>
                                    {!! Form::select('status', getEnumValues('environments', 'status'), $editenviron->status, ['class' => 'form-control', 'placeholder' => 'Seleccione...']) !!}
                                </div>
                                <!-- Fin del estado del ambiente -->
                                <!-- Inicio del tipo de coordenadas -->
                                <div class="form-group">
                                    <label for="type">{{ trans('cefamaps::environment.Label_Type_Coordinates') }}</label>
                                    <select class="form-control select2" style="width: 100%;" id="type" name="type" required>
                                        <option value="Polygon">{{ trans('cefamaps::environment.Select_Coordiante_Polygon') }}</option>
                                        <option value="EvacuationRoute">{{ trans('cefamaps::environment.Select_Coordiante_Ev_Route') }}</option>
                                    </select>
                                </div>
                                <hr>
                                <h4>{{ trans('cefamaps::environment.Label_Type_Coordinates_of_the') }} <em>{{ $editenviron->type_environment }}</em></h4>
                                <div class="card-body">
                                    <div class="content">
                                        <!-- Inicio de las coordenadas -->
                                        <div class="form-group">
                                            @foreach ($editenviron->coordinates as $c)
                                                <input type="hidden" name="idcoord[]" value="{{ $c->id }}">
                                                <div class="row align-items-end">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="lengthcoor">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>
                                                            <input type="text" class="form-control m-input" name="lengthcoor[]" value="{{ $c->length }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="latitudecoor">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>
                                                            <input type="text" class="form-control m-input" name="latitudecoor[]" value="{{ $c->latitude }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <br>
                                                            <button type="button" class="btn btn-danger" onclick="eliminarInput({{ $c->id }})">
                                                                {{ trans('cefamaps::environment.Btn_Delete_Coordinates') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div id="Agregar"></div>
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-info" id="addRow">
                                                    {{ trans('cefamaps::environment.Btn_Add_Coordinates') }}
                                                </button>
                                            </div>
                                        </div>
                                        <!-- Fin de las coordenadas -->
                                        <!-- Inicio del botón de guardar -->
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                                                {{ trans('cefamaps::environment.Btn_Edit_Environment') }}
                                            </button>
                                        </div>
                                        <!-- Fin del botón de guardar -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Función para agregar fila de unidad productiva
        $(".addunit").click(function() {
            var clonedRow = $(".unidad_productiva_row").first().clone();
            clonedRow.find('select').val(''); // Limpiar el valor seleccionado
            $("#unidad_productiva_container").append(clonedRow);
        });

        // Función para eliminar fila de unidad productiva
        $(document).on('click', '.delete-row', function() {
            $(this).closest('.unidad_productiva_row').remove();
        });
    });
</script>
    <!-- JavaScript para agregar y eliminar coordenadas -->
    <script type="text/javascript">
        // Función para agregar una fila de coordenadas
        $('#addRow').click(function() {
            var html = "";
            html += '<div id="inputFormRow">';
            html += '<div class="row align-items-end">';
            html += '<div class="col-md-5">';
            html += '<div class="form-group">';
            html += '<label for="lengthcoor">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>';
            html += '<input type="text" class="form-control m-input" id="lengthcoor" name="lengthcoor[]">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-5">';
            html += '<div class="form-group">';
            html += '<label for="latitudecoor">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>';
            html += '<input type="text" class="form-control m-input" id="latitudecoor" name="latitudecoor[]">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2">';
            html += '<div class="form-group">';
            html += '<br>';
            html += '<button type="button" class="btn btn-danger" onclick="eliminarInput()">';
            html += '{{ trans('cefamaps::environment.Btn_Delete_Coordinates') }}';
            html += '</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('#Agregar').append(html);
        });

        // Función para eliminar una fila de coordenadas
        function eliminarInput() {
            $(this).closest('#inputFormRow').remove();
        }
    </script>

    <!-- JavaScript para el mapa -->
    <script type="text/javascript">
        function initMap() {
            var latitude = {{ $editenviron->latitude }};
            var length = {{ $editenviron->length }};

            var coordenadas = {
                lng: length,
                lat: latitude
            };

            generarMapa(coordenadas);
        }

        function generarMapa(coordenadas) {
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 17,
                mapTypeId: 'satellite',
                center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });

            var marcador = new google.maps.Marker({
                map: mapa,
                draggable: true,
                position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
            });

            marcador.addListener('dragend', function(event) {
                document.getElementById("latitude").value = this.getPosition().lat();
                document.getElementById("length").value = this.getPosition().lng();
            });
        }
    </script>
@endsection
