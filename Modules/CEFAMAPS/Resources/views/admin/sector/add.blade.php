@extends('cefamaps::layouts.master')

@section('breadcrumb')

  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i> {{ trans('cefamaps::menu.Administrator') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.farm.index') }}"><i class="fas fa-solid fa-tractor"></i> {{ trans('cefamaps::farm.Farm') }}</a></li>
  <li class="breadcrumb-item"><a href="#"><i class="fas fa-solid fa-square-plus"></i> {{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::farm.Farm') }}</a></li>

@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-lightblue card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::farm.Farm') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('cefamaps.admin.config.farm.add') }}" method="post">
                  @csrf
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('cefamaps::menu.Name') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio de la descripcion -->
                  <div class="form-group">
                    <label for="description">{{ trans('cefamaps::farm.Description') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                  </div>
                  <!-- fin de la descripcion -->
                  <div class="row align-items-center">
                    <div class="col">
                      <!-- inicio del municipio -->
                      <div class="form-group">
                        <label for="muni">{{ trans('cefamaps::farm.Municipality') }}</label>
                        <select class="form-control select2" name="muni" id="muni">
                          @foreach ($muni as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- fin del municipio -->
                    </div>
                    <div class="col">
                      <!-- inicio del area -->
                      <div class="form-group">
                        <label for="area">{{ trans('cefamaps::farm.Area') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::farm.Farm') }}</label>
                        <input type="number" class="form-control" id="area" name="area" required>
                      </div>
                      <!-- fin del area -->
                    </div>
                  </div>
                  <div class="row align-items-end">
                    <div class="col">
                      <!-- inicio de la persona encargada de la Granja -->  
                      <div class="form-group">
                        <label for="person">{{ trans('cefamaps::unit.Person in charge') }} {{ trans('cefamaps::unit.Of The') }} {{ trans('cefamaps::unit.Unit') }}</label>
                        <div class="input-group mb-3">
                          <input type="number" class="form-control" placeholder="{{ trans('cefamaps::unit.Number') }} {{ trans('cefamaps::menu.Of The') }} {{ trans('cefamaps::unit.Document') }}" id="document" name="document">
                          <div class="input-group-append">
                            <button id="search" class="btn btn-info btn-block" type="button">{{ trans('cefamaps::menu.Search') }}</button>
                          </div>
                        </div>
                      </div>
                      <!-- fin de la persona encargada de la FARM -->
                    </div>
                    <div class="col-4">
                      <!-- Inicio del resultado de la busqueda -->
                      <div class="form-group">
                        <div id="resultDocument"></div>
                      </div>
                      <!-- Fin del resultado de la busqueda -->
                    </div>
                  </div>
                  <!-- inicio del boton -->
                  <div class="d-grip gap-2">
                    <button type="submit" class="btn btn-light btn-block btn-outline-info btn-lg">
                        {{ trans('cefamaps::menu.Add') }} {{ trans('cefamaps::farm.Farm') }}
                    </button>
                  </div>
                  <!-- fin del boton -->
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

    const inputDocument = document.getElementById('document');
    const btnSearch = document.getElementById('search');
    const result = document.getElementById('resultDocument');

    btnSearch.addEventListener('click', () => {
      const documento = inputDocument.value;
      const url = `/cefamaps/unit/search/${documento}`;

      if (inputDocument.value === '') {
        /* alert('Por favor ingresa el número de documento'); */
        Swal.fire({
          title: '{{ trans("cefamaps::unit.AlertDocumentTitle") }}',
          text: '{{ trans("cefamaps::unit.AlertDocumentText") }}?',
          icon: 'question',
          showConfirmButton: false,
          timer: 3300
        })
        return;
      }
      
      // Envía la solicitud AJAX al servidor
      fetch(url)
      .then(response => response.json())
      .then(search => {
        // Muestra los resultados en la vista
        let htmlResultados = '';
        search.forEach(person => {
          htmlResultados += `<label>${person.first_name} ${person.first_last_name} ${person.second_last_name}</label>`;
          htmlResultados += `<input type="hidden" value="${person.id}" name="person">`;
        });
        // Por si el docuemnto no existe
        if (htmlResultados === '') {
          htmlResultados += `<label>{{trans("cefamaps::unit.Document notfound")}}</label>`;
        }
        result.innerHTML = htmlResultados;
      })
      .catch(error => console.error(error));
    });

  </script>

@endsection