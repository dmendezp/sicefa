@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.farm.index') }}"><i class="fas fa-solid fa-tractor"></i> {{ trans('cefamaps::farm.Farm') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas "></i> {{$editfarm->name}}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Edit') }} {{$editfarm->name}}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('cefamaps.admin.farm.edit') }}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $editfarm->id }}" required>
                  <div class="row align-items-start">
                    <!-- inicio del nombre -->
                    <div class="col">
                      <div class="form-group">
                        <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $editfarm->name }}" required>
                      </div>
                    </div>
                    <!-- fin del nombre -->
                    <!-- inicio del area -->
                    <div class="col">
                      <div class="form-group">
                        <label for="area">{{ trans('cefamaps::farm.Area') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <input type="number" class="form-control" id="area" name="area" value="{{ $editfarm->area }}" required>
                      </div>
                    </div>
                    <!-- fin del area -->
                  </div>
                  <div class="row align-items-center">
                    <!-- inicio de la descripcion -->
                    <div class="col">
                      <div class="form-group">
                        <label for="description">{{ trans('cefamaps::farm.Description') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $editfarm->description }}" required>
                      </div>
                    </div>
                    <!-- fin de la descripcion -->
                  </div>
                  <div class="row align-items-footer">
                    <!-- inicio de la persona encargada de la FARM -->                  
                    <div class="col">
                      <div class="form-group">
                        <label for="person">{{ trans('cefamaps::farm.Person in charge') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <select class="form-control select2" name="person" id="person">
                          @foreach ($person as $p)
                            <option value="{{$p->id}}">{{$p->first_name}} {{$p->first_last_name}} {{$p->second_last_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- fin de la persona encargada de la FARM -->
                    <!-- inicio del municipio -->
                    <div class="col">
                      <div class="form-group">
                        <label for="muni">{{ trans('cefamaps::farm.Municipality') }}</label>
                        <select class="form-control select2" name="muni" id="muni">
                          @foreach ($muni as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- fin del municipio -->
                  </div>
                  <!-- inicio del boton de agregar -->
                  <div class="d-grip gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                      {{ trans('cefamaps::menu.Edit') }} {{ trans('cefamaps::farm.Farm') }}
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