@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.sector.index') }}"><i class="fas fa-solid fa-vector-square"></i> {{ trans('cefamaps::sector.Sector') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i>{{$editsector->id}}</i> {{$editsector->name}}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Edit') }} {{$editsector->name}}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('cefamaps.admin.sector.edit') }}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $editsector->id }}">
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::sector.Sector') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $editsector->name }}" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio de la descripcion -->
                  <div class="form-group">
                    <label for="description">{{ trans('cefamaps::sector.Description') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::sector.Sector') }}</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $editsector->description }}" required>
                  </div>
                  <!-- fin de la descripcion -->
                  <!-- inicio del boton de agregar -->
                  <div class="d-grip gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                      {{ trans('cefamaps::menu.Edit') }} {{ trans('cefamaps::sector.Sector') }}
                    </button>
                  </div>
                  <!-- fin del boton de agregar -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
