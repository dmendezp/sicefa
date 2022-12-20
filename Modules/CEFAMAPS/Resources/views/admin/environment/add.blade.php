@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i> {{ trans('cefamaps::environment.Add') }} {{ trans('cefamaps::environment.Environment') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::environment.Add') }} {{ trans('cefamaps::environment.Environment') }}</h3>
            </div>
            <div class="card-body">
              <!--div class="content"-->
                <form method="post" action="{{ route('cefamaps.admin.environment.add')}}">
                  @csrf
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('cefamaps::environment.Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio de la imagen -->
                  <div id="actions" class="row">
                    <div class="col-lg-12">
                      <div class="btn-group w-100">
                        <span class="btn btn-success col fileinput-button">
                          <i class="fas fa-plus"></i>
                          <span>Add files</span>
                        </span>
                        <button type="reset" class="btn btn-warning col cancel">
                          <i class="fas fa-times-circle"></i>
                          <span>Cancel upload</span>
                        </button>
                      </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                      <div class="fileupload-process w-100">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                      </div>
                    </div>
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
                        <input type="text" class="form-control" id="length" name="length" required>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="latitude">{{ trans('cefamaps::environment.Latitude') }}</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required>
                      </div>
                    </div>
                  </div>
                  <!-- fin de las longitudes y latitudes -->
                  <!-- inicio para el id de la unidad -->
                  <div class="row align-items-center">
                    <div class="col">
                      <div class="form-group">
                        <label for="per">{{ trans('cefamaps::environment.Productive units') }}</label>
                        <select class="form-control select2" style="width: 100%;" id="per" name="per">
                          @foreach ($unit as $u)
                            <option value="{{$u->id}}">{{$u->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <label for="latitude">{{ trans('cefamaps::environment.Add') }} {{ trans('cefamaps::environment.Productive units') }}</label>
                        <br>
                          <a href="{{ route('cefamaps.admin.unit.add')}}" class="btn btn-light btn-block btn-outline-success">
                            <i class="fa-solid fa-square-plus"></i>
                          </a>
                      </div>
                    </div>
                  </div>
                  <!-- fin para el id de la unidad -->
                  <!-- inicio boton de agregar -->
                  <div class="card-footer">
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::environment.Save') }}</button>
                    </div>
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



@endsection
