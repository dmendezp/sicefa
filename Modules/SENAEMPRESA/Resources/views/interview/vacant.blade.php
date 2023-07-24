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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Vacantes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <div id="contactos" class="team">
                <h1><strong><em><span>Vacantes</span></strong></em></h1>

                <div class="team_box">
                    <div class="profile">
                        <img src="{{ asset('senaempresa/images/contador.jpg') }}">

                        <div class="info">
                            <h2 class="name">Contador</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img src="{{ asset('senaempresa/images/talento_humano.jpg') }}">

                        <div class="info">
                            <h2 class="name">Administrador Talento Humano</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img src="{{ asset('senaempresa/images/gestion_calidad.jpg') }}">

                        <div class="info">
                            <h2 class="name">Administrador Gestion de calidad</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img src="{{ asset('senaempresa/images/secretario.jpg') }}">

                        <div class="info">
                            <h2 class="name">Secretario</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-instagram"></i>
                            </div>

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
