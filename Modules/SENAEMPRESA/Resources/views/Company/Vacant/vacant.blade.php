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


            <h1 class="text-center"><strong><em><span>Vacantes</span></em></strong></h1>
            <div class="col-md-3">


                <label for="cursoFilter">Filtrar por Curso:</label>
                <select class="form-control" id="cursoFilter">
                    <option value="">Todos los cursos</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->code }} {{ $course->program->name }}</option>
                    @endforeach
                </select>
            </div><br>
            <div class="col-md-12">
                <div class="vacantes">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead class="vacant bg-primary text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Presentación</th>
                                    <th>Id Cargo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th class="text-center">Inscripción</th>
                                    <th><a href="{{ route('agregar_vacante') }}" class="btn btn-success btn-sm"><i
                                                class="fas fa-user-plus"></i></a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacancies as $vacancy)
                                    <tr>
                                        <td>{{ $vacancy->id }}</td>
                                        <td>{{ $vacancy->name }}</td>
                                        <td><img src="{{ asset($vacancy->image) }}" alt="{{ $vacancy->name }}"></td>
                                        <td>{{ $vacancy->position_company_id }}</td>
                                        <td>{{ $vacancy->start_datetime }}</td>
                                        <td>{{ $vacancy->end_datetime }}</td>
                                        <td class="text-center">
                                            <a class="openModalBtn" title="Inscripción"
                                                data-vacancy='@json($vacancy)' data-bs-toggle="modal"
                                                data-bs-target="#myModal">
                                                <i class="fas fa-eye" style="color: #000000;"></i>
                                            </a>
                                        </td>
                                        <form action="{{ route('eliminar_vacante', $vacancy->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <a href="{{ route('editar_vacante', ['id' => $vacancy->id]) }}"
                                                    class="btn btn-primary btn-sm">Editar</a>
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este Vacante?')">Eliminar</button>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="myModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vacancyTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    Descripción General:
                                </div>
                                <p id="vacancyDescription"></p>
                                <div class="card-header">
                                    Requisitos:
                                </div>
                                <ul id="vacancyRequirements" class="list-unstyled">
                                    <!-- Requisitos se mostrarán aquí como list items -->
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a href="{{ route('inscription') }}" class="btn btn-primary">Inscripción</a>
                    </div>
                </div>
            </div>
        </div>


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
    @show

    @section('dataTables')
    @show
</body>

</html>
