@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">Configuracion del mapa</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <div class="container-fluid">
                  <div class="mtop16">
                    <a class="btn btn-app  btn-app-2" href="{{ route('cefamaps.admin.config.unit.index')}}">
                      <i class="fas fa-solid fa-mountain-sun"></i> Unidades
                    </a>
                    <a class="btn btn-app btn-app-2">
                      <i class="fas fa-solid fa-kaaba"></i> Areas
                    </a>
                    <a class="btn btn-app btn-app-2" href="{{ route('cefamaps.admin.config.environment.index') }}">
                      <i class="fas fa-solid fa-chalkboard-user"></i> Ambientes
                    </a>
                  </div>
                </div>
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

  Swal.fire({
    title: 'Bienvenido {{ Auth::user()->roles[0]->name }} - {{ Auth::user()->nickname }}',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
  })

  </script>

@endsection
