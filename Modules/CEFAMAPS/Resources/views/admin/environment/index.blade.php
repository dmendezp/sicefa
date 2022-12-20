@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="nav-icon fa-solid fa-gears"></i> {{ trans('cefamaps::environment.Setting') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">Ambientes de Formacion</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('cefamaps::environment.Name') }}</th>
                      <th>{{ trans('cefamaps::environment.Picture') }}</th>
                      <th>{{ trans('cefamaps::environment.Description') }}</th>
                      <th>{{ trans('cefamaps::environment.Length') }}</th>
                      <th>{{ trans('cefamaps::environment.Latitude') }}</th>
                      <th>{{ trans('cefamaps::environment.Productive units') }}</th>
                      <th>{{ trans('cefamaps::environment.Type') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th>
                        <a href="{{ route('cefamaps.admin.environment.add')}}" class="btn btn-success">
                          <i class="fa-solid fa-square-plus"></i>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  @foreach($environ as $env)
                  <tbody>
                    <tr>
                      <td>{{$env->name}}</td>
                      src="{{ asset('storage/'.Auth::user()->person->avatar) }}"
                      <td><img src="{{ asset('cefamaps/imagenes/')}}"></td>
                      <td>{{$env->description}}</td>
                      <td>{{$env->length}}</td>
                      <td>{{$env->latitude}}</td>
                      <td>{{$env->productive_units_id}}</td>
                      <td>{{$env->type_environment}}</td>
                      <td>
                        <a href="#" class="btn btn-warning">
                          <i class="fas fa-map-signs"></i>
                        </a>
                        <a href="#" class="btn btn-warning">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>{{ trans('cefamaps::environment.Name') }}</th>
                      <th>{{ trans('cefamaps::environment.Picture') }}</th>
                      <th>{{ trans('cefamaps::environment.Description') }}</th>
                      <th>{{ trans('cefamaps::environment.Length') }}</th>
                      <th>{{ trans('cefamaps::environment.Latitude') }}</th>
                      <th>{{ trans('cefamaps::environment.Productive units') }}</th>
                      <th>{{ trans('cefamaps::environment.Type') }} {{ trans('cefamaps::environment.Environment') }}</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
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

  <script>

  $(document).ready(function () {
    $('#example1').DataTable({
      order: [[3, 'desc']],
    });
  });

  </script>

@endsection
