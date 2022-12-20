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
              <div class="content">
                  <h1>Agregar unidad</h1>
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



@endsection
