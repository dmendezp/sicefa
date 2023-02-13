@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-arrows-to-circle"></i> {{ trans('cefamaps::coordinates.Coordinates') }}</a></li>
@endsection

@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-lightblue card-outline">
          <div class="card-header">
            <h3 class="m-0">{{ trans('cefamaps::menu.Edit') }} {{ trans('cefamaps::coordinates.Coordinates') }}</h3>
          </div>
          <div class="card-body">
            <div class="content">
              <!-- contenido de editar -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

@endsection