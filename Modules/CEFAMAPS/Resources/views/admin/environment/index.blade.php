@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fas fa-solid fa-chalkboard-user"></i> {{ trans('cefamaps::environment.Environment') }}</a></li>
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
                      <th>{{ trans('cefamaps::environment.Length') }}</th>
                      <th>{{ trans('cefamaps::environment.Latitude') }}</th>
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
                      <td>{{$env->length}}</td>
                      <td>{{$env->latitude}}</td>
                      <td>{{$env->farms_id}}</td>
                      <td>{{$env->productive_units_id}}</td>
                      <td>{{$env->status}}</td>
                      <!-- inicio de la prueba -->
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info-{{$env->id}}">{{$env->type_environment}}</button>
                        <div class="modal fade" id="modal-info-{{$env->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-info">
                              <div class="modal-header">
                                <h4 class="modal-title">{{$env->type_environment}} {{$env->name}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <i class="fa-solid fa-xmark"></i>
                                </button>
                              </div>
                              <div class="modal-body">
                              @foreach($env->coordinates as $c)
                                <p>
                                  {{$c->length}}
                                </p>
                                <p></p>
                                <p>
                                  {{$c->latitude}}
                                </p>
                              @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <!-- fin de la prueba -->
                      <td>{{$env->environment_classroom}}</td>
                      @foreach($env->pages as $p)
                      <td>
                        <a class="btn btn-primary" href="{{url('/cefamaps/page/edit/'.$p->id)}}">
                          <i class="fas fa-regular fa-file-lines"></i>
                        </a>
                      </td>
                      @endforeach
                      <td>
                        <a href="{{url('/cefamaps/environment/edit/'.$env->id)}}" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a class="btn btn-danger delete-environment" href="#" type="submit" data-action="delete" data-object="{{ $env->id }}" data-path="/cefamaps/environment/delete/">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>{{ trans('cefamaps::environment.Name') }}</th>
                      <th>{{ trans('cefamaps::environment.Picture') }}</th>
                      <th>{{ trans('cefamaps::environment.Description') }}</th>
                      <th>{{ trans('cefamaps::environment.Length') }}</th>
                      <th>{{ trans('cefamaps::environment.Latitude') }}</th>
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

  <script>
  $(document).ready(function () {
    $('#example1').DataTable({
      order: [[3, 'desc']],
    });
  });
  </script>

@endsection
