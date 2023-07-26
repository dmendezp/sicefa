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
              <h3 class="m-0">{{ trans('ganaderia::menu.Add') }} {{ trans('ganaderia::leader.Animal') }}</h3>
            </div>
            <div class="card-body">
              <div class="content">
                <form action="{{ route('ganaderia.admin.leader.addpost') }}" method="post">
                  @csrf
                  <!-- inicio del nombre -->
                  <div class="form-group">
                    <label for="name">{{ trans('ganaderia::leader.Name') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- fin del nombre -->
                  <!-- inicio del codigo -->
                  <div class="form-group">
                    <label for="code">{{ trans('ganaderia::leader.Code') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                  </div>
                  <!-- fin del codigo -->
                  <!-- inicio de la raza -->
                  <div class="form-group">
                    <label for="race">{{ trans('ganaderia::leader.Race') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    {!! Form::select('races_id',$raceadd, [],['class' => 'form-control','placeholder' => 'Seleccione...','required']) !!}
                  </div>
                  <!-- fin de la raza -->
                  <!-- inicio de la madre -->
                  <div class="form-group">
                    <label for="mother">{{ trans('ganaderia::leader.Mother') }}</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="{{ trans('ganaderia::leader.Code') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Mother') }}" id="mother" name="mother">
                      <div class="input-group-append">
                        <button id="search" class="btn btn-info btn-block" type="button">{{ trans('ganaderia::leader.Search') }}</button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div id="resultMother"></div>
                  </div>
                  <!-- fin de la madre -->
                  <!-- inicio del peso -->
                  <div class="form-group">
                    <label for="peso">{{ trans('ganaderia::leader.Weight') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    <input type="number" class="form-control" id="peso" name="peso" required>
                  </div>
                  <!-- fin del peso -->
                  <!-- inicio del sexo -->
                  <div class="form-group">
                    <label for="sex">{{ trans('ganaderia::leader.Sex') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    {!! Form::select('sex',getEnumValues('animals', 'sex'),null, ['class' =>'form-control','placeholder' => 'Selecciona...','required']) !!}
                  </div>
                  <!-- fin del sexo -->
                  <!-- inicio del color -->
                  <div class="form-group">
                    <label for="color">{{ trans('ganaderia::leader.Color') }} {{ trans('ganaderia::leader.Of The') }} {{ trans('ganaderia::leader.Animal') }}</label>
                    <input type="text" class="form-control" id="color" name="color" required>
                  </div>
                  <!-- fin del color -->
                  <!-- inicio del fecha -->
                  <div class="form-group">
                    <label for="date">{{ trans('ganaderia::leader.Date') }} {{ trans('ganaderia::leader.Of') }} {{ trans('ganaderia::leader.Birth') }}</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                  </div>
                  <!-- fin del fecha -->
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
  </div>
@endsection

@section('script')

  <script type="text/javascript">

  const inputMother = document.getElementById('mother');
  const btnSearch = document.getElementById('search');
  const result = document.getElementById('resultMother');

  btnSearch.addEventListener('click', () => {
    const mother = inputMother.value;
    const url = `/ganaderia/admin/animal/search/${mother}`;

    if (inputMother.value === '') {
      /* alert('Por favor ingresa el número de documento'); */
      Swal.fire({
        title: '{{ trans("ganaderia::leader.AlertDocumentTitle") }}',
        text: '{{ trans("ganaderia::leader.AlertDocumentText") }}?',
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
      search.forEach(animal => {
        htmlResultados += `<label>${animal.name}</label>`;
        htmlResultados += `<input type="hidden" value="${animal.name}" name="mother">`;
      });
      // Por si el docuemnto no existe
      if (htmlResultados === '') {
        htmlResultados += `<label>{{trans("ganaderia::leader.Document notfound")}}</label>`;
      }
      result.innerHTML = htmlResultados;
    })
    .catch(error => console.error(error));
  });

  </script>

@endsection