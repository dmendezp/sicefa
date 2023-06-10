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
                        <img
                            src="https://marketplace.canva.com/EAE2_HrPNRU/1/0/1600w/canva-mascot-character-twitch-profile-picture-jF0b61iv4pQ.jpg">

                        <div class="info">
                            <h2 class="name">Contador</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img
                            src="https://marketplace.canva.com/EAEjwVtGaFM/2/0/1600w/canva-azul-y-negro-limpio-minimalista-imagen-de-perfil-de-twitch-e7SU6tIoyis.jpg">

                        <div class="info">
                            <h2 class="name">Administrador Talento Humano</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img src="https://ehorus.com/wp-content/uploads/2018/06/administrador-de-sistemas-featured.png">

                        <div class="info">
                            <h2 class="name">Administrador Gestion de calidad</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-instagram"></i>
                            </div>

                        </div>

                    </div>

                    <div class="profile">
                        <img
                            src="https://marketplace.canva.com/EAE2_DLA9H8/1/0/1600w/canva-mascot-character-twitch-profile-picture-wD-8htUsoVw.jpg">

                        <div class="info">
                            <h2 class="name">Secretario</h2>
                            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                            <div class="team_icon">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-instagram"></i>
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
