@extends('senaempresa::layouts.master')
@section('stylesheet')
    <style>
        /* Estilo del fondo oscuro detrás del modal */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* Estilo del modal */
        .modal-content {
            background-color: #fff;
            /* Cambia el color de fondo del modal */
            border-radius: 10px;
            /* Agrega bordes redondeados al modal */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.296);
            /* Agrega una sombra al modal */
        }

        /* Estilo del encabezado del modal */
        .modal-header {
            background-color: #2ea29c;
            /* Cambia el color de fondo del encabezado */
            color: #fff;
            /* Cambia el color del texto del encabezado */
            border-bottom: none;
            /* Quita el borde inferior del encabezado */
        }

        /* Estilo del cuerpo del modal */
        .modal-body {
            padding: 20px;
            /* Añade espacio interno al cuerpo del modal */
        }

        /* Estilo del título del modal */
        .modal-title {
            color: #fff;
            /* Cambia el color del título del modal */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        @if (Auth::user()->havePermission('senaempresa.admin.vacancies.filter') && Route::is('senaempresa.admin.*'))
            <div class="row">
                <div class="col">
                    <form method="GET"
                        action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}">
                        <label for="cursoFilter">{{ trans('senaempresa::menu.Filter by course') }}:</label>
                        <select class="form-control" id="cursoFilter" name="cursoFilter" onchange="this.form.submit()">
                            <option value="">{{ trans('senaempresa::menu.All courses') }}</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $selectedCourseId == $course->id ? 'selected' : '' }}>
                                    {{ $course->code }} {{ $course->program->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col">
                    <form method="GET"
                        action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}">
                        <label for="senaempresaFilter">{{ trans('senaempresa::menu.Filter by senaempresa') }}:</label>
                        <select class="form-control" id="senaempresaFilter" name="senaempresaFilter"
                            onchange="this.form.submit()">
                            <option value="" {{ !$selectedSenaempresaId ? 'selected' : '' }}>
                                {{ trans('senaempresa::menu.All Senaempresas') }}</option>
                            @foreach ($senaempresas as $senaempresa)
                                <option value="{{ $senaempresa->id }}"
                                    {{ $selectedSenaempresaId == $senaempresa->id ? 'selected' : '' }}>
                                    {{ $senaempresa->id }} {{ $senaempresa->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        @endif
        <br>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    @if (Route::is('senaempresa.apprentice.*'))
                        <table id="inventory" class="table table-striped table-bordered">
                        @elseif (Route::is('senaempresa.admin.*'))
                            <table id="datatable" class="table table-striped table-bordered">
                    @endif
                    <thead>
                        <tr>
                            <th style="width: 15px;">#</th>
                            <th>{{ trans('senaempresa::menu.Name') }}</th>
                            <th>{{ trans('senaempresa::menu.Presentation') }}</th>
                            <th>{{ trans('senaempresa::menu.Id Position') }}</th>
                            <th>{{ trans('senaempresa::menu.Status') }}</th>
                            <th class="text-center">{{ trans('senaempresa::menu.Details') }}</th>
                            @if (Route::is('senaempresa.admin.*') &&
                                    Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.new'))
                                <th style="width: 100px;"><a
                                        href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.new') }}"
                                        class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vacancy->name }}</td>
                                <td><img src="{{ asset($vacancy->image) }}" alt="{{ $vacancy->name }}" width="200">
                                </td>
                                <td>
                                    @foreach ($PositionCompany as $position)
                                        @if ($position->id == $vacancy->position_company_id)
                                            {{ $position->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $vacancy->state }}</td>
                                <td class="text-center">
                                    <a class="openModalBtn" title="Ver información" data-bs-toggle="modal"
                                        data-bs-target="#myModal" data-vacancy='@json($vacancy)'>
                                        <i class="fas fa-eye" style="color: #000000;"></i>
                                    </a>
                                    @if (Auth::check())
                                        @if (Auth::user()->roles[0]->name === 'Aprendiz Senaempresa' || Route::is('senaempresa.apprentice.*'))
                                            @if (Auth::user()->person->apprentices()->where('course_id', $vacancy->course_id)->exists())
                                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.inscription', ['vacancy_id' => $vacancy->id]) }}"
                                                    title="Inscripción">
                                                    <i class="fas fa-user-plus" style="color: #000000;"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                @if (Route::is('senaempresa.admin.*') &&
                                        Auth::user()->havePermission(
                                            'senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.delete'))
                                    <form class="formEliminar"
                                        action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.delete', $vacancy->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td>
                                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.edit', ['id' => $vacancy->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </form>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('senaempresa::Company.vacancies.details')
@endsection

<!--scripts utilizados para procesos-->
@section('scripts')
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('.formEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "{{ trans('senaempresa::menu.Are you sure?') }}",
                        text: "{{ trans('senaempresa::menu.It is an irreversible process.') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ trans('senaempresa::menu.Yes, delete it') }}",
                        cancelButtonText: "{{ trans('senaempresa::menu.Cancel') }}" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar el formulario usando AJAX
                            axios.post(form.action, new FormData(form))
                                .then(function(response) {
                                    // Manejar la respuesta JSON del servidor
                                    if (response.data && response.data.mensaje) {
                                        Swal.fire({
                                            title: '{{ trans('senaempresa::menu.Vacancy deleted!') }}',
                                            text: response.data.mensaje,
                                            icon: 'success'
                                        }).then(() => {
                                            // Recargar la página u otra acción según sea necesario
                                            location
                                                .reload(); // Recargar la página después de eliminar
                                        });
                                    }
                                })
                                .catch(function(error) {
                                    // Manejar errores si es necesario
                                    console.error(error);
                                });
                        }
                    });
                });
            });
    </script>
@endsection
