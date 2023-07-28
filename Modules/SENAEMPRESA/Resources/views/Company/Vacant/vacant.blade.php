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
        <div id="contactos" class="team">
            <h1><strong><em><span>Vacantes</span></strong></em></h1>
            <div class="team_box">
                <div class="profile">
                    <img src="{{ asset('senaempresa/images/contador.jpg') }}">

                    <div class="info">
                        <h2 class="name">Contador</h2>
                        <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                        <div class="team_icon">
                            <a href="ruta_de_la_otra_vista.html" title="Presentación">
                                <i class="fas fa-file-powerpoint" style="color: #000000;"></i>
                            </a>
                            <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                        </div>

                    </div>

                </div>

                <div class="profile">
                    <img src="{{ asset('senaempresa/images/talento_humano.jpg') }}">

                    <div class="info">
                        <h2 class="name">Administrador Talento Humano</h2>
                        <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                        <div class="team_icon">
                            <a href="ruta_de_la_otra_vista.html" title="Presentación">
                                <i class="fas fa-file-powerpoint" style="color: #000000;"></i>
                            </a>
                            <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                        </div>

                    </div>

                </div>

                <div class="profile">
                    <img src="{{ asset('senaempresa/images/gestion_calidad.jpg') }}">

                    <div class="info">
                        <h2 class="name">Administrador Gestion de calidad</h2>
                        <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                        <div class="team_icon">
                            <a href="ruta_de_la_otra_vista.html" title="Presentación">
                                <i class="fas fa-file-powerpoint" style="color: #000000;"></i>
                            </a>
                            <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                        </div>

                    </div>

                </div>

                <div class="profile">
                    <img src="{{ asset('senaempresa/images/secretario.jpg') }}">

                    <div class="info">
                        <h2 class="name">Secretario</h2>
                        <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                        <div class="team_icon">
                            <a href="ruta_de_la_otra_vista.html" title="Presentación">
                                <i class="fas fa-file-powerpoint" style="color: #000000;"></i>
                            </a>
                            <a id="openModalBtn" title="Inscripción"><i class="fas fa-eye"></i></a>
                        </div>

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
