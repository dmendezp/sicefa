@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item">
      <a href="#">
        <i class="fas fa-solid fa-user-tie"></i>
            Gestor Ambientes
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
                                        <a class="btn btn-app  btn-app-2"
                                            href="{{ route('cefamaps.environmentmanager.config.class.index') }}">
                                            <i class="fas fa-solid fa-building-wheat"></i> {{ trans('cefamaps::general.Class') }}
                                        </a>
                                        <a class="btn btn-app btn-app-2"
                                            href="{{ route('cefamaps.environmentmanager.config.environment.index') }}">
                                            <i class="fas fa-solid fa-chalkboard-user"></i>
                                            {{ trans('cefamaps::dashboard.Title_Card_Environments') }}
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
