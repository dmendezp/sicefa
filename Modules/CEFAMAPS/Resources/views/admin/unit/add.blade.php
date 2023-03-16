@extends('cefamaps::layouts.master')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i> {{ trans('cefamaps::unit.Add') }} {{ trans('cefamaps::unit.Unit') }}</a></li>
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::unit.Units') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form method="post" action="{{ route('cefamaps.admin.config.unit.add')}}">
                  @csrf
                  <div class="row align-items-start">
                    <!-- inicio del nombre -->
                    <div class="col">
                      <div class="form-group">
                        <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                    </div>
                    <!-- fin del nombre -->
                    <div class="col">
                      <div class="form-group">
                        <label for="sector">{{ trans('cefampas::unit.Sector') }}</label>
                        <select class="form-control select2" name="sector" id="sector" required>
                          @foreach ($sector as $s)
                          <option value="{{ $s->id }}">{{ $s->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- inicio de la descripcion -->
                      <div class="form-group">
                        <label for="description">{{ trans('cefamaps::unit.Description') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <input type="text" class="form-control" id="description" name="description" required>
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
                          <option value="fa-solid fa-hippo">Hipopotamo</option>
                          <option value="fa-solid fa-otter">Nutria</option>
                          <option value="fa-solid fa-dog">Perro</option>
                          <option value="fa-solid fa-cow">Vaca</option>
                          <option value="fa-solid fa-fish">Pescado</option>
                          <option value="fa-solid fa-shrimp">Camarón</option>
                          <option value="fa-solid fa-horse">Caballo</option>
                          <option value="fa-solid fa-frog">Rana</option>
                          <option value="fa-solid fa-dove">Paloma</option>
                          <option value="fa-solid fa-cat">Gato</option>
                          <option value="fa-solid fa-piggy-bank">Cerdo</option>
                          <!-- Iconos Adicionales -->
                          <option value="fas fa-seedling">Arroz</option>
                          <option value="fa-solid fa-building-wheat">Edificio de Trigo</option>
                        </select>
                      </div>
                    </div>
                    <!-- fin del icono -->
                  </div>
                  <!-- inicio boton de agregar -->
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg" id="addunit">{{ trans('cefamaps::menu.Save') }} {{ trans('cefamaps::unit.Unit') }}</button>
                  </div>
                  <!-- fin boton de agregar -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

  <script>
    /* Inicio alerta para agregar una unidad en ambientes */
    document.getElementById('addunit').onclick = function(){
      Swal.fire({
        title:'Do you want to save the changes?',
        showdenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText:'Dont save',
      })
    }
    /* Fin alerta para agregar una unidad en ambientes */
  </script>

@endsection
