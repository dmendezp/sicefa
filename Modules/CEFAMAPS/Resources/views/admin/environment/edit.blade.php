@extends('cefamaps::layouts.master')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.environment.index') }}"><i class="nav-icon fas fa-solid fa-chalkboard-user"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><img src="{{ asset('modules/cefamaps/images/uploads/'.$editenviron->picture) }}" width="25" height="25">{{$editenviron->name}}</a></li>

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
                                    <input type="hidden" name="id" id="idEnvironment" value="{{$editenviron->id}}">
                                    <!-- inicio del name -->
                                    <div class="form-group">
                                        <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::environment.Environment') }}</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $editenviron->name }}">
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
                                            <img src="{{ asset('modules/cefamaps/images/uploads/'.$editenviron->picture) }}" width="90" height="90">
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
                                                <input type="text" class="form-control" id="length" name="lengthspot" value="{{ $editenviron->length }}" placeholder="-1.2345">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label
                                                    for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                                                <input type="text" class="form-control" id="latitude" name="latitudespot" value="{{ $editenviron->latitude }}" placeholder="1.2345">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPunto">
                                                {{ trans('cefamaps::environment.Map') }}
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
                                    <!-- fin de las longitudes y latitudes -->
                                    <!-- inicio para el id de la unidad -->
                                    <div class="form-group">
                                        <label for="unit">{{ trans('cefamaps::environment.Productive units') }}</label>
                                        {!! Form::select('productive_unit_id',$unitedit, $editenviron->productive_unit_id,['class' => 'form-control','placeholder' => 'Seleccione...','required']) !!}
                                    </div>
                                    <!-- fin para el id de la unidad -->
                                    <!-- inicio de los complementos de environment -->
                                    <div class="row align-items-end">
                                        <!-- inicio de la clase de ambiente -->
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="class">{{ trans('cefamaps::menu.Class') }} {{ trans('cefamaps::environment.Environment') }}</label>
                                                {!! Form::select('class_environment_id',$classenvironedit, $editenviron->class_environment_id,['class' => 'form-control','placeholder' => 'Seleccione...','required']) !!}
                                            </div>
                                        </div>
                                        <!-- fin de la clase de ambiente -->
                                        <div class="col">
                                            <!-- inicio para el id del Farm -->
                                            <div class="form-group">
                                                <label for="farm">{{ trans('cefamaps::unit.Farm') }}</label>
                                                {!! Form::select('farm_id',$farm, $editenviron->farm_id,['class' => 'form-control','placeholder' => 'Seleccione...', 'required']) !!}
                                            </div>
                                            <!-- fin para el id del Farm -->
                                        </div>
                                        <!-- inicio del status del environment -->
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="status">{{ trans('cefamaps::menu.Status') }} {{ trans('cefamaps::environment.Environment') }}</label>
                                                {!! Form::select('status',getEnumValues('environments','status'),$editenviron->status,['class'=>'form-control','placeholder'=>'seleccione...']) !!}
                                            </div>
                                        </div>
                                        <!-- fin del status del environment -->
                                    </div>
                                    <!-- fin de los complementos de environment -->
                                    <div class="form-group">
                                        <label for="type">{{ trans('cefamaps::menu.Type') }} {{ trans('cefamaps::environment.Coordinates') }}</label>
                                        <select class="form-control select2" style="width: 100%;" id="type" value="{{ $editenviron->type_environment }}" name="type" required>
                                            <option value="Polygon">{{ trans('cefamaps::environment.Polygon') }}</option>
                                            <option value="EvacuationRoute">{{ trans('cefamaps::environment.Evacuation route') }}</option>
                                        </select>
                                    </div>
                                    <div class="card-header">
                                        <h3 class="m-0"> {{ trans('cefamaps::environment.Coordinates') }} {{ trans('cefamaps::menu.Of The') }} {{ $editenviron->type_environment }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="content">
                                            <!-- inicio de las longitudes y latitudes -->
                                            <div class="form-group">
                                                @foreach($editenviron->coordinates as $c)
                                                    <input type="hidden" name="idcoord[]" id="idcoordenada" value="{{$c->id}}">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="length">{{ trans('cefamaps::environment.Length') }}</label>
                                                                <input type="text" class="form-control m-input" id="length[]" name="length[]" value="{{$c->length}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                                                                <input type="text" class="form-control m-input" id="latitude[]" name="latitude[]" value="{{$c->latitude}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            <div class="form-group">
                                                                <br>
                                                                <button id="btnEliminar" onclick="eliminarInput({{$c->id}})" type="button" class="btn btn-danger">{{ trans('cefamaps::menu.Delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                                <div id="Agregar"></div>
                                                <div class="d-grid gap-2">
                                                    <button id="addRow" type="button" class="btn btn-info">{{ trans('cefamaps::menu.Add') }}</button>
                                                </div>
                                            </div>
                                            <!-- fin de las longitudes y latitudes -->
                                            <!-- inicio boton de agregar -->
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::menu.Save') }}</button>
                                            </div>
                                            <!-- fin boton de agregar -->
                                        </div>
                                    </div>
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
    $('#addRow').click(function () {
    var html = "";
    html += '<div id="inputFormRow">';
    html += '<div class="row align-items-end">';
    html += '<div class="col">';
    html += '<div class="form-group">';
    html += '<label for="length">{{ trans("cefamaps::environment.Length") }}</label>';
    html += '<input type="hidden" id="idEnv" name="idlength[]"">';
    html += '<input type="text" class="form-control m-input" id="idLongitud">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col">';
    html += '<div class="form-group">';
    html += '<label for="latitude">{{ trans("cefamaps::environment.Latitude") }}</label>';
    html += '<input type="hidden" name="idlatitude[]"">';
    html += '<input type="text" class="form-control m-input" id="idLatitud">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-1">';
    html += '<div class="form-group">';
    html += '<br>';
    html += '<button id="btnEliminar" onclick="eliminarInput({{$coor->id}})" type="button" class="btn btn-danger">{{ trans("cefamaps::menu.Delete") }}</button>';
    html += '<button id="btnCrear" onclick="addInput()" type="button" class="btn btn-info">{{ trans("cefamaps::menu.Save") }}</button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $('#Agregar').append(html);
  });

    var ideEl;
    function eliminarInput(id){
        if(id ===''){
        }else{
            var idEl = id;
            $.ajax({
                url: '/cefamaps/environment/eliminar/'+idEl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                data: {id: idEl},
                success: function(response){
                    $("#inputFormRow"+response.id).closest('#inputFormRow'+response.id).remove();
                }
            });
        }
    }

    function addInput(){
        var id = $("#idEnvironment").val();
        var longitud = $("#idLongitud").val();
        var latitud = $("#idLatitud").val();
        $.ajax({
            url: '/cefamaps/environment/addinput',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                id: id,
                ltn: latitud,
                long: longitud,
            },
            success: function(response){
                $("#btnCrear").closest('#btnCrear').remove();
            }
        });
    }

  </script>

    <!-- Inicio mapa para las cooordenadas -->
    <script type="text/javascript">
    
    function initMap(){
      var latitude = {{$editenviron->latitude}};
      var length = {{$editenviron->length}};

      coordenas = {
        lng: length,
        lat: latitude
      };

      generarMapa(coordenas);
      
    };

    function generarMapa(coordenas) {
      var mapa = new google.maps.Map(document.getElementById('mapa'),
      {
        zoom: 17,
        mapTypeId: 'satellite',
        center: new google.maps.LatLng(coordenas.lat, coordenas.lng)
      });

      marcador = new google.maps.Marker({
        map: mapa,
        draggable: true,
        position: new google.maps.LatLng(coordenas.lat, coordenas.lng)
      });

      marcador.addListener('dragend', function(event){
        document.getElementById("latitude").value = this.getPosition().lat();
        document.getElementById("length").value = this.getPosition().lng();
      });
    }
    
  </script>
  <!-- Fin mapa para las cooordenadas -->

@endsection