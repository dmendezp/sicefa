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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('danger') }}
                </div>
            @endif
            <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>

            <!-- Verificar si no hay cursos relacionados con vacantes -->
            @if ($courses->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No hay cursos relacionados con vacantes.
                </div>
            @else
                <!-- Formulario para filtrar por curso -->
                <form method="GET" action="{{ route('cefa.vacantes') }}">
                    <label for="cursoFilter">Filtrar por Curso:</label>
                    <select class="form-control" id="cursoFilter" name="cursoFilter" onchange="this.form.submit()">
                        <option value="">Todos los cursos</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $selectedCourseId == $course->id ? 'selected' : '' }}>
                                {{ $course->code }} {{ $course->program->name }}
                            </option>
                        @endforeach
                    </select>
                </form><br>

                <!-- Verificar si no hay vacantes disponibles para el curso seleccionado -->
                @if ($vacancies->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No hay vacantes disponibles para el curso seleccionado.
                    </div><br>
                @else
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Presentación</th>
                                            <th>Id Cargo</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th class="text-center">Inscripción</th>
                                            <th><a href="{{ route('cefa.agregar_vacante') }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vacancies as $vacancy)
                                            <tr>
                                                <td>{{ $vacancy->id }}</td>
                                                <td>{{ $vacancy->name }}</td>
                                                <td><img src="{{ asset($vacancy->image) }}"
                                                        alt="{{ $vacancy->name }}"></td>
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
                                                        data-vacancy='@json($vacancy)'
                                                        data-bs-toggle="modal" data-bs-target="#myModal">
                                                        <i class="fas fa-eye" style="color: #000000;"></i>
                                                    </a>
                                                </td>
                                                <form action="{{ route('cefa.eliminar_vacante', $vacancy->id) }}"
                                                    method="POST" class="formEliminar">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
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
                            title: '¿Estás seguro?',
                            text: 'Es un proceso irreversible.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarlo',
                            cancelButtonText: 'Cancelar' // Cambiar el texto del botón "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Enviar el formulario usando AJAX
                                axios.post(form.action, new FormData(form))
                                    .then(function(response) {
                                        // Manejar la respuesta JSON del servidor
                                        if (response.data && response.data.mensaje) {
                                            Swal.fire({
                                                title: '¡Vacante eliminada!',
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
