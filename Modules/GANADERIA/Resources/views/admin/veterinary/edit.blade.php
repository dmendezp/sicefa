@extends('ganaderia::layouts.master')

@section('style')
@endsection

@section('breadcrumb')
@endsection

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="m-0">{{ trans('ganaderia::menu.Edit') }}</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('ganaderia.admin.vet.editpost') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $treat->id }}">
                <!-- inicio del inventario -->
                <div class="form-group">
                  <label for="invent">{{ trans('ganaderia::vet.Inventario usado') }}</label>
                  {!! Form::select('inventory_id',$inven, $treat->inventory_id,['class' => 'form-control','placeholder' => 'Seleccione...','required']) !!}
                </div>
                <!-- fin del inventario -->
                <!-- inicio del animal que se le hizo el tratamiento -->
                <div class="form-group">
                  <label for="animal">{{ trans('ganaderia::vet.animal que se trato') }}</label>
                  {!! Form::select('animal_id',$animal, $treat->animal_id,['class' => 'form-control','placeholder' => 'Seleccione...','required']) !!}
                </div>
                <!-- fin del animal que se le hizo el tratamiento -->
                <!-- inicio de la fecha del tratamiento -->
                <div class="form-group">
                  <label for="treat">{{ trans('ganaderia::vet.fecha del tratamiento') }}</label>
                  <input type="date" class="form-control" name="treat" id="treat" value="{{ $treat->date_treatment }}">
                </div>
                <!-- fin de la fecha del tratamiento -->
                <!-- inico de la dosis aplicadas -->
                <div class="form-group">
                  <label for="dose">{{ trans('ganaderia::vet.dosis aplicadas') }}</label>
                  <input type="number" class="form-control" name="dose" id="dose" value="{{ $treat->dose }}">
                </div>
                <!-- fin de la dosis aplicadas -->
                <!-- inicio del nombre de la medcina -->
                <div class="form-group">
                  <label for="medi">{{ trans('ganaderia::vet.Nombre de la Medicina') }}</label>
                  <input type="text" class="form-control" name="medi" id="medi" value="{{ $treat->name_medicine }}">
                </div>
                <!-- fin del nombre de la medcina -->
                <!-- inicio de la observacion -->
                <div class="form-group">
                  <label for="obser">{{ trans('ganaderia::vet.Observacion del tratamiento') }}</label>
                  <input type="text" class="form-control" name="obser" id="obser" value="{{ $treat->observations }}">
                </div>
                <!-- fin de la observacion -->
                <!-- inicio de la persona que le aplico el tratamiento -->
                <div class="form-group">
                  <label for="person">{{ trans('ganaderia::leader.Person in charge') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Unit') }}</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="{{ trans('ganaderia::leader.Number') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Document') }}" id="document" name="document">
                    <div class="input-group-append">
                      <button id="search" class="btn btn-info btn-block" type="button">{{ trans('ganaderia::leader.Search') }}</button>
                    </div>
                  </div>
                </div>
                <!-- fin de la persona que le aplico el tratamiento -->
                <!-- Inicio del resultado de la busqueda -->
                <div class="form-group">
                  <div id="resultDocument"></div>
                </div>
                <!-- Fin del resultado de la busqueda -->
                <!-- inicio del boton -->
                <div class="d-grip gap-2">
                  <button type="submit" class="btn btn-light btn-block btn-outline-success btn-lg">
                    {{ trans('ganaderia::menu.Add') }}
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

@endsection

@section('script')

  <script>

    const inputDocument = document.getElementById('document');
    const btnSearch = document.getElementById('search');
    const result = document.getElementById('resultDocument');

    btnSearch.addEventListener('click', () => {
      const documento = inputDocument.value;
      const url = `/ganaderia/admin/search/${documento}`;

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