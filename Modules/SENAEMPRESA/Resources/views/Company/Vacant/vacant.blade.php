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
                <div class="alert alert-success">
                    {{ session('success') }}
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
                            <thead class="vacant bg-danger text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Presentación</th>
                                    <th>Id Cargo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th class="text-center">Inscripción</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacancies as $vacancy)
                                    <tr>
                                        <td>{{ $vacancy->id }}</td>
                                        <td>{{ $vacancy->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $vacancy->image) }}"
                                                alt="{{ $vacancy->name }}" width="100">
                                        </td>

                                        <td>{{ $vacancy->position_company_id }}</td>
                                        <td>{{ $vacancy->start_date }}</td>
                                        <td>{{ $vacancy->end_date }}</td>
                                        <td class="text-center">
                                            <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                                        </td>
                                        <td>Editar|Eliminar</td>
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
                        <h5 class="modal-title">Contador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>


                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                @foreach ($vacancies as $vacancy)
                                    <div class="card-header">
                                        Descripción General:
                                    </div>
                                    <p>{{ $vacancy->description_general }}</p>
                                    <div class="card-header">
                                        Requisitos:
                                    </div>
                                    <ul>{{ $vacancy->requirement }}</ul>
                                @endforeach
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
