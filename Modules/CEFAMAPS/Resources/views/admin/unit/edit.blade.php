@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::menu.Edit') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas {{$editunit->icon}}"></i> {{$editunit->name}}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Edit') }} {{$editunit->name}}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('cefamaps.admin.unit.edit') }}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $editunit->id }}" required>
                  <div class="row align-items-start">
                    <!-- inicio del nombre -->
                    <div class="col">
                      <div class="form-group">
                        <label for="name">{{ trans('cefamaps::unit.Name') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $editunit->name }}" required>
                      </div>
                    </div>
                    <!-- fin del nombre -->
                    <!-- inicio del Sector -->
                    <div class="col">
                      <div class="form-group">
                        <label for="sector">{{ trans('cefamaps::unit.Sector') }}</label>
                        <select class="form-control select2" name="sector" id="sector" required>
                          @foreach ($sector as $s)
                          <option value="{{ $s->id }}">{{ $s->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- fin del Sector -->
                    
                  </div>
                  <!-- inicio de la descripcion -->
                  <div class="form-group">
                        <label for="description">{{ trans('cefamaps::unit.Description') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $editunit->description }}" required>
                      </div>
                      <!-- fin de la descripcion -->
                  <div class="row align-items-center">
                    <!-- inicio de la persona encargada de la unidad -->                  
                    <div class="col">
                      <div class="form-group">
                        <label for="person">{{ trans('cefamaps::unit.Person in charge') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <select class="form-control select2" name="person" id="person">
                          @foreach ($person as $p)
                            <option value="{{$p->id}}">{{$p->first_name}} {{$p->first_last_name}} {{$p->second_last_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- fin de la persona encargada de la unidad -->
                    <!-- inicio del icono -->
                    <div class="col">
                      <div class="form-group">
                        <label for="icon">{{ trans('cefamaps::unit.Icon') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <select class="form-control select2" name="icon" id="icon">
                          <!-- Iconos Animales -->
                          <option value="fa-solid fa-hippo">{{ trans('cefamaps::unit.Hipopotamo') }}</option>
                          <option value="fa-solid fa-otter">{{ trans('cefamaps::unit.Nutria') }}</option>
                          <option value="fa-solid fa-dog">{{ trans('cefamaps::unit.Perro') }}</option>
                          <option value="fa-solid fa-cow">{{ trans('cefamaps::unit.Vaca') }}</option>
                          <option value="fa-solid fa-fish">{{ trans('cefamaps::unit.Pescado') }}</option>
                          <option value="fa-solid fa-shrimp">{{ trans('cefamaps::unit.Camarón') }}</option>
                          <option value="fa-solid fa-horse">{{ trans('cefamaps::unit.Caballo') }}</option>
                          <option value="fa-solid fa-frog">{{ trans('cefamaps::unit.Rana') }}</option>
                          <option value="fa-solid fa-dove">{{ trans('cefamaps::unit.Paloma') }}</option>
                          <option value="fa-solid fa-cat">{{ trans('cefamaps::unit.Gato') }}</option>
                          <option value="fa-solid fa-piggy-bank">{{ trans('cefamaps::unit.Cerdo') }}</option>
                          <option value="fa-regular fa-lemon">{{ trans('cefamaps::unit.Limon') }}</option>
                          <!-- Iconos Adicionales -->
                          <option value="fas fa-seedling">{{ trans('cefamaps::unit.Arroz') }}</option>
                          <option value="fa-solid fa-building-wheat">{{ trans('cefamaps::unit.Edificio de Trigo') }}</option>
                        </select>
                      </div>
                    </div>
                    <!-- fin del icono -->
                  </div>
                  <!-- inicio boton de agregar -->
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::menu.Edit') }} {{ trans('cefamaps::unit.Unit') }}</button>
                  </div>
                  <!-- fin boton de agregar -->
                </form>
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