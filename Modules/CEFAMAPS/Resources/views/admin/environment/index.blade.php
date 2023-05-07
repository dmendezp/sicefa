@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.environment.index') }}"><i class="nav-icon fas fa-solid fa-chalkboard-user"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::environment.Environment') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::environment.Name') }}</th>
                      <th>{{ trans('cefamaps::environment.Picture') }}</th>
                      <th>{{ trans('cefamaps::environment.Description') }}</th>
                      <th>{{ trans('cefamaps::farm.Farm') }}</th>
                      <th>{{ trans('cefamaps::environment.Productive units') }}</th>
                      <th>{{ trans('cefamaps::menu.Status') }}</th>
                      <th>{{ trans('cefamaps::environment.Type') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>{{ trans('cefamaps::menu.Class') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>{{ trans('cefamaps::page.Page') }}</th>
                      <th>
                        <a href="{{ route('cefamaps.admin.config.environment.add')}}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($environ as $env)
                    <tr>
                      <td>{{$env->id}}</td>
                      <td>{{$env->name}}</td>
                      <td><img src="{{ asset('cefamaps/images/uploads/'.$env->picture) }}" width="100" height="100"></td>
                      <td>{{$env->description}}</td>
                      <td>{{$env->name}}</td>
                      <td>{{$env->productive_units->name}}</td>
                      <td>{{$env->status}}</td>
                      <!-- Inicio del modal pra las coordenadas -->
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info-{{$env->id}}">{{$env->type_environment}}</button>
                        <div class="modal fade" id="modal-info-{{$env->id}}">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content bg-info">
                              <div class="modal-header">
                                <br>
                                 <!-- aqui va el nombre del punto  -->
                                 <h1 class="modal-title" style="center">{{trans('cefamaps::environment.Spot')}} {{$env->name}}</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <i class="fa-solid fa-xmark"></i>
                                </button>
                              </div>
                              <!-- Inicio del punto del mapa -->
                              <div class="container text-center">
                                <div class="row align-items-start">
                                  <div class="col">
                                    <div class="modal-header">
                                      <h3 class="modal-title">{{ trans('cefamaps::environment.Length') }}</h3>
                                    </div>
                                    <div class="modal-body">
                                      <h5>{{$env->length}}</h5>
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="modal-header">
                                      <h3 class="modal-title">{{ trans('cefamaps::environment.Latitude') }}</h3>
                                    </div>
                                    <div class="modal-body">
                                      <h5>{{$env->latitude}}</h5>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Fin del punto del mapa -->
                              <!-- aqui va el nombre del poligono -->
                              <h1 class="modal-title" style="center">{{trans('cefamaps::environment.Polygon')}} {{$env->name}}</h1>
                                <div class="row align-items-center">
                                  <div class="col">
                                    <div class="modal-header">
                                      <h3 class="modal-title">{{ trans('cefamaps::environment.Length') }}</h3>
                                    </div>
                                    <div class="modal-body">
                                      @foreach($env->coordinates as $c)
                                      <h5>{{$c->length}}</h5>
                                      @endforeach
                                    </div>
                                  </div>
                                  <div class="col">
                                    <div class="modal-header">
                                      <h3 class="modal-title">{{ trans('cefamaps::environment.Latitude') }}</h3>
                                    </div>
                                    <div class="modal-body">
                                      @foreach($env->coordinates as $c)
                                      <h5>{{$c->latitude}}</h5>
                                      @endforeach
                                    </div>
                                  </div>
                              </div>
                            </div>                      
                          </div>
                        </div>
                      </td>
                      <!-- Fin del modal pra las coordenadas -->
                      <td>{{$env->class_environments->name}}</td>
                      <!-- Inicio del ID para el filtro de las paginas -->
                      <td>
                        <a class="btn btn-primary" href="{{url('/cefamaps/page/index?id='.$env->id)}}">
                          <i class="fas fa-regular fa-file-lines"></i>
                        </a>
                      </td>
                      <!-- Fin del ID para el filtro de las paginas -->
                      <!-- Inico para Editar y Eliminar -->
                      <td>
                        <a href="{{url('/cefamaps/environment/edit/'.$env->id)}}" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-environment" href="#" type="submit" data-action="delete" data-object="{{ $env->id }}" data-path="/cefamaps/environment/delete/">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                      <!-- Fin para Editar y Eliminar -->
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::environment.Name') }}</th>
                      <th>{{ trans('cefamaps::environment.Picture') }}</th>
                      <th>{{ trans('cefamaps::environment.Description') }}</th>
                      <th>{{ trans('cefamaps::farm.Farm') }}</th>
                      <th>{{ trans('cefamaps::environment.Productive units') }}</th>
                      <th>{{ trans('cefamaps::menu.Status') }}</th>
                      <th>{{ trans('cefamaps::environment.Type') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>{{ trans('cefamaps::menu.Class') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>{{ trans('cefamaps::page.Page') }}</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

  <script>
    $(document).ready(function () {
      $('#example1').DataTable({
        order: [[3, 'desc']],
      });
    });
  </script>

  <script type="text/javascript">
    /*
      Para poder eliminar un Environment
    */
    $(document).ready(function(){
      $(document).on("click", ".delete-environment", function() {
        var id = $(this).data('object');
        var url = "{{ url('/cefamaps/environment/delete/') }}/"+id;
        Swal.fire({
          title: '{{ trans("cefamaps::menu.Are You Sure") }} {{ trans("cefamaps::menu.To") }} {{ trans("cefamaps::menu.Delete") }}'+id,
          text: "Aca no sirve el control Z",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed){
            window.location.href=url
          }
        })
      })
    })
  </script>

  <script type="text/javascript">
    
    function initMap() {

      const mapId = document.getElementById("map");
      
      @foreach($environ as $e)

        // The map, centered at Uluru
        const map{{$e->id}} = new google.maps.Map(mapId, {
          zoom: 18,
          center: { lat: {{$e->latitude}}, lng: {{$e->length}} },
          mapTypeId: 'satellite'
        });
        
        // The marker, positioned at Uluru
        const marker{{$e->id}} = new google.maps.Marker({
          position: { lat: {{$e->latitude}},  lng: {{$e->length}} },
          map: map{{$e->id}},
        });

      @endforeach

    }

  </script>
@endsection
