@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
      <a href="#">
        <i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::dashboard.Breadcrumb_CEFAMAPS_Admin') }}
      </a>
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::dashboard.Title_Card_Settings') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="mtop16">
                                        <a class="btn btn-app btn-app-2"
                                            href="{{ route('cefamaps.admin.config.sector.index') }}">
                                            <i class="fas fa-solid fa-vector-square"></i>
                                            {{ trans('cefamaps::dashboard.Title_Card_Sectors') }}
                                        </a>
                                        <a class="btn btn-app  btn-app-2"
                                            href="{{ route('cefamaps.admin.config.unit.index') }}">
                                            <i class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::dashboard.Title_Card_Units') }}
                                        </a>
                                        <a class="btn btn-app  btn-app-2"
                                            href="{{ route('cefamaps.admin.config.class.index') }}">
                                            <i class="fas fa-solid fa-building-wheat"></i> {{ trans('cefamaps::general.Class') }}
                                        </a>
                                        <a class="btn btn-app btn-app-2"
                                            href="{{ route('cefamaps.admin.config.environment.index') }}">
                                            <i class="fas fa-solid fa-chalkboard-user"></i>
                                            {{ trans('cefamaps::dashboard.Title_Card_Environments') }}
                                        </a>
                                        <a class="btn btn-app btn-app-2"
                                            href="{{ route('cefamaps.admin.config.page.index') }}">
                                            <i class="fas fa-regular fa-file-lines"></i> {{ trans('cefamaps::dashboard.Title_Card_Pages') }}
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
            title: "{{ trans('cefamaps::dashboard.Title_Alert') }} {{ Auth::user()->roles[0]->name }} - {{ Auth::user()->nickname }}",
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            html: "<lord-icon src='https://cdn.lordicon.com/vusrdugn.json' trigger='loop' delay='2000' colors='primary:#121331,secondary:#b26836,tertiary:#848484,quaternary:#f9c9c0,quinary:#30e849' style='width:150px;height:150px'>" +
                "</lord-icon>",
        })
    </script>
@endsection
