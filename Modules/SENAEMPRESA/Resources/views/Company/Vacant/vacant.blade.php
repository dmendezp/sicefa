<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')

<body>
    @csrf
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        @include('senaempresa::layouts.structure.breadcrumb')

        <div class="container">
            <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
            <!-- Formulario para filtrar por curso -->
            <form method="GET" action="{{ route('cefa.vacantes') }}">
                <label for="cursoFilter">{{ trans('senaempresa::menu.Filter by course') }}:</label>
                <select class="form-control" id="cursoFilter" name="cursoFilter" onchange="this.form.submit()">
                    <option value="">{{ trans('senaempresa::menu.All courses') }}</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $selectedCourseId == $course->id ? 'selected' : '' }}>
                            {{ $course->code }} {{ $course->program->name }}
                        </option>
                    @endforeach
                </select>
            </form><br>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Id') }}</th>
                                    <th>{{ trans('senaempresa::menu.Name') }}</th>
                                    <th>{{ trans('senaempresa::menu.Presentation') }}</th>
                                    <th>{{ trans('senaempresa::menu.Id Position') }}</th>
                                    <th>{{ trans('senaempresa::menu.Start Date and Time') }}</th>
                                    <th>{{ trans('senaempresa::menu.Date and Time End') }}</th>
                                    <th class="text-center">{{ trans('senaempresa::menu.Registration') }}</th>
                                    <th><a href="{{ route('cefa.agregar_vacante') }}" class="btn btn-success btn-sm"><i
                                                class="fas fa-user-plus"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Verificar si no hay vacantes disponibles para el curso seleccionado -->
                                @if ($vacancies->isEmpty())
                                    <div class="alert alert-info" role="alert">
                                        {{ trans('senaempresa::menu.There are no vacancies available for the selected course') }}
                                    </div><br>
                                @else
                                    @foreach ($vacancies as $vacancy)
                                        <tr>
                                            <td>{{ $vacancy->id }}</td>
                                            <td>{{ $vacancy->name }}</td>
                                            <td><img src="{{ asset($vacancy->image) }}" alt="{{ $vacancy->name }}">
                                            </td>
                                            <td>
                                                @foreach ($PositionCompany as $position)
                                                    @if ($position->id == $vacancy->position_company_id)
                                                        {{ $position->description }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $vacancy->start_datetime }}</td>
                                            <td>{{ $vacancy->end_datetime }}</td>
                                            <td class="text-center">
                                                <a class="openModalBtn" title="Inscripción"
                                                    data-vacancy='@json($vacancy)' data-bs-toggle="modal"
                                                    data-bs-target="#myModal">
                                                    <i class="fas fa-eye" style="color: #000000;"></i>
                                                </a>
                                            </td>
                                            <form class="formEliminar"
                                                action="{{ route('cefa.eliminar_vacante', $vacancy->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <td>
                                                    <a href="{{ route('cefa.editar_vacante', ['id' => $vacancy->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('senaempresa::Company.Vacant.inscription')
        @section('content')
        @show

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

    </div>
    <!-- Main Footer -->
    @include('senaempresa::layouts.structure.footer')

    @include('senaempresa::layouts.structure.scripts')

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
    @show

    @section('dataTables')
    @show
</body>

</html>