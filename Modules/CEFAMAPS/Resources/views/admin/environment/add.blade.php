@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::environment.Breadcrumb_Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.index') }}"><i
                class="nav-icon fas fa-solid fa-chalkboard-user"></i>
            {{ trans('cefamaps::environment.Breadcrumb_Active_Environment') }}</a>
    </li>
    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i>
            {{ trans('cefamaps::environment.Breadcrumb_Active_Add_Environment') }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::environment.Title_Card_Add_Environment') }}</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.add') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- inicio del nombre -->
                                <div class="form-group">
                                    <label
                                        for="name">{{ trans('cefamaps::environment.Label_Name_Environment') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <!-- fin del nombre -->
                                <!-- inicio de la imagen -->
                                <div class="form-group">
                                    <label for="file">{{ trans('cefamaps::environment.Label_Add_File') }}</label>
                                    <input type="file" class="form-control" name="file" id="file"
                                        accept="image/*" required>
                                </div>
                                <!-- fin de la imagen -->
                                <!-- inicio de la descripcion -->
                                <div class="form-group">
                                    <label
                                        for="description">{{ trans('cefamaps::environment.Label_Description_Environment') }}</label>
                                    <input type="text" class="form-control" id="description" name="description" required>
                                </div>
                                <!-- fin de la descripcion -->
                                <!-- inicio de las longitudes y latitudes -->
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="form-group">
                                            <label
                                                for="length">{{ trans('cefamaps::environment.Label_Length_Environment') }}</label>
                                            <input type="text" class="form-control" id="length" name="lengthspot"
                                                placeholder="-1.2345">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label
                                                for="latitude">{{ trans('cefamaps::environment.Label_Latitude_Environment') }}</label>
                                            <input type="text" class="form-control" id="latitude" name="latitudespot"
                                                placeholder="1.2345">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modalPunto">{{ trans('cefamaps::environment.Btn_Map') }}</button>
                                            <div class="modal fade" id="modalPunto">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h4 class="modal-title"></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <lord-icon src="https://cdn.lordicon.com/rivoakkk.json"
                                                                    trigger="hover"
                                                                    colors="primary:#000000,secondary:#000000"
                                                                    style="width:32px;height:32px"></lord-icon>
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
                                <!-- fin de las longitudes y latitudes -->
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
                                    <div class="row align-items-center unidad_productiva_row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="unit">{{ trans('cefamaps::environment.Label_Productive_Unit') }}</label>
                                                {!! Form::select(
                                                    'productive_unit_id[]',
                                                    $unitadd,
                                                    [],
                                                    ['class' => 'form-control', 'placeholder' => 'Seleccione...', 'required']
                                                ) !!}
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" class="btn btn-danger delete-row">{{ trans('cefamaps::menu.Delete') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- inicio de los complementos de environment -->
                                <div class="row align-items-end">
                                    <!-- inicio de la clase de ambiente -->
                                    <div class="col">
                                        <div class="form-group">
                                            <label
                                                for="class">{{ trans('cefamaps::environment.Label_Environment_Class') }}</label>
                                            {!! Form::select(
                                                'class_environment_id',
                                                $classenvironadd,
                                                [],
                                                ['class' => 'form-control', 'placeholder' => 'Seleccione...', 'required'],
                                            ) !!}
                                        </div>
                                    </div>
                                    <!-- fin de la clase de ambiente -->
                                    <div class="col">
                                        <!-- inicio de la Farm id -->
                                        <div class="form-group">
                                            <label for="farm">{{ trans('cefamaps::environment.Label_Farm') }}</label>
                                            {!! Form::select(
                                                'farm_id',
                                                $farm,
                                                [],
                                                ['class' => 'form-control', 'placeholder' => 'Seleccione...', 'required'],
                                            ) !!}
                                        </div>
                                        <!-- fin de la Farm id -->
                                    </div>
                                    <!-- inicio del estado del environment -->
                                    <div class="col">
                                        <div class="form-group">
                                            <label
                                                for="status">{{ trans('cefamaps::environment.Label_Environment_Status') }}</label>
                                            {!! Form::select('status', getEnumValues('environments', 'status'), null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'Selecciona...',
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <!-- fin del estado del environment -->
                                </div>
                                <!-- fin de los complementos de environment -->
                                <!-- inicio de la prueba -->
                                <div class="form-group">
                                    <label>{{ trans('cefamaps::environment.Label_Type_Coordinates') }}</label>
                                    <select id="option" class="form-control select2" name="type" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Polygon">
                                            {{ trans('cefamaps::environment.Select_Coordiante_Polygon') }}</option>
                                        <option value="EvacuationRoute">
                                            {{ trans('cefamaps::environment.Select_Coordiante_Ev_Route') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p id="aqui"></p>
                                </div>
                                <!-- fin de la prueba -->
                                <!-- inicio boton de agregar -->
                                <div class="d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::environment.Btn_Add_Environment') }}</button>
                                </div>
                                <!-- fin boton de agregar -->
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


    <script type="text/javascript">
        let seleccionar = document.getElementById('option');
        let parrafo = document.getElementById('aqui');

        seleccionar.addEventListener('change', establecerOption);

        function establecerOption() {
            let eleccion = seleccionar.value;

            if (eleccion === 'Polygon') {
                parrafo.innerHTML += '<div id="inputFormRow">' +
                    '<div class="row align-items-center">' +
                    '<div class="col">' +
                    '<div class="form-group">' +
                    '<label for="lengthcoor">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>' +
                    '<input type="text" class="form-control m-input" id="lengthcoor" name="lengthcoor[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col">' +
                    '<div class="form-group">' +
                    '<label for="latitudecoor">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>' +
                    '<input type="text" class="form-control m-input" id="latitudecoor" name="latitudecoor[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1">' +
                    '<div class="form-group">' +
                    '<br>' +
                    '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div id="Agregar"></div>' +
                    '<div class="d-grid gap-2">' +
                    '<button id="addRow" type="button" class="btn btn-info">{{ trans('cefamaps::menu.Add') }}</button>' +
                    '</div>'

                // agregar registro
                $('#addRow').click(function() {
                    var html = "";

                    html += '<div id="inputFormRow">';
                    html += '<div class="row align-items-end">';
                    html += '<div class="col">';
                    html += '<div class="form-group">';
                    html += '<label for="lengthcoor">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>';
                    html += '<input type="text" class="form-control m-input" id="lengthcoor" name="lengthcoor[]">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col">';
                    html += '<div class="form-group">';
                    html += '<label for="latitudecoor">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>';
                    html +=
                        '<input type="text" class="form-control m-input" id="latitudecoor" name="latitudecoor[]">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col-1">';
                    html += '<div class="form-group">';
                    html += '<br>';
                    html +=
                        '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $('#Agregar').append(html);
                });

                // borrar registro
                $(document).on('click', '#Eliminar', function() {
                    $(this).closest('#inputFormRow').remove();
                });

            } else if (eleccion === 'EvacuationRoute') {
                parrafo.innerHTML += '<div id="inputFormRow">' +
                    '<div class="row align-items-center">' +
                    '<div class="col">' +
                    '<div class="form-group">' +
                    '<label for="lengthrou">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>' +
                    '<input type="text" class="form-control m-input" id="lengthrou" name="lengthrou[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col">' +
                    '<div class="form-group">' +
                    '<label for="latituderou">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>' +
                    '<input type="text" class="form-control m-input" id="latituderou" name="latituderou[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1">' +
                    '<div class="form-group">' +
                    '<br>' +
                    '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div id="Agregar"></div>' +
                    '<div class="d-grid gap-2">' +
                    '<button id="addRow" type="button" class="btn btn-info">{{ trans('cefamaps::menu.Add') }}</button>' +
                    '</div>'

                // agregar registro
                $('#addRow').click(function() {
                    var html = "";

                    html += '<div id="inputFormRow">';
                    html += '<div class="row align-items-end">';
                    html += '<div class="col">';
                    html += '<div class="form-group">';
                    html += '<label for="lengthrou">{{ trans('cefamaps::environment.1M_Label_Length_Environment') }}</label>';
                    html += '<input type="text" class="form-control m-input" id="lengthrou" name="lengthrou[]">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col">';
                    html += '<div class="form-group">';
                    html += '<label for="latituderou">{{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}</label>';
                    html +=
                        '<input type="text" class="form-control m-input" id="latituderou" name="latituderou[]">';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col-1">';
                    html += '<div class="form-group">';
                    html += '<br>';
                    html +=
                        '<button id="Eliminar" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $('#Agregar').append(html);
                });

                // borrar registro
                $(document).on('click', '#Eliminar', function() {
                    $(this).closest('#inputFormRow').remove();
                });
            } else {
                parrafo.innerHTML += "";
            }
        }
    </script>

    <!-- Inicio mapa para las cooordenadas -->
    <script type="text/javascript">
        function initMap() {
            var latitude = 2.612320;
            var length = -75.360842;

            coordenas = {
                lng: length,
                lat: latitude
            };

            generarMapa(coordenas);

        }

        function generarMapa(coordenas) {
            var mapa = new google.maps.Map(document.getElementById('mapa'), {
                zoom: 16,
                mapTypeId: 'satellite',
                center: new google.maps.LatLng(coordenas.lat, coordenas.lng)
            });

            marcador = new google.maps.Marker({
                map: mapa,
                draggable: true,
                position: new google.maps.LatLng(coordenas.lat, coordenas.lng)
            });

            marcador.addListener('dragend', function(event) {
                document.getElementById("latitude").value = this.getPosition().lat();
                document.getElementById("length").value = this.getPosition().lng();
            })
        }
    </script>
    <!-- Fin mapa para las cooordenadas -->

@endsection
