@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::unit.Breadcrumb_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.unit.index') }}"><i
                class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Breadcrumb_Active_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-map-signs"></i> {{ trans('cefamaps::unit.Breadcrumb_Active_Edit_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fas {{ $editunit->icon }}"></i> {{ $editunit->name }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::unit.Title_Card_Edit_Unit') }} :
                                <em>{{ $editunit->name }}</em>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <form action="{{ route('cefamaps.admin.unit.edit') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $editunit->id }}" required>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- inicio del nombre -->
                                            <div class="form-group">
                                                <label for="name">{{ trans('cefamaps::unit.Label_Name_Unit') }}
                                                </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $editunit->name }}" required>
                                            </div>
                                            <!-- fin del nombre -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- inicio del icono -->
                                            <div class="form-group">
                                                <label for="icon">{{ trans('cefamaps::unit.Label_Icon_Unit') }}</label>
                                                <?php
                                                $datosDefinidos = [
                                                    'fa-solid fa-hippo' => 'Hipopotamo',
                                                    'fa-solid fa-otter' => 'Nutria',
                                                    'fa-solid fa-dog' => 'Perro',
                                                    'fa-solid fa-cow' => 'Vaca',
                                                    'fa-solid fa-fish' => 'Pescado',
                                                    'fa-solid fa-shrimp' => 'Camarón',
                                                    'fa-solid fa-horse' => 'Caballo',
                                                    'fa-solid fa-frog' => 'Rana',
                                                    'fa-solid fa-dove' => 'Paloma',
                                                    'fa-solid fa-cat' => 'Gato',
                                                    'fa-solid fa-piggy-bank' => 'Cerdo',
                                                    'fa-regular fa-lemon' => 'Limon',
                                                    'fas fa-seedling' => 'Arroz',
                                                    'fa-solid fa-building-wheat' => 'Edificio de Trigo',
                                                    'fa-solid fa-tree' => 'Arbol de Mango',
                                                    'fas fa-coffee' => 'Cafe',
                                                ];
                                                
                                                $datoIngresado = $editunit->icon;
                                                
                                                echo '<select class="form-control select2" name="icon" id="icon">';
                                                foreach ($datosDefinidos as $valor => $texto) {
                                                    echo '<option value="' . $valor . '"';
                                                    if ($valor === $datoIngresado) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $texto . '</option>';
                                                }
                                                echo '</select>';
                                                ?>
                                            </div>
                                            <!-- fin del icono -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- inicio del Sector -->
                                            <div class="form-group">
                                                <label for="sector">{{ trans('cefamaps::unit.Label_Sector_Unit') }}</label>
                                                {!! Form::select('sector_id', $sectoredit, $editunit->sector_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Seleccione...',
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <!-- fin del Sector -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- incio de la farm -->
                                            <div class="form-group">
                                                <label for="farm">{{ trans('cefamaps::unit.Label_Farm_Unit') }}</label>
                                                {!! Form::select('farm_id', $farm, $editunit->farm_id, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Seleccione...',
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <!-- fin de la farm -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- inicio de la descripcion -->
                                            <div class="form-group">
                                                <label for="description">{{ trans('cefamaps::unit.Label_Description_Unit') }}</label>
                                                <input type="text" class="form-control" id="description"
                                                    name="description" value="{{ $editunit->description }}" required>
                                            </div>
                                            <!-- fin de la descripcion -->
                                        </div>
                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-md-4">
                                            <!-- inicio de la persona encargada de la unidad -->
                                            <div class="form-group">
                                                <label for="person">{{ trans('cefamaps::unit.Label_Person_Charge') }}</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control"
                                                        placeholder="{{ trans('cefamaps::unit.Placeholder_Person_Charge') }}"
                                                        id="document" name="document"
                                                        value="{{ $editunit->person->document_number }}">
                                                    <div class="input-group-append">
                                                        <button id="search" class="btn btn-info btn-block"
                                                            type="button">{{ trans('cefamaps::unit.Btn_Search') }}</button>
                                                    </div>
                                                </div>
                                                <div class="form-text">{{ trans('cefamaps::unit.Help_Text_Person_Charge') }}</div>
                                            </div>
                                            <!-- fin de la persona encargada de la unidad -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- Inicio del resultado de la busqueda -->
                                            <div class="form-group">
                                                <div id="resultDocument"></div>
                                            </div>
                                            <!-- Fin del resultado de la busqueda -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- inicio boton de agregar -->
                                            <div class="d-grid gap-2">
                                                <button type="submit"
                                                    class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::unit.Btn_Edit_Unit') }}</button>
                                            </div>
                                            <!-- fin boton de agregar -->
                                        </div>
                                    </div>
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
                    title: '{{ trans('cefamaps::unit.AlertDocumentTitle') }}',
                    text: '{{ trans('cefamaps::unit.AlertDocumentText') }}?',
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
                        htmlResultados +=
                            `<label>${person.first_name} ${person.first_last_name} ${person.second_last_name}</label>`;
                        htmlResultados += `<input type="hidden" value="${person.id}" name="person">`;
                    });
                    // Por si el docuemnto no existe
                    if (htmlResultados === '') {
                        htmlResultados += `<label>{{ trans('cefamaps::unit.Document_not_found') }}</label>`;
                    }
                    result.innerHTML = htmlResultados;
                })
                .catch(error => console.error(error));
        });
    </script>
@endsection
