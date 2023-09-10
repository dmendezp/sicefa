@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::unit.Breadcrumb_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.admin.config.unit.index') }}"><i
                class="fas fa-solid fa-mountain-sun"></i> {{ trans('cefamaps::unit.Breadcrumb_Active_Unit') }}</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-square-plus"></i>
            {{ trans('cefamaps::unit.Breadcrumb_Active_Add_Unit') }}</a></li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::unit.Title_Card_Units') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <form method="post" action="{{ route('cefamaps.admin.config.unit.add') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- inicio del nombre -->
                                            <div class="form-group">
                                                <label for="name">{{ trans('cefamaps::unit.Label_Name_Unit') }}</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required>
                                            </div>
                                            <!-- fin del nombre -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- inicio del icono -->
                                            <div class="form-group">
                                                <label for="icon">{{ trans('cefamaps::unit.Label_Icon_Unit') }}</label>
                                                <select class="form-control select2" name="icon" id="icon">
                                                    <option value="">Seleccione...</option>
                                                    <!-- Iconos Animales -->
                                                    <option value="fa-solid fa-hippo">
                                                        {{ trans('cefamaps::unit.Icon_Hippo') }}
                                                    </option>
                                                    <option value="fa-solid fa-otter">
                                                        {{ trans('cefamaps::unit.Icon_Otter') }}
                                                    </option>
                                                    <option value="fa-solid fa-dog">{{ trans('cefamaps::unit.Icon_Dog') }}
                                                    </option>
                                                    <option value="fa-solid fa-cow">{{ trans('cefamaps::unit.Icon_Cow') }}
                                                    </option>
                                                    <option value="fa-solid fa-fish">
                                                        {{ trans('cefamaps::unit.Icon_Fish') }}
                                                    </option>
                                                    <option value="fa-solid fa-shrimp">
                                                        {{ trans('cefamaps::unit.Icon_Shrimp') }}
                                                    </option>
                                                    <option value="fa-solid fa-horse">
                                                        {{ trans('cefamaps::unit.Icon_Horse') }}
                                                    </option>
                                                    <option value="fa-solid fa-frog">
                                                        {{ trans('cefamaps::unit.Icon_Frog') }}
                                                    </option>
                                                    <option value="fa-solid fa-dove">
                                                        {{ trans('cefamaps::unit.Icon_Dove') }}
                                                    </option>
                                                    <option value="fa-solid fa-cat">{{ trans('cefamaps::unit.Icon_Cat') }}
                                                    </option>
                                                    <option value="fa-solid fa-piggy-bank">
                                                        {{ trans('cefamaps::unit.Icon_Piggy') }}</option>
                                                    <option value="fa-regular fa-lemon">
                                                        {{ trans('cefamaps::unit.Icon_Lemon') }}
                                                    </option>
                                                    <!-- Iconos Adicionales -->
                                                    <option value="fas fa-seedling">{{ trans('cefamaps::unit.Icon_Rice') }}
                                                    </option>
                                                    <option value="fa-solid fa-building-wheat">
                                                        {{ trans('cefamaps::unit.Icon_Wheat_Building') }}</option>
                                                    <option value="fa-solid fa-tree">
                                                        {{ trans('cefamaps::unit.Icon_Tree_Mango') }}</option>
                                                    <option value="fas fa-coffee">{{ trans('cefamaps::unit.Icon_Coffee') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- fin del icono -->
                                        </div>
                                        <div class="col-md-4">
                                            <!-- inicio del Sector -->
                                            <div class="form-group">
                                                <label
                                                    for="sector">{{ trans('cefamaps::unit.Label_Sector_Unit') }}</label>
                                                {!! Form::select(
                                                    'sector_id',
                                                    $sectoradd,
                                                    [],
                                                    ['class' => 'form-control', 'placeholder' => 'Seleccione...', 'required'],
                                                ) !!}
                                            </div>
                                            <!-- fin del Sector -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- incio de la farm -->
                                            <div class="form-group">
                                                <label for="farm">{{ trans('cefamaps::unit.Label_Farm_Unit') }}</label>
                                                {!! Form::select(
                                                    'farm_id',
                                                    $farm,
                                                    [],
                                                    ['class' => 'form-control', 'placeholder' => 'Seleccione...', 'required'],
                                                ) !!}
                                            </div>
                                            <!-- fin de la farm -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- inicio de la descripcion -->
                                            <div class="form-group">
                                                <label
                                                    for="description">{{ trans('cefamaps::unit.Label_Description_Unit') }}</label>
                                                <input type="text" class="form-control" id="description"
                                                    name="description" required>
                                            </div>
                                            <!-- fin de la descripcion -->
                                        </div>
                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-md-4">
                                            <!-- inicio de la persona encargada de la unidad -->
                                            <div class="form-group">
                                                <label
                                                    for="person">{{ trans('cefamaps::unit.Label_Person_Charge') }}</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control"
                                                        placeholder="{{ trans('cefamaps::unit.Placeholder_Person_Charge') }}"
                                                        id="document" name="document">
                                                    <div class="input-group-append">
                                                        <button id="search" class="btn btn-info btn-block"
                                                            type="button">{{ trans('cefamaps::unit.Btn_Search') }}</button>
                                                    </div>
                                                </div>
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
                                                    class="btn btn-light btn-block btn-outline-info btn-lg">{{ trans('cefamaps::unit.Btn_Register_Unit') }}</button>
                                            </div>
                                            <!-- fin boton de agregar -->
                                        </div>
                                    </div>
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
                        htmlResultados += `<label>{{ trans('cefamaps::unit.Document_Not_Found') }}</label>`;
                    }
                    result.innerHTML = htmlResultados;
                })
                .catch(error => console.error(error));
        });
    </script>
@endsection
