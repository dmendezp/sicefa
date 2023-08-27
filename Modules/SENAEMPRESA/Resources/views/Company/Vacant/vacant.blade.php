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
            <h1 class="text-center"><strong><em><span>Vacantes</span></em></strong></h1>
            <div class="col-md-3">


                <label for="cursoFilter">Filtrar por Curso:</label>
                <select class="form-control" id="cursoFilter">
                    <option value="">Todos los cursos</option>
                    <option value="curso1">Curso 1</option>
                    <option value="curso2">Curso 2</option>
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
                                    <th>Sena Empresa Id</th>
                                    <th>Id Cargo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th class="text-center">Presentación</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Contador</td>
                                    <td>1 Estrategia 34</td>
                                    <td>1 Contador</td>
                                    <td>24-08-2023</td>
                                    <td>24-08-2023</td>
                                    <td class="text-center">
                                        <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                                    </td>
                                    <td>Editar|Eliminar</td>
                                </tr>
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
                                <div class="card-header">
                                    Descripción General:
                                </div>
                                <p>Tu función principal será mantener registros precisos y
                                    actualizados de las
                                    transacciones
                                    financieras, asegurando el cumplimiento de las normas contables y fiscales
                                    vigentes.
                                    Trabajarás en estrecha colaboración con el departamento financiero y la gerencia
                                    para
                                    proporcionar información financiera crucial y asesoramiento estratégico.</p>
                                <div class="card-header">
                                    Requisitos:
                                </div>
                                <ul>
                                    <li>Ser mayor de 13 años.</li>
                                    <li>Contar con el conocimiento para el uso administrativo de redes sociales
                                        (Twitter, Instagram, Facebook, Whatsapp).</li>
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
